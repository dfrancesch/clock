<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $expectedUser = config('admin.username');
        $expectedPass = config('admin.password');

        if (
            $credentials['username'] === $expectedUser &&
            $credentials['password'] === $expectedPass
        ) {
            session([
                'admin_logged_in' => true,
                'admin_username' => $credentials['username'],
            ]);

            return redirect()->route('admin.dashboard');
        }

        return back()
            ->withInput($request->only('username'))
            ->with('error', 'Credenciales inválidas.');
    }

    public function logout(Request $request)
    {
        $request->session()->forget(['admin_logged_in', 'admin_username']);

        return redirect()->route('admin.login');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }
}

