<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Edit Data Sarpras - Bappeda Surabaya</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
  <link rel="stylesheet" href="{{ asset('css/crud.css') }}">
</head>
<body class="app-shell">
  @include('partials.header')
  <div class="app-shell__content">
    <section class="crud-page">
      <div class="crud-container">
        <a href="{{ route('sarpras.index') }}" class="crud-back"><i class="bi bi-arrow-left"></i> Kembali</a>
        <div class="crud-header">
          <div class="crud-header__left">
            <div class="crud-header__icon" style="background:linear-gradient(135deg,#f59e0b,#d97706)"><i class="bi bi-pencil-square"></i></div>
            <div><h1 class="crud-header__title">Edit Data Sarpras</h1><p class="crud-header__subtitle">{{ $sarpras->tipe_peralatan }}</p></div>
          </div>
        </div>
        @if($errors->any())
          <div class="crud-errors"><div class="crud-errors__title"><i class="bi bi-exclamation-circle"></i> Kesalahan input</div>
            <ul class="crud-errors__list">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
          </div>
        @endif
        <div class="crud-form-card">
          <form method="POST" action="{{ route('sarpras.update', $sarpras->id) }}">
            @csrf @method('PUT')
            <div class="crud-form__section">
              <h3 class="crud-form__section-title"><i class="bi bi-tools"></i> Informasi Peralatan</h3>
              <div class="crud-form__grid">
                <div class="crud-form__group"><label class="crud-form__label">Tipe Peralatan <span class="required">*</span></label><input type="text" name="tipe_peralatan" class="crud-form__input" value="{{ old('tipe_peralatan', $sarpras->tipe_peralatan) }}" required></div>
                <div class="crud-form__group"><label class="crud-form__label">Jenis BBM</label><input type="text" name="jenis_bbm" class="crud-form__input" value="{{ old('jenis_bbm', $sarpras->jenis_bbm) }}"></div>
              </div>
            </div>
            <div class="crud-form__section">
              <h3 class="crud-form__section-title"><i class="bi bi-boxes"></i> Jumlah Unit</h3>
              <div class="crud-form__grid">
                <div class="crud-form__group"><label class="crud-form__label">Jumlah Total <span class="required">*</span></label><input type="number" name="jumlah_total" class="crud-form__input" value="{{ old('jumlah_total', $sarpras->jumlah_total) }}" min="0" required></div>
                <div class="crud-form__group"><label class="crud-form__label">Beroperasi <span class="required">*</span></label><input type="number" name="jumlah_beroperasi" class="crud-form__input" value="{{ old('jumlah_beroperasi', $sarpras->jumlah_beroperasi) }}" min="0" required></div>
                <div class="crud-form__group"><label class="crud-form__label">Rusak <span class="required">*</span></label><input type="number" name="jumlah_rusak" class="crud-form__input" value="{{ old('jumlah_rusak', $sarpras->jumlah_rusak) }}" min="0" required></div>
                <div class="crud-form__group"><label class="crud-form__label">Cadangan</label><input type="number" name="jumlah_cadangan" class="crud-form__input" value="{{ old('jumlah_cadangan', $sarpras->jumlah_cadangan) }}" min="0"></div>
              </div>
            </div>
            <div class="crud-form__section">
              <h3 class="crud-form__section-title"><i class="bi bi-fuel-pump"></i> Kebutuhan BBM</h3>
              <div class="crud-form__grid">
                <div class="crud-form__group"><label class="crud-form__label">Per Unit Pertamax (L)</label><input type="number" name="kebutuhan_per_unit_pertamax" class="crud-form__input" value="{{ old('kebutuhan_per_unit_pertamax', $sarpras->kebutuhan_per_unit_pertamax) }}" step="0.01" min="0"></div>
                <div class="crud-form__group"><label class="crud-form__label">Per Unit Dexlite (L)</label><input type="number" name="kebutuhan_per_unit_dexlite" class="crud-form__input" value="{{ old('kebutuhan_per_unit_dexlite', $sarpras->kebutuhan_per_unit_dexlite) }}" step="0.01" min="0"></div>
                <div class="crud-form__group"><label class="crud-form__label">1 Tahun Pertamax (L)</label><input type="number" name="kebutuhan_1_tahun_pertamax" class="crud-form__input" value="{{ old('kebutuhan_1_tahun_pertamax', $sarpras->kebutuhan_1_tahun_pertamax) }}" step="0.01" min="0"></div>
                <div class="crud-form__group"><label class="crud-form__label">1 Tahun Dexlite (L)</label><input type="number" name="kebutuhan_1_tahun_dexlite" class="crud-form__input" value="{{ old('kebutuhan_1_tahun_dexlite', $sarpras->kebutuhan_1_tahun_dexlite) }}" step="0.01" min="0"></div>
              </div>
            </div>
            <div class="crud-form__section">
              <div class="crud-form__group crud-form__group--full"><label class="crud-form__label">Keterangan</label><textarea name="keterangan" class="crud-form__textarea">{{ old('keterangan', $sarpras->keterangan) }}</textarea></div>
            </div>
            <div class="crud-form__actions">
              <button type="submit" class="crud-btn crud-btn--primary"><i class="bi bi-check-lg"></i> Perbarui</button>
              <a href="{{ route('sarpras.index') }}" class="crud-btn crud-btn--outline"><i class="bi bi-x-lg"></i> Batal</a>
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>
  @include('partials.footer')
</body>
</html>
