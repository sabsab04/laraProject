<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function organizzatori() {
        $organizzatori = \App\Models\User::where('role', 'organizzatore')->get();
        
        return view('admin.organizzatori', compact('organizzatori'));
    }
    
    // 1. Mostra il form vuoto (Creazione)
    public function createOrganizzatore() {
        return view('admin.organizzatori_form');
    }

    // 2. Salva il nuovo organizzatore nel DB
    public function storeOrganizzatore(Request $request) {
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'organization' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|min:4'
        ]);

        User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'organization' => $request->organization,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'organizzatore', // Impostiamo in automatico il Livello 3
            'birth_date' => '2000-01-01', // Data fittizia se il tuo DB la richiede obbligatoria
        ]);

        return redirect()->route('admin.organizzatori')->with('success', 'Nuovo organizzatore creato con successo!');
    }

    // 3. Mostra il form pieno coi dati vecchi (Modifica)
    public function editOrganizzatore($id) {
        $organizzatore = User::findOrFail($id);
        return view('admin.organizzatori_form', compact('organizzatore'));
    }

    // 4. Salva le modifiche nel DB
    public function updateOrganizzatore(Request $request, $id) {
        $organizzatore = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'organization' => 'required',
            // L'username deve essere unico, tranne che per se stesso!
            'username' => 'required|unique:users,username,' . $id, 
        ]);

        $organizzatore->name = $request->name;
        $organizzatore->surname = $request->surname;
        $organizzatore->organization = $request->organization;
        $organizzatore->username = $request->username;

        // Aggiorniamo la password solo se l'admin ne ha digitata una nuova
        if ($request->filled('password')) {
            $organizzatore->password = Hash::make($request->password);
        }

        $organizzatore->save();

        return redirect()->route('admin.organizzatori')->with('success', 'Organizzatore aggiornato con successo!');
    }

    public function clienti() {
        $clienti = \App\Models\User::where('role', 'user')->get();
        
        return view('admin.clienti', compact('clienti'));
    }

    public function vendite(Request $request) {
        // Estrai tutti gli organizzatori per popolare la tendina
        $organizzatori = \App\Models\User::where('role', 'organizzatore')->get();

        $selectedOrg = null;
        $bigliettiVenduti = 0;
        $incassoTotale = 0;

        // Se è stata selezionata un'organizzazione dalla tendina
        if ($request->filled('organizzatore_id')) {
            $selectedOrg = \App\Models\User::find($request->organizzatore_id);

            if ($selectedOrg) {
                
                // 1. Trova tutti gli ID degli eventi di questo specifico organizzatore
                $eventiIds = \App\Models\Event::where('organizer_id', $selectedOrg->id)->pluck('id');

                // 2. Somma la colonna 'quantita' degli acquisti legati a questi eventi
                $bigliettiVenduti = \App\Models\Purchase::whereIn('event_id', $eventiIds)->sum('quantita'); 

                // 3. Somma la colonna 'totale' degli acquisti legati a questi eventi
                $incassoTotale = \App\Models\Purchase::whereIn('event_id', $eventiIds)->sum('totale');
            }
        }

        return view('admin.vendite', compact('organizzatori', 'selectedOrg', 'bigliettiVenduti', 'incassoTotale'));
    }
    
    public function destroyUser($id) {
        $user = \App\Models\User::findOrFail($id);
        $user->delete();
        
        return redirect()->back()->with('success', 'Utente eliminato con successo!');
    }
}
