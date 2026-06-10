@extends('layouts.app')
@section('title', 'Crea Evento')
@section('content')
<div style="padding: 30px;">
<h2>Eventi gestiti</h2>
<h3 style="color: #7b2d3e; margin: 20px 0;">Crea/Modifica evento</h3>
<div style="background: white; border-radius: 12px; padding: 30px; max-width: 600px;">
<form method="POST" action="{{ isset($event) ? route('organizer.update', $event->id) : route('organizer.store') }}" enctype="multipart/form-data">
@csrf
@if(isset($event))
@method('PUT')
@endif
<div style="margin-bottom: 15px;">
<label>Nome</label>
<input type="text" name="titolo" value="{{ $event->titolo ?? '' }}" style="width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;box-sizing:border-box;">
</div>
<div style="display:flex;gap:15px;margin-bottom:15px;">
<div style="flex:1;"><label>Data</label>
<input type="date" name="data" value="{{ $event->data ?? '' }}" style="width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;box-sizing:border-box;"></div>
<div style="flex:1;"><label>Orario</label>
<input type="text" name="orario" value="{{ $event->orario ?? '' }}" placeholder="Es: 10:00 - 12:00" style="width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;box-sizing:border-box;"></div>
</div>
<div style="display:flex;gap:15px;margin-bottom:15px;">
<div style="flex:1;"><label>Prezzo €</label>
<input type="number" name="costo" value="{{ $event->costo ?? '' }}" step="0.01" style="width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;box-sizing:border-box;"></div>
<div style="flex:1;"><label>Posti</label>
<input type="number" name="posti_disponibili" value="{{ $event->posti_disponibili ?? '' }}" style="width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;box-sizing:border-box;"></div>
</div>
<div style="margin-bottom:15px;"><label>Città</label>
<input type="text" name="citta" value="{{ $event->citta ?? '' }}" style="width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;box-sizing:border-box;"></div>
<div style="margin-bottom:15px;"><label>Luogo</label>
<input type="text" name="luogo" value="{{ $event->luogo ?? '' }}" style="width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;box-sizing:border-box;"></div>
<div style="margin-bottom:15px;"><label>Punti di riferimento</label>
<input type="text" name="punti_riferimento" value="{{ $event->punti_riferimento ?? '' }}" style="width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;box-sizing:border-box;"></div>
<div style="margin-bottom:15px;"><label>Descrizione</label>
<textarea name="descrizione" style="width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;box-sizing:border-box;height:100px;">{{ $event->descrizione ?? '' }}</textarea></div>
<div style="margin-bottom:15px;"><label>Immagine</label>
<input type="file" name="immagine" accept="image/*" style="width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;box-sizing:border-box;"></div>
<div style="display:flex;gap:10px;justify-content:flex-end;">
<button type="submit" style="background-color:#7b2d3e;color:white;border:none;padding:12px 30px;border-radius:8px;cursor:pointer;">SALVA</button>
</div>
</form>
</div>
</div>
@endsection
