<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Kelola Layer Peta - Bappeda Surabaya</title>

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
        <div class="crud-banner" style="background:linear-gradient(135deg,#0f766e 0%,#0d9488 50%,#14b8a6 100%)">
          <div class="crud-banner__content">
            <h1 class="crud-banner__title">Kelola Layer Peta</h1>
            <p class="crud-banner__subtitle">Upload file GeoJSON/JSON untuk menambahkan layer baru ke peta interaktif. Layer yang di-upload akan muncul di sidebar peta.</p>
            <div class="crud-banner__actions">
              <a href="{{ route('custom-layers.create') }}" class="crud-banner__btn crud-banner__btn--solid"><i class="bi bi-upload"></i> Upload Layer Baru</a>
              <a href="{{ route('peta') }}" class="crud-banner__btn"><i class="bi bi-map"></i> Lihat di Peta</a>
            </div>
          </div>
          <i class="bi bi-layers-fill crud-banner__deco"></i>
        </div>

        {{-- SUMMARY CARDS --}}
        <div class="crud-summary">
          <div class="crud-stat">
            <div class="crud-stat__icon crud-stat__icon--blue"><i class="bi bi-layers"></i></div>
            <div>
              <div class="crud-stat__value">{{ $summary['total_layers'] }}</div>
              <div class="crud-stat__label">Total Layer</div>
            </div>
          </div>
          <div class="crud-stat">
            <div class="crud-stat__icon crud-stat__icon--green"><i class="bi bi-check-circle"></i></div>
            <div>
              <div class="crud-stat__value">{{ $summary['total_active'] }}</div>
              <div class="crud-stat__label">Layer Aktif</div>
            </div>
          </div>
          <div class="crud-stat">
            <div class="crud-stat__icon crud-stat__icon--orange"><i class="bi bi-geo-alt"></i></div>
            <div>
              <div class="crud-stat__value">{{ number_format($summary['total_features']) }}</div>
              <div class="crud-stat__label">Total Fitur</div>
            </div>
          </div>
          <div class="crud-stat">
            <div class="crud-stat__icon crud-stat__icon--teal"><i class="bi bi-diagram-3"></i></div>
            <div>
              <div class="crud-stat__value">
                <span title="Point">{{ $summary['total_points'] }}P</span>
                <span title="Line" style="margin-left:4px">{{ $summary['total_lines'] }}L</span>
                <span title="Polygon" style="margin-left:4px">{{ $summary['total_polygons'] }}A</span>
              </div>
              <div class="crud-stat__label">Tipe Geometri</div>
            </div>
          </div>
        </div>

        {{-- FILTER BAR --}}
        <form class="crud-filters" method="GET" action="{{ route('custom-layers.index') }}">
          <div class="crud-filters__search">
            <i class="bi bi-search"></i>
            <input type="text" name="search" placeholder="Cari nama layer, deskripsi..." value="{{ request('search') }}">
          </div>
          <button type="submit" class="crud-btn crud-btn--primary crud-btn--sm"><i class="bi bi-funnel"></i> Filter</button>
          @if(request()->hasAny(['search']))
            <a href="{{ route('custom-layers.index') }}" class="crud-btn crud-btn--outline crud-btn--sm"><i class="bi bi-x-lg"></i> Reset</a>
          @endif
        </form>

        {{-- DATA TABLE --}}
        <div class="crud-table-card">
          @if($layers->count() > 0)
            <div class="crud-table-wrap">
              <table class="crud-table">
                <thead>
                  <tr>
                    <th style="width:50px">No</th>
                    <th>Layer</th>
                    <th>Tipe</th>
                    <th class="text-center">Fitur</th>
                    <th>File Asli</th>
                    <th>Di-upload</th>
                    <th class="text-center">Status</th>
                    <th style="width:160px">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($layers as $i => $layer)
                    <tr>
                      <td class="text-center">{{ $layers->firstItem() + $i }}</td>
                      <td>
                        <div style="display:flex;align-items:center;gap:8px">
                          <span style="width:14px;height:14px;border-radius:50%;background:{{ $layer->color }};flex-shrink:0;border:2px solid rgba(255,255,255,.6);box-shadow:0 0 0 1px rgba(0,0,0,.1)"></span>
                          <div>
                            <strong>{{ $layer->name }}</strong>
                            <div style="display:flex;align-items:center;gap:6px;margin-top:2px;flex-wrap:wrap">
                              @php
                                $catLabels = [
                                  'infrastruktur' => 'Infrastruktur',
                                  'pendidikan' => 'Pendidikan',
                                  'persampahan' => 'Persampahan & Lingkungan',
                                  'fasilitas' => 'Fasilitas Umum',
                                  'demografi' => 'Demografi',
                                  'pompa_saluran' => 'Pompa & Saluran Air'
                                ];
                              @endphp
                              <span style="font-size:10px;background:#f1f5f9;color:#475569;padding:1px 6px;border-radius:4px;border:1px solid #e2e8f0;font-weight:600">
                                Kategori: {{ $catLabels[$layer->category] ?? ucfirst($layer->category) }}
                              </span>
                              @if($layer->description)
                                <span style="font-size:11px;color:#64748b">— {{ Str::limit($layer->description, 45) }}</span>
                              @endif
                            </div>
                          </div>
                        </div>
                      </td>
                      <td>
                        @php
                          $typeIcons = ['point' => 'bi-geo-alt-fill', 'line' => 'bi-bezier2', 'polygon' => 'bi-pentagon-fill', 'mixed' => 'bi-diagram-3-fill'];
                          $typeLabels = ['point' => 'Titik', 'line' => 'Garis', 'polygon' => 'Area', 'mixed' => 'Campuran'];
                        @endphp
                        <span class="crud-badge crud-badge--blue" style="font-size:11px">
                          <i class="bi {{ $typeIcons[$layer->geometry_type] ?? 'bi-question' }}"></i>
                          {{ $typeLabels[$layer->geometry_type] ?? $layer->geometry_type }}
                        </span>
                      </td>
                      <td class="text-center text-number">{{ number_format($layer->feature_count) }}</td>
                      <td style="font-size:12px;color:#64748b">{{ Str::limit($layer->original_filename, 30) }}</td>
                      <td style="font-size:12px;color:#64748b">
                        {{ $layer->created_at->diffForHumans() }}
                        <div style="font-size:10px;color:#94a3b8">oleh {{ $layer->user->name ?? '-' }}</div>
                      </td>
                      <td class="text-center">
                        <form action="{{ route('custom-layers.toggle', $layer->id) }}" method="POST" style="display:inline">
                          @csrf @method('PATCH')
                          <button type="submit" class="crud-btn crud-btn--sm" style="border:none;background:none;cursor:pointer;font-size:18px" title="{{ $layer->is_active ? 'Klik untuk nonaktifkan' : 'Klik untuk aktifkan' }}">
                            @if($layer->is_active)
                              <i class="bi bi-toggle-on" style="color:#10b981"></i>
                            @else
                              <i class="bi bi-toggle-off" style="color:#94a3b8"></i>
                            @endif
                          </button>
                        </form>
                      </td>
                      <td>
                        <div class="crud-actions">
                          <a href="{{ route('custom-layers.edit', $layer->id) }}" class="crud-btn crud-btn--warning crud-btn--icon crud-tooltip" data-tooltip="Edit"><i class="bi bi-pencil-square"></i></a>
                          <button type="button" class="crud-btn crud-btn--danger crud-btn--icon crud-tooltip" data-tooltip="Hapus" onclick="confirmDelete({{ $layer->id }}, '{{ addslashes($layer->name) }}')"><i class="bi bi-trash3"></i></button>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            @if($layers->hasPages())
              <div class="crud-pagination">
                <div class="crud-pagination__info">Menampilkan {{ $layers->firstItem() }} - {{ $layers->lastItem() }} dari {{ $layers->total() }} layer</div>
                <div class="crud-pagination__links">
                  @if($layers->onFirstPage()) <span class="disabled">&laquo;</span> @else <a href="{{ $layers->previousPageUrl() }}">&laquo;</a> @endif
                  @foreach($layers->getUrlRange(max($layers->currentPage()-2, 1), min($layers->currentPage()+2, $layers->lastPage())) as $page => $url)
                    @if($page == $layers->currentPage()) <span class="active">{{ $page }}</span> @else <a href="{{ $url }}">{{ $page }}</a> @endif
                  @endforeach
                  @if($layers->hasMorePages()) <a href="{{ $layers->nextPageUrl() }}">&raquo;</a> @else <span class="disabled">&raquo;</span> @endif
                </div>
              </div>
            @endif
          @else
            <div class="crud-empty">
              <div class="crud-empty__icon"><i class="bi bi-layers"></i></div>
              <h3 class="crud-empty__title">Belum Ada Custom Layer</h3>
              <p class="crud-empty__desc">Upload file GeoJSON pertama Anda untuk menambahkan layer baru ke peta.</p>
              <a href="{{ route('custom-layers.create') }}" class="crud-btn crud-btn--primary" style="margin-top:12px"><i class="bi bi-upload"></i> Upload Sekarang</a>
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
      <p class="crud-modal__text">Apakah Anda yakin ingin menghapus layer <strong id="deleteItemName"></strong>? Semua fitur GeoJSON di layer ini juga akan dihapus.</p>
      <div class="crud-modal__actions">
        <button class="crud-btn crud-btn--outline" onclick="closeDeleteModal()">Batal</button>
        <form id="deleteForm" method="POST" style="display:inline">@csrf @method('DELETE')
          <button type="submit" class="crud-btn crud-btn--danger"><i class="bi bi-trash3"></i> Hapus Layer</button>
        </form>
      </div>
    </div>
  </div>

  <script>
    // Auto-hide flash
    setTimeout(() => { const a = document.getElementById('flash-alert'); if(a){a.style.opacity='0'; setTimeout(()=>a.remove(),300);} }, 4000);

    // Delete modal
    function confirmDelete(id, name) {
      document.getElementById('deleteItemName').textContent = name;
      document.getElementById('deleteForm').action = '/custom-layers/' + id;
      document.getElementById('deleteModal').classList.add('active');
    }
    function closeDeleteModal() { document.getElementById('deleteModal').classList.remove('active'); }
    document.getElementById('deleteModal').addEventListener('click', function(e) { if(e.target===this) closeDeleteModal(); });
  </script>
</body>
</html>
