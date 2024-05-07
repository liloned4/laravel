@extends('layouts/layoutMaster')

@section('title', 'Edit Pengaduan')

@section('vendor-style')
    @vite('resources/assets/vendor/libs/flatpickr/flatpickr.scss')
@endsection

@section('page-style')
    @vite('resources/assets/vendor/scss/pages/app-invoice.scss')
@endsection

@section('vendor-script')
    @vite(['resources/assets/vendor/libs/moment/moment.js', 'resources/assets/vendor/libs/flatpickr/flatpickr.js', 'resources/assets/vendor/libs/cleavejs/cleave.js', 'resources/assets/vendor/libs/cleavejs/cleave-phone.js'])
@endsection

@section('page-script')
    {{-- @vite(['resources/assets/js/offcanvas-add-payment.js', 'resources/assets/js/offcanvas-send-invoice.js']) --}}
@endsection


<?php
$status = strtolower($pengaduan->status);
?>

@section('content')

    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Si-dandang /</span> Edit Pengaduan
    </h4>
    <div class="row invoice-preview">
        <!-- Invoice -->
        <div class="col-xl-9 col-md-8 col-12 mb-md-0 mb-4">
            <div class="card invoice-preview-card">
                <div class="card-body">
                    <div
                        class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column m-sm-3 m-0">
                        <div class="mb-xl-0 mb-2">
                            <div class="d-flex svg-illustration mb-4 gap-2 align-items-center">
                                <div class="app-brand-logo demo" style="width: 60px; height: 60px;"> <img
                                        src="{{ asset('assets/img/si-dandang/datu.png') }}"
                                        style="width: 100%; height: 100%;" alt="Logo"></div>
                                <span class="app-brand-text fw-bold fs-4">
                                    {{ config('variables.templateName') }}
                                </span>
                            </div>
                        </div>
                        <div>
                            <h4 class="fw-medium mb-2">{{ $pengaduan->kode }}</h4>
                            <div class="mb-2 pt-1">
                                <span>Tanggal Pengaduan :</span>
                                <span class="fw-medium">{{ $pengaduan->tanggal_laporan }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="{{ route('pengaduan.update', $pengaduan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <hr class="my-0" />
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-4">Detail Pengaduan</h4>
                            <div class="row g-3 ">
                                <div class="col-md-8">
                                    <label class="form-label" for="keterangan_petugas">Catatan Dari Petugas</label>
                                    <textarea class="form-control" name="keterangan_petugas" cols="10" rows="5">{{ $pengaduan->keterangan_petugas }}</textarea>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Tanggal Perbaikan</label>
                                    <input type="date" class="form-control" name="tanggal_perbaikan"
                                        value="{{ $pengaduan->tanggal_perbaikan }}">
                                </div>
                                <div class="col-12 p-2 mb-4">
                                    <div class="text-light medium fw-medium mb-3">Status</div>
                                    <div class="row switches-stacked text-center">
                                        <div class="col-lg-4 mb-2">
                                            <!-- Menggunakan kolom grid Bootstrap untuk setiap switch -->
                                            <label class="switch switch-success">
                                                <input type="radio" class="switch-input" name="status" value="Pending"
                                                    <?php echo $status === 'pending' ? 'checked' : ''; ?> required />
                                                <span class="switch-toggle-slider">
                                                    <span class="switch-on"></span>
                                                    <span class="switch-off"></span>
                                                </span>
                                                <span class="switch-label">Pending</span>
                                            </label>
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <!-- Menggunakan kolom grid Bootstrap untuk setiap switch -->
                                            <label class="switch switch-success">
                                                <input type="radio" class="switch-input" name="status" value="Proses"
                                                    <?php echo $status === 'proses' ? 'checked' : ''; ?> required />
                                                <span class="switch-toggle-slider">
                                                    <span class="switch-on"></span>
                                                    <span class="switch-off"></span>
                                                </span>
                                                <span class="switch-label">Proses</span>
                                            </label>
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <!-- Menggunakan kolom grid Bootstrap untuk setiap switch -->
                                            <label class="switch switch-success">
                                                <input type="radio" class="switch-input" name="status" value="Selesai"
                                                    <?php echo $status === 'selesai' ? 'checked' : ''; ?> required />
                                                <span class="switch-toggle-slider">
                                                    <span class="switch-on"></span>
                                                    <span class="switch-off"></span>
                                                </span>
                                                <span class="switch-label">Selesai</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="nip">NIP / NITK Pegawai</label>
                                    <input type="text" class="form-control" disabled value="{{ $pengaduan->nip }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="nama">Nama</label>
                                    <input type="text" class="form-control" disabled value="{{ $pengaduan->nama }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="telepon_pelapor">Nomor WhatsApp</label>
                                    <input type="text" class="form-control" disabled
                                        value="{{ $pengaduan->telepon_pelapor }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="nama_barang">Jenis Barang</label>
                                    <input type="text" class="form-control" disabled
                                        value="{{ $pengaduan->nama_barang }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="unit_pelapor">Instalasi / Unit Kerja</label>
                                    <input type="text" class="form-control" disabled
                                        value="{{ $pengaduan->unit_pelapor }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="jabatan_pelapor">Jabatan</label>
                                    <input type="text" class="form-control" disabled
                                        value="{{ $pengaduan->jabatan_pelapor }}">
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label" for="keterangan_laporan">Keterangan Laporan</label>
                                    <textarea class="form-control" cols="10" rows="5" disabled>{{ $pengaduan->keterangan_laporan }}</textarea>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="fotoModal" tabindex="-1" aria-labelledby="fotoModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="fotoModalLabel">Foto Kerusakan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <img src="" id="modalFoto" class="img-fluid"
                                                    alt="Foto Kerusakan">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="foto">Foto Kerusakan</label><br>
                                    <?php if ($pengaduan->foto): ?>
                                    <img src="{{ asset('uploads/' . $pengaduan->foto) }}" alt="Foto Kerusakan"
                                        style="max-width: 100%; max-height: 420px;" data-bs-toggle="modal"
                                        data-bs-target="#fotoModal"
                                        onclick="showModalImage('{{ asset('uploads/' . $pengaduan->foto) }}')" />
                                    <?php else: ?>
                                    <p>- Foto tidak tersedia -</p>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <!-- /Invoice -->

        <!-- Invoice Actions -->
        <div class="col-xl-3 col-md-4 col-12 invoice-actions">
            <div class="card">
                <div class="card-body">
                    <button type="submit" class="btn btn-label-primary w-100 mb-2">
                        <span class="d-flex align-items-center justify-content-center text-nowrap">
                            <i class="ti ti-send ti-xs me-2"></i>Kirim
                        </span>
                    </button>
                    <a href="{{ route('dandang-pengaduan') }}" class="btn btn-label-warning w-100">
                        <i class="ti ti-arrow-left ti-xs me-2"></i>Kembali
                    </a>
                </div>
            </div>
        </div>
        <!-- /Invoice Actions -->
    </div>
    </form>
    <script>
        function showModalImage(imageSrc) {
            document.getElementById('modalFoto').src = imageSrc;
        }
    </script>

@endsection
