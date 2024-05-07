<?php

namespace App\Http\Controllers\front_pages;

use App\Models\Pegawai;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;


class Landing extends Controller
{
  public function index()
  {
    $pageConfigs = ['myLayout' => 'front'];
    // Untuk Mendapatan Data Pegawai
    $pegawai = Pegawai::all();
    // Mendapatkan nomor pengaduan terbaru dari tabel pengaduan
    $lastPengaduan = Pengaduan::latest()->first();
    if ($lastPengaduan) {
      $lastKode = $lastPengaduan->kode;
      // Mengambil angka dari kode terakhir dan menambahkan 1
      $nextKode = 'NP-' . str_pad((intval(substr($lastKode, 3)) + 1), 4, '0', STR_PAD_LEFT); // Panjang 4 digit
    } else {
      // Jika tidak ada pengaduan sebelumnya, nomor pengaduan baru dimulai dari NP-0001
      $nextKode = 'NP-0001';
    }
    return view('content.front-pages.pengaduan', ['pageConfigs' => $pageConfigs, 'nextKode' => $nextKode, 'pegawai' => $pegawai]);
  }


  public function store(Request $request)
  {
    $request->validate([
      'nip' => 'required|max:255',
      'nama' => 'required|max:255',
      'telepon_pelapor' => 'required|max:255',
      'unit_pelapor' => 'required|max:255',
      'jabatan_pelapor' => 'required|max:255',
      'nama_barang' => 'required|max:255',
      'keterangan_laporan' => 'required|max:255',
      'tanggal_laporan' => 'required|date',
      'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

      // Tambahkan validasi untuk input fields lainnya sesuai kebutuhan

    ]);

    // Proses upload file foto
    if ($request->hasFile('foto')) {
      $fotoName = time() . '.' . $request->foto->extension();
      $request->foto->move(public_path('uploads'), $fotoName);
    } else {
      $fotoName = null; // Atau Anda bisa memberikan nilai default lainnya
    }

    // Mendapatkan nomor pengaduan terbaru
    $lastPengaduan = Pengaduan::latest()->first();
    if ($lastPengaduan) {
      $lastKode = $lastPengaduan->kode;
      // Mengambil angka dari kode terakhir dan menambahkan 1
      $nextKode = 'NP-' . str_pad((intval(substr($lastKode, 3)) + 1), 4, '0', STR_PAD_LEFT); // Panjang 4 digit
    } else {
      // Jika tidak ada pengaduan sebelumnya, nomor pengaduan baru dimulai dari NP-0001
      $nextKode = 'NP-0001';
    }

    // Simpan data ke dalam database
    $pengaduan = Pengaduan::create([
      'kode' => $nextKode,
      'nip' => $request->nip,
      'nama' => $request->nama,
      'telepon_pelapor' => $request->telepon_pelapor,
      'unit_pelapor' => $request->unit_pelapor,
      'jabatan_pelapor' => $request->jabatan_pelapor,
      'nama_barang' => $request->nama_barang,
      'keterangan_laporan' => $request->keterangan_laporan,
      'tanggal_laporan' => $request->tanggal_laporan,
      'foto' => $fotoName,
      // Tambahkan data lainnya sesuai kebutuhan
    ]);

    // Kirim pesan ke Telegram
    $message =
      "SI - DANDANG \n" .
      "Pengaduan Baru : $pengaduan->kode \n" .
      "NIP / NITK: " . $request->nip . "\n" .
      "Nama Pengadu: " . $request->nama . "\n" .
      "Nomor Pengadu: " . $request->telepon_pelapor . "\n" .
      "Unit / Instalasi: " . $request->unit_pelapor . "\n" .
      "Keterangan Keluhan: " . $request->keterangan_laporan . "\n \n" .
      "Silahkan Segera Diproses." . "\n" . "Terima Kasih. "; // Menghapus bagian yang menyertakan nama file foto

    // Kirim pesan ke Telegram
    if ($fotoName && file_exists(public_path('uploads/' . $fotoName))) {
      $response = Http::attach(
        'photo',
        file_get_contents(public_path('uploads/' . $fotoName)),
        $fotoName
      )->post('https://api.telegram.org/bot6909856644:AAGShlDTCiwi07ejXrF28Pimq6JZDPIOIlw/sendPhoto', [
        'chat_id' => -4101105112,
        'caption' => $message,
      ]);
    } else {
      // Jika tidak ada foto yang diunggah atau foto tidak ditemukan
      $response = Http::post('https://api.telegram.org/bot6909856644:AAGShlDTCiwi07ejXrF28Pimq6JZDPIOIlw/sendMessage', [
        'chat_id' => -4101105112,
        'text' => $message,
      ]);
    }

    // Simpan pesan sukses sebagai bagian dari URL redirect
    return redirect()->back()->with('success', 'Laporan berhasil dikirim!')->with('kode', $nextKode);
  }


  public function checkStatus(Request $request)
  {
    $pageConfigs = ['myLayout' => 'front'];
    $kode = $request->input('kode');
    $nip = $request->input('nip');

    // Lakukan validasi kode dan NIP
    $pengaduan = Pengaduan::where('kode', $kode)
      ->where('nip', $nip)
      ->first();

    if ($pengaduan) {
      // Jika sesuai, arahkan ke halaman status dengan data pengaduan yang sesuai
      return view('content.front-pages.status', ['pageConfigs' => $pageConfigs, 'pengaduan' => $pengaduan]);
    } else {
      // Jika tidak sesuai, kembalikan ke halaman sebelumnya dengan pesan kesalahan
      return redirect()->back()->with('error', 'Nomor Pengaduan atau NIP salah.');
    }
  }
  public function listPengaduan(Request $request)
  {
    // Mengambil data pengaduan dengan status 'pending' dan diurutkan berdasarkan tanggal laporan paling baru
    $pengaduan = Pengaduan::where('status', 'pending')->orderBy('tanggal_laporan', 'desc')->get();

    $pageConfigs = ['myLayout' => 'front'];
    return view('content.front-pages.list-pengaduan', ['pageConfigs' => $pageConfigs, 'pengaduan' => $pengaduan]);
  }
}
