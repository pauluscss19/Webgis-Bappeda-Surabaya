<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Peta - SIDAPETA SBY</title>

  <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
  <link rel="stylesheet" href="{{ asset('css/peta.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
  
  <style>
    /* --- CSS UTAMA --- */
    .peta-card {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        background: #fff;
        position: relative;
        height: 85vh;
        min-height: 600px;
    }

    #map {
        height: 100%; width: 100%; z-index: 1;
    }

    /* --- SIDEBAR FILTER (FLOATING) --- */
    #filter-sidebar {
        position: absolute;
        top: 10px; left: 10px; bottom: 10px;
        width: 340px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(5px);
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        z-index: 2000;
        display: flex;
        flex-direction: column;
        transition: transform 0.3s ease-in-out;
        transform: translateX(0);
    }

    #filter-sidebar.hidden {
        transform: translateX(-380px);
    }

    .sidebar-header {
        padding: 15px 20px;
        border-bottom: 1px solid #eee;
        display: flex; justify-content: space-between; align-items: center;
        background: #f8fafc;
        border-radius: 12px 12px 0 0;
    }

    .sidebar-content {
        flex: 1;
        overflow-y: auto;
        padding: 15px;
    }
    
    .sidebar-content::-webkit-scrollbar { width: 6px; }
    .sidebar-content::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }

    .sidebar-footer {
        padding: 15px;
        border-top: 1px solid #eee;
        background: #fff;
        border-radius: 0 0 12px 12px;
    }

    /* --- TOMBOL TOGGLE --- */
    #toggle-btn {
        position: absolute;
        top: 20px; left: 20px;
        z-index: 2001;
        background: #3b82f6; color: white;
        border: none; padding: 10px 14px;
        border-radius: 8px; cursor: pointer;
        box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        transition: all 0.3s;
        display: none;
    }
    #toggle-btn:hover { background: #2563eb; transform: scale(1.05); }

    .close-btn {
        background: none; border: none; font-size: 20px; color: #64748b; cursor: pointer;
    }
    .close-btn:hover { color: #ef4444; }

    /* --- STYLE ITEM LAYER --- */
    .layer-item {
        display: flex; align-items: center; cursor: pointer;
        padding: 10px; margin-bottom: 8px;
        border-radius: 8px; border: 1px solid #e2e8f0;
        background: #fff; transition: all 0.2s;
    }
    .layer-item:hover { border-color: #3b82f6; background: #eff6ff; }
    .layer-color {
        width: 16px; height: 16px; border-radius: 4px; 
        display: inline-block; margin-right: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    /* --- SECTION ANALISIS --- */
    .analysis-box {
        background: #f0f9ff; border: 1px solid #bae6fd;
        padding: 15px; border-radius: 10px; margin-bottom: 20px;
    }
    .analysis-title { 
        font-size: 14px; font-weight: 700; color: #0369a1; 
        margin-bottom: 10px; display: flex; align-items: center; gap: 8px; 
    }
    .form-group { margin-bottom: 10px; }
    .form-group label { 
        display: block; font-size: 12px; color: #64748b; 
        margin-bottom: 6px; font-weight: 600; 
    }
    
    .checkbox-list {
        background: white; border: 1px solid #cbd5e1; border-radius: 6px;
        padding: 8px; max-height: 120px; overflow-y: auto;
    }
    .checkbox-list::-webkit-scrollbar { width: 5px; }
    .checkbox-list::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
    
    .checkbox-item { 
        display: flex; align-items: center; font-size: 12px; margin-bottom: 5px; 
    }
    .checkbox-item:last-child { margin-bottom: 0; }
    .checkbox-item input { margin-right: 8px; }

    .form-control { 
        width: 100%; padding: 8px; border: 1px solid #cbd5e1; 
        border-radius: 6px; font-size: 13px; 
    }
    .btn-analysis {
        width: 100%; padding: 8px; background: #0ea5e9; color: white; border: none;
        border-radius: 6px; font-weight: 600; cursor: pointer; transition: 0.2s;
        margin-top: 5px;
    }
    .btn-analysis:hover { background: #0284c7; }

    /* --- LEGEND STATISTIK --- */
    .info-legend {
        padding: 10px 15px; font: 13px Arial; background: rgba(255,255,255,0.9);
        box-shadow: 0 0 15px rgba(0,0,0,0.2); border-radius: 8px; min-width: 160px;
    }
    .info-legend h4 { margin: 0 0 8px; border-bottom: 1px solid #ccc; padding-bottom: 5px; font-size:14px; }
    .legend-item { display: flex; justify-content: space-between; margin-bottom: 4px; }

    /* --- STYLE UNTUK POPUP RANKING --- */
    .rank-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 13px;
        margin-bottom: 8px;
    }
    .rank-1 { background: #ffd700; color: #000; }
    .rank-2 { background: #c0c0c0; color: #000; }
    .rank-3 { background: #cd7f32; color: #fff; }
    .rank-other { background: #3b82f6; color: #fff; }

    .score-bar {
        width: 100%;
        height: 8px;
        background: #e5e7eb;
        border-radius: 10px;
        overflow: hidden;
        margin-top: 4px;
    }
    .score-fill {
        height: 100%;
        background: linear-gradient(90deg, #ef4444, #f59e0b, #10b981);
        border-radius: 10px;
        transition: width 0.3s ease;
    }

    .metric-item {
        display: flex;
        justify-content: space-between;
        padding: 6px 0;
        border-bottom: 1px solid #f1f5f9;
        font-size: 12px;
    }
    .metric-item:last-child {
        border-bottom: none;
    }
    .metric-label {
        color: #64748b;
        font-weight: 500;
    }
    .metric-value {
        color: #1e293b;
        font-weight: 700;
    }
  </style>
</head>
<body>

  @include('partials.header') 

  <main class="peta-page">
    <section class="peta-banner">
      <div class="peta-banner__inner">
        <div class="peta-banner__icon">
            <img src="{{ asset('images/icon-peta.jpg') }}" alt="Icon Peta" onerror="this.style.display='none'">
        </div>
        <div class="peta-banner__text">
          <h1 class="peta-banner__title">Peta Pembangunan</h1>
          <p class="peta-banner__subtitle">Peta Tematik Kota Surabaya</p>
        </div>
      </div>
    </section>

    <section class="peta-content">
      <div class="peta-card">
        
        <button id="toggle-btn" onclick="toggleSidebar()">
            <i class="bi bi-list-ul"></i> Filter
        </button>

        <div id="filter-sidebar">
            <div class="sidebar-header">
                <h5 style="margin:0; font-weight:700; color:#334155;"><i class="bi bi-layers-fill me-2"></i> Kontrol Peta</h5>
                <button class="close-btn" onclick="toggleSidebar()"><i class="bi bi-x-lg"></i></button>
            </div>
            
            <div class="sidebar-content">
                
                <!-- SECTION ANALISIS KLUSTERING -->
                <div class="analysis-box">
                    <div class="analysis-title"><i class="bi bi-cpu-fill"></i> AI Analisis Lokasi</div>
                    
                    <div class="form-group">
                        <label>Pilih Sumber Data (Gabungan):</label>
                        <div class="checkbox-list">
                            <label class="checkbox-item">
                                <input type="checkbox" class="analysis-source" value="CCTV_EKSISTING"> CCTV Eksisting
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" class="analysis-source" value="TITIK_SAMPAH"> Titik Sampah
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" class="analysis-source" value="CCTV_RENCANA"> CCTV Rencana
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" class="analysis-source" value="TITIK_SAMPAH_RENCANA"> Sampah Rencana
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" class="analysis-source" value="DAMKAR"> Pos Damkar
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" class="analysis-source" value="MAKAM"> Makam
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Target Rekomendasi (Titik):</label>
                        <input type="number" id="cluster-count" class="form-control" value="3" min="1" max="10">
                    </div>

                    <button class="btn-analysis" onclick="runClustering()">
                        <i class="bi bi-magic me-1"></i> Hitung Rekomendasi
                    </button>
                    <div id="analysis-result" style="font-size: 11px; color: #0c4a6e; margin-top: 8px; display: none;">
                    </div>
                </div>

                <hr style="border-top:1px dashed #cbd5e1; margin: 15px 0;">

                <!-- SECTION VISUALISASI DATA -->
                <div style="font-size:12px; font-weight:700; color:#64748b; margin-bottom:10px;">VISUALISASI DATA</div>
                <div style="font-size:12px; color:#64748b; margin-bottom:15px;">
                    Centang layer untuk menampilkan data.
                </div>

                <label class="layer-item">
                    <input type="checkbox" class="layer-toggle me-2" data-layer="CCTV_EKSISTING" checked>
                    <span class="layer-color" style="background: #B153D7;"></span>
                    <span style="font-size:14px;">CCTV Eksisting</span>
                </label>

                <label class="layer-item">
                    <input type="checkbox" class="layer-toggle me-2" data-layer="TITIK_SAMPAH" checked>
                    <span class="layer-color" style="background: #facc15;"></span>
                    <span style="font-size:14px;">Titik Sampah</span>
                </label>

                <label class="layer-item">
                    <input type="checkbox" class="layer-toggle me-2" data-layer="CCTV_RENCANA" checked>
                    <span class="layer-color" style="background: #f97316;"></span>
                    <span style="font-size:14px;">CCTV Rencana</span>
                </label>

                <label class="layer-item">
                    <input type="checkbox" class="layer-toggle me-2" data-layer="TITIK_SAMPAH_RENCANA" checked>
                    <span class="layer-color" style="background: #22c55e;"></span>
                    <span style="font-size:14px;">Sampah Rencana</span>
                </label>

                <label class="layer-item">
                    <input type="checkbox" class="layer-toggle me-2" data-layer="DAMKAR" checked>
                    <span class="layer-color" style="background: #FF0000;"></span>
                    <span style="font-size:14px;">Pos Damkar</span>
                </label>

                <label class="layer-item">
                    <input type="checkbox" class="layer-toggle me-2" data-layer="MAKAM" checked>
                    <span class="layer-color" style="background: #3b82f6;"></span>
                    <span style="font-size:14px;">Makam</span>
                </label>
            </div>

            <div class="sidebar-footer">
                <button onclick="resetMap()" style="
                    width: 100%; padding: 10px; background: #e2e8f0; color: #334155; 
                    border: none; border-radius: 8px; font-weight: 600; cursor: pointer; transition: 0.2s;">
                    <i class="bi bi-arrow-counterclockwise"></i> Reset Peta
                </button>
            </div>
        </div>

        <div id="loading-overlay">Sedang memuat data peta...</div>
        <div id="map"></div>
        
      </div>
    </section>
  </main>

  @include('partials.footer')

  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@turf/turf@6/turf.min.js"></script>

  <script>
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
        const surabayaBounds = [[-7.3600, 112.5900], [-7.1200, 112.8500]];
        const centerPoint = [-7.2575, 112.7521];

        const defaultLayer = L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; CARTO', subdomains: 'abcd', maxZoom: 20
        });
        const satelliteLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: 'Tiles &copy; Esri', maxZoom: 19
        });

        const map = L.map('map', {
            center: centerPoint, zoom: 13, minZoom: 12,
            maxBounds: surabayaBounds, maxBoundsViscosity: 1.0,
            layers: [defaultLayer], zoomControl: false
        });

        L.control.zoom({ position: 'topright' }).addTo(map);
        L.control.layers({ "Peta Default": defaultLayer, "Satelit": satelliteLayer }, null, { position: 'topright' }).addTo(map);

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
            'MAKAM': { file: 'MAKAM.geojson', color: '#3b82f6', label: 'Makam', nameField: 'Nama_Lokas', isPolygon: true }
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
            const filePath = "{{ asset('') }}" + config.file; 

            try {
                const response = await fetch(filePath);
                if (!response.ok) throw new Error(`Status: ${response.status}`);
                const data = await response.json();

                geoJsonStore[layerKey] = data;

                const defaultStyle = { color: config.color, weight: 2, opacity: 1, fillOpacity: 0.5 };

                const layer = L.geoJSON(data, {
                    pointToLayer: (feature, latlng) => {
                        return L.circleMarker(latlng, {
                            radius: 6, fillColor: config.color, fillOpacity: 1.0, stroke: false
                        });
                    },
                    style: (feature) => defaultStyle,
                    
                    onEachFeature: (feature, layer) => {
                        const props = feature.properties; 
                        
                        const nameKey = config.nameField || Object.keys(props).find(k => /name|nama|pos/i.test(k)) || 'Name';
                        const nameVal = props[nameKey] || '-';

                        let lokasiVal = null;
                        if (config.locationField && props[config.locationField]) {
                            lokasiVal = props[config.locationField];
                        } else {
                            const locationKey = Object.keys(props).find(k => /jalan|alamat|lokasi/i.test(k));
                            if (locationKey) lokasiVal = props[locationKey];
                        }

                        const kecKey = Object.keys(props).find(k => /kecamatan|kec/i.test(k));
                        const kecVal = kecKey ? props[kecKey] : null;

                        let detailHtml = '';

                        if (lokasiVal) {
                            detailHtml += `
                            <div style="display:flex; align-items:start; margin-bottom:6px; color:#334155;">
                                <i class="bi bi-geo-alt-fill" style="font-size:14px; margin-right:8px; color:#ef4444; width:15px; margin-top:2px;"></i>
                                <span style="line-height:1.4;">${lokasiVal}</span>
                            </div>`;
                        }

                        if (kecVal) {
                            detailHtml += `
                            <div style="display:flex; align-items:start; margin-bottom:6px; color:#334155;">
                                <i class="bi bi-map-fill" style="font-size:14px; margin-right:8px; color:#3b82f6; width:15px; margin-top:2px;"></i>
                                <span>${kecVal}</span>
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
            const promises = Object.keys(layerConfig).map(key => loadLayer(key));
            await Promise.all(promises);
            if(loadingOverlay) loadingOverlay.style.display = 'none';
        }

        document.querySelectorAll('.layer-toggle').forEach(checkbox => {
            checkbox.addEventListener('change', (e) => {
                const layerKey = e.target.dataset.layer;
                if (mapLayers[layerKey]) {
                    if (e.target.checked) map.addLayer(mapLayers[layerKey]);
                    else map.removeLayer(mapLayers[layerKey]);
                    infoLegend.update();
                }
            });
        });

        function resetMap() {
            map.setView(centerPoint, 13);
            
            if (mapLayers['ANALYSIS_RESULT']) {
                map.removeLayer(mapLayers['ANALYSIS_RESULT']);
                delete mapLayers['ANALYSIS_RESULT'];
            }
            
            document.querySelectorAll('.layer-toggle').forEach(cb => {
                cb.checked = false; 
                const key = cb.dataset.layer;
                if (mapLayers[key] && map.hasLayer(mapLayers[key])) map.removeLayer(mapLayers[key]);
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
                        // Semakin banyak titik = lebih baik (40%)
                        // Semakin kecil jarak rata-rata = lebih baik (30%)
                        // Semakin tinggi density = lebih baik (30%)
                        const maxPoints = Math.max(...Object.keys(clusterGroups).map(id => clusterGroups[id].length));
                        const maxDensity = Math.max(...Object.keys(clusterGroups).map(id => {
                            const cf = turf.featureCollection(clusterGroups[id]);
                            const h = turf.convex(cf);
                            const a = h ? turf.area(h) / 1000000 : 0;
                            return a > 0 ? clusterGroups[id].length / a : clusterGroups[id].length;
                        }));
                        
                        const pointScore = (pointCount / maxPoints) * 40;
                        const distanceScore = (1 / (1 + avgDistance)) * 30; // Inverse, semakin kecil semakin baik
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

                    clusterScores.forEach((cluster, index) => {
                        const rank = index + 1;
                        const coord = cluster.center.geometry.coordinates;
                        
                        // Tentukan badge ranking
                        let rankBadgeClass = 'rank-other';
                        let rankIcon = '🏆';
                        if (rank === 1) {
                            rankBadgeClass = 'rank-1';
                            rankIcon = '🥇';
                        } else if (rank === 2) {
                            rankBadgeClass = 'rank-2';
                            rankIcon = '🥈';
                        } else if (rank === 3) {
                            rankBadgeClass = 'rank-3';
                            rankIcon = '🥉';
                        } else {
                            rankIcon = `#${rank}`;
                        }

                        // Popup dengan ranking, penjelasan detail, dan scoring
                        const popupContent = `
                            <div style="min-width: 280px; font-family: sans-serif;">
                                <div style="text-align: center; margin-bottom: 12px;">
                                    <span class="${rankBadgeClass} rank-badge">
                                        ${rankIcon} Ranking ${rank}
                                    </span>
                                </div>
                                
                                <h6 style="color:#ef4444; font-weight:bold; margin:0 0 8px 0; text-align:center; font-size:15px;">
                                    Rekomendasi Lokasi Strategis
                                </h6>
                                
                                <div style="background:#fff3cd; border-left:4px solid #ffc107; padding:10px; margin-bottom:10px; border-radius:4px;">
                                    <div style="font-size:11px; color:#856404; line-height:1.5;">
                                        <strong>Tingkat Kepentingan:</strong> ${rank === 1 ? 'SANGAT TINGGI ⭐⭐⭐' : rank === 2 ? 'TINGGI ⭐⭐' : rank === 3 ? 'SEDANG ⭐' : 'RENDAH'}
                                    </div>
                                </div>

                                <div style="background:#f0fdf4; border:1px solid #86efac; padding:12px; border-radius:8px; margin-bottom:12px;">
                                    <div style="font-size:12px; font-weight:700; color:#15803d; margin-bottom:8px;">
                                        📊 SKOR KELAYAKAN
                                    </div>
                                    <div style="font-size:20px; font-weight:900; color:#16a34a; text-align:center; margin-bottom:6px;">
                                        ${cluster.score.toFixed(1)} / 100
                                    </div>
                                    <div class="score-bar">
                                        <div class="score-fill" style="width: ${cluster.score}%;"></div>
                                    </div>
                                </div>

                                <div style="background:#f8fafc; border:1px solid #e2e8f0; padding:10px; border-radius:8px; margin-bottom:10px;">
                                    <div style="font-size:11px; font-weight:700; color:#334155; margin-bottom:8px;">
                                        📈 METRIK ANALISIS
                                    </div>
                                    
                                    <div class="metric-item">
                                        <span class="metric-label">Jumlah Objek Terdekat</span>
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
                                        <span class="metric-label">Kepadatan Lokasi</span>
                                        <span class="metric-value">${cluster.density.toFixed(1)} titik/km²</span>
                                    </div>
                                </div>

                                <div style="background:#eff6ff; border:1px solid #bfdbfe; padding:10px; border-radius:8px; margin-bottom:10px;">
                                    <div style="font-size:11px; font-weight:700; color:#1e40af; margin-bottom:6px;">
                                        💡 INTERPRETASI
                                    </div>
                                    <div style="font-size:11px; color:#1e3a8a; line-height:1.5;">
                                        Lokasi ini merupakan <strong>pusat gravitasi</strong> dari ${cluster.pointCount} objek infrastruktur. 
                                        ${rank === 1 ? 'Lokasi ini SANGAT DIREKOMENDASIKAN sebagai prioritas utama pembangunan karena memiliki skor tertinggi.' : 
                                          rank === 2 ? 'Lokasi ini DIREKOMENDASIKAN sebagai prioritas kedua dengan potensi strategis yang baik.' :
                                          rank === 3 ? 'Lokasi ini dapat dipertimbangkan sebagai alternatif ketiga.' :
                                          'Lokasi ini memiliki potensi lebih rendah dibanding alternatif lain.'}
                                    </div>
                                </div>

                                <div style="background:#fef2f2; border:1px solid #fecaca; padding:10px; border-radius:8px; margin-bottom:10px;">
                                    <div style="font-size:11px; font-weight:700; color:#991b1b; margin-bottom:6px;">
                                        ✅ KEUNGGULAN STRATEGIS
                                    </div>
                                    <div style="font-size:11px; color:#7f1d1d; line-height:1.6;">
                                        • Meminimalkan jarak rata-rata ke ${cluster.pointCount} objek<br>
                                        • Efisiensi aksesibilitas tinggi<br>
                                        • Optimasi cakupan layanan area<br>
                                        • Kepadatan ${cluster.density.toFixed(1)} titik/km²
                                    </div>
                                </div>

                                <a href="http://maps.google.com/maps?q=${coord[1]},${coord[0]}" target="_blank" 
                                   style="display:block; text-align:center; background:#ef4444; color:white; padding:8px; 
                                          border-radius:6px; text-decoration:none; font-weight:600; font-size:12px;">
                                   📍 Buka di Google Maps
                                </a>
                            </div>
                        `;

                        // Marker dengan label ranking
                        const markerSize = rank === 1 ? 16 : rank === 2 ? 14 : 12;
                        L.circleMarker([coord[1], coord[0]], {
                            radius: markerSize, 
                            fillColor: rank === 1 ? '#ffd700' : rank === 2 ? '#c0c0c0' : rank === 3 ? '#cd7f32' : '#ef4444',
                            color: '#fff', 
                            weight: 3, 
                            fillOpacity: 0.95
                        }).bindPopup(popupContent, { maxWidth: 320 }).addTo(recommendations);

                        // Convex hull untuk area cluster
                        if(cluster.hull) {
                            L.geoJSON(cluster.hull, {
                                style: { 
                                    color: rank === 1 ? '#ffd700' : rank === 2 ? '#c0c0c0' : rank === 3 ? '#cd7f32' : '#ef4444',
                                    weight: 2, 
                                    dashArray: '5, 5', 
                                    fillOpacity: 0.1 
                                }
                            }).addTo(recommendations);
                        }
                    });

                    mapLayers['ANALYSIS_RESULT'] = recommendations;
                    map.addLayer(recommendations);
                    map.fitBounds(recommendations.getBounds(), { padding: [50, 50] });

                    statusDiv.innerHTML = `<i class="bi bi-check-circle-fill" style="color:#10b981;"></i> Selesai! ${k} titik rekomendasi dengan ranking.`;
                    infoLegend.update();

                } catch (error) {
                    console.error(error);
                    statusDiv.innerHTML = `<span style="color:#ef4444;">❌ Gagal: ${error.message}</span>`;
                }
            }, 100);
        }

        initMapData();
  </script>
</body>
</html>