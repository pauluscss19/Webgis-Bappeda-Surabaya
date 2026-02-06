<footer class="sby-footer">
  <div class="sby-footer__inner">

    {{-- TOP: brand (kiri) + kontak (kanan) --}}
    <div class="sby-footer__grid-top">

      <div class="sby-footer__col sby-footer__brandcol">
        <div class="sby-footer__brand">
          <a class="sby-footer__logo" href="https://link-logo-kamu" target="_blank" rel="noopener">
            <img src="{{ asset('images/logo-2.png') }}" alt="Logo Bappeda">
          </a>

          <div>
            <div class="sby-footer__brand-title">BAPPEDA</div>
            <div class="sby-footer__brand-sub">Kota Surabaya</div>
          </div>
        </div>

        <p class="sby-footer__text">
          Badan Perencanaan Pembangunan Daerah Kota Surabaya berperan dalam menyusun dan mengkoordinasikan
          perencanaan pembangunan daerah.
        </p>
      </div>

      <div class="sby-footer__col">
        <h4 class="sby-footer__title">Kontak</h4>

        <ul class="sby-footer__list sby-footer__list--icon">
          <li>
            <i class="bi bi-geo-alt" aria-hidden="true"></i>
            <span>Jl. Pacar No. 8, Ketabang, Kec. Genteng, Kota Surabaya, Jawa Timur 60272</span>
          </li>
          <li>
            <i class="bi bi-telephone" aria-hidden="true"></i>
            <span>(031) 5312144</span>
          </li>
          <li>
            <i class="bi bi-envelope" aria-hidden="true"></i>
            <span>bappeda@surabaya.go.id</span>
          </li>
        </ul>
      </div>

    </div>

    {{-- BOTTOM: jam (kiri) + tautan (kanan) --}}
    <div class="sby-footer__grid-bottom">

      <div class="sby-footer__col">
        <h4 class="sby-footer__title">Jam Operasional</h4>

        <ul class="sby-footer__list sby-footer__list--icon">
          <li>
            <i class="bi bi-clock" aria-hidden="true"></i>
            <span><strong>Senin - Kamis</strong><br>07.30 - 16.00</span>
          </li>
          <li>
            <i class="bi bi-clock" aria-hidden="true"></i>
            <span><strong>Jumat</strong><br>07.30 - 15.00</span>
          </li>
        </ul>
      </div>

      <div class="sby-footer__col">
        <h4 class="sby-footer__title">Tautan Cepat</h4>

        <ul class="sby-footer__list sby-footer__links">
          <li><a href="https://surabaya.go.id" target="_blank" rel="noopener">Portal Website Resmi Kota Surabaya</a></li>
          <li><a href="https://bappeda.surabaya.go.id" target="_blank" rel="noopener">Portal Bappeda Surabaya</a></li>
          <li><a href="https://www.bappenas.go.id/id">Portal Bappenas</a></li>
          <li><a href="https://bappeda.jatimprov.go.id/">Portal Bappeda Jatim</a></li>
        </ul>
      </div>

    </div>
  </div>

  <div class="sby-footer__bottom">
    <div class="sby-footer__bottom-inner">
      <div class="sby-footer__copy">
        © {{ date('Y') }} Badan Perencanaan Pembangunan Daerah Kota Surabaya. Hak Cipta Dilindungi.
      </div>
      <div class="sby-footer__tagline">
        Sistem Informasi Perencanaan Pembangunan
      </div>
    </div>
  </div>
</footer>
