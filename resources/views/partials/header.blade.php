<header class="topbar">
  <div class="navwrap">
    
    {{-- LOGO BRAND --}}
    <div class="brand">
      <a href="#" class="brand-logo">
        <img src="{{ asset('images/jasobundo.png') }}" alt="Logo" onerror="this.style.display='none'">
      </a>
      <span class="brand-text1">Jaso</span>
      <span class="brand-text2">Bundo</span>
    </div>

    {{-- MENU NAVIGASI --}}
    <nav class="nav">
      
      <a class="navlink {{ request()->routeIs('beranda') ? 'active' : '' }}" href="{{ route('beranda') }}">
        <i class="bi bi-house-door"></i>
        Beranda
      </a>

      <a class="navlink {{ request()->is('peta*') ? 'active' : '' }}" href="{{ url('/peta') }}">
        <i class="bi bi-map"></i>
        Peta
      </a>

      {{-- MENU DATA STATISTIK (REVISI JS) --}}
      <div class="nav-item-dropdown">
          {{-- Tambahkan onclick --}}
          <a class="navlink {{ request()->is('data-statistik*') ? 'active' : '' }}" href="#" onclick="toggleStatistik(event)">
            <i class="bi bi-bar-chart"></i>
            Data Statistik
            <i class="bi bi-chevron-down ms-1" style="font-size: 12px;"></i>
          </a>
          
          {{-- Tambahkan ID unik: "statDropdown" --}}
          <div id="statDropdown" class="dropdown-menu-custom">
              <a href="{{ url('/data-statistik') }}" class="dropdown-item-custom">
                  1. Data Sampah
              </a>
              <a href="{{ url('/rth-surabaya') }}" class="dropdown-item-custom">
                  2. Data Kualitas Lingkungan
              </a>
              <a href="{{ url('/data-statistik?tab=sarpras') }}" class="dropdown-item-custom">
                  3. Data?
              </a>
              <a href="{{ url('/data-statistik?tab=sdm') }}" class="dropdown-item-custom">
                  4. Data?
              </a>
              <a href="{{ url('/data-statistik?tab=ringkasan') }}" class="dropdown-item-custom">
                  5. Data?
              </a>
          </div>
      </div>

    </nav>

    {{-- TOMBOL LOGOUT --}}
    <a class="logout" href="login" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
      <i class="bi bi-box-arrow-right logout-icon"></i>
      Logout
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

  </div>
</header>

{{-- SCRIPT LOGIKA REVISI (Taruh di bawah header agar load terakhir) --}}
<script>
    let statTimer; // Variabel untuk menyimpan timer

    function toggleStatistik(event) {
        event.preventDefault(); // Mencegah link pindah halaman
        
        const dropdown = document.getElementById('statDropdown');
        
        // 1. Toggle Tampilan (Buka/Tutup)
        dropdown.classList.toggle('show');

        // Jika menu barusan dibuka:
        if (dropdown.classList.contains('show')) {
            
            // A. Reset timer lama jika ada (biar tidak bentrok kalau diklik cepat)
            if (statTimer) clearTimeout(statTimer);

            // B. Set Timer 10 Detik untuk menutup otomatis
            statTimer = setTimeout(() => {
                dropdown.classList.remove('show');
            }, 10000); // 10000 ms = 10 detik

            // C. Pasang Event Listener Scroll (Sekali pakai)
            // Jika user scroll, menu langsung tertutup
            const closeOnScroll = () => {
                dropdown.classList.remove('show');
                window.removeEventListener('scroll', closeOnScroll); // Hapus listener agar hemat memori
            };
            window.addEventListener('scroll', closeOnScroll);
            
            // D. Pasang Event Listener Klik di luar (Optional, UX bagus)
            const closeOnClickOutside = (e) => {
                if (!event.target.contains(e.target) && !dropdown.contains(e.target)) {
                    dropdown.classList.remove('show');
                    document.removeEventListener('click', closeOnClickOutside);
                }
            };
            // Delay sedikit agar klik saat ini tidak langsung menutup
            setTimeout(() => {
                document.addEventListener('click', closeOnClickOutside);
            }, 100);
        }
    }
</script>