<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use Illuminate\Support\Facades\DB;

class OrganizerController extends Controller
{
    public function index()
    {
        $events = Event::where('organizer_id', Auth::id())->get();
        return view('organizer.eventi', compact('events'));
    }

    public function create()
    {
        return view('organizer.crea-evento');
    }

public function store(Request $request)
{

    $request->validate([
        'titolo' => 'required',
        'descrizione' => 'nullable',
        'data' => 'required|date',
        'orario' => 'required',
        'citta' => 'required',
        'luogo' => 'required',
        'costo' => 'required|numeric',
        'posti_disponibili' => 'required|integer',
    ]);



    $immagine = 'default.jpg';
    if ($request->hasFile('immagine')) {
        $immagine = $request->file('immagine')->store('eventi', 'public');
    }
$evento = Event::create([
    'organizer_id' => Auth::id(),
    'titolo' => $request->titolo,
    'descrizione' => $request->descrizione,
    'punti_riferimento' => $request->punti_riferimento ?? '',
    'data' => $request->data,
    'orario' => $request->orario,
    'citta' => $request->citta,
    'luogo' => $request->luogo,
    'costo' => $request->costo,
    'posti_disponibili' => $request->posti_disponibili,
    'immagine' => $immagine,
]);



return redirect()->route('organizer.eventi')->with('success', 'Evento creato con successo!');
   
}



    public function edit($id)
    {
        $event = Event::where('id', $id)->where('organizer_id', Auth::id())->firstOrFail();
        return view('organizer.crea-evento', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $event = Event::where('id', $id)->where('organizer_id', Auth::id())->firstOrFail();
        $event->update($request->all());
        return redirect()->route('organizer.eventi');
    }

    public function destroy($id)
    {
        $event = Event::where('id', $id)->where('organizer_id', Auth::id())->firstOrFail();
        $event->delete();
       return redirect()->route('organizer.eventi')->with('success', 'Evento cancellato con successo!');
        
    }

    public function sconti()
{
    $events = Event::where('organizer_id', Auth::id())->get();
    return view('organizer.sconti', compact('events'));
}

public function updateSconto(Request $request, $id)
{
    $event = Event::where('id', $id)->where('organizer_id', Auth::id())->firstOrFail();
    $event->update([
        'last_minute_days' => $request->last_minute_days,
        'last_minute_discount_percentage' => $request->last_minute_discount_percentage,
    ]);
    return redirect()->route('organizer.sconti')->with('success', 'Sconto aggiornato!');
}
public function incassi()
{
    $events = Event::where('organizer_id', Auth::id())->get();
    $totale = 0;
    return view('organizer.incassi', compact('events', 'totale'));
}

public function analisiVendite()
{
    $events = Event::where('organizer_id', Auth::id())->get();
    
    foreach ($events as $event) {
        $event->biglietti_venduti = $event->purchases()->sum('quantita');
    }
    
    return view('organizer.analisi-vendite', compact('events'));
}

}