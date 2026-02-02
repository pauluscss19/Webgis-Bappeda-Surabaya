<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Login - SIDAPETA SBY</title>
  {{-- Pastikan file CSS ini ada di folder public/css --}}
  <link rel="stylesheet" href="{{ asset('css/login-sby.css') }}">
</head>
<body>

  <main class="login-page" style="background-image: url('{{ asset('images/bg-sby.jpg') }}')">
     <section class="card login-anim">

      <div class="logos">
        <a href="#" target="_blank" rel="noopener">
          <img class="logo" src="{{ asset('images/logo-1.png') }}" alt="Logo 1">
        </a>
        <a href="#" target="_blank" rel="noopener">
          <img class="logo" src="{{ asset('images/logo-2.png') }}" alt="Logo 2">
        </a>
      </div>

      <h1 class="title">SIDAPETA</h1>
      <p class="subtitle">Silakan masuk untuk mengakses data & peta lokasi<br>Kota Surabaya</p>

      {{-- Form Action mengarah ke route('login') bawaan Breeze --}}
      <form class="form" method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Menampilkan Error Global (jika ada) --}}
        @if ($errors->any())
            <div class="form-alert" style="color: red; font-size: 0.9em; margin-bottom: 10px; text-align: center;">
                {{-- Menampilkan error pertama yang ditemukan --}}
                {{ $errors->first('email') ?: $errors->first('password') }}
            </div>
        @endif

        {{-- Input Email (Breeze default menggunakan email) --}}
        <label class="label" for="email">Email</label>
        <input class="input" id="email" name="email" type="email"
               value="{{ old('email') }}"
               required autofocus autocomplete="username">

        {{-- Input Password --}}
        <label class="label" for="password">Password</label>
        <input class="input" id="password" name="password" type="password"
               required autocomplete="current-password">

        {{-- Opsi Remember Me (Opsional, tapi disarankan) --}}
        <div style="margin-bottom: 15px; display: flex; align-items: center; font-size: 0.85em;">
            <input id="remember_me" type="checkbox" name="remember" style="margin-right: 5px;">
            <label for="remember_me" style="color: #666;">Ingat Saya</label>
        </div>

        <button class="btn login-anim-btn" type="submit">LOGIN</button>
      </form>

    </section>
  </main>

</body>
</html>