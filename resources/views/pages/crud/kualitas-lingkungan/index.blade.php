<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Data Kualitas Lingkungan - Bappeda Surabaya</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
  <link rel="stylesheet" href="{{ asset('css/crud.css') }}">
</head>

<body class="app-shell">
  @include('partials.header')

  <div class="app-shell__content">
    <section class="crud-page">
      <div class="crud-container">

        @if(session('success'))
          <div class="crud-alert crud-alert--success" id="flash-alert">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            <button class="crud-alert__close" onclick="this.parentElement.remove()">&times;</button>
          </div>
        @endif

        {{-- BANNER CARD --}}
        <div class="crud-banner crud-banner--lingkungan">
          <div class="crud-banner__content">
            <h1 class="crud-banner__title">Dashboard Kualitas Lingkungan</h1>
            <p class="crud-banner__subtitle">Data Pengujian Kualitas Air, Udara, Tanah & Kebisingan — Monitoring standar baku mutu lingkungan hidup Kota Surabaya.</p>
            <div class="crud-banner__actions">
              <a href="{{ route('kualitas-lingkungan.create') }}" class="crud-banner__btn crud-banner__btn--solid"><i class="bi bi-plus-lg"></i> Tambah Data Baru</a>
              <a href="{{ route('ringkasan') }}" class="crud-banner__btn"><i class="bi bi-bar-chart-line"></i> Lihat Ringkasan</a>
            </div>
          </div>
          <i class="bi bi-droplet-half crud-banner__deco"></i>
        </div>

        {{-- SUMMARY CARDS --}}
        <div class="crud-summary">
          <div class="crud-stat">
            <div class="crud-stat__icon crud-stat__icon--blue"><i class="bi bi-clipboard-data"></i></div>
            <div><div class="crud-stat__value">{{ $summary['total_data'] }}</div><div class="crud-stat__label">Total Data</div></div>
          </div>
          <div class="crud-stat">
            <div class="crud-stat__icon crud-stat__icon--green"><i class="bi bi-check-circle"></i></div>
            <div><div class="crud-stat__value">{{ $summary['memenuhi'] }}</div><div class="crud-stat__label">Memenuhi</div></div>
          </div>
          <div class="crud-stat">
            <div class="crud-stat__icon crud-stat__icon--red"><i class="bi bi-x-circle"></i></div>
            <div><div class="crud-stat__value">{{ $summary['tidak_memenuhi'] }}</div><div class="crud-stat__label">Tidak Memenuhi</div></div>
          </div>
          <div class="crud-stat">
            <div class="crud-stat__icon crud-stat__icon--orange"><i class="bi bi-hourglass-split"></i></div>
            <div><div class="crud-stat__value">{{ $summary['belum_diuji'] }}</div><div class="crud-stat__label">Belum Diuji</div></div>
          </div>
        </div>

        {{-- CHARTS --}}
        <div class="crud-chart-row">
          <div class="crud-chart-card">
            <div class="crud-chart-card__title"><i class="bi bi-pie-chart-fill"></i> Status Kualitas</div>
            <div id="chartStatus" style="min-height:320px"></div>
          </div>
          <div class="crud-chart-card">
            <div class="crud-chart-card__title"><i class="bi bi-bar-chart-fill"></i> Jumlah per Jenis Uji</div>
            <div id="chartJenis" style="min-height:320px"></div>
          </div>
        </div>

        {{-- FILTER --}}
        <form class="crud-filters" method="GET" action="{{ route('kualitas-lingkungan.index') }}">
          <div class="crud-filters__search">
            <i class="bi bi-search"></i>
            <input type="text" name="search" placeholder="Cari lokasi, parameter..." value="{{ request('search') }}">
          </div>
          <select name="jenis_uji" onchange="this.form.submit()">
            <option value="">Semua Jenis</option>
            <option value="air_sungai" {{ request('jenis_uji')=='air_sungai'?'selected':'' }}>Air Sungai</option>
            <option value="air_laut" {{ request('jenis_uji')=='air_laut'?'selected':'' }}>Air Laut</option>
            <option value="udara_ambien" {{ request('jenis_uji')=='udara_ambien'?'selected':'' }}>Udara Ambien</option>
            <option value="tanah" {{ request('jenis_uji')=='tanah'?'selected':'' }}>Tanah</option>
            <option value="kebisingan" {{ request('jenis_uji')=='kebisingan'?'selected':'' }}>Kebisingan</option>
          </select>
          <select name="status" onchange="this.form.submit()">
            <option value="">Semua Status</option>
            <option value="memenuhi" {{ request('status')=='memenuhi'?'selected':'' }}>Memenuhi</option>
            <option value="tidak_memenuhi" {{ request('status')=='tidak_memenuhi'?'selected':'' }}>Tidak Memenuhi</option>
            <option value="belum_diuji" {{ request('status')=='belum_diuji'?'selected':'' }}>Belum Diuji</option>
          </select>
          <button type="submit" class="crud-btn crud-btn--primary crud-btn--sm"><i class="bi bi-funnel"></i> Filter</button>
          @if(request()->hasAny(['search','jenis_uji','status','tahun']))
            <a href="{{ route('kualitas-lingkungan.index') }}" class="crud-btn crud-btn--outline crud-btn--sm"><i class="bi bi-x-lg"></i> Reset</a>
          @endif
        </form>

        {{-- TABLE --}}
        <div class="crud-table-card">
          @if($data->count() > 0)
            <div class="crud-table-wrap">
              <table class="crud-table">
                <thead>
                  <tr>
                    <th style="width:50px">No</th>
                    <th>Lokasi</th>
                    <th>Jenis Uji</th>
                    <th>Parameter</th>
                    <th class="text-right">Nilai</th>
                    <th class="text-right">Baku Mutu</th>
                    <th class="text-center">Status</th>
                    <th style="width:130px">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($data as $i => $item)
                    <tr>
                      <td class="text-center">{{ $data->firstItem() + $i }}</td>
                      <td><strong>{{ $item->lokasi }}</strong>@if($item->kecamatan)<br><small style="color:#94a3b8">{{ $item->kecamatan }}</small>@endif</td>
                      <td><span class="crud-badge crud-badge--blue">{{ $item->jenis_uji_label }}</span></td>
                      <td>{{ $item->parameter_uji }}</td>
                      <td class="text-right text-number">{{ $item->nilai_hasil !== null ? number_format($item->nilai_hasil, 2) : '-' }} @if($item->satuan)<small style="color:#94a3b8">{{ $item->satuan }}</small>@endif</td>
                      <td class="text-right text-number">{{ $item->baku_mutu !== null ? number_format($item->baku_mutu, 2) : '-' }}</td>
                      <td class="text-center">
                        @if($item->status == 'memenuhi')<span class="crud-badge crud-badge--green"><i class="bi bi-check-circle"></i> Memenuhi</span>
                        @elseif($item->status == 'tidak_memenuhi')<span class="crud-badge crud-badge--red"><i class="bi bi-x-circle"></i> Tidak Memenuhi</span>
                        @else<span class="crud-badge crud-badge--yellow"><i class="bi bi-hourglass"></i> Belum Diuji</span>@endif
                      </td>
                      <td>
                        <div class="crud-actions">
                          <a href="{{ route('kualitas-lingkungan.edit', $item->id) }}" class="crud-btn crud-btn--warning crud-btn--icon crud-tooltip" data-tooltip="Edit"><i class="bi bi-pencil-square"></i></a>
                          <button type="button" class="crud-btn crud-btn--danger crud-btn--icon crud-tooltip" data-tooltip="Hapus" onclick="confirmDelete({{ $item->id }},'{{ $item->lokasi }}')"><i class="bi bi-trash3"></i></button>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            @if($data->hasPages())
              <div class="crud-pagination">
                <div class="crud-pagination__info">Menampilkan {{ $data->firstItem() }} - {{ $data->lastItem() }} dari {{ $data->total() }} data</div>
                <div class="crud-pagination__links">
                  @if($data->onFirstPage())<span class="disabled">&laquo;</span>@else<a href="{{ $data->previousPageUrl() }}">&laquo;</a>@endif
                  @foreach($data->getUrlRange(max($data->currentPage()-2,1), min($data->currentPage()+2,$data->lastPage())) as $page => $url)
                    @if($page==$data->currentPage())<span class="active">{{ $page }}</span>@else<a href="{{ $url }}">{{ $page }}</a>@endif
                  @endforeach
                  @if($data->hasMorePages())<a href="{{ $data->nextPageUrl() }}">&raquo;</a>@else<span class="disabled">&raquo;</span>@endif
                </div>
              </div>
            @endif
          @else
            <div class="crud-empty">
              <div class="crud-empty__icon"><i class="bi bi-droplet"></i></div>
              <h3 class="crud-empty__title">Belum Ada Data</h3>
              <p class="crud-empty__desc">Mulai tambahkan data kualitas lingkungan.</p>
            </div>
          @endif
        </div>
      </div>
    </section>
  </div>

  @include('partials.footer')

  <div class="crud-modal-overlay" id="deleteModal">
    <div class="crud-modal">
      <div class="crud-modal__icon"><i class="bi bi-exclamation-triangle"></i></div>
      <h3 class="crud-modal__title">Konfirmasi Hapus</h3>
      <p class="crud-modal__text">Hapus data <strong id="deleteItemName"></strong>?</p>
      <div class="crud-modal__actions">
        <button class="crud-btn crud-btn--outline" onclick="closeDeleteModal()">Batal</button>
        <form id="deleteForm" method="POST" style="display:inline">@csrf @method('DELETE')
          <button type="submit" class="crud-btn crud-btn--danger"><i class="bi bi-trash3"></i> Hapus</button>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <script>
    setTimeout(()=>{const a=document.getElementById('flash-alert');if(a){a.style.opacity='0';setTimeout(()=>a.remove(),300);}},4000);
    function confirmDelete(id,name){document.getElementById('deleteItemName').textContent=name;document.getElementById('deleteForm').action='/kualitas-lingkungan/'+id;document.getElementById('deleteModal').classList.add('active');}
    function closeDeleteModal(){document.getElementById('deleteModal').classList.remove('active');}
    document.getElementById('deleteModal').addEventListener('click',function(e){if(e.target===this)closeDeleteModal();});

    const co = { chart:{fontFamily:'system-ui',toolbar:{show:false}}, tooltip:{theme:'light'} };

    @if($summary['total_data'] > 0)
    new ApexCharts(document.querySelector("#chartStatus"), {
      ...co, series: [{{ $summary['memenuhi'] }}, {{ $summary['tidak_memenuhi'] }}, {{ $summary['belum_diuji'] }}],
      labels: ['Memenuhi', 'Tidak Memenuhi', 'Belum Diuji'],
      chart: { type: 'donut', height: 320 },
      colors: ['#10b981', '#ef4444', '#f59e0b'],
      plotOptions: { pie: { donut: { size: '60%' } } },
      legend: { position: 'bottom' }
    }).render();

    @php
      $jenisLabels = ['Air Sungai','Air Laut','Udara Ambien','Tanah','Kebisingan'];
      $jenisKeys = ['air_sungai','air_laut','udara_ambien','tanah','kebisingan'];
      $jenisValues = [];
      foreach($jenisKeys as $k) {
        $jenisValues[] = \App\Models\DataKualitasLingkungan::where('jenis_uji', $k)->count();
      }
    @endphp
    new ApexCharts(document.querySelector("#chartJenis"), {
      ...co, series: [{ name: 'Jumlah', data: @json($jenisValues) }],
      chart: { type: 'bar', height: 320 },
      xaxis: { categories: @json($jenisLabels) },
      colors: ['#3b82f6'],
      plotOptions: { bar: { borderRadius: 6, columnWidth: '55%' } },
      dataLabels: { enabled: true }
    }).render();
    @endif
  </script>
</body>
</html>
