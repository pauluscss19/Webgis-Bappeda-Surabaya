<header class="topbar">
  <div class="navwrap">
    <div class="brand">
      <a href="https://link-logo-kamu-1" class="brand-logo" target="_blank" rel="noopener">
        <img src="{{ asset('images/logo-2.png') }}" alt="Logo">
      </a>
      <span class="brand-text">Bappeda Surabaya</span>
    </div>

    <nav class="nav">
      <a class="navlink {{ request()->routeIs('beranda') ? 'active' : '' }}" href="{{ route('beranda') }}">
        <i class="bi bi-house-door"></i>
        Beranda
      </a>

      <a class="navlink {{ request()->is('peta*') ? 'active' : '' }}" href="{{ url('/peta') }}">
        <i class="bi bi-map"></i>
        Peta
      </a>

      <a class="navlink {{ request()->is('data-statistik*') ? 'active' : '' }}" href="{{ url('/data-statistik') }}">
        <i class="bi bi-bar-chart"></i>
        Data Statistik
      </a>
    </nav>

    <a class="logout" href="{{ url('/logout') }}">Logout</a>
  </div>
</header>
