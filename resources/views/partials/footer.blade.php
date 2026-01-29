<footer class="sby-footer">
  <div class="sby-footer__inner">

    <div class="sby-footer__col">
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
      <ul class="sby-footer__list">
        <li>Jl. Jimerto No.25–27, Ketabang, Kec. Genteng, Kota Surabaya, Jawa Timur 60272</li>
        <li>(031) 5312144</li>
        <li>bappeda@surabaya.go.id</li>
      </ul>
    </div>

    <div class="sby-footer__col">
      <h4 class="sby-footer__title">Jam Operasional</h4>
      <ul class="sby-footer__list">
        <li>Senin - Kamis<br><strong>07.30 - 16.00 WIB</strong></li>
        <li>Jumat<br><strong>07.30 - 15.00 WIB</strong></li>
      </ul>
    </div>

    <div class="sby-footer__col">
      <h4 class="sby-footer__title">Tautan Cepat</h4>
      <ul class="sby-footer__list sby-footer__links">
        <li><a href="https://surabaya.go.id" target="_blank" rel="noopener">Website Resmi Kota Surabaya</a></li>
        <li><a href="https://bappeda.surabaya.go.id" target="_blank" rel="noopener">Portal BAPPEDA</a></li>
        <li><a href="{{ url('/kebijakan-privasi') }}">Kebijakan Privasi</a></li>
        <li><a href="{{ url('/syarat-ketentuan') }}">Syarat dan Ketentuan</a></li>
      </ul>
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
