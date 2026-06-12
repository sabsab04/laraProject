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
        $quantita = $request->quantita ?? 1;
        
        if ($event->posti_disponibili <= 0 || $quantita > $event->posti_disponibili) {
            return back()->with('error', 'Operazione annullata: i posti per questo evento sono esauriti o insufficienti!');
        }

        $prezzo = (float)$event->costo;
        if ($event->last_minute_days && $event->last_minute_discount_percentage) {
            $giorniMancanti = \Carbon\Carbon::now()->floatDiffInDays(\Carbon\Carbon::parse($event->data));
            if ($giorniMancanti <= $event->last_minute_days) {
                $sconto = $prezzo * ((float)$event->last_minute_discount_percentage / 100);
                $prezzo = round($prezzo - $sconto, 2);
            }
        }

        // Salvataggio nel database
        Purchase::create([
            'user_id'        => Auth::id(),
            'event_id'       => $event->id,
            'quantita'       => $quantita,
            'totale'         => $prezzo * $quantita,
            'payment_method' => $request->pagamento ?? 'paypal',
            // Eliminata la riga tickets_count che causava il crash SQL
        ]);

        // Scala i posti dal totale
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