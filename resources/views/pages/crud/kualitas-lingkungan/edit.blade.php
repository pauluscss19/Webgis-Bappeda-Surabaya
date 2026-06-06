<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Edit Data Kualitas Lingkungan - Bappeda Surabaya</title>

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
              <i class="bi bi-pencil-square"></i>
            </div>
            <div>
              <h1 class="crud-header__title">Edit Data Kualitas Lingkungan</h1>
              <p class="crud-header__subtitle">Perbarui data: {{ $kualitasLingkungan->lokasi }}</p>
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
          <form method="POST" action="{{ route('kualitas-lingkungan.update', $kualitasLingkungan->id) }}" id="form-edit-kl">
            @csrf
            @method('PUT')

            {{-- SECTION: Lokasi --}}
            <div class="crud-form__section">
              <h3 class="crud-form__section-title">
                <i class="bi bi-geo-alt"></i> Informasi Lokasi
              </h3>
              <div class="crud-form__grid--3 crud-form__grid">
                <div class="crud-form__group">
                  <label class="crud-form__label">Lokasi Pengujian <span class="required">*</span></label>
                  <input type="text" name="lokasi" class="crud-form__input" 
                         value="{{ old('lokasi', $kualitasLingkungan->lokasi) }}" required>
                </div>
                <div class="crud-form__group">
                  <label class="crud-form__label">Kecamatan</label>
                  <input type="text" name="kecamatan" class="crud-form__input" 
                         value="{{ old('kecamatan', $kualitasLingkungan->kecamatan) }}">
                </div>
                <div class="crud-form__group">
                  <label class="crud-form__label">Kelurahan</label>
                  <input type="text" name="kelurahan" class="crud-form__input" 
                         value="{{ old('kelurahan', $kualitasLingkungan->kelurahan) }}">
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
                  <select name="jenis_uji" class="crud-form__select" required>
                    <option value="">-- Pilih Jenis Uji --</option>
                    @foreach(['air_sungai' => 'Air Sungai', 'air_laut' => 'Air Laut', 'udara_ambien' => 'Udara Ambien', 'tanah' => 'Tanah', 'kebisingan' => 'Kebisingan'] as $val => $label)
                      <option value="{{ $val }}" {{ old('jenis_uji', $kualitasLingkungan->jenis_uji) == $val ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="crud-form__group">
                  <label class="crud-form__label">Parameter Uji <span class="required">*</span></label>
                  <input type="text" name="parameter_uji" class="crud-form__input" 
                         value="{{ old('parameter_uji', $kualitasLingkungan->parameter_uji) }}" required>
                </div>
                <div class="crud-form__group">
                  <label class="crud-form__label">Nilai Hasil</label>
                  <input type="number" name="nilai_hasil" class="crud-form__input" 
                         value="{{ old('nilai_hasil', $kualitasLingkungan->nilai_hasil) }}" step="0.001">
                </div>
                <div class="crud-form__group">
                  <label class="crud-form__label">Satuan</label>
                  <input type="text" name="satuan" class="crud-form__input" 
                         value="{{ old('satuan', $kualitasLingkungan->satuan) }}">
                </div>
                <div class="crud-form__group">
                  <label class="crud-form__label">Baku Mutu / Standar</label>
                  <input type="number" name="baku_mutu" class="crud-form__input" 
                         value="{{ old('baku_mutu', $kualitasLingkungan->baku_mutu) }}" step="0.001">
                </div>
                <div class="crud-form__group">
                  <label class="crud-form__label">Status <span class="required">*</span></label>
                  <select name="status" class="crud-form__select" required>
                    <option value="belum_diuji" {{ old('status', $kualitasLingkungan->status) == 'belum_diuji' ? 'selected' : '' }}>Belum Diuji</option>
                    <option value="memenuhi" {{ old('status', $kualitasLingkungan->status) == 'memenuhi' ? 'selected' : '' }}>Memenuhi Baku Mutu</option>
                    <option value="tidak_memenuhi" {{ old('status', $kualitasLingkungan->status) == 'tidak_memenuhi' ? 'selected' : '' }}>Tidak Memenuhi</option>
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
                         value="{{ old('tanggal_uji', $kualitasLingkungan->tanggal_uji?->format('Y-m-d')) }}">
                </div>
                <div class="crud-form__group">
                  <label class="crud-form__label">Tahun <span class="required">*</span></label>
                  <input type="number" name="tahun" class="crud-form__input" 
                         value="{{ old('tahun', $kualitasLingkungan->tahun) }}" min="2000" max="2099" required>
                </div>
                <div class="crud-form__group">
                  <label class="crud-form__label">Sumber Data</label>
                  <input type="text" name="sumber_data" class="crud-form__input" 
                         value="{{ old('sumber_data', $kualitasLingkungan->sumber_data) }}">
                </div>
              </div>
              <div class="crud-form__grid" style="margin-top:18px">
                <div class="crud-form__group crud-form__group--full">
                  <label class="crud-form__label">Keterangan</label>
                  <textarea name="keterangan" class="crud-form__textarea">{{ old('keterangan', $kualitasLingkungan->keterangan) }}</textarea>
                </div>
              </div>
            </div>

            {{-- ACTIONS --}}
            <div class="crud-form__actions">
              <button type="submit" class="crud-btn crud-btn--primary" id="btn-update">
                <i class="bi bi-check-lg"></i> Perbarui Data
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
