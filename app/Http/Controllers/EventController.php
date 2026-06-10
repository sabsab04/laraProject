<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Mostra tutti gli eventi nella pagina principale
    public function index()
    {
        $eventi = Event::all(); // Prende tutti gli eventi dal DB
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

