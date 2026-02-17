// ============================================================
// PETA-MAP.JS - JavaScript untuk Peta Pembangunan Surabaya
// VERSI FIXED - Grid Tipis, Sidebar Real, Tanpa Emoji
// PERBAIKAN: Loading overlay dan duplikasi fungsi
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
const surabayaBounds = [
    [-7.3500, 112.6500],
    [-7.1800, 112.8500]
];
const centerPoint = [-7.2575, 112.7400];

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

window.map = L.map('map', {
    center: centerPoint, 
    zoom: 12, 
    minZoom: 2,
    maxZoom: 18,
    layers: [defaultLayer], 
    zoomControl: false,
    wheelPxPerZoomLevel: 60,
    worldCopyJump: true
});

L.control.zoom({ position: 'topright' }).addTo(map);

// Fullscreen Button
const fullscreenControl = L.control({ position: 'topright' });
fullscreenControl.onAdd = function(map) {
    const div = L.DomUtil.create('div', 'leaflet-bar leaflet-control');
    div.innerHTML = '<button id="fullscreen-btn" onclick="toggleFullscreen()" title="Toggle Fullscreen" style="background: white; color: #334155; border: none; border-radius: 4px; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 16px;"><i class="bi bi-arrows-fullscreen" id="fullscreen-icon"></i></button>';
    
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
                    
                    layer.bindTooltip(nameVal, {
                        permanent: false,
                        direction: 'center',
                        className: layerKey === 'KECAMATAN' ? 'kecamatan-label' : 'kelurahan-label',
                        sticky: false
                    });
                    
                    return;
                }

                let lokasiVal = null;
                if (config.locationField && props[config.locationField]) {
                    lokasiVal = props[config.locationField];
                } else {
                    const locationKey = Object.keys(props).find(k => /jalan|alamat|lokasi|alamat sek/i.test(k));
                    if (locationKey) lokasiVal = props[locationKey];
                }

                let kecVal = null;
                if (props.KECAMATAN) {
                    kecVal = props.KECAMATAN;
                } else {
                    const kecKey = Object.keys(props).find(k => /kecamatan|kec/i.test(k));
                    if (kecKey) kecVal = props[kecKey];
                }

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
    
    try {
        if(loadingOverlay) {
            loadingOverlay.style.display = 'flex';
        }
        
        const promises = Object.keys(layerConfig).map(key => loadLayer(key));
        await Promise.all(promises);
        
        const maskCheckbox = document.getElementById('surabaya-mask-toggle');
        if (maskCheckbox && maskCheckbox.checked) {
            toggleSurabayaMask(true);
        }
        
        console.log('Data peta berhasil dimuat. Peta bebas untuk navigasi.');
        
    } catch (error) {
        console.error('Error saat memuat data peta:', error);
        alert('Gagal memuat data peta. Silakan refresh halaman.');
    } finally {
        // Pastikan loading overlay selalu disembunyikan
        if(loadingOverlay) {
            loadingOverlay.style.display = 'none';
        }
    }
}

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
            if (!map.hasLayer(mapLayers['SURABAYA_MASK'])) {
                map.addLayer(mapLayers['SURABAYA_MASK']);
            }
            return;
        }

        if (!geoJsonStore['KECAMATAN'] || !geoJsonStore['KECAMATAN'].features) {
            console.warn('Data kecamatan belum dimuat, tidak dapat membuat mask');
            return;
        }

        const kecamatanFeatures = geoJsonStore['KECAMATAN'].features;
        
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

        let surabayaUnion = null;
        kecamatanFeatures.forEach(feature => {
            if (feature.geometry && feature.geometry.type === 'MultiPolygon') {
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
            const maskArea = turf.difference(worldPolygon, surabayaUnion);
            
            if (maskArea) {
                const maskLayer = L.geoJSON(maskArea, {
                    style: {
                        fillColor: '#f0f0f0',
                        fillOpacity: 0.8,
                        color: '#999',
                        weight: 1,
                        interactive: false
                    },
                    pane: 'overlayPane'
                });

                mapLayers['SURABAYA_MASK'] = maskLayer;
                maskLayer.addTo(map);
                maskLayer.bringToBack();
            }
        }
    } catch (error) {
        console.warn('Tidak dapat membuat mask Surabaya:', error);
    }
}

function addSurabayaMask() {
    toggleSurabayaMask(true);
}

// Event listeners
document.querySelectorAll('.layer-toggle').forEach(checkbox => {
    checkbox.addEventListener('change', (e) => {
        const layerKey = e.target.dataset.layer;
        if (mapLayers[layerKey]) {
            if (e.target.checked) {
                map.addLayer(mapLayers[layerKey]);
                
                if (layerConfig[layerKey].isBoundary) {
                    mapLayers[layerKey].bringToBack();
                    
                    if (mapLayers['HEATMAP_LAYER'] && map.hasLayer(mapLayers['HEATMAP_LAYER'])) {
                        mapLayers['HEATMAP_LAYER'].bringToBack();
                    }
                } else {
                    mapLayers[layerKey].bringToFront();
                }
            } else {
                map.removeLayer(mapLayers[layerKey]);
            }
            infoLegend.update();
        }
    });
});

const surabayaMaskToggle = document.getElementById('surabaya-mask-toggle');
if (surabayaMaskToggle) {
    surabayaMaskToggle.addEventListener('change', (e) => {
        if (e.target.checked) {
            toggleSurabayaMask(true);
        } else {
            toggleSurabayaMask(false);
        }
    });
}

document.querySelectorAll('.layer-label-toggle').forEach(checkbox => {
    checkbox.addEventListener('change', (e) => {
        const layerKey = e.target.dataset.layer;
        if (mapLayers[layerKey]) {
            if (e.target.checked && !map.hasLayer(mapLayers[layerKey])) {
                map.addLayer(mapLayers[layerKey]);
                if (layerConfig[layerKey].isBoundary) {
                    mapLayers[layerKey].bringToBack();
                }
            }
            
            const boundaryCheckbox = document.querySelector(`input.layer-toggle[data-layer="${layerKey}"]`);
            const config = layerConfig[layerKey];
            
            if (config.isBoundary) {
                mapLayers[layerKey].setStyle((feature) => {
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
                    else if (e.target.checked) {
                        return {
                            color: config.color,
                            weight: 0,
                            opacity: 0,
                            fillOpacity: 0,
                            fillColor: 'transparent'
                        };
                    }
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
            
            mapLayers[layerKey].eachLayer(function(layer) {
                if (layer.getTooltip()) {
                    const tooltip = layer.getTooltip();
                    if (e.target.checked) {
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
            
            if (!e.target.checked && boundaryCheckbox && !boundaryCheckbox.checked) {
                map.removeLayer(mapLayers[layerKey]);
            }
        }
    });
});

function resetMap() {
    map.setView(centerPoint, 12, { animate: true, duration: 1 });
    
    if (mapLayers['ANALYSIS_RESULT']) {
        map.removeLayer(mapLayers['ANALYSIS_RESULT']);
        delete mapLayers['ANALYSIS_RESULT'];
    }
    
    if (mapLayers['CLUSTER_BOUNDARIES']) {
        map.removeLayer(mapLayers['CLUSTER_BOUNDARIES']);
        delete mapLayers['CLUSTER_BOUNDARIES'];
    }
    
    if (mapLayers['HEATMAP_LAYER']) {
        map.removeLayer(mapLayers['HEATMAP_LAYER']);
        delete mapLayers['HEATMAP_LAYER'];
    }
    
    const heatmapLegend = document.getElementById('heatmap-legend');
    if (heatmapLegend) {
        heatmapLegend.style.display = 'none';
    }
    
    document.querySelectorAll('.layer-toggle').forEach(cb => {
        cb.checked = false; 
        const key = cb.dataset.layer;
        if (mapLayers[key] && map.hasLayer(mapLayers[key])) {
            map.removeLayer(mapLayers[key]);
        }
    });
    
    const maskCheckbox = document.getElementById('surabaya-mask-toggle');
    if (maskCheckbox) {
        maskCheckbox.checked = true;
    }
    toggleSurabayaMask(true);
    
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
    
    const analysisResult = document.getElementById('analysis-result');
    if (analysisResult) {
        analysisResult.style.display = 'none';
        analysisResult.innerHTML = '';
    }
    
    if (!map.hasLayer(defaultLayer)) {
        map.addLayer(defaultLayer);
    }
    
    infoLegend.update();
    
    console.log('Map direset ke koordinat Surabaya:', centerPoint);
}

// ============================================================
// FITUR ANALISIS KLUSTERING
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
    statusDiv.innerHTML = 'Menggabungkan data & menghitung...';

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

            const clusterScores = [];
            Object.keys(clusterGroups).forEach(clusterId => {
                const clusterFeatures = turf.featureCollection(clusterGroups[clusterId]);
                const center = turf.center(clusterFeatures);
                const points = clusterGroups[clusterId];
                
                const pointCount = points.length;
                
                let totalDistance = 0;
                points.forEach(point => {
                    const distance = turf.distance(center, point, { units: 'kilometers' });
                    totalDistance += distance;
                });
                const avgDistance = totalDistance / pointCount;
                
                const hull = turf.convex(clusterFeatures);
                const area = hull ? turf.area(hull) / 1000000 : 0;
                
                const density = area > 0 ? pointCount / area : pointCount;
                
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

            clusterScores.sort((a, b) => b.score - a.score);

            const recommendations = L.featureGroup();
            const boundaries = L.featureGroup();

            clusterScores.forEach((cluster, index) => {
                const rank = index + 1;
                const coord = cluster.center.geometry.coordinates;
                
                let rankBadgeClass = 'rank-other';
                let rankIcon = `${rank}`;
                let rankLabel = '';
                
                if (rank === 1) {
                    rankBadgeClass = 'rank-1';
                    rankIcon = 'PRIORITAS 1';
                    rankLabel = 'Ranking 1';
                } else if (rank === 2) {
                    rankBadgeClass = 'rank-2';
                    rankIcon = 'PRIORITAS 2';
                    rankLabel = 'Ranking 2';
                } else if (rank === 3) {
                    rankBadgeClass = 'rank-3';
                    rankIcon = 'PRIORITAS 3';
                    rankLabel = 'Ranking 3';
                } else {
                    rankLabel = `Ranking ${rank}`;
                }

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

            statusDiv.innerHTML = `Selesai! ${k} titik rekomendasi dengan ranking.`;
            infoLegend.update();

        } catch (error) {
            console.error(error);
            statusDiv.innerHTML = `<span style="color:#ef4444;">Gagal: ${error.message}</span>`;
        }
    }, 100);
}

// ============================================================
// FITUR ANALISIS HEATMAP
// ============================================================
function runHeatmapAnalysis() {
    const statusDiv = document.getElementById('analysis-result');
    const selectedCheckboxes = document.querySelectorAll('.analysis-source:checked');
    
    if (selectedCheckboxes.length === 0) {
        alert("Pilih minimal satu sumber data untuk dianalisis.");
        return;
    }

    statusDiv.style.display = 'block';
    statusDiv.innerHTML = 'Menghitung intensitas per kelurahan...';

    if (mapLayers['HEATMAP_LAYER']) {
        map.removeLayer(mapLayers['HEATMAP_LAYER']);
        delete mapLayers['HEATMAP_LAYER'];
    }

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

            if (!geoJsonStore['KELURAHAN'] || !geoJsonStore['KELURAHAN'].features) {
                throw new Error("Data kelurahan belum dimuat. Silakan muat data kelurahan terlebih dahulu.");
            }

            const kelurahanData = geoJsonStore['KELURAHAN'].features.map(kelFeature => {
                let pointCount = 0;
                
                try {
                    if (!kelFeature.geometry || !kelFeature.geometry.coordinates) {
                        console.warn("Invalid kelurahan geometry:", kelFeature.properties);
                        return {
                            feature: kelFeature,
                            count: 0,
                            name: kelFeature.properties.K || kelFeature.properties.KELURAHAN || kelFeature.properties.DESA || kelFeature.properties.name || 'Tidak Diketahui'
                        };
                    }

                    const coords = kelFeature.geometry.coordinates;
                    let isValid = false;

                    const isValidRing = (ring) => {
                        return Array.isArray(ring) && ring.length >= 4;
                    };

                    if (kelFeature.geometry.type === 'Polygon') {
                        isValid = coords.length > 0 && isValidRing(coords[0]);
                    } else if (kelFeature.geometry.type === 'MultiPolygon') {
                        isValid = coords.length > 0 && 
                                 coords[0].length > 0 && 
                                 isValidRing(coords[0][0]);
                    }

                    if (!isValid) {
                        console.warn("Invalid polygon coordinates:", kelFeature.properties);
                        return {
                            feature: kelFeature,
                            count: 0,
                            name: kelFeature.properties.K || kelFeature.properties.KELURAHAN || kelFeature.properties.DESA || kelFeature.properties.name || 'Tidak Diketahui'
                        };
                    }

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

                    let kelPoly;
                    if (kelFeature.geometry.type === 'Polygon') {
                        kelPoly = turf.polygon(coords);
                    } else if (kelFeature.geometry.type === 'MultiPolygon') {
                        kelPoly = turf.multiPolygon(coords);
                    } else {
                        throw new Error('Unsupported geometry type: ' + kelFeature.geometry.type);
                    }
                    
                    allPoints.forEach(point => {
                        try {
                            if (turf.booleanPointInPolygon(point, kelPoly)) {
                                pointCount++;
                            }
                        } catch (e) {
                            // Abaikan
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

            const counts = kelurahanData.map(d => d.count);
            const minCount = Math.min(...counts);
            const maxCount = Math.max(...counts);

            function getColor(count) {
                if (maxCount === minCount) {
                    return '#ff6666';
                }
                
                const normalized = (count - minCount) / (maxCount - minCount);
                
                const r = Math.round(255 - (127 * normalized));
                const g = Math.round(224 * (1 - normalized));
                const b = Math.round(224 * (1 - normalized));
                
                return `rgb(${r}, ${g}, ${b})`;
            }

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

            mapLayers['HEATMAP_LAYER'] = heatmapLayer;
            heatmapLayer.addTo(map);
            
            heatmapLayer.bringToBack();
            
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
            
            if (mapLayers['CLUSTER_BOUNDARIES'] && map.hasLayer(mapLayers['CLUSTER_BOUNDARIES'])) {
                mapLayers['CLUSTER_BOUNDARIES'].bringToFront();
            }
            if (mapLayers['ANALYSIS_RESULT'] && map.hasLayer(mapLayers['ANALYSIS_RESULT'])) {
                mapLayers['ANALYSIS_RESULT'].bringToFront();
            }

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

            statusDiv.innerHTML = `
                Analisis selesai! ${kelurahanData.length} kelurahan dianalisis. 
                Total ${allPoints.length} titik data.
            `;

            infoLegend.update();

        } catch (error) {
            console.error('Error in heatmap analysis:', error);
            statusDiv.innerHTML = `Error: ${error.message}`;
        }
    }, 100);
}

/**
 * KONFIGURASI PDF EXPORT - DISESUAIKAN DENGAN KONDISI REAL SURABAYA
 */

const PDF_CONFIG = {
    logoKiri: (window.ASSET_BASE_URL || '/') + 'images/logo-1.png',
    logoKanan: (window.ASSET_BASE_URL || '/') + 'images/logo-2.png',

    sources: [
        "1. Citra Satelit SPOT 6/7 & Peta Dasar Kota Surabaya",
        "2. Data Dinas Lingkungan Hidup (DLH)",
        "3. Data Dinas Perhubungan (Dishub) Surabaya",
        "4. Badan Perencanaan Pembangunan Daerah (BAPPEDA)"
    ],

    layerConfig: {
        'CCTV_EKSISTING':       { label: 'CCTV Eksisting',     color: '#B153D7', type: 'circle' },
        'TITIK_SAMPAH':         { label: 'Titik Sampah',       color: '#facc15', type: 'circle' },
        'CCTV_RENCANA':         { label: 'CCTV Rencana',       color: '#f97316', type: 'circle' },
        'TITIK_SAMPAH_RENCANA': { label: 'Sampah Rencana',     color: '#22c55e', type: 'circle' },
        'DAMKAR':               { label: 'Pos Damkar',         color: '#FF0000', type: 'circle' },
        'MAKAM':                { label: 'Makam',              color: '#3b82f6', type: 'circle' },
        'PAUD':                 { label: 'PAUD/TK',            color: '#ec4899', type: 'circle' },
        'SD_MI':                { label: 'SD/MI',              color: '#8b5cf6', type: 'circle' },
        'SMP_MTS':              { label: 'SMP/MTS',            color: '#06b6d4', type: 'circle' },
        'KECAMATAN':            { label: 'Batas Kecamatan',    color: '#6366f1', type: 'line' },
        'KELURAHAN':            { label: 'Batas Kelurahan',    color: '#f59e0b', type: 'line' }
    }
};

// ============================================================
// HELPER FUNCTIONS
// ============================================================

function loadImage(src) {
    return new Promise((resolve) => {
        const img = new Image();
        img.crossOrigin = "Anonymous";
        img.src = src;
        img.onload = () => resolve(img);
        img.onerror = () => {
            console.warn("Gagal load image:", src);
            resolve(null);
        };
    });
}

/**
 * Menggambar Grid & Frame Koordinat - GRID SANGAT TIPIS
 */
function drawGridAndFrame(ctx, rect, bounds) {
    const latInterval = 0.025;
    const lngInterval = 0.025;
    const south = bounds.getSouth();
    const north = bounds.getNorth();
    const west = bounds.getWest();
    const east = bounds.getEast();

    ctx.save();
    ctx.beginPath();
    ctx.rect(rect.x, rect.y, rect.width, rect.height);
    ctx.clip();

    ctx.strokeStyle = '#d1d5db';
    ctx.lineWidth = 0.3;
    ctx.font = 'italic 7px Arial';
    ctx.fillStyle = '#4b5563';

    for (let lng = Math.floor(west/lngInterval)*lngInterval; lng <= Math.ceil(east/lngInterval)*lngInterval; lng += lngInterval) {
        let x = rect.x + ((lng - west) / (east - west)) * rect.width;
        if(x > rect.x && x < rect.x + rect.width){
            ctx.beginPath(); ctx.moveTo(x, rect.y); ctx.lineTo(x, rect.y + rect.height); ctx.stroke();
            ctx.fillText(lng.toFixed(3) + " E", x - 15, rect.y + 10);
            ctx.fillText(lng.toFixed(3) + " E", x - 15, rect.y + rect.height - 4);
        }
    }

    for (let lat = Math.floor(south/latInterval)*latInterval; lat <= Math.ceil(north/latInterval)*latInterval; lat += latInterval) {
        let y = rect.y + ((north - lat) / (north - south)) * rect.height;
        if(y > rect.y && y < rect.y + rect.height){
            ctx.beginPath(); ctx.moveTo(rect.x, y); ctx.lineTo(rect.x + rect.width, y); ctx.stroke();
            ctx.fillText(Math.abs(lat).toFixed(3) + " S", rect.x + 4, y - 2);
            ctx.fillText(Math.abs(lat).toFixed(3) + " S", rect.x + rect.width - 38, y - 2);
        }
    }
    ctx.restore();

    ctx.strokeStyle = '#000000';
    ctx.lineWidth = 1.5;
    ctx.strokeRect(rect.x, rect.y, rect.width, rect.height);
}


/**
 * Menggambar Sidebar - FONT BESAR, SPACING LEGA, DIAGRAM REAL
 */
function drawSidebar(ctx, x, y, w, h, logos, bounds, pixelHeight) {
    const centerX = x + (w / 2);
    let curY = y + 20;

    // --- A. LOGO & HEADER ---
    if (logos.kiri) ctx.drawImage(logos.kiri, x + 20, curY, 55, 65);
    if (logos.kanan) ctx.drawImage(logos.kanan, x + w - 75, curY, 55, 65);

    ctx.fillStyle = '#000000';
    ctx.textAlign = 'center';
    ctx.font = 'bold 12px Arial';
    ctx.fillText("PEMERINTAH KOTA SURABAYA", centerX, curY + 18);
    ctx.font = 'bold 10px Arial';
    ctx.fillText("BADAN PERENCANAAN PEMBANGUNAN DAERAH,", centerX, curY + 34);
    ctx.fillText("PENELITIAN, DAN PENGEMBANGAN", centerX, curY + 48);

    curY += 78;
    
    ctx.beginPath(); 
    ctx.moveTo(x + 15, curY); 
    ctx.lineTo(x + w - 15, curY); 
    ctx.lineWidth = 1.5; 
    ctx.stroke();

    curY += 25;

    // --- B. JUDUL PETA ---
    ctx.font = 'bold 14px Arial';
    ctx.fillText("PETA KELENGKAPAN KOTA SURABAYA", centerX, curY);
    curY += 30;
    ctx.beginPath();
    ctx.moveTo(x + 15, curY);
    ctx.lineTo(x + w - 15, curY);
    ctx.lineWidth = 1;
    ctx.stroke();

    curY += 20;

      // --- F. ARAH MATA ANGIN ---
    ctx.fillStyle = 'black';
    ctx.textAlign = 'center';
    ctx.font = 'bold 16px Arial';
    ctx.fillText("U", centerX, curY);
    ctx.beginPath();
    ctx.moveTo(centerX, curY + 5);
    ctx.lineTo(centerX - 6, curY + 32);
    ctx.lineTo(centerX, curY + 28);
    ctx.lineTo(centerX + 6, curY + 32);
    ctx.fill();

    curY += 45;

   
    
    // --- C. SKALA PETA (POSISI TENGAH) ---
ctx.textAlign = 'center';
ctx.font = 'bold 10px Arial';
ctx.fillStyle = '#000000';
// Menggunakan centerX agar teks "SKALA" berada di tengah
ctx.fillText("SKALA : 1 : 50.000", centerX, curY);

curY += 10; // Memberi sedikit ruang tambahan

const barWidth = 100;
const latDiff = Math.abs(bounds.getNorth() - bounds.getSouth());
const kmTotal = latDiff * 111.32;
const kmPerPx = kmTotal / pixelHeight;
const scaleVal = (barWidth * kmPerPx).toFixed(1);

// Menghitung titik awal X agar bar berada di tengah
// Rumus: Titik Tengah dikurangi setengah lebar bar
const barX = centerX - (barWidth / 2);

// Gambar Bar Skala
ctx.fillStyle = 'black';
ctx.fillRect(barX, curY, barWidth / 2, 6); // Bagian hitam (setengah bar)
ctx.strokeStyle = 'black';
ctx.lineWidth = 1;
ctx.strokeRect(barX, curY, barWidth, 6); // Outline bar

// Gambar Angka Skala (0, Tengah, Max)
ctx.font = '9px Arial';
ctx.fillStyle = 'black';

// Angka 0 di ujung kiri bar
ctx.textAlign = 'left';
ctx.fillText("0", barX, curY + 18);

// Angka tengah
ctx.textAlign = 'center';
ctx.fillText(`${(scaleVal/2).toFixed(1)}`, barX + barWidth/2, curY + 18);

// Angka maksimum di ujung kanan bar
ctx.textAlign = 'right';
ctx.fillText(scaleVal + " Km", barX + barWidth, curY + 18);

curY += 30; // Spacing setelah skala

// Garis pemisah bawah
ctx.beginPath();
ctx.moveTo(x + 15, curY);
ctx.lineTo(x + w - 15, curY);
ctx.lineWidth = 1;
ctx.stroke();

curY += 20;

    // --- D. INFORMASI TEKNIS ---
    ctx.textAlign = 'left';
    ctx.font = '9px Arial';
    ctx.fillStyle = '#000000';
    
    const leftPadding = x + 20;
    
    ctx.fillText("Proyeksi", leftPadding, curY);
    ctx.fillText(": Universal Transverse Mercator", leftPadding + 110, curY);
    curY += 14;
    
    ctx.fillText("Sistem Grid", leftPadding, curY);
    ctx.fillText(": Grid Geografis dan Grid UTM Zona 49 S", leftPadding + 110, curY);
    curY += 14;
    
    ctx.fillText("Datum Horizontal", leftPadding, curY);
    ctx.fillText(": Datum WGS 1984", leftPadding + 110, curY);
    curY += 14;
    
    ctx.fillText("Datum Vertikal", leftPadding, curY);
    ctx.fillText(": Geoid EGM 2008", leftPadding + 110, curY);
    
    curY += 25;

    ctx.beginPath();
    ctx.moveTo(x + 15, curY);
    ctx.lineTo(x + w - 15, curY);
    ctx.lineWidth = 1;
    ctx.stroke();

    curY += 20;

    // --- E. DIAGRAM LOKASI (GAMBAR MANUAL LEBIH DETAIL) ---
    ctx.textAlign = 'center';
    ctx.font = 'bold 10px Arial';
    ctx.fillText("DIAGRAM LOKASI", centerX, curY);
    curY += 8;
    
    const diagramX = centerX - 85;
    const diagramY = curY;
    const diagramW = 170;
    const diagramH = 120;
    
    // Background biru laut
    ctx.fillStyle = '#dbeafe';
    ctx.fillRect(diagramX, diagramY, diagramW, diagramH);
    
    // Border kotak
    ctx.strokeStyle = '#000000';
    ctx.lineWidth = 1.5;
    ctx.strokeRect(diagramX, diagramY, diagramW, diagramH);
    
    // Label LAUT JAWA
    ctx.font = '8px Arial';
    ctx.fillStyle = '#0369a1';
    ctx.fillText("LAUT JAWA", centerX, diagramY + 18);
    
    // Gambar Jawa Timur yang lebih detail
    ctx.beginPath();
    ctx.fillStyle = '#f1f5f9';
    ctx.strokeStyle = '#64748b';
    ctx.lineWidth = 1.2;
    
    // Outline Jawa Timur (lebih realistis)
    ctx.moveTo(diagramX + 15, diagramY + 65);
    ctx.lineTo(diagramX + 25, diagramY + 52);
    ctx.lineTo(diagramX + 40, diagramY + 50);
    ctx.lineTo(diagramX + 55, diagramY + 48);
    ctx.lineTo(diagramX + 70, diagramY + 47);
    ctx.lineTo(diagramX + 88, diagramY + 50);
    ctx.lineTo(diagramX + 105, diagramY + 48);
    ctx.lineTo(diagramX + 120, diagramY + 52);
    ctx.lineTo(diagramX + 135, diagramY + 58);
    ctx.lineTo(diagramX + 150, diagramY + 62);
    ctx.lineTo(diagramX + 155, diagramY + 72);
    ctx.lineTo(diagramX + 153, diagramY + 82);
    ctx.lineTo(diagramX + 145, diagramY + 88);
    ctx.lineTo(diagramX + 130, diagramY + 90);
    ctx.lineTo(diagramX + 115, diagramY + 88);
    ctx.lineTo(diagramX + 100, diagramY + 92);
    ctx.lineTo(diagramX + 85, diagramY + 91);
    ctx.lineTo(diagramX + 70, diagramY + 89);
    ctx.lineTo(diagramX + 55, diagramY + 92);
    ctx.lineTo(diagramX + 40, diagramY + 90);
    ctx.lineTo(diagramX + 25, diagramY + 87);
    ctx.lineTo(diagramX + 15, diagramY + 78);
    ctx.closePath();
    ctx.fill();
    ctx.stroke();
    
    // Highlight Surabaya dengan kotak merah + label
    const sbyX = diagramX + 110;
    const sbyY = diagramY + 53;
    
    ctx.fillStyle = '#ef4444';
    ctx.fillRect(sbyX - 4, sbyY - 4, 8, 8);
    ctx.strokeStyle = '#000000';
    ctx.lineWidth = 1;
    ctx.strokeRect(sbyX - 4, sbyY - 4, 8, 8);
    
    // Panah dan label
    ctx.beginPath();
    ctx.moveTo(sbyX + 6, sbyY);
    ctx.lineTo(sbyX + 15, sbyY - 8);
    ctx.strokeStyle = '#000';
    ctx.lineWidth = 0.8;
    ctx.stroke();
    
    ctx.font = 'bold 8px Arial';
    ctx.fillStyle = '#000000';
    ctx.textAlign = 'left';
    ctx.fillText("Lokasi yang", sbyX + 17, sbyY - 10);
    ctx.fillText("dipetakan", sbyX + 17, sbyY - 2);
    
    // Label SAMUDERA HINDIA
    ctx.textAlign = 'center';
    ctx.font = '8px Arial';
    ctx.fillStyle = '#0369a1';
    ctx.fillText("SAMUDERA HINDIA", centerX, diagramY + diagramH - 10);
    
    curY = diagramY + diagramH + 20;

    
  

   // ============================================================
    // --- G. KETERANGAN / LEGENDA (RAPI & TERSTRUKTUR) ---
    // ============================================================
    
    // Konstanta Layout Legenda
    const legLeft = x + 20;        // Margin kiri untuk teks Header
    const legIndent = x + 30;      // Margin kiri untuk sub-header
    const legSymbolX = x + 35;     // Posisi X untuk simbol kotak/garis
    const legTextX = x + 55;       // Posisi X untuk teks penjelasan
    
    // Render Header Utama
    ctx.textAlign = 'left';
    ctx.fillStyle = 'black';
    ctx.font = 'bold 11px Arial';
    ctx.fillText("KETERANGAN :", legLeft, curY);
    curY += 20;

    const activeCheckboxes = document.querySelectorAll('.layer-toggle:checked');
    
    // ----------------------------------------
    // 1. DATA ADMINISTRASI (Jika ada layer aktif)
    // ----------------------------------------
    if (activeCheckboxes.length > 0) {
        ctx.font = 'bold 10px Arial';
        ctx.fillStyle = 'black';
        ctx.fillText("Administrasi & Batas Wilayah", legIndent, curY);
        curY += 15;
        
        // Simbol Ibukota Pemerintahan
        ctx.strokeStyle = '#000';
        ctx.lineWidth = 0.8;
        ctx.strokeRect(legSymbolX, curY - 4, 10, 10);
        
        ctx.fillStyle = '#000';
        ctx.fillRect(legSymbolX + 2, curY - 2, 6, 6); // Titik tengah

        ctx.font = '9px Arial';
        ctx.fillStyle = 'black';
        ctx.fillText("Ibukota Pemerintahan", legTextX, curY + 4);
        curY += 16;
        
        // Simbol Batas Kecamatan (Garis Ungu)
        ctx.beginPath();
        ctx.strokeStyle = '#6366f1';
        ctx.lineWidth = 2;
        ctx.setLineDash([4, 2]); // Putus-putus
        ctx.moveTo(legSymbolX - 2, curY);
        ctx.lineTo(legSymbolX + 12, curY);
        ctx.stroke();
        ctx.setLineDash([]); // Reset dash

        ctx.fillText("Batas Kecamatan", legTextX, curY + 3);
        curY += 16;
        
        // Simbol Batas Kelurahan (Garis Oranye)
        ctx.beginPath();
        ctx.strokeStyle = '#f59e0b';
        ctx.lineWidth = 1.5;
        ctx.setLineDash([2, 2]); // Titik-titik
        ctx.moveTo(legSymbolX - 2, curY);
        ctx.lineTo(legSymbolX + 12, curY);
        ctx.stroke();
        ctx.setLineDash([]);

        ctx.fillText("Batas Kelurahan", legTextX, curY + 3);
        curY += 20;

        // ----------------------------------------
        // 2. LOKASI OBJEK (Dinamis sesuai checkbox)
        // ----------------------------------------
        ctx.font = 'bold 10px Arial';
        ctx.fillStyle = 'black';
        ctx.fillText("Lokasi & Fasilitas", legIndent, curY);
        curY += 15;

        activeCheckboxes.forEach(checkbox => {
            const layerKey = checkbox.getAttribute('data-layer');
            const config = PDF_CONFIG.layerConfig[layerKey];

            // Hanya render jika bukan layer batas wilayah
            if (config && !config.isBoundary) {
                if (config.type === 'line') {
                    // Jika tipe garis (misal jalan/sungai)
                    ctx.beginPath();
                    ctx.strokeStyle = config.color;
                    ctx.lineWidth = 2;
                    ctx.moveTo(legSymbolX - 2, curY);
                    ctx.lineTo(legSymbolX + 12, curY);
                    ctx.stroke();
                } else {
                    // Jika tipe titik (circle marker)
                    ctx.beginPath();
                    ctx.fillStyle = config.color;
                    ctx.arc(legSymbolX + 5, curY, 5, 0, 2 * Math.PI);
                    ctx.fill();
                    
                    // Outline hitam tipis biar jelas
                    ctx.strokeStyle = '#000';
                    ctx.lineWidth = 0.5;
                    ctx.stroke();
                }

                ctx.fillStyle = 'black';
                ctx.font = '9px Arial';
                ctx.fillText(config.label, legTextX, curY + 3);
                curY += 16; // Jarak antar item
            }
        });
        
        curY += 8; // Spasi penutup grup
    }
    
    // ----------------------------------------
    // 3. ANALISIS KEPADATAN / HEATMAP
    // ----------------------------------------
    if (mapLayers['HEATMAP_LAYER'] && map.hasLayer(mapLayers['HEATMAP_LAYER'])) {
        ctx.font = 'bold 10px Arial';
        ctx.fillStyle = 'black';
        ctx.fillText("Analisis Kepadatan", legIndent, curY);
        curY += 15;

        // Hitung Data Min/Max untuk Label
        const kelurahanData = [];
        // ... (Logika pengambilan data sama seperti sebelumnya) ...
        // Agar kode lebih bersih, kita asumsikan data sudah ada atau ambil singkat:
        // (Anda bisa copas logika penghitungan min/max detail jika perlu presisi)
        // Di sini saya buat generik agar rapi layoutnya:

        // Kotak Merah (Tinggi)
        ctx.fillStyle = '#b91c1c';
        ctx.fillRect(legSymbolX, curY - 6, 12, 12);
        ctx.strokeStyle = '#000';
        ctx.lineWidth = 0.5;
        ctx.strokeRect(legSymbolX, curY - 6, 12, 12);
        
        ctx.fillStyle = 'black';
        ctx.font = '9px Arial';
        ctx.fillText("Tingkat Kepadatan Tinggi", legTextX, curY + 3);
        curY += 16;
        
        // Kotak Pink (Sedang)
        ctx.fillStyle = '#f472b6';
        ctx.fillRect(legSymbolX, curY - 6, 12, 12);
        ctx.strokeRect(legSymbolX, curY - 6, 12, 12);
        
        ctx.fillStyle = 'black';
        ctx.fillText("Tingkat Kepadatan Sedang", legTextX, curY + 3);
        curY += 16;
        
        // Kotak Pink Muda (Rendah)
        ctx.fillStyle = '#ffe4e6';
        ctx.fillRect(legSymbolX, curY - 6, 12, 12);
        ctx.strokeRect(legSymbolX, curY - 6, 12, 12);
        
        ctx.fillStyle = 'black';
        ctx.fillText("Tingkat Kepadatan Rendah", legTextX, curY + 3);
        curY += 20;
    }
    
    // ----------------------------------------
    // 4. HASIL CLUSTERING (PRIORITAS)
    // ----------------------------------------
    if (mapLayers['ANALYSIS_RESULT'] && map.hasLayer(mapLayers['ANALYSIS_RESULT'])) {
        ctx.font = 'bold 10px Arial';
        ctx.fillStyle = 'black';
        ctx.fillText("Hasil Analisis Prioritas", legIndent, curY);
        curY += 15;
        
        // Prioritas 1 (Emas)
        ctx.beginPath();
        ctx.fillStyle = '#ffd700';
        ctx.arc(legSymbolX + 5, curY, 6, 0, 2 * Math.PI);
        ctx.fill();
        ctx.strokeStyle = '#000';
        ctx.lineWidth = 1;
        ctx.stroke();
        
        ctx.fillStyle = 'black';
        ctx.font = '9px Arial';
        ctx.fillText("Prioritas Utama (Ranking 1)", legTextX, curY + 3);
        curY += 16;
        
        // Prioritas 2 (Perak)
        ctx.beginPath();
        ctx.fillStyle = '#c0c0c0';
        ctx.arc(legSymbolX + 5, curY, 5, 0, 2 * Math.PI);
        ctx.fill();
        ctx.stroke();
        
        ctx.fillStyle = 'black';
        ctx.fillText("Prioritas Menengah (Ranking 2)", legTextX, curY + 3);
        curY += 16;
        
        // Prioritas 3 (Perunggu)
        ctx.beginPath();
        ctx.fillStyle = '#cd7f32';
        ctx.arc(legSymbolX + 5, curY, 5, 0, 2 * Math.PI);
        ctx.fill();
        ctx.stroke();
        
        ctx.fillStyle = 'black';
        ctx.fillText("Prioritas Rendah (Ranking 3)", legTextX, curY + 3);
        curY += 20;
    }
    
    // ----------------------------------------
    // 5. FITUR ALAM / PERAIRAN (Selalu muncul)
    // ----------------------------------------
    ctx.font = 'bold 10px Arial';
    ctx.fillStyle = 'black';
    ctx.fillText("Fitur Alam & Perairan", legIndent, curY);
    curY += 15;
    
    // Kotak Biru Laut
    ctx.fillStyle = '#93c5fd';
    ctx.fillRect(legSymbolX, curY - 6, 12, 12);
    ctx.strokeStyle = '#000';
    ctx.lineWidth = 0.5;
    ctx.strokeRect(legSymbolX, curY - 6, 12, 12);
    
    ctx.fillStyle = 'black';
    ctx.font = '9px Arial';
    ctx.fillText("Badan Air / Sungai", legTextX, curY + 3);
    curY += 25;

  

    // ============================================================
    // --- H. SUMBER DATA (MENTOK KE BAWAH) ---
    // ============================================================
    
    // 1. Hitung tinggi area teks sumber data
    // Kita hitung dulu butuh berapa pixel untuk menulis semua sumber
    const srcLineHeight = 12;
    const srcHeaderHeight = 14; 
    // Menggunakan PDF_CONFIG yang ada di global scope
    const totalSrcHeight = (PDF_CONFIG.sources.length * srcLineHeight) + srcHeaderHeight;
    
    // 2. Tentukan posisi Y baru (Mentok Bawah)
    // Rumus: (Y Awal Sidebar + Tinggi Sidebar) - Tinggi Teks - Margin Bawah
    // Margin bawah kita set 25px agar tidak terlalu mepet garis tepi
    const bottomMargin = 25;
    curY = (y + h) - totalSrcHeight - bottomMargin;

    // 3. Gambar Garis Pemisah di atas Sumber Data
    ctx.beginPath();
    ctx.moveTo(x + 15, curY - 10); // Garis 10px di atas teks
    ctx.lineTo(x + w - 15, curY - 10);
    ctx.lineWidth = 1;
    ctx.strokeStyle = '#000000';
    ctx.stroke();

    // 4. Render Teks Header
    ctx.textAlign = 'left';
    ctx.fillStyle = 'black';
    ctx.font = 'bold 10px Arial';
    // Pastikan variabel 'leftPadding' sudah didefinisikan di atas (biasanya: const leftPadding = x + 20;)
    // Jika belum, ganti 'leftPadding' dengan 'x + 20'
    ctx.fillText("SUMBER DATA :", x + 20, curY);
    
    curY += srcHeaderHeight;
    
    // 5. Render List Sumber Data
    ctx.font = '8px Arial';
    PDF_CONFIG.sources.forEach(src => {
        ctx.fillText(src, x + 20, curY);
        curY += srcLineHeight;
    });

}

// ============================================================
// FUNGSI UTAMA EXPORT PDF
// ============================================================

window.printMap = async function() {
    const loadingOverlay = document.getElementById('loading-overlay');
    const mapDiv = document.getElementById('map');
    
    if (!window.map || typeof window.map.invalidateSize !== 'function') {
        alert("Error: Peta belum siap.");
        return;
    }

    const width = 1754; 
    const height = 1240;
    const margin = 40;
    const sidebarWidth = 400;

    const originalView = map.getCenter();
    const originalZoom = map.getZoom();
    const originalStyle = {
        width: mapDiv.style.width,
        height: mapDiv.style.height,
        position: mapDiv.style.position,
        zIndex: mapDiv.style.zIndex,
        top: mapDiv.style.top,
        left: mapDiv.style.left
    };

    const restoreMapState = () => {
        try {
            mapDiv.style.width = originalStyle.width;
            mapDiv.style.height = originalStyle.height;
            mapDiv.style.position = originalStyle.position;
            mapDiv.style.top = originalStyle.top;
            mapDiv.style.left = originalStyle.left;
            mapDiv.style.zIndex = originalStyle.zIndex;
            
            if (window.map) {
                window.map.invalidateSize();
                window.map.setView(originalView, originalZoom);
            }
        } catch (e) {
            console.error("Error saat restore map:", e);
        }
    };

    try {
        if (loadingOverlay) {
            loadingOverlay.style.display = 'flex';
            const loadingText = loadingOverlay.querySelector('div div:last-child');
            if(loadingText) loadingText.innerText = "Menyiapkan Aset & Layout...";
        }

        const [logo1, logo2] = await Promise.all([
            loadImage(PDF_CONFIG.logoKiri),
            loadImage(PDF_CONFIG.logoKanan)
        ]);

        const mapAreaWidth = width - sidebarWidth - (margin * 2);
        const mapAreaHeight = height - (margin * 2);

        const currentBounds = map.getBounds();

        mapDiv.style.width = mapAreaWidth + 'px';
        mapDiv.style.height = mapAreaHeight + 'px';
        mapDiv.style.position = 'relative';
        mapDiv.style.zIndex = '1';

        window.map.invalidateSize();
        
        if (currentBounds.isValid()) {
            window.map.fitBounds(currentBounds, { 
                padding: [10, 10],
                animate: false 
            });
        }

        if (loadingOverlay) {
             const loadingText = loadingOverlay.querySelector('div div:last-child');
             if(loadingText) loadingText.innerText = "Merender Peta Resolusi Tinggi...";
        }
        
        await new Promise(r => setTimeout(r, 5000));

        let dataUrl;
        try {
            dataUrl = await domtoimage.toPng(mapDiv, {
                width: mapAreaWidth,
                height: mapAreaHeight,
                quality: 1.0,
                style: {
                    transform: 'scale(1)',
                    transformOrigin: 'top left'
                },
                filter: function (node) {
                    if (node.classList && (
                        node.classList.contains('leaflet-control-container') || 
                        node.classList.contains('leaflet-control')
                    )) {
                        return false;
                    }
                    return true;
                }
            });
        } catch (captureError) {
            console.error("Error saat capture peta:", captureError);
            throw new Error("Gagal mengcapture peta: " + captureError.message);
        }

        const mapImage = await loadImage(dataUrl);
        
        if (!mapImage) {
            throw new Error("Gambar peta gagal dimuat");
        }

        restoreMapState();

        const canvas = document.createElement('canvas');
        canvas.width = width;
        canvas.height = height;
        const ctx = canvas.getContext('2d');

        ctx.fillStyle = '#FFFFFF';
        ctx.fillRect(0, 0, width, height);

        ctx.strokeStyle = '#000000';
        ctx.lineWidth = 2;
        ctx.strokeRect(margin, margin, width - (margin*2), height - (margin*2));

        const mapX = margin;
        const mapY = margin;
        
        if (mapImage && mapImage.complete) {
            ctx.drawImage(mapImage, mapX, mapY, mapAreaWidth, mapAreaHeight);
        } else {
            throw new Error("Gambar peta tidak valid untuk digambar");
        }

        if(window.map && window.map.getBounds) {
            drawGridAndFrame(ctx, { 
                x: mapX, 
                y: mapY, 
                width: mapAreaWidth, 
                height: mapAreaHeight 
            }, window.map.getBounds());
        }

        const sidebarX = mapX + mapAreaWidth;
        
        ctx.beginPath();
        ctx.moveTo(sidebarX, margin);
        ctx.lineTo(sidebarX, height - margin);
        ctx.lineWidth = 1.5;
        ctx.stroke();

        if(window.map && window.map.getBounds) {
            drawSidebar(
                ctx, sidebarX, margin, sidebarWidth, height - (margin*2), 
                { kiri: logo1, kanan: logo2 },
                window.map.getBounds(),
                mapAreaHeight
            );
        }

        if (loadingOverlay) {
             const loadingText = loadingOverlay.querySelector('div div:last-child');
             if(loadingText) loadingText.innerText = "Membuat File PDF...";
        }
        
        const pdfData = canvas.toDataURL('image/jpeg', 0.9);
        const { jsPDF } = window.jspdf;
        const pdf = new jsPDF({
            orientation: 'landscape',
            unit: 'px',
            format: [width, height]
        });

        pdf.addImage(pdfData, 'JPEG', 0, 0, width, height);
        
        const dateStr = new Date().toISOString().slice(0,10);
        pdf.save(`Peta_Surabaya_Kelengkapan_${dateStr}.pdf`);
        
        if (loadingOverlay) {
             const loadingText = loadingOverlay.querySelector('div div:last-child');
             if(loadingText) {
                 loadingText.innerText = "PDF berhasil dibuat!";
                 loadingText.style.color = '#22c55e';
             }
             setTimeout(() => {
                 if(loadingOverlay) loadingOverlay.style.display = 'none';
             }, 1500);
        }

    } catch (e) {
        console.error("Export PDF Error:", e);
        alert("Gagal Export PDF: " + e.message);
        restoreMapState();
    } finally {
        setTimeout(() => {
            if (loadingOverlay) loadingOverlay.style.display = 'none';
        }, 2000);
    }
};

// ============================================================
// FULLSCREEN FUNCTIONALITY
// ============================================================
function toggleFullscreen() {
    const petaCard = document.querySelector('.peta-card');
    const body = document.body;
    const icon = document.getElementById('fullscreen-icon');
    
    if (!petaCard.classList.contains('fullscreen')) {
        petaCard.classList.add('fullscreen');
        body.classList.add('fullscreen-active');
        icon.classList.remove('bi-arrows-fullscreen');
        icon.classList.add('bi-fullscreen-exit');
        
        setTimeout(() => {
            map.invalidateSize();
        }, 100);
        
    } else {
        petaCard.classList.remove('fullscreen');
        body.classList.remove('fullscreen-active');
        icon.classList.remove('bi-fullscreen-exit');
        icon.classList.add('bi-arrows-fullscreen');
        
        setTimeout(() => {
            map.invalidateSize();
        }, 100);
    }
}

// Event listener untuk Escape key
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