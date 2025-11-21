<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) return redirect('/rumahsakit');
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username'=>'required',
            'password'=>'required'
        ]);

        $credentials = $request->only('username','password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/rumahsakit');
        }

        return back()->withErrors(['username' => 'Username atau password salah'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function showRegister()
    {
        if (Auth::check()) return redirect('/rumahsakit');
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'password' => 'required|min:6'
        ]);

        User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password)
        ]);

        return redirect('/')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}
