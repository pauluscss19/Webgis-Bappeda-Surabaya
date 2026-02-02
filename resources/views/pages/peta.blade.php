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
        overflow: hidden; /* Penting agar sidebar tidak keluar kotak */
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        background: #fff;
        position: relative; /* Container relatif untuk sidebar absolut */
        height: 85vh; /* Tinggi peta menyesuaikan layar (85% tinggi layar) */
        min-height: 600px;
    }

    /* PETA FILL CONTAINER */
    #map {
        height: 100%; width: 100%; z-index: 1;
    }

    /* --- SIDEBAR FILTER (FLOATING) --- */
    #filter-sidebar {
        position: absolute;
        top: 10px; left: 10px; bottom: 10px; /* Jarak dari tepi */
        width: 300px;
        background: rgba(255, 255, 255, 0.95); /* Sedikit transparan */
        backdrop-filter: blur(5px);
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        z-index: 2000; /* Di atas Leaflet (biasanya 400-1000) */
        display: flex;
        flex-direction: column;
        transition: transform 0.3s ease-in-out;
        transform: translateX(0); /* Default muncul */
    }

    /* KELAS UNTUK MENYEMBUNYIKAN SIDEBAR */
    #filter-sidebar.hidden {
        transform: translateX(-340px); /* Geser ke kiri sampai hilang */
    }

    /* HEADER SIDEBAR */
    .sidebar-header {
        padding: 15px 20px;
        border-bottom: 1px solid #eee;
        display: flex; justify-content: space-between; align-items: center;
        background: #f8fafc;
        border-radius: 12px 12px 0 0;
    }

    /* CONTENT SIDEBAR (SCROLLABLE) */
    .sidebar-content {
        flex: 1; /* Mengisi sisa ruang */
        overflow-y: auto; /* SCROLL DI SINI */
        padding: 15px;
    }
    
    /* Scrollbar cantik */
    .sidebar-content::-webkit-scrollbar { width: 6px; }
    .sidebar-content::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }

    /* FOOTER SIDEBAR (TOMBOL RESET) */
    .sidebar-footer {
        padding: 15px;
        border-top: 1px solid #eee;
        background: #fff;
        border-radius: 0 0 12px 12px;
    }

    /* --- TOMBOL TOGGLE (BUKA/TUTUP) --- */
    #toggle-btn {
        position: absolute;
        top: 20px; left: 20px;
        z-index: 2001; /* Di atas sidebar */
        background: #3b82f6; color: white;
        border: none; padding: 10px 14px;
        border-radius: 8px; cursor: pointer;
        box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        transition: all 0.3s;
        display: none; /* Default hidden, muncul via JS kalau sidebar hide */
    }
    #toggle-btn:hover { background: #2563eb; transform: scale(1.05); }

    /* Tombol Close di dalam header */
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

    /* --- LEGEND STATISTIK (DI POJOK KIRI BAWAH) --- */
    .info-legend {
        padding: 10px 15px; font: 13px Arial; background: rgba(255,255,255,0.9);
        box-shadow: 0 0 15px rgba(0,0,0,0.2); border-radius: 8px; min-width: 160px;
    }
    .info-legend h4 { margin: 0 0 8px; border-bottom: 1px solid #ccc; padding-bottom: 5px; font-size:14px; }
    .legend-item { display: flex; justify-content: space-between; margin-bottom: 4px; }
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
                <h5 style="margin:0; font-weight:700; color:#334155;"><i class="bi bi-layers-fill me-2"></i> Layer Data</h5>
                <button class="close-btn" onclick="toggleSidebar()"><i class="bi bi-x-lg"></i></button>
            </div>
            
            <div class="sidebar-content">
                <div style="font-size:12px; color:#64748b; margin-bottom:15px;">
                    Centang layer untuk menampilkan data.
                </div>

                <label class="layer-item">
                    <input type="checkbox" class="layer-toggle me-2" data-layer="CCTV_EKSISTING" checked>
                    <span class="layer-color" style="background: #ef4444;"></span>
                    <span style="font-size:14px;">CCTV Eksisting</span>
                </label>

                <label class="layer-item">
                    <input type="checkbox" class="layer-toggle me-2" data-layer="TITIK_SAMPAH" checked>
                    <span class="layer-color" style="background: #facc15;"></span>
                    <span style="font-size:14px;">Titik Sampah</span>
                </label>

                <label class="layer-item">
                    <input type="checkbox" class="layer-toggle me-2" data-layer="CCTV_RENCANA" checked>
                    <span class="layer-color" style="background: #22c55e;"></span>
                    <span style="font-size:14px;">CCTV Rencana</span>
                </label>

                <label class="layer-item">
                    <input type="checkbox" class="layer-toggle me-2" data-layer="TITIK_SAMPAH_RENCANA" checked>
                    <span class="layer-color" style="background: #f97316;"></span>
                    <span style="font-size:14px;">Sampah Rencana</span>
                </label>

                <label class="layer-item">
                    <input type="checkbox" class="layer-toggle me-2" data-layer="DAMKAR" checked>
                    <span class="layer-color" style="background: #ec4899;"></span>
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
        // Tips: Anda bisa tambahkan 'locationField' manual jika tahu nama kolom alamatnya
        const layerConfig = {
            'CCTV_EKSISTING': { file: 'CCTV_EKSISTING.geojson', color: '#ef4444', label: 'CCTV Eksisting' },
            'TITIK_SAMPAH': { 
                file: 'TITIK_SAMPAH.geojson', 
                color: '#facc15', 
                label: 'Titik Sampah',
                // Script akan otomatis cari 'Jalan'/'Alamat', tapi kalau masih gagal,
                // isi nama kolom alamat di sini, misal: locationField: 'Alamat_Lengkap'
            },
            'CCTV_RENCANA': { file: 'CCTV_RENCANA.geojson', color: '#22c55e', label: 'CCTV Rencana' },
            'TITIK_SAMPAH_RENCANA': { file: 'TITIK_SAMPAH_RENCANA.geojson', color: '#f97316', label: 'Sampah Rencana' },
            'DAMKAR': { file: 'Damkar.geojson', color: '#ec4899', label: 'Pos Damkar', nameField: 'Pos_Ekst' },
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
            if (!hasActiveLayer) html += '<div style="color:#777; font-size:11px;">Tidak ada layer aktif</div>';
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

                const defaultStyle = { color: config.color, weight: 2, opacity: 1, fillOpacity: 0.5 };

                const layer = L.geoJSON(data, {
                    pointToLayer: (feature, latlng) => {
                        return L.circleMarker(latlng, {
                            radius: 6, fillColor: config.color, fillOpacity: 1.0, stroke: false
                        });
                    },
                    style: (feature) => defaultStyle,
                    
                    // --- REVISI DETEKSI LOKASI/JALAN ---
                    onEachFeature: (feature, layer) => {
                        const props = feature.properties; 
                        
                        // 1. Cari Nama (Otomatis cek Name/Nama/Pos_Ekst/dll)
                        const nameKey = config.nameField || Object.keys(props).find(k => /name|nama|pos/i.test(k)) || 'Name';
                        const nameVal = props[nameKey] || '-';

                        // 2. Cari Jalan/Lokasi (Otomatis cek Jalan/Alamat/Lokasi)
                        // Prioritas: Config -> Kolom 'Jalan' -> Kolom 'Alamat' -> Kolom 'Lokasi'
                        let lokasiVal = null;
                        if (config.locationField && props[config.locationField]) {
                            lokasiVal = props[config.locationField];
                        } else {
                            // Cari key yang mengandung kata jalan/alamat/lokasi
                            const locationKey = Object.keys(props).find(k => /jalan|alamat|lokasi/i.test(k));
                            if (locationKey) lokasiVal = props[locationKey];
                        }

                        // 3. Cari Kecamatan
                        const kecKey = Object.keys(props).find(k => /kecamatan|kec/i.test(k));
                        const kecVal = kecKey ? props[kecKey] : null;

                        // 4. Susun Popup
                        let detailHtml = '';

                        // Tampilkan Jalan/Lokasi (Pin Merah)
                        if (lokasiVal) {
                            detailHtml += `
                            <div style="display:flex; align-items:start; margin-bottom:6px; color:#334155;">
                                <i class="bi bi-geo-alt-fill" style="font-size:14px; margin-right:8px; color:#ef4444; width:15px; margin-top:2px;"></i>
                                <span style="line-height:1.4;">${lokasiVal}</span>
                            </div>`;
                        } else {
                            // Pesan default jika tidak ditemukan (bisa dihapus kalau mau hidden)
                            // detailHtml += `<div style="font-size:11px; color:#999; margin-bottom:5px;">Lokasi tidak tersedia</div>`;
                        }

                        // Tampilkan Kecamatan (Peta Biru)
                        if (kecVal) {
                            detailHtml += `
                            <div style="display:flex; align-items:start; margin-bottom:6px; color:#334155;">
                                <i class="bi bi-map-fill" style="font-size:14px; margin-right:8px; color:#3b82f6; width:15px; margin-top:2px;"></i>
                                <span>${kecVal}</span>
                            </div>`;
                        }
                        
                        // Tampilkan Jenis/Keterangan (Tag Abu)
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
            document.querySelectorAll('.layer-toggle').forEach(cb => {
                cb.checked = false; 
                const key = cb.dataset.layer;
                if (mapLayers[key] && map.hasLayer(mapLayers[key])) map.removeLayer(mapLayers[key]);
            });
            if (!map.hasLayer(defaultLayer)) {
                map.addLayer(defaultLayer); map.removeLayer(satelliteLayer);
            }
            infoLegend.update();
        }

        initMapData();
  </script>
</body>
</html>