<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Tambah Data RTH - Bappeda Surabaya</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
  <link rel="stylesheet" href="{{ asset('css/crud.css') }}">
</head>
<body class="app-shell">
  @include('partials.header')
  <div class="app-shell__content">
    <section class="crud-page">
      <div class="crud-container">
        <a href="{{ route('rth.index') }}" class="crud-back"><i class="bi bi-arrow-left"></i> Kembali</a>
        <div class="crud-header"><div class="crud-header__left">
          <div class="crud-header__icon" style="background:linear-gradient(135deg,#16a34a,#15803d)"><i class="bi bi-plus-lg"></i></div>
          <div><h1 class="crud-header__title">Tambah Data RTH</h1><p class="crud-header__subtitle">Tambahkan data ruang terbuka hijau baru</p></div>
        </div></div>
        @if($errors->any())
          <div class="crud-errors"><div class="crud-errors__title"><i class="bi bi-exclamation-circle"></i> Kesalahan</div><ul class="crud-errors__list">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
        @endif
        <div class="crud-form-card">
          <form method="POST" action="{{ route('rth.store') }}">@csrf
            <div class="crud-form__section">
              <h3 class="crud-form__section-title"><i class="bi bi-tree"></i> Informasi RTH</h3>
              <div class="crud-form__grid--3 crud-form__grid">
                <div class="crud-form__group"><label class="crud-form__label">Tipologi <span class="required">*</span></label>
                  <select name="tipologi" class="crud-form__select" required>
                    <option value="">-- Pilih --</option>
                    <option value="A" {{ old('tipologi')=='A'?'selected':'' }}>A - Publik</option>
                    <option value="B" {{ old('tipologi')=='B'?'selected':'' }}>B - Privat</option>
                    <option value="C" {{ old('tipologi')=='C'?'selected':'' }}>C - Badan Air</option>
                  </select>
                </div>
                <div class="crud-form__group"><label class="crud-form__label">Zona <span class="required">*</span></label><input type="text" name="zona" class="crud-form__input" value="{{ old('zona') }}" required></div>
                <div class="crud-form__group"><label class="crud-form__label">Kode</label><input type="text" name="kode" class="crud-form__input" value="{{ old('kode') }}"></div>
              </div>
            </div>
            <div class="crud-form__section">
              <h3 class="crud-form__section-title"><i class="bi bi-rulers"></i> Data Luasan</h3>
              <div class="crud-form__grid">
                <div class="crud-form__group"><label class="crud-form__label">Luas (Ha) <span class="required">*</span></label><input type="number" name="luas" class="crud-form__input" value="{{ old('luas', 0) }}" step="0.01" min="0" required></div>
                <div class="crud-form__group"><label class="crud-form__label">Bobot (%)</label><input type="number" name="bobot" class="crud-form__input" value="{{ old('bobot', 0) }}" step="0.01" min="0"></div>
                <div class="crud-form__group"><label class="crud-form__label">Luas x Bobot</label><input type="number" name="luas_x_bobot" class="crud-form__input" value="{{ old('luas_x_bobot', 0) }}" step="0.01" min="0"></div>
                <div class="crud-form__group"><label class="crud-form__label">FHBI</label><input type="number" name="fhbi" class="crud-form__input" value="{{ old('fhbi', 0) }}" step="0.01" min="0"></div>
                <div class="crud-form__group"><label class="crud-form__label">Jumlah</label><input type="number" name="jumlah" class="crud-form__input" value="{{ old('jumlah', 0) }}" step="0.01" min="0"></div>
              </div>
            </div>
            <div class="crud-form__actions">
              <button type="submit" class="crud-btn crud-btn--success"><i class="bi bi-check-lg"></i> Simpan</button>
              <a href="{{ route('rth.index') }}" class="crud-btn crud-btn--outline"><i class="bi bi-x-lg"></i> Batal</a>
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>
  @include('partials.footer')
</body>
</html>
