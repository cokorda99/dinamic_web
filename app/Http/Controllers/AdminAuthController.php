<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\GeneralSetting;

class AdminAuthController extends Controller
{
    // Menampilkan form login admin
    public function showLoginForm()
    {
        $setting = GeneralSetting::first();
        return view('auth.admin-login', compact('setting'));
    }

    // Menampilkan form registrasi admin
    public function showRegisterForm()
    {
        $setting = GeneralSetting::first();
        return view('auth.admin-register', compact('setting'));
    }

    // Menangani proses login admin
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->intended('/admin/dashboard');
        }

        // Menggunakan session untuk menyimpan pesan error
        return back()->with('error', 'Email atau Password salah');
    }

    // Menangani proses registrasi admin
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $admin = $this->create($request->all());

        Auth::guard('admin')->login($admin);

        return redirect()->intended('/admin/dashboard');
    }

    // Validasi input
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    // Membuat record admin baru di database
    protected function create(array $data)
    {
        return Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'Img' => 'admin_default.png',   // Set default value for the img column
            'phone' => '-',                 // Set default value for the phone column
        ]);
    }

    // Menangani logout admin
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
}
