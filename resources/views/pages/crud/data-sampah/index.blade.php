<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Data Sampah - Bappeda Surabaya</title>

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
            <i class="bi bi-check-circle-fill"></i>
            {{ session('success') }}
            <button class="crud-alert__close" onclick="this.parentElement.remove()">&times;</button>
          </div>
        @endif

        {{-- BANNER CARD --}}
        <div class="crud-banner crud-banner--sampah">
          <div class="crud-banner__content">
            <h1 class="crud-banner__title">Dashboard Data Sampah</h1>
            <p class="crud-banner__subtitle">Data Terpadu Pengelolaan Sampah & Kebersihan Kota Surabaya — Kelola, monitor, dan analisis data persampahan secara real-time.</p>
            <div class="crud-banner__actions">
              <a href="{{ route('data-sampah.create') }}" class="crud-banner__btn crud-banner__btn--solid"><i class="bi bi-plus-lg"></i> Tambah Data Baru</a>
              <a href="{{ route('ringkasan') }}" class="crud-banner__btn"><i class="bi bi-bar-chart-line"></i> Lihat Ringkasan</a>
            </div>
          </div>
          <i class="bi bi-trash3-fill crud-banner__deco"></i>
        </div>

        {{-- SUMMARY CARDS --}}
        <div class="crud-summary">
          <div class="crud-stat">
            <div class="crud-stat__icon crud-stat__icon--blue"><i class="bi bi-database"></i></div>
            <div>
              <div class="crud-stat__value">{{ number_format($summary['total_data']) }}</div>
              <div class="crud-stat__label">Total Data</div>
            </div>
          </div>
          <div class="crud-stat">
            <div class="crud-stat__icon crud-stat__icon--green"><i class="bi bi-box-seam"></i></div>
            <div>
              <div class="crud-stat__value">{{ number_format($summary['total_volume'], 1) }}</div>
              <div class="crud-stat__label">Volume (Ton)</div>
            </div>
          </div>
          <div class="crud-stat">
            <div class="crud-stat__icon crud-stat__icon--orange"><i class="bi bi-truck"></i></div>
            <div>
              <div class="crud-stat__value">{{ number_format($summary['total_terangkut'], 1) }}</div>
              <div class="crud-stat__label">Terangkut (Ton)</div>
            </div>
          </div>
          <div class="crud-stat">
            <div class="crud-stat__icon crud-stat__icon--teal"><i class="bi bi-recycle"></i></div>
            <div>
              <div class="crud-stat__value">{{ number_format($summary['total_diolah'], 1) }}</div>
              <div class="crud-stat__label">Diolah (Ton)</div>
            </div>
          </div>
        </div>

        {{-- CHARTS --}}
        <div class="crud-chart-row">
          <div class="crud-chart-card">
            <div class="crud-chart-card__title"><i class="bi bi-bar-chart-fill"></i> Volume Sampah per Kecamatan</div>
            <div id="chartBar" style="min-height:320px"></div>
          </div>
          <div class="crud-chart-card">
            <div class="crud-chart-card__title"><i class="bi bi-pie-chart-fill"></i> Komposisi Pengelolaan</div>
            <div id="chartPie" style="min-height:320px"></div>
          </div>
        </div>

        {{-- FILTER BAR --}}
        <form class="crud-filters" method="GET" action="{{ route('data-sampah.index') }}">
          <div class="crud-filters__search">
            <i class="bi bi-search"></i>
            <input type="text" name="search" placeholder="Cari kecamatan, kelurahan..." value="{{ request('search') }}">
          </div>
          <select name="tahun" onchange="this.form.submit()">
            <option value="">Semua Tahun</option>
            @foreach($tahunList as $t)
              <option value="{{ $t }}" {{ request('tahun') == $t ? 'selected' : '' }}>{{ $t }}</option>
            @endforeach
          </select>
          <button type="submit" class="crud-btn crud-btn--primary crud-btn--sm"><i class="bi bi-funnel"></i> Filter</button>
          @if(request()->hasAny(['search', 'tahun']))
            <a href="{{ route('data-sampah.index') }}" class="crud-btn crud-btn--outline crud-btn--sm"><i class="bi bi-x-lg"></i> Reset</a>
          @endif
        </form>

        {{-- DATA TABLE --}}
        <div class="crud-table-card">
          @if($data->count() > 0)
            <div class="crud-table-wrap">
              <table class="crud-table">
                <thead>
                  <tr>
                    <th style="width:50px">No</th>
                    <th>Kecamatan</th>
                    <th>Kelurahan</th>
                    <th class="text-right">Volume (Ton)</th>
                    <th class="text-right">Terangkut</th>
                    <th class="text-right">Diolah</th>
                    <th class="text-center">TPS</th>
                    <th class="text-center">Bank Sampah</th>
                    <th class="text-center">Tahun</th>
                    <th style="width:130px">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($data as $i => $item)
                    <tr>
                      <td class="text-center">{{ $data->firstItem() + $i }}</td>
                      <td><strong>{{ $item->kecamatan }}</strong></td>
                      <td>{{ $item->kelurahan ?? '-' }}</td>
                      <td class="text-right text-number">{{ number_format($item->volume_sampah_ton, 2) }}</td>
                      <td class="text-right text-number">{{ number_format($item->sampah_terangkut_ton, 2) }}</td>
                      <td class="text-right text-number">{{ number_format($item->sampah_diolah_ton, 2) }}</td>
                      <td class="text-center text-number">{{ $item->jumlah_tps }}</td>
                      <td class="text-center text-number">{{ $item->jumlah_bank_sampah }}</td>
                      <td class="text-center"><span class="crud-badge crud-badge--blue">{{ $item->tahun }}</span></td>
                      <td>
                        <div class="crud-actions">
                          <a href="{{ route('data-sampah.edit', $item->id) }}" class="crud-btn crud-btn--warning crud-btn--icon crud-tooltip" data-tooltip="Edit"><i class="bi bi-pencil-square"></i></a>
                          <button type="button" class="crud-btn crud-btn--danger crud-btn--icon crud-tooltip" data-tooltip="Hapus" onclick="confirmDelete({{ $item->id }}, '{{ $item->kecamatan }}')"><i class="bi bi-trash3"></i></button>
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
                  @if($data->onFirstPage()) <span class="disabled">&laquo;</span> @else <a href="{{ $data->previousPageUrl() }}">&laquo;</a> @endif
                  @foreach($data->getUrlRange(max($data->currentPage()-2, 1), min($data->currentPage()+2, $data->lastPage())) as $page => $url)
                    @if($page == $data->currentPage()) <span class="active">{{ $page }}</span> @else <a href="{{ $url }}">{{ $page }}</a> @endif
                  @endforeach
                  @if($data->hasMorePages()) <a href="{{ $data->nextPageUrl() }}">&raquo;</a> @else <span class="disabled">&raquo;</span> @endif
                </div>
              </div>
            @endif
          @else
            <div class="crud-empty">
              <div class="crud-empty__icon"><i class="bi bi-inbox"></i></div>
              <h3 class="crud-empty__title">Belum Ada Data</h3>
              <p class="crud-empty__desc">Mulai tambahkan data sampah pertama Anda.</p>
            </div>
          @endif
        </div>
      </div>
    </section>
  </div>

  @include('partials.footer')

  {{-- DELETE MODAL --}}
  <div class="crud-modal-overlay" id="deleteModal">
    <div class="crud-modal">
      <div class="crud-modal__icon"><i class="bi bi-exclamation-triangle"></i></div>
      <h3 class="crud-modal__title">Konfirmasi Hapus</h3>
      <p class="crud-modal__text">Apakah Anda yakin ingin menghapus data <strong id="deleteItemName"></strong>?</p>
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
    // Auto-hide flash
    setTimeout(() => { const a = document.getElementById('flash-alert'); if(a){a.style.opacity='0'; setTimeout(()=>a.remove(),300);} }, 4000);

    // Delete modal
    function confirmDelete(id, name) {
      document.getElementById('deleteItemName').textContent = name;
      document.getElementById('deleteForm').action = '/data-sampah/' + id;
      document.getElementById('deleteModal').classList.add('active');
    }
    function closeDeleteModal() { document.getElementById('deleteModal').classList.remove('active'); }
    document.getElementById('deleteModal').addEventListener('click', function(e) { if(e.target===this) closeDeleteModal(); });

    // Charts
    const chartOpts = { chart: { fontFamily: 'system-ui, sans-serif', toolbar: { show: false } }, tooltip: { theme: 'light' } };

    @php
      $chartLabels = $data->pluck('kecamatan')->toArray();
      $chartVolume = $data->pluck('volume_sampah_ton')->toArray();
      $chartTerangkut = $data->pluck('sampah_terangkut_ton')->toArray();
      $chartDiolah = $data->pluck('sampah_diolah_ton')->toArray();
    @endphp

    @if($data->count() > 0)
    new ApexCharts(document.querySelector("#chartBar"), {
      ...chartOpts,
      series: [
        { name: 'Volume', data: @json($chartVolume) },
        { name: 'Terangkut', data: @json($chartTerangkut) },
        { name: 'Diolah', data: @json($chartDiolah) },
      ],
      chart: { type: 'bar', height: 320, stacked: false },
      xaxis: { categories: @json($chartLabels), labels: { rotate: -35, style: { fontSize: '11px' } } },
      colors: ['#3b82f6', '#f59e0b', '#10b981'],
      plotOptions: { bar: { borderRadius: 4, columnWidth: '65%' } },
      dataLabels: { enabled: false },
      legend: { position: 'top' }
    }).render();

    new ApexCharts(document.querySelector("#chartPie"), {
      ...chartOpts,
      series: [{{ $summary['total_terangkut'] }}, {{ $summary['total_diolah'] }}, {{ $summary['total_volume'] - $summary['total_terangkut'] - $summary['total_diolah'] }}],
      labels: ['Terangkut', 'Diolah', 'Tidak Terkelola'],
      chart: { type: 'donut', height: 320 },
      colors: ['#f59e0b', '#10b981', '#ef4444'],
      plotOptions: { pie: { donut: { size: '60%' } } },
      legend: { position: 'bottom' }
    }).render();
    @endif
  </script>
</body>
</html>
