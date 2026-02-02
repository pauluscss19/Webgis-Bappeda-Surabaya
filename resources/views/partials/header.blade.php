<header class="topbar">
  <div class="navwrap">
    
    {{-- LOGO BRAND --}}
    <div class="brand">
      <a href="#" class="brand-logo">
        <img src="{{ asset('images/logo-2.png') }}" alt="Logo" onerror="this.style.display='none'">
      </a>
      <span class="brand-text1">Bappeda</span>
      <span class="brand-text2">Surabaya</span>
    </div>

    {{-- MENU NAVIGASI --}}
    <nav class="nav">
      
      {{-- Menu Beranda --}}
      <a class="navlink {{ request()->routeIs('beranda') ? 'active' : '' }}" href="{{ route('beranda') }}">
        <i class="bi bi-house-door"></i>
        Beranda
      </a>

      {{-- Menu Peta --}}
      <a class="navlink {{ request()->is('peta*') ? 'active' : '' }}" href="{{ url('/peta') }}">
        <i class="bi bi-map"></i>
        Peta
      </a>

      {{-- Menu Data Statistik (DROPDOWN) --}}
      <div class="nav-item-dropdown">
          <a class="navlink {{ request()->is('data-statistik*') ? 'active' : '' }}" href="#">
            <i class="bi bi-bar-chart"></i>
            Data Statistik
            <i class="bi bi-chevron-down ms-1" style="font-size: 12px;"></i>
          </a>
          
          {{-- Isi Dropdown --}}
          <div class="dropdown-menu-custom">
              <a href="{{ url('/data-statistik') }}" class="dropdown-item-custom">
                  1. Pengelolaan Sampah
              </a>
              <a href="{{ url('/data-statistik?tab=rth') }}" class="dropdown-item-custom">
                  2. Ruang Terbuka Hijau
              </a>
              <a href="{{ url('/data-statistik?tab=sarpras') }}" class="dropdown-item-custom">
                  3. Sarana Prasarana
              </a>
              <a href="{{ url('/data-statistik?tab=sdm') }}" class="dropdown-item-custom">
                  4. Kepegawaian
              </a>
              <a href="{{ url('/data-statistik?tab=ringkasan') }}" class="dropdown-item-custom">
                  5. Ringkasan Eksekutif
              </a>
          </div>
      </div>

    </nav>

    {{-- TOMBOL LOGOUT --}}
    <a class="logout" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
      <i class="bi bi-box-arrow-right logout-icon"></i>
      Logout
    </a>

    {{-- Form Logout Rahasia --}}
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

  </div>
</header>