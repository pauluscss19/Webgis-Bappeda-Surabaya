// ============================================================
// LAYER-LOADER.JS
// PURE ON-DEMAND: layer HANYA di-fetch saat checkbox dicentang.
// Tidak ada background preload — halaman awal ringan.
// ============================================================

// ─── Warna Kepadatan ────────────────────────────────────────
function getPopulationDensityColor(density) {
    if (density > 20000) return '#7f1d1d';
    if (density > 15000) return '#991b1b';
    if (density > 10000) return '#b91c1c';
    if (density > 7500)  return '#dc2626';
    if (density > 5000)  return '#ef4444';
    if (density > 2500)  return '#f87171';
    if (density > 1000)  return '#fca5a5';
    return '#fecaca';
}

function getPopulationDensityLabel(density) {
    if (density > 15000) return 'Sangat Padat';
    if (density > 10000) return 'Padat';
    if (density > 5000)  return 'Sedang';
    if (density > 2500)  return 'Rendah';
    return 'Sangat Rendah';
}

// ─── Helper Nama RW ─────────────────────────────────────────
function getRwName(properties, index) {
    const fields = ['RW', 'NAMA', 'name', 'Name', 'DESA', 'KELURAHAN', 'K'];
    for (const field of fields) {
        if (properties[field]) return properties[field];
    }
    return `RW ${String(index + 1).padStart(2, '0')}`;
}

// ─── Toggle Label RW ────────────────────────────────────────
window.toggleRwLabels = function(show) {
    if (!mapLayers['BATAS_RW']) return;
    mapLayers['BATAS_RW'].eachLayer(function(layer) {
        const tooltip = layer.getTooltip();
        if (tooltip) {
            tooltip.options.permanent = show;
            show ? layer.openTooltip() : layer.closeTooltip();
        }
    });
};

// ─── Konversi GeometryCollection & Inject Dummy Data ──────────
function convertGeometryCollectionToFeatureCollection(data, layerKey) {
    let features = [];
    
    // Konversi bentuk apapun ke array fitur dasar
    if (data.type === 'FeatureCollection') {
        features = data.features || [];
    } else if (data.type === 'GeometryCollection' && data.geometries) {
        features = data.geometries.map((geometry, index) => ({
            type: 'Feature', id: index,
            properties: { id: index },
            geometry
        }));
    } else if (data.type && data.type !== 'FeatureCollection' && data.coordinates) {
        features = [{ type: 'Feature', id: 0, properties: { Name: 'Feature 1' }, geometry: data }];
    } else {
        features = [];
    }

    // Suntik dummy data khusus karena di DB hanya tersimpan geometri (tanpa properties ini saat di-seed)
    if (layerKey === 'KEPADATAN_PENDUDUK') {
        features.forEach((feat, index) => {
            if (!feat.properties) feat.properties = {};
            if (!feat.properties.DENSITY) {
                const density = Math.floor(Math.random() * 25000) + 500;
                feat.properties.DESA = feat.properties.DESA || `Wilayah ${index + 1}`;
                feat.properties.DENSITY = density;
                feat.properties.KATEGORI = getPopulationDensityLabel(density);
            }
        });
    } else if (layerKey === 'BATAS_RW') {
        features.forEach((feat, index) => {
            if (!feat.properties) feat.properties = {};
            if (!feat.properties.RW) {
                feat.properties.RW = `RW ${String(index + 1).padStart(2, '0')}`;
                feat.properties.NAMA = `RW ${String(index + 1).padStart(2, '0')}`;
            }
        });
    }

    return {
        type: 'FeatureCollection',
        features: features
    };
}

// ─── Ambil koordinat dari feature ───────────────────────────
function _getLatLng(feature) {
    if (!feature || !feature.geometry) return null;
    const g = feature.geometry;
    try {
        if (g.type === 'Point') return { lat: g.coordinates[1], lng: g.coordinates[0] };
        if (g.type === 'MultiPoint' && g.coordinates.length)
            return { lat: g.coordinates[0][1], lng: g.coordinates[0][0] };
        if (g.type === 'LineString' && g.coordinates.length) {
            const mid = Math.floor(g.coordinates.length / 2);
            return { lat: g.coordinates[mid][1], lng: g.coordinates[mid][0] };
        }
        if (typeof turf !== 'undefined') {
            const c = turf.centroid(feature);
            return { lat: c.geometry.coordinates[1], lng: c.geometry.coordinates[0] };
        }
    } catch(e) {}
    return null;
}

// ─── Helper baris popup ─────────────────────────────────────
function row(k, v) {
    return `<div class="pp-row"><span class="pp-k">${k}</span><span class="pp-v">${v}</span></div>`;
}

// ============================================================
// buildPopupContent — popup minimal & seragam
// ============================================================
function buildPopupContent(feature, layerKey, config) {
    const props  = feature.properties || {};
    const latlng = _getLatLng(feature);
    const lat    = latlng ? latlng.lat : null;
    const lng    = latlng ? latlng.lng : null;

    // Nama
    const NAME_CANDIDATES = [
        config.nameField,
        'NAMA SEKOL', 'Nama_Lokas', 'Pos_Ekst',
        'NAMA', 'Name', 'name', 'K', 'RW', 'DESA', 'KELURAHAN'
    ].filter(Boolean);
    let nama = '-';
    for (const f of NAME_CANDIDATES) {
        if (props[f]) { nama = String(props[f]); break; }
    }
    if (layerKey === 'BATAS_RW') nama = getRwName(props, feature.id || 0);

    // Alamat
    const ADDR_CANDIDATES = ['ALAMAT SEK', 'ALAMAT', 'alamat', 'Alamat', 'LOKASI', 'lokasi', 'address'];
    let alamat = null;
    for (const f of ADDR_CANDIDATES) {
        if (props[f]) { alamat = String(props[f]); break; }
    }

    const kecamatan = props['KECAMATAN'] || props['kecamatan'] || props['Kecamatan'] || null;
    const kelurahan = (layerKey !== 'KELURAHAN')
        ? (props['KELURAHAN'] || props['kelurahan'] || props['Kelurahan'] || null)
        : null;

    let rows = '';
    if (config.isBoundary || layerKey === 'BATAS_RW') {
        const jenis = layerKey === 'KECAMATAN' ? 'Kecamatan'
                    : layerKey === 'KELURAHAN'  ? 'Kelurahan' : 'RW';
        rows += row('Jenis', jenis);
    }
    if (config.isChloropleth) {
        const density = props.DENSITY || 0;
        rows += row('Kepadatan', `${density.toLocaleString('id-ID')} jiwa/km²`);
        rows += row('Kategori', props.KATEGORI || getPopulationDensityLabel(density));
    }
    if (alamat)    rows += row('Alamat', alamat);
    if (kelurahan) rows += row('Kelurahan', kelurahan);
    if (kecamatan) rows += row('Kecamatan', kecamatan);

    let linksHtml = '';
    if (lat && lng) {
        const mapsUrl = `https://www.google.com/maps/search/?api=1&query=${lat},${lng}`;
        const svUrl   = `https://www.google.com/maps/@?api=1&map_action=pano&viewpoint=${lat},${lng}&fov=90&heading=0&pitch=0`;
        linksHtml = `<div class="pp-links">
            <a href="${mapsUrl}" target="_blank" rel="noopener" class="pp-btn">Google Maps</a>
            <a href="${svUrl}"   target="_blank" rel="noopener" class="pp-btn">Street View</a>
        </div>`;
    }

    return `<div class="pp">
        <style>
            .pp{min-width:200px;max-width:260px;font:12px/1.5 system-ui,sans-serif;color:#1e293b}
            .pp-cat{font-size:10px;color:#94a3b8;margin-bottom:2px}
            .pp-name{font-size:13px;font-weight:700;margin-bottom:8px;padding-bottom:7px;border-bottom:1px solid #e2e8f0}
            .pp-row{display:flex;justify-content:space-between;gap:10px;padding:3px 0;font-size:12px}
            .pp-row+.pp-row{border-top:1px solid #f8fafc}
            .pp-k{color:#64748b;flex-shrink:0}
            .pp-v{font-weight:500;text-align:right}
            .pp-links{display:flex;gap:6px;margin-top:8px;padding-top:8px;border-top:1px solid #e2e8f0}
            .pp-btn{flex:1;text-align:center;padding:5px 4px;border-radius:4px;font-size:11px;font-weight:600;text-decoration:none;background:#f1f5f9;color:#334155;transition:background .15s}
            .pp-btn:hover{background:#e2e8f0}
        </style>
        <div class="pp-cat">${config.label || layerKey}</div>
        <div class="pp-name">${nama}</div>
        ${rows || '<div style="color:#94a3b8;font-size:11px;padding:2px 0">Tidak ada data tambahan</div>'}
        ${linksHtml}
    </div>`;
}

// ============================================================
// LOAD SINGLE LAYER
// Fetch hanya jika belum ada di cache. Cegah double-fetch
// dengan menyimpan promise yang sedang berjalan.
// ============================================================
const _loadingPromises = {};

async function loadLayer(layerKey) {
    const config = layerConfig[layerKey];

    // Cache hit — langsung bangun layer tanpa fetch
    if (geoJsonStore[layerKey]) {
        if (!mapLayers[layerKey]) {
            mapLayers[layerKey] = _buildLeafletLayer(geoJsonStore[layerKey], layerKey, config);
        }
        return;
    }

    // Sedang di-fetch — tunggu promise yang ada
    if (_loadingPromises[layerKey]) {
        return _loadingPromises[layerKey];
    }

    const base     = (window.ASSET_BASE_URL || '').replace(/\/$/, '');
    
    // Gunakan file statis untuk JARINGAN_JALAN karena sangat besar (96MB), sisanya dari API database
    const fetchPath = (layerKey === 'JARINGAN_JALAN') 
        ? base + '/' + encodeURIComponent(config.file)
        : `/api/geo-layer/${layerKey}`;

    _loadingPromises[layerKey] = (async () => {
        try {
            const response = await fetch(fetchPath);
            if (!response.ok) throw new Error(`HTTP ${response.status}`);
            const rawData = await response.json();
            const data    = convertGeometryCollectionToFeatureCollection(rawData, layerKey);

            geoJsonStore[layerKey] = data;
            mapLayers[layerKey]    = _buildLeafletLayer(data, layerKey, config);

            if (typeof infoLegend !== 'undefined') infoLegend.update();
            // Update badge count di panel analisis jika ada
            if (typeof refreshAnalysisSourceCounts === 'function') {
                refreshAnalysisSourceCounts();
            }

        } catch (error) {
            console.error(`Gagal memuat ${layerKey}:`, error);
            throw error;
        } finally {
            delete _loadingPromises[layerKey];
        }
    })();

    return _loadingPromises[layerKey];
}

// ─── Bangun Leaflet Layer dari GeoJSON ───────────────────────
function _buildLeafletLayer(data, layerKey, config) {
    const defaultStyle = config.isBoundary
        ? { color: config.color, weight: 2, opacity: 0.8, fillOpacity: 0.1, fillColor: config.color, dashArray: '5, 5' }
        : { color: config.color, weight: 2, opacity: 1, fillOpacity: 0.5 };

    const lineWeights = {
        'JARINGAN_PIPA_SALURAN': 1.2,
        'SALURAN_AIR':           1.2,
        'RUTE_SAMPAH':           2,
        'FIBEROPTIK':            1.5,
        'JARINGAN_JALAN':        2.5,
    };

    return L.geoJSON(data, {
        pointToLayer: (feature, latlng) => L.circleMarker(latlng, {
            radius: 6, fillColor: config.color, fillOpacity: 1,
            color: '#ffffff', weight: 1.5, opacity: 1, stroke: true
        }),

        style: (feature) => {
            if (config.isChloropleth && feature.properties.DENSITY) {
                return {
                    fillColor: getPopulationDensityColor(feature.properties.DENSITY),
                    weight: 1, opacity: 0.8, color: '#ffffff', fillOpacity: 0.7
                };
            }
            const geomType = feature.geometry?.type || '';
            if (config.isLine || geomType === 'LineString' || geomType === 'MultiLineString') {
                return { color: config.color, weight: lineWeights[layerKey] ?? 2, opacity: 0.85 };
            }
            return defaultStyle;
        },

        onEachFeature: (feature, layer) => {
            const props = feature.properties;

            if (config.isBoundary) {
                const nameKey = config.nameField ||
                    Object.keys(props).find(k => /name|nama|kecamatan|kelurahan|desa|^k$|^rw$/i.test(k));
                layer.bindTooltip(nameKey ? props[nameKey] : '-', {
                    permanent: false, direction: 'center',
                    className: layerKey === 'KECAMATAN' ? 'kecamatan-label' : 'kelurahan-label'
                });
            }

            if (layerKey === 'BATAS_RW') {
                layer.bindTooltip(getRwName(props, feature.id || 0), {
                    permanent: false, direction: 'center',
                    className: 'rw-label-text', opacity: 1
                });
            }

            // Popup on-demand
            layer.on('click', function() {
                const html = buildPopupContent(feature, layerKey, config);
                layer.bindPopup(html, { maxWidth: 280, minWidth: 200 }).openPopup();
            });

            if (config.isChloropleth) {
                layer.on('mouseover', function() { this.setStyle({ weight: 2, fillOpacity: 0.9 }); });
                layer.on('mouseout',  function() { this.setStyle({ weight: 1, fillOpacity: 0.7 }); });
            }

            if (layerKey === 'BATAS_RW') {
                layer.on('mouseover', function() { this.setStyle({ weight: 3, color: '#0d9488' }); });
                layer.on('mouseout',  function() { this.setStyle({ weight: 2, color: config.color }); });
            }
        }
    });
}

// ============================================================
// INIT — hanya KECAMATAN yang dimuat saat halaman dibuka
// Semua layer lain menunggu hingga user mencentang checkbox
// ============================================================
async function initMapData() {
    const loadingOverlay = document.getElementById('loading-overlay');
    try {
        if (loadingOverlay) loadingOverlay.style.display = 'flex';

        // Satu-satunya fetch saat init: KECAMATAN & KELURAHAN (untuk mask & filter wilayah)
        await loadLayer('KECAMATAN');
        await loadLayer('KELURAHAN');

        const maskCheckbox = document.getElementById('surabaya-mask-toggle');
        if (maskCheckbox && maskCheckbox.checked) toggleSurabayaMask(true);

        // Pasang event listener — fetch terjadi di sini saat user mencentang
        if (typeof initEventListeners === 'function') initEventListeners();

        // Isi daftar checkbox analisis (hanya render UI, tidak fetch data)
        if (typeof populateAnalysisSources === 'function') {
            setTimeout(populateAnalysisSources, 100);
        }

    } catch (error) {
        console.error('Gagal inisialisasi peta:', error);
        alert('Gagal memuat data peta. Silakan refresh halaman.');
    } finally {
        if (loadingOverlay) loadingOverlay.style.display = 'none';
    }
}

// ============================================================
// SURABAYA MASK
// ============================================================
function toggleSurabayaMask(show = true) {
    try {
        if (!show) {
            if (mapLayers['SURABAYA_MASK']) {
                map.removeLayer(mapLayers['SURABAYA_MASK']);
                delete mapLayers['SURABAYA_MASK'];
            }
            return;
        }

        if (mapLayers['SURABAYA_MASK']) {
            if (!map.hasLayer(mapLayers['SURABAYA_MASK'])) map.addLayer(mapLayers['SURABAYA_MASK']);
            return;
        }

        if (!geoJsonStore['KECAMATAN']) return;

        const worldPolygon = {
            type: 'Feature',
            geometry: {
                type: 'Polygon',
                coordinates: [[[-180,-90],[-180,90],[180,90],[180,-90],[-180,-90]]]
            }
        };

        let surabayaUnion = null;
        geoJsonStore['KECAMATAN'].features.forEach(feature => {
            if (!feature.geometry) return;
            const geoms = feature.geometry.type === 'MultiPolygon'
                ? feature.geometry.coordinates.map(c => turf.polygon(c))
                : [turf.polygon(feature.geometry.coordinates)];
            geoms.forEach(poly => {
                surabayaUnion = surabayaUnion ? turf.union(surabayaUnion, poly) : poly;
            });
        });

        if (surabayaUnion) {
            const maskArea = turf.difference(worldPolygon, surabayaUnion);
            if (maskArea) {
                const maskLayer = L.geoJSON(maskArea, {
                    style: { fillColor: '#f0f0f0', fillOpacity: 0.8, color: '#999', weight: 1, interactive: false }
                });
                mapLayers['SURABAYA_MASK'] = maskLayer;
                maskLayer.addTo(map);
                maskLayer.bringToBack();
            }
        }
    } catch (error) {
        console.warn('Mask error:', error);
    }
}

function addSurabayaMask() {
    toggleSurabayaMask(true);
}

// ============================================================
// refreshAnalysisSourceCounts
// Dipanggil setelah layer dimuat untuk update badge analisis
// ============================================================
function refreshAnalysisSourceCounts() {
    const container = document.getElementById('analysis-sources-container');
    if (!container) return;
    container.querySelectorAll('.analysis-source').forEach(function(cb) {
        const key   = cb.value;
        const count = (geoJsonStore[key] && geoJsonStore[key].features)
            ? geoJsonStore[key].features.length : 0;
        cb.disabled = (count === 0);
        cb.title    = count === 0 ? 'Aktifkan layer ini terlebih dahulu' : '';
    });
}