@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'List Pengaduan ')

<!-- Vendor Styles -->
@section('vendor-style')
    @vite(['resources/assets/vendor/libs/nouislider/nouislider.scss', 'resources/assets/vendor/libs/swiper/swiper.scss', 'resources/assets/vendor/libs/animate-css/animate.scss'])
@endsection

<!-- Page Styles -->
@section('page-style')
    {{-- @vite(['resources/assets/vendor/scss/pages/front-page-status.scss']) --}}
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
    @vite(['resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/nouislider/nouislider.js', 'resources/assets/vendor/libs/swiper/swiper.js'])
@endsection

<!-- Page Scripts -->
@section('page-script')
    @vite(['resources/assets/js/forms-selects.js', 'resources/assets/js/main.js'])
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
                        <h1 class="text-primary hero-title display-6 fw-bold">List Pengaduan
                        </h1>
                    </div>
                </div>
            </div>
        </section>
        <!-- Hero: End -->

        <!-- Contact Us: Start -->
        <section id="landingContact" class="section-py bg-body landing-contact">
            <div class="container">
                <div class="card">
                    <div class="card-datatable table-responsive">
                        <table class="pengaduan-table table border-top">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Telepon Pelapor</th>
                                    <th>Nama Barang</th>
                                    <th>Keterangan Laporan</th>
                                    <th>Tanggal Laporan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $counter = 1 @endphp
                                @foreach ($pengaduan as $item)
                                    <tr>
                                        <td>{{ $counter++ }}</td>
                                        <td>{{ $item->kode }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->telepon_pelapor }}</td>
                                        <td>{{ $item->nama_barang }}</td>
                                        <td>{{ $item->keterangan_laporan }}</td>
                                        <td>{{ $item->tanggal_laporan }}</td>
                                        <td>{{ $item->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <!-- Contact Us: End -->
        <script>
            setInterval(function() {
                location.reload();
            }, 60000); // 60000 milliseconds = 1 minute
        </script>
    </div>
@endsection
