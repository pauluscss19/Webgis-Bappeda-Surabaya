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
    /* Style untuk dropdown accordion */
    .layer-group {
        margin-bottom: 10px;
    }

    .layer-group-header {
        background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%);
        color: white;
        padding: 10px 12px;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        font-size: 13px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: all 0.3s ease;
        margin-bottom: 8px;
    }

    .layer-group-header:hover {
        transform: translateX(2px);
        box-shadow: 0 2px 8px rgba(30, 64, 175, 0.3);
    }

    .layer-group-header i.toggle-icon {
        transition: transform 0.3s ease;
    }

    .layer-group-header.active i.toggle-icon {
        transform: rotate(180deg);
    }

    .layer-group-content {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
        padding-left: 12px;
    }

    .layer-group-content.active {
        max-height: 1000px;
        margin-bottom: 10px;
    }

    .layer-group-infrastruktur .layer-group-header {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    }

    .layer-group-pendidikan .layer-group-header {
        background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
    }

    .layer-group-persampahan .layer-group-header {
        background: linear-gradient(135deg, #059669 0%, #10b981 100%);
    }

    .layer-group-fasilitas .layer-group-header {
        background: linear-gradient(135deg, #64748b 0%, #475569 100%);
    }

    .layer-group-demografi .layer-group-header {
        background: linear-gradient(135deg, #334155 0%, #1e293b 100%);
    }

    .layer-group-batas .layer-group-header {
        background: linear-gradient(135deg, #94a3b8 0%, #cbd5e1 100%);
        color: #334155;
    }

    .layer-group-pompa-saluran .layer-group-header {
        background: linear-gradient(135deg, #0d9488 0%, #0f766e 100%);
    }

    /* ============================================================
       CSS UNTUK LABEL NAMA RW
       ============================================================ */

    .rw-label {
        background: rgba(20, 184, 166, 0.9) !important;
        border: 2px solid #ffffff !important;
        border-radius: 6px !important;
        padding: 4px 10px !important;
        font-weight: 700 !important;
        font-size: 11px !important;
        color: #ffffff !important;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5) !important;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3) !important;
        white-space: nowrap !important;
        pointer-events: none !important;
        font-family: 'Arial', sans-serif !important;
        letter-spacing: 0.5px !important;
    }

    .rw-label:before {
        display: none !important;
    }

    /* Hover effect untuk polygon RW */
    .leaflet-interactive:hover {
        stroke-width: 3 !important;
        stroke-opacity: 1 !important;
    }

    /* Animasi smooth untuk label */
    .leaflet-zoom-animated .rw-label {
        transition: all 0.2s ease;
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
                                <input type="checkbox" class="analysis-source" value="DAMKAR"> Pos Damkar
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
                            <label class="checkbox-item">
                                <input type="checkbox" class="analysis-source" value="TPS3R"> TPS3R
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" class="analysis-source" value="TPS"> TPS
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" class="analysis-source" value="RUKOM"> Rumah Kompos
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" class="analysis-source" value="DEKORASI_KOTA"> Dekorasi Kota
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" class="analysis-source" value="POINT_RUTE_SAMPAH"> Titik Rute Sampah
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Target Rekomendasi (Titik):</label>
                        <input type="number" id="cluster-count" class="form-control" value="3" min="1" max="10">
                    </div>

                    <!-- Tombol Hitung Rekomendasi + Help -->
                   <div class="btn-help-wrap">
                        <button class="btn-analysis" onclick="runClustering()">
                            Hitung Rekomendasi
                        </button>
                        <button class="help-btn help-btn-rec" onclick="showHelp('rec')" title="Info Analisis Rekomendasi">?</button>
                    </div>

                    <div class="btn-help-wrap" style="margin-top: 15px;">
                        <button class="btn-analysis" onclick="runHeatmapAnalysis()" style="background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%);">
                            Analisis Heatmap
                        </button>
                        <button class="help-btn help-btn-heat" onclick="showHelp('heat')" title="Info Analisis Heatmap">?</button>
                    </div>

                    <div class="help-popup-overlay" id="help-popup-rec" onclick="closeHelpIfOutside(event,'rec')">
                        <div class="help-popup">
                            <div class="help-popup-header">
                                <div>
                                    <div class="help-popup-title">Rekomendasi Lokasi</div>
                                    <div class="help-popup-subtitle">Metode K-Means Clustering</div>
                                </div>
                                <button class="help-popup-close" onclick="closeHelp('rec')">&times;</button>
                            </div>
                            <div class="help-popup-body">
                                <div class="help-section">
                                    <div class="help-section-title help-section-title-rec">Definisi</div>
                                    <p>Mencari titik lokasi baru yang paling strategis berdasarkan sebaran data yang dipilih.</p>
                                </div>
                                <div class="help-section">
                                    <div class="help-section-title help-section-title-rec">Cara Kerja</div>
                                    <p>Sistem mengelompokkan data yang berdekatan, lalu menentukan lokasi terbaik berdasarkan jumlah titik terbanyak dan jarak terdekat.</p>
                                </div>
                                <div class="help-section">
                                    <div class="help-section-title help-section-title-rec">Kegunaan</div>
                                    <div class="help-example help-example-rec">
                                        Membantu penentuan lokasi optimal untuk membangun fasilitas baru (seperti TPS atau CCTV) di area yang padat namun belum terjangkau.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="help-popup-overlay" id="help-popup-heat" onclick="closeHelpIfOutside(event,'heat')">
                        <div class="help-popup">
                            <div class="help-popup-header">
                                <div>
                                    <div class="help-popup-title">Heatmap Kelurahan</div>
                                    <div class="help-popup-subtitle">Pemetaan Kepadatan Data</div>
                                </div>
                                <button class="help-popup-close" onclick="closeHelp('heat')">&times;</button>
                            </div>
                            <div class="help-popup-body">
                                <div class="help-section">
                                    <div class="help-section-title help-section-title-heat">Definisi</div>
                                    <p>Menampilkan visualisasi tingkat kepadatan data di setiap wilayah kelurahan.</p>
                                </div>
                                <div class="help-section">
                                    <div class="help-section-title help-section-title-heat">Cara Kerja</div>
                                    <p>Area kelurahan akan diwarnai berdasarkan jumlah data. Warna gelap berarti padat (banyak data), sedangkan warna terang berarti sepi (sedikit data).</p>
                                </div>
                                <div class="help-section">
                                    <div class="help-section-title help-section-title-heat">Kegunaan</div>
                                    <div class="help-example help-example-heat">
                                        Memantau pemerataan fasilitas dan mengidentifikasi kelurahan mana saja yang masih kekurangan infrastruktur.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="analysis-result" style="font-size: 11px; color: #0c4a6e; margin-top: 8px; display: none;">
                    </div>
                </div>

                <hr style="border-top:1px dashed #cbd5e1; margin: 15px 0;">

                <!-- SECTION LAYERS DENGAN DROPDOWN -->
                <div style="font-size:12px; font-weight:700; color:#64748b; margin-bottom:10px;">
                    <i class="bi bi-stack"></i> LAYER DATA
                </div>

                <!-- GROUP 1: INFRASTRUKTUR -->
                <div class="layer-group layer-group-infrastruktur">
                    <div class="layer-group-header" onclick="toggleLayerGroup(this)">
                        <span><i class="bi bi-broadcast-pin"></i> Infrastruktur</span>
                        <i class="bi bi-chevron-down toggle-icon"></i>
                    </div>
                    <div class="layer-group-content">
                        <label class="layer-item">
                            <input type="checkbox" class="layer-toggle me-2" data-layer="CCTV_EKSISTING">
                            <span class="layer-color" style="background: #B153D7;"></span>
                            <span style="font-size:14px;">CCTV Eksisting</span>
                        </label>
                        <label class="layer-item">
                            <input type="checkbox" class="layer-toggle me-2" data-layer="CCTV_RENCANA">
                            <span class="layer-color" style="background: #f97316;"></span>
                            <span style="font-size:14px;">CCTV Rencana</span>
                        </label>
                        <label class="layer-item">
                            <input type="checkbox" class="layer-toggle me-2" data-layer="DAMKAR">
                            <span class="layer-color" style="background: #FF0000;"></span>
                            <span style="font-size:14px;">Pos Damkar</span>
                        </label>
                    </div>
                </div>

                <!-- GROUP 2: PENDIDIKAN -->
                <div class="layer-group layer-group-pendidikan">
                    <div class="layer-group-header" onclick="toggleLayerGroup(this)">
                        <span><i class="bi bi-mortarboard-fill"></i> Pendidikan</span>
                        <i class="bi bi-chevron-down toggle-icon"></i>
                    </div>
                    <div class="layer-group-content">
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
                    </div>
                </div>

                <!-- GROUP 3: PERSAMPAHAN & LINGKUNGAN -->
                <div class="layer-group layer-group-persampahan">
                    <div class="layer-group-header" onclick="toggleLayerGroup(this)">
                        <span><i class="bi bi-recycle"></i> Persampahan & Lingkungan</span>
                        <i class="bi bi-chevron-down toggle-icon"></i>
                    </div>
                    <div class="layer-group-content">
                        <label class="layer-item">
                            <input type="checkbox" class="layer-toggle me-2" data-layer="TPS3R">
                            <span class="layer-color" style="background: #10b981;"></span>
                            <span style="font-size:14px;">TPS3R</span>
                        </label>
                        <label class="layer-item">
                            <input type="checkbox" class="layer-toggle me-2" data-layer="TPS">
                            <span class="layer-color" style="background: #f59e0b;"></span>
                            <span style="font-size:14px;">TPS</span>
                        </label>
                        <label class="layer-item">
                            <input type="checkbox" class="layer-toggle me-2" data-layer="RUTE_SAMPAH">
                            <span class="layer-color" style="background: #8b5cf6; width: 20px; height: 3px;"></span>
                            <span style="font-size:14px;">Rute Pengangkutan Sampah</span>
                        </label>
                        <label class="layer-item">
                            <input type="checkbox" class="layer-toggle me-2" data-layer="POINT_RUTE_SAMPAH">
                            <span class="layer-color" style="background: #ec4899;"></span>
                            <span style="font-size:14px;">Titik Rute Sampah</span>
                        </label>
                        <label class="layer-item">
                            <input type="checkbox" class="layer-toggle me-2" data-layer="TITIK_SAMPAH">
                            <span class="layer-color" style="background: #facc15;"></span>
                            <span style="font-size:14px;">Titik Sampah</span>
                        </label>
                        <label class="layer-item">
                            <input type="checkbox" class="layer-toggle me-2" data-layer="TITIK_SAMPAH_RENCANA">
                            <span class="layer-color" style="background: #22c55e;"></span>
                            <span style="font-size:14px;">Sampah Rencana</span>
                        </label>
                        <label class="layer-item">
                            <input type="checkbox" class="layer-toggle me-2" data-layer="MAKAM">
                            <span class="layer-color" style="background: #3b82f6;"></span>
                            <span style="font-size:14px;">Makam</span>
                        </label>
                        <label class="layer-item">
                            <input type="checkbox" class="layer-toggle me-2" data-layer="RUKOM">
                            <span class="layer-color" style="background: #06b6d4;"></span>
                            <span style="font-size:14px;">Rumah Kompos</span>
                        </label>
                    </div>
                </div>

                <!-- GROUP 4: FASILITAS UMUM -->
                <div class="layer-group layer-group-fasilitas">
                    <div class="layer-group-header" onclick="toggleLayerGroup(this)">
                        <span><i class="bi bi-buildings-fill"></i> Fasilitas Umum</span>
                        <i class="bi bi-chevron-down toggle-icon"></i>
                    </div>
                    <div class="layer-group-content">
                        <label class="layer-item">
                            <input type="checkbox" class="layer-toggle me-2" data-layer="DEKORASI_KOTA">
                            <span class="layer-color" style="background: #f97316;"></span>
                            <span style="font-size:14px;">Dekorasi Kota</span>
                        </label>
                    </div>
                </div>

                <!-- GROUP 5: DEMOGRAFI -->
                <div class="layer-group layer-group-demografi">
                    <div class="layer-group-header" onclick="toggleLayerGroup(this)">
                        <span><i class="bi bi-people-fill"></i> Demografi</span>
                        <i class="bi bi-chevron-down toggle-icon"></i>
                    </div>
                    <div class="layer-group-content">
                        <label class="layer-item">
                            <input type="checkbox" class="layer-toggle me-2" data-layer="KEPADATAN_PENDUDUK">
                            <span class="layer-color" style="background: transparent; border: 2px solid #8b5cf6;"></span>
                            <span style="font-size:14px;">Kepadatan Penduduk</span>
                        </label>
                    </div>
                </div>

                <!-- GROUP: POMPA & SALURAN AIR -->
                <div class="layer-group layer-group-pompa-saluran">
                    <div class="layer-group-header" onclick="toggleLayerGroup(this)">
                        <span><i class="bi bi-droplet-fill"></i> Pompa & Saluran Air</span>
                        <i class="bi bi-chevron-down toggle-icon"></i>
                    </div>
                    <div class="layer-group-content">
                        <label class="layer-item">
                            <input type="checkbox" class="layer-toggle me-2" data-layer="AREA_RAYON">
                            <span class="layer-color" style="background: #0d9488;"></span>
                            <span style="font-size:14px;">Area Rayon</span>
                        </label>
                        <label class="layer-item">
                            <input type="checkbox" class="layer-toggle me-2" data-layer="POMPA_AIR_7_RAYON">
                            <span class="layer-color" style="background: #0891b2;"></span>
                            <span style="font-size:14px;">Area Pompa Air 7 Rayon</span>
                        </label>
                        <label class="layer-item">
                            <input type="checkbox" class="layer-toggle me-2" data-layer="JARINGAN_PIPA_SALURAN">
                            <span class="layer-color" style="background: #0284c7; width: 20px; height: 3px;"></span>
                            <span style="font-size:14px;">Jaringan Pipa & Saluran Air</span>
                        </label>
                        <label class="layer-item">
                            <input type="checkbox" class="layer-toggle me-2" data-layer="TITIK_POMPA_AIR">
                            <span class="layer-color" style="background: #0369a1;"></span>
                            <span style="font-size:14px;">Titik Lokasi Pompa Air</span>
                        </label>
                        <label class="layer-item">
                            <input type="checkbox" class="layer-toggle me-2" data-layer="SALURAN_AIR">
                            <span class="layer-color" style="background: #0e7490;"></span>
                            <span style="font-size:14px;">Saluran Air</span>
                        </label>
                    </div>
                </div>

                <hr style="border-top:1px dashed #cbd5e1; margin: 15px 0;">

                <!-- GROUP 6: BATAS WILAYAH -->
                <div class="layer-group layer-group-batas">
                    <div class="layer-group-header" onclick="toggleLayerGroup(this)">
                        <span><i class="bi bi-geo-alt-fill"></i> Batas Wilayah</span>
                        <i class="bi bi-chevron-down toggle-icon"></i>
                    </div>
                    <div class="layer-group-content">
                        <label class="layer-item">
                            <input type="checkbox" class="layer-toggle me-2" data-layer="KECAMATAN">
                            <span class="layer-color" style="background: transparent; border: 2px solid #6366f1;"></span>
                            <span style="font-size:14px;">Batas Kecamatan</span>
                        </label>
                        <label class="layer-item">
                            <input type="checkbox" class="layer-label-toggle me-2" data-layer="KECAMATAN">
                            <span class="layer-color" style="background: transparent; border: 2px solid #6366f1;"></span>
                            <span style="font-size:14px;">Label Kecamatan</span>
                        </label>
                        <label class="layer-item">
                            <input type="checkbox" class="layer-toggle me-2" data-layer="KELURAHAN">
                            <span class="layer-color" style="background: transparent; border: 2px solid #f59e0b;"></span>
                            <span style="font-size:14px;">Batas Kelurahan</span>
                        </label>
                        <label class="layer-item">
                            <input type="checkbox" class="layer-label-toggle me-2" data-layer="KELURAHAN">
                            <span class="layer-color" style="background: transparent; border: 2px solid #f59e0b;"></span>
                            <span style="font-size:14px;">Label Kelurahan</span>
                        </label>
                        <label class="layer-item">
                            <input type="checkbox" class="layer-toggle me-2" data-layer="BATAS_RW">
                            <span class="layer-color" style="background: transparent; border: 2px solid #06b6d4;"></span>
                            <span style="font-size:14px;">Batas RW</span>
                        </label>
                        <label class="layer-item">
                            <input type="checkbox" class="layer-label-toggle me-2" data-layer="BATAS_RW">
                            <span class="layer-color" style="background: transparent; border: 2px solid #06b6d4;"></span>
                            <span style="font-size:14px;">Label RW</span>
                        </label>
                        <label class="layer-item">
                            <input type="checkbox" class="mask-toggle me-2" id="surabaya-mask-toggle" checked>
                            <span class="layer-color" style="background: #e2e8f0; border: 2px solid #94a3b8;"></span>
                            <span style="font-size:14px;">Tampilkan Hanya Surabaya</span>
                        </label>
                    </div>
                </div>
                <!-- FILTER WILAYAH -->
                <div class="fw-section">
                    <div class="fw-section-title">
                        <i class="bi bi-funnel-fill"></i> Filter Wilayah
                    </div>
                    <div class="fw-row">
                        <label><i class="bi bi-map"></i> Kecamatan</label>
                        <select id="fw-kecamatan" class="fw-select">
                            <option value="">— Semua Kecamatan —</option>
                        </select>
                    </div>
                    <div class="fw-row">
                        <label><i class="bi bi-geo-alt"></i> Kelurahan</label>
                        <select id="fw-kelurahan" class="fw-select">
                            <option value="">— Semua Kelurahan —</option>
                        </select>
                    </div>
                    <div class="fw-btn-row">
                        <button class="fw-btn-apply" onclick="FilterWilayah.applyFromUI()">
                            <i class="bi bi-check2-circle"></i> Terapkan Filter
                        </button>
                        <button class="fw-btn-reset" onclick="FilterWilayah.clearFilter()" title="Reset filter">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                    <div id="fw-active-badge"></div>
                </div>

            </div>

            <div class="sidebar-footer">
                <button onclick="resetMap()" style="
                    width: 100%; padding: 10px; background: #e2e8f0; color: #334155; 
                    border: none; border-radius: 8px; font-weight: 600; cursor: pointer; transition: 0.2s;">
                    <i class="bi bi-arrow-counterclockwise"></i> Reset Peta
                </button>
            </div>
        </div>

        <!-- Overlay: Memuat Peta (saat refresh) -->
        <div id="loading-overlay" style="display:flex; position:absolute; top:0; left:0; right:0; bottom:0; background:rgba(248,250,252,0.97); z-index:3000; align-items:center; justify-content:center; border-radius:8px;">
            <div style="display:flex; flex-direction:column; align-items:center; gap:16px;">
                <div style="position:relative; width:40px; height:40px;">
                    <div style="position:absolute; inset:0; border-radius:50%; border:3px solid #e2e8f0;"></div>
                    <div style="position:absolute; inset:0; border-radius:50%; border:3px solid transparent; border-top-color:#1e3a8a; animation:_spin 0.9s linear infinite;"></div>
                </div>
                <span style="font-size:13px; font-weight:600; color:#475569; letter-spacing:0.01em;">Memuat peta...</span>
            </div>
        </div>

        <!-- Overlay: Export PDF -->
        <div id="pdf-overlay" style="display:none; position:absolute; top:0; left:0; right:0; bottom:0; background:rgba(15,23,42,0.82); z-index:3001; align-items:center; justify-content:center; border-radius:8px; backdrop-filter:blur(3px);">
            <div style="text-align:center; padding:32px 40px; background:#fff; border-radius:12px; box-shadow:0 16px 40px rgba(0,0,0,0.25); width:280px;">
                <div style="position:relative; width:40px; height:40px; margin:0 auto 18px;">
                    <div style="position:absolute; inset:0; border-radius:50%; border:3px solid #e2e8f0;"></div>
                    <div style="position:absolute; inset:0; border-radius:50%; border:3px solid transparent; border-top-color:#1e3a8a; animation:_spin 0.9s linear infinite;"></div>
                </div>
                <div style="width:100%; height:2px; background:#f1f5f9; border-radius:4px; overflow:hidden; margin-bottom:14px;">
                    <div id="pdf-progress-bar" style="height:100%; width:5%; background:#1e3a8a; border-radius:4px; transition:width 0.6s ease;"></div>
                </div>
                <div style="display:flex; justify-content:center; gap:5px; margin-bottom:12px;">
                    <div id="pdf-step-1" style="width:5px; height:5px; border-radius:50%; background:#1e3a8a; transition:all 0.3s;"></div>
                    <div id="pdf-step-2" style="width:5px; height:5px; border-radius:50%; background:#e2e8f0; transition:all 0.3s;"></div>
                    <div id="pdf-step-3" style="width:5px; height:5px; border-radius:50%; background:#e2e8f0; transition:all 0.3s;"></div>
                    <div id="pdf-step-4" style="width:5px; height:5px; border-radius:50%; background:#e2e8f0; transition:all 0.3s;"></div>
                </div>
                <div id="pdf-loading-text" style="font-size:12px; font-weight:600; color:#334155; transition:opacity 0.2s;">Menyiapkan...</div>
                <div id="pdf-loading-sub" style="font-size:10px; color:#94a3b8; margin-top:3px;"></div>
            </div>
        </div>

        <!-- Overlay: Reset Peta -->
        <div id="reset-overlay" style="display:none; position:absolute; top:0; left:0; right:0; bottom:0; background:rgba(15,23,42,0.6); z-index:3000; align-items:center; justify-content:center; border-radius:8px; backdrop-filter:blur(2px);">
            <div style="display:flex; flex-direction:column; align-items:center; gap:12px; padding:24px 32px; background:#fff; border-radius:10px; box-shadow:0 8px 24px rgba(0,0,0,0.15);">
                <div style="position:relative; width:32px; height:32px;">
                    <div style="position:absolute; inset:0; border-radius:50%; border:2px solid #e2e8f0;"></div>
                    <div style="position:absolute; inset:0; border-radius:50%; border:2px solid transparent; border-top-color:#475569; animation:_spin 0.9s linear infinite;"></div>
                </div>
                <span style="font-size:12px; font-weight:600; color:#475569;">Mereset peta...</span>
            </div>
        </div>

        <style>@keyframes _spin { to { transform:rotate(360deg); } }</style>

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

        <!-- SECTION PRINT PDF & EXPORT EXCEL -->
        <div class="print-section">
            <div class="print-title">
                <i class="bi bi-printer-fill"></i>
                Export Peta & Data
            </div>
            <div class="print-buttons">
                <button class="btn-print" onclick="printMap()">
                    <i class="bi bi-file-earmark-pdf-fill"></i>
                    Export PDF
                </button>
                <button class="btn-print btn-print-excel" onclick="exportMapDataToExcel()">
                    <i class="bi bi-file-earmark-excel-fill"></i>
                    Export Excel
                </button>
            </div>
            <div style="margin-top: 10px; font-size: 11px; color: #64748b; line-height: 1.4;">
                <i class="bi bi-info-circle"></i> PDF: A4 Landscape, skala 1:50.000. <br>
                <i class="bi bi-info-circle"></i> Excel: data layer yang aktif (nama, koordinat, atribut).
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
  <script src="https://cdn.sheetjs.com/xlsx-0.20.1/package/dist/xlsx.full.min.js"></script>

  <!-- Load external JS files in correct order -->
  <script>
    // Pass asset URL to external JS
    window.ASSET_BASE_URL = "{{ asset('') }}";

    // Function to toggle layer group dropdown
    function toggleLayerGroup(header) {
        const content = header.nextElementSibling;
        const isActive = content.classList.contains('active');
        if (isActive) {
            header.classList.remove('active');
            content.classList.remove('active');
        } else {
            header.classList.add('active');
            content.classList.add('active');
        }
    }

    // ── Help Popup ────────────────────────────────────────────
    function showHelp(type) {
        document.getElementById('help-popup-' + type).classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closeHelp(type) {
        document.getElementById('help-popup-' + type).classList.remove('active');
        document.body.style.overflow = '';
    }
    function closeHelpIfOutside(event, type) {
        // Tutup hanya jika klik langsung di overlay (bukan di dalam popup)
        if (event.target === event.currentTarget) closeHelp(type);
    }
    // Tutup dengan tombol Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            ['rec', 'heat'].forEach(function(t) {
                const el = document.getElementById('help-popup-' + t);
                if (el && el.classList.contains('active')) closeHelp(t);
            });
        }
    });
  </script>

  <!-- 1. Config - harus dimuat pertama karena berisi konfigurasi global -->
  <script src="{{ asset('js/config.js') }}"></script>

  <!-- 2. UI - fungsi UI sidebar dan fullscreen -->
  <script src="{{ asset('js/ui.js') }}"></script>

  <!-- 3. Map Init - inisialisasi peta dan kontrol -->
  <script src="{{ asset('js/map-init.js') }}"></script>

  <!-- 4. Layer Loader - fungsi load dan manage layer -->
  <script src="{{ asset('js/layer-loader.js') }}"></script>

  <!-- 5. Event Handlers - event listeners -->
  <script src="{{ asset('js/event-handlers.js') }}"></script>

  <!-- 6. Analysis - fungsi analisis clustering dan heatmap -->
  <script src="{{ asset('js/analysis.js') }}"></script>

  <!-- 7. PDF Export - fungsi export PDF -->
  <script src="{{ asset('js/pdf-export.js') }}"></script>

  <!-- 8. Excel Export - fungsi export data layer ke Excel -->
  <script src="{{ asset('js/excel-export.js') }}"></script>

  <script src="{{ asset('js/filter-wilayah.js') }}"></script>

  <!-- 9. Main - inisialisasi aplikasi (harus terakhir) -->
  <script src="{{ asset('js/main.js') }}"></script>



</body>
</html>