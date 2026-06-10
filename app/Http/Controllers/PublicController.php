<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Event;
use Carbon\Carbon;

class PublicController extends Controller
{
   public function home()
{
    $events = Event::latest()->take(4)->get();
    
    foreach ($events as $event) {
        $event->prezzo_finale = (float)$event->costo;
        
        if ($event->last_minute_days && $event->last_minute_discount_percentage) {
            $giorniMancanti = \Carbon\Carbon::now()->floatDiffInDays(\Carbon\Carbon::parse($event->data));
            
            if ($giorniMancanti <= $event->last_minute_days) {
                $sconto = (float)$event->costo * ((float)$event->last_minute_discount_percentage / 100);
                $event->prezzo_finale = round((float)$event->costo - $sconto, 2);
            }
        }
    }
    
    return view('home', compact('events'));
}
}