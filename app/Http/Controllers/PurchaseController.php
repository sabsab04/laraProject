<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function store(Request $request, $event_id)
    {
        $event = Event::findOrFail($event_id);

        // Controlla se ci sono posti disponibili
        if ($event->posti_disponibili <= 0) {
            return back()->with('error', 'Nessun posto disponibile!');
        }

        // Crea l'acquisto
        Purchase::create([
            'user_id'  => Auth::id(),
            'event_id' => $event->id,
            'quantita' => 1,
            'totale'   => $event->costo,
        ]);

        // Diminuisci i posti disponibili
        $event->decrement('posti_disponibili');

        return back()->with('success', 'Biglietto acquistato con successo!');
    }
}