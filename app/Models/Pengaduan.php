<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
  protected $table = 'pengaduan';

  protected $fillable = [
    'kode',
    'nip',
    'nama',
    'telepon_pelapor',
    'unit_pelapor',
    'jabatan_pelapor',
    'nama_barang',
    'keterangan_laporan',
    'tanggal_laporan',
    'foto',
    'keterangan_petugas',
    'tanggal_perbaikan',
    'status',
  ];
}
