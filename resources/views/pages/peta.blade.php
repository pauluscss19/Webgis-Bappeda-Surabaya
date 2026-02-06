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
                            <label class="checkbox-item">
                                <input type="checkbox" class="analysis-source" value="PAUD"> PAUD/TK
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" class="analysis-source" value="SD_MI"> SD/MI
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" class="analysis-source" value="SMP_MTS"> SMP/MTS
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

                <label class="layer-item">
                    <input type="checkbox" class="layer-toggle me-2" data-layer="PAUD">
                    <span class="layer-color" style="background: #ec4899;"></span>
                    <span style="font-size:14px;">PAUD/TK</span>
                </label>

                <label class="layer-item">
                    <input type="checkbox" class="layer-toggle me-2" data-layer="SD_MI">
                    <span class="layer-color" style="background: #8b5cf6;"></span>
                    <span style="font-size:14px;">SD/MI</span>
                </label>

                <label class="layer-item">
                    <input type="checkbox" class="layer-toggle me-2" data-layer="SMP_MTS">
                    <span class="layer-color" style="background: #06b6d4;"></span>
                    <span style="font-size:14px;">SMP/MTS</span>
                </label>

                <!-- SECTION BATAS WILAYAH -->
                <div class="section-separator">
                    <div class="section-title">Batas Wilayah</div>
                </div>

                <label class="layer-item">
                    <input type="checkbox" class="layer-toggle me-2" data-layer="KECAMATAN">
                    <span class="layer-color" style="background: transparent; border: 2px solid #6366f1;"></span>
                    <span style="font-size:14px;">Batas Kecamatan</span>
                </label>

                <label class="layer-item">
                    <input type="checkbox" class="layer-label-toggle me-2" data-layer="KECAMATAN">
                    <span class="layer-color" style="background: transparent; border: 2px solid #6366f1;"></span>
                    <span style="font-size:14px;">Nama Kecamatan</span>
                </label>

                <label class="layer-item">
                    <input type="checkbox" class="layer-toggle me-2" data-layer="KELURAHAN">
                    <span class="layer-color" style="background: transparent; border: 2px solid #f59e0b;"></span>
                    <span style="font-size:14px;">Batas Kelurahan</span>
                </label>

                <label class="layer-item">
                    <input type="checkbox" class="layer-label-toggle me-2" data-layer="KELURAHAN">
                    <span class="layer-color" style="background: transparent; border: 2px solid #f59e0b;"></span>
                    <span style="font-size:14px;">Nama Kelurahan</span>
                </label>

                <label class="layer-item">
                    <input type="checkbox" class="mask-toggle me-2" id="surabaya-mask-toggle" checked>
                    <span class="layer-color" style="background: #e2e8f0; border: 2px solid #94a3b8;"></span>
                    <span style="font-size:14px;">Tampilkan Hanya Surabaya</span>
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
        
        <!-- SECTION PRINT PDF -->
        <div class="print-section">
            <div class="print-title">
                <i class="bi bi-printer"></i>
                Export Peta
            </div>
            <div class="print-buttons">
                <button class="btn-print" onclick="printMap('current')">
                    <i class="bi bi-file-earmark-pdf"></i>
                    Ukuran Layar
                </button>
                <button class="btn-print" onclick="printMap('a4portrait')">
                    <i class="bi bi-file-earmark-pdf"></i>
                    A4 Portrait
                </button>
                <button class="btn-print" onclick="printMap('a4landscape')">
                    <i class="bi bi-file-earmark-pdf"></i>
                    A4 Landscape
                </button>
            </div>
        </div>
        
      </div>
    </section>
  </main>

  @include('partials.footer')

  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@turf/turf@6/turf.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://unpkg.com/leaflet-simple-map-screenshoter"></script>

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
        // Bounds yang lebih luas mencakup area sekitar Surabaya
        const surabayaBounds = [[-7.5500, 112.4000], [-6.9500, 113.0000]];
        const centerPoint = [-7.2575, 112.7521];

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
            minZoom: 10,
            maxBounds: surabayaBounds, 
            maxBoundsViscosity: 0.8,
            layers: [defaultLayer], 
            zoomControl: false
        });

        L.control.zoom({ position: 'topright' }).addTo(map);
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
            'KELURAHAN': { file: 'kelurahan.geojson', color: '#f59e0b', label: 'Batas Kelurahan', nameField: 'KELURAHAN', isPolygon: true, isBoundary: true }
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
            const filePath = "{{ asset('') }}" + config.file; 

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
                        
                        const nameKey = config.nameField || Object.keys(props).find(k => /name|nama|pos|kecamatan|kelurahan/i.test(k)) || 'Name';
                        const nameVal = props[nameKey] || '-';

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

        // Event listener untuk toggle batas wilayah (kecamatan/kelurahan)
document.querySelectorAll('.layer-toggle').forEach(checkbox => {
    checkbox.addEventListener('change', (e) => {
        const layerKey = e.target.dataset.layer;
        if (mapLayers[layerKey]) {
            if (e.target.checked) {
                map.addLayer(mapLayers[layerKey]);
                // Kirim layer boundary ke belakang
                if (layerConfig[layerKey].isBoundary) {
                    mapLayers[layerKey].bringToBack();
                }
            } else {
                map.removeLayer(mapLayers[layerKey]);
            }
            infoLegend.update();
        }
    });
});

// Event listener untuk toggle label nama kecamatan/kelurahan - DIPERBAIKI
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
            const boundaryCheckbox = document.querySelector(`input.layer-toggle[data-layer="${layerKey}"]`);
            if (!e.target.checked && boundaryCheckbox && !boundaryCheckbox.checked) {
                map.removeLayer(mapLayers[layerKey]);
            }
        }
    });
});

        function resetMap() {
            map.setView(centerPoint, 12);
            
            if (mapLayers['ANALYSIS_RESULT']) {
                map.removeLayer(mapLayers['ANALYSIS_RESULT']);
                delete mapLayers['ANALYSIS_RESULT'];
            }
            
            if (mapLayers['CLUSTER_BOUNDARIES']) {
                map.removeLayer(mapLayers['CLUSTER_BOUNDARIES']);
                delete mapLayers['CLUSTER_BOUNDARIES'];
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
            
            // Reset mask toggle - aktifkan kembali
            const maskToggle = document.getElementById('surabaya-mask-toggle');
            if (maskToggle) {
                maskToggle.checked = true;
                if (mapLayers['SURABAYA_MASK'] && !map.hasLayer(mapLayers['SURABAYA_MASK'])) {
                    map.addLayer(mapLayers['SURABAYA_MASK']);
                    mapLayers['SURABAYA_MASK'].bringToBack();
                }
            }
            
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
        // FUNGSI PRINT MAP KE PDF - METODE ALTERNATIF LEBIH RELIABLE
        // ============================================================
        
        // Inisialisasi screenshoter plugin
        let screenshoter = null;
        
        function initScreenshoter() {
            if (!screenshoter && window.SimpleMapScreenshoter) {
                screenshoter = new SimpleMapScreenshoter({
                    hideElementsWithSelectors: [
                        '.leaflet-control-container',
                        '.leaflet-popup',
                        '#filter-sidebar',
                        '#toggle-btn',
                        '.print-section'
                    ]
                }).addTo(map);
            }
        }
        
        function printMap(size) {
            const loadingOverlay = document.getElementById('loading-overlay');
            
            // Tampilkan loading
            if (loadingOverlay) {
                loadingOverlay.style.display = 'flex';
                loadingOverlay.innerHTML = 'Mempersiapkan export PDF...';
            }
            
            // Simpan state peta saat ini
            const currentZoom = map.getZoom();
            const currentCenter = map.getCenter();
            
            // Tentukan bounds Surabaya untuk fokus export
            let surabayaBoundsForExport = null;
            if (geoJsonStore['KECAMATAN']) {
                const kecamatanFeatures = geoJsonStore['KECAMATAN'].features;
                let minLat = Infinity, maxLat = -Infinity;
                let minLng = Infinity, maxLng = -Infinity;
                
                kecamatanFeatures.forEach(feature => {
                    const coords = feature.geometry.coordinates;
                    const flattenCoords = (coordArray) => {
                        coordArray.forEach(item => {
                            if (Array.isArray(item[0])) {
                                flattenCoords(item);
                            } else {
                                const [lng, lat] = item;
                                minLat = Math.min(minLat, lat);
                                maxLat = Math.max(maxLat, lat);
                                minLng = Math.min(minLng, lng);
                                maxLng = Math.max(maxLng, lng);
                            }
                        });
                    };
                    flattenCoords(coords);
                });
                
                surabayaBoundsForExport = [[minLat, minLng], [maxLat, maxLng]];
            }

            // Atur ukuran dan orientasi
            let width, height, orientation;
            switch(size) {
                case 'a4portrait':
                    width = 1587;  // A4 at 192 DPI for better quality
                    height = 2245;
                    orientation = 'portrait';
                    break;
                case 'a4landscape':
                    width = 2245;
                    height = 1587;
                    orientation = 'landscape';
                    break;
                case 'current':
                default:
                    width = 1600;
                    height = 1200;
                    orientation = width > height ? 'landscape' : 'portrait';
                    break;
            }

            // Fit bounds ke Surabaya
            const padding = size === 'a4portrait' ? [80, 80] : [60, 60];
            if (surabayaBoundsForExport) {
                map.fitBounds(surabayaBoundsForExport, {
                    padding: padding,
                    animate: false
                });
            }
            
            // Tutup popup
            map.closePopup();
            
            if (loadingOverlay) {
                loadingOverlay.innerHTML = 'Mengambil screenshot peta...';
            }
            
            // Gunakan dom-to-image sebagai fallback yang lebih reliable
            setTimeout(() => {
                const mapContainer = document.getElementById('map');
                
                domtoimage.toPng(mapContainer, {
                    width: width,
                    height: height,
                    style: {
                        'transform': 'scale(1)',
                        'transform-origin': 'top left'
                    },
                    filter: function(node) {
                        // Filter out unwanted elements
                        if (node.id === 'filter-sidebar' || 
                            node.id === 'toggle-btn' || 
                            node.className && node.className.includes('print-section') ||
                            node.className && node.className.includes('leaflet-control')) {
                            return false;
                        }
                        return true;
                    }
                })
                .then(function(dataUrl) {
                    if (loadingOverlay) {
                        loadingOverlay.innerHTML = 'Membuat PDF...';
                    }
                    
                    // Buat PDF
                    const { jsPDF } = window.jspdf;
                    const pdf = new jsPDF({
                        orientation: orientation,
                        unit: 'mm',
                        format: 'a4',
                        compress: true
                    });

                    const pdfWidth = pdf.internal.pageSize.getWidth();
                    const pdfHeight = pdf.internal.pageSize.getHeight();
                    
                    // Hitung area untuk map
                    const headerHeight = 15;
                    const footerHeight = 10;
                    const mapMargin = 3;
                    
                    const mapAreaY = headerHeight;
                    const mapAreaHeight = pdfHeight - headerHeight - footerHeight;
                    
                    // Tambahkan image map
                    pdf.addImage(dataUrl, 'PNG', mapMargin, mapAreaY, 
                                pdfWidth - (mapMargin * 2), mapAreaHeight);

                    // Header dengan background
                    pdf.setFillColor(51, 65, 85);
                    pdf.rect(0, 0, pdfWidth, headerHeight - 2, 'F');
                    
                    pdf.setFontSize(14);
                    pdf.setTextColor(255, 255, 255);
                    pdf.setFont(undefined, 'bold');
                    pdf.text('PETA PEMBANGUNAN KOTA SURABAYA', pdfWidth / 2, 9, { align: 'center' });

                    // Footer dengan border
                    pdf.setDrawColor(200, 200, 200);
                    pdf.line(mapMargin, pdfHeight - footerHeight, pdfWidth - mapMargin, pdfHeight - footerHeight);
                    
                    pdf.setFontSize(8);
                    pdf.setTextColor(100);
                    pdf.setFont(undefined, 'normal');
                    const timestamp = new Date().toLocaleString('id-ID', {
                        dateStyle: 'long',
                        timeStyle: 'short'
                    });
                    pdf.text('SIDAPETA SBY', mapMargin + 2, pdfHeight - 4);
                    pdf.text(timestamp, pdfWidth - mapMargin - 2, pdfHeight - 4, { align: 'right' });
                    
                    // Info layer aktif
                    pdf.setFontSize(7);
                    pdf.setTextColor(80);
                    let layerInfo = 'Layer: ';
                    const activeLayers = [];
                    Object.keys(layerConfig).forEach(key => {
                        if (!layerConfig[key].isBoundary && mapLayers[key] && map.hasLayer(mapLayers[key])) {
                            activeLayers.push(layerConfig[key].label);
                        }
                    });
                    layerInfo += activeLayers.length > 0 ? activeLayers.join(', ') : 'Tidak ada';
                    pdf.text(layerInfo, pdfWidth / 2, pdfHeight - 4, { align: 'center' });

                    // Download
                    const dateStr = new Date().toISOString().split('T')[0];
                    pdf.save(`Peta_Surabaya_${size}_${dateStr}.pdf`);

                    // Restore state
                    map.setView(currentCenter, currentZoom, { animate: false });
                    
                    if (loadingOverlay) {
                        loadingOverlay.style.display = 'none';
                        loadingOverlay.innerHTML = 'Sedang memuat data peta...';
                    }
                })
                .catch(function(error) {
                    console.error('Error exporting map:', error);
                    alert('Gagal mengexport peta. Silakan coba lagi.\nError: ' + error.message);
                    
                    // Restore state
                    map.setView(currentCenter, currentZoom, { animate: false });
                    
                    if (loadingOverlay) {
                        loadingOverlay.style.display = 'none';
                        loadingOverlay.innerHTML = 'Sedang memuat data peta...';
                    }
                });
            }, 1500); // Delay untuk memastikan render selesai
        }

        initMapData();
  </script>
</body>
</html>