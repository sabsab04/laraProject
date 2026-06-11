<?php

namespace App\Http\Controllers;

use App\Models\OrganizerRequest;
use Illuminate\Http\Request;

class OrganizerRequestController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validazione dei dati del form
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|unique:organizer_requests,email',
            'organization' => 'required|string|max:255',
        ]);

        // 2. Salvataggio nel database (lo stato sarà 'pending' di default)
        OrganizerRequest::create($validated);

        // 3. Ritorna alla pagina precedente con un messaggio di successo
        return redirect()->back()->with('success', 'La tua richiesta è stata inviata con successo! Sarà valutata dagli amministratori.');
    }
}