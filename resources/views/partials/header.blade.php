<header class="topbar">
    <div class="navwrap">

        {{-- LOGO BRAND --}}
        <div class="brand">
            <a href="#" class="brand-logo">
                <img src="{{ asset('images/logo-2.png') }}" alt="Logo" onerror="this.style.display='none'">
            </a>
            <span class="brand-text1">SIGAP</span>
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
                <a class="navlink {{ request()->is('data-statistik*') ? 'active' : '' }}" href="#"
                    onclick="toggleStatistik(event)">
                    <i class="bi bi-bar-chart"></i>
                    Data Statistik
                    <i class="bi bi-chevron-down ms-1" style="font-size: 12px;"></i>
                </a>

                {{-- Tambahkan ID unik: "statDropdown" --}}
                <div id="statDropdown" class="dropdown-menu-custom">
                    <a href="{{ route('data-sampah.index') }}" class="dropdown-item-custom">
                        <i class="bi bi-trash3" style="margin-right:6px;color:#059669"></i> 1. Data Sampah
                    </a>
                    {{-- <a href="{{ route('kualitas-lingkungan.index') }}" class="dropdown-item-custom">
                        <i class="bi bi-droplet-half" style="margin-right:6px;color:#2563eb"></i> 2. Data Kualitas
                        Lingkungan
                    </a> --}}
                    {{-- <a href="{{ route('sarpras.index') }}" class="dropdown-item-custom">
                        <i class="bi bi-tools" style="margin-right:6px;color:#d97706"></i> 3. Data Sarpras
                    </a> --}}
                    {{-- <a href="{{ route('rth.index') }}" class="dropdown-item-custom">
                        <i class="bi bi-tree" style="margin-right:6px;color:#16a34a"></i> 4. Data RTH
                    </a> --}}
                    {{-- <a href="{{ route('ringkasan') }}" class="dropdown-item-custom">
                        <i class="bi bi-bar-chart" style="margin-right:6px;color:#7c3aed"></i> 5. Ringkasan
                    </a> --}}
                </div>
            </div>

        </nav>

        {{-- TOMBOL LOGOUT --}}
        <a class="logout" href="login"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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

    // ─── EFEK TRANSISI PINDAH HALAMAN ───
    document.addEventListener("DOMContentLoaded", function () {
        // Buat elemen overlay untuk efek fade out / fade in
        const overlay = document.createElement('div');
        overlay.id = 'page-transition-overlay';
        Object.assign(overlay.style, {
            position: 'fixed', top: '0', left: '0', width: '100vw', height: '100vh',
            backgroundColor: '#f8fafc', zIndex: '99999', pointerEvents: 'none',
            opacity: '1', transition: 'opacity 0.4s cubic-bezier(0.4, 0, 0.2, 1)',
            display: 'flex', flexDirection: 'column', alignItems: 'center', justifyContent: 'center'
        });

        // Tambahkan spinner dan teks loading ke dalam overlay
        overlay.innerHTML = `
            <div style="width:44px;height:44px;border:4px solid #cbd5e1;border-top-color:#3b82f6;border-radius:50%;animation:spinTransition 0.8s linear infinite;"></div>
            <div style="margin-top:16px;color:#64748b;font-weight:600;font-size:15px;letter-spacing:1px;text-transform:uppercase;">Loading...</div>
            <style>@keyframes spinTransition { to { transform: rotate(360deg); } }</style>
        `;

        document.body.appendChild(overlay);

        // Fade in saat halaman pertama kali diload
        setTimeout(() => {
            overlay.style.opacity = '0';
        }, 50);

        // Tangkap klik link untuk efek fade out
        document.querySelectorAll('a[href]').forEach(link => {
            link.addEventListener('click', function (e) {
                // Jangan tangkap jika link: punya onclick, mengarah ke target blank, anchor link (#), atau ditekan pakai ctrl/cmd
                if (this.target === '_blank' || this.href.includes('#') || this.getAttribute('onclick') || e.ctrlKey || e.metaKey) {
                    return;
                }

                // Pastikan link mengarah ke domain yang sama (internal link)
                if (this.hostname === window.location.hostname) {
                    e.preventDefault();
                    const targetUrl = this.href;

                    // Fade out
                    overlay.style.opacity = '1';

                    // Pindah halaman setelah animasi selesai
                    setTimeout(() => {
                        window.location.href = targetUrl;
                    }, 400);
                }
            });
        });
    });
</script>