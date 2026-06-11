<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();
            
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.organizzatori');
            }

            return redirect('/dashboard');
        }

        return back()->withErrors([
            'username' => 'Credenziali non corrette.',
        ]);
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
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'       => 'required',
            'surname'    => 'required',
            'username'   => 'required|unique:users',
            'birth_date' => 'required|date',
            'password'   => 'required|min:6',
        ]);

        $user = User::create([
            'name'       => $request->name,
            'surname'    => $request->surname,
            'username'   => $request->username,
            'birth_date' => $request->birth_date,
            'password'   => Hash::make($request->password),
            'role'       => 'user'
        ]);

        Auth::login($user);
        return redirect('/dashboard');
    }
}
