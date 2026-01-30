<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Data Statistik - Bappeda Surabaya</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
  <link rel="stylesheet" href="{{ asset('css/analisis.css') }}">
</head>

<body class="app-shell">
  @include('partials.header')

  <main class="app-shell__content ana">
    {{-- Banner --}}
    <section class="ana-hero">
      <div class="ana-hero__inner">
        <div class="ana-hero__icon" aria-hidden="true">
          <i class="bi bi-bar-chart-fill"></i>
        </div>
        <div>
          <h1 class="ana-hero__title">Data Statistik Pembangunan</h1>
          <p class="ana-hero__subtitle">Penyajian data statistik pembangunan Kota Surabaya</p>
        </div>
      </div>
    </section>

    {{-- Strip kartu ringkas --}}
    <section class="ana-strip">
      <div class="ana-strip__inner">
        <div class="ana-mini">
          <div class="ana-mini__label">Total Anggaran</div>
          <div class="ana-mini__value">Rp 1,3 T</div>
          <div class="ana-mini__sub">Tahun Anggaran 2025</div>
        </div>

        <div class="ana-mini">
          <div class="ana-mini__label">Total Anggaran</div>
          <div class="ana-mini__value">Rp 1,3 T</div>
          <div class="ana-mini__sub">Tahun Anggaran 2025</div>
        </div>

        <div class="ana-mini">
          <div class="ana-mini__label">Total Anggaran</div>
          <div class="ana-mini__value">Rp 1,3 T</div>
          <div class="ana-mini__sub">Tahun Anggaran 2025</div>
        </div>

        <div class="ana-mini">
          <div class="ana-mini__label">Total Anggaran</div>
          <div class="ana-mini__value">Rp 1,3 T</div>
          <div class="ana-mini__sub">Tahun Anggaran 2025</div>
        </div>
      </div>
    </section>

    {{-- Tabel --}}
    <section class="ana-main">
      <div class="ana-card">
        <h2 class="ana-card__title">Realisasi Anggaran per Sektor</h2>

        <div class="ana-tablewrap">
          <table class="ana-table">
            <thead>
              <tr>
                <th>Kategori</th>
                <th>Realisasi</th>
                <th>Target</th>
                <th>Capaian</th>
                <th>Trend</th>
              </tr>
            </thead>

            <tbody>
              @php
                $rows = [
                  ['Infrastruktur Jalan', 'Rp 245,8 M', 'Rp 300 M', 82],
                  ['Pendidikan', 'Rp 245,8 M', 'Rp 300 M', 82],
                  ['Tanaman', 'Rp 245,8 M', 'Rp 300 M', 82],
                  ['Jembatan', 'Rp 245,8 M', 'Rp 300 M', 82],
                  ['Fly Over', 'Rp 245,8 M', 'Rp 300 M', 82],
                  ['JPO', 'Rp 245,8 M', 'Rp 300 M', 82],
                ];
              @endphp

              @foreach($rows as $r)
                <tr>
                  <td class="ana-td--strong">{{ $r[0] }}</td>
                  <td>{{ $r[1] }}</td>
                  <td>{{ $r[2] }}</td>
                  <td>
                    <div class="ana-cap">
                      <div class="ana-cap__bar">
                        <span class="ana-cap__fill" style="width: {{ $r[3] }}%"></span>
                      </div>
                      <span class="ana-cap__pct">{{ $r[3] }}%</span>
                    </div>
                  </td>
                  <td class="ana-trend">
                    <i class="bi bi-arrow-up" aria-hidden="true"></i>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </section>
  </main>

  @include('partials.footer')
</body>
</html>
