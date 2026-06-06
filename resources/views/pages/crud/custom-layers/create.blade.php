<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Upload Layer GeoJSON - Bappeda Surabaya</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
  <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
  <link rel="stylesheet" href="{{ asset('css/crud.css') }}">
  <style>
    /* Preview Map */
    #preview-map {
      width: 100%;
      height: 350px;
      border-radius: 10px;
      border: 2px solid #e2e8f0;
      background: #f8fafc;
      margin-top: 8px;
    }
    #preview-map.has-data { border-color: #10b981; }

    /* Dropzone */
    .dropzone {
      border: 2px dashed #cbd5e1;
      border-radius: 12px;
      padding: 40px 20px;
      text-align: center;
      cursor: pointer;
      transition: all .25s ease;
      background: #fafbfc;
    }
    .dropzone:hover, .dropzone.dragover {
      border-color: #3b82f6;
      background: #eff6ff;
    }
    .dropzone.has-file {
      border-color: #10b981;
      background: #f0fdf4;
    }
    .dropzone__icon {
      font-size: 36px;
      color: #94a3b8;
      margin-bottom: 10px;
      transition: color .2s;
    }
    .dropzone.has-file .dropzone__icon { color: #10b981; }
    .dropzone__title {
      font-size: 14px;
      font-weight: 600;
      color: #334155;
      margin-bottom: 4px;
    }
    .dropzone__subtitle {
      font-size: 12px;
      color: #94a3b8;
    }
    .dropzone__file-info {
      display: none;
      margin-top: 12px;
      padding: 10px 16px;
      background: #fff;
      border-radius: 8px;
      border: 1px solid #e2e8f0;
      font-size: 12px;
      color: #334155;
    }
    .dropzone.has-file .dropzone__file-info { display: flex; align-items: center; gap: 10px; justify-content: center; }

    /* Color Picker */
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
    .color-hex-input {
      flex: 1;
    }

    /* Preview stats */
    .preview-stats {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 10px;
      margin-top: 12px;
    }
    .preview-stat {
      background: #f8fafc;
      border: 1px solid #e2e8f0;
      border-radius: 8px;
      padding: 10px 12px;
      text-align: center;
    }
    .preview-stat__value {
      font-size: 18px;
      font-weight: 700;
      color: #1e293b;
    }
    .preview-stat__label {
      font-size: 11px;
      color: #94a3b8;
      margin-top: 2px;
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
              <i class="bi bi-upload"></i>
            </div>
            <div>
              <h1 class="crud-header__title">Upload Layer GeoJSON</h1>
              <p class="crud-header__subtitle">Upload file GeoJSON/JSON untuk menambahkan layer baru ke peta</p>
            </div>
          </div>
        </div>

        {{-- VALIDATION ERRORS --}}
        @if($errors->any())
          <div class="crud-errors">
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
        <div class="crud-form-card">
          <form method="POST" action="{{ route('custom-layers.store') }}" enctype="multipart/form-data" id="upload-form">
            @csrf

            {{-- SECTION: File Upload --}}
            <div class="crud-form__section">
              <h3 class="crud-form__section-title">
                <i class="bi bi-file-earmark-code"></i> File GeoJSON
              </h3>

              <div class="dropzone" id="dropzone" onclick="document.getElementById('geojson_file').click()">
                <div class="dropzone__icon"><i class="bi bi-cloud-arrow-up-fill"></i></div>
                <div class="dropzone__title">Klik atau drag & drop file GeoJSON di sini</div>
                <div class="dropzone__subtitle">Format: .geojson, .json — Maksimal 10 MB, 5.000 fitur</div>
                <div class="dropzone__file-info" id="file-info">
                  <i class="bi bi-file-earmark-check" style="color:#10b981;font-size:16px"></i>
                  <span id="file-name">-</span>
                  <span id="file-size" style="color:#94a3b8">-</span>
                  <button type="button" onclick="event.stopPropagation(); clearFile()" style="border:none;background:#fee2e2;color:#dc2626;border-radius:50%;width:22px;height:22px;cursor:pointer;font-size:12px;display:flex;align-items:center;justify-content:center" title="Hapus file">
                    <i class="bi bi-x"></i>
                  </button>
                </div>
              </div>
              <input type="file" name="geojson_file" id="geojson_file" accept=".geojson,.json,.txt" style="display:none" required>
            </div>

            {{-- SECTION: Preview Peta --}}
            <div class="crud-form__section" id="preview-section" style="display:none">
              <h3 class="crud-form__section-title">
                <i class="bi bi-map"></i> Preview di Peta
              </h3>
              <div id="preview-map"></div>
              <div class="preview-stats" id="preview-stats">
                <div class="preview-stat">
                  <div class="preview-stat__value" id="stat-features">0</div>
                  <div class="preview-stat__label">Total Fitur</div>
                </div>
                <div class="preview-stat">
                  <div class="preview-stat__value" id="stat-type">-</div>
                  <div class="preview-stat__label">Tipe Geometri</div>
                </div>
                <div class="preview-stat">
                  <div class="preview-stat__value" id="stat-props">0</div>
                  <div class="preview-stat__label">Field Properti</div>
                </div>
              </div>
            </div>

            {{-- SECTION: Metadata --}}
            <div class="crud-form__section">
              <h3 class="crud-form__section-title">
                <i class="bi bi-tag"></i> Informasi Layer
              </h3>
              <div class="crud-form__grid crud-form__grid--3">
                <div class="crud-form__group">
                  <label class="crud-form__label">Nama Layer <span class="required">*</span></label>
                  <input type="text" name="name" class="crud-form__input"
                         value="{{ old('name') }}" placeholder="Contoh: Pos Pemadam Kebakaran" required id="input-name">
                </div>
                <div class="crud-form__group">
                  <label class="crud-form__label">Kategori Peta <span class="required">*</span></label>
                  <select name="category" class="crud-form__select" required>
                    <option value="infrastruktur" {{ old('category') == 'infrastruktur' ? 'selected' : '' }}>Infrastruktur</option>
                    <option value="pendidikan" {{ old('category') == 'pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                    <option value="persampahan" {{ old('category') == 'persampahan' ? 'selected' : '' }}>Persampahan & Lingkungan</option>
                    <option value="fasilitas" {{ old('category') == 'fasilitas' ? 'selected' : '' }}>Fasilitas Umum</option>
                    <option value="demografi" {{ old('category') == 'demografi' ? 'selected' : '' }}>Demografi</option>
                    <option value="pompa_saluran" {{ old('category') == 'pompa_saluran' ? 'selected' : '' }}>Pompa & Saluran Air</option>
                  </select>
                </div>
                <div class="crud-form__group">
                  <label class="crud-form__label">Warna Layer <span class="required">*</span></label>
                  <div class="color-picker-wrap">
                    <input type="color" id="color-picker" value="{{ old('color', '#3b82f6') }}">
                    <input type="text" name="color" class="crud-form__input color-hex-input"
                           value="{{ old('color', '#3b82f6') }}" id="color-hex" pattern="^#[0-9A-Fa-f]{6}$"
                           placeholder="#3b82f6" required>
                  </div>
                </div>
              </div>
              <div class="crud-form__group" style="margin-top:12px">
                <label class="crud-form__label">Deskripsi (opsional)</label>
                <textarea name="description" class="crud-form__textarea"
                          placeholder="Deskripsi singkat tentang layer ini" id="input-description">{{ old('description') }}</textarea>
              </div>
            </div>

            {{-- ACTIONS --}}
            <div class="crud-form__actions">
              <button type="submit" class="crud-btn crud-btn--success" id="btn-upload" disabled>
                <i class="bi bi-upload"></i> Upload & Simpan Layer
              </button>
              <a href="{{ route('custom-layers.index') }}" class="crud-btn crud-btn--outline">
                <i class="bi bi-x-lg"></i> Batal
              </a>
            </div>
          </form>
        </div>

      </div>
    </section>
  </div>

  @include('partials.footer')

  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/proj4js/2.9.0/proj4.js"></script>
  <script>
    // ─── Preview Map ──────────────────────────────────────────
    let previewMap = null;
    let previewLayer = null;

    function initPreviewMap() {
      if (previewMap) return;
      previewMap = L.map('preview-map').setView([-7.2575, 112.74], 12);
      L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; CARTO', maxZoom: 19
      }).addTo(previewMap);
    }

    function showPreview(geojsonData) {
      const section = document.getElementById('preview-section');
      section.style.display = 'block';
      initPreviewMap();

      // Remove old layer
      if (previewLayer) { previewMap.removeLayer(previewLayer); }

      const color = document.getElementById('color-hex').value || '#3b82f6';

      previewLayer = L.geoJSON(geojsonData, {
        pointToLayer: (f, ll) => L.circleMarker(ll, {
          radius: 6, fillColor: color, fillOpacity: 0.8,
          color: '#fff', weight: 1.5
        }),
        style: (f) => {
          const t = f.geometry?.type || '';
          if (t.includes('Line')) return { color: color, weight: 2.5, opacity: 0.85 };
          return { color: color, weight: 1.5, fillColor: color, fillOpacity: 0.3 };
        },
        onEachFeature: (f, layer) => {
          const props = f.properties || {};
          let html = '<div style="font:12px/1.4 system-ui;max-width:220px">';
          const keys = Object.keys(props).slice(0, 8);
          keys.forEach(k => { html += `<div><strong>${k}:</strong> ${props[k]}</div>`; });
          if (!keys.length) html += '<em style="color:#94a3b8">Tanpa properti</em>';
          html += '</div>';
          layer.bindPopup(html);
        }
      }).addTo(previewMap);

      // Fit bounds
      try {
        const bounds = previewLayer.getBounds();
        if (bounds.isValid()) previewMap.fitBounds(bounds, { padding: [30, 30] });
      } catch(e) {}

      // Fix map size setelah container muncul
      setTimeout(() => previewMap.invalidateSize(), 200);

      // Stats
      const features = geojsonData.features || [];
      document.getElementById('stat-features').textContent = features.length;

      // Detect type
      const types = new Set();
      features.forEach(f => {
        const t = f.geometry?.type || '';
        if (t.includes('Point')) types.add('Titik');
        else if (t.includes('Line')) types.add('Garis');
        else if (t.includes('Polygon')) types.add('Area');
      });
      document.getElementById('stat-type').textContent = [...types].join(', ') || '-';

      // Props count
      const allProps = new Set();
      features.slice(0, 50).forEach(f => {
        Object.keys(f.properties || {}).forEach(k => allProps.add(k));
      });
      document.getElementById('stat-props').textContent = allProps.size;
    }

    // ─── File Upload / Drag & Drop ──────────────────────────────
    const dropzone     = document.getElementById('dropzone');
    const fileInput    = document.getElementById('geojson_file');
    const btnUpload    = document.getElementById('btn-upload');

    // Drag events
    ['dragenter', 'dragover'].forEach(evt => {
      dropzone.addEventListener(evt, e => { e.preventDefault(); dropzone.classList.add('dragover'); });
    });
    ['dragleave', 'drop'].forEach(evt => {
      dropzone.addEventListener(evt, e => { e.preventDefault(); dropzone.classList.remove('dragover'); });
    });
    dropzone.addEventListener('drop', e => {
      const files = e.dataTransfer.files;
      if (files.length) { fileInput.files = files; handleFileSelect(files[0]); }
    });

    fileInput.addEventListener('change', function() {
      if (this.files.length) handleFileSelect(this.files[0]);
    });

    function handleFileSelect(file) {
      // Validate extension
      const ext = file.name.split('.').pop().toLowerCase();
      if (!['geojson', 'json', 'txt'].includes(ext)) {
        alert('Format file tidak didukung. Gunakan .geojson atau .json');
        clearFile();
        return;
      }

      // Validate size
      if (file.size > 10 * 1024 * 1024) {
        alert('File terlalu besar. Maksimal 10 MB.');
        clearFile();
        return;
      }

      // Show file info
      document.getElementById('file-name').textContent = file.name;
      document.getElementById('file-size').textContent = formatFileSize(file.size);
      dropzone.classList.add('has-file');

      // Auto-fill name if empty
      const nameInput = document.getElementById('input-name');
      if (!nameInput.value) {
        nameInput.value = file.name.replace(/\.(geojson|json|txt)$/i, '').replace(/[_-]/g, ' ');
      }

      // Parse and preview
      const reader = new FileReader();
      reader.onload = function(e) {
        try {
          const data = JSON.parse(e.target.result);
          let normalized = normalizeGeoJSON(data);
          
          if (normalized.features.length === 0) {
            alert('Tidak ditemukan fitur GeoJSON yang valid.');
            clearFile();
            return;
          }
          if (normalized.features.length > 5000) {
            alert('File memiliki ' + normalized.features.length + ' fitur. Maksimal 5.000.');
            clearFile();
            return;
          }

          // Auto-convert UTM (Easting/Northing) to WGS84 (Lat/Lng)
          normalized = convertToWgs84(normalized);

          showPreview(normalized);

          // Simpan data GeoJSON yang sudah dinormalisasi dan dikonversi ke form submission
          // Buat file baru dari objek JSON yang sudah diperbaiki
          const blob = new Blob([JSON.stringify(normalized)], { type: 'application/json' });
          const dt = new DataTransfer();
          dt.items.add(new File([blob], file.name, { type: 'application/json' }));
          fileInput.files = dt.files;

          btnUpload.disabled = false;
        } catch(err) {
          alert('File bukan JSON yang valid: ' + err.message);
          clearFile();
        }
      };
      reader.readAsText(file);
    }

    function normalizeGeoJSON(data) {
      if (data.type === 'FeatureCollection') return data;
      if (data.type === 'Feature') return { type: 'FeatureCollection', features: [data] };
      if (data.type === 'GeometryCollection') {
        return {
          type: 'FeatureCollection',
          features: (data.geometries || []).map((g, i) => ({
            type: 'Feature', geometry: g, properties: { id: i }
          }))
        };
      }
      if (data.coordinates) {
        return { type: 'FeatureCollection', features: [{ type: 'Feature', geometry: data, properties: {} }] };
      }
      return { type: 'FeatureCollection', features: [] };
    }

    // ─── UTM (EPSG:32649) to WGS84 (EPSG:4326) Auto-Converter ───
    proj4.defs("EPSG:32649","+proj=utm +zone=49 +south +datum=WGS84 +units=m +no_defs");
    
    function convertToWgs84(geojson) {
      if (!geojson || !geojson.features) return geojson;
      
      let needsConversion = false;
      // Cek cepat apakah perlu konversi (jika koordinat > 180 atau < -180)
      for (const f of geojson.features) {
        let firstCoord = getFirstCoord(f.geometry?.coordinates);
        if (firstCoord && (Math.abs(firstCoord[0]) > 180 || Math.abs(firstCoord[1]) > 90)) {
          needsConversion = true;
          break;
        }
      }

      if (!needsConversion) return geojson; // Sudah format WGS84 yang benar (Lat/Lng)

      console.log('Mengkonversi koordinat dari UTM ke WGS84...');
      
      const converted = JSON.parse(JSON.stringify(geojson)); // deep copy
      converted.features.forEach(f => {
        if (f.geometry && f.geometry.coordinates) {
          f.geometry.coordinates = transformCoords(f.geometry.coordinates);
        }
      });
      return converted;
    }

    function getFirstCoord(coords) {
      if (!Array.isArray(coords) || coords.length === 0) return null;
      if (typeof coords[0] === 'number') return coords;
      return getFirstCoord(coords[0]);
    }

    function transformCoords(coords) {
      if (!Array.isArray(coords)) return coords;
      if (coords.length >= 2 && typeof coords[0] === 'number') {
        // Hanya konversi jika memang di luar batas valid LatLng
        if (Math.abs(coords[0]) > 180 || Math.abs(coords[1]) > 90) {
           return proj4("EPSG:32649", "EPSG:4326", [coords[0], coords[1]]);
        }
        return coords;
      }
      return coords.map(c => transformCoords(c));
    }

    function clearFile() {
      fileInput.value = '';
      dropzone.classList.remove('has-file');
      btnUpload.disabled = true;
      document.getElementById('preview-section').style.display = 'none';
      if (previewLayer && previewMap) { previewMap.removeLayer(previewLayer); previewLayer = null; }
    }

    function formatFileSize(bytes) {
      if (bytes < 1024) return bytes + ' B';
      if (bytes < 1048576) return (bytes / 1024).toFixed(1) + ' KB';
      return (bytes / 1048576).toFixed(1) + ' MB';
    }

    // ─── Color picker sync ─────────────────────────────────────
    const colorPicker = document.getElementById('color-picker');
    const colorHex    = document.getElementById('color-hex');

    colorPicker.addEventListener('input', function() {
      colorHex.value = this.value;
      updatePreviewColor();
    });
    colorHex.addEventListener('input', function() {
      if (/^#[0-9A-Fa-f]{6}$/.test(this.value)) {
        colorPicker.value = this.value;
        updatePreviewColor();
      }
    });

    function updatePreviewColor() {
      if (previewLayer && previewMap) {
        const color = colorHex.value;
        previewLayer.eachLayer(layer => {
          if (layer.setStyle) {
            layer.setStyle({ color: color, fillColor: color });
          }
        });
      }
    }
  </script>
</body>
</html>
