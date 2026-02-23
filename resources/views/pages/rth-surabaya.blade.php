<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Dashboard Lingkungan Hidup - SIDAPETA SBY</title>
  
  <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
  <link rel="stylesheet" href="{{ asset('css/rth.css') }}"> {{-- CSS Gabungan --}}
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.41.0/dist/apexcharts.min.css">
</head>
<body>

  @include('partials.header') 

  <main class="nature-section">
    <div class="container">

        {{-- HEADER --}}
        <div class="page-header-nature">
            <div>
                <h1>Dashboard Lingkungan Hidup</h1>
                <p>Integrasi Data RTH, Sarpras, Kualitas Air, dan Kualitas Udara Kota Surabaya.</p>
            </div>
            <i class="bi bi-tree-fill tree-deco"></i>
        </div>

        {{-- NAV TABS GLOBAL --}}
        <div class="nature-card p-0 overflow-hidden mb-5">
            <div class="p-3 border-bottom bg-white d-flex justify-content-center">
                <ul class="nav nav-pills nav-pills-nature" id="mainTab" role="tablist">
                    <li class="nav-item"><button class="nav-link active" id="ihbi-tab" data-bs-toggle="pill" data-bs-target="#content-ihbi" type="button"><i class="bi bi-bar-chart-steps me-2"></i>IHBI</button></li>
                    <li class="nav-item"><button class="nav-link" id="taman-tab" data-bs-toggle="pill" data-bs-target="#content-taman" type="button"><i class="bi bi-tree me-2"></i>Taman</button></li>
                    <li class="nav-item"><button class="nav-link" id="makam-tab" data-bs-toggle="pill" data-bs-target="#content-makam" type="button"><i class="bi bi-box2-heart me-2"></i>Makam</button></li>
                    <li class="nav-item"><button class="nav-link" id="krematorium-tab" data-bs-toggle="pill" data-bs-target="#content-krematorium" type="button"><i class="bi bi-fire me-2"></i>Krematorium</button></li>
                    <li class="nav-item"><button class="nav-link" id="sarpras-tab" data-bs-toggle="pill" data-bs-target="#content-sarpras" type="button"><i class="bi bi-tools me-2"></i>Sarpras</button></li>
                    <li class="nav-item"><button class="nav-link" id="air-tab" data-bs-toggle="pill" data-bs-target="#content-air" type="button"><i class="bi bi-droplet me-2"></i>Uji Air</button></li>
                    <li class="nav-item"><button class="nav-link" id="udara-tab" data-bs-toggle="pill" data-bs-target="#content-udara" type="button"><i class="bi bi-wind me-2"></i>Uji Udara</button></li>
                </ul>
            </div>

            <div class="tab-content p-4" id="mainTabContent">
                
                {{-- TAB 1: IHBI --}}
                <div class="tab-pane fade show active" id="content-ihbi">
                    <div class="row">
                        <div class="col-lg-8">
                            <h5 class="nature-card-title"><i class="bi bi-table text-success"></i> Rincian Luas Per Tipologi</h5>
                            <div class="table-responsive">
                                <table class="table table-nature table-bordered align-middle">
                                    <thead class="table-success text-center">
                                        <tr><th>Zona</th><th>Kode</th><th>Luas (Ha)</th><th>Bobot</th><th>FHBI</th><th>Skoring</th></tr>
                                    </thead>
                                    <tbody>
                                        <tr class="table-light fw-bold"><td colspan="6">TIPOLOGI A ({{ $persentase['A'] ?? 0 }}%)</td></tr>
                                        @foreach($rthA as $d)
                                        <tr><td>{{ $d->zona }}</td><td class="text-center">{{ $d->kode ?? '-' }}</td><td class="text-end">{{ number_format($d->luas, 0) }}</td><td class="text-center">{{ $d->bobot ? number_format($d->bobot,0).'%' : '-' }}</td><td class="text-center">{{ $d->fhbi ?? '-' }}</td><td class="text-end fw-bold">{{ $d->jumlah ? number_format($d->jumlah,0) : '-' }}</td></tr>
                                        @endforeach
                                        <tr class="table-light fw-bold"><td colspan="6">TIPOLOGI B ({{ $persentase['B'] ?? 0 }}%)</td></tr>
                                        @foreach($rthB as $d)
                                        <tr><td>{{ $d->zona }}</td><td class="text-center">{{ $d->kode }}</td><td class="text-end">{{ number_format($d->luas, 0) }}</td><td class="text-center">{{ number_format($d->bobot,0) }}%</td><td class="text-center">{{ $d->fhbi }}</td><td class="text-end fw-bold">{{ number_format($d->jumlah,0) }}</td></tr>
                                        @endforeach
                                        <tr class="table-light fw-bold"><td colspan="6">TIPOLOGI C ({{ $persentase['C'] ?? 0 }}%)</td></tr>
                                        @foreach($rthC as $d)
                                        <tr><td>{{ $d->zona }}</td><td class="text-center">{{ $d->kode }}</td><td class="text-end">{{ number_format($d->luas, 0) }}</td><td class="text-center">{{ number_format($d->bobot,0) }}%</td><td class="text-center">{{ $d->fhbi }}</td><td class="text-end fw-bold">{{ number_format($d->jumlah,0) }}</td></tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="border rounded p-3 mb-3 bg-light">
                                <h6 class="fw-bold text-center mb-3">Komposisi Tipologi RTH</h6>
                                <div id="chartPieIHBI"></div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TAB 2: TAMAN --}}
                <div class="tab-pane fade" id="content-taman">
                    <div class="row mb-4">
                        <div class="col-12">
                            <h5 class="nature-card-title"><i class="bi bi-flower3 text-success"></i> Rekapitulasi RTH Taman Per Wilayah</h5>
                            <div class="table-responsive">
                                <table class="table table-nature table-hover table-bordered text-center align-middle">
                                    <thead class="table-success">
                                        <tr><th rowspan="2">Wilayah</th><th colspan="2">Taman Pasif</th><th colspan="2">Taman Aktif</th><th colspan="2">Taman Kota</th><th colspan="2" class="bg-success text-white">TOTAL</th></tr>
                                        <tr><th>Jml</th><th>Luas (m²)</th><th>Jml</th><th>Luas (m²)</th><th>Jml</th><th>Luas (m²)</th><th class="bg-success text-white">Jml</th><th class="bg-success text-white">Luas (m²)</th></tr>
                                    </thead>
                                    <tbody>
                                        @foreach($dataTaman as $t)
                                        <tr><td class="fw-bold text-start">{{ $t->wilayah }}</td><td>{{ $t->jumlah_taman_pasif_jalur_hijau }}</td><td class="text-end">{{ number_format($t->luas_taman_pasif_jalur_hijau, 2) }}</td><td>{{ $t->jumlah_taman_aktif }}</td><td class="text-end">{{ number_format($t->luas_taman_aktif, 2) }}</td><td>{{ $t->jumlah_taman_kota }}</td><td class="text-end">{{ number_format($t->luas_taman_kota, 2) }}</td><td class="fw-bold bg-light">{{ $t->jumlah_per_wilayah }}</td><td class="fw-bold bg-light text-end">{{ number_format($t->luas_per_wilayah, 2) }}</td></tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot class="fw-bold bg-light">
                                        <tr><td>TOTAL</td><td>{{ $totalTaman['jml_pasif'] }}</td><td class="text-end">{{ number_format($totalTaman['luas_pasif'], 2) }}</td><td>{{ $totalTaman['jml_aktif'] }}</td><td class="text-end">{{ number_format($totalTaman['luas_aktif'], 2) }}</td><td>{{ $totalTaman['jml_kota'] }}</td><td class="text-end">{{ number_format($totalTaman['luas_kota'], 2) }}</td><td>{{ $totalTaman['jml_pasif']+$totalTaman['jml_aktif']+$totalTaman['jml_kota'] }}</td><td class="text-end text-success">{{ number_format($totalTaman['luas_total'], 2) }}</td></tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row"><div class="col-12"><div class="border rounded p-3"><h6 class="fw-bold text-center">Grafik Luas Taman Per Wilayah</h6><div id="chartBarTaman"></div></div></div></div>
                </div>

                {{-- TAB 3: MAKAM --}}
                <div class="tab-pane fade" id="content-makam">
                    <div class="row mb-4">
                        <div class="col-md-5 mb-4 mb-md-0">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-header bg-light fw-bold">Daftar Luas RTH Makam</div>
                                <div class="card-body p-0 table-responsive" style="max-height: 400px; overflow-y:auto;">
                                    <table class="table table-sm table-striped mb-0">
                                        <thead><tr><th>Nama Makam</th><th class="text-end">Luas (m²)</th></tr></thead>
                                        <tbody>
                                            @foreach($dataMakamLuas as $m)
                                            <tr><td>{{ $m->nama_makam }}</td><td class="text-end">{{ number_format($m->luas, 2) }}</td></tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot class="fw-bold table-group-divider"><tr><td>TOTAL</td><td class="text-end">{{ number_format($totalLuasMakam ?? 0, 2) }}</td></tr></tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-header bg-light fw-bold">Status Kapasitas Makam</div>
                                <div class="card-body p-0 table-responsive">
                                    <table class="table table-sm table-bordered align-middle mb-0 text-center">
                                        <thead class="table-secondary"><tr><th>Lokasi</th><th>Kapasitas</th><th>Terisi</th><th>Sisa</th><th>Status</th></tr></thead>
                                        <tbody>
                                            @foreach($dataKapasitas as $k)
                                            <tr><td class="text-start fw-bold">{{ $k->nama_lokasi }}</td><td>{{ $k->kapasitas_makam }}</td><td>{{ number_format($k->jumlah_data_kematian, 0) }}</td><td class="fw-bold {{ ($k->sisa_petak ?? 0) < 1000 ? 'text-danger' : 'text-success' }}">{{ $k->sisa_petak !== null ? number_format($k->sisa_petak, 0) : '-' }}</td><td>@if(str_contains(strtolower($k->keterangan), 'penuh')) <span class="badge bg-danger">Penuh</span> @elseif(str_contains(strtolower($k->keterangan), 'tersedia')) <span class="badge bg-success">Tersedia</span> @else <span class="badge bg-secondary">{{ $k->keterangan }}</span> @endif</td></tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TAB 4: KREMATORIUM --}}
                <div class="tab-pane fade" id="content-krematorium">
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <div class="nature-card h-100 mb-0">
                                <div class="nature-card-title"><i class="bi bi-fire text-danger"></i> Kondisi Kompor Kremasi</div>
                                <div class="table-responsive">
                                    <table class="table table-nature mb-0">
                                        <thead><tr><th>Kondisi</th><th>Jumlah Unit</th><th>Keterangan</th></tr></thead>
                                        <tbody>
                                            @foreach($krematoriumKompor as $kom)
                                            <tr><td>@if($kom->kondisi == 'Bisa Digunakan') <span class="badge-status-baik">Normal</span> @else <span class="badge-status-rusak">Rusak</span> @endif</td><td class="fw-bold">{{ $kom->jumlah }}</td><td class="text-muted small">{{ $kom->keterangan }}</td></tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="nature-card h-100 mb-0">
                                <div class="nature-card-title"><i class="bi bi-person-badge text-primary"></i> Struktur Jabatan</div>
                                <div class="table-responsive">
                                    <table class="table table-nature mb-0">
                                        <thead><tr><th>Jabatan</th><th>Jumlah Personil</th><th>Tugas</th></tr></thead>
                                        <tbody>
                                            @foreach($krematoriumJabatan as $jab)
                                            <tr><td class="fw-bold">{{ $jab->jabatan }}</td><td class="text-center">{{ $jab->jumlah_orang }}</td><td class="text-muted">{{ $jab->keterangan }}</td></tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="nature-card p-0">
                                <div class="p-3 border-bottom d-flex justify-content-between align-items-center"><div class="fw-bold fs-5 text-dark"><i class="bi bi-people-fill text-success me-2"></i>Daftar Pegawai</div><span class="badge bg-success rounded-pill">{{ $totalPegawaiKrematorium }} Pegawai</span></div>
                                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                                    <table class="table table-nature table-striped mb-0">
                                        <thead class="sticky-top bg-white"><tr><th width="50">No</th><th>Nama Pegawai</th><th>L/P</th><th>Status</th><th>Lokasi Kerja</th></tr></thead>
                                        <tbody>
                                            @foreach($krematoriumPegawai as $peg)
                                            <tr><td class="text-center text-muted">{{ $peg->no }}</td><td class="fw-bold">{{ $peg->nama_pegawai }}</td><td>{{ $peg->jenis_kelamin == 'Laki-laki' ? 'L' : 'P' }}</td><td><span class="badge bg-light text-dark border">{{ $peg->status }}</span></td><td>{{ $peg->lokasi_kerja }}</td></tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TAB 5: SARPRAS & CSR --}}
                <div class="tab-pane fade" id="content-sarpras">
                    <div class="row mb-5">
                        <div class="col-lg-6 mb-4 mb-lg-0">
                            <div class="nature-card h-100 mb-0">
                                <div class="nature-card-title"><i class="bi bi-truck-flatbed text-success"></i> Kendaraan Operasional</div>
                                <div class="table-responsive">
                                    <table class="table table-nature mb-0" style="font-size: 0.85rem;">
                                        <thead><tr><th>Jenis</th><th>BBM</th><th>Unit</th><th>Rusak</th><th>Ops</th></tr></thead>
                                        <tbody>
                                            @foreach($bbmKendaraan as $k)
                                            <tr><td class="fw-bold">{{ $k->tipe_kendaraan }}</td><td><span class="badge-fuel-{{ $k->jenis_bbm == 'Pertamax' ? 'blue' : 'orange' }}">{{ $k->jenis_bbm }}</span></td><td>{{ $k->jumlah_total }}</td><td class="text-danger">{{ $k->jumlah_rusak }}</td><td class="text-success fw-bold">{{ $k->jumlah_beroperasi }}</td></tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="nature-card h-100 mb-0">
                                <div class="nature-card-title"><i class="bi bi-tools text-success"></i> Peralatan Operasional</div>
                                <div class="table-responsive">
                                    <table class="table table-nature mb-0" style="font-size: 0.85rem;">
                                        <thead><tr><th>Jenis</th><th>BBM</th><th>Unit</th><th>Rusak</th><th>Ops</th></tr></thead>
                                        <tbody>
                                            @foreach($bbmPeralatan as $p)
                                            <tr><td class="fw-bold">{{ $p->tipe_peralatan }}</td><td><span class="badge-fuel-{{ $p->jenis_bbm == 'Pertamax' ? 'blue' : 'orange' }}">{{ $p->jenis_bbm }}</span></td><td>{{ $p->jumlah_total }}</td><td class="text-danger">{{ $p->jumlah_rusak }}</td><td class="text-success fw-bold">{{ $p->jumlah_beroperasi }}</td></tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="nature-card p-0">
                                <div class="nature-card-title p-4 mb-0 border-bottom"><i class="bi bi-buildings-fill text-primary"></i> Daftar RTH Skema CSR (2024-2025)</div>
                                <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                                    <table class="table table-nature table-striped mb-0">
                                        <thead class="sticky-top bg-white"><tr><th>Tahun/Bulan</th><th>Lokasi RTH</th><th>Penanggung Jawab (Sponsor)</th></tr></thead>
                                        <tbody>
                                            @foreach($dataCSR as $csr)
                                            <tr><td><span class="badge bg-light text-dark border">{{ $csr->bulan }} {{ $csr->tahun }}</span></td><td class="fw-bold">{{ $csr->lokasi }}</td><td>{{ $csr->penanggung_jawab }}</td></tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TAB 6: UJI AIR (BARU) --}}
                <div class="tab-pane fade" id="content-air">
                    {{-- TABEL 1: UJI AIR BADAN AIR --}}
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="water-card">
                                <div class="water-card-header">
                                    <h2 class="water-title"><div class="icon-box"><i class="bi bi-water"></i></div> Uji Air Badan Air (Sungai & Saluran)</h2>
                                    <span class="badge bg-primary rounded-pill">{{ count($badanAir) }} Titik</span>
                                </div>
                                <div class="table-responsive" style="max-height: 500px; overflow-y:auto;">
                                    <table class="table table-water table-hover align-middle mb-0">
                                        <thead class="sticky-top bg-white"><tr><th class="text-center" width="50">No</th><th>Nama Sungai / Lokasi</th><th>Titik Koordinat</th></tr></thead>
                                        <tbody>
                                            @forelse($badanAir as $index => $item)
                                            <tr><td class="text-center fw-bold">{{ $index + 1 }}</td><td class="fw-bold text-dark">{{ $item->nama_sungai }}</td><td>@if($item->koordinat)<span class="badge-coord"><i class="bi bi-geo-alt me-1"></i>{{ $item->koordinat }}</span>@else<span class="text-muted small">-</span>@endif</td></tr>
                                            @empty <tr><td colspan="4" class="text-center py-4 text-muted">Data tidak tersedia</td></tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- TABEL 2, 3, 4: Pelabuhan, Wisata, Biota --}}
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="water-card h-100">
                                <div class="water-card-header"><h2 class="water-title"><div class="icon-box"><i class="bi bi-box-seam"></i></div> Kawasan Pelabuhan</h2></div>
                                <div class="table-responsive"><table class="table table-water table-sm mb-0"><thead><tr><th>Lokasi</th><th>Koordinat</th></tr></thead><tbody>@foreach($pelabuhan as $item)<tr><td class="fw-bold">{{ $item->nama_lokasi }}</td><td><span class="badge-coord">{{ $item->koordinat }}</span></td></tr>@endforeach</tbody></table></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="water-card mb-4">
                                <div class="water-card-header"><h2 class="water-title"><div class="icon-box"><i class="bi bi-umbrella"></i></div> Kawasan Wisata Bahari</h2></div>
                                <div class="table-responsive"><table class="table table-water table-sm mb-0"><thead><tr><th>Lokasi</th><th>Koordinat</th></tr></thead><tbody>@foreach($wisata as $item)<tr><td class="fw-bold">{{ $item->nama_lokasi }}</td><td><span class="badge-coord">{{ $item->koordinat }}</span></td></tr>@endforeach</tbody></table></div>
                            </div>
                            <div class="water-card mb-0">
                                <div class="water-card-header"><h2 class="water-title"><div class="icon-box"><i class="bi bi-fish"></i></div> Kawasan Biota Laut</h2></div>
                                <div class="table-responsive"><table class="table table-water table-sm mb-0"><thead><tr><th>Lokasi</th><th>Koordinat</th></tr></thead><tbody>@foreach($biota as $item)<tr><td class="fw-bold">{{ $item->nama_lokasi }}</td><td><span class="badge-coord">{{ $item->koordinat }}</span></td></tr>@endforeach</tbody></table></div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TAB 7: UJI UDARA (BARU) --}}
                <div class="tab-pane fade" id="content-udara">
                    <div class="row g-4 mb-4">
                        <div class="col-md-4"><div class="sky-card-stat"><div class="stat-icon theme-blue"><i class="bi bi-geo-alt-fill"></i></div><div class="stat-info"><h3>{{ $totalAmbien }}</h3><p>Titik Uji Ambien</p></div></div></div>
                        <div class="col-md-4"><div class="sky-card-stat"><div class="stat-icon theme-green"><i class="bi bi-wind"></i></div><div class="stat-info"><h3>{{ $totalPassive }}</h3><p>Titik Passive Sampler</p></div></div></div>
                        <div class="col-md-4"><div class="sky-card-stat"><div class="stat-icon theme-purple"><i class="bi bi-broadcast"></i></div><div class="stat-info"><h3>{{ $totalAlat }}</h3><p>Stasiun Pantau</p></div></div></div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-lg-7">
                            <div class="sky-card h-100">
                                <div class="sky-card-title"><i class="bi bi-pie-chart-fill text-primary"></i> Sebaran Titik Uji Ambien</div>
                                <div id="chartAmbien"></div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="sky-card h-100">
                                <div class="sky-card-title"><i class="bi bi-hdd-network-fill text-primary"></i> Stasiun Pemantauan</div>
                                <h6 class="fw-bold text-secondary mb-2 px-4"><i class="bi bi-wifi me-2"></i>SPKUA (Online)</h6>
                                <div class="list-group mb-4 px-4">@foreach($spkua as $s)<div class="list-group-item d-flex justify-content-between align-items-center border-0 bg-light rounded mb-2"><span class="fw-bold text-dark">{{ $s->nama_spkua }}</span><span class="badge bg-success">Aktif</span></div>@endforeach</div>
                                <h6 class="fw-bold text-secondary mb-2 px-4"><i class="bi bi-moisture me-2"></i>Sumur Pantau</h6>
                                <div class="list-group px-4">@foreach($sumur as $sum)<div class="list-group-item d-flex justify-content-between align-items-center border-0 bg-light rounded mb-2"><span class="fw-bold text-dark">{{ $sum->nama_sumur }}</span><span class="badge bg-primary">Monitoring</span></div>@endforeach</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="sky-card">
                                <div class="sky-card-title d-flex justify-content-between"><span><i class="bi bi-table text-primary me-2"></i>Detail Lokasi Uji Ambien</span><span class="badge bg-info text-white">{{ $totalAmbien }} Lokasi</span></div>
                                <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                                    <table class="table table-sky table-hover align-middle">
                                        <thead style="position: sticky; top: 0; z-index: 10;"><tr><th width="50" class="text-center">No</th><th>Nama Lokasi</th><th>Kategori Kawasan</th></tr></thead>
                                        <tbody>
                                            @foreach($ambien as $index => $a)
                                            <tr><td class="text-center fw-bold text-secondary">{{ $index + 1 }}</td><td class="fw-bold text-dark">{{ $a->lokasi }}</td><td><span class="badge-category"><i class="bi bi-tag-fill me-1 opacity-50"></i>{{ $a->peruntukan_kawasan ?? 'Umum' }}</span></td></tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
  </main>

  @include('partials.footer')

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.41.0/dist/apexcharts.min.js"></script>

  <script>
    (function() {
      var hasData = function(arr) { return arr && arr.length && arr.some(function(x) { return (x || 0) > 0; }); };
      var el = function(id) { return document.querySelector(id); };

      if (el("#chartPieIHBI")) {
        var seriesIHBI = @json($chartPieIHBI['series'] ?? [0,0,0]);
        if (hasData(seriesIHBI)) {
          new ApexCharts(el("#chartPieIHBI"), { series: seriesIHBI, chart: { type: 'donut', height: 300, fontFamily: 'Inter, sans-serif' }, labels: @json($chartPieIHBI['labels'] ?? []), colors: ['#10b981', '#f59e0b', '#3b82f6'], plotOptions: { pie: { donut: { size: '60%' } } }, dataLabels: { enabled: false }, legend: { position: 'bottom' }, tooltip: { y: { formatter: function(val) { return val + " Ha"; } } } }).render();
        } else {
          el("#chartPieIHBI").innerHTML = '<div class="text-center text-muted py-5">Belum ada data IHBI.<br><small>Jalankan seeder: LuasanRthSeeder</small></div>';
        }
      }
      if (el("#chartBarTaman")) {
        var dataTaman = @json($chartBarTaman['data'] ?? []);
        if (dataTaman.length && dataTaman.some(function(x) { return (x || 0) > 0; })) {
          new ApexCharts(el("#chartBarTaman"), { series: [{ name: 'Luas Taman (m²)', data: dataTaman }], chart: { type: 'bar', height: 350, toolbar: { show: false }, fontFamily: 'Inter, sans-serif' }, colors: ['#059669'], xaxis: { categories: @json($chartBarTaman['labels'] ?? []) }, plotOptions: { bar: { borderRadius: 4, columnWidth: '50%' } }, dataLabels: { enabled: false }, tooltip: { y: { formatter: function(val) { return (val || 0).toLocaleString() + " m²"; } } } }).render();
        } else {
          el("#chartBarTaman").innerHTML = '<div class="text-center text-muted py-5">Belum ada data taman.<br><small>Jalankan seeder: CompleteDataSeeder atau RekapitulasiRthTaman</small></div>';
        }
      }
      if (el("#chartAmbien")) {
        var seriesAmbien = @json($chartAmbien['series'] ?? [0]);
        if (seriesAmbien.length && seriesAmbien.some(function(x) { return (x || 0) > 0; })) {
          new ApexCharts(el("#chartAmbien"), { series: seriesAmbien, chart: { type: 'donut', height: 350, fontFamily: 'system-ui' }, labels: @json($chartAmbien['labels'] ?? []), colors: ['#0ea5e9', '#22c55e', '#f59e0b', '#8b5cf6', '#ef4444', '#64748b', '#ec4899'], plotOptions: { pie: { donut: { size: '65%' } } }, dataLabels: { enabled: false }, legend: { position: 'bottom' }, tooltip: { y: { formatter: function(val) { return val + " Titik"; } } } }).render();
        } else {
          el("#chartAmbien").innerHTML = '<div class="text-center text-muted py-5">Belum ada data uji udara ambien.</div>';
        }
      }
    })();
  </script>

</body>
</html>