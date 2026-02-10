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
                    
                    <button class="btn-analysis" onclick="runHeatmapAnalysis()" style="margin-top: 8px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <i class="bi bi-map-fill me-1"></i> Analisis Heatmap
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
                    <input type="checkbox" class="layer-toggle me-2" data-layer="CCTV_EKSISTING">
                    <span class="layer-color" style="background: #B153D7;"></span>
                    <span style="font-size:14px;">CCTV Eksisting</span>
                </label>

                <label class="layer-item">
                    <input type="checkbox" class="layer-toggle me-2" data-layer="TITIK_SAMPAH">
                    <span class="layer-color" style="background: #facc15;"></span>
                    <span style="font-size:14px;">Titik Sampah</span>
                </label>

                <label class="layer-item">
                    <input type="checkbox" class="layer-toggle me-2" data-layer="CCTV_RENCANA">
                    <span class="layer-color" style="background: #f97316;"></span>
                    <span style="font-size:14px;">CCTV Rencana</span>
                </label>

                <label class="layer-item">
                    <input type="checkbox" class="layer-toggle me-2" data-layer="TITIK_SAMPAH_RENCANA">
                    <span class="layer-color" style="background: #22c55e;"></span>
                    <span style="font-size:14px;">Sampah Rencana</span>
                </label>

                <label class="layer-item">
                    <input type="checkbox" class="layer-toggle me-2" data-layer="DAMKAR">
                    <span class="layer-color" style="background: #FF0000;"></span>
                    <span style="font-size:14px;">Pos Damkar</span>
                </label>

                <label class="layer-item">
                    <input type="checkbox" class="layer-toggle me-2" data-layer="MAKAM">
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

        <!-- Loading Overlay -->
        <div id="loading-overlay" style="display:none; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(255,255,255,0.95); z-index: 3000; display: flex; align-items: center; justify-content: center; border-radius: 8px;">
            <div style="text-align: center;">
                <div style="width: 50px; height: 50px; border: 5px solid #e2e8f0; border-top: 5px solid #3b82f6; border-radius: 50%; animation: spin 1s linear infinite; margin: 0 auto 15px;"></div>
                <div style="font-weight: 600; color: #334155; font-size: 15px;">Sedang memuat data peta...</div>
            </div>
        </div>
        
        <style>
            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
        </style>

        <div id="map"></div>

        <!-- Legend untuk Heatmap -->
        <div id="heatmap-legend" style="display:none; position: absolute; bottom: 110px; left: 20px; background: white; padding: 15px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.2); z-index: 1000; min-width: 200px;">
            <div style="font-weight: 700; font-size: 13px; color: #334155; margin-bottom: 10px;">
                <i class="bi bi-thermometer-half"></i> Intensitas Nilai
            </div>
            <div id="legend-gradient" style="height: 20px; background: linear-gradient(to right, #ffe0e0, #ff4d4d, #cc0000, #800000); border-radius: 4px; margin-bottom: 8px;"></div>
            <div style="display: flex; justify-content: space-between; font-size: 11px; color: #64748b;">
                <span>Rendah</span>
                <span>Sedang</span>
                <span>Tinggi</span>
            </div>
            <div id="legend-values" style="margin-top: 10px; font-size: 11px; color: #475569;">
            </div>
        </div>

        <!-- SECTION PRINT PDF -->
        <div class="print-section">
            <div class="print-title">
                <i class="bi bi-printer-fill"></i>
                Export Peta PDF
            </div>
            <div class="print-buttons">
                <button class="btn-print" onclick="printMap()">
                    <i class="bi bi-file-earmark-pdf-fill"></i>
                    Export PDF Landscape
                </button>
            </div>
            <div style="margin-top: 10px; font-size: 11px; color: #64748b; line-height: 1.4;">
                <i class="bi bi-info-circle"></i> PDF akan di-export dalam format A4 Landscape dengan gambar peta penuh 1 halaman.
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

  <!-- Load external JS file -->
  <script>
    // Pass asset URL to external JS
    window.ASSET_BASE_URL = "{{ asset('') }}";
  </script>
  <script src="{{ asset('js/peta.js') }}"></script>

</body>
</html>