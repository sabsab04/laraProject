<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\OrganizerRequest;

class AdminController extends Controller
{
    public function organizzatori() {
        $organizzatori = \App\Models\User::where('role', 'organizer')->get();
        
        return view('admin.organizzatori', compact('organizzatori'));
    }
    
    public function createOrganizzatore() {
        return view('admin.organizzatori_form');
    }

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
            'role' => 'organizer',
            'birth_date' => '2000-01-01',
        ]);

        return redirect()->route('admin.organizzatori')->with('success', 'Nuovo organizzatore creato con successo!');
    }

    public function editOrganizzatore($id) {
        $organizzatore = User::findOrFail($id);
        return view('admin.organizzatori_form', compact('organizzatore'));
    }

    public function updateOrganizzatore(Request $request, $id) {
        $organizzatore = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'organization' => 'required',
            'username' => 'required|unique:users,username,' . $id, 
        ]);

        $organizzatore->name = $request->name;
        $organizzatore->surname = $request->surname;
        $organizzatore->organization = $request->organization;
        $organizzatore->username = $request->username;

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
        $organizzatori = \App\Models\User::where('role', 'organizer')->get();

        $selectedOrg = null;
        $bigliettiVenduti = 0;
        $incassoTotale = 0;

        if ($request->filled('organizzatore_id')) {
            $selectedOrg = \App\Models\User::find($request->organizzatore_id);

            if ($selectedOrg) {
                $eventiIds = \App\Models\Event::where('organizer_id', $selectedOrg->id)->pluck('id');
                $bigliettiVenduti = \App\Models\Purchase::whereIn('event_id', $eventiIds)->sum('quantita'); 
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

    public function richieste() {
    $richieste = OrganizerRequest::where('status', 'pending')->get();
    return view('admin.richieste', compact('richieste'));
}

public function approvaRichiesta($id) {
    $richiesta = OrganizerRequest::findOrFail($id);
    
    User::create([
        'name'         => $richiesta->name,
        'surname'      => $richiesta->surname,
        'email'        => $richiesta->email,
        'organization' => $richiesta->organization,
        'username'     => strtolower($richiesta->name . $richiesta->surname),
        'password'     => Hash::make('password123'),
        'role'         => 'organizer',
        'birth_date'   => '2000-01-01',
    ]);

    $richiesta->update(['status' => 'approved']);
    return redirect()->route('admin.richieste')->with('success', 'Organizzatore approvato!');
}

public function rifiutaRichiesta($id) {
    $richiesta = OrganizerRequest::findOrFail($id);
    $richiesta->update(['status' => 'rejected']);
    return redirect()->route('admin.richieste')->with('success', 'Richiesta rifiutata.');
}

}