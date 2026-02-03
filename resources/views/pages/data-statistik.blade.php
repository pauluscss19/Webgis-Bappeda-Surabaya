<!doctype html>
<html lang="id">
<head>
<<<<<<< HEAD
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Dashboard Kompos - SIDAPETA SBY</title>

  {{-- Load CSS --}}
  <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
  <link rel="stylesheet" href="{{ asset('css/statistik.css') }}">
  
  {{-- Bootstrap, Icons, & APEXCHARTS CSS --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.41.0/dist/apexcharts.min.css">
=======
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Executive Dashboard DLH Surabaya</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    
    <style>
        :root { --primary-green: #059669; --light-green: #ecfdf5; --dark-green: #064e3b; }
        body { background-color: #f8fafc; font-family: 'Segoe UI', sans-serif; color: #334155; }
        .main-content { margin-top: 100px; padding-bottom: 80px; min-height: 85vh; }
        
        /* Navigasi */
        .nav-scroller { background: white; padding: 10px 15px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.03); margin-bottom: 25px; overflow-x: auto; white-space: nowrap; border: 1px solid #e2e8f0; }
        .nav-pills .nav-link { border-radius: 8px; padding: 10px 20px; margin-right: 8px; font-weight: 600; color: #64748b; transition: all 0.2s; border: 1px solid transparent; }
        .nav-pills .nav-link:hover { background-color: #f1f5f9; color: var(--primary-green); }
        .nav-pills .nav-link.active { background-color: var(--primary-green); color: white; box-shadow: 0 4px 6px -1px rgba(5, 150, 105, 0.2); }

        /* Kartu & Tabel */
        .card-box { background: white; border-radius: 16px; padding: 25px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02); border: 1px solid #e2e8f0; height: 100%; transition: transform 0.2s; }
        .card-box:hover { border-color: #cbd5e1; }
        .card-header-custom { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 1px solid #f1f5f9; padding-bottom: 15px; }
        .card-title { font-size: 1.1rem; font-weight: 700; color: var(--dark-green); margin: 0; display: flex; align-items: center; gap: 10px; }
        .table-custom th { background-color: #f8fafc; color: #64748b; font-weight: 600; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.05em; border-bottom: 2px solid #e2e8f0; padding: 12px; }
        .table-custom td { vertical-align: middle; font-size: 0.9rem; padding: 12px; border-bottom: 1px solid #f1f5f9; }
        .table-row-hover:hover { background-color: #f0fdf4; }
        .badge-green { background: #dcfce7; color: #166534; }
        .progress-thin { height: 8px; border-radius: 4px; background-color: #e2e8f0; }
        
        /* Pagination */
        .pagination { margin-bottom: 0; }
        .page-link { color: var(--dark-green); border: 1px solid #e2e8f0; }
        .page-item.active .page-link { background-color: var(--primary-green); border-color: var(--primary-green); color: white; }
    </style>
>>>>>>> 1dfeaf17f3c1e38f179bf280b21c8dabe71e2c10
</head>
<body style="background-color: #f8fafc;"> {{-- Background halaman sedikit abu --}}

    @include('partials.header')

<<<<<<< HEAD
  <main class="stat-section" style="padding-top: 100px; padding-bottom: 60px;">
    <div class="container">

        {{-- Header Halaman --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="fw-bold text-dark mb-1">Dashboard Kinerja Kompos</h1>
                <p class="text-muted mb-0">Monitoring Operasional Rumah Kompos Kota Surabaya Tahun 2025</p>
            </div>
            <span class="badge bg-primary fs-6 px-3 py-2 rounded-pill">Data Terbaru 2025</span>
        </div>

        {{-- SECTION 1: SCORECARDS (KARTU RINGKASAN) --}}
        <div class="row g-4 mb-4">
            {{-- Kartu 1: Total Input --}}
            <div class="col-md-4">
                <div class="stats-card-box">
                    <div class="stats-icon-wrapper theme-blue">
                        <i class="bi bi-box-seam"></i>
                    </div>
                    <div class="stats-content">
                        <h3>{{ number_format($komposTotal['masuk_25'], 2) }}</h3>
                        <p>Total Bahan Masuk (Ton)</p>
                    </div>
                </div>
            </div>
            {{-- Kartu 2: Total Output --}}
            <div class="col-md-4">
                <div class="stats-card-box">
                    <div class="stats-icon-wrapper theme-green">
                        <i class="bi bi-flower1"></i>
                    </div>
                    <div class="stats-content">
                        <h3>{{ number_format($komposTotal['hasil_25'], 2) }}</h3>
                        <p>Total Hasil Kompos (Ton)</p>
                    </div>
                </div>
            </div>
            {{-- Kartu 3: Efisiensi --}}
            <div class="col-md-4">
                <div class="stats-card-box">
                    <div class="stats-icon-wrapper theme-purple">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>
                    <div class="stats-content">
                        <h3>{{ number_format($efisiensi, 1) }}%</h3>
                        <p>Rasio Hasil per Input</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- SECTION 2: GRAFIK VISUAL --}}
        <div class="row g-4 mb-5">
            {{-- Grafik Kiri: Top 5 Lokasi --}}
            <div class="col-lg-7">
                <div class="chart-container">
                    <h5 class="chart-title">Top 5 Lokasi dengan Input Terbanyak (2025)</h5>
                    <div id="chartTop5"></div>
                </div>
            </div>
            {{-- Grafik Kanan: Perbandingan Input vs Output --}}
            <div class="col-lg-5">
                <div class="chart-container">
                    <h5 class="chart-title">Ringkasan Proses (2025)</h5>
                    <div id="chartSummaryPie"></div>
                </div>
            </div>
        </div>


        {{-- SECTION 3: TABEL DETAIL (Yang Lama) --}}
        <div class="row">
            <div class="col-12">
                <div class="stat-card" style="background: #fff; border-radius: 12px; padding: 20px; box-shadow: 0 2px 15px rgba(0,0,0,0.05);">
                    <div class="stat-card__header mb-3">
                        <h5 class="fw-bold text-dark">
                            <i class="bi bi-table me-2 text-primary"></i> 
                            Detail Data per Lokasi
                        </h5>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle mb-0" style="font-size: 0.9rem;">
                            <thead class="table-light text-center">
                                <tr>
                                    <th rowspan="2" class="align-middle">Lokasi</th>
                                    <th colspan="4" class="fw-bold text-primary">Tahun 2025 (Ton/Hari)</th>
                                </tr>
                                <tr>
                                    <th>Masuk</th>
                                    <th>Non-Kompos</th>
                                    <th>Utk Kompos</th>
                                    <th class="bg-primary text-white">Hasil</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($komposData as $k)
                                <tr>
                                    <td class="fw-bold">{{ $k->lokasi }}</td>
                                    <td class="text-end">{{ number_format($k->bahan_masuk_2025, 2) }}</td>
                                    <td class="text-end">{{ number_format($k->diolah_selain_kompos_2025, 2) }}</td>
                                    <td class="text-end">{{ number_format($k->diolah_untuk_kompos_2025, 2) }}</td>
                                    <td class="text-end fw-bold text-primary bg-primary bg-opacity-10">
                                        {{ number_format($k->hasil_produksi_2025, 2) }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="fw-bold bg-light">
                                <tr>
                                    <td>TOTAL NASIONAL</td>
                                    <td class="text-end">{{ number_format($komposTotal['masuk_25'], 2) }}</td>
                                    <td class="text-end">{{ number_format($komposTotal['selain_25'], 2) }}</td>
                                    <td class="text-end">{{ number_format($komposTotal['kompos_25'], 2) }}</td>
                                    <td class="text-end text-primary">{{ number_format($komposTotal['hasil_25'], 2) }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
  </main>

  @include('partials.footer')

  {{-- Load APEXCHARTS JS --}}
  <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.41.0/dist/apexcharts.min.js"></script>

  {{-- SCRIPT UNTUK RENDER GRAFIK --}}
  <script>
    // --- GRAFIK 1: TOP 5 LOKASI (BAR HORIZONTAL) ---
    var optionsTop5 = {
        series: [{
            name: 'Bahan Masuk (Ton)',
            data: @json($chartTop5['data']) // Data dari Controller
        }],
        chart: {
            type: 'bar',
            height: 320,
            toolbar: { show: false },
            fontFamily: 'system-ui'
        },
        plotOptions: {
            bar: {
                borderRadius: 4,
                horizontal: true,
                barHeight: '60%',
                distributed: true // Agar warna beda-beda tiap bar
            }
        },
        colors: ['#3b82f6', '#10b981', '#f59e0b', '#8b5cf6', '#ef4444'],
        dataLabels: {
            enabled: true,
            textAnchor: 'start',
            style: { colors: ['#fff'] },
            formatter: function (val) { return val + " Ton" },
            offsetX: 0,
        },
        xaxis: {
            categories: @json($chartTop5['labels']), // Label Lokasi dari Controller
        },
        grid: { xaxis: { lines: { show: false } }, yaxis: { lines: { show: false } } },
        legend: { show: false }
    };
    var chartTop5Render = new ApexCharts(document.querySelector("#chartTop5"), optionsTop5);
    chartTop5Render.render();


    // --- GRAFIK 2: RINGKASAN PIE CHART ---
    var optionsPie = {
        series: [
            {{ $komposTotal['hasil_25'] }}, // Total Hasil
            {{ $komposTotal['masuk_25'] - $komposTotal['hasil_25'] }} // Sisa (Input dikurangi Hasil)
        ],
        chart: {
            type: 'donut',
            height: 320,
            fontFamily: 'system-ui'
        },
        labels: ['Hasil Produksi Kompos', 'Residu / Proses Lain'],
        colors: ['#10b981', '#cbd5e1'], // Hijau untuk hasil, Abu untuk sisanya
        dataLabels: {
            enabled: true,
             formatter: function (val) { return val.toFixed(1) + "%" }
        },
        plotOptions: {
            pie: { donut: { size: '65%' } }
        },
        legend: { position: 'bottom' },
        tooltip: {
             y: { formatter: function(val) { return val + " Ton"; } }
        }
    };
    var chartPieRender = new ApexCharts(document.querySelector("#chartSummaryPie"), optionsPie);
    chartPieRender.render();

  </script>
=======
    <main class="container main-content">
        
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h6 class="text-success fw-bold text-uppercase ls-1 mb-1">Dashboard Eksekutif</h6>
                <h2 class="fw-bold text-dark m-0">Statistik Lingkungan Hidup</h2>
            </div>
            <button onclick="window.print()" class="btn btn-outline-secondary btn-sm d-print-none">
                <i class="bi bi-printer me-2"></i>Cetak Laporan
            </button>
        </div>

        <div class="nav-scroller d-print-none">
            <nav class="nav nav-pills">
                <a class="nav-link {{ $tab=='sarpras' ? 'active' : '' }}" href="?tab=sarpras"><i class="bi bi-building me-2"></i>Fasilitas & Aset</a>
                <a class="nav-link {{ $tab=='armada_logistik' ? 'active' : '' }}" href="?tab=armada_logistik"><i class="bi bi-truck me-2"></i>Armada & Logistik</a>
                <a class="nav-link {{ $tab=='tpa' ? 'active' : '' }}" href="?tab=tpa"><i class="bi bi-graph-up-arrow me-2"></i>Sampah TPA</a>
                <a class="nav-link {{ $tab=='tps3r' ? 'active' : '' }}" href="?tab=tps3r"><i class="bi bi-recycle me-2"></i>Kinerja TPS 3R</a>
                <a class="nav-link {{ $tab=='b3' ? 'active' : '' }}" href="?tab=b3"><i class="bi bi-radioactive me-2"></i>Limbah B3</a>
            </nav>
        </div>

        {{-- TAB 1: SARPRAS --}}
        @if($tab == 'sarpras')
            <div class="row g-4">
                <div class="col-lg-5">
                    <div class="card-box">
                        <div class="card-header-custom"><h5 class="card-title"><i class="bi bi-pie-chart-fill"></i> Komposisi Aset</h5></div>
                        <div id="chartSarprasDonut"></div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="card-box">
                        <div class="card-header-custom">
                            <h5 class="card-title"><i class="bi bi-list-ul"></i> Ringkasan Aset</h5>
                            <span class="badge badge-green">{{ $data['summary']['fasilitas'] + $data['summary']['bank_sampah'] }} Unit Total</span>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-custom">
                                <thead><tr><th>Jenis Fasilitas</th><th class="text-end">Jumlah Unit</th><th class="text-end">Kontribusi</th></tr></thead>
                                <tbody>
                                    @php $total = array_sum($data['chart_sarpras']['value']); @endphp
                                    @foreach($data['chart_sarpras']['label'] as $index => $label)
                                    <tr class="table-row-hover">
                                        <td class="fw-bold text-dark">{{ $label }}</td>
                                        <td class="text-end fw-bold">{{ number_format($data['chart_sarpras']['value'][$index], 0, ',', '.') }}</td>
                                        <td class="text-end">
                                            <div class="d-flex align-items-center justify-content-end gap-2">
                                                <span class="small text-muted">{{ $total > 0 ? round(($data['chart_sarpras']['value'][$index] / $total) * 100, 1) : 0 }}%</span>
                                                <div class="progress progress-thin" style="width: 50px;">
                                                    <div class="progress-bar bg-success" style="width: {{ $total > 0 ? ($data['chart_sarpras']['value'][$index] / $total) * 100 : 0 }}%"></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @if(isset($listData) && $listData->count() > 0)
                <div class="col-12">
                    <div class="card-box">
                        <div class="card-header-custom">
                            <h5 class="card-title"><i class="bi bi-geo-alt-fill"></i> Daftar Lokasi & Rincian Fasilitas</h5>
                            <small class="text-muted">Menampilkan {{ $listData->firstItem() }} - {{ $listData->lastItem() }} dari {{ $listData->total() }} data</small>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-custom table-hover">
                                <thead><tr><th>Jenis</th><th>Nama Fasilitas</th><th>Alamat</th><th>Kecamatan</th><th>Kelurahan</th></tr></thead>
                                <tbody>
                                    @foreach($listData as $item)
                                    <tr>
                                        <td><span class="badge badge-green">{{ $item->jenis_fasilitas }}</span></td>
                                        <td class="fw-bold">{{ $item->nama_fasilitas }}</td>
                                        <td>{{ $item->alamat ?: '-' }}</td>
                                        <td>{{ $item->kecamatan ?: '-' }}</td>
                                        <td>{{ $item->kelurahan ?: '-' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-4">{{ $listData->links('pagination::bootstrap-5') }}</div>
                    </div>
                </div>
                @endif
            </div>

        {{-- TAB 2: ARMADA & BBM (UPDATED GRAFIK STACKED) --}}
        @elseif($tab == 'armada_logistik')
            <div class="row g-4">
                <div class="col-lg-5">
                    <div class="card-box">
                        <div class="card-header-custom"><h5 class="card-title"><i class="bi bi-truck-front"></i> Jenis Armada</h5></div>
                        <div id="chartArmada"></div>
                        <div class="mt-4"><table class="table table-custom table-sm mb-0"><thead><tr><th>Tipe</th><th class="text-end">Unit</th></tr></thead><tbody>@foreach($data['chart_armada']['label'] as $index => $label)<tr><td>{{ $label }}</td><td class="text-end fw-bold">{{ $data['chart_armada']['value'][$index] }}</td></tr>@endforeach</tbody></table></div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="card-box">
                        <div class="card-header-custom"><h5 class="card-title"><i class="bi bi-fuel-pump-fill"></i> Konsumsi Bahan Bakar (Liter)</h5></div>
                        <div id="chartBBM"></div>
                        
                        <div class="mt-4 table-responsive" style="max-height: 300px; overflow-y:auto;">
                            <table class="table table-custom table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th>Bulan</th>
                                        <th class="text-end">Total Volume</th>
                                        <th class="text-end fw-bold text-dark">Estimasi Biaya (Rp)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['chart_bbm']['label'] as $index => $label)
                                    <tr>
                                        <td class="text-capitalize fw-bold small">{{ $label }}</td>
                                        <td class="text-end font-monospace small">
                                            {{ number_format($data['chart_bbm']['costs'][$index]['total_liter'], 0, ',', '.') }} L
                                        </td>
                                        <td class="text-end fw-bold text-success font-monospace small">
                                            Rp {{ number_format($data['chart_bbm']['costs'][$index]['total_biaya'], 0, ',', '.') }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        {{-- TAB 3: TPA --}}
        @elseif($tab == 'tpa')
            <div class="row g-4">
                <div class="col-12">
                    <div class="card-box">
                        <div class="card-header-custom"><h5 class="card-title"><i class="bi bi-activity"></i> Tren Volume Sampah TPA</h5></div>
                        <div id="chartTrendTPA"></div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card-box">
                        <h6 class="fw-bold mb-3 text-secondary small text-uppercase">Data Historis & Biaya</h6>
                        <div class="table-responsive">
                            <table class="table table-custom table-hover">
                                <thead><tr><th>Tahun</th><th class="text-end">Total Tonase</th><th class="text-end fw-bold">Biaya Tipping Fee (Rp)</th><th class="text-end">Status</th></tr></thead>
                                <tbody>
                                    @foreach($data['trend_tpa']['label'] as $index => $label)
                                    <tr>
                                        <td class="fw-bold">{{ $label }}</td>
                                        <td class="text-end">{{ number_format($data['trend_tpa']['value'][$index], 0, ',', '.') }}</td>
                                        <td class="text-end fw-bold text-success font-monospace">Rp {{ number_format($data['trend_tpa']['biaya'][$index], 0, ',', '.') }}</td>
                                        <td class="text-end"><span class="badge badge-green">Terverifikasi</span></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        {{-- TAB 4: TPS3R --}}
        @elseif($tab == 'tps3r')
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="card-box">
                        <div class="card-header-custom">
                            <h5 class="card-title"><i class="bi bi-bar-chart-fill"></i> Grafik Produktivitas TPS 3R</h5>
                            <div class="small"><span class="badge bg-success me-2">Hijau: Masuk</span><span class="badge bg-danger">Merah: Residu</span></div>
                        </div>
                        <div id="chartTPS3R"></div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card-box">
                        <div class="card-header-custom"><h5 class="card-title"><i class="bi bi-table"></i> Peringkat Data Lokasi</h5></div>
                        <div class="table-responsive">
                            <table class="table table-custom table-hover align-middle">
                                <thead><tr><th style="width: 50px;">#</th><th>Lokasi</th><th class="text-end text-success">Masuk (Ton)</th><th class="text-end text-danger">Residu (Ton)</th><th class="text-end text-primary">Efektivitas</th></tr></thead>
                                <tbody>
                                    @foreach($data['chart_tps3r']['label'] as $index => $lokasi)
                                    @php 
                                        $masuk = $data['chart_tps3r']['masuk'][$index];
                                        $residu = $data['chart_tps3r']['residu'][$index];
                                        $efektivitas = $masuk > 0 ? (($masuk - $residu) / $masuk) * 100 : 0;
                                    @endphp
                                    <tr>
                                        <td class="text-center fw-bold text-muted">{{ $index + 1 }}</td>
                                        <td class="fw-bold">{{ $lokasi }}</td>
                                        <td class="text-end font-monospace fw-bold">{{ number_format($masuk, 2, ',', '.') }}</td>
                                        <td class="text-end font-monospace">{{ number_format($residu, 2, ',', '.') }}</td>
                                        <td class="text-end"><span class="small fw-bold">{{ number_format($efektivitas, 1) }}%</span></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        {{-- TAB 5: B3 --}}
        @elseif($tab == 'b3')
            <div class="row g-4">
                <div class="col-lg-5">
                    <div class="card-box"><div class="card-header-custom"><h5 class="card-title"><i class="bi bi-pie-chart"></i> Kategori Limbah</h5></div><div id="chartB3"></div></div>
                </div>
                <div class="col-lg-7">
                    <div class="card-box"><div class="card-header-custom"><h5 class="card-title"><i class="bi bi-list-check"></i> Daftar Limbah</h5></div><table class="table table-custom table-hover"><thead><tr><th>Jenis Limbah</th><th class="text-end">Berat Total (Kg)</th></tr></thead><tbody>@foreach($data['chart_b3']['label'] as $index => $label)<tr><td class="fw-bold text-dark">{{ $label }}</td><td class="text-end font-monospace fw-bold">{{ number_format($data['chart_b3']['value'][$index], 2, ',', '.') }}</td></tr>@endforeach</tbody></table></div>
                </div>
            </div>
        @endif

    </main>

    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        const commonOpts = { chart: { fontFamily: 'Segoe UI', toolbar: { show: false } }, tooltip: { theme: 'light' } };

        @if($tab == 'sarpras')
            new ApexCharts(document.querySelector("#chartSarprasDonut"), { ...commonOpts, series: @json($data['chart_sarpras']['value']), labels: @json($data['chart_sarpras']['label']), chart: { type: 'donut', height: 350 }, colors: ['#059669', '#10b981', '#34d399', '#6ee7b7'], plotOptions: { pie: { donut: { size: '65%' } } }, legend: { position: 'bottom' } }).render();
        @elseif($tab == 'armada_logistik')
            new ApexCharts(document.querySelector("#chartArmada"), { ...commonOpts, series: @json($data['chart_armada']['value']), labels: @json($data['chart_armada']['label']), chart: { type: 'pie', height: 300 }, legend: { position: 'bottom' } }).render();
            
            // === GRAFIK BBM STACKED BAR (ADA TOTALNYA!) ===
            new ApexCharts(document.querySelector("#chartBBM"), {
                ...commonOpts,
                series: @json($data['chart_bbm']['series']), 
                chart: { 
                    type: 'bar', 
                    height: 380, 
                    stacked: true, // INI KUNCINYA: DITUMPUK
                    toolbar: { show: false }
                },
                xaxis: { 
                    categories: @json($data['chart_bbm']['label']),
                },
                colors: ['#dc2626', '#16a34a', '#2563eb'], // Merah, Hijau, Biru
                plotOptions: {
                    bar: {
                        borderRadius: 4,
                        columnWidth: '50%',
                        dataLabels: {
                            // FITUR TOTAL DI ATAS BATANG
                            total: {
                                enabled: true,
                                style: { fontSize: '12px', fontWeight: 900, color: '#333' },
                                formatter: function (val) { return (val / 1000).toFixed(0) + 'k L'; } // Format jadi '200k L'
                            }
                        }
                    }
                },
                dataLabels: { enabled: false }, // Label detail sembunyikan dulu biar rapi
                tooltip: {
                    y: { formatter: function (val) { return val.toLocaleString('id-ID') + " Liter"; } }
                },
                legend: { position: 'top' }
            }).render();
>>>>>>> 1dfeaf17f3c1e38f179bf280b21c8dabe71e2c10

        @elseif($tab == 'tpa')
            new ApexCharts(document.querySelector("#chartTrendTPA"), { ...commonOpts, series: [{ name: 'Volume (Ton)', data: @json($data['trend_tpa']['value']) }], chart: { type: 'area', height: 400 }, xaxis: { categories: @json($data['trend_tpa']['label']) }, colors: ['#059669'], stroke: { curve: 'straight', width: 3 }, dataLabels: { enabled: true } }).render();
        @elseif($tab == 'tps3r')
            new ApexCharts(document.querySelector("#chartTPS3R"), { ...commonOpts, series: [{ name: 'Masuk', data: @json($data['chart_tps3r']['masuk']) }, { name: 'Residu', data: @json($data['chart_tps3r']['residu']) }], chart: { type: 'bar', height: 400, stacked: false, toolbar: { show: false } }, yaxis: { labels: { show: false } }, xaxis: { categories: @json($data['chart_tps3r']['label']), labels: { show: true, style: { fontSize: '10px' } } }, colors: ['#10b981', '#ef4444'], plotOptions: { bar: { horizontal: true, borderRadius: 3, barHeight: '80%', dataLabels: { position: 'top' } } }, dataLabels: { enabled: true, textAnchor: 'start', offsetX: 0, style: { fontSize: '11px', colors: ['#333'] }, formatter: function (val) { return val.toLocaleString('id-ID'); } }, grid: { show: false }, legend: { position: 'top' } }).render();
        @elseif($tab == 'b3')
            new ApexCharts(document.querySelector("#chartB3"), { ...commonOpts, series: @json($data['chart_b3']['value']), labels: @json($data['chart_b3']['label']), chart: { type: 'pie', height: 350 }, legend: { position: 'bottom' } }).render();
        @endif
    </script>
</body>
</html>