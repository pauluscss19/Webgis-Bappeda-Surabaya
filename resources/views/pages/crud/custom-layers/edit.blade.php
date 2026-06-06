<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Edit Layer - {{ $customLayer->name }}</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
  <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
  <link rel="stylesheet" href="{{ asset('css/crud.css') }}">
  <style>
    #preview-map {
      width: 100%;
      height: 350px;
      border-radius: 10px;
      border: 2px solid #e2e8f0;
      margin-top: 8px;
    }
    .color-picker-wrap {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .color-picker-wrap input[type="color"] {
      width: 44px;
      height: 44px;
      border: 2px solid #e2e8f0;
      border-radius: 10px;
      cursor: pointer;
      padding: 2px;
    }
    .color-hex-input { flex: 1; }
    .layer-meta {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
      gap: 10px;
      margin-top: 12px;
    }
    .layer-meta__item {
      background: #f8fafc;
      border: 1px solid #e2e8f0;
      border-radius: 8px;
      padding: 10px 14px;
    }
    .layer-meta__label { font-size: 11px; color: #94a3b8; }
    .layer-meta__value { font-size: 14px; font-weight: 600; color: #1e293b; margin-top: 2px; }

    /* Premium Modal Overlay */
    .feature-modal-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(15, 23, 42, 0.45);
      backdrop-filter: blur(6px);
      -webkit-backdrop-filter: blur(6px);
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 10000;
      opacity: 0;
      visibility: hidden;
      transition: opacity 0.25s ease, visibility 0.25s ease;
    }
    .feature-modal-overlay.active {
      opacity: 1;
      visibility: visible;
    }
    /* Modal Container */
    .feature-modal-container {
      background: #ffffff;
      border-radius: 16px;
      width: 90%;
      max-width: 460px;
      box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.25);
      border: 1px solid rgba(226, 232, 240, 0.8);
      overflow: hidden;
      transform: scale(0.92);
      transition: transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    .feature-modal-overlay.active .feature-modal-container {
      transform: scale(1);
    }
    /* Modal Header */
    .feature-modal-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 18px 24px;
      border-bottom: 1px solid #f1f5f9;
      background: #f8fafc;
    }
    .feature-modal-title {
      font-size: 16px;
      font-weight: 700;
      color: #0f172a;
      margin: 0;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .feature-modal-close-btn {
      background: none;
      border: none;
      color: #94a3b8;
      cursor: pointer;
      font-size: 16px;
      padding: 6px;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.2s;
    }
    .feature-modal-close-btn:hover {
      background: #e2e8f0;
      color: #475569;
    }
    /* Modal Body */
    .feature-modal-body {
      padding: 24px;
      max-height: 60vh;
      overflow-y: auto;
    }
    .modal-geom-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 6px 12px;
      border-radius: 8px;
      font-size: 11px;
      font-weight: 700;
      margin-bottom: 16px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    .modal-geom-badge.badge-point {
      background: rgba(59, 130, 246, 0.1);
      color: #2563eb;
    }
    .modal-geom-badge.badge-polygon {
      background: rgba(16, 185, 129, 0.1);
      color: #059669;
    }
    .modal-coords-container {
      background: #f8fafc;
      border: 1px solid #e2e8f0;
      border-radius: 12px;
      padding: 14px;
      margin-bottom: 18px;
    }
    .modal-coord-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 12px;
    }
    .modal-label {
      font-size: 11px;
      font-weight: 700;
      color: #64748b;
      display: block;
      margin-bottom: 6px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    .modal-input {
      width: 100%;
      padding: 8px 12px;
      border: 1px solid #cbd5e1;
      border-radius: 8px;
      font-size: 13px;
      color: #1e293b;
      box-sizing: border-box;
      transition: border-color 0.2s, box-shadow 0.2s;
    }
    .modal-input:focus {
      outline: none;
      border-color: #3b82f6;
      box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
    }
    .modal-field-group {
      margin-bottom: 16px;
    }
    .modal-field-group:last-child {
      margin-bottom: 0;
    }
    /* Modal Footer */
    .feature-modal-footer {
      display: flex;
      justify-content: flex-end;
      gap: 12px;
      padding: 18px 24px;
      border-top: 1px solid #f1f5f9;
      background: #f8fafc;
    }
  </style>
</head>

<body class="app-shell">
  @include('partials.header')

  <div class="app-shell__content">
    <section class="crud-page">
      <div class="crud-container">

        <a href="{{ route('custom-layers.index') }}" class="crud-back">
          <i class="bi bi-arrow-left"></i> Kembali ke Daftar Layer
        </a>

        {{-- PAGE HEADER --}}
        <div class="crud-header">
          <div class="crud-header__left">
            <div class="crud-header__icon" style="background:linear-gradient(135deg,#0f766e,#14b8a6)">
              <i class="bi bi-pencil-square"></i>
            </div>
            <div>
              <h1 class="crud-header__title">Edit Layer: {{ $customLayer->name }}</h1>
              <p class="crud-header__subtitle">Ubah metadata layer (nama, warna, deskripsi)</p>
            </div>
          </div>
        </div>

        <div class="layer-meta">
          <div class="layer-meta__item">
            <div class="layer-meta__label">Layer Key</div>
            <div class="layer-meta__value" style="font-family:monospace;font-size:12px">{{ $customLayer->layer_key }}</div>
          </div>
          <div class="layer-meta__item">
            <div class="layer-meta__label">File Asli</div>
            <div class="layer-meta__value" style="font-size:12px">{{ $customLayer->original_filename }}</div>
          </div>
          <div class="layer-meta__item">
            <div class="layer-meta__label">Kategori</div>
            <div class="layer-meta__value" style="font-size:12px">
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
              {{ $catLabels[$customLayer->category] ?? ucfirst($customLayer->category) }}
            </div>
          </div>
          <div class="layer-meta__item">
            <div class="layer-meta__label">Jumlah Fitur</div>
            <div class="layer-meta__value" id="meta-feature-count">{{ number_format($customLayer->feature_count) }}</div>
          </div>
          <div class="layer-meta__item">
            <div class="layer-meta__label">Tipe Geometri</div>
            <div class="layer-meta__value" id="meta-geometry-type">
              @php
                $tl = ['point'=>'Titik','line'=>'Garis','polygon'=>'Area','mixed'=>'Campuran'];
              @endphp
              {{ $tl[$customLayer->geometry_type] ?? $customLayer->geometry_type }}
            </div>
          </div>
          <div class="layer-meta__item">
            <div class="layer-meta__label">Di-upload</div>
            <div class="layer-meta__value" style="font-size:12px">{{ $customLayer->created_at->format('d M Y H:i') }}</div>
          </div>
        </div>

        {{-- VALIDATION ERRORS --}}
        @if($errors->any())
          <div class="crud-errors" style="margin-top:16px">
            <div class="crud-errors__title">
              <i class="bi bi-exclamation-circle"></i> Terdapat kesalahan
            </div>
            <ul class="crud-errors__list">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        {{-- FORM --}}
        <div class="crud-form-card" style="margin-top:16px">
          <form id="main-layer-form" method="POST" action="{{ route('custom-layers.update', $customLayer->id) }}">
            @csrf
            @method('PUT')

            {{-- SECTION: Metadata --}}
            <div class="crud-form__section">
              <h3 class="crud-form__section-title">
                <i class="bi bi-tag"></i> Informasi Layer
              </h3>
              <div class="crud-form__grid crud-form__grid--3">
                <div class="crud-form__group">
                  <label class="crud-form__label">Nama Layer <span class="required">*</span></label>
                  <input type="text" name="name" class="crud-form__input"
                         value="{{ old('name', $customLayer->name) }}" required>
                </div>
                <div class="crud-form__group">
                  <label class="crud-form__label">Kategori Peta <span class="required">*</span></label>
                  <select name="category" class="crud-form__select" required>
                    <option value="infrastruktur" {{ old('category', $customLayer->category) == 'infrastruktur' ? 'selected' : '' }}>Infrastruktur</option>
                    <option value="pendidikan" {{ old('category', $customLayer->category) == 'pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                    <option value="persampahan" {{ old('category', $customLayer->category) == 'persampahan' ? 'selected' : '' }}>Persampahan & Lingkungan</option>
                    <option value="fasilitas" {{ old('category', $customLayer->category) == 'fasilitas' ? 'selected' : '' }}>Fasilitas Umum</option>
                    <option value="demografi" {{ old('category', $customLayer->category) == 'demografi' ? 'selected' : '' }}>Demografi</option>
                    <option value="pompa_saluran" {{ old('category', $customLayer->category) == 'pompa_saluran' ? 'selected' : '' }}>Pompa & Saluran Air</option>
                  </select>
                </div>
                <div class="crud-form__group">
                  <label class="crud-form__label">Warna Layer <span class="required">*</span></label>
                  <div class="color-picker-wrap">
                    <input type="color" id="color-picker" value="{{ old('color', $customLayer->color) }}">
                    <input type="text" name="color" class="crud-form__input color-hex-input"
                           value="{{ old('color', $customLayer->color) }}" id="color-hex"
                           pattern="^#[0-9A-Fa-f]{6}$" required>
                  </div>
                </div>
              </div>
              <div class="crud-form__group" style="margin-top:12px">
                <label class="crud-form__label">Deskripsi (opsional)</label>
                <textarea name="description" class="crud-form__textarea"
                          placeholder="Deskripsi singkat tentang layer ini">{{ old('description', $customLayer->description) }}</textarea>
              </div>
              <div class="crud-form__group" style="margin-top:12px">
                <label class="crud-form__label" style="display:flex;align-items:center;gap:8px">
                  <input type="hidden" name="is_active" value="0">
                  <input type="checkbox" name="is_active" value="1" {{ old('is_active', $customLayer->is_active) ? 'checked' : '' }}
                         style="width:18px;height:18px;accent-color:#10b981">
                  Tampilkan layer di peta (aktif)
                </label>
              </div>
            </div>

            {{-- ACTIONS --}}
            <div class="crud-form__actions">
              <button type="submit" class="crud-btn crud-btn--success">
                <i class="bi bi-check-lg"></i> Simpan Perubahan
              </button>
              <a href="{{ route('custom-layers.index') }}" class="crud-btn crud-btn--outline">
                <i class="bi bi-x-lg"></i> Batal
              </a>
            </div>
          </form>

          {{-- SECTION: Preview --}}
          <div class="crud-form__section" style="margin-top: 20px; border-top: 1px solid #e2e8f0; padding-top: 20px">
            <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:10px">
              <h3 class="crud-form__section-title" style="margin:0">
                <i class="bi bi-map"></i> Preview di Peta
              </h3>
              <div style="display:flex; gap:8px">
                @if($customLayer->geometry_type === 'point' || $customLayer->geometry_type === 'mixed')
                  <button type="button" id="btn-toggle-add-point" class="crud-btn crud-btn--outline" style="font-size:12px; padding:6px 12px; display:flex; align-items:center; gap:6px; height:auto; border-radius:8px">
                    <i class="bi bi-plus-circle"></i> Tambah Titik Baru
                  </button>
                @endif
                @if($customLayer->geometry_type === 'polygon' || $customLayer->geometry_type === 'mixed')
                  <button type="button" id="btn-toggle-add-area" class="crud-btn crud-btn--outline" style="font-size:12px; padding:6px 12px; display:flex; align-items:center; gap:6px; height:auto; border-radius:8px">
                    <i class="bi bi-pentagon"></i> Tambah Area Baru
                  </button>
                  <button type="button" id="btn-finish-area" class="crud-btn crud-btn--success" style="display:none; font-size:12px; padding:6px 12px; align-items:center; gap:6px; height:auto; border-radius:8px">
                    <i class="bi bi-check-circle"></i> Selesai Menggambar (0)
                  </button>
                @endif
              </div>
            </div>
            <p style="font-size: 11px; color: #64748b; margin-top: 4px; display: none" id="add-point-instructions">
              <i class="bi bi-info-circle"></i> Mode tambah titik aktif. Klik lokasi mana saja pada peta untuk menggambar/menambahkan titik baru.
            </p>
            <p style="font-size: 11px; color: #64748b; margin-top: 4px; display: none" id="add-area-instructions">
              <i class="bi bi-info-circle"></i> Mode tambah area aktif. Klik di peta untuk membuat titik-titik sudut area. Klik kembali titik pertama (vertex pertama) atau klik tombol <button type="button" id="btn-finish-area-inline" style="background:#10b981; color:#fff; border:none; padding:2px 6px; border-radius:4px; font-size:10px; font-weight:600; cursor:pointer">Selesai</button> untuk menutup area.
            </p>
            <div id="preview-map"></div>
          </div>
        </div>

      </div>
    </section>
  </div>

  {{-- MODAL DIALOG UNTUK TAMBAH & EDIT FITUR SPASIAL --}}
  <div id="feature-modal" class="feature-modal-overlay">
    <div class="feature-modal-container">
      <div class="feature-modal-header">
        <h3 class="feature-modal-title" id="modal-title">
          <i class="bi bi-geo-alt"></i> Tambah Fitur Baru
        </h3>
        <button type="button" class="feature-modal-close-btn" id="btn-close-modal-x">
          <i class="bi bi-x-lg"></i>
        </button>
      </div>
      <div class="feature-modal-body">
        <div id="modal-geom-badge" class="modal-geom-badge">
          <!-- Dinamis: Titik / Area -->
        </div>
        
        <form id="modal-feature-form" onsubmit="return false;">
          <!-- Field Koordinat (hanya untuk Point) -->
          <div id="modal-coords-section" class="modal-coords-container" style="display: none;">
            <div class="modal-coord-row">
              <div>
                <label class="modal-label">Latitude</label>
                <input type="number" step="any" id="modal-input-lat" class="modal-input">
              </div>
              <div>
                <label class="modal-label">Longitude</label>
                <input type="number" step="any" id="modal-input-lng" class="modal-input">
              </div>
            </div>
            <p style="font-size: 10px; color: #64748b; margin: 6px 0 0 0;">
              <i class="bi bi-info-circle"></i> Koordinat posisi titik pada peta.
            </p>
          </div>

          <!-- Field Nama Fitur (Wajib) -->
          <div class="modal-field-group">
            <label class="modal-label">Nama Fitur / Lokasi <span style="color:#ef4444">*</span></label>
            <input type="text" id="modal-feature-name" class="modal-input" placeholder="Masukkan nama..." required>
          </div>

          <!-- Field Properties Dinamis -->
          <div id="modal-dynamic-fields">
            <!-- Diisi lewat JS berdasarkan existingPropertyKeys -->
          </div>
        </form>
      </div>
      <div class="feature-modal-footer">
        <button type="button" class="crud-btn crud-btn--outline crud-btn--sm" id="btn-cancel-modal">
          Batal
        </button>
        <button type="button" class="crud-btn crud-btn--success crud-btn--sm" id="btn-save-modal">
          <i class="bi bi-save"></i> Simpan
        </button>
      </div>
    </div>
  </div>

  @include('partials.footer')

  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <script>
    // Init preview map
    const map = L.map('preview-map').setView([-7.2575, 112.74], 12);
    L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
      attribution: '&copy; CARTO', maxZoom: 19
    }).addTo(map);

    let previewLayer = null;
    let existingPropertyKeys = [];

    // Fetch GeoJSON data for this layer with cache-buster
    fetch('/api/geo-layer/{{ $customLayer->layer_key }}?t=' + Date.now())
      .then(r => r.json())
      .then(data => {
        // Ekstrak properti yang ada, abaikan system keys
        if (data && data.features && data.features.length > 0) {
          const keys = new Set();
          const exclude = ['id', 'layer_key', 'feature_id', 'FID', 'fid'];
          data.features.forEach(f => {
            if (f.properties) {
              Object.keys(f.properties).forEach(k => {
                if (!exclude.includes(k)) keys.add(k);
              });
            }
          });
          existingPropertyKeys = Array.from(keys);
        }
        
        // Fallback jika layer masih kosong sama sekali
        if (existingPropertyKeys.length === 0) {
          existingPropertyKeys = ['nama'];
        }

        const color = document.getElementById('color-hex').value || '{{ $customLayer->color }}';
        previewLayer = L.geoJSON(data, {
          pointToLayer: (f, ll) => L.circleMarker(ll, {
            radius: 6, fillColor: color, fillOpacity: 0.8, color: '#fff', weight: 1.5
          }),
          style: (f) => {
            const t = f.geometry?.type || '';
            if (t.includes('Line')) return { color: color, weight: 2.5, opacity: 0.85 };
            return { color: color, weight: 1.5, fillColor: color, fillOpacity: 0.3 };
          },
          onEachFeature: (f, layer) => {
            const featureId = f.id || f.properties?.feature_id || f.properties?.id;
            const html = buildFeaturePopupHtml(featureId, f);
            layer.bindPopup(html);
          }
        }).addTo(map);

        const bounds = previewLayer.getBounds();
        if (bounds.isValid()) map.fitBounds(bounds, { padding: [30, 30] });
      })
      .catch(err => console.warn('Failed to load preview:', err));

    // Color picker sync
    const colorPicker = document.getElementById('color-picker');
    const colorHex    = document.getElementById('color-hex');

    colorPicker.addEventListener('input', function() {
      colorHex.value = this.value;
      updateColor();
    });
    colorHex.addEventListener('input', function() {
      if (/^#[0-9A-Fa-f]{6}$/.test(this.value)) {
        colorPicker.value = this.value;
        updateColor();
      }
    });

    function updateColor() {
      if (previewLayer) {
        const color = colorHex.value;
        previewLayer.eachLayer(layer => {
          if (layer.setStyle) layer.setStyle({ color: color, fillColor: color });
        });
      }
    }

    // --- FORM FIELD GENERATORS & POPUP HELPERS ---



    function buildFeaturePopupHtml(featureId, feature) {
      const props = feature.properties || {};
      const geomType = feature.geometry?.type || '';
      const geomLabel = geomType === 'Point' ? 'Titik' : (geomType === 'Polygon' ? 'Area' : 'Fitur');
      
      let html = '<div style="font:12px/1.4 system-ui; min-width:180px; max-width:240px; padding:4px">';
      html += `<strong style="display:block; margin-bottom:6px; font-size:12px; color:#1e293b"><i class="bi bi-info-circle"></i> Info Detail (${geomLabel})</strong>`;
      html += '<div style="max-height:120px; overflow-y:auto; margin-bottom:8px">';
      Object.keys(props).slice(0, 10).forEach(k => { 
        html += `<div style="margin-bottom:2px"><strong>${k}:</strong> ${props[k]}</div>`; 
      });
      html += '</div>';
      
      if (featureId) {
        html += `
          <div style="display:flex; justify-content:space-between; border-top:1px solid #f1f5f9; padding-top:6px; gap:6px">
            <button type="button" class="btn-edit-feature" data-id="${featureId}"
                    style="background:#3b82f6; color:#fff; border:none; padding:4px 8px; border-radius:6px; font-size:11px; cursor:pointer; font-weight:600; display:flex; align-items:center; gap:4px">
              <i class="bi bi-pencil"></i> Edit
            </button>
            <button type="button" class="btn-delete-feature" data-id="${featureId}"
                    style="background:#ef4444; color:#fff; border:none; padding:4px 8px; border-radius:6px; font-size:11px; cursor:pointer; font-weight:600; display:flex; align-items:center; gap:4px">
              <i class="bi bi-trash"></i> Hapus
            </button>
          </div>
        `;
      }
      html += '</div>';
      return html;
    }

    // --- TRACKING STATUS MODAL & FITUR ---
    let currentModalMode = null; // 'add_point', 'add_area', 'edit'
    let currentEditFeatureId = null;
    let currentEditLayer = null;
    let currentEditFeature = null;
    let activePointLatLng = null;

    // --- POPULATE MODAL DYNAMIC FIELDS ---
    function populateModalFields(existingValues = {}) {
      const container = document.getElementById('modal-dynamic-fields');
      container.innerHTML = '';
      
      // Tentukan key untuk field "Nama" utama
      const nameKeys = ['Name', 'name', 'NAMA', 'Nama', 'nama', 'label', 'title'];
      let nameKey = existingPropertyKeys.find(k => nameKeys.includes(k)) || 'nama';
      
      // Isi input Nama utama
      const nameInput = document.getElementById('modal-feature-name');
      nameInput.value = existingValues[nameKey] !== undefined ? existingValues[nameKey] : '';
      
      // Render field properti lainnya
      existingPropertyKeys.forEach(key => {
        // Lewati nameKey karena sudah dijadikan input utama di atas
        if (key === nameKey) return;
        
        const val = existingValues[key] !== undefined ? existingValues[key] : '';
        const group = document.createElement('div');
        group.className = 'modal-field-group';
        
        group.innerHTML = `
          <label class="modal-label">${key}</label>
          <input type="text" data-key="${key}" class="modal-input modal-prop-input" value="${val}" placeholder="Masukkan ${key}...">
        `;
        container.appendChild(group);
      });
    }

    // --- OPEN MODAL FORM ---
    function openFeatureModal(mode, options = {}) {
      currentModalMode = mode;
      const modal = document.getElementById('feature-modal');
      const titleEl = document.getElementById('modal-title');
      const badgeEl = document.getElementById('modal-geom-badge');
      const coordsSection = document.getElementById('modal-coords-section');
      
      // Reset inputs & values
      document.getElementById('modal-input-lat').value = '';
      document.getElementById('modal-input-lng').value = '';
      
      if (mode === 'add_point') {
        titleEl.innerHTML = '<i class="bi bi-geo-alt"></i> Tambah Titik Baru';
        badgeEl.className = 'modal-geom-badge badge-point';
        badgeEl.innerHTML = '<i class="bi bi-dot"></i> Geometri: Titik';
        coordsSection.style.display = 'block';
        
        activePointLatLng = options.latlng;
        document.getElementById('modal-input-lat').value = activePointLatLng.lat.toFixed(6);
        document.getElementById('modal-input-lng').value = activePointLatLng.lng.toFixed(6);
        
        populateModalFields();
        currentEditFeatureId = null;
        currentEditLayer = null;
        currentEditFeature = null;
        
      } else if (mode === 'add_area') {
        titleEl.innerHTML = '<i class="bi bi-pentagon"></i> Tambah Area Baru';
        badgeEl.className = 'modal-geom-badge badge-polygon';
        badgeEl.innerHTML = '<i class="bi bi-pentagon"></i> Geometri: Area';
        coordsSection.style.display = 'none';
        
        populateModalFields();
        currentEditFeatureId = null;
        currentEditLayer = null;
        currentEditFeature = null;
        
      } else if (mode === 'edit') {
        const feature = options.feature;
        const geomType = feature.geometry?.type || 'Point';
        currentEditFeatureId = options.featureId;
        currentEditLayer = options.layer;
        currentEditFeature = feature;
        
        titleEl.innerHTML = '<i class="bi bi-pencil-square"></i> Edit Detail Fitur';
        
        if (geomType === 'Point') {
          badgeEl.className = 'modal-geom-badge badge-point';
          badgeEl.innerHTML = '<i class="bi bi-dot"></i> Geometri: Titik';
          coordsSection.style.display = 'block';
          
          const latlng = options.layer.getLatLng ? options.layer.getLatLng() : { lat: feature.geometry.coordinates[1], lng: feature.geometry.coordinates[0] };
          document.getElementById('modal-input-lat').value = latlng.lat.toFixed(6);
          document.getElementById('modal-input-lng').value = latlng.lng.toFixed(6);
        } else {
          badgeEl.className = 'modal-geom-badge badge-polygon';
          badgeEl.innerHTML = '<i class="bi bi-pentagon"></i> Geometri: Area';
          coordsSection.style.display = 'none';
        }
        
        populateModalFields(feature.properties || {});
      }
      
      // Show modal
      modal.classList.add('active');
      
      // Auto-focus first input
      setTimeout(() => {
        const firstInput = modal.querySelector('.modal-prop-input');
        if (firstInput) firstInput.focus();
      }, 100);
    }

    // --- CLOSE MODAL FORM ---
    function closeFeatureModal(isSaved = false) {
      const modal = document.getElementById('feature-modal');
      modal.classList.remove('active');
      
      if (!isSaved) {
        // If cancelled, remove temporary drawn graphics
        if (currentModalMode === 'add_point') {
          if (tempMarker) {
            map.removeLayer(tempMarker);
            tempMarker = null;
          }
          resetAddMode();
        } else if (currentModalMode === 'add_area') {
          if (tempAreaPolygon) {
            map.removeLayer(tempAreaPolygon);
            tempAreaPolygon = null;
          }
          resetAddAreaMode();
        }
      }
      
      currentModalMode = null;
      currentEditFeatureId = null;
      currentEditLayer = null;
      currentEditFeature = null;
      activePointLatLng = null;
    }

    // --- BTN ACTIONS FOR MODAL ---
    document.getElementById('btn-close-modal-x').addEventListener('click', () => closeFeatureModal(false));
    document.getElementById('btn-cancel-modal').addEventListener('click', () => closeFeatureModal(false));
    
    // Close modal on ESC
    window.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        const modal = document.getElementById('feature-modal');
        if (modal.classList.contains('active')) {
          closeFeatureModal(false);
        }
      }
    });

    document.getElementById('btn-save-modal').addEventListener('click', function() {
      const properties = {};
      
      // Dapatkan key untuk field "Nama" utama
      const nameKeys = ['Name', 'name', 'NAMA', 'Nama', 'nama', 'label', 'title'];
      let nameKey = existingPropertyKeys.find(k => nameKeys.includes(k)) || 'nama';
      
      // Dapatkan nilai nama
      const nameVal = document.getElementById('modal-feature-name').value.trim();
      if (!nameVal) {
        alert('Nama Fitur wajib diisi!');
        document.getElementById('modal-feature-name').focus();
        return;
      }
      properties[nameKey] = nameVal;
      
      // Ambil nilai properti dinamis lainnya
      const propInputs = document.querySelectorAll('.modal-prop-input');
      propInputs.forEach(input => {
        const key = input.getAttribute('data-key');
        const value = input.value.trim();
        properties[key] = value;
      });
      
      const saveBtn = document.getElementById('btn-save-modal');
      saveBtn.disabled = true;
      const originalHtml = saveBtn.innerHTML;
      saveBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Menyimpan...';
      
      const onFinish = () => {
        saveBtn.disabled = false;
        saveBtn.innerHTML = originalHtml;
      };

      if (currentModalMode === 'add_point') {
        const latInput = parseFloat(document.getElementById('modal-input-lat').value);
        const lngInput = parseFloat(document.getElementById('modal-input-lng').value);
        const lat = !isNaN(latInput) ? latInput : activePointLatLng.lat;
        const lng = !isNaN(lngInput) ? lngInput : activePointLatLng.lng;
        
        savePointToDb(lat, lng, properties, onFinish);
        
      } else if (currentModalMode === 'add_area') {
        saveAreaToDb(properties, onFinish);
        
      } else if (currentModalMode === 'edit') {
        let payload = { properties };
        const geomType = currentEditFeature.geometry?.type || 'Point';
        
        if (geomType === 'Point') {
          const latInput = parseFloat(document.getElementById('modal-input-lat').value);
          const lngInput = parseFloat(document.getElementById('modal-input-lng').value);
          if (!isNaN(latInput) && !isNaN(lngInput)) {
            payload.lat = latInput;
            payload.lng = lngInput;
          }
        }
        
        updateFeatureInDb(currentEditFeatureId, payload, currentEditLayer, currentEditFeature, onFinish);
      }
    });

    // --- INTERAKSI TAMBAH TITIK KUSTOM ---
    let isAddMode = false;
    let tempMarker = null;
    const btnToggleAdd = document.getElementById('btn-toggle-add-point');
    const instructions = document.getElementById('add-point-instructions');

    if (btnToggleAdd) {
      btnToggleAdd.addEventListener('click', () => {
        isAddMode = !isAddMode;
        if (isAddMode) {
          if (isAddAreaMode) resetAddAreaMode();
          btnToggleAdd.innerHTML = '<i class="bi bi-x-circle"></i> Batal';
          btnToggleAdd.style.backgroundColor = '#dc2626';
          btnToggleAdd.style.color = '#fff';
          btnToggleAdd.style.borderColor = '#dc2626';
          instructions.style.display = 'block';
          map.getContainer().style.cursor = 'crosshair';
        } else {
          resetAddMode();
        }
      });
    }

    function resetAddMode() {
      isAddMode = false;
      if (btnToggleAdd) {
        btnToggleAdd.innerHTML = '<i class="bi bi-plus-circle"></i> Tambah Titik Baru';
        btnToggleAdd.style.backgroundColor = '';
        btnToggleAdd.style.color = '';
        btnToggleAdd.style.borderColor = '';
      }
      if (instructions) {
        instructions.style.display = 'none';
      }
      map.getContainer().style.cursor = '';
      if (tempMarker) {
        map.removeLayer(tempMarker);
        tempMarker = null;
      }
    }

    function savePointToDb(lat, lng, properties, onFinish) {
      fetch('{{ route("custom-layers.add-point", $customLayer->id) }}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          'Accept': 'application/json'
        },
        body: JSON.stringify({ lat, lng, properties })
      })
      .then(response => response.json().then(data => ({ status: response.status, body: data })))
      .then(({ status, body }) => {
        if (status === 200 && body.success) {
          if (previewLayer) {
            previewLayer.addData(body.feature);
          } else {
            const color = document.getElementById('color-hex').value || '{{ $customLayer->color }}';
            L.circleMarker([lat, lng], {
              radius: 6,
              fillColor: color,
              fillOpacity: 0.8,
              color: '#fff',
              weight: 1.5
            }).bindPopup(`<strong>Point:</strong> New`).addTo(map);
          }

          const featureCountEl = document.getElementById('meta-feature-count');
          const geometryTypeEl = document.getElementById('meta-geometry-type');
          if (featureCountEl) {
            featureCountEl.innerText = Number(body.new_count).toLocaleString('id-ID');
          }
          if (geometryTypeEl) {
            const tl = {'point':'Titik','line':'Garis','polygon':'Area','mixed':'Campuran'};
            geometryTypeEl.innerText = tl[body.geometry_type] || body.geometry_type;
          }

          showToast('success', body.message);
          closeFeatureModal(true);
          resetAddMode();
        } else {
          showToast('error', body.message || 'Gagal menyimpan titik.');
        }
        if (typeof onFinish === 'function') onFinish();
      })
      .catch(err => {
        console.error('Error saving point:', err);
        showToast('error', 'Terjadi kesalahan sistem.');
        if (typeof onFinish === 'function') onFinish();
      });
    }

    // --- INTERAKSI TAMBAH AREA (POLYGON DRAWING) ---
    let isAddAreaMode = false;
    let activeAreaCoords = [];
    let tempAreaMarkers = [];
    let tempAreaPolygon = null;
    const btnToggleAddArea = document.getElementById('btn-toggle-add-area');
    const btnFinishArea = document.getElementById('btn-finish-area');
    const areaInstructions = document.getElementById('add-area-instructions');

    if (btnToggleAddArea) {
      btnToggleAddArea.addEventListener('click', () => {
        isAddAreaMode = !isAddAreaMode;
        if (isAddAreaMode) {
          if (isAddMode) resetAddMode();
          btnToggleAddArea.innerHTML = '<i class="bi bi-x-circle"></i> Batal';
          btnToggleAddArea.style.backgroundColor = '#dc2626';
          btnToggleAddArea.style.color = '#fff';
          btnToggleAddArea.style.borderColor = '#dc2626';
          
          if (btnFinishArea) {
            btnFinishArea.style.display = 'flex';
            btnFinishArea.disabled = true;
            btnFinishArea.style.opacity = '0.5';
            btnFinishArea.style.cursor = 'not-allowed';
            btnFinishArea.innerHTML = '<i class="bi bi-check-circle"></i> Selesai Menggambar (0)';
          }
          
          areaInstructions.style.display = 'block';
          map.getContainer().style.cursor = 'crosshair';
          
          // Disable double click zoom while drawing
          map.doubleClickZoom.disable();
        } else {
          resetAddAreaMode();
        }
      });
    }

    if (btnFinishArea) {
      btnFinishArea.addEventListener('click', function() {
        if (activeAreaCoords.length >= 3) {
          finishAreaDrawing();
        }
      });
    }

    function resetAddAreaMode() {
      isAddAreaMode = false;
      if (btnToggleAddArea) {
        btnToggleAddArea.innerHTML = '<i class="bi bi-pentagon"></i> Tambah Area Baru';
        btnToggleAddArea.style.backgroundColor = '';
        btnToggleAddArea.style.color = '';
        btnToggleAddArea.style.borderColor = '';
      }
      if (btnFinishArea) {
        btnFinishArea.style.display = 'none';
      }
      if (areaInstructions) {
        areaInstructions.style.display = 'none';
      }
      map.getContainer().style.cursor = '';
      
      // Restore double click zoom
      map.doubleClickZoom.enable();
      
      if (tempAreaPolygon) {
        map.removeLayer(tempAreaPolygon);
        tempAreaPolygon = null;
      }
      tempAreaMarkers.forEach(m => map.removeLayer(m));
      tempAreaMarkers = [];
      activeAreaCoords = [];
    }

    function addVertexToArea(latlng) {
      activeAreaCoords.push(latlng);
      const color = document.getElementById('color-hex').value || '{{ $customLayer->color }}';
      
      if (activeAreaCoords.length === 1) {
        // First point
      } else if (activeAreaCoords.length === 2) {
        if (tempAreaPolygon) map.removeLayer(tempAreaPolygon);
        tempAreaPolygon = L.polyline(activeAreaCoords, { color: color, weight: 2.5 }).addTo(map);
      } else {
        if (tempAreaPolygon) map.removeLayer(tempAreaPolygon);
        tempAreaPolygon = L.polygon(activeAreaCoords, {
          color: color,
          fillColor: color,
          fillOpacity: 0.3,
          weight: 2.5
        }).addTo(map);
      }

      // Update finish area button
      if (btnFinishArea) {
        btnFinishArea.innerHTML = `<i class="bi bi-check-circle"></i> Selesai Menggambar (${activeAreaCoords.length})`;
        if (activeAreaCoords.length >= 3) {
          btnFinishArea.disabled = false;
          btnFinishArea.style.opacity = '1';
          btnFinishArea.style.cursor = 'pointer';
        } else {
          btnFinishArea.disabled = true;
          btnFinishArea.style.opacity = '0.5';
          btnFinishArea.style.cursor = 'not-allowed';
        }
      }

      const isFirst = activeAreaCoords.length === 1;
      const markerColor = isFirst ? '#10b981' : '#3b82f6';
      
      const vertex = L.circleMarker(latlng, {
        radius: 5,
        fillColor: markerColor,
        fillOpacity: 0.9,
        color: '#ffffff',
        weight: 1.5
      }).addTo(map);
      
      if (isFirst) {
        vertex.bindTooltip("Klik disini untuk menutup area", { permanent: false, direction: 'top' });
        vertex.on('click', function(evt) {
          L.DomEvent.stopPropagation(evt);
          if (activeAreaCoords.length >= 3) {
            finishAreaDrawing();
          } else {
            alert('Harap buat setidaknya 3 titik untuk membuat area!');
          }
        });
      }
      
      tempAreaMarkers.push(vertex);
    }

    // Centroid helper
    function getAreaCentroid(latlngs) {
      let lat = 0;
      let lng = 0;
      latlngs.forEach(ll => {
        lat += ll.lat;
        lng += ll.lng;
      });
      return [lat / latlngs.length, lng / latlngs.length];
    }

    // Inline finish button handler
    setTimeout(() => {
      const finishInlineBtn = document.getElementById('btn-finish-area-inline');
      if (finishInlineBtn) {
        finishInlineBtn.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();
          if (activeAreaCoords.length >= 3) {
            finishAreaDrawing();
          } else {
            alert('Harap buat setidaknya 3 titik untuk membuat area!');
          }
        });
      }
    }, 500);

    function finishAreaDrawing() {
      if (activeAreaCoords.length < 3) {
        alert('Harap buat setidaknya 3 titik untuk membuat area!');
        return;
      }
      
      const color = document.getElementById('color-hex').value || '{{ $customLayer->color }}';
      
      if (tempAreaPolygon) map.removeLayer(tempAreaPolygon);
      tempAreaPolygon = L.polygon(activeAreaCoords, {
        color: color,
        fillColor: color,
        fillOpacity: 0.3,
        weight: 2.5
      }).addTo(map);

      tempAreaMarkers.forEach(m => map.removeLayer(m));
      tempAreaMarkers = [];

      // Open input properties Modal immediately
      openFeatureModal('add_area');
    }

    function saveAreaToDb(properties, onFinish) {
      const geoJsonCoords = activeAreaCoords.map(c => [c.lng, c.lat]);
      if (geoJsonCoords.length > 0) {
        geoJsonCoords.push([geoJsonCoords[0][0], geoJsonCoords[0][1]]);
      }
      
      const geometry = {
        type: 'Polygon',
        coordinates: [geoJsonCoords]
      };

      fetch('{{ route("custom-layers.add-point", $customLayer->id) }}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          'Accept': 'application/json'
        },
        body: JSON.stringify({ geometry, properties })
      })
      .then(response => response.json().then(data => ({ status: response.status, body: data })))
      .then(({ status, body }) => {
        if (status === 200 && body.success) {
          if (previewLayer) {
            previewLayer.addData(body.feature);
          } else {
            const color = document.getElementById('color-hex').value || '{{ $customLayer->color }}';
            L.polygon(activeAreaCoords, {
              color: color,
              fillColor: color,
              fillOpacity: 0.3,
              weight: 2.5
            }).addTo(map);
          }

          const featureCountEl = document.getElementById('meta-feature-count');
          const geometryTypeEl = document.getElementById('meta-geometry-type');
          if (featureCountEl) {
            featureCountEl.innerText = Number(body.new_count).toLocaleString('id-ID');
          }
          if (geometryTypeEl) {
            const tl = {'point':'Titik','line':'Garis','polygon':'Area','mixed':'Campuran'};
            geometryTypeEl.innerText = tl[body.geometry_type] || body.geometry_type;
          }

          showToast('success', body.message);
          
          if (tempAreaPolygon) {
            map.removeLayer(tempAreaPolygon);
            tempAreaPolygon = null;
          }
          closeFeatureModal(true);
          resetAddAreaMode();
        } else {
          showToast('error', body.message || 'Gagal menyimpan area.');
        }
        if (typeof onFinish === 'function') onFinish();
      })
      .catch(err => {
        console.error('Error saving area:', err);
        showToast('error', 'Terjadi kesalahan sistem.');
        if (typeof onFinish === 'function') onFinish();
      });
    }

    // --- INTERAKSI MENGEDIT FITUR (MODAL & UPDATE) ---
    function updateFeatureInDb(featureId, payload, layer, feature, onFinish) {
      const url = `{{ route("custom-layers.update-feature", [$customLayer->id, ":feature_id"]) }}`.replace(':feature_id', featureId);

      fetch(url, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          'Accept': 'application/json'
        },
        body: JSON.stringify({
          _method: 'PUT',
          ...payload
        })
      })
      .then(response => response.json().then(data => ({ status: response.status, body: data })))
      .then(({ status, body }) => {
        if (status === 200 && body.success) {
          showToast('success', body.message);
          
          feature.properties = body.feature.properties;
          feature.geometry = body.feature.geometry;

          if (body.feature.geometry.type === 'Point') {
            const coords = body.feature.geometry.coordinates;
            if (layer.setLatLng) {
              layer.setLatLng([coords[1], coords[0]]);
            }
          } else {
            // If area/polygon, update the coordinates/style if modified
            if (layer.setLatLngs && body.feature.geometry.coordinates) {
              const coordinates = body.feature.geometry.coordinates[0];
              const leafletLatLngs = coordinates.map(c => [c[1], c[0]]);
              if (leafletLatLngs.length > 1 && 
                  leafletLatLngs[0][0] === leafletLatLngs[leafletLatLngs.length - 1][0] && 
                  leafletLatLngs[0][1] === leafletLatLngs[leafletLatLngs.length - 1][1]) {
                leafletLatLngs.pop();
              }
              layer.setLatLngs(leafletLatLngs);
            }
          }

          const updatedHtml = buildFeaturePopupHtml(featureId, feature);
          layer.bindPopup(updatedHtml);
          
          closeFeatureModal(true);
          
          setTimeout(() => {
            layer.openPopup();
          }, 300);
        } else {
          showToast('error', body.message || 'Gagal menyimpan perubahan.');
        }
        if (typeof onFinish === 'function') onFinish();
      })
      .catch(err => {
        console.error('Error updating feature:', err);
        showToast('error', 'Terjadi kesalahan sistem.');
        if (typeof onFinish === 'function') onFinish();
      });
    }

    map.on('click', function(e) {
      if (isAddMode) {
        if (tempMarker) {
          tempMarker.setLatLng(e.latlng);
        } else {
          tempMarker = L.marker(e.latlng).addTo(map);
        }
        openFeatureModal('add_point', { latlng: e.latlng });
      } else if (isAddAreaMode) {
        addVertexToArea(e.latlng);
      }
    });

    map.on('dblclick', function(e) {
      if (isAddAreaMode) {
        if (activeAreaCoords.length >= 3) {
          finishAreaDrawing();
        } else {
          alert('Harap buat setidaknya 3 titik untuk membuat area!');
        }
      }
    });

    const mainLayerForm = document.getElementById('main-layer-form');
    if (mainLayerForm) {
      mainLayerForm.addEventListener('submit', function(e) {
        if (isAddMode || isAddAreaMode) {
          e.preventDefault();
          alert('Anda sedang dalam mode menggambar/menambahkan fitur di peta. Harap simpan atau batalkan penggambaran fitur terlebih dahulu di panel peta sebelum menyimpan perubahan layer.');
        }
      });
    }

    // --- INTEGRASI HAPUS & EDIT FITUR SPASIAL ---
    map.on('popupopen', function(e) {
      const deleteBtn = document.querySelector('.btn-delete-feature');
      if (deleteBtn) {
        const featureId = deleteBtn.getAttribute('data-id');
        deleteBtn.onclick = function() {
          if (confirm('Apakah Anda yakin ingin menghapus fitur ini secara permanen dari database?')) {
            deleteFeatureFromDb(featureId, e.popup._source);
          }
        };
      }

      const editBtn = document.querySelector('.btn-edit-feature');
      if (editBtn) {
        const featureId = editBtn.getAttribute('data-id');
        editBtn.onclick = function() {
          const layer = e.popup._source;
          let feature = layer.feature;
          if (!feature) {
            feature = {
              type: 'Feature',
              id: featureId,
              properties: layer.feature ? layer.feature.properties : {},
              geometry: layer.toGeoJSON ? layer.toGeoJSON().geometry : null
            };
          }
          openFeatureModal('edit', { featureId, layer, feature });
          map.closePopup();
        };
      }
    });

    function deleteFeatureFromDb(featureId, layerSource) {
      const deleteBtn = document.querySelector('.btn-delete-feature');
      if (deleteBtn) {
        deleteBtn.disabled = true;
        deleteBtn.innerText = 'Menghapus...';
      }

      const url = `{{ route("custom-layers.delete-feature", [$customLayer->id, ":feature_id"]) }}`.replace(':feature_id', featureId);

      fetch(url, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          'Accept': 'application/json'
        },
        body: JSON.stringify({ _method: 'DELETE' })
      })
      .then(response => response.json().then(data => ({ status: response.status, body: data })))
      .then(({ status, body }) => {
        if (status === 200 && body.success) {
          showToast('success', body.message);
          map.closePopup();

          if (layerSource) {
            if (previewLayer) {
              previewLayer.removeLayer(layerSource);
            } else {
              map.removeLayer(layerSource);
            }
          }

          const featureCountEl = document.getElementById('meta-feature-count');
          if (featureCountEl) {
            featureCountEl.innerText = Number(body.new_count).toLocaleString('id-ID');
          }
        } else {
          showToast('error', body.message || 'Gagal menghapus fitur.');
          if (deleteBtn) {
            deleteBtn.disabled = false;
            deleteBtn.innerHTML = '<i class="bi bi-trash"></i> Hapus';
          }
        }
      })
      .catch(err => {
        console.error('Error deleting feature:', err);
        showToast('error', 'Terjadi kesalahan sistem.');
        if (deleteBtn) {
          deleteBtn.disabled = false;
          deleteBtn.innerHTML = '<i class="bi bi-trash"></i> Hapus';
        }
      });
    }

    // --- TOAST NOTIFICATION COMPONENT ---
    function showToast(type, message) {
      const toast = document.createElement('div');
      toast.style.position = 'fixed';
      toast.style.bottom = '24px';
      toast.style.right = '24px';
      toast.style.padding = '12px 20px';
      toast.style.borderRadius = '10px';
      toast.style.color = '#fff';
      toast.style.fontSize = '14px';
      toast.style.fontWeight = '600';
      toast.style.zIndex = '9999';
      toast.style.boxShadow = '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)';
      toast.style.display = 'flex';
      toast.style.alignItems = 'center';
      toast.style.gap = '10px';
      toast.style.transform = 'translateY(100px)';
      toast.style.opacity = '0';
      toast.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
      
      const icon = document.createElement('i');
      if (type === 'success') {
        toast.style.backgroundColor = '#10b981';
        icon.className = 'bi bi-check-circle-fill';
      } else {
        toast.style.backgroundColor = '#ef4444';
        icon.className = 'bi bi-exclamation-triangle-fill';
      }
      
      const text = document.createElement('span');
      text.innerText = message;
      
      toast.appendChild(icon);
      toast.appendChild(text);
      document.body.appendChild(toast);
      
      setTimeout(() => {
        toast.style.transform = 'translateY(0)';
        toast.style.opacity = '1';
      }, 10);
      
      setTimeout(() => {
        toast.style.transform = 'translateY(20px)';
        toast.style.opacity = '0';
        setTimeout(() => {
          toast.remove();
        }, 300);
      }, 3500);
    }

    // Fix map size
    setTimeout(() => map.invalidateSize(), 300);
  </script>
</body>
</html>
