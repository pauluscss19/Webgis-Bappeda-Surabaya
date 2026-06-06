<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Data Sarpras - Bappeda Surabaya</title>
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
        <div class="crud-banner crud-banner--sarpras">
          <div class="crud-banner__content">
            <h1 class="crud-banner__title">Dashboard Sarana & Prasarana</h1>
            <p class="crud-banner__subtitle">Data Peralatan & Kendaraan Operasional DLH Kota Surabaya — Monitoring unit, kondisi, dan kebutuhan BBM.</p>
            <div class="crud-banner__actions">
              <a href="{{ route('sarpras.create') }}" class="crud-banner__btn crud-banner__btn--solid"><i class="bi bi-plus-lg"></i> Tambah Data Baru</a>
              <a href="{{ route('ringkasan') }}" class="crud-banner__btn"><i class="bi bi-bar-chart-line"></i> Lihat Ringkasan</a>
            </div>
          </div>
          <i class="bi bi-tools crud-banner__deco"></i>
        </div>

        <div class="crud-summary">
          <div class="crud-stat">
            <div class="crud-stat__icon crud-stat__icon--blue"><i class="bi bi-database"></i></div>
            <div><div class="crud-stat__value">{{ $summary['total_data'] }}</div><div class="crud-stat__label">Jenis Peralatan</div></div>
          </div>
          <div class="crud-stat">
            <div class="crud-stat__icon crud-stat__icon--green"><i class="bi bi-boxes"></i></div>
            <div><div class="crud-stat__value">{{ number_format($summary['total_unit']) }}</div><div class="crud-stat__label">Total Unit</div></div>
          </div>
          <div class="crud-stat">
            <div class="crud-stat__icon crud-stat__icon--teal"><i class="bi bi-check-circle"></i></div>
            <div><div class="crud-stat__value">{{ number_format($summary['total_beroperasi']) }}</div><div class="crud-stat__label">Beroperasi</div></div>
          </div>
          <div class="crud-stat">
            <div class="crud-stat__icon crud-stat__icon--red"><i class="bi bi-x-circle"></i></div>
            <div><div class="crud-stat__value">{{ number_format($summary['total_rusak']) }}</div><div class="crud-stat__label">Rusak</div></div>
          </div>
        </div>

        <div class="crud-chart-row">
          <div class="crud-chart-card">
            <div class="crud-chart-card__title"><i class="bi bi-bar-chart-fill"></i> Jumlah Unit per Tipe</div>
            <div id="chartBar" style="min-height:320px"></div>
          </div>
          <div class="crud-chart-card">
            <div class="crud-chart-card__title"><i class="bi bi-pie-chart-fill"></i> Distribusi Peralatan</div>
            <div id="chartPie" style="min-height:320px"></div>
          </div>
        </div>

        <form class="crud-filters" method="GET" action="{{ route('sarpras.index') }}">
          <div class="crud-filters__search">
            <i class="bi bi-search"></i>
            <input type="text" name="search" placeholder="Cari tipe peralatan..." value="{{ request('search') }}">
          </div>
          <button type="submit" class="crud-btn crud-btn--primary crud-btn--sm"><i class="bi bi-funnel"></i> Filter</button>
          @if(request('search'))
            <a href="{{ route('sarpras.index') }}" class="crud-btn crud-btn--outline crud-btn--sm"><i class="bi bi-x-lg"></i> Reset</a>
          @endif
        </form>

        <div class="crud-table-card">
          @if($data->count() > 0)
            <div class="crud-table-wrap">
              <table class="crud-table">
                <thead>
                  <tr>
                    <th style="width:50px">No</th>
                    <th>Tipe Peralatan</th>
                    <th>Jenis BBM</th>
                    <th class="text-center">Total</th>
                    <th class="text-center">Beroperasi</th>
                    <th class="text-center">Rusak</th>
                    <th class="text-right">BBM Pertamax/Thn</th>
                    <th class="text-right">BBM Dexlite/Thn</th>
                    <th style="width:130px">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($data as $i => $item)
                    <tr>
                      <td class="text-center">{{ $data->firstItem() + $i }}</td>
                      <td><strong>{{ $item->tipe_peralatan ?? '-' }}</strong></td>
                      <td>{{ $item->jenis_bbm ?? '-' }}</td>
                      <td class="text-center text-number">{{ $item->jumlah_total ?? 0 }}</td>
                      <td class="text-center"><span class="crud-badge crud-badge--green">{{ $item->jumlah_beroperasi ?? 0 }}</span></td>
                      <td class="text-center"><span class="crud-badge crud-badge--red">{{ $item->jumlah_rusak ?? 0 }}</span></td>
                      <td class="text-right text-number">{{ number_format($item->kebutuhan_1_tahun_pertamax ?? 0, 0) }} L</td>
                      <td class="text-right text-number">{{ number_format($item->kebutuhan_1_tahun_dexlite ?? 0, 0) }} L</td>
                      <td>
                        <div class="crud-actions">
                          <a href="{{ route('sarpras.edit', $item->id) }}" class="crud-btn crud-btn--warning crud-btn--icon crud-tooltip" data-tooltip="Edit"><i class="bi bi-pencil-square"></i></a>
                          <button type="button" class="crud-btn crud-btn--danger crud-btn--icon crud-tooltip" data-tooltip="Hapus" onclick="confirmDelete({{ $item->id }},'{{ $item->tipe_peralatan }}')"><i class="bi bi-trash3"></i></button>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            @if($data->hasPages())
              <div class="crud-pagination">
                <div class="crud-pagination__info">{{ $data->firstItem() }}-{{ $data->lastItem() }} dari {{ $data->total() }}</div>
                <div class="crud-pagination__links">
                  @if($data->onFirstPage())<span class="disabled">&laquo;</span>@else<a href="{{ $data->previousPageUrl() }}">&laquo;</a>@endif
                  @foreach($data->getUrlRange(max($data->currentPage()-2,1),min($data->currentPage()+2,$data->lastPage())) as $p=>$u)
                    @if($p==$data->currentPage())<span class="active">{{ $p }}</span>@else<a href="{{ $u }}">{{ $p }}</a>@endif
                  @endforeach
                  @if($data->hasMorePages())<a href="{{ $data->nextPageUrl() }}">&raquo;</a>@else<span class="disabled">&raquo;</span>@endif
                </div>
              </div>
            @endif
          @else
            <div class="crud-empty"><div class="crud-empty__icon"><i class="bi bi-tools"></i></div><h3 class="crud-empty__title">Belum Ada Data</h3></div>
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
    function confirmDelete(id,n){document.getElementById('deleteItemName').textContent=n;document.getElementById('deleteForm').action='/sarpras/'+id;document.getElementById('deleteModal').classList.add('active');}
    function closeDeleteModal(){document.getElementById('deleteModal').classList.remove('active');}
    document.getElementById('deleteModal').addEventListener('click',function(e){if(e.target===this)closeDeleteModal();});

    const co={chart:{fontFamily:'system-ui',toolbar:{show:false}},tooltip:{theme:'light'}};
    @if(!empty($chartData['labels']))
    new ApexCharts(document.querySelector("#chartBar"),{...co,series:[{name:'Total',data:@json($chartData['values'])},{name:'Beroperasi',data:@json($chartData['beroperasi'])},{name:'Rusak',data:@json($chartData['rusak'])}],chart:{type:'bar',height:320,stacked:false},xaxis:{categories:@json($chartData['labels']),labels:{rotate:-35,style:{fontSize:'10px'}}},colors:['#3b82f6','#10b981','#ef4444'],plotOptions:{bar:{borderRadius:4,columnWidth:'70%'}},dataLabels:{enabled:false},legend:{position:'top'}}).render();
    new ApexCharts(document.querySelector("#chartPie"),{...co,series:@json($chartData['values']),labels:@json($chartData['labels']),chart:{type:'donut',height:320},colors:['#3b82f6','#10b981','#f59e0b','#ef4444','#8b5cf6','#06b6d4','#ec4899'],plotOptions:{pie:{donut:{size:'60%'}}},legend:{position:'bottom'}}).render();
    @endif
  </script>
</body>
</html>
