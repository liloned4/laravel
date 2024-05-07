@extends('layouts/layoutMaster')

@section('title', 'Pengaduan List')

@section('vendor-style')
    @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss'])
@endsection

@section('vendor-script')
    @vite(['resources/assets/vendor/libs/moment/moment.js', 'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js'])
@endsection

@section('page-script')
    @vite('resources/assets/js/pengaduan-list.js')
@endsection

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Si-dandang /</span> Data Pengaduan
    </h4>

    <!-- Invoice List Widget -->

    <div class="card mb-4">
        <div class="card-widget-separator-wrapper">
            <div class="card-body card-widget-separator">
                <div class="row gy-4 gy-sm-1">
                    <div class="col-sm-6 col-lg-3">
                        <div class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-3 pb-sm-0">
                            <div>
                                <h3 class="mb-1">{{ $pendingCount }}</h3>
                                <p class="mb-0">Pending</p>
                            </div>
                            <span class="avatar me-sm-4">
                                <span class="avatar-initial bg-label-secondary rounded"><i
                                        class="ti ti-settings-exclamation ti-md"></i></span>
                            </span>
                        </div>
                        <hr class="d-none d-sm-block d-lg-none me-4">
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-3 pb-sm-0">
                            <div>
                                <h3 class="mb-1">{{ $prosesCount }}</h3>
                                <p class="mb-0">Proses</p>
                            </div>
                            <span class="avatar me-lg-4">
                                <span class="avatar-initial bg-label-secondary rounded"><i
                                        class="ti ti-progress ti-md"></i></span>
                            </span>
                        </div>
                        <hr class="d-none d-sm-block d-lg-none">
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="d-flex justify-content-between align-items-start border-end pb-3 pb-sm-0 card-widget-3">
                            <div>
                                <h3 class="mb-1">{{ $selesaiCount }}</h3>
                                <p class="mb-0">Selesai</p>
                            </div>
                            <span class="avatar me-sm-4">
                                <span class="avatar-initial bg-label-secondary rounded"><i
                                        class="ti ti-checks ti-md"></i></span>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="d-flex justify-content-between align-items-start border-end pb-3 pb-sm-0 card-widget-3">
                            <div>
                                <h3 class="mb-1">{{ $totalPengaduan }}</h3>
                                <p class="mb-0">Pengaduan {{ $namaBulanTerakhir }} </p>
                            </div>
                            <span class="avatar me-sm-4">
                                <span class="avatar-initial bg-label-secondary rounded"><i
                                        class="ti ti-user-plus ti-md"></i></span>
                            </span>
                        </div>
                    </div>
                    <!-- Sisanya di sini -->
                </div>

            </div>
        </div>
    </div>

    <!-- Invoice List Table -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="pengaduan-table table border-top">
                <thead>
                    <tr>
                        <th></th>
                        <th>Id</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Telepon Pelapor</th>
                        <th>Nama Barang</th>
                        <th>Keterangan Laporan</th>
                        <th>Tanggal Laporan</th>
                        <th>Status</th>
                        <th class="cell-fit">Actions</th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>
@endsection
