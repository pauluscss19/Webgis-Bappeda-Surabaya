<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Login - SIDAPETA SBY</title>

  <link rel="stylesheet" href="{{ asset('css/login-sby.css') }}">
</head>
<body>

  <main class="login-page" style="background-image: url('{{ asset('images/bg-sby.jpg') }}')">
     <section class="card login-anim">

      <div class="logos">
        {{-- Logo 1 pakai href --}}
        <a href="https://contoh-link-logo-1.com" target="_blank" rel="noopener">
          <img class="logo" src="{{ asset('images/logo-1.png') }}" alt="Logo 1">
        </a>

        {{-- Logo 2 pakai href --}}
        <a href="https://contoh-link-logo-2.com" target="_blank" rel="noopener">
          <img class="logo" src="{{ asset('images/logo-2.png') }}" alt="Logo 2">
        </a>
      </div>

      <h1 class="title">SIDAPETA SBY</h1>
      <p class="subtitle">Silakan masuk untuk mengakses data & peta lokasi<br>Kota Surabaya</p>

      <form class="form" method="POST" action="#">
        @csrf

        <label class="label" for="username">Username</label>
        <input class="input" id="username" name="username" type="text" autocomplete="username" placeholder="">

        <label class="label" for="password">Password</label>
        <input class="input" id="password" name="password" type="password" autocomplete="current-password" placeholder="">

        <button class="btn login-anim-btn" type="submit">LOGIN</button>

      </form>

    </section>
  </main>

</body>
</html>
