// ============================================================
// SEARCH-BAR.JS — Pencarian Titik Poin Berdasarkan Nama
//
// Cara kerja:
// - Mencari di semua layer yang sudah dimuat (geoJsonStore)
// - Juga mencari di layer yang belum dimuat dengan lazy-load
// - Hasil klik → zoom ke titik & buka popup
// ============================================================

(function() {

    // ─── State ────────────────────────────────────────────────
    let _searchResults  = [];
    let _searchDebounce = null;
    let _activeMarker   = null;   // highlight marker sementara

    // ─── DOM refs (diisi saat init) ───────────────────────────
    let _input, _resultBox, _clearBtn;

    // ─── Inisialisasi (dipanggil setelah DOM siap) ────────────
    window.initSearchBar = function() {
        _input     = document.getElementById('sb-input');
        _resultBox = document.getElementById('sb-results');
        _clearBtn  = document.getElementById('sb-clear');

        if (!_input) return;

        _input.addEventListener('input', function() {
            clearTimeout(_searchDebounce);
            const q = _input.value.trim();
            _clearBtn.style.display = q ? 'flex' : 'none';

            if (!q) { _hideResults(); return; }
            _searchDebounce = setTimeout(() => _doSearch(q), 280);
        });

        _input.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') { _clearSearch(); return; }
            if (e.key === 'ArrowDown') { _focusResult(0); e.preventDefault(); }
        });

        _clearBtn.addEventListener('click', _clearSearch);

        // Klik di luar → tutup hasil
        document.addEventListener('click', function(e) {
            if (!e.target.closest('#search-bar-wrapper')) _hideResults();
        });
    };

    // ─── Ambil nama dari properties ──────────────────────────
    function _getName(props, config) {
        const candidates = [
            config && config.nameField,
            'NAMA SEKOL', 'Nama_Lokas', 'Pos_Ekst',
            'NAMA', 'Name', 'name', 'K', 'RW', 'DESA', 'KELURAHAN'
        ].filter(Boolean);
        for (const f of candidates) {
            if (props[f] && String(props[f]).trim()) return String(props[f]).trim();
        }
        return null;
    }

    // ─── Ambil koordinat dari feature ────────────────────────
    function _getLatlng(feature) {
        const g = feature.geometry;
        if (!g) return null;
        try {
            if (g.type === 'Point')
                return L.latLng(g.coordinates[1], g.coordinates[0]);
            if (g.type === 'MultiPoint' && g.coordinates.length)
                return L.latLng(g.coordinates[0][1], g.coordinates[0][0]);
            if (g.type === 'LineString' && g.coordinates.length) {
                const mid = Math.floor(g.coordinates.length / 2);
                return L.latLng(g.coordinates[mid][1], g.coordinates[mid][0]);
            }
            if ((g.type === 'Polygon' || g.type === 'MultiPolygon') && typeof turf !== 'undefined') {
                const c = turf.centroid(feature);
                return L.latLng(c.geometry.coordinates[1], c.geometry.coordinates[0]);
            }
        } catch(e) {}
        return null;
    }

    // ─── Cari di semua layer yang sudah dimuat ────────────────
    function _searchLoaded(q) {
        const results = [];
        const qLower  = q.toLowerCase();

        Object.keys(geoJsonStore).forEach(function(key) {
            const data   = geoJsonStore[key];
            const config = layerConfig[key];
            if (!data || !data.features) return;

            data.features.forEach(function(feature) {
                const props = feature.properties || {};
                const name  = _getName(props, config);
                if (!name) return;
                if (!name.toLowerCase().includes(qLower)) return;

                const latlng = _getLatlng(feature);
                if (!latlng) return;

                results.push({
                    key,
                    label:  config ? config.label : key,
                    name,
                    color:  config ? config.color : '#3b82f6',
                    latlng,
                    feature
                });
            });
        });

        return results;
    }

    // ─── Jalankan pencarian ───────────────────────────────────
    function _doSearch(q) {
        _searchResults = _searchLoaded(q);
        _renderResults(_searchResults, q);
    }

    // ─── Render hasil ─────────────────────────────────────────
    function _renderResults(results, q) {
        if (!results.length) {
            _resultBox.innerHTML = `
                <div class="sb-empty">
                    <i class="bi bi-search" style="font-size:18px;color:#cbd5e1;"></i>
                    <span>Tidak ada hasil untuk "<strong>${_escHtml(q)}</strong>"</span>
                    <span style="font-size:10px;color:#94a3b8;">Aktifkan layer terlebih dahulu</span>
                </div>`;
            _showResults();
            return;
        }

        // Batasi maksimal 40 hasil
        const shown = results.slice(0, 40);
        const more  = results.length - shown.length;

        let html = shown.map((r, i) => `
            <div class="sb-item" tabindex="0" data-idx="${i}"
                 onmousedown="window._sbSelect(${i})"
                 onkeydown="if(event.key==='Enter')window._sbSelect(${i});
                             if(event.key==='ArrowDown'){var n=this.nextElementSibling;if(n)n.focus();event.preventDefault();}
                             if(event.key==='ArrowUp'){var p=this.previousElementSibling;if(p)p.focus();else document.getElementById('sb-input').focus();event.preventDefault();}">
                <span class="sb-dot" style="background:${r.color};"></span>
                <div class="sb-item-text">
                    <div class="sb-item-name">${_highlight(r.name, q)}</div>
                    <div class="sb-item-cat">${_escHtml(r.label)}</div>
                </div>
                <i class="bi bi-arrow-right-short sb-item-arrow"></i>
            </div>
        `).join('');

        if (more > 0) {
            html += `<div class="sb-more">+${more} hasil lainnya — persempit pencarian</div>`;
        }

        _resultBox.innerHTML = html;
        _showResults();
    }

    // ─── Pilih hasil ──────────────────────────────────────────
    window._sbSelect = function(idx) {
        const r = _searchResults[idx];
        if (!r) return;

        _input.value = r.name;
        _clearBtn.style.display = 'flex';
        _hideResults();

        // Hapus highlight marker sebelumnya
        if (_activeMarker) { map.removeLayer(_activeMarker); _activeMarker = null; }

        // Zoom ke titik
        const zoom = (r.feature.geometry && r.feature.geometry.type === 'Point') ? 17 : 15;
        map.flyTo(r.latlng, zoom, { animate: true, duration: 0.8 });

        // Tambahkan pulse marker sementara
        const pulseIcon = L.divIcon({
            className: '',
            html: `<div class="sb-pulse-ring" style="border-color:${r.color};">
                       <div class="sb-pulse-dot" style="background:${r.color};"></div>
                   </div>`,
            iconSize: [28, 28],
            iconAnchor: [14, 14]
        });
        _activeMarker = L.marker(r.latlng, { icon: pulseIcon, interactive: false }).addTo(map);

        // Coba buka popup dari layer asli
        setTimeout(function() {
            _tryOpenPopup(r);
        }, 900);

        // Hapus pulse marker setelah 4 detik
        setTimeout(function() {
            if (_activeMarker) { map.removeLayer(_activeMarker); _activeMarker = null; }
        }, 4000);
    };

    // ─── Coba buka popup dari layer yang ada di peta ──────────
    function _tryOpenPopup(r) {
        const layer = mapLayers[r.key];
        if (!layer) return;

        // Pastikan layer ada di peta
        if (!map.hasLayer(layer)) return;

        // Iterasi sub-layer untuk menemukan feature yang cocok
        layer.eachLayer(function(subLayer) {
            const feature = subLayer.feature;
            if (!feature) return;
            const props = feature.properties || {};
            const name  = _getName(props, layerConfig[r.key]);
            if (name === r.name) {
                const config = layerConfig[r.key];
                const html   = buildPopupContent(feature, r.key, config);
                subLayer.bindPopup(html, { maxWidth: 280, minWidth: 200 }).openPopup();
            }
        });
    }

    // ─── Focus ke item hasil tertentu ────────────────────────
    function _focusResult(idx) {
        const items = _resultBox.querySelectorAll('.sb-item');
        if (items[idx]) items[idx].focus();
    }

    // ─── Helpers ──────────────────────────────────────────────
    function _showResults() { _resultBox.style.display = 'block'; }
    function _hideResults() { _resultBox.style.display = 'none'; }

    function _clearSearch() {
        _input.value = '';
        _clearBtn.style.display = 'none';
        _hideResults();
        if (_activeMarker) { map.removeLayer(_activeMarker); _activeMarker = null; }
        _input.focus();
    }

    function _escHtml(str) {
        return String(str)
            .replace(/&/g,'&amp;').replace(/</g,'&lt;')
            .replace(/>/g,'&gt;').replace(/"/g,'&quot;');
    }

    function _highlight(text, q) {
        const safe   = _escHtml(text);
        const safeQ  = _escHtml(q).replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
        return safe.replace(new RegExp(`(${safeQ})`, 'gi'), '<mark class="sb-mark">$1</mark>');
    }

})();