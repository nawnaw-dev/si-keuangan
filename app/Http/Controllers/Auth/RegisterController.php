<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
  public function showRegistrationForm()
  {
    return view('auth.register'); // Pastikan view ini ada
  }

  /**
   * Menangani pemrosesan registrasi.
   */
  public function register(Request $request)
  {
    // 1. Validasi Input
    $validatedData = $request->validate([
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'password' => ['required', 'string', 'min:8'], // 'confirmed' akan mencari kolom password_confirmation
    ]);

    // 2. Buat User Baru
    $user = User::create([
      'name' => $validatedData['name'],
      'email' => $validatedData['email'],
      // Hashing password SANGAT PENTING
      'password' => Hash::make($validatedData['password']),
    ]);

    // 3. Langsung Loginkan User Setelah Registrasi
    Auth::login($user);

    // 4. Redirect ke halaman yang dituju
    return redirect('/login')->with('success', 'Akun berhasil dibuat dan Anda telah login!');
  }
}
