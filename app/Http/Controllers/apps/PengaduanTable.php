<?php

namespace App\Http\Controllers\apps;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanTable extends Controller
{
  /**
   * Redirect to pengaduan-management view.
   *
   */
  public function pengaduanManagement()
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

    return view('content.apps.pengaduan-table', [
      'totalPengaduan' => $totalPengaduan,
      'pendingCount' => $pendingCount,
      'prosesCount' => $prosesCount,
      'selesaiCount' => $selesaiCount,
      'pengaduans' => $pengaduans,
      'namaBulanTerakhir' => $namaBulanTerakhir,
      // Kamu bisa menambahkan variabel tambahan yang ingin ditampilkan di view
    ]);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $columns = [
      // Sesuaikan kolom yang ingin ditampilkan dalam tabel
      1 => 'id',
      2 => 'kode',
      3 => 'nama',
      4 => 'telepon_pelapor',
      5 => 'nama_barang',
      6 => 'keterangan_laporan',
      7 => 'tanggal_laporan',
      8 => 'status',
      // Tambahkan kolom lain jika diperlukan
    ];

    $search = [];
    $status = $request->input('status'); // Ambil status dari permintaan

    $query = Pengaduan::query(); // Mulai query builder

    if (!empty($status)) {
      // Jika status tidak kosong, tambahkan kondisi WHERE ke query
      $query->where('status', $status);
    }

    $totalData = $query->count();
    $totalFiltered = $totalData;

    $limit = $request->input('length');
    $start = $request->input('start');
    $order = $columns[$request->input('order.0.column')];
    $dir = $request->input('order.0.dir');

    if (empty($request->input('search.value'))) {
      $pengaduans = $query->offset($start)
        ->limit($limit)
        ->orderBy($order, ($dir === 'asc' ? 'asc' : 'desc'))
        ->get();
    } else {
      $search = $request->input('search.value');

      $pengaduans = $query->where('id', 'LIKE', "%{$search}%")
        ->orWhere('kode', 'LIKE', "%{$search}%")
        ->orWhere('nama', 'LIKE', "%{$search}%")
        // Tambahkan logika pencarian sesuai kebutuhan
        ->offset($start)
        ->limit($limit)
        ->orderBy($order, $dir)
        ->get();

      $totalFiltered = $query->where('id', 'LIKE', "%{$search}%")
        ->orWhere('kode', 'LIKE', "%{$search}%")
        ->orWhere('nama', 'LIKE', "%{$search}%")
        // Tambahkan logika pencarian sesuai kebutuhan
        ->count();
    }

    $data = [];

    if (!empty($pengaduans)) {
      // Berikan ID yang sesuai kebutuhan, bisa berupa ID dari database atau ID yang digenerate secara manual
      $ids = $start;

      foreach ($pengaduans as $pengaduan) {
        $nestedData['id'] = $pengaduan->id;
        $nestedData['fake_id'] = ++$ids;
        $nestedData['kode'] = $pengaduan->kode;
        $nestedData['nama'] = $pengaduan->nama;
        $nestedData['telepon_pelapor'] = $pengaduan->telepon_pelapor;
        $nestedData['nama_barang'] = $pengaduan->nama_barang;
        $nestedData['keterangan_laporan'] = $pengaduan->keterangan_laporan;
        $nestedData['tanggal_laporan'] = $pengaduan->tanggal_laporan;
        $nestedData['status'] = $pengaduan->status;
        // Tambahkan kolom lain jika diperlukan

        $data[] = $nestedData;
      }
    }

    if ($data) {
      return response()->json([
        'draw' => intval($request->input('draw')),
        'recordsTotal' => intval($totalData),
        'recordsFiltered' => intval($totalFiltered),
        'code' => 200,
        'data' => $data,
      ]);
    } else {
      return response()->json([
        'message' => 'Internal Server Error',
        'code' => 500,
        'data' => [],
      ]);
    }
  }


  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    // Implementasi penyimpanan pengaduan baru jika diperlukan
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $where = ['id' => $id];
    $pengaduan = Pengaduan::where($where)->first();
    return view('content.apps.pengaduan-table-edit', ['pengaduan' => $pengaduan]);
  }


  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    // $pengaduan = Pengaduan::findOrFail($id);
    // $pengaduan->tanggal_perbaikan = $request->input('tanggal_perbaikan');
    // $pengaduan->keterangan_petugas = $request->input('keterangan_petugas');
    // $pengaduan->status = $request->input('status');
    // $pengaduan->save();
    // return redirect()->route('dandang-pengaduan', $pengaduan->id)->with('success', 'Perubahan berhasil disimpan.');

    $pengaduan = Pengaduan::findOrFail($id);

    // Validasi data yang diterima dari formulir jika diperlukan

    $kode = $pengaduan->kode;
    $nama = $pengaduan->nama;
    $nip = $pengaduan->nip;
    $barang = $pengaduan->nama_barang;
    $keterangan_laporan = $pengaduan->keterangan_laporan;

    $old_status = $pengaduan->status;
    $new_status = $request->input('status');

    $pengaduan->tanggal_perbaikan = $request->input('tanggal_perbaikan');
    $pengaduan->keterangan_petugas = $request->input('keterangan_petugas');
    $keterangan_petugas = $request->input('keterangan_petugas');
    $pengaduan->status = $new_status;

    $pengaduan->save();

    // Kirim pesan jika status berubah
    if ($old_status != $new_status) {
      // Sesuaikan nomor telepon pengadu dan pesan sesuai dengan kebutuhan
      $telepon_pelapor = $pengaduan->telepon_pelapor; // Ganti ini dengan kolom yang sesuai di tabel pengaduan

      $pesan = "Pengaduan anda dengan nomor : $kode \nNama : $nama \nNIP / NITK : $nip \nNama Barang : $barang \nKeterangan Laporan : $keterangan_laporan \nStatus  : $new_status.
      \nKeterangan dari petugas: $keterangan_petugas \n \nRESPON OTOMATIS DARI SI-DANDANG";

      // Kirim pesan melalui Fonnte API
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.fonnte.com/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array(
          'target' => $telepon_pelapor,
          'message' => $pesan,
          'countryCode' => '62', // Kode negara, bisa disesuaikan dengan kode negara yang sesuai
        ),
        CURLOPT_HTTPHEADER => array(
          'Authorization: ' . '+@sZn_v3HxrUnENQMVm1', // Ganti 'TOKEN' dengan token Anda
        ),
      ));

      $response = curl_exec($curl);
      if (curl_errno($curl)) {
        $error_msg = curl_error($curl);
      }
      curl_close($curl);

      if (isset($error_msg)) {
        echo $error_msg;
      }
      echo $response;
    }
    return redirect()->route('dandang-pengaduan', $pengaduan->id)->with('success', 'Perubahan berhasil disimpan.');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $pengaduan = Pengaduan::where('id', $id)->delete();
  }
}
