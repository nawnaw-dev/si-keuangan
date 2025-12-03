<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  public function showLoginForm()
  {
    return view('auth.login');
  }

  public function login(Request $request)
  {
    $credentials = $request->validate([
      'email' => ['required', 'email'],
      'password' => ['required'],
    ]);

    // 2. Coba Otentikasi
    if (Auth::attempt($credentials)) {
      // Regenerate session untuk mencegah session fixation
      $request->session()->regenerate();

      // Redirect ke halaman yang dituju setelah login
      return redirect()->intended('/dashboard');
    }

    // 3. Gagal Otentikasi
    return back()->withErrors([
      'email' => 'Kredensial yang diberikan tidak cocok dengan catatan kami.',
    ])->onlyInput('email');
  }

  public function logout(Request $request)
  {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
  }
}
