@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Pengaduan ')

<!-- Vendor Styles -->
@section('vendor-style')
    @vite(['resources/assets/vendor/libs/select2/select2.scss', 'resources/assets/vendor/libs/nouislider/nouislider.scss', 'resources/assets/vendor/libs/swiper/swiper.scss', 'resources/assets/vendor/libs/animate-css/animate.scss'])
@endsection

<!-- Page Styles -->
@section('page-style')
    @vite(['resources/assets/vendor/scss/pages/front-page-landing.scss'])
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
    @vite(['resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/nouislider/nouislider.js', 'resources/assets/vendor/libs/swiper/swiper.js'])
@endsection


<!-- Page Scripts -->
@section('page-script')
    @vite(['resources/assets/js/forms-selects.js', 'resources/assets/js/main.js', 'resources/assets/js/costume.js'])
@endsection


@section('content')
    <div data-bs-spy="scroll" class="scrollspy-example">
        <!-- Hero: Start -->
        <section id="hero-animation">
            <div id="landingHero" class="section-py landing-hero position-relative">
                <img src="{{ asset('assets/img/front-pages/backgrounds/hero-bg.png') }}" alt="hero background"
                    class="position-absolute top-0 start-50 translate-middle-x object-fit-contain w-100 h-100"
                    data-speed="1" />
                <div class="container">
                    <div class="hero-text-box text-center">
                        <h1 class="text-primary hero-title display-6 fw-bold">SISTEM INFORMASI
                            PENGADUAN DAN GANGGUAN SIMRS
                        </h1>
                        {{-- <h2 class="hero-sub-title h6 mb-4 pb-1">
                            Production-ready & easy to use Admin Template<br class="d-none d-lg-block" />
                            for Reliability and Customizability.
                        </h2> --}}
                        <div class="landing-hero-btn d-inline-block position-relative">
                            <span class="hero-btn-item position-absolute d-none d-md-flex text-heading">Cek Disini
                                <img src="{{ asset('assets/img/front-pages/icons/Join-community-arrow.png') }}"
                                    alt="Join community arrow" class="scaleX-n1-rtl" /></span>

                            <!-- Vertically Centered Modal -->
                            <div class="col-lg-12 col-md-6">
                                <div class="mt-3">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#modalCenter">
                                        Detail Status
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalCenterTitle">Cek Status
                                                        Pengaduan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('check.status') }}" method="post">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col mb-3">
                                                                <label for="kode" class="form-label">Nomor
                                                                    Pengaduan</label>
                                                                <input type="text" id="kode" name="kode"
                                                                    class="form-control"
                                                                    placeholder="Masukan Nomor Pengaduan Anda ..">
                                                            </div>
                                                        </div>
                                                        <div class="row g-2">
                                                            <div class="col mb-0">
                                                                <label for="nitk" class="form-label">NITK /
                                                                    NIP</label>
                                                                <input type="text" id="nitk" name="nip"
                                                                    class="form-control" placeholder="Masukkan NITK / NIP">
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-label-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-success">Kirim</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="heroDashboardAnimation" class="hero-animation-img">
                        <a>
                            <div id="heroAnimationImg" class="position-relative hero-dashboard-img">
                                <img src="{{ asset('assets/img/front-pages/landing-page/0909-' . $configData['style'] . '.png') }}"
                                    alt="hero dashboard" class="animation-img"
                                    data-app-light-img="front-pages/landing-page/0909-light.png"
                                    data-app-dark-img="front-pages/landing-page/0909-dark.png" />
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="landing-hero-blank"></div>
        </section>
        <!-- Hero: End -->

        <!-- Contact Us: Start -->
        <section id="landingContact" class="section-py bg-body landing-contact">
            <div class="container">
                <h3 class="text-center mb-1">
                    <span class="position-relative fw-bold z-1">Sistem Informasi Pengaduan Dan Gangguan SIMRS
                        <img src="{{ asset('assets/img/front-pages/icons/section-title-icon.png') }}" alt="laptop charging"
                            class="section-title-img position-absolute object-fit-contain bottom-0 z-n1">
                    </span>
                </h3>
                <p class="text-center mb-4 mb-lg-5 pb-md-3">Jangan ambil pusing ! Sampaikan kepada kami.</p>
                <div class="row gy-4">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-4">Masukan Detail Pengaduan</h4>
                                {{-- <p class="mb-4">
                                    Jam Kerja Perbaikan <br>
                                </p> --}}
                                <script>
                                    // Tampilkan SweetAlert jika terdapat pesan sukses dalam URL
                                    const successMessage = '{{ session('success') }}';
                                    if (successMessage) {
                                        Swal.fire('Sukses!', successMessage, 'success');
                                    }

                                    // Tampilkan SweetAlert jika terdapat pesan error dalam URL
                                    const errorMessage = '{{ session('error') }}';
                                    if (errorMessage) {
                                        Swal.fire('Error!', errorMessage, 'error');
                                    }
                                </script>
                                <form method="POST" action="{{ route('aduan.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row g-3 ">
                                        <div class="col-md-4">
                                            <label class="form-label" for="kode">Nomor Pengaduan</label>
                                            <input type="text" class="form-control" id="kode" name="kode"
                                                value="{{ $nextKode }}" disabled>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="tanggal_laporan">Tanggal Laporan</label>
                                            <input type="datetime" class="form-control" id="auto_datestamp"
                                                name="tanggal_laporan" placeholder="01-xx-xxxx" required readonly />
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="foto">Foto Kerusakan</label>
                                            <input type="file" class="form-control" id="foto" name="foto"
                                                placeholder="Upload File Foto" />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="nip">NIP / NITK Pegawai</label>
                                            <select class="form-select select2" id="nip" name="nip">
                                                <option value="" selected disabled>Pilih NIP / NITK Pegawai</option>
                                                @foreach ($pegawai as $pegawai)
                                                    <option value="{{ $pegawai->nip }}" data-nama="{{ $pegawai->nama }}">
                                                        {{ $pegawai->nip }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="nama">Nama </label>
                                            <input type="text" class="form-control" id="nama" name="nama"
                                                required readonly />
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="telepon_pelapor">Nomor WhatsApp</label>
                                            <input type="text" id="telepon_pelapor" name="telepon_pelapor"
                                                class="form-control" required />
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="unit_pelapor">Instalasi / Unit Kerja</label>
                                            <input type="text" id="unit_pelapor" name="unit_pelapor"
                                                class="form-control" required />
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="jabatan_pelapor">Jabatan</label>
                                            <input type="text" id="jabatan_pelapor" name="jabatan_pelapor"
                                                class="form-control" required />
                                        </div>
                                        <div class="col-12">
                                            <div class="cad">
                                                <p class="crd-header mt-3">Pilih Jenis Brang </p>
                                                <div class="row row-bordered g-0">
                                                    <div class="col-sm-6 p-2">
                                                        <div class="text-light medium fw-medium mb-3">HARDWARE</div>
                                                        <div class="switches-stacked">
                                                            <label class="switch switch-success">
                                                                <input type="radio" class="switch-input"
                                                                    name="nama_barang" value="Printer" required />
                                                                <span class="switch-toggle-slider">
                                                                    <span class="switch-on"></span>
                                                                    <span class="switch-off"></span>
                                                                </span>
                                                                <span class="switch-label">Printer</span>
                                                            </label>
                                                            <label class="switch switch-success">
                                                                <input type="radio" class="switch-input"
                                                                    name="nama_barang" value="Komputer" required />
                                                                <span class="switch-toggle-slider">
                                                                    <span class="switch-on"></span>
                                                                    <span class="switch-off"></span>
                                                                </span>
                                                                <span class="switch-label">Komputer</span>
                                                            </label>

                                                            <label class="switch switch-success">
                                                                <input type="radio" class="switch-input"
                                                                    name="nama_barang" value="Mouse" required />
                                                                <span class="switch-toggle-slider">
                                                                    <span class="switch-on"></span>
                                                                    <span class="switch-off"></span>
                                                                </span>
                                                                <span class="switch-label">Mouse</span>
                                                            </label>

                                                            <label class="switch switch-success">
                                                                <input type="radio" class="switch-input"
                                                                    name="nama_barang" value="Keyboard" required />
                                                                <span class="switch-toggle-slider">
                                                                    <span class="switch-on"></span>
                                                                    <span class="switch-off"></span>
                                                                </span>
                                                                <span class="switch-label">Keyboard</span>
                                                            </label>

                                                            <label class="switch switch-success">
                                                                <input type="radio" class="switch-input"
                                                                    name="nama_barang" value="Jaringan" required />
                                                                <span class="switch-toggle-slider">
                                                                    <span class="switch-on"></span>
                                                                    <span class="switch-off"></span>
                                                                </span>
                                                                <span class="switch-label">Jaringan</span>
                                                            </label>

                                                            <label class="switch switch-success">
                                                                <input type="radio" class="switch-input"
                                                                    name="nama_barang" value="CCTV" required />
                                                                <span class="switch-toggle-slider">
                                                                    <span class="switch-on"></span>
                                                                    <span class="switch-off"></span>
                                                                </span>
                                                                <span class="switch-label">CCTV</span>
                                                            </label>

                                                            <label class="switch switch-success">
                                                                <input type="radio" class="switch-input"
                                                                    name="nama_barang" value="Portal" required />
                                                                <span class="switch-toggle-slider">
                                                                    <span class="switch-on"></span>
                                                                    <span class="switch-off"></span>
                                                                </span>
                                                                <span class="switch-label">Portal</span>
                                                            </label>

                                                            <label class="switch switch-success">
                                                                <input type="radio" class="switch-input"
                                                                    name="nama_barang" value="SmartTV" required />
                                                                <span class="switch-toggle-slider">
                                                                    <span class="switch-on"></span>
                                                                    <span class="switch-off"></span>
                                                                </span>
                                                                <span class="switch-label">Smart Tv</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 p-2">
                                                        <div class="text-light medium fw-medium mb-3">SOFTWARE</div>
                                                        <div class="switches-stacked">
                                                            <label class="switch switch-success">
                                                                <input type="radio" class="switch-input"
                                                                    name="nama_barang" value="SIMRS" required />
                                                                <span class="switch-toggle-slider">
                                                                    <span class="switch-on"></span>
                                                                    <span class="switch-off"></span>
                                                                </span>
                                                                <span class="switch-label">SIMRS</span>
                                                            </label>

                                                            <label class="switch switch-success">
                                                                <input type="radio" class="switch-input"
                                                                    name="nama_barang" value="Office" required />
                                                                <span class="switch-toggle-slider">
                                                                    <span class="switch-on"></span>
                                                                    <span class="switch-off"></span>
                                                                </span>
                                                                <span class="switch-label">Office</span>
                                                            </label>

                                                            <label class="switch switch-success">
                                                                <input type="radio" class="switch-input"
                                                                    name="nama_barang" value="SINARS" required />
                                                                <span class="switch-toggle-slider">
                                                                    <span class="switch-on"></span>
                                                                    <span class="switch-off"></span>
                                                                </span>
                                                                <span class="switch-label">SINARS</span>
                                                            </label>

                                                            <label class="switch switch-success">
                                                                <input type="radio" class="switch-input"
                                                                    name="nama_barang" value="Tempayan" required />
                                                                <span class="switch-toggle-slider">
                                                                    <span class="switch-on"></span>
                                                                    <span class="switch-off"></span>
                                                                </span>
                                                                <span class="switch-label">Tempayan</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label" for="keterangan_laporan">Keterangan Laporan</label>
                                            <textarea id="keterangan_laporan" name="keterangan_laporan" class="form-control" cols="10" rows="5"
                                                required></textarea>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-success">Kirim</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Contact Us: End -->
    </div>


@endsection
