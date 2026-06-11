<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // Aggiunto per criptare la password
use App\Models\User;

class AuthController extends Controller
{
    // Mostra la pagina di login
    public function showLogin()
    {
        return view('login');
    }

    // Gestisce la richiesta di login
    // Gestisce la richiesta di login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();
            
            // IL VIGILE URBANO: Controlliamo chi è appena entrato
            if (Auth::user()->role === 'admin') {
                // Se è l'admin, spediscilo dritto al suo pannello di controllo!
                return redirect()->route('admin.organizzatori'); 
            }

            // Se è un cliente (Livello 2) o un organizzatore (Livello 3), va al profilo normale
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
        // 1. Validazione: chiediamo l'username e lo rendiamo unico
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'username' => 'required|unique:users', // L'username deve essere unico!
            'birth_date' => 'required|date',
            'password' => 'required|min:6',
        ]);

        // 2. Creazione dell'utente SENZA l'email e CON la password criptata
        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'username' => $request->username, // Ora l'utente sceglie direttamente il suo username
            'birth_date' => $request->birth_date,
            'password' => Hash::make($request->password), // FONDAMENTALE: cripta la password
            'role' => 'user' // Di default, chi si registra è un Livello 2
        ]);

        // 3. Login automatico post-registrazione
        Auth::login($user);
        return redirect('/dashboard');
    }
}