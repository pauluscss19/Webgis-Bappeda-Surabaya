<!doctype html>
<html lang="id">
<head>
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
</head>
<body style="background-color: #f8fafc;"> {{-- Background halaman sedikit abu --}}

  @include('partials.header') 

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

</body>
</html>