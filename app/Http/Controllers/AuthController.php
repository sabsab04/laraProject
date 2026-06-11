<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // per mostrare la pagina di login
    public function showLogin()
    {
        return view('login');
    }

    // Gestisce la richiesta di login
  
   public function login(Request $request)
{
    $credentials = $request->validate([
        'username' => 'required',
        'password' => 'required',
    ]);

    if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
        $request->session()->regenerate();
        return redirect('/dashboard');
    }

    return back()->withErrors([
        'username' => 'Credenziali non corrette.',
    ]);
}
    // Logout
  public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    // Mostra la pagina di registrazione
public function showRegister()
{
    return view('register');
}

// Gestisce il form di registrazione

public function register(Request $request)
{
    $request->validate([
        'name' => 'required',
        'surname' => 'required',
        'email' => 'required|email|unique:users',
        'birth_date' => 'required|date',
         'password' => bcrypt($request->password),
    ]);

    $user = \App\Models\User::create([
        'name' => $request->name,
        'surname' => $request->surname,
        'username' => explode('@', $request->email)[0],
        'birth_date' => $request->birth_date,
        'email' => $request->email,
        'password' => $request->password,
    ]);

    Auth::login($user);
    return redirect('/dashboard');
}

}