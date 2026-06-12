<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function showDatiPersonali() {
        return view('dashboard'); 
        
    }

    public function editDatiPersonali() {
        return view('dati-personali-form');
    }

    public function updateDatiPersonali(Request $request) {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
        ]);

        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->birth_date = $request->birth_date;
        $user->username = $request->username;
        
        $user->save();

        return redirect('/dashboard')->with('success', 'Dati aggiornati con successo!');
    }
}