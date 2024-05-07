@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Status')

<!-- Page Styles -->
@section('page-style')
    @vite(['resources/assets/vendor/scss/pages/front-page-pricing.scss'])
@endsection

<!-- Page Scripts -->
@section('page-script')
    @vite(['resources/assets/js/front-page-pricing.js'])
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
                        <h1 class="text-primary hero-title display-6 fw-bold">Status Laporan
                        </h1>
                    </div>
                </div>
            </div>
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
                                <h4 class="mb-4">Detail Pengaduan</h4>
                                <div class="row g-3 ">
                                    <div class="col-md-4">
                                        <label class="form-label" for="kode">Nomor Pengaduan</label>
                                        <input type="text" class="form-control" Readonly value="{{ $pengaduan->kode }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Tanggal Laporan</label>
                                        <input type="text" class="form-control" Readonly
                                            value="{{ $pengaduan->tanggal_laporan }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Status</label>
                                        <input type="text" class="form-control" Readonly
                                            value="{{ $pengaduan->status }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label" for="nip">NIP / NITK Pegawai</label>
                                        <input type="text" class="form-control" Readonly value="{{ $pengaduan->nip }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="nama">Nama</label>
                                        <input type="text" class="form-control" Readonly value="{{ $pengaduan->nama }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="telepon_pelapor">Nomor WhatsApp</label>
                                        <input type="text" class="form-control" Readonly
                                            value="{{ $pengaduan->telepon_pelapor }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="nama_barang">Jenis Barang</label>
                                        <input type="text" class="form-control" Readonly
                                            value="{{ $pengaduan->nama_barang }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="unit_pelapor">Instalasi / Unit Kerja</label>
                                        <input type="text" class="form-control" Readonly
                                            value="{{ $pengaduan->unit_pelapor }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="jabatan_pelapor">Jabatan</label>
                                        <input type="text" class="form-control" Readonly
                                            value="{{ $pengaduan->jabatan_pelapor }}">
                                    </div>
                                    <div class="col-md-8">
                                        <label class="form-label" for="keterangan_laporan">Keterangan Laporan</label>
                                        <textarea class="form-control" cols="10" rows="5" Readonly>{{ $pengaduan->keterangan_laporan }}</textarea>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="foto">Foto Kerusakan</label><br>
                                        <img src="{{ asset('uploads/' . $pengaduan->foto) }}" alt="Foto Kerusakan" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Contact Us: End -->
    </div>


@endsection
