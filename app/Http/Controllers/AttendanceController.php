<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function store($event_id)
    {
        // Controlla se l'utente ha già messo "Parteciperò"
        $exists = Attendance::where('user_id', Auth::id())
                    ->where('event_id', $event_id)
                    ->exists();

        if ($exists) {
            // Se esiste già, lo rimuove (toggle)
            Attendance::where('user_id', Auth::id())
                ->where('event_id', $event_id)
                ->delete();
            return back()->with('success', 'Hai rimosso la tua partecipazione!');
        }

        Attendance::create([
            'user_id'  => Auth::id(),
            'event_id' => $event_id,
        ]);

        return back()->with('success', 'Hai indicato che parteciperò!');
    }
}