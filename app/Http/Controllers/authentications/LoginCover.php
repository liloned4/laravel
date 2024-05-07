<?php

namespace App\Http\Controllers\authentications;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginCover extends Controller
{
  public function index()
  {
    $pageConfigs = ['myLayout' => 'blank'];
    return view('content.authentications.auth-login-cover', ['pageConfigs' => $pageConfigs]);
  }

  public function login(Request $request)
  {
    // Validasi data yang diterima dari formulir login
    $request->validate([
      'name' => 'required|string',
      'password' => 'required|string',
    ]);

    // Mencoba mengautentikasi pengguna
    $credentials = $request->only('name', 'password');
    if (Auth::attempt($credentials)) {
      // Autentikasi berhasil
      $request->session()->regenerate();
      session()->flash('success', 'Login berhasil!');

      // Redirect ke dashboard jika berhasil login
      return redirect()->intended(route('dandang-dashboard'));
    }

    // Jika autentikasi gagal, kembali ke halaman login
    return redirect()->route('auth-login-dandang')->with('error', 'Login gagal! Periksa kembali username dan password Anda.');
  }


  public function logout(Request $request)
  {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/')->with('success', 'Anda Berhasil Logout!');
  }
}
