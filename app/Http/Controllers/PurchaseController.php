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

        if ($event->posti_disponibili <= 0) {
            return back()->with('error', 'Nessun posto disponibile!');
        }

        // Calcola il prezzo con eventuale sconto
        $prezzo = (float)$event->costo;
        if ($event->last_minute_days && $event->last_minute_discount_percentage) {
            $giorniMancanti = \Carbon\Carbon::now()->floatDiffInDays(\Carbon\Carbon::parse($event->data));
            if ($giorniMancanti <= $event->last_minute_days) {
                $sconto = $prezzo * ((float)$event->last_minute_discount_percentage / 100);
                $prezzo = round($prezzo - $sconto, 2);
            }
        }

        $quantita = $request->quantita ?? 1;

        Purchase::create([
            'user_id'        => Auth::id(),
            'event_id'       => $event->id,
            'quantita'       => $quantita,
            'totale'         => $prezzo * $quantita,
            'payment_method' => $request->pagamento ?? 'paypal',
            'tickets_count'  => $quantita,
        ]);

        $event->decrement('posti_disponibili', $quantita);

        return back()->with('success', 'Biglietto acquistato con successo!');
    }

    public function miei()
    {
        $purchases = \App\Models\Purchase::where('user_id', Auth::id())
                        ->with('event')
                        ->get();
        return view('eventimiei', compact('purchases'));
    }
}