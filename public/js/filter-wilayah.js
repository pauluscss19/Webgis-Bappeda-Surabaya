// ============================================================
// FILTER-WILAYAH.JS
// - Marker di dalam wilayah: tampil normal, bisa diklik
// - Marker di luar wilayah: transparan/dim, tidak bisa diklik
// - Batas wilayah: selalu bringToBack di bawah marker
// - Statistik legend: hanya hitung marker di dalam wilayah
// ============================================================

window.FilterWilayah = (function () {

    let _activeKec = null;
    let _activeKel = null;
    let _isActive  = false;
    let _autoAddedBoundary = [];
    
    // FIX: Variabel untuk menyimpan feature wilayah yang sedang aktif (dibutuhkan Excel Export)
    let _currentTargetFeature = null; 

    // Simpan jumlah marker inside per layer saat filter aktif
    // { layerKey: countInside }
    let _insideCount = {};

    const DIM_OPACITY      = 0.12;
    const DIM_FILL_OPACITY = 0.08;

    // ── Utilitas ──────────────────────────────────────────────

    function _getKecList() {
        if (!geoJsonStore['KECAMATAN']) return [];
        const seen = new Set();
        return geoJsonStore['KECAMATAN'].features
            .map(f => f.properties.Name || f.properties.KECAMATAN || f.properties.name || '')
            .filter(name => {
                if (!name) return false;
                const key = name.trim().toLowerCase();
                if (seen.has(key)) return false;
                seen.add(key);
                return true;
            })
            .sort((a, b) => a.localeCompare(b, 'id'));
    }

    // Cache spatial join kelurahan → kecamatan (dibangun sekali, lazy)
    let _kelKecCache = null;

    function _buildKelKecCache() {
        if (_kelKecCache) return;
        _kelKecCache = {};
        if (!geoJsonStore['KELURAHAN'] || !geoJsonStore['KECAMATAN']) return;

        geoJsonStore['KELURAHAN'].features.forEach(function(f) {
            const kelName = f.properties.K || f.properties.KELURAHAN || f.properties.name || '';
            if (!kelName) return;

            // Prioritas 1: properti KECAMATAN langsung di data kelurahan
            const propKec = f.properties.KECAMATAN || f.properties.kecamatan ||
                            f.properties.Kecamatan  || f.properties.KEC || '';
            if (propKec) {
                _kelKecCache[kelName.trim().toLowerCase()] = propKec.trim().toLowerCase();
                return;
            }

            // Prioritas 2: spatial join — cek centroid kelurahan masuk kecamatan mana
            try {
                const centroid = turf.centroid(f);
                for (const kf of geoJsonStore['KECAMATAN'].features) {
                    let kpoly;
                    if (kf.geometry.type === 'Polygon')
                        kpoly = turf.polygon(kf.geometry.coordinates);
                    else if (kf.geometry.type === 'MultiPolygon')
                        kpoly = turf.multiPolygon(kf.geometry.coordinates);
                    else continue;
                    if (turf.booleanPointInPolygon(centroid, kpoly)) {
                        const kecName = kf.properties.Name || kf.properties.KECAMATAN || kf.properties.name || '';
                        if (kecName) _kelKecCache[kelName.trim().toLowerCase()] = kecName.trim().toLowerCase();
                        break;
                    }
                }
            } catch(e) { /* skip */ }
        });
    }

    function _getKelList(kecName) {
        if (!geoJsonStore['KELURAHAN']) return [];
        if (!kecName) {
            // Tidak ada filter kecamatan — tampilkan semua
            return geoJsonStore['KELURAHAN'].features
                .map(f => f.properties.K || f.properties.KELURAHAN || f.properties.name || '')
                .filter(Boolean)
                .sort((a, b) => a.localeCompare(b, 'id'));
        }

        // Ada filter kecamatan — pastikan cache sudah dibangun
        _buildKelKecCache();
        const kecLower = kecName.trim().toLowerCase();

        return geoJsonStore['KELURAHAN'].features
            .filter(f => {
                const kelName = f.properties.K || f.properties.KELURAHAN || f.properties.name || '';
                if (!kelName) return false;

                // Cek dari properti langsung dulu
                const propKec = f.properties.KECAMATAN || f.properties.kecamatan ||
                                f.properties.Kecamatan  || f.properties.KEC || '';
                if (propKec) return propKec.trim().toLowerCase() === kecLower;

                // Cek dari cache spatial join
                const cached = _kelKecCache[kelName.trim().toLowerCase()];
                return cached === kecLower;
            })
            .map(f => f.properties.K || f.properties.KELURAHAN || f.properties.name || '')
            .filter(Boolean)
            .sort((a, b) => a.localeCompare(b, 'id'));
    }

    function _findFeature(storeKey, fields, name) {
        if (!geoJsonStore[storeKey]) return null;
        return geoJsonStore[storeKey].features.find(f => {
            for (const field of fields) {
                const val = (f.properties[field] || '').toString();
                if (val.toLowerCase() === name.toLowerCase()) return true;
            }
            return false;
        }) || null;
    }

    function _pointInFeature(latlng, feature) {
        try {
            const pt = turf.point([latlng.lng, latlng.lat]);
            let poly;
            if (feature.geometry.type === 'Polygon')
                poly = turf.polygon(feature.geometry.coordinates);
            else if (feature.geometry.type === 'MultiPolygon')
                poly = turf.multiPolygon(feature.geometry.coordinates);
            else return false;
            return turf.booleanPointInPolygon(pt, poly);
        } catch (e) { return false; }
    }

    function _zoomTo(feature) {
        try {
            const bbox = turf.bbox(feature);
            map.fitBounds([[bbox[1], bbox[0]], [bbox[3], bbox[2]]], {
                padding: [60, 60], animate: true, duration: 0.8
            });
        } catch (e) {}
    }

    // ── Style helpers ─────────────────────────────────────────

    function _saveOrigStyle(sub) {
        if (sub._fw_origStyle) return;
        if (sub.options) {
            sub._fw_origStyle = {
                opacity:     sub.options.opacity     !== undefined ? sub.options.opacity     : 1,
                fillOpacity: sub.options.fillOpacity !== undefined ? sub.options.fillOpacity : 1,
                color:       sub.options.color,
                fillColor:   sub.options.fillColor,
                weight:      sub.options.weight
            };
        }
    }

    function _restoreOrigStyle(sub) {
        if (!sub._fw_origStyle) {
            if (sub.setStyle) sub.setStyle({ opacity: 1, fillOpacity: 1 });
        } else {
            if (sub.setStyle) sub.setStyle(sub._fw_origStyle);
        }
        if (sub.getElement && sub.getElement()) {
            sub.getElement().style.pointerEvents = 'auto';
            sub.getElement().style.cursor = 'pointer';
        }
    }

    function _dimSub(sub) {
        if (sub.setStyle) sub.setStyle({ opacity: DIM_OPACITY, fillOpacity: DIM_FILL_OPACITY });
        if (sub.getElement && sub.getElement()) {
            sub.getElement().style.pointerEvents = 'none';
        }
    }

    // ── Override infoLegend saat filter aktif ─────────────────

    function _patchLegend() {
        if (typeof infoLegend === 'undefined') return;

        // Simpan fungsi update asli kalau belum disimpan
        if (!infoLegend._origUpdate) {
            infoLegend._origUpdate = infoLegend.update.bind(infoLegend);
        }

        // Override update: tampilkan count inside + label filter
        infoLegend.update = function () {
            const label = _activeKel
                ? (_activeKec ? 'Kec. ' + _activeKec + ' › Kel. ' + _activeKel : 'Kel. ' + _activeKel)
                : 'Kec. ' + _activeKec;

            let html = '<h4>Statistik Data</h4>';
            html += `<div style="font-size:10px; color:#0369a1; background:#e0f2fe; border-radius:4px; padding:3px 6px; margin-bottom:6px; font-weight:600;">
                        <i class="bi bi-funnel-fill"></i> ${label}
                     </div>`;

            let hasActive = false;
            Object.keys(layerConfig).forEach(key => {
                const config = layerConfig[key];
                const layer  = mapLayers[key];
                if (config.isBoundary) return;
                if (!layer || !map.hasLayer(layer)) return;

                hasActive = true;
                const count = _insideCount[key] !== undefined ? _insideCount[key] : 0;
                const total = layer.getLayers().length;

                html += `
                    <div class="legend-item">
                        <div style="display:flex; align-items:center;">
                            <span class="layer-color" style="background:${config.color}; width:10px; height:10px; margin-right:5px;"></span>
                            ${config.label}
                        </div>
                        <span>
                            <b style="color:#0369a1;">${count}</b>
                            <span style="color:#94a3b8; font-size:10px;">/${total}</span>
                        </span>
                    </div>`;
            });

            if (!hasActive) html += '<div style="color:#777; font-size:11px;">Tidak ada layer aktif</div>';
            html += '<div style="margin-top:6px; font-size:10px; color:#64748b;">Klik untuk refresh</div>';
            // FIX: Tulis ke _statsDiv bukan _div agar struktur legend (heatmap-legend) tidak tertimpa
            const target = this._statsDiv || this._div;
            target.innerHTML = html;
        };

        infoLegend.update();
    }

    function _restoreLegend() {
        if (typeof infoLegend === 'undefined') return;
        if (infoLegend._origUpdate) {
            infoLegend.update = infoLegend._origUpdate;
        }
        infoLegend.update();
    }

    // ── Core: Terapkan Filter ─────────────────────────────────

    function _apply() {
        if (!_activeKec && !_activeKel) { _clear(); return; }

        let targetFeature = null;
        if (_activeKel) {
            targetFeature = _findFeature('KELURAHAN', ['K','KELURAHAN','name','DESA'], _activeKel);
        }
        if (!targetFeature && _activeKec) {
            targetFeature = _findFeature('KECAMATAN', ['Name','KECAMATAN','name'], _activeKec);
        }
        if (!targetFeature) {
            _setBadge('Wilayah tidak ditemukan dalam data', false);
            return;
        }

        _isActive    = true;
        _insideCount = {};
        _autoAddedBoundary = [];
        
        // FIX: Simpan target yang sedang difilter ke variabel global agar bisa ditarik oleh Excel
        _currentTargetFeature = targetFeature;

        // ── 1. Dim/normal marker, hitung yang inside ──────────
        Object.keys(mapLayers).forEach(function(layerKey) {
            const cfg = layerConfig[layerKey];
            if (!cfg || cfg.isBoundary) return;
            if (['SURABAYA_MASK','HEATMAP_LAYER','ANALYSIS_RESULT','CLUSTER_BOUNDARIES'].includes(layerKey)) return;

            const layer = mapLayers[layerKey];
            if (!layer || !map.hasLayer(layer)) return;

            let countInside = 0;
            layer.eachLayer(function(sub) {
                let latlng = null;
                if (sub.getLatLng) latlng = sub.getLatLng();
                else if (sub.getBounds) latlng = sub.getBounds().getCenter();
                if (!latlng) return;

                _saveOrigStyle(sub);

                const inside = _pointInFeature(latlng, targetFeature);
                if (inside) {
                    _restoreOrigStyle(sub);
                    countInside++;
                } else {
                    _dimSub(sub);
                }
            });
            _insideCount[layerKey] = countInside;
        });

        // ── 2. Batas wilayah ──────────────────────────────────
        _showBoundary(targetFeature);

        // ── 3. Marker ke depan ────────────────────────────────
        _liftMarkers();

        // ── 3b. Angkat marker INSIDE ke atas boundary ─────────
        // Dilakukan setelah _showBoundary & _liftMarkers agar
        // marker inside bisa diklik dan tidak tertutup polygon wilayah.
        _liftInsideMarkers(targetFeature);

        // ── 4. Zoom ───────────────────────────────────────────
        _zoomTo(targetFeature);

        // ── 5. Patch legend & badge ───────────────────────────
        _patchLegend();
        const label = _activeKel
            ? (_activeKec ? 'Kec. ' + _activeKec + ' › Kel. ' + _activeKel : 'Kel. ' + _activeKel)
            : 'Kec. ' + _activeKec;
        _setBadge('Filter aktif: ' + label, true);
    }

    function _showBoundary(targetFeature) {
        const boundaryKey = _activeKel ? 'KELURAHAN' : 'KECAMATAN';
        const cfg = layerConfig[boundaryKey];

        if (mapLayers[boundaryKey] && !map.hasLayer(mapLayers[boundaryKey])) {
            map.addLayer(mapLayers[boundaryKey]);
            _autoAddedBoundary.push(boundaryKey);
        }

        if (mapLayers[boundaryKey] && map.hasLayer(mapLayers[boundaryKey])) {
            mapLayers[boundaryKey].eachLayer(function(sub) {
                const feat  = sub.feature;
                if (!feat) return;

                let isTarget = false;
                const props  = feat.properties || {};
                if (_activeKel) {
                    const v = props.K || props.KELURAHAN || props.name || '';
                    isTarget = v.toLowerCase() === _activeKel.toLowerCase();
                } else if (_activeKec) {
                    const v = props.Name || props.KECAMATAN || props.name || '';
                    isTarget = v.toLowerCase() === _activeKec.toLowerCase();
                }

                if (_activeKel) {
                    // Saat filter kelurahan: tampilkan HANYA kelurahan yang dicari, sisanya hide
                    if (isTarget) {
                        // FIX: Border tebal dan fill yang lebih visible
                        if (sub.setStyle) sub.setStyle({
                            color: cfg.color || '#3b82f6',       // Warna border
                            weight: 5,                            // Border tebal (dari 4 → 5)
                            opacity: 1,                           // Border solid 100%
                            fillColor: cfg.color || '#3b82f6',   // Warna fill
                            fillOpacity: 0.25,                    // Fill visible (dari 0.1 → 0.25)
                            dashArray: '',                        // Garis solid
                            className: 'boundary-filter-active'  // CSS class untuk z-index fix
                        });
                        // FIX: Angkat border ke atas agar tidak tertimpa mask/layer lain
                        sub.bringToFront(); 
                        
                        // FIX CSS: Tambahkan class ke SVG path
                        const el = sub.getElement ? sub.getElement() : null;
                        if (el) {
                            el.style.display = '';
                            el.classList.add('boundary-filter-active');
                        }
                    } else {
                        // Sembunyikan kelurahan lain sepenuhnya
                        if (sub.setStyle) sub.setStyle({
                            opacity: 0, fillOpacity: 0, weight: 0,
                            className: 'boundary-filter-inactive'
                        });
                        const el = sub.getElement ? sub.getElement() : null;
                        if (el) {
                            el.style.display = 'none';
                            el.classList.add('boundary-filter-inactive');
                            el.classList.remove('boundary-filter-active');
                        }
                    }
                } else {
                    // Saat filter kecamatan: highlight target, dim sisanya
                    if (sub.setStyle) {
                        sub.setStyle(isTarget ? {
                            color: cfg.color || '#3b82f6',       // Warna border
                            weight: 5,                            // Border tebal (dari 4 → 5)
                            opacity: 1,                           // Border solid
                            fillColor: cfg.color || '#3b82f6',   // Warna fill
                            fillOpacity: 0.25,                    // Fill visible (dari 0.1 → 0.25)
                            dashArray: '',                        // Garis solid
                            className: 'boundary-filter-active'  // CSS class untuk z-index
                        } : {
                            color: '#94a3b8',                     // Border abu untuk non-target
                            weight: 1,
                            opacity: 0.25,
                            fillColor: '#f1f5f9',
                            fillOpacity: 0.02,
                            dashArray: '4,4',                     // Garis putus-putus untuk non-target
                            className: 'boundary-filter-inactive'
                        });
                    }
                    // FIX: Angkat border target ke atas + tambahkan CSS class
                    const el = sub.getElement ? sub.getElement() : null;
                    if (isTarget) {
                        sub.bringToFront();
                        if (el) {
                            el.classList.add('boundary-filter-active');
                            el.classList.remove('boundary-filter-inactive');
                        }
                    } else {
                        sub.bringToBack();
                        if (el) {
                            el.classList.add('boundary-filter-inactive');
                            el.classList.remove('boundary-filter-active');
                        }
                    }
                }
            });
            // Tidak perlu bringToBack layer utamanya jika isTarget sudah di Front
        }

        // Kecamatan sebagai konteks tipis saat filter kelurahan
        if (_activeKel && mapLayers['KECAMATAN'] && map.hasLayer(mapLayers['KECAMATAN'])) {
            mapLayers['KECAMATAN'].eachLayer(function(sub) {
                if (sub.setStyle) sub.setStyle({
                    color: layerConfig['KECAMATAN'].color,
                    weight: 2, opacity: 0.5, fillOpacity: 0, dashArray: '6,4'
                });
                sub.bringToBack();
            });
        }

        if (mapLayers['SURABAYA_MASK'] && map.hasLayer(mapLayers['SURABAYA_MASK'])) {
            mapLayers['SURABAYA_MASK'].bringToBack();
        }
    }

    // ── Angkat marker INSIDE ke atas segalanya ───────────────
    // Dipanggil TERAKHIR setelah _showBoundary & _liftMarkers,
    // sehingga titik-titik di dalam wilayah selalu bisa diklik.
    function _liftInsideMarkers(targetFeature) {
        Object.keys(mapLayers).forEach(function(layerKey) {
            const cfg = layerConfig[layerKey];
            if (!cfg || cfg.isBoundary) return;
            if (['SURABAYA_MASK','HEATMAP_LAYER','ANALYSIS_RESULT','CLUSTER_BOUNDARIES'].includes(layerKey)) return;
            const layer = mapLayers[layerKey];
            if (!layer || !map.hasLayer(layer)) return;

            layer.eachLayer(function(sub) {
                let latlng = null;
                if (sub.getLatLng) latlng = sub.getLatLng();
                else if (sub.getBounds) latlng = sub.getBounds().getCenter();
                if (!latlng) return;

                const inside = _pointInFeature(latlng, targetFeature);
                if (inside) {
                    // Pastikan pointer-events aktif & angkat ke atas
                    if (sub.getElement && sub.getElement()) {
                        sub.getElement().style.pointerEvents = 'auto';
                        sub.getElement().style.cursor = 'pointer';
                    }
                    if (sub.bringToFront) sub.bringToFront();
                }
            });
        });
    }

    function _liftMarkers() {
        Object.keys(mapLayers).filter(function(k) {
            const cfg = layerConfig[k];
            if (!cfg || cfg.isBoundary) return false;
            if (['SURABAYA_MASK','HEATMAP_LAYER','ANALYSIS_RESULT','CLUSTER_BOUNDARIES'].includes(k)) return false;
            return mapLayers[k] && map.hasLayer(mapLayers[k]);
        }).forEach(function(k) {
            mapLayers[k].bringToFront();
        });
    }

    // ── Core: Reset ───────────────────────────────────────────

    function _clear() {
        _isActive    = false;
        _kelKecCache = null;  // reset cache agar fresh
        
        // FIX: Hapus target aktif
        _currentTargetFeature = null;

        // Kembalikan semua marker ke style asli
        Object.keys(mapLayers).forEach(function(layerKey) {
            const cfg = layerConfig[layerKey];
            if (!cfg || cfg.isBoundary) return;
            if (['SURABAYA_MASK','HEATMAP_LAYER','ANALYSIS_RESULT','CLUSTER_BOUNDARIES'].includes(layerKey)) return;
            const layer = mapLayers[layerKey];
            if (!layer || !map.hasLayer(layer)) return;
            layer.eachLayer(function(sub) { _restoreOrigStyle(sub); });
        });

        // Hapus boundary yang auto-ditambahkan
        _autoAddedBoundary.forEach(function(bKey) {
            if (mapLayers[bKey] && map.hasLayer(mapLayers[bKey])) {
                map.removeLayer(mapLayers[bKey]);
                const cb = document.querySelector('.layer-toggle[data-layer="' + bKey + '"]');
                if (cb) cb.checked = false;
            }
        });
        _autoAddedBoundary = [];

        // Reset style batas yang masih aktif
        ['KECAMATAN','KELURAHAN','BATAS_RW'].forEach(function(bKey) {
            if (!mapLayers[bKey] || !map.hasLayer(mapLayers[bKey])) return;
            const cfg = layerConfig[bKey];
            // Kembalikan display semua sub-layer yang mungkin di-hide
            mapLayers[bKey].eachLayer(function(sub) {
                const el = sub.getElement ? sub.getElement() : null;
                if (el) el.style.display = '';
            });
            mapLayers[bKey].setStyle({
                color: cfg.color, weight: 2, opacity: 0.8,
                fillOpacity: 0.1, fillColor: cfg.color, dashArray: '5,5'
            });
            mapLayers[bKey].bringToBack();
        });
        if (mapLayers['SURABAYA_MASK'] && map.hasLayer(mapLayers['SURABAYA_MASK'])) {
            mapLayers['SURABAYA_MASK'].bringToBack();
        }

        // Kembalikan legend ke normal
        _insideCount = {};
        _restoreLegend();

        // Reset dropdown & badge
        _activeKec = null;
        _activeKel = null;
        const selKec = document.getElementById('fw-kecamatan');
        const selKel = document.getElementById('fw-kelurahan');
        if (selKec) selKec.value = '';
        if (selKel) selKel.innerHTML = '<option value="">— Semua Kelurahan —</option>';
        _setBadge('', false);
    }

    // ── Badge ─────────────────────────────────────────────────

    function _setBadge(text, show) {
        const el = document.getElementById('fw-active-badge');
        if (!el) return;
        el.style.display = show ? 'block' : 'none';
        el.textContent = text;
    }

    // ── Dropdown ──────────────────────────────────────────────

    function _populateKec() {
        const sel = document.getElementById('fw-kecamatan');
        if (!sel) return;
        _getKecList().forEach(function(name) {
            const opt = document.createElement('option');
            opt.value = name; opt.textContent = name;
            sel.appendChild(opt);
        });
        sel.addEventListener('change', function() { _populateKel(this.value); });
    }

    function _populateKel(kecName) {
        const sel = document.getElementById('fw-kelurahan');
        if (!sel) return;
        sel.innerHTML = '<option value="">— Semua Kelurahan —</option>';
        _getKelList(kecName).forEach(function(name) {
            const opt = document.createElement('option');
            opt.value = name; opt.textContent = name;
            sel.appendChild(opt);
        });
    }

    // ── Public ────────────────────────────────────────────────

    function applyFromUI() {
        if (_isActive) _clear();

        const selKec = document.getElementById('fw-kecamatan');
        const selKel = document.getElementById('fw-kelurahan');
        _activeKec = (selKec && selKec.value) ? selKec.value : null;
        _activeKel = (selKel && selKel.value) ? selKel.value : null;

        if (!_activeKec && !_activeKel) {
            _setBadge('Pilih kecamatan atau kelurahan terlebih dahulu', false);
            return;
        }
        _apply();
    }

    function clearFilter() { _clear(); }

    function init() {
        var _try = function() {
            if (!geoJsonStore['KECAMATAN'] || !geoJsonStore['KELURAHAN'] || !document.getElementById('fw-kecamatan')) {
                setTimeout(_try, 500); return;
            }
            _populateKec();
            _populateKel('');
            console.log('[FilterWilayah] Siap');
        };
        _try();
    }

    // Expose state untuk kebutuhan eksternal (misal pdf-export)
    function getInsideCount() { return _insideCount; }
    function isFilterActive() { return _isActive; }
    
    // FIX: Fungsi baru untuk diambil oleh excel-export.js
    function getActiveFeature() { return _currentTargetFeature; }

    function getFilterLabel() {
        if (!_isActive) return null;
        if (_activeKel) return _activeKec
            ? 'Kec. ' + _activeKec + ' \u203a Kel. ' + _activeKel
            : 'Kel. ' + _activeKel;
        if (_activeKec) return 'Kec. ' + _activeKec;
        return null;
    }

    // Pastikan getActiveFeature dimasukkan ke dalam return
    return { init, applyFromUI, clearFilter, getInsideCount, isFilterActive, getFilterLabel, getActiveFeature };

})();

(function() {
    var _boot = function() {
        if (typeof map === 'undefined' || typeof geoJsonStore === 'undefined' || typeof layerConfig === 'undefined') {
            setTimeout(_boot, 600); return;
        }
        FilterWilayah.init();
    };
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', _boot);
    } else { _boot(); }
})();