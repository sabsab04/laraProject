<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Mostra tutti gli eventi nella pagina principale
    public function index(Request $request)
    {
        $query = Event::query();

        if ($request->filled('ricerca')) {
            $termine = $request->ricerca;

            // Passiamo $termine dentro la closure con 'use'
            $query->where(function($q) use ($termine) {
                
                if (str_contains($termine, '*')) {
                    // C'è l'asterisco: ricerca nella descrizione
                    $termini = explode(' ', $termine);

                    // Passiamo $termini dentro questa seconda closure
                    $q->where(function($subQuery) use ($termini) {
                        foreach ($termini as $index => $t) {
                            $wildcardTerm = str_replace('*', '%', $t);
                            
                            if ($index === 0) {
                                $subQuery->where('descrizione', 'LIKE', $wildcardTerm);
                            } else {
                                $subQuery->orWhere('descrizione', 'LIKE', $wildcardTerm);
                            }
                        }
                    });
                } else {
                    // Niente asterisco: ricerca esatta sulla città
                    // $termine qui è già disponibile perché lo abbiamo passato nel primo 'use'
                    $q->where('citta', $termine);
                }
            });
        }

        $eventi = $query->paginate(2);
        
        // Passiamo i risultati alla vista
        return view('eventi', compact('eventi'));
    }

    // Mostra il dettaglio di un singolo evento in base al suo ID
   public function show($id)
{
    $evento = Event::findOrFail($id);
    $conteggio_partecipanti = \App\Models\Attendance::where('event_id', $id)->count();
    
    $evento->prezzo_finale = (float)$evento->costo;
    
    if ($evento->last_minute_days && $evento->last_minute_discount_percentage) {
        $giorniMancanti = \Carbon\Carbon::now()->floatDiffInDays(\Carbon\Carbon::parse($evento->data));
        
        if ($giorniMancanti <= $evento->last_minute_days) {
            $sconto = (float)$evento->costo * ((float)$evento->last_minute_discount_percentage / 100);
            $evento->prezzo_finale = round((float)$evento->costo - $sconto, 2);
        }
    }
    
    return view('evento-dettaglio', compact('evento', 'conteggio_partecipanti'));
}
}

