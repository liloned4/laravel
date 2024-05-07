<?php

namespace App\Http\Controllers\authentications;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterCover extends Controller
{
  public function index()
  {
    $pageConfigs = ['myLayout' => 'blank'];

    return view('content.authentications.auth-register-cover', ['pageConfigs' => $pageConfigs]);
  }

  public function register(Request $request)
  {
    // Validasi data yang diterima dari formulir pendaftaran
    $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required|string|min:8|confirmed',
    ]);

    // Buat entitas User baru
    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
    ]);

    // Simpan nilai _token ke dalam kolom remember_token
    // $user->update(['remember_token' => $request->_token]);

    // Redirect pengguna ke halaman utama dengan pesan sukses
    return redirect('/')->with('success', 'Akun berhasil dibuat!');
  }
}