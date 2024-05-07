<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('pengaduan', function (Blueprint $table) {
      $table->id();
      $table->string('kode')->unique(); // Kolom nomor kode yang unik
      $table->string('nip');
      $table->string('nama');
      $table->string('telepon_pelapor');
      $table->string('unit_pelapor');
      $table->string('jabatan_pelapor');
      $table->string('nama_barang');
      $table->text('keterangan_laporan');
      $table->date('tanggal_laporan');
      $table->string('status');
      $table->text('keterangan_petugas')->nullable();
      $table->date('tanggal_perbaikan')->nullable();
      $table->string('foto')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('pengaduan');
  }
};
