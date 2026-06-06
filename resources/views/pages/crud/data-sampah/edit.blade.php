<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Edit Data Sampah - Bappeda Surabaya</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
  <link rel="stylesheet" href="{{ asset('css/crud.css') }}">
</head>

<body class="app-shell">
  @include('partials.header')

  <div class="app-shell__content">
    <section class="crud-page">
      <div class="crud-container">

        <a href="{{ route('data-sampah.index') }}" class="crud-back">
          <i class="bi bi-arrow-left"></i> Kembali ke Daftar Data
        </a>

        {{-- PAGE HEADER --}}
        <div class="crud-header">
          <div class="crud-header__left">
            <div class="crud-header__icon crud-header__icon--sampah">
              <i class="bi bi-pencil-square"></i>
            </div>
            <div>
              <h1 class="crud-header__title">Edit Data Sampah</h1>
              <p class="crud-header__subtitle">Perbarui data: {{ $dataSampah->kecamatan }}</p>
            </div>
          </div>
        </div>

        {{-- VALIDATION ERRORS --}}
        @if($errors->any())
          <div class="crud-errors">
            <div class="crud-errors__title">
              <i class="bi bi-exclamation-circle"></i> Terdapat kesalahan input
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
          <form method="POST" action="{{ route('data-sampah.update', $dataSampah->id) }}" id="form-edit-sampah">
            @csrf
            @method('PUT')

            {{-- SECTION: Lokasi --}}
            <div class="crud-form__section">
              <h3 class="crud-form__section-title">
                <i class="bi bi-geo-alt"></i> Informasi Lokasi
              </h3>
              <div class="crud-form__grid">
                <div class="crud-form__group">
                  <label class="crud-form__label">Kecamatan <span class="required">*</span></label>
                  <input type="text" name="kecamatan" class="crud-form__input" 
                         value="{{ old('kecamatan', $dataSampah->kecamatan) }}" required id="input-kecamatan">
                </div>
                <div class="crud-form__group">
                  <label class="crud-form__label">Kelurahan</label>
                  <input type="text" name="kelurahan" class="crud-form__input" 
                         value="{{ old('kelurahan', $dataSampah->kelurahan) }}" id="input-kelurahan">
                </div>
              </div>
            </div>

            {{-- SECTION: Data Sampah --}}
            <div class="crud-form__section">
              <h3 class="crud-form__section-title">
                <i class="bi bi-box-seam"></i> Data Volume Sampah
              </h3>
              <div class="crud-form__grid">
                <div class="crud-form__group">
                  <label class="crud-form__label">Volume Sampah (Ton) <span class="required">*</span></label>
                  <input type="number" name="volume_sampah_ton" class="crud-form__input" 
                         value="{{ old('volume_sampah_ton', $dataSampah->volume_sampah_ton) }}" step="0.01" min="0" required>
                </div>
                <div class="crud-form__group">
                  <label class="crud-form__label">Sampah Terangkut (Ton) <span class="required">*</span></label>
                  <input type="number" name="sampah_terangkut_ton" class="crud-form__input" 
                         value="{{ old('sampah_terangkut_ton', $dataSampah->sampah_terangkut_ton) }}" step="0.01" min="0" required>
                </div>
                <div class="crud-form__group">
                  <label class="crud-form__label">Sampah Diolah (Ton) <span class="required">*</span></label>
                  <input type="number" name="sampah_diolah_ton" class="crud-form__input" 
                         value="{{ old('sampah_diolah_ton', $dataSampah->sampah_diolah_ton) }}" step="0.01" min="0" required>
                </div>
                <div class="crud-form__group">
                  <label class="crud-form__label">Tidak Terkelola (Ton) <span class="required">*</span></label>
                  <input type="number" name="sampah_tidak_terkelola_ton" class="crud-form__input" 
                         value="{{ old('sampah_tidak_terkelola_ton', $dataSampah->sampah_tidak_terkelola_ton) }}" step="0.01" min="0" required>
                </div>
              </div>
            </div>

            {{-- SECTION: Fasilitas --}}
            <div class="crud-form__section">
              <h3 class="crud-form__section-title">
                <i class="bi bi-building"></i> Data Fasilitas
              </h3>
              <div class="crud-form__grid--3 crud-form__grid">
                <div class="crud-form__group">
                  <label class="crud-form__label">Jumlah TPS <span class="required">*</span></label>
                  <input type="number" name="jumlah_tps" class="crud-form__input" 
                         value="{{ old('jumlah_tps', $dataSampah->jumlah_tps) }}" min="0" required>
                </div>
                <div class="crud-form__group">
                  <label class="crud-form__label">Jumlah Bank Sampah <span class="required">*</span></label>
                  <input type="number" name="jumlah_bank_sampah" class="crud-form__input" 
                         value="{{ old('jumlah_bank_sampah', $dataSampah->jumlah_bank_sampah) }}" min="0" required>
                </div>
                <div class="crud-form__group">
                  <label class="crud-form__label">Tahun <span class="required">*</span></label>
                  <input type="number" name="tahun" class="crud-form__input" 
                         value="{{ old('tahun', $dataSampah->tahun) }}" min="2000" max="2099" required>
                </div>
              </div>
            </div>

            {{-- SECTION: Tambahan --}}
            <div class="crud-form__section">
              <h3 class="crud-form__section-title">
                <i class="bi bi-info-circle"></i> Informasi Tambahan
              </h3>
              <div class="crud-form__grid">
                <div class="crud-form__group">
                  <label class="crud-form__label">Sumber Data</label>
                  <input type="text" name="sumber_data" class="crud-form__input" 
                         value="{{ old('sumber_data', $dataSampah->sumber_data) }}">
                </div>
                <div class="crud-form__group">
                  <label class="crud-form__label">Keterangan</label>
                  <textarea name="keterangan" class="crud-form__textarea">{{ old('keterangan', $dataSampah->keterangan) }}</textarea>
                </div>
              </div>
            </div>

            {{-- ACTIONS --}}
            <div class="crud-form__actions">
              <button type="submit" class="crud-btn crud-btn--primary" id="btn-update">
                <i class="bi bi-check-lg"></i> Perbarui Data
              </button>
              <a href="{{ route('data-sampah.index') }}" class="crud-btn crud-btn--outline">
                <i class="bi bi-x-lg"></i> Batal
              </a>
            </div>
          </form>
        </div>

      </div>
    </section>
  </div>

  @include('partials.footer')
</body>
</html>
