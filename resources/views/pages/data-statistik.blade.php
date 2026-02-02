<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Data Statistik - Bappeda Surabaya</title>

  {{-- Load CSS Navbar yang sudah Anda punya --}}
  <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
  {{-- Load CSS Statistik Baru --}}
  <link rel="stylesheet" href="{{ asset('css/statistik.css') }}">

  {{-- Bootstrap & Icon --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>

  @include('partials.header') 

  <main class="stat-section">
    <div class="container">

        {{-- Header Halaman --}}
        <div class="page-header">
            <h1 class="page-title">Dashboard Kinerja Lingkungan</h1>
            <p class="page-desc">Visualisasi data statistik pembangunan dan lingkungan hidup Kota Surabaya Tahun 2025.</p>
        </div>

        {{-- NAVIGASI FITUR (1-5) --}}
        <div class="feature-nav">
            <a href="?tab=sampah" class="feature-link {{ $tab == 'sampah' ? 'active' : '' }}">
                1. Pengelolaan Sampah
            </a>
            <a href="?tab=rth" class="feature-link {{ $tab == 'rth' ? 'active' : '' }}">
                2. Ruang Terbuka Hijau
            </a>
            <a href="?tab=sarpras" class="feature-link {{ $tab == 'sarpras' ? 'active' : '' }}">
                3. Sarana Prasarana
            </a>
            <a href="?tab=sdm" class="feature-link {{ $tab == 'sdm' ? 'active' : '' }}">
                4. Kepegawaian
            </a>
            <a href="?tab=ringkasan" class="feature-link {{ $tab == 'ringkasan' ? 'active' : '' }}">
                5. Ringkasan Eksekutif
            </a>
        </div>

        {{-- AREA KONTEN (DRILL DOWN TARGET ID) --}}
        <div id="stat-content">
            
            @if($tab == 'sampah')
                
                {{-- 1. SCORECARDS (RINGKASAN CEPAT) --}}
                <div class="row g-4 mb-4">
                    <div class="col-md-3 col-6">
                        <div class="scorecard">
                            <div class="scorecard-icon icon-orange"><i class="bi bi-trash-fill"></i></div>
                            <div class="scorecard-label">Total Sampah (Ton)</div>
                            <div class="scorecard-value">{{ $dataSampah['summary']['total_tpa'] }}</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="scorecard">
                            <div class="scorecard-icon icon-blue"><i class="bi bi-arrow-repeat"></i></div>
                            <div class="scorecard-label">Rata-rata Harian</div>
                            <div class="scorecard-value">{{ $dataSampah['summary']['avg_harian'] }}</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="scorecard">
                            <div class="scorecard-icon icon-green"><i class="bi bi-recycle"></i></div>
                            <div class="scorecard-label">Bank Sampah</div>
                            <div class="scorecard-value">{{ $dataSampah['summary']['bank_sampah'] }} <span style="font-size:14px; font-weight:400">Unit</span></div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="scorecard">
                            <div class="scorecard-icon icon-purple"><i class="bi bi-truck"></i></div>
                            <div class="scorecard-label">Armada Truk</div>
                            <div class="scorecard-value">{{ $dataSampah['summary']['armada'] }} <span style="font-size:14px; font-weight:400">Unit</span></div>
                        </div>
                    </div>
                </div>

                {{-- 2. GRAFIK UTAMA (TPA & TPS3R) --}}
                <div class="row">
                    {{-- Grafik Tren TPA --}}
                    <div class="col-12">
                        <div class="chart-card">
                            <div class="chart-header">
                                <div class="chart-title">Tren Volume Sampah Masuk TPA Benowo (2018-2025)</div>
                                <span class="badge bg-danger">Isu Strategis</span>
                            </div>
                            <div id="chartTPA"></div>
                        </div>
                    </div>

                    {{-- Grafik TPS 3R --}}
                    <div class="col-12">
                        <div class="chart-card">
                            <div class="chart-header">
                                <div class="chart-title">Efektivitas Pengolahan di 12 TPS 3R Utama</div>
                                <span class="badge bg-success">Kinerja Baik</span>
                            </div>
                            <div id="chartTPS3R"></div>
                        </div>
                    </div>
                </div>

                {{-- 3. BANK SAMPAH SECTION --}}
                <div class="row">
                    <div class="col-lg-7">
                        <div class="chart-card h-100">
                            <div class="chart-header">
                                <div class="chart-title">Partisipasi Bank Sampah per Wilayah</div>
                            </div>
                            <div id="chartBankSampah"></div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="chart-card h-100">
                            <div class="chart-header">
                                <div class="chart-title">Top 5 Bank Sampah Terbaik</div>
                            </div>
                            <div class="table-responsive">
                                <table class="table-modern">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Unit</th>
                                            <th>Wilayah</th>
                                            <th class="text-end">Tonase (Kg)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($dataSampah['bank_sampah']['top_5'] as $index => $bs)
                                        <tr>
                                            <td><span class="rank-badge">{{ $index + 1 }}</span></td>
                                            <td style="font-weight:600">{{ $bs['nama'] }}</td>
                                            <td><span class="badge bg-light text-dark border">{{ $bs['wilayah'] }}</span></td>
                                            <td class="text-end" style="color:#1d4ed8; font-weight:700">{{ number_format($bs['tonase'], 1, ',', '.') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            @else
                {{-- TAMPILAN JIKA FITUR 2-5 DIKLIK (COMING SOON) --}}
                <div class="empty-state">
                    <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" alt="Construction" style="width: 80px; opacity: 0.5; margin-bottom: 20px;">
                    <h3 style="color: #475569; font-weight: 700;">Data Sedang Disiapkan</h3>
                    <p style="color: #64748b;">Fitur visualisasi untuk kategori ini sedang dalam tahap pengembangan dan integrasi data.</p>
                </div>
            @endif

        </div>

    </div>
  </main>

  @include('partials.footer')

  {{-- APEXCHARTS LIBRARY --}}
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

  {{-- SCRIPT KHUSUS HALAMAN INI --}}
  <script>
    // Fitur Drill Down (Scroll otomatis ke konten jika tab aktif)
    document.addEventListener("DOMContentLoaded", function() {
        const urlParams = new URLSearchParams(window.location.search);
        if(urlParams.has('tab')) {
            // Scroll halus ke area konten
            const element = document.getElementById("stat-content");
            if(element) {
                // Beri jeda sedikit agar layout load sempurna
                setTimeout(() => {
                    element.scrollIntoView({ behavior: "smooth", block: "start" });
                }, 300);
            }
        }
    });

    @if($tab == 'sampah')
    // --- 1. CONFIG CHART TPA (Area Gradient) ---
    var optionsTPA = {
        series: [{
            name: "Volume Sampah (Ton)",
            data: @json($dataSampah['tpa']['tonase'])
        }],
        chart: { type: 'area', height: 350, fontFamily: 'system-ui', toolbar: {show: false} },
        colors: ['#ef4444'], // Merah (Warning)
        stroke: { curve: 'smooth', width: 3 },
        dataLabels: { enabled: false },
        fill: { 
            type: 'gradient', 
            gradient: { shadeIntensity: 1, opacityFrom: 0.6, opacityTo: 0.1, stops: [0, 90, 100] } 
        },
        xaxis: { categories: @json($dataSampah['tpa']['tahun']) },
        yaxis: { labels: { formatter: (val) => (val / 1000).toFixed(0) + " Ribu" } },
        tooltip: { y: { formatter: (val) => val.toLocaleString('id-ID') + " Ton" } }
    };
    new ApexCharts(document.querySelector("#chartTPA"), optionsTPA).render();

    // --- 2. CONFIG CHART TPS 3R (Stacked Bar) ---
    var optionsTPS = {
        series: [
            { name: 'Sampah Terolah', data: @json($dataSampah['tps3r']['terolah']) },
            { name: 'Residu (Sisa)', data: @json($dataSampah['tps3r']['residu']) }
        ],
        chart: { type: 'bar', height: 380, stacked: true, fontFamily: 'system-ui', toolbar: {show: false} },
        colors: ['#10b981', '#cbd5e1'], // Hijau & Abu-abu
        plotOptions: { bar: { borderRadius: 4, columnWidth: '45%' } },
        dataLabels: { enabled: false },
        xaxis: { 
            categories: @json($dataSampah['tps3r']['lokasi']), 
            labels: { rotate: -45, style: {fontSize: '11px'} } 
        },
        legend: { position: 'top', horizontalAlign: 'right' }
    };
    new ApexCharts(document.querySelector("#chartTPS3R"), optionsTPS).render();

    // --- 3. CONFIG CHART BANK SAMPAH (Horizontal Bar) ---
    var optionsBS = {
        series: [{ name: 'Unit Aktif', data: @json($dataSampah['bank_sampah']['wilayah_data']) }],
        chart: { type: 'bar', height: 300, fontFamily: 'system-ui', toolbar: {show: false} },
        plotOptions: { bar: { borderRadius: 4, horizontal: true, barHeight: '50%' } },
        colors: ['#1d4ed8'], // Biru Bappeda
        xaxis: { categories: @json($dataSampah['bank_sampah']['wilayah_label']) },
        dataLabels: { 
            enabled: true, 
            textAnchor: 'start', 
            style: { colors: ['#fff'] },
            formatter: function (val, opt) { return val + " Unit" },
            offsetX: 0,
        }
    };
    new ApexCharts(document.querySelector("#chartBankSampah"), optionsBS).render();
    @endif
  </script>

</body>
</html>