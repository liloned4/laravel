<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\apps\PengaduanTable;
use App\Http\Controllers\front_pages\Landing;
use App\Http\Controllers\apps\DashboardController;
use App\Http\Controllers\authentications\LoginCover;
use App\Http\Controllers\language\LanguageController;
use App\Http\Controllers\authentications\RegisterCover;


// Main Page Route
Route::get('/', [Landing::class, 'index'])->name('pengaduan');
Route::post('/aduan', [Landing::class, 'store'])->name('aduan.store');
Route::post('/front-pages/status', [Landing::class, 'checkStatus'])->name('check.status');
Route::get('/front-pages/front-list-table', [Landing::class, 'listPengaduan'])->name('front.list.table');
Route::get('/auth/register', [RegisterCover::class, 'index'])->name('auth.register');
Route::post('/auth/register', [RegisterCover::class, 'register'])->name('proses.register');
Route::get('/auth/login-dandang', [LoginCover::class, 'index'])->name('auth-login-dandang');
Route::post('/auth/login', [LoginCover::class, 'login'])->name('proses.login');

Route::middleware('auth')->group(function () {
  Route::get('/logout', [LoginCover::class, 'logout'])->name('logout');
  Route::get('/si-dandang/dashboard', [DashboardController::class, 'index'])->name('dandang-dashboard');
  // Rute untuk data pengaduan per hari (chart)
  Route::get('/si-dandang/dashboard/data-pengaduan-per-hari', [DashboardController::class, 'chartPerHari'])->name('data-pengaduan-per-hari');
  // Rute untuk data pengaduan per hari berdasarkan nama barang (chart)
  Route::get('/si-dandang/dashboard/data-pengaduan-per-hari-nama-barang', [DashboardController::class, 'chartPerBarang'])->name('data-pengaduan-per-hari-nama-barang');

  // Pengelolaan Pengaduan
  Route::get('/si-dandang/pengaduan', [PengaduanTable::class, 'pengaduanManagement'])->name('dandang-pengaduan');
  Route::get('/si-dandang/pengaduan/edit/{id}', [PengaduanTable::class, 'edit'])->name('dandang-pengaduan.edit');
  Route::put('/si-dandang/pengaduan/{id}', [PengaduanTable::class, 'update'])->name('pengaduan.update');
  Route::delete('/si-dandang/pengaduan/destroy/{id}', [PengaduanTable::class, 'destroy'])->name('pengaduan.destroy');

  Route::resource('/pengaduan-list-table', PengaduanTable::class);
});

Route::fallback(function () {
  if (request()->is('assets/*')) {
    return response()->json(['error' => 'Not Found'], 404);
  }
});

Route::get('lang/{locale}', [LanguageController::class, 'swap']);
