<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <title>Beranda - Bappeda Surabaya</title>
  <link rel="stylesheet" href="{{ asset('css/beranda.css') }}">
</head>
<body>

  @include('partials.header') {{-- include partial di Blade --}} {{-- [web:167] --}}
 


  <main class="hero"
    style="background-image:
      linear-gradient(90deg, rgba(0,0,0,.45), rgba(0,0,0,.15)),
      url('{{ asset('images/Kantor_Bappeko_Surabaya.jpg') }}');">

    <div class="hero-inner intro">
      <div class="pill intro-item"><span class="dot"></span> Sistem Informasi Perencanaan Pembangunan</div>
       <h1 class="headline floaty intro-item">Wujudkan Surabaya</h1>
     <p class="desc intro-item">Platform digital terintegrasi untuk perencanaan, monitoring, dan evaluasi pembangunan Kota Surabaya. Mendukung pengambilan keputusan berbasis data untuk pembangunan yang berkelanjutan.</p>

       <div class="cta intro-item">
        <a class="btn primary" href="{{ url('/peta') }}">
  Lihat Peta Pembangunan
  <i class="bi bi-arrow-right btn-icon"></i>
</a>
        <a class="btn outline" href="{{ url('/data-statistik') }}">Akses Data Statistik</a>
      </div>
    </div>
  </main>

  {{-- konten tambahan supaya kelihatan efek scroll --}}
  <section style="height: 120vh; background: #fff;"></section>
 @include('partials.footer')
</body>
</html>
