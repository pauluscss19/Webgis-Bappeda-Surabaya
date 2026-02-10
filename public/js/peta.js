// ============================================================
// PETA-MAP.JS - JavaScript untuk Peta Pembangunan Surabaya
// ============================================================

// --- LOGIC UI SIDEBAR ---
const sidebar = document.getElementById('filter-sidebar');
const toggleBtn = document.getElementById('toggle-btn');

function toggleSidebar() {
    sidebar.classList.toggle('hidden');
    if (sidebar.classList.contains('hidden')) {
        toggleBtn.style.display = 'block'; 
    } else {
        toggleBtn.style.display = 'none'; 
    }
}

// --- KONFIGURASI PETA ---
// ========================================
// BOUNDS TERKUNCI KETAT KHUSUS SURABAYA - LEBIH ZOOM IN
// ========================================
const surabayaBounds = [
    [-7.3500, 112.6500],  // Southwest (batas selatan-barat Surabaya)
    [-7.1800, 112.8500]   // Northeast (batas utara-timur Surabaya)
];
const centerPoint = [-7.2575, 112.7400]; // Titik pusat Kota Surabaya

const defaultLayer = L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
    attribution: '&copy; CARTO', subdomains: 'abcd', maxZoom: 20
});
const satelliteLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
    attribution: 'Tiles &copy; Esri', maxZoom: 19
});
const osmLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors', maxZoom: 19
});
const darkLayer = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
    attribution: '&copy; CARTO', subdomains: 'abcd', maxZoom: 20
});
const topoLayer = L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenTopoMap contributors', maxZoom: 17
});
const streetLayer = L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors', maxZoom: 19
});

const map = L.map('map', {
    center: centerPoint, 
    zoom: 12, 
    minZoom: 11,
    maxZoom: 18,
    maxBounds: surabayaBounds, 
    maxBoundsViscosity: 1.0,
    layers: [defaultLayer], 
    zoomControl: false
});

// Tambahkan event listener untuk mencegah zoom/pan keluar bounds
map.on('drag', function() {
    map.panInsideBounds(surabayaBounds, { animate: false });
});

map.on('zoomend', function() {
    if (!surabayaBounds[0] || !surabayaBounds[1]) return;
    
    const bounds = map.getBounds();
    const mapBounds = L.latLngBounds(surabayaBounds[0], surabayaBounds[1]);
    
    if (!mapBounds.contains(bounds)) {
        map.fitBounds(mapBounds);
    }
});

L.control.zoom({ position: 'topright' }).addTo(map);

// Fullscreen Button - DIPINDAH KE DALAM MAP DI BAWAH LAYER CONTROL
const fullscreenControl = L.control({ position: 'topright' });
fullscreenControl.onAdd = function(map) {
    const div = L.DomUtil.create('div', 'leaflet-bar leaflet-control');
    div.innerHTML = '<button id="fullscreen-btn" onclick="toggleFullscreen()" title="Toggle Fullscreen" style="background: white; color: #334155; border: none; border-radius: 4px; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 16px;"><i class="bi bi-arrows-fullscreen" id="fullscreen-icon"></i></button>';
    
    // Prevent click propagation
    L.DomEvent.disableClickPropagation(div);
    return div;
};
fullscreenControl.addTo(map);

L.control.layers({ 
    "Peta Default": defaultLayer, 
    "Satelit": satelliteLayer,
    "OpenStreetMap": osmLayer,
    "Dark Mode": darkLayer,
    "Topografi": topoLayer,
    "Humanitarian": streetLayer
}, null, { position: 'topright' }).addTo(map);

// --- KONFIGURASI DATA ---
const geoJsonStore = {};
const layerConfig = {
    'CCTV_EKSISTING': { file: 'CCTV_EKSISTING.geojson', color: '#B153D7', label: 'CCTV Eksisting' },
    'TITIK_SAMPAH': { 
        file: 'TITIK_SAMPAH.geojson', 
        color: '#facc15', 
        label: 'Titik Sampah'
    },
    'CCTV_RENCANA': { file: 'CCTV_RENCANA.geojson', color: '#f97316', label: 'CCTV Rencana' },
    'TITIK_SAMPAH_RENCANA': { file: 'TITIK_SAMPAH_RENCANA.geojson', color: '#22c55e', label: 'Sampah Rencana' },
    'DAMKAR': { file: 'Damkar.geojson', color: '#FF0000', label: 'Pos Damkar', nameField: 'Pos_Ekst' },
    'MAKAM': { file: 'MAKAM.geojson', color: '#3b82f6', label: 'Makam', nameField: 'Nama_Lokas', isPolygon: true },
    'PAUD': { file: 'paud.geojson', color: '#ec4899', label: 'PAUD/TK', nameField: 'NAMA SEKOL', locationField: 'ALAMAT SEK' },
    'SD_MI': { file: 'sd-mi.geojson', color: '#8b5cf6', label: 'SD/MI', nameField: 'NAMA SEKOL', locationField: 'ALAMAT SEK' },
    'SMP_MTS': { file: 'smp-mts.geojson', color: '#06b6d4', label: 'SMP/MTS', nameField: 'NAMA SEKOL', locationField: 'ALAMAT SEK' },
    'KECAMATAN': { file: 'Kecamatan.geojson', color: '#6366f1', label: 'Batas Kecamatan', nameField: 'Name', isPolygon: true, isBoundary: true },
    'KELURAHAN': { file: 'kelurahan.geojson', color: '#f59e0b', label: 'Batas Kelurahan', nameField: 'K', isPolygon: true, isBoundary: true }
};

const mapLayers = {};

// --- LEGEND STATISTIK ---
const infoLegend = L.control({ position: 'bottomleft' });
infoLegend.onAdd = function (map) {
    this._div = L.DomUtil.create('div', 'info-legend');
    this.update();
    return this._div;
};
infoLegend.update = function () {
    let html = '<h4>Statistik Data</h4>';
    let hasActiveLayer = false;
    Object.keys(layerConfig).forEach(key => {
        const config = layerConfig[key];
        const layer = mapLayers[key];
        
        // Skip boundary layers dari statistik
        if (config.isBoundary) return;
        
        if (layer && map.hasLayer(layer)) {
            hasActiveLayer = true;
            const count = layer.getLayers().length;
            html += `
                <div class="legend-item">
                    <div style="display:flex; align-items:center;">
                        <span class="layer-color" style="background:${config.color}; width:10px; height:10px; margin-right:5px;"></span>
                        ${config.label}
                    </div>
                    <span><b>${count}</b></span>
                </div>`;
        }
    });
    
    if (mapLayers['ANALYSIS_RESULT']) {
        html += `<div style="margin-top:5px; border-top:1px solid #eee; padding-top:5px;"><strong>Hasil Analisis:</strong></div>`;
        html += `<div class="legend-item"><div style="display:flex;align-items:center;"><span style="display:inline-block; width:12px; height:12px; background:#ef4444; border:2px solid white; border-radius:50%; margin-right:5px; box-shadow:0 0 4px black;"></span>Rekomendasi</div></div>`;
    }
    
    if (!hasActiveLayer && !mapLayers['ANALYSIS_RESULT']) html += '<div style="color:#777; font-size:11px;">Tidak ada layer aktif</div>';
    this._div.innerHTML = html;
};
infoLegend.addTo(map);

// --- LOAD DATA ---
async function loadLayer(layerKey) {
    const config = layerConfig[layerKey];
    const filePath = window.ASSET_BASE_URL + config.file; 

    try {
        const response = await fetch(filePath);
        if (!response.ok) throw new Error(`Status: ${response.status}`);
        const data = await response.json();

        geoJsonStore[layerKey] = data;

        // Style khusus untuk batas wilayah
        const defaultStyle = config.isBoundary ? {
            color: config.color,
            weight: 2,
            opacity: 0.8,
            fillOpacity: 0.1,
            fillColor: config.color,
            dashArray: '5, 5'
        } : {
            color: config.color,
            weight: 2,
            opacity: 1,
            fillOpacity: 0.5
        };

        const layer = L.geoJSON(data, {
            pointToLayer: (feature, latlng) => {
                return L.circleMarker(latlng, {
                    radius: 6, fillColor: config.color, fillOpacity: 1.0, stroke: false
                });
            },
            style: (feature) => defaultStyle,
            
            onEachFeature: (feature, layer) => {
                const props = feature.properties; 
                
                const nameKey = config.nameField || Object.keys(props).find(k => /name|nama|pos|kecamatan|kelurahan|^k$/i.test(k)) || 'Name';
                const nameVal = props[nameKey] || props.K || props.KELURAHAN || props.Name || '-';

                // Untuk layer kecamatan dan kelurahan, tampilkan informasi khusus
                if (config.isBoundary) {
                    const wilayahType = layerKey === 'KECAMATAN' ? 'Kecamatan' : 'Kelurahan';
                    const popupContent = `
                        <div style="min-width:200px; font-family:sans-serif;">
                            <h5 style="margin:0 0 10px 0; color:${config.color}; font-weight:bold; border-bottom:1px solid #e2e8f0; padding-bottom:8px;">
                                ${wilayahType}
                            </h5>
                            <div style="background:#f8fafc; padding:12px; border-radius:8px; font-size:13px; border:1px solid #e2e8f0;">
                                <div style="font-weight:700; font-size:16px; margin-bottom:8px; color:#1e293b;">
                                    ${nameVal}
                                </div>
                                <div style="font-size:11px; color:#64748b;">
                                    Kota Surabaya
                                </div>
                            </div>
                        </div>`;
                    layer.bindPopup(popupContent);
                    
                    // Tambahkan tooltip untuk nama
                    layer.bindTooltip(nameVal, {
                        permanent: false,
                        direction: 'center',
                        className: layerKey === 'KECAMATAN' ? 'kecamatan-label' : 'kelurahan-label',
                        sticky: false
                    });
                    
                    return;
                }

                // Untuk layer pendidikan dan layer lainnya
                let lokasiVal = null;
                if (config.locationField && props[config.locationField]) {
                    lokasiVal = props[config.locationField];
                } else {
                    const locationKey = Object.keys(props).find(k => /jalan|alamat|lokasi|alamat sek/i.test(k));
                    if (locationKey) lokasiVal = props[locationKey];
                }

                // Cari kecamatan dari berbagai field
                let kecVal = null;
                if (props.KECAMATAN) {
                    kecVal = props.KECAMATAN;
                } else {
                    const kecKey = Object.keys(props).find(k => /kecamatan|kec/i.test(k));
                    if (kecKey) kecVal = props[kecKey];
                }

                // Cari kelurahan
                let kelVal = null;
                if (props.KELURAHAN) {
                    kelVal = props.KELURAHAN;
                } else {
                    const kelKey = Object.keys(props).find(k => /kelurahan|kel/i.test(k));
                    if (kelKey) kelVal = props[kelKey];
                }

                let detailHtml = '';

                if (lokasiVal) {
                    detailHtml += `
                    <div style="display:flex; align-items:start; margin-bottom:6px; color:#334155;">
                        <i class="bi bi-geo-alt-fill" style="font-size:14px; margin-right:8px; color:#ef4444; width:15px; margin-top:2px;"></i>
                        <span style="line-height:1.4;">${lokasiVal}</span>
                    </div>`;
                }

                if (kelVal) {
                    detailHtml += `
                    <div style="display:flex; align-items:start; margin-bottom:6px; color:#334155;">
                        <i class="bi bi-building" style="font-size:14px; margin-right:8px; color:#f59e0b; width:15px; margin-top:2px;"></i>
                        <span>Kel. ${kelVal}</span>
                    </div>`;
                }

                if (kecVal) {
                    detailHtml += `
                    <div style="display:flex; align-items:start; margin-bottom:6px; color:#334155;">
                        <i class="bi bi-map-fill" style="font-size:14px; margin-right:8px; color:#3b82f6; width:15px; margin-top:2px;"></i>
                        <span>Kec. ${kecVal}</span>
                    </div>`;
                }
                
                // Info tambahan untuk sekolah
                if (props.JENJANG) {
                    detailHtml += `
                    <div style="display:flex; align-items:start; margin-bottom:6px; color:#64748b;">
                        <i class="bi bi-mortarboard-fill" style="font-size:14px; margin-right:8px; width:15px; margin-top:2px;"></i>
                        <span>${props.JENJANG}${props.STATUS ? ' - ' + (props.STATUS === 'N' ? 'Negeri' : 'Swasta') : ''}</span>
                    </div>`;
                }
                
                if (props.Jenis || props.Keterangan) {
                    detailHtml += `
                    <div style="display:flex; align-items:start; margin-bottom:6px; color:#64748b;">
                        <i class="bi bi-tag-fill" style="font-size:14px; margin-right:8px; width:15px; margin-top:2px;"></i>
                        <span>${props.Jenis || props.Keterangan}</span>
                    </div>`;
                }

                let popupContent = `
                    <div style="min-width:230px; font-family:sans-serif;">
                        <h5 style="margin:0 0 10px 0; color:${config.color}; font-weight:bold; border-bottom:1px solid #e2e8f0; padding-bottom:8px;">
                            ${config.label}
                        </h5>
                        <div style="background:#f8fafc; padding:12px; border-radius:8px; font-size:13px; border:1px solid #e2e8f0;">
                            <div style="font-weight:700; font-size:14px; margin-bottom:10px; color:#1e293b; line-height:1.4;">
                                ${nameVal}
                            </div>
                            ${detailHtml}
                        </div>
                    </div>`;
                
                layer.bindPopup(popupContent);
            }
        });

        mapLayers[layerKey] = layer;
        
        const checkbox = document.querySelector(`input[data-layer="${layerKey}"]`);
        if (checkbox && checkbox.checked) map.addLayer(layer);
        infoLegend.update();

    } catch (error) {
        console.error(`Gagal: ${config.file}`, error);
    }
}

async function initMapData() {
    const loadingOverlay = document.getElementById('loading-overlay');
    if(loadingOverlay) loadingOverlay.style.display = 'flex';
    
    const promises = Object.keys(layerConfig).map(key => loadLayer(key));
    await Promise.all(promises);
    
    // Tambahkan mask layer Surabaya jika data kecamatan sudah dimuat
    if (geoJsonStore['KECAMATAN']) {
        addSurabayaMask();
    }
    
    if(loadingOverlay) loadingOverlay.style.display = 'none';
}

// Fungsi untuk menambahkan mask - hanya menampilkan area Surabaya
function addSurabayaMask() {
    try {
        // Ambil semua polygon kecamatan dan gabungkan menjadi satu
        const kecamatanFeatures = geoJsonStore['KECAMATAN'].features;
        
        // Buat polygon besar yang mencakup seluruh dunia
        const worldPolygon = {
            type: 'Feature',
            geometry: {
                type: 'Polygon',
                coordinates: [[
                    [-180, -90],
                    [-180, 90],
                    [180, 90],
                    [180, -90],
                    [-180, -90]
                ]]
            }
        };

        // Gabungkan semua polygon kecamatan
        let surabayaUnion = null;
        kecamatanFeatures.forEach(feature => {
            if (feature.geometry && feature.geometry.type === 'MultiPolygon') {
                // Konversi MultiPolygon ke Polygon array
                feature.geometry.coordinates.forEach(polyCoords => {
                    const poly = turf.polygon(polyCoords);
                    surabayaUnion = surabayaUnion ? turf.union(surabayaUnion, poly) : poly;
                });
            } else if (feature.geometry && feature.geometry.type === 'Polygon') {
                const poly = turf.polygon(feature.geometry.coordinates);
                surabayaUnion = surabayaUnion ? turf.union(surabayaUnion, poly) : poly;
            }
        });

        if (surabayaUnion) {
            // Buat difference: world - surabaya = area di luar surabaya
            const maskArea = turf.difference(worldPolygon, surabayaUnion);
            
            if (maskArea) {
                // Tambahkan mask layer dengan opacity tinggi
                const maskLayer = L.geoJSON(maskArea, {
                    style: {
                        fillColor: '#f0f0f0',
                        fillOpacity: 0.8,
                        color: '#999',
                        weight: 1,
                        interactive: false
                    },
                    pane: 'overlayPane'
                }).addTo(map);

                // Simpan reference untuk kontrol
                mapLayers['SURABAYA_MASK'] = maskLayer;
            }
        }
    } catch (error) {
        console.warn('Tidak dapat membuat mask Surabaya:', error);
    }
}

// Event listener untuk toggle layer
document.querySelectorAll('.layer-toggle').forEach(checkbox => {
    checkbox.addEventListener('change', (e) => {
        const layerKey = e.target.dataset.layer;
        if (mapLayers[layerKey]) {
            if (e.target.checked) {
                map.addLayer(mapLayers[layerKey]);
                
                // Atur urutan z-index
                if (layerConfig[layerKey].isBoundary) {
                    // Boundary di belakang
                    mapLayers[layerKey].bringToBack();
                    
                    // Pastikan heatmap di bawah boundary jika ada
                    if (mapLayers['HEATMAP_LAYER'] && map.hasLayer(mapLayers['HEATMAP_LAYER'])) {
                        mapLayers['HEATMAP_LAYER'].bringToBack();
                    }
                } else {
                    // Layer data (titik-titik) di depan
                    mapLayers[layerKey].bringToFront();
                }
            } else {
                map.removeLayer(mapLayers[layerKey]);
            }
            infoLegend.update();
        }
    });
});

// Event listener untuk toggle label nama kecamatan/kelurahan
document.querySelectorAll('.layer-label-toggle').forEach(checkbox => {
    checkbox.addEventListener('change', (e) => {
        const layerKey = e.target.dataset.layer;
        if (mapLayers[layerKey]) {
            // CEK: Jika layer belum ada di peta, tambahkan terlebih dahulu
            if (e.target.checked && !map.hasLayer(mapLayers[layerKey])) {
                map.addLayer(mapLayers[layerKey]);
                if (layerConfig[layerKey].isBoundary) {
                    mapLayers[layerKey].bringToBack();
                }
            }
            
            // Update style polygon berdasarkan status toggle batas dan nama
            const boundaryCheckbox = document.querySelector(`input.layer-toggle[data-layer="${layerKey}"]`);
            const config = layerConfig[layerKey];
            
            // Hanya update style jika layer adalah boundary
            if (config.isBoundary) {
                mapLayers[layerKey].setStyle((feature) => {
                    // Jika toggle batas aktif: tampilkan batas
                    if (boundaryCheckbox && boundaryCheckbox.checked) {
                        return {
                            color: config.color,
                            weight: 2,
                            opacity: 0.8,
                            fillOpacity: 0.1,
                            fillColor: config.color,
                            dashArray: '5, 5'
                        };
                    }
                    // Jika hanya toggle nama aktif: sembunyikan batas polygon
                    else if (e.target.checked) {
                        return {
                            color: config.color,
                            weight: 0,
                            opacity: 0,
                            fillOpacity: 0,
                            fillColor: 'transparent'
                        };
                    }
                    // Default
                    return {
                        color: config.color,
                        weight: 2,
                        opacity: 0.8,
                        fillOpacity: 0.1,
                        fillColor: config.color,
                        dashArray: '5, 5'
                    };
                });
            }
            
            // Update tooltip untuk semua feature dalam layer
            mapLayers[layerKey].eachLayer(function(layer) {
                if (layer.getTooltip()) {
                    const tooltip = layer.getTooltip();
                    if (e.target.checked) {
                        // Set permanent dan buka tooltip
                        tooltip.options.permanent = true;
                        tooltip.options.sticky = false;
                        layer.unbindTooltip();
                        layer.bindTooltip(tooltip.getContent(), {
                            permanent: true,
                            direction: 'center',
                            className: layerKey === 'KECAMATAN' ? 'kecamatan-label' : 'kelurahan-label',
                            sticky: false
                        });
                        layer.openTooltip();
                    } else {
                        // Set tidak permanent dan tutup tooltip
                        tooltip.options.permanent = false;
                        layer.closeTooltip();
                        layer.unbindTooltip();
                        layer.bindTooltip(tooltip.getContent(), {
                            permanent: false,
                            direction: 'center',
                            className: layerKey === 'KECAMATAN' ? 'kecamatan-label' : 'kelurahan-label',
                            sticky: false
                        });
                    }
                }
            });
            
            // Jika toggle label dimatikan, cek apakah toggle batas juga mati
            // Jika iya, hapus layer dari peta
            if (!e.target.checked && boundaryCheckbox && !boundaryCheckbox.checked) {
                map.removeLayer(mapLayers[layerKey]);
            }
        }
    });
});

function resetMap() {
    // Reset ke center point Surabaya dengan zoom 12
    map.setView(centerPoint, 12);
    
    if (mapLayers['ANALYSIS_RESULT']) {
        map.removeLayer(mapLayers['ANALYSIS_RESULT']);
        delete mapLayers['ANALYSIS_RESULT'];
    }
    
    if (mapLayers['CLUSTER_BOUNDARIES']) {
        map.removeLayer(mapLayers['CLUSTER_BOUNDARIES']);
        delete mapLayers['CLUSTER_BOUNDARIES'];
    }
    
    // Hapus heatmap layer jika ada
    if (mapLayers['HEATMAP_LAYER']) {
        map.removeLayer(mapLayers['HEATMAP_LAYER']);
        delete mapLayers['HEATMAP_LAYER'];
    }
    
    // Sembunyikan legend heatmap
    const heatmapLegend = document.getElementById('heatmap-legend');
    if (heatmapLegend) {
        heatmapLegend.style.display = 'none';
    }
    
    document.querySelectorAll('.layer-toggle').forEach(cb => {
        cb.checked = false; 
        const key = cb.dataset.layer;
        if (mapLayers[key] && map.hasLayer(mapLayers[key])) map.removeLayer(mapLayers[key]);
    });
    
    // Reset label toggle untuk nama kecamatan
    document.querySelectorAll('.layer-label-toggle').forEach(cb => {
        cb.checked = false;
        const key = cb.dataset.layer;
        if (mapLayers[key]) {
            mapLayers[key].eachLayer(function(layer) {
                if (layer.getTooltip()) {
                    layer.closeTooltip();
                    const tooltip = layer.getTooltip();
                    tooltip.options.permanent = false;
                    layer.unbindTooltip();
                    layer.bindTooltip(tooltip.getContent(), {
                        permanent: false,
                        direction: 'center',
                        className: 'kecamatan-label',
                        sticky: false
                    });
                }
            });
        }
    });
    
    document.querySelectorAll('.analysis-source').forEach(cb => cb.checked = false);
    document.getElementById('analysis-result').style.display = 'none';
    document.getElementById('analysis-result').innerHTML = '';
    
    if (!map.hasLayer(defaultLayer)) {
        map.addLayer(defaultLayer); map.removeLayer(satelliteLayer);
    }
    infoLegend.update();
}

// ============================================================
// FITUR ANALISIS KLUSTERING DENGAN RANKING & SCORING
// ============================================================
function runClustering() {
    const statusDiv = document.getElementById('analysis-result');
    const k = parseInt(document.getElementById('cluster-count').value) || 3;
    
    const selectedCheckboxes = document.querySelectorAll('.analysis-source:checked');
    if (selectedCheckboxes.length === 0) {
        alert("Pilih minimal satu sumber data untuk dianalisis.");
        return;
    }

    statusDiv.style.display = 'block';
    statusDiv.innerHTML = '<i class="bi bi-hourglass-split"></i> Menggabungkan data & menghitung...';

    if (mapLayers['ANALYSIS_RESULT']) {
        map.removeLayer(mapLayers['ANALYSIS_RESULT']);
        delete mapLayers['ANALYSIS_RESULT'];
    }
    
    if (mapLayers['CLUSTER_BOUNDARIES']) {
        map.removeLayer(mapLayers['CLUSTER_BOUNDARIES']);
        delete mapLayers['CLUSTER_BOUNDARIES'];
    }

    setTimeout(() => {
        try {
            let allFeatures = [];
            
            selectedCheckboxes.forEach(cb => {
                const key = cb.value;
                if (geoJsonStore[key] && geoJsonStore[key].features) {
                    const pointFeatures = geoJsonStore[key].features.filter(f => 
                        f.geometry.type === 'Point'
                    );
                    allFeatures = allFeatures.concat(pointFeatures);
                }
            });

            if (allFeatures.length === 0) {
                throw new Error("Data sumber kosong atau belum dimuat.");
            }

            const combinedPoints = turf.featureCollection(allFeatures);
            const clustered = turf.clustersKmeans(combinedPoints, { numberOfClusters: k });

            const clusterGroups = {};
            turf.featureEach(clustered, (feature) => {
                const clusterId = feature.properties.cluster;
                if (!clusterGroups[clusterId]) clusterGroups[clusterId] = [];
                clusterGroups[clusterId].push(feature);
            });

            // Hitung score untuk setiap cluster
            const clusterScores = [];
            Object.keys(clusterGroups).forEach(clusterId => {
                const clusterFeatures = turf.featureCollection(clusterGroups[clusterId]);
                const center = turf.center(clusterFeatures);
                const points = clusterGroups[clusterId];
                
                // Hitung berbagai metrik
                const pointCount = points.length;
                
                // Hitung jarak rata-rata ke pusat
                let totalDistance = 0;
                points.forEach(point => {
                    const distance = turf.distance(center, point, { units: 'kilometers' });
                    totalDistance += distance;
                });
                const avgDistance = totalDistance / pointCount;
                
                // Hitung area coverage (convex hull)
                const hull = turf.convex(clusterFeatures);
                const area = hull ? turf.area(hull) / 1000000 : 0; // km²
                
                // Hitung density (titik per km²)
                const density = area > 0 ? pointCount / area : pointCount;
                
                // Hitung skor total (weighted scoring)
                const maxPoints = Math.max(...Object.keys(clusterGroups).map(id => clusterGroups[id].length));
                const maxDensity = Math.max(...Object.keys(clusterGroups).map(id => {
                    const cf = turf.featureCollection(clusterGroups[id]);
                    const h = turf.convex(cf);
                    const a = h ? turf.area(h) / 1000000 : 0;
                    return a > 0 ? clusterGroups[id].length / a : clusterGroups[id].length;
                }));
                
                const pointScore = (pointCount / maxPoints) * 40;
                const distanceScore = (1 / (1 + avgDistance)) * 30;
                const densityScore = (density / maxDensity) * 30;
                
                const totalScore = pointScore + distanceScore + densityScore;
                
                clusterScores.push({
                    clusterId: clusterId,
                    center: center,
                    points: points,
                    pointCount: pointCount,
                    avgDistance: avgDistance,
                    area: area,
                    density: density,
                    score: totalScore,
                    hull: hull
                });
            });

            // Urutkan berdasarkan score (tertinggi ke terendah)
            clusterScores.sort((a, b) => b.score - a.score);

            const recommendations = L.featureGroup();
            const boundaries = L.featureGroup();

            clusterScores.forEach((cluster, index) => {
                const rank = index + 1;
                const coord = cluster.center.geometry.coordinates;
                
                // Tentukan badge ranking dengan ikon
                let rankBadgeClass = 'rank-other';
                let rankIcon = `<i class="bi bi-hash"></i> ${rank}`;
                let rankLabel = '';
                
                if (rank === 1) {
                    rankBadgeClass = 'rank-1';
                    rankIcon = '<i class="bi bi-trophy-fill"></i>';
                    rankLabel = 'Ranking 1';
                } else if (rank === 2) {
                    rankBadgeClass = 'rank-2';
                    rankIcon = '<i class="bi bi-award-fill"></i>';
                    rankLabel = 'Ranking 2';
                } else if (rank === 3) {
                    rankBadgeClass = 'rank-3';
                    rankIcon = '<i class="bi bi-star-fill"></i>';
                    rankLabel = 'Ranking 3';
                } else {
                    rankLabel = `Ranking ${rank}`;
                }

                // Popup dengan ranking, penjelasan singkat, dan scoring
                const popupContent = `
                    <div style="min-width: 240px; font-family: sans-serif;">
                        <div style="text-align: center; margin-bottom: 12px;">
                            <span class="${rankBadgeClass} rank-badge">
                                ${rankIcon} ${rankLabel}
                            </span>
                        </div>
                        
                        <div style="border:1px solid #e2e8f0; padding:10px; border-radius:6px; margin-bottom:10px;">
                            <div style="font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px;">
                                Skor Kelayakan
                            </div>
                            <div style="font-size:16px; font-weight:700; color:#1e293b; text-align:center; margin-bottom:4px;">
                                ${cluster.score.toFixed(1)} / 100
                            </div>
                            <div class="score-bar">
                                <div class="score-fill" style="width: ${cluster.score}%;"></div>
                            </div>
                        </div>

                        <div style="border:1px solid #e2e8f0; padding:10px; border-radius:6px; margin-bottom:10px;">
                            <div style="font-size:11px; font-weight:600; color:#64748b; margin-bottom:8px;">
                                Data Analisis
                            </div>
                            
                            <div class="metric-item">
                                <span class="metric-label">Jumlah Objek</span>
                                <span class="metric-value">${cluster.pointCount} titik</span>
                            </div>
                            
                            <div class="metric-item">
                                <span class="metric-label">Jarak Rata-rata</span>
                                <span class="metric-value">${cluster.avgDistance.toFixed(2)} km</span>
                            </div>
                            
                            <div class="metric-item">
                                <span class="metric-label">Cakupan Area</span>
                                <span class="metric-value">${cluster.area.toFixed(3)} km²</span>
                            </div>
                            
                            <div class="metric-item">
                                <span class="metric-label">Kepadatan</span>
                                <span class="metric-value">${cluster.density.toFixed(1)} titik/km²</span>
                            </div>
                        </div>

                        <div style="background:#f8fafc; padding:8px; border-radius:4px; margin-bottom:10px;">
                            <div style="font-size:11px; color:#475569; line-height:1.4;">
                                ${rank === 1 ? 'Prioritas utama dengan skor tertinggi.' : 
                                  rank === 2 ? 'Prioritas kedua dengan potensi strategis baik.' :
                                  rank === 3 ? 'Alternatif ketiga yang layak dipertimbangkan.' :
                                  'Potensi lebih rendah dari alternatif lain.'}
                            </div>
                        </div>

                        <a href="http://maps.google.com/maps?q=${coord[1]},${coord[0]}" target="_blank" 
                           style="display:block; text-align:center; background:#334155; color:white; padding:8px; 
                                  border-radius:4px; text-decoration:none; font-weight:600; font-size:12px;">
                           Buka di Google Maps
                        </a>
                    </div>
                `;

                // Marker dengan label ranking
                const markerSize = rank === 1 ? 16 : rank === 2 ? 14 : 12;
                const markerColor = rank === 1 ? '#ffd700' : rank === 2 ? '#c0c0c0' : rank === 3 ? '#cd7f32' : '#ef4444';
                
                const marker = L.circleMarker([coord[1], coord[0]], {
                    radius: markerSize, 
                    fillColor: markerColor,
                    color: '#fff', 
                    weight: 3, 
                    fillOpacity: 0.95
                }).bindPopup(popupContent, { maxWidth: 320 });
                
                marker.addTo(recommendations);

                // Convex hull untuk area cluster - langsung ditampilkan semua
                if(cluster.hull) {
                    L.geoJSON(cluster.hull, {
                        style: { 
                            color: markerColor,
                            weight: 2, 
                            dashArray: '5, 5', 
                            fillOpacity: 0.15,
                            fillColor: markerColor
                        }
                    }).addTo(boundaries);
                }
            });

            mapLayers['ANALYSIS_RESULT'] = recommendations;
            mapLayers['CLUSTER_BOUNDARIES'] = boundaries;
            
            map.addLayer(boundaries);
            boundaries.bringToBack();
            map.addLayer(recommendations);
            map.fitBounds(recommendations.getBounds(), { padding: [50, 50] });

            statusDiv.innerHTML = `<i class="bi bi-check-circle-fill" style="color:#10b981;"></i> Selesai! ${k} titik rekomendasi dengan ranking.`;
            infoLegend.update();

        } catch (error) {
            console.error(error);
            statusDiv.innerHTML = `<span style="color:#ef4444;"><i class="bi bi-x-circle-fill"></i> Gagal: ${error.message}</span>`;
        }
    }, 100);
}

// ============================================================
// FITUR ANALISIS HEATMAP CHOROPLETH
// ============================================================
function runHeatmapAnalysis() {
    const statusDiv = document.getElementById('analysis-result');
    const selectedCheckboxes = document.querySelectorAll('.analysis-source:checked');
    
    if (selectedCheckboxes.length === 0) {
        alert("Pilih minimal satu sumber data untuk dianalisis.");
        return;
    }

    statusDiv.style.display = 'block';
    statusDiv.innerHTML = '<i class="bi bi-hourglass-split"></i> Menghitung intensitas per kelurahan...';

    // Hapus heatmap layer sebelumnya jika ada
    if (mapLayers['HEATMAP_LAYER']) {
        map.removeLayer(mapLayers['HEATMAP_LAYER']);
        delete mapLayers['HEATMAP_LAYER'];
    }

    // Hapus juga cluster jika ada
    if (mapLayers['ANALYSIS_RESULT']) {
        map.removeLayer(mapLayers['ANALYSIS_RESULT']);
        delete mapLayers['ANALYSIS_RESULT'];
    }
    
    if (mapLayers['CLUSTER_BOUNDARIES']) {
        map.removeLayer(mapLayers['CLUSTER_BOUNDARIES']);
        delete mapLayers['CLUSTER_BOUNDARIES'];
    }

    setTimeout(() => {
        try {
            // Kumpulkan semua titik dari sumber yang dipilih
            let allPoints = [];
            
            selectedCheckboxes.forEach(cb => {
                const key = cb.value;
                if (geoJsonStore[key] && geoJsonStore[key].features) {
                    const pointFeatures = geoJsonStore[key].features.filter(f => 
                        f.geometry && f.geometry.type === 'Point'
                    );
                    allPoints = allPoints.concat(pointFeatures);
                }
            });

            if (allPoints.length === 0) {
                throw new Error("Data sumber kosong atau belum dimuat.");
            }

            // Pastikan data kelurahan tersedia
            if (!geoJsonStore['KELURAHAN'] || !geoJsonStore['KELURAHAN'].features) {
                throw new Error("Data kelurahan belum dimuat. Silakan muat data kelurahan terlebih dahulu.");
            }

            // Hitung jumlah titik di setiap kelurahan
            const kelurahanData = geoJsonStore['KELURAHAN'].features.map(kelFeature => {
                let pointCount = 0;
                
                // Untuk setiap polygon di kelurahan (bisa MultiPolygon)
                try {
                    // Validasi geometry
                    if (!kelFeature.geometry || !kelFeature.geometry.coordinates) {
                        console.warn("Invalid kelurahan geometry:", kelFeature.properties);
                        return {
                            feature: kelFeature,
                            count: 0,
                            name: kelFeature.properties.K || kelFeature.properties.KELURAHAN || kelFeature.properties.DESA || kelFeature.properties.name || 'Tidak Diketahui'
                        };
                    }

                    // Validasi koordinat polygon - minimal 4 posisi (ring harus close)
                    const coords = kelFeature.geometry.coordinates;
                    let isValid = false;

                    // Fungsi untuk validasi ring
                    const isValidRing = (ring) => {
                        return Array.isArray(ring) && ring.length >= 4;
                    };

                    if (kelFeature.geometry.type === 'Polygon') {
                        // Polygon: harus punya minimal 1 ring dengan >= 4 koordinat
                        isValid = coords.length > 0 && isValidRing(coords[0]);
                    } else if (kelFeature.geometry.type === 'MultiPolygon') {
                        // MultiPolygon: harus punya minimal 1 polygon dengan 1 ring >= 4 koordinat
                        isValid = coords.length > 0 && 
                                 coords[0].length > 0 && 
                                 isValidRing(coords[0][0]);
                    }

                    if (!isValid) {
                        console.warn("Invalid polygon coordinates (< 4 positions):", kelFeature.properties);
                        return {
                            feature: kelFeature,
                            count: 0,
                            name: kelFeature.properties.K || kelFeature.properties.KELURAHAN || kelFeature.properties.DESA || kelFeature.properties.name || 'Tidak Diketahui'
                        };
                    }

                    // Validasi lebih dalam - pastikan semua ring valid
                    let allRingsValid = true;
                    if (kelFeature.geometry.type === 'Polygon') {
                        allRingsValid = coords.every(ring => isValidRing(ring));
                    } else if (kelFeature.geometry.type === 'MultiPolygon') {
                        allRingsValid = coords.every(polygon => 
                            polygon.every(ring => isValidRing(ring))
                        );
                    }

                    if (!allRingsValid) {
                        console.warn("Some rings invalid in polygon:", kelFeature.properties);
                        return {
                            feature: kelFeature,
                            count: 0,
                            name: kelFeature.properties.K || kelFeature.properties.KELURAHAN || kelFeature.properties.DESA || kelFeature.properties.name || 'Tidak Diketahui'
                        };
                    }

                    // Buat polygon atau multipolygon sesuai tipe geometry
                    let kelPoly;
                    if (kelFeature.geometry.type === 'Polygon') {
                        kelPoly = turf.polygon(coords);
                    } else if (kelFeature.geometry.type === 'MultiPolygon') {
                        kelPoly = turf.multiPolygon(coords);
                    } else {
                        throw new Error('Unsupported geometry type: ' + kelFeature.geometry.type);
                    }
                    
                    // Hitung berapa banyak titik yang ada di dalam polygon kelurahan ini
                    allPoints.forEach(point => {
                        try {
                            if (turf.booleanPointInPolygon(point, kelPoly)) {
                                pointCount++;
                            }
                        } catch (e) {
                            // Abaikan error untuk titik yang tidak valid
                        }
                    });
                } catch (e) {
                    console.warn("Error processing kelurahan polygon:", e, kelFeature.properties);
                }
                
                return {
                    feature: kelFeature,
                    count: pointCount,
                    name: kelFeature.properties.K || kelFeature.properties.KELURAHAN || kelFeature.properties.DESA || kelFeature.properties.name || 'Tidak Diketahui'
                };
            });

            // Temukan nilai min dan max untuk normalisasi
            const counts = kelurahanData.map(d => d.count);
            const minCount = Math.min(...counts);
            const maxCount = Math.max(...counts);

            // Fungsi untuk menghasilkan warna berdasarkan nilai
            // Nilai tinggi = merah tua (#800000)
            // Nilai rendah = merah muda/pink muda (#ffe0e0)
            function getColor(count) {
                if (maxCount === minCount) {
                    return '#ff6666'; // Warna default jika semua sama
                }
                
                // Normalisasi nilai antara 0 dan 1
                const normalized = (count - minCount) / (maxCount - minCount);
                
                // Gradasi dari pink muda ke merah tua
                // Pink muda: rgb(255, 224, 224) = #ffe0e0
                // Merah tua: rgb(128, 0, 0) = #800000
                
                const r = Math.round(255 - (127 * normalized));
                const g = Math.round(224 * (1 - normalized));
                const b = Math.round(224 * (1 - normalized));
                
                return `rgb(${r}, ${g}, ${b})`;
            }

            // Buat layer choropleth
            const heatmapLayer = L.geoJSON(geoJsonStore['KELURAHAN'], {
                style: (feature) => {
                    const data = kelurahanData.find(d => d.feature === feature);
                    const count = data ? data.count : 0;
                    
                    return {
                        fillColor: getColor(count),
                        weight: 1.5,
                        opacity: 1,
                        color: 'white',
                        fillOpacity: 0.75
                    };
                },
                onEachFeature: (feature, layer) => {
                    const data = kelurahanData.find(d => d.feature === feature);
                    const count = data ? data.count : 0;
                    const name = data ? data.name : 'Tidak Diketahui';
                    
                    // Hitung persentase dari maksimal
                    const percentage = maxCount > 0 ? ((count / maxCount) * 100).toFixed(1) : 0;
                    
                    const popupContent = `
                        <div style="min-width: 200px; font-family: sans-serif;">
                            <div style="font-weight: 700; font-size: 14px; color: #1e293b; margin-bottom: 10px; padding-bottom: 8px; border-bottom: 2px solid #e2e8f0;">
                                ${name}
                            </div>
                            
                            <div style="border:1px solid #e2e8f0; padding:10px; border-radius:6px; margin-bottom:10px; background: #f8fafc;">
                                <div style="font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px;">
                                    Jumlah Objek
                                </div>
                                <div style="font-size:24px; font-weight:700; color:#1e293b; text-align:center; margin-bottom:8px;">
                                    ${count}
                                </div>
                                <div style="height: 10px; background: #e2e8f0; border-radius: 5px; overflow: hidden; margin-bottom: 6px;">
                                    <div style="height: 100%; background: ${getColor(count)}; width: ${percentage}%; transition: width 0.3s;"></div>
                                </div>
                                <div style="font-size:11px; color:#64748b; text-align:center;">
                                    ${percentage}% dari maksimal (${maxCount} titik)
                                </div>
                            </div>

                            <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding:10px; border-radius:6px; font-size:11px; color:white; line-height:1.4; text-align: center; font-weight: 600;">
                                ${count === maxCount ? 'PRIORITAS: Area dengan nilai tertinggi!' : 
                                  count === minCount ? 'INFO: Area dengan nilai terendah' :
                                  count > (maxCount * 0.7) ? 'TINGGI: Area dengan nilai tinggi' :
                                  count > (maxCount * 0.4) ? 'SEDANG: Area dengan nilai sedang' :
                                  'RENDAH: Area dengan nilai rendah'}
                            </div>
                        </div>
                    `;
                    
                    layer.bindPopup(popupContent);
                    
                    layer.on('mouseover', function() {
                        this.setStyle({
                            weight: 3,
                            fillOpacity: 0.9
                        });
                        if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
                            this.bringToFront();
                        }
                    });
                    
                    layer.on('mouseout', function() {
                        heatmapLayer.resetStyle(this);
                    });
                }
            });

            // Tambahkan ke peta
            mapLayers['HEATMAP_LAYER'] = heatmapLayer;
            heatmapLayer.addTo(map);
            
            // Pastikan heatmap di paling bawah
            heatmapLayer.bringToBack();
            
            // Bawa semua layer lain (titik-titik) ke depan
            Object.keys(mapLayers).forEach(key => {
                if (key !== 'HEATMAP_LAYER' && 
                    key !== 'KECAMATAN' && 
                    key !== 'KELURAHAN' && 
                    key !== 'SURABAYA_MASK' &&
                    mapLayers[key] && 
                    map.hasLayer(mapLayers[key])) {
                    mapLayers[key].bringToFront();
                }
            });
            
            // Bawa cluster result dan boundaries ke depan jika ada
            if (mapLayers['CLUSTER_BOUNDARIES'] && map.hasLayer(mapLayers['CLUSTER_BOUNDARIES'])) {
                mapLayers['CLUSTER_BOUNDARIES'].bringToFront();
            }
            if (mapLayers['ANALYSIS_RESULT'] && map.hasLayer(mapLayers['ANALYSIS_RESULT'])) {
                mapLayers['ANALYSIS_RESULT'].bringToFront();
            }

            // Update legend
            const legendDiv = document.getElementById('heatmap-legend');
            const legendValues = document.getElementById('legend-values');
            legendDiv.style.display = 'block';
            
            legendValues.innerHTML = `
                <div style="display: flex; justify-content: space-between; margin-bottom: 4px;">
                    <span>Min:</span>
                    <span style="font-weight: 600;">${minCount} titik</span>
                </div>
                <div style="display: flex; justify-content: space-between;">
                    <span>Max:</span>
                    <span style="font-weight: 600;">${maxCount} titik</span>
                </div>
            `;

            // Update status
            statusDiv.innerHTML = `
                <i class="bi bi-check-circle-fill" style="color: #22c55e;"></i> 
                Analisis selesai! ${kelurahanData.length} kelurahan dianalisis. 
                Total ${allPoints.length} titik data.
            `;

            // Update legend info
            infoLegend.update();

        } catch (error) {
            console.error('Error in heatmap analysis:', error);
            statusDiv.innerHTML = `<i class="bi bi-exclamation-triangle-fill" style="color: #ef4444;"></i> Error: ${error.message}`;
        }
    }, 100);
}

// ============================================================
// FUNGSI PRINT MAP KE PDF - ANTI GLITCH & SMOOTH
// ============================================================
function printMap() {
    const loadingOverlay = document.getElementById('loading-overlay');
    const mapContainer = document.getElementById('map'); 

    // --- 1. SETUP LOADING OVERLAY (TIRAI PANGGUNG) ---
    // Pastikan overlay mode FIXED agar menutupi seluruh layar & tidak ikut bergeser
    if (loadingOverlay) {
        loadingOverlay.style.position = 'fixed'; // Wajib fixed
        loadingOverlay.style.top = '0';
        loadingOverlay.style.left = '0';
        loadingOverlay.style.width = '100vw';
        loadingOverlay.style.height = '100vh';
        loadingOverlay.style.zIndex = '99999'; // Pastikan paling atas
        loadingOverlay.style.background = 'rgba(255, 255, 255, 1)'; // Background solid (bukan transparan) agar proses resize tidak tembus pandang
        loadingOverlay.style.display = 'flex';
        
        loadingOverlay.innerHTML = `
            <div style="text-align: center;">
                <div style="width: 50px; height: 50px; border: 5px solid #e2e8f0; border-top: 5px solid #3b82f6; border-radius: 50%; animation: spin 1s linear infinite; margin: 0 auto 15px;"></div>
                <div style="font-weight: 600; color: #334155; font-size: 15px;">Mempersiapkan export...</div>
            </div>`;
    }

    // --- 2. ANTI-GLITCH: KUNCI SCROLL BODY ---
    // Mencegah scrollbar muncul/hilang saat peta membesar
    const originalBodyOverflow = document.body.style.overflow;
    document.body.style.overflow = 'hidden';

    // --- 3. PROSES UTAMA (DIBUNGKUS TIMEOUT) ---
    // Kita beri jeda 100ms agar Loading Overlay munul DULUAN dengan sempurna
    // Baru setelah itu kita ubah ukuran peta. Ini mencegah user melihat "lompatan" gambar.
    setTimeout(() => {
        try {
            // --- AMBIL DATA CHECKBOX (Sama seperti sebelumnya) ---
            const activeLayersList = [];
            const checkboxes = document.querySelectorAll('#filter-sidebar input[type="checkbox"]:checked');
            checkboxes.forEach(cb => {
                let labelText = '';
                const parent = cb.parentElement;
                if (parent) labelText = parent.innerText || parent.textContent;
                labelText = labelText.replace(/[\n\r]+|[\s]{2,}/g, ' ').trim();
                if (labelText) activeLayersList.push(labelText);
            });

            // --- SIMPAN STATE AWAL ---
            const originalWidth = mapContainer.style.width;
            const originalHeight = mapContainer.style.height;
            const originalPosition = mapContainer.style.position;
            const originalTop = mapContainer.style.top;
            const originalLeft = mapContainer.style.left;
            const originalZIndex = mapContainer.style.zIndex;
            
            const currentZoom = map.getZoom();
            const currentCenter = map.getCenter();

            // Sembunyikan UI
            const sidebar = document.getElementById('filter-sidebar');
            const toggleBtn = document.getElementById('toggle-btn');
            const heatmapLegend = document.getElementById('heatmap-legend');
            const printSection = document.querySelector('.print-section');
            const infoLegendDiv = document.querySelector('.info-legend');

            if (sidebar) sidebar.style.display = 'none';
            if (toggleBtn) toggleBtn.style.display = 'none';
            if (heatmapLegend) heatmapLegend.style.display = 'none';
            if (printSection) printSection.style.display = 'none';
            if (infoLegendDiv) infoLegendDiv.style.display = 'none';
            map.closePopup();

            // --- RESIZE MAP DI BELAKANG LAYAR ---
            mapContainer.style.position = 'fixed'; // Gunakan FIXED agar tidak merusak layout halaman di belakang overlay
            mapContainer.style.top = '0';
            mapContainer.style.left = '0';
            mapContainer.style.width = '2480px';  // A4 Width High Res
            mapContainer.style.height = '1754px'; // A4 Height High Res
            mapContainer.style.zIndex = '1';      // Di bawah loading overlay (99999), tapi tetap visible bagi DOM
            
            map.invalidateSize();
            
            // Set View Surabaya
            const surabayaCenter = [-7.2575, 112.7400];
            map.setView(surabayaCenter, 13, { animate: false });

            // Update Text Loading
            if(loadingOverlay) loadingOverlay.querySelector('div[style*="font-weight"]').innerText = "Menambahkan Legenda...";

            // --- BUAT LEGENDA ---
            const printLegendDiv = document.createElement('div');
            printLegendDiv.id = 'temp-print-legend';
            const now = new Date();
            const dateStr = now.toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
            const timeStr = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });

            let layersHtml = activeLayersList.length > 0 
                ? `<ul style="margin: 5px 0 0 20px; padding: 0; list-style-type: square;">
                    ${activeLayersList.map(l => `<li style="margin-bottom: 2px;">${l}</li>`).join('')}
                   </ul>` 
                : '<div style="font-style: italic; color: #666;">Tidak ada layer khusus yang aktif</div>';

            printLegendDiv.style.cssText = `
                position: absolute; bottom: 30px; right: 30px;
                background: rgba(255, 255, 255, 0.95); padding: 20px;
                border: 2px solid #333; border-radius: 8px;
                font-family: Arial, sans-serif; font-size: 24px; color: #333;
                z-index: 9999; max-width: 600px; box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            `;

            printLegendDiv.innerHTML = `
                <h2 style="margin: 0 0 10px 0; font-size: 32px; border-bottom: 2px solid #333; padding-bottom: 10px;">Peta Sebaran Surabaya</h2>
                <div style="font-weight: bold; margin-bottom: 5px;">Waktu Cetak:</div>
                <div style="margin-bottom: 15px;">${dateStr}, Pukul ${timeStr}</div>
                <div style="font-weight: bold; margin-bottom: 5px;">Layer Aktif:</div>
                ${layersHtml}
            `;
            mapContainer.appendChild(printLegendDiv);

            if(loadingOverlay) loadingOverlay.querySelector('div[style*="font-weight"]').innerText = "Merender Peta Resolusi Tinggi...";

            // --- RENDER DENGAN TIMEOUT ---
            // Beri waktu 2.5 detik untuk map memuat tiles di ukuran baru
            setTimeout(() => {
                const width = mapContainer.offsetWidth;
                const height = mapContainer.offsetHeight;

                domtoimage.toPng(mapContainer, {
                    width: width,
                    height: height,
                    quality: 1.0,
                    style: { 'transform': 'none' },
                    filter: function(node) {
                        if (node.id === 'loading-overlay') return false;
                        if (node.classList && (
                            node.classList.contains('leaflet-control-zoom') || 
                            node.classList.contains('leaflet-control-layers') ||
                            node.classList.contains('leaflet-control-attribution')
                        )) return false;
                        return true;
                    }
                })
                .then(function(dataUrl) {
                    if(loadingOverlay) loadingOverlay.querySelector('div[style*="font-weight"]').innerText = "Menyimpan PDF...";

                    const { jsPDF } = window.jspdf;
                    const pdf = new jsPDF({
                        orientation: 'landscape',
                        unit: 'mm',
                        format: 'a4',
                        compress: true
                    });

                    pdf.addImage(dataUrl, 'PNG', 0, 0, 297, 210);
                    const filenameDate = new Date().toISOString().split('T')[0];
                    pdf.save(`Peta_Surabaya_${filenameDate}.pdf`);

                    // --- RESTORE (BERSIH-BERSIH) ---
                    // 1. Hapus Legenda
                    const tempLegend = document.getElementById('temp-print-legend');
                    if (tempLegend) tempLegend.remove();

                    // 2. Kembalikan Ukuran & Posisi Map
                    mapContainer.style.width = originalWidth;
                    mapContainer.style.height = originalHeight;
                    mapContainer.style.position = originalPosition;
                    mapContainer.style.top = originalTop;
                    mapContainer.style.left = originalLeft;
                    mapContainer.style.zIndex = originalZIndex;
                    
                    map.invalidateSize(); // PENTING

                    // 3. Kembalikan UI
                    if (sidebar) sidebar.style.display = 'flex';
                    if (toggleBtn) toggleBtn.style.display = 'flex';
                    if (printSection) printSection.style.display = 'block';
                    if (infoLegendDiv) infoLegendDiv.style.display = 'block';
                    if (heatmapLegend) {
                        const heatmapCheckbox = document.getElementById('heatmap-kecamatan');
                        if (heatmapCheckbox && heatmapCheckbox.checked) heatmapLegend.style.display = 'block';
                    }

                    // 4. Kembalikan View & Scroll
                    map.setView(currentCenter, currentZoom, { animate: false });
                    document.body.style.overflow = originalBodyOverflow; // Buka kunci scroll
                    
                    if (loadingOverlay) loadingOverlay.style.display = 'none';
                })
                .catch(function(error) {
                    console.error('Error export:', error);
                    alert('Gagal export PDF: ' + error.message);
                    cleanupAfterError(originalWidth, originalHeight, originalPosition, originalBodyOverflow, sidebar, loadingOverlay);
                });

            }, 2500); // Waktu tunggu render

        } catch (e) {
            console.error(e);
            if (loadingOverlay) loadingOverlay.style.display = 'none';
            document.body.style.overflow = originalBodyOverflow;
        }
    }, 100); // Timeout awal 100ms untuk memastikan overlay tampil dulu
}

// Fungsi helper jika terjadi error di tengah jalan
function cleanupAfterError(w, h, pos, overflow, sidebar, overlay) {
    const mapContainer = document.getElementById('map');
    const tempLegend = document.getElementById('temp-print-legend');
    if (tempLegend) tempLegend.remove();
    
    mapContainer.style.width = w;
    mapContainer.style.height = h;
    mapContainer.style.position = pos;
    map.invalidateSize();
    
    document.body.style.overflow = overflow;
    if (sidebar) sidebar.style.display = 'flex';
    if (overlay) overlay.style.display = 'none';
}

// ============================================================
// FULLSCREEN FUNCTIONALITY
// ============================================================
function toggleFullscreen() {
    const petaCard = document.querySelector('.peta-card');
    const body = document.body;
    const icon = document.getElementById('fullscreen-icon');
    
    if (!petaCard.classList.contains('fullscreen')) {
        // Enter fullscreen
        petaCard.classList.add('fullscreen');
        body.classList.add('fullscreen-active');
        icon.classList.remove('bi-arrows-fullscreen');
        icon.classList.add('bi-fullscreen-exit');
        
        // Invalidate map size untuk re-render
        setTimeout(() => {
            map.invalidateSize();
        }, 100);
        
    } else {
        // Exit fullscreen
        petaCard.classList.remove('fullscreen');
        body.classList.remove('fullscreen-active');
        icon.classList.remove('bi-fullscreen-exit');
        icon.classList.add('bi-arrows-fullscreen');
        
        // Invalidate map size untuk re-render
        setTimeout(() => {
            map.invalidateSize();
        }, 100);
    }
}

// ESC key untuk exit fullscreen
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        const petaCard = document.querySelector('.peta-card');
        if (petaCard.classList.contains('fullscreen')) {
            toggleFullscreen();
        }
    }
});

// INITIALIZE MAP DATA
initMapData();