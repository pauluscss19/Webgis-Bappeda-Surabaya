<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Ringkasan Data - Bappeda Surabaya</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
  <link rel="stylesheet" href="{{ asset('css/crud.css') }}">
  <style>
    .ring-tabs { display:flex; gap:8px; margin-bottom:28px; flex-wrap:wrap; }
    .ring-tab { display:inline-flex; align-items:center; gap:8px; padding:12px 22px; border-radius:12px; font-weight:700; font-size:14px; cursor:pointer; border:2px solid #e2e8f0; background:#fff; color:#64748b; transition:all .25s; }
    .ring-tab:hover { border-color:#3b82f6; color:#3b82f6; }
    .ring-tab.active { background:linear-gradient(135deg,#3b82f6,#2563eb); color:#fff; border-color:#3b82f6; box-shadow:0 4px 16px rgba(59,130,246,.3); }
    .ring-tab i { font-size:18px; }
    .ring-panel { display:none; }
    .ring-panel.active { display:block; animation:fadeUp .3s ease; }
    @keyframes fadeUp { from{opacity:0;transform:translateY(10px)} to{opacity:1;transform:translateY(0)} }
    .ring-section { background:#fff; border-radius:18px; padding:28px; margin-bottom:20px; box-shadow:0 4px 20px rgba(0,0,0,.04); border:1px solid rgba(0,0,0,.04); }
    .ring-section__title { font-size:18px; font-weight:800; color:#0f172a; margin:0 0 20px; display:flex; align-items:center; gap:10px; }
    .ring-section__title i { color:#3b82f6; }
    .ring-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(180px,1fr)); gap:16px; }
    .ring-metric { text-align:center; padding:16px; border-radius:14px; background:#f8fafc; border:1px solid #f1f5f9; }
    .ring-metric__value { font-size:28px; font-weight:800; color:#0f172a; }
    .ring-metric__label { font-size:12px; font-weight:600; color:#94a3b8; text-transform:uppercase; letter-spacing:.5px; margin-top:4px; }
    .ring-chart-row { display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-top:20px; }
    @media(max-width:768px) { .ring-chart-row { grid-template-columns:1fr; } }
  </style>
</head>
<body class="app-shell">
  @include('partials.header')
  <div class="app-shell__content">
    <section class="crud-page">
      <div class="crud-container">

        {{-- BANNER CARD --}}
        <div class="crud-banner crud-banner--ringkasan">
          <div class="crud-banner__content">
            <h1 class="crud-banner__title">Ringkasan Data Statistik</h1>
            <p class="crud-banner__subtitle">Rangkuman Seluruh Data Lingkungan Kota Surabaya — Pantau keseluruhan data sampah, kualitas, sarpras, dan RTH dalam satu halaman.</p>
          </div>
          <i class="bi bi-bar-chart-line-fill crud-banner__deco"></i>
        </div>

        {{-- TABS --}}
        <div class="ring-tabs">
          <div class="ring-tab active" onclick="switchTab('sampah')"><i class="bi bi-trash3"></i> Data Sampah</div>
          <div class="ring-tab" onclick="switchTab('kualitas')"><i class="bi bi-droplet-half"></i> Kualitas Lingkungan</div>
          <div class="ring-tab" onclick="switchTab('sarpras')"><i class="bi bi-tools"></i> Sarpras</div>
          <div class="ring-tab" onclick="switchTab('rth')"><i class="bi bi-tree"></i> RTH</div>
        </div>

        {{-- TAB 1: SAMPAH --}}
        <div class="ring-panel active" id="panel-sampah">
          <div class="ring-section">
            <h3 class="ring-section__title"><i class="bi bi-trash3"></i> Ringkasan Data Sampah</h3>
            <div class="ring-grid">
              <div class="ring-metric"><div class="ring-metric__value">{{ number_format($sampah['total_data']) }}</div><div class="ring-metric__label">Total Data</div></div>
              <div class="ring-metric"><div class="ring-metric__value">{{ number_format($sampah['total_volume'],1) }}</div><div class="ring-metric__label">Volume (Ton)</div></div>
              <div class="ring-metric"><div class="ring-metric__value">{{ number_format($sampah['total_terangkut'],1) }}</div><div class="ring-metric__label">Terangkut (Ton)</div></div>
              <div class="ring-metric"><div class="ring-metric__value">{{ number_format($sampah['total_diolah'],1) }}</div><div class="ring-metric__label">Diolah (Ton)</div></div>
              <div class="ring-metric"><div class="ring-metric__value">{{ number_format($sampah['total_tps']) }}</div><div class="ring-metric__label">Total TPS</div></div>
              <div class="ring-metric"><div class="ring-metric__value">{{ number_format($sampah['total_bank_sampah']) }}</div><div class="ring-metric__label">Bank Sampah</div></div>
            </div>
            <div class="ring-chart-row">
              <div><div id="chartSampahBar" style="min-height:300px"></div></div>
              <div><div id="chartSampahPie" style="min-height:300px"></div></div>
            </div>
          </div>
        </div>

        {{-- TAB 2: KUALITAS --}}
        <div class="ring-panel" id="panel-kualitas">
          <div class="ring-section">
            <h3 class="ring-section__title"><i class="bi bi-droplet-half"></i> Ringkasan Kualitas Lingkungan</h3>
            <div class="ring-grid">
              <div class="ring-metric"><div class="ring-metric__value">{{ $kualitas['total_data'] }}</div><div class="ring-metric__label">Total Data</div></div>
              <div class="ring-metric"><div class="ring-metric__value" style="color:#059669">{{ $kualitas['memenuhi'] }}</div><div class="ring-metric__label">Memenuhi</div></div>
              <div class="ring-metric"><div class="ring-metric__value" style="color:#dc2626">{{ $kualitas['tidak_memenuhi'] }}</div><div class="ring-metric__label">Tidak Memenuhi</div></div>
              <div class="ring-metric"><div class="ring-metric__value" style="color:#d97706">{{ $kualitas['belum_diuji'] }}</div><div class="ring-metric__label">Belum Diuji</div></div>
            </div>
            <div class="ring-chart-row">
              <div><div id="chartKualitasStatus" style="min-height:300px"></div></div>
              <div><div id="chartKualitasJenis" style="min-height:300px"></div></div>
            </div>
          </div>
        </div>

        {{-- TAB 3: SARPRAS --}}
        <div class="ring-panel" id="panel-sarpras">
          <div class="ring-section">
            <h3 class="ring-section__title"><i class="bi bi-tools"></i> Ringkasan Sarana & Prasarana</h3>
            <div class="ring-grid">
              <div class="ring-metric"><div class="ring-metric__value">{{ $sarpras['total_data'] }}</div><div class="ring-metric__label">Jenis Peralatan</div></div>
              <div class="ring-metric"><div class="ring-metric__value">{{ number_format($sarpras['total_unit']) }}</div><div class="ring-metric__label">Total Unit</div></div>
              <div class="ring-metric"><div class="ring-metric__value" style="color:#059669">{{ number_format($sarpras['total_beroperasi']) }}</div><div class="ring-metric__label">Beroperasi</div></div>
              <div class="ring-metric"><div class="ring-metric__value" style="color:#dc2626">{{ number_format($sarpras['total_rusak']) }}</div><div class="ring-metric__label">Rusak</div></div>
            </div>
            <div class="ring-chart-row">
              <div><div id="chartSarpras" style="min-height:300px"></div></div>
              <div style="display:flex;align-items:center;justify-content:center"><div id="chartSarprasPie" style="min-height:300px;width:100%"></div></div>
            </div>
          </div>
        </div>

        {{-- TAB 4: RTH --}}
        <div class="ring-panel" id="panel-rth">
          <div class="ring-section">
            <h3 class="ring-section__title"><i class="bi bi-tree"></i> Ringkasan Ruang Terbuka Hijau</h3>
            <div class="ring-grid">
              <div class="ring-metric"><div class="ring-metric__value">{{ $rth['total_data'] }}</div><div class="ring-metric__label">Total Data</div></div>
              <div class="ring-metric"><div class="ring-metric__value">{{ number_format($rth['total_luas'],2) }}</div><div class="ring-metric__label">Total Luas (Ha)</div></div>
              <div class="ring-metric"><div class="ring-metric__value" style="color:#10b981">{{ number_format($rth['luas_a'],2) }}</div><div class="ring-metric__label">Tipologi A</div></div>
              <div class="ring-metric"><div class="ring-metric__value" style="color:#8b5cf6">{{ number_format($rth['luas_b'],2) }}</div><div class="ring-metric__label">Tipologi B</div></div>
              <div class="ring-metric"><div class="ring-metric__value" style="color:#06b6d4">{{ number_format($rth['luas_c'],2) }}</div><div class="ring-metric__label">Tipologi C</div></div>
            </div>
            <div class="ring-chart-row">
              <div><div id="chartRth" style="min-height:300px"></div></div>
              <div style="display:flex;flex-direction:column;justify-content:center;gap:12px;padding:20px">
                <p style="font-size:14px;color:#64748b;line-height:1.8">
                  <strong>Tipologi A</strong> = RTH Publik (taman kota, hutan kota, jalur hijau)<br>
                  <strong>Tipologi B</strong> = RTH Privat (pekarangan, halaman gedung)<br>
                  <strong>Tipologi C</strong> = RTH Badan Air (sempadan sungai, waduk)
                </p>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>
  </div>
  @include('partials.footer')

  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <script>
    function switchTab(tab) {
      document.querySelectorAll('.ring-tab').forEach(t => t.classList.remove('active'));
      document.querySelectorAll('.ring-panel').forEach(p => p.classList.remove('active'));
      document.getElementById('panel-' + tab).classList.add('active');
      event.currentTarget.classList.add('active');
    }

    const co = { chart:{fontFamily:'system-ui',toolbar:{show:false}}, tooltip:{theme:'light'} };

    // Sampah charts
    @if(!empty($sampah['chart_labels']))
    new ApexCharts(document.querySelector("#chartSampahBar"),{...co,series:[{name:'Volume (Ton)',data:@json($sampah['chart_values'])}],chart:{type:'bar',height:300},xaxis:{categories:@json($sampah['chart_labels']),labels:{rotate:-35,style:{fontSize:'10px'}}},colors:['#10b981'],plotOptions:{bar:{borderRadius:4,columnWidth:'60%'}},dataLabels:{enabled:true,style:{fontSize:'10px'}}}).render();
    @endif
    @php $stot = $sampah['total_terangkut']+$sampah['total_diolah']; $sother = max(0,$sampah['total_volume']-$stot); @endphp
    new ApexCharts(document.querySelector("#chartSampahPie"),{...co,series:[{{ $sampah['total_terangkut'] }},{{ $sampah['total_diolah'] }},{{ $sother }}],labels:['Terangkut','Diolah','Tidak Terkelola'],chart:{type:'donut',height:300},colors:['#f59e0b','#10b981','#ef4444'],plotOptions:{pie:{donut:{size:'60%'}}},legend:{position:'bottom'}}).render();

    // Kualitas charts
    new ApexCharts(document.querySelector("#chartKualitasStatus"),{...co,series:[{{ $kualitas['memenuhi'] }},{{ $kualitas['tidak_memenuhi'] }},{{ $kualitas['belum_diuji'] }}],labels:['Memenuhi','Tidak Memenuhi','Belum Diuji'],chart:{type:'donut',height:300},colors:['#10b981','#ef4444','#f59e0b'],plotOptions:{pie:{donut:{size:'60%'}}},legend:{position:'bottom'}}).render();
    new ApexCharts(document.querySelector("#chartKualitasJenis"),{...co,series:[{name:'Jumlah',data:[{{ $kualitas['by_jenis']['air_sungai'] }},{{ $kualitas['by_jenis']['air_laut'] }},{{ $kualitas['by_jenis']['udara_ambien'] }},{{ $kualitas['by_jenis']['tanah'] }},{{ $kualitas['by_jenis']['kebisingan'] }}]}],chart:{type:'bar',height:300},xaxis:{categories:['Air Sungai','Air Laut','Udara','Tanah','Kebisingan']},colors:['#3b82f6'],plotOptions:{bar:{borderRadius:6,columnWidth:'55%'}},dataLabels:{enabled:true}}).render();

    // Sarpras charts
    @if(!empty($sarpras['chart_labels']))
    new ApexCharts(document.querySelector("#chartSarpras"),{...co,series:[{name:'Unit',data:@json($sarpras['chart_values'])}],chart:{type:'bar',height:300},xaxis:{categories:@json($sarpras['chart_labels']),labels:{rotate:-35,style:{fontSize:'10px'}}},colors:['#f59e0b'],plotOptions:{bar:{borderRadius:4}},dataLabels:{enabled:false}}).render();
    new ApexCharts(document.querySelector("#chartSarprasPie"),{...co,series:@json($sarpras['chart_values']),labels:@json($sarpras['chart_labels']),chart:{type:'donut',height:300},colors:['#3b82f6','#10b981','#f59e0b','#ef4444','#8b5cf6','#06b6d4'],plotOptions:{pie:{donut:{size:'60%'}}},legend:{position:'bottom'}}).render();
    @endif

    // RTH chart
    new ApexCharts(document.querySelector("#chartRth"),{...co,series:[{{ $rth['luas_a'] }},{{ $rth['luas_b'] }},{{ $rth['luas_c'] }}],labels:['Tipologi A','Tipologi B','Tipologi C'],chart:{type:'donut',height:300},colors:['#10b981','#8b5cf6','#06b6d4'],plotOptions:{pie:{donut:{size:'60%'}}},legend:{position:'bottom'}}).render();
  </script>
</body>
</html>
