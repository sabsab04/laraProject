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
        $evento = Event::findOrFail($id); // Cerca l'evento, se non lo trova lancia un errore 404
        return view('evento-dettaglio', compact('evento'));
    }
}
