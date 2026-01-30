<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Peta - SIDAPETA SBY</title>

  {{-- CSS halaman peta --}}
  <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
  <link rel="stylesheet" href="{{ asset('css/peta.css') }}">

  {{-- Bootstrap Icons (buat icon header bar) --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  {{-- Leaflet --}}
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
</head>
<body>

  {{-- Navbar sudah ada di partials --}}
  @include('partials.header') 

  <main class="peta-page">
    <section class="peta-banner">
      <div class="peta-banner__inner">
        <div class="peta-banner__icon" aria-hidden="true">
  <a href="{{ asset('images/icon-peta.jpg') }}" target="_blank" rel="noopener">
    <img src="{{ asset('images/icon-peta.jpg') }}" alt="Icon Peta">
  </a>
</div>

        <div class="peta-banner__text">
          <h1 class="peta-banner__title">Peta Pembangunan</h1>
          <p class="peta-banner__subtitle">Penyajian peta tematik pembangunan Kota Surabaya</p>
        </div>
      </div>
    </section>

    <section class="peta-content">
      <div class="peta-card">
        <div class="peta-card__header">
          <div class="peta-card__label">Peta Interaktif</div>
          <div class="peta-card__hint">Gunakan scroll untuk zoom, drag untuk geser</div>
        </div>

        <div id="map" class="peta-map"></div>
      </div>
    </section>
  </main>

  {{-- Footer sudah ada di partials (logo pakai href sudah kamu set di footer) --}}
  @include('partials.footer')

  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <script>
    // Leaflet basic map (OSM)
    const map = L.map('map').setView([-7.2575, 112.7521], 12); // Surabaya

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '&copy; OpenStreetMap'
    }).addTo(map);
  </script>
</body>
</html>
