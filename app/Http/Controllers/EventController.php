<?php
namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::query();

        if ($request->filled('ricerca')) {
            $termine = $request->ricerca;

            if (Auth::check() && str_contains($termine, '*')) {
                // Utente loggato con asterisco: cerca nella descrizione
                $wildcardTerm = str_replace('*', '%', $termine);
                $query->where('descrizione', 'LIKE', $wildcardTerm);
            } else {
                // Utente non loggato o senza asterisco: città esatta
                $query->where('citta', $termine);
            }
        }

        $eventi = $query->paginate(5);
        return view('eventi', compact('eventi'));
    }

    public function show($id)
    {
        $evento = Event::findOrFail($id);
        $conteggio_partecipanti = Attendance::where('event_id', $id)->count();
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