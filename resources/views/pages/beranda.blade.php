<!doctype html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Beranda - SIGAP</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
  <link rel="stylesheet" href="{{ asset('css/beranda.css') }}">
</head>

<body class="app-shell">
  @include('partials.header')

  <div class="app-shell__content">
    <main class="hero" style="background-image:
        linear-gradient(90deg, rgba(0,0,0,.45), rgba(0,0,0,.15)),
        url('{{ asset('images/Kantor_Bappeko_Surabaya.jpg') }}');">

      <div class="hero-inner intro">
        <div class="pill intro-item">
          <span class="dot"></span>
          Sistem Informasi Geospasial Persampahan
        </div>

        <h1 class="headline floaty intro-item">SIGAP Surabaya</h1>

        <p class="desc intro-item">
          Platform visualisasi dan pengelolaan data spasial persampahan untuk mendukung pemantauan, analisis, serta
          perencanaan pengelolaan sampah yang lebih efektif dan berkelanjutan.

        <div class="cta intro-item">
          <a class="btn primary" href="{{ url('/peta') }}">
            Lihat Peta Persebaran
            <i class="bi bi-arrow-right hero__cta-icon" aria-hidden="true"></i>
          </a>

          <a class="btn outline" href="{{ url('/data-statistik') }}">
            Akses Data Statistik
          </a>
        </div>
      </div>
    </main>

    <section class="home-stats reveal">
      <div class="home-stats__inner">
        <div class="home-stat">
          <i class="bi bi-bullseye home-stat__icon" aria-hidden="true"></i>
          <div class="home-stat__value">248</div>
          <div class="home-stat__label">Proyek Persebaran</div>
        </div>

        <div class="home-stat">
          <i class="bi bi-building home-stat__icon" aria-hidden="true"></i>
          <div class="home-stat__value">156</div>
          <div class="home-stat__label">Proyek Aktif</div>
        </div>

        <div class="home-stat">
          <i class="bi bi-graph-up-arrow home-stat__icon" aria-hidden="true"></i>
          <div class="home-stat__value">87%</div>
          <div class="home-stat__label">Capaian Target</div>
        </div>

        <div class="home-stat">
          <i class="bi bi-people home-stat__icon" aria-hidden="true"></i>
          <div class="home-stat__value">42</div>
          <div class="home-stat__label">SKPD Terlibat</div>
        </div>
      </div>
    </section>

    <section class="home-features">
      <div class="home-wrap">
        <h2 class="home-title reveal">Fitur Unggulan</h2>
        <p class="home-subtitle reveal">
          Berbagai fitur modern untuk mendukung pengelolaan, pemantauan, dan perencanaan sistem persampahan yang efektif
          dan efisien.
        </p>

        <div class="home-cards">
          <a class="home-card reveal" href="{{ url('/peta') }}">
            <div class="home-card__icon"><i class="bi bi-map" aria-hidden="true"></i></div>
            <div class="home-card__title">Peta Persebaran</div>
            <div class="home-card__desc">Visualisasi spasial persampahan Kota Surabaya dalam peta interaktif yang mudah
              dipahami.</div>
          </a>

          <a class="home-card reveal" href="{{ url('/data-statistik') }}">
            <div class="home-card__icon"><i class="bi bi-bar-chart" aria-hidden="true"></i></div>
            <div class="home-card__title">Data Statistik</div>
            <div class="home-card__desc">Penyajian data statistik persampa untuk pemantauan dan analisis yang mudah
              dipahami.</div>
          </a>

          <div class="home-card reveal">
            <div class="home-card__icon"><i class="bi bi-file-earmark-text" aria-hidden="true"></i></div>
            <div class="home-card__title">Dokumen Perencanaan</div>
            <div class="home-card__desc">Repository dokumen perencanaan pembangunan dengan akses terstruktur dan mudah
              ditelusuri.</div>
          </div>

          <div class="home-card reveal">
            <div class="home-card__icon"><i class="bi bi-diagram-3" aria-hidden="true"></i></div>
            <div class="home-card__title">Kolaborasi</div>
            <div class="home-card__desc">Fasilitas kolaborasi antar-SKPD untuk koordinasi perencanaan yang efektif.
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="home-why">
      <div class="home-wrap">
        <h2 class="home-title home-title--left reveal">Mengapa Menggunakan Sistem Ini?</h2>

        <p class="home-why__desc reveal">
          Sistem Informasi Geospasial Persampahan (SIGAP) dirancang untuk meningkatkan efektivitas pengelolaan,

          pemantauan, dan analisis data persampahan melalui pemanfaatan teknologi geospasial.
        </p>

        <ul class="home-why__list reveal">
          <li><i class="bi bi-check-circle" aria-hidden="true"></i> Integrasi data spasial persampahan dalam satu
            platform terpusat</li>
          <li><i class="bi bi-check-circle" aria-hidden="true"></i> Visualisasi sebaran fasilitas dan layanan
            persampahan secara interaktif</li>
          <li><i class="bi bi-check-circle" aria-hidden="true"></i> Monitoring kondisi dan pengelolaan data persampahan
            secara efektif</li>
          <li><i class="bi bi-check-circle" aria-hidden="true"></i> Analisis data geospasial untuk mendukung pengambilan
            keputusan dan perencanaan layanan persampahan</li>
        </ul>

        <div class="home-progress reveal">
          <div class="home-progress__title">Data Terkini Persampahan</div>

          <div class="home-bar">
            <div class="home-bar__row">
              <span>Cakupan Layanan Pengangkutan Sampah</span><span>90%</span>
            </div>
            <div class="home-bar__track">
              <div class="home-bar__fill" style="width:90%"></div>
            </div>
          </div>

          <div class="home-bar">
            <div class="home-bar__row">
              <span>Pemetaan Titik TPS</span><span>85%</span>
            </div>
            <div class="home-bar__track">
              <div class="home-bar__fill" style="width:85%"></div>
            </div>
          </div>

          <div class="home-bar">
            <div class="home-bar__row">
              <span>Pembaruan Data Persampahan</span><span>75%</span>
            </div>
            <div class="home-bar__track">
              <div class="home-bar__fill" style="width:75%"></div>
            </div>
          </div>
    </section>

    <section class="home-cta2">
      <div class="home-cta2__inner reveal">
        <h2 class="home-cta2__title">Mulai Jelajahi Data Persampahan</h2>
        <p class="home-cta2__subtitle">
          Akses informasi lengkap tentang perencanaan dan progress persampahan Kota Surabaya
        </p>

        <div class="home-cta2__buttons">
          <a class="home-cta2__btn" href="{{ url('/peta') }}">
            <i class="bi bi-map" aria-hidden="true"></i> Buka Peta
          </a>
          <a class="home-cta2__btn home-cta2__btn--outline" href="{{ url('/data-statistik') }}">
            <i class="bi bi-bar-chart" aria-hidden="true"></i> Lihat Statistik
          </a>
        </div>
      </div>
    </section>
  </div>

  @include('partials.footer')

  <script>
    const targets = document.querySelectorAll('.reveal');
    const io = new IntersectionObserver((entries, obs) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-in');
          obs.unobserve(entry.target); // animasi sekali saja
        }
      });
    }, { threshold: 0.15 });

    targets.forEach(el => io.observe(el));
  </script>
</body>

</html>