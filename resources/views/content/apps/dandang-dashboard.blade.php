@extends('layouts/layoutMaster')

@section('title', 'Dashboard')

@section('vendor-style')
    @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss', 'resources/assets/vendor/libs/apex-charts/apex-charts.scss'])
@endsection

@section('vendor-script')
    @vite(['resources/assets/vendor/libs/moment/moment.js', 'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js', 'resources/assets/vendor/libs/apex-charts/apexcharts.js'])
@endsection

@section('page-script')
    @vite('resources/assets/js/app-academy-dashboard.js')
@endsection

@section('content')
    <!-- Hour chart  -->
    <div class="card bg-transparent shadow-none my-4 border-0">
        <div class="card-body row p-0 pb-3">
            <div class="col-12 col-md-8 card-separator">
                <h3>Welcome back, {{ config('variables.dandangName') }} 👋🏻 </h3>
                <div class="col-12 col-lg-7">
                    <p>Selamat Datang di Sistem Informasi Pengaduan Dan Gangguan SIMRS ( si - dandang ), pantau segala
                        pengaduan
                        disini !</p>
                </div>
                <div class="d-flex justify-content-between flex-wrap gap-3 me-5">
                    <div class="d-flex align-items-center gap-3 me-4 me-sm-0">
                        <span class="bg-label-success p-2 rounded">
                            <i class='ti ti-circle-check ti-xl'></i>
                        </span>
                        <div class="content-right">
                            <p class="mb-0">Selesai</p>
                            <h4 class="text-dark mb-0">{{ $selesaiCount }}</h4>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <span class="bg-label-info p-2 rounded">
                            <i class='ti ti-progress ti-xl'></i>
                        </span>
                        <div class="content-right">
                            <p class="mb-0">Diproses</p>
                            <h4 class="text-dark mb-0">{{ $prosesCount }}</h4>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <span class="bg-label-warning p-2 rounded">
                            <i class='ti ti-help-octagon ti-xl'></i>
                        </span>
                        <div class="content-right">
                            <p class="mb-0">Pending</p>
                            <h4 class="text-dark mb-0">{{ $pendingCount }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 ps-md-3 ps-lg-4 pt-3 pt-md-0">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="d-flex align-items-center gap-3">
                            <span class="bg-label-danger p-2 rounded">
                                <i class='ti ti-clock-hour-7 ti-xl'></i>
                            </span>
                            <div class="content- mb-2 mt-3">
                                <h5 class="mb-0">IT | SIMRS</h5>
                                <p class="text-dark mb-0" id="currentTime"></p>
                            </div>
                        </div>
                        {{-- <div>
                            <h5 class="mb-2 mt-4">IT | SIMRS</h5>
                            <p class="mb-5"id="currentTime"></p>
                        </div> --}}
                        <div class="time-spending-chart">
                            <h3 class="mb-2 mt-3" id="currentDate">
                            </h3>
                            <span class="badge bg-label-success"></span>
                        </div>
                    </div>
                    {{-- <div id="leadsReportChart"></div> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- Hour chart End  -->

    <!-- Topic and Instructors -->
    <div class="row mb-4 g-4">
        <div class="col-12 col-xl-8">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title m-0 me-2">Jumlah Pengaduan Setiap Harinya</h5>
                    <div class="dropdown">
                        <button class="btn p-0" type="button" id="topic" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="ti ti-dots-vertical"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="topic">
                            <a class="dropdown-item" href="javascript:void(0);">Highest Views</a>
                            <a class="dropdown-item" href="javascript:void(0);">See All</a>
                        </div>
                    </div>
                </div>
                <div class="card-body row g-3">
                    <div class="col-md-12">
                        <div id="lineChart"></div>
                        {{-- <div id="lineAreaChart"></div> --}}

                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-4 col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <div class="bg-label-primary rounded-3 text-center mb-3 pt-4">
                        <img class="img-fluid" src="{{ asset('assets/img/illustrations/girl-with-laptop.png') }}"
                            alt="Card girl image" width="140" />
                    </div>
                    <h4 class="mb-2 pb-1">Si-Dandang 24 Jam standbye

                    </h4>
                    <p class="small">Memastikan semua yang alat alat yang bersangkutan pada bidang IT berjalan dengan
                        sepestinya.</p>
                    <div class="row mb-3 g-3">
                        <div class="col-6">
                            <div class="d-flex">
                                <div class="avatar flex-shrink-0 me-2">
                                    {{-- <span class="avatar-initial rounded bg-label-primary"><i
                                            class="ti ti-calendar-event ti-md"></i></span> --}}
                                </div>
                                <div>
                                    {{-- <h6 class="mb-0 text-nowrap" id="currentDate"></h6>
                                    <small>Tanggal</small> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex">
                                <div class="avatar flex-shrink-0 me-2">
                                    {{-- <span class="avatar-initial rounded bg-label-primary"><i
                                            class="ti ti-clock ti-md"></i></span> --}}
                                </div>
                                <div>
                                    {{-- <h6 class="mb-0 text-nowrap" id="currentTime"></h6>
                                    <small>Jam</small> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="" class="btn btn-primary w-100">SI - DANDANG</a>
                </div>
            </div>
        </div>
    </div>





@endsection
