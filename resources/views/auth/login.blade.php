<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>SIDAPETA</title>
  
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

      <h1 class="title">SIDAPETA SURABAYA</h1>
      <p class="subtitle">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione mollitia, voluptatum quam qui suscipit cupiditate, consequatur nihil quidem, sit illum quia sunt eos itaque tenetur? Facilis nesciunt architecto vero eligendi?<br>Makanan Padang</p>

      {{-- Form Action mengarah ke route('login') bawaan Breeze --}}
      <form class="form" method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Menampilkan Error Global (jika ada) --}}
        @if ($errors->any())
            <div class="form-alert" style="color: red; font-size: 0.9em; margin-bottom: 10px; text-align: center;">
                {{-- Menampilkan error pertama yang ditemukan --}}
                {{ $errors->first('email') ?: $errors->first('password') ?: $errors->first('captcha') }}
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

        {{-- === CAPTCHA (BAGIAN BARU) === --}}
        <div class="captcha-container">
          <label class="captcha-label"> Masukan Kode</label>
          <div class="captcha-wrapper">
            <img 
              id="captcha-img" 
              src="{{ route('captcha.image') }}?{{ time() }}" 
              alt="CAPTCHA" 
              class="captcha-image"
            >
            <input 
              type="text" 
              id="captcha" 
              name="captcha" 
              class="captcha-input" 
              placeholder="Ketik kode"
              maxlength="6"
              required
              autocomplete="off"
            >
          </div>
          <button 
            type="button" 
            class="captcha-refresh" 
            onclick="refreshCaptcha()"
          >
            ↻ Refresh Kode
          </button>
          @error('captcha')
            <div class="captcha-error">{{ $message }}</div>
          @enderror
        </div>

        <button class="btn login-anim-btn" type="submit">LOGIN</button>
      </form>

    </section>
  </main>

  <script>
    function refreshCaptcha() {
      const img = document.getElementById('captcha-img');
      img.src = '{{ route("captcha.image") }}?' + Date.now();
      document.getElementById('captcha').value = '';
      document.getElementById('captcha').focus();
    }
  </script>

</body>
</html>
