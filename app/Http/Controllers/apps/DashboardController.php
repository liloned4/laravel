<?php

namespace App\Http\Controllers\apps;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
  public function index()
  {
    $pengaduans = Pengaduan::all();

    // Mendapatkan bulan terakhir
    $lastMonth = date('Y-m-01');

    // Mengambil jumlah total pengaduan pada bulan terakhir
    $totalPengaduan = Pengaduan::where('tanggal_laporan', '>=', $lastMonth)->count();

    // Hitung jumlah pengaduan berdasarkan status
    $pengaduanCount = $pengaduans->count();
    $pendingCount = $pengaduans->where('status', 'Pending')->count();
    $prosesCount = $pengaduans->where('status', 'Proses')->count();
    $selesaiCount = $pengaduans->where('status', 'Selesai')->count();
    // Kamu bisa menambahkan logika tambahan di sini sesuai kebutuhan

    // Mendapatkan nama bulan terakhir
    $namaBulanTerakhir = date('F Y');

    return view('content.apps.dandang-dashboard', [
      'totalPengaduan' => $totalPengaduan,
      'pendingCount' => $pendingCount,
      'prosesCount' => $prosesCount,
      'selesaiCount' => $selesaiCount,
      'pengaduans' => $pengaduans,
      'namaBulanTerakhir' => $namaBulanTerakhir,
      // Kamu bisa menambahkan variabel tambahan yang ingin ditampilkan di view
    ]);
    // return view('content.apps.dandang-dashboard');
  }

  public function chartPerHari()
  {
    // Ambil data jumlah pengaduan setiap harinya
    $pengaduanPerHari = Pengaduan::selectRaw('DATE(tanggal_laporan) as tanggal, count(*) as jumlah_pengaduan')
      ->groupBy('tanggal')
      ->get();

    // Susun data untuk chart
    $dataChart = [
      'labels' => [],
      'data' => []
    ];

    foreach ($pengaduanPerHari as $pengaduan) {
      $dataChart['labels'][] = $pengaduan->tanggal;
      $dataChart['data'][] = $pengaduan->jumlah_pengaduan;
    }

    // Kirim data ke view
    return response()->json($dataChart);
  }
  public function chartPerBarang()
  {
    // Ambil data jumlah pengaduan setiap harinya untuk setiap barang
    $pengaduanPerBarang = Pengaduan::selectRaw('DATE(tanggal_laporan) as tanggal, nama_barang, count(*) as jumlah_pengaduan')
      ->groupBy('tanggal', 'nama_barang')
      ->get();

    // Susun data untuk chart
    $dataChart = [];

    foreach ($pengaduanPerBarang as $pengaduan) {
      $barang = $pengaduan->nama_barang;
      if (!isset($dataChart[$barang])) {
        $dataChart[$barang] = [
          'name' => $barang,
          'data' => [] // Data jumlah pengaduan akan diisi nanti
        ];
      }
      $dataChart[$barang]['data'][] = $pengaduan->jumlah_pengaduan;
    }

    // Kirim data ke view
    return response()->json(array_values($dataChart));
  }
}
