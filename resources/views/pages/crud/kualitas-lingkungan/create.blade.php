<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Tambah Data Kualitas Lingkungan - Bappeda Surabaya</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
  <link rel="stylesheet" href="{{ asset('css/crud.css') }}">
</head>

<body class="app-shell">
  @include('partials.header')

  <div class="app-shell__content">
    <section class="crud-page">
      <div class="crud-container">

        <a href="{{ route('kualitas-lingkungan.index') }}" class="crud-back">
          <i class="bi bi-arrow-left"></i> Kembali ke Daftar Data
        </a>

        {{-- PAGE HEADER --}}
        <div class="crud-header">
          <div class="crud-header__left">
            <div class="crud-header__icon crud-header__icon--lingkungan">
              <i class="bi bi-plus-lg"></i>
            </div>
            <div>
              <h1 class="crud-header__title">Tambah Data Kualitas Lingkungan</h1>
              <p class="crud-header__subtitle">Tambahkan data pengujian baru</p>
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
          <form method="POST" action="{{ route('kualitas-lingkungan.store') }}" id="form-create-kl">
            @csrf

            {{-- SECTION: Lokasi --}}
            <div class="crud-form__section">
              <h3 class="crud-form__section-title">
                <i class="bi bi-geo-alt"></i> Informasi Lokasi
              </h3>
              <div class="crud-form__grid--3 crud-form__grid">
                <div class="crud-form__group">
                  <label class="crud-form__label">Lokasi Pengujian <span class="required">*</span></label>
                  <input type="text" name="lokasi" class="crud-form__input" 
                         value="{{ old('lokasi') }}" placeholder="Contoh: Sungai Kalimas" required id="input-lokasi">
                </div>
                <div class="crud-form__group">
                  <label class="crud-form__label">Kecamatan</label>
                  <input type="text" name="kecamatan" class="crud-form__input" 
                         value="{{ old('kecamatan') }}" placeholder="Contoh: Genteng" id="input-kecamatan">
                </div>
                <div class="crud-form__group">
                  <label class="crud-form__label">Kelurahan</label>
                  <input type="text" name="kelurahan" class="crud-form__input" 
                         value="{{ old('kelurahan') }}" placeholder="Contoh: Genteng" id="input-kelurahan">
                </div>
              </div>
            </div>

            {{-- SECTION: Pengujian --}}
            <div class="crud-form__section">
              <h3 class="crud-form__section-title">
                <i class="bi bi-clipboard2-pulse"></i> Data Pengujian
              </h3>
              <div class="crud-form__grid">
                <div class="crud-form__group">
                  <label class="crud-form__label">Jenis Uji <span class="required">*</span></label>
                  <select name="jenis_uji" class="crud-form__select" required id="input-jenis-uji">
                    <option value="">-- Pilih Jenis Uji --</option>
                    <option value="air_sungai" {{ old('jenis_uji') == 'air_sungai' ? 'selected' : '' }}>Air Sungai</option>
                    <option value="air_laut" {{ old('jenis_uji') == 'air_laut' ? 'selected' : '' }}>Air Laut</option>
                    <option value="udara_ambien" {{ old('jenis_uji') == 'udara_ambien' ? 'selected' : '' }}>Udara Ambien</option>
                    <option value="tanah" {{ old('jenis_uji') == 'tanah' ? 'selected' : '' }}>Tanah</option>
                    <option value="kebisingan" {{ old('jenis_uji') == 'kebisingan' ? 'selected' : '' }}>Kebisingan</option>
                  </select>
                </div>
                <div class="crud-form__group">
                  <label class="crud-form__label">Parameter Uji <span class="required">*</span></label>
                  <input type="text" name="parameter_uji" class="crud-form__input" 
                         value="{{ old('parameter_uji') }}" placeholder="Contoh: BOD, COD, pH, PM10" required id="input-parameter">
                </div>
                <div class="crud-form__group">
                  <label class="crud-form__label">Nilai Hasil</label>
                  <input type="number" name="nilai_hasil" class="crud-form__input" 
                         value="{{ old('nilai_hasil') }}" step="0.001" placeholder="Contoh: 5.42" id="input-nilai">
                </div>
                <div class="crud-form__group">
                  <label class="crud-form__label">Satuan</label>
                  <input type="text" name="satuan" class="crud-form__input" 
                         value="{{ old('satuan') }}" placeholder="Contoh: mg/L, µg/m³, dB" id="input-satuan">
                </div>
                <div class="crud-form__group">
                  <label class="crud-form__label">Baku Mutu / Standar</label>
                  <input type="number" name="baku_mutu" class="crud-form__input" 
                         value="{{ old('baku_mutu') }}" step="0.001" placeholder="Nilai baku mutu" id="input-baku-mutu">
                </div>
                <div class="crud-form__group">
                  <label class="crud-form__label">Status <span class="required">*</span></label>
                  <select name="status" class="crud-form__select" required id="input-status">
                    <option value="belum_diuji" {{ old('status', 'belum_diuji') == 'belum_diuji' ? 'selected' : '' }}>Belum Diuji</option>
                    <option value="memenuhi" {{ old('status') == 'memenuhi' ? 'selected' : '' }}>Memenuhi Baku Mutu</option>
                    <option value="tidak_memenuhi" {{ old('status') == 'tidak_memenuhi' ? 'selected' : '' }}>Tidak Memenuhi</option>
                  </select>
                </div>
              </div>
            </div>

            {{-- SECTION: Periode --}}
            <div class="crud-form__section">
              <h3 class="crud-form__section-title">
                <i class="bi bi-calendar3"></i> Periode & Sumber
              </h3>
              <div class="crud-form__grid--3 crud-form__grid">
                <div class="crud-form__group">
                  <label class="crud-form__label">Tanggal Uji</label>
                  <input type="date" name="tanggal_uji" class="crud-form__input" 
                         value="{{ old('tanggal_uji') }}" id="input-tanggal">
                </div>
                <div class="crud-form__group">
                  <label class="crud-form__label">Tahun <span class="required">*</span></label>
                  <input type="number" name="tahun" class="crud-form__input" 
                         value="{{ old('tahun', date('Y')) }}" min="2000" max="2099" required id="input-tahun">
                </div>
                <div class="crud-form__group">
                  <label class="crud-form__label">Sumber Data</label>
                  <input type="text" name="sumber_data" class="crud-form__input" 
                         value="{{ old('sumber_data') }}" placeholder="Contoh: DLH Surabaya" id="input-sumber">
                </div>
              </div>
              <div class="crud-form__grid" style="margin-top:18px">
                <div class="crud-form__group crud-form__group--full">
                  <label class="crud-form__label">Keterangan</label>
                  <textarea name="keterangan" class="crud-form__textarea" 
                            placeholder="Catatan tambahan (opsional)" id="input-keterangan">{{ old('keterangan') }}</textarea>
                </div>
              </div>
            </div>

            {{-- ACTIONS --}}
            <div class="crud-form__actions">
              <button type="submit" class="crud-btn crud-btn--primary" id="btn-simpan">
                <i class="bi bi-check-lg"></i> Simpan Data
              </button>
              <a href="{{ route('kualitas-lingkungan.index') }}" class="crud-btn crud-btn--outline">
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
