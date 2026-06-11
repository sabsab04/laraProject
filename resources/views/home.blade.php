@extends('layouts.app')
@section('title', 'La piattaforma degli studenti')
@section('content')
<div id="sezione-home" style="background-image: url('{{ asset('img/events/sfondo.jpg') }}');
                background-size: cover; 
                background-position: center; 
                height: 350px; 
                border-radius: 15px; 
                padding: 40px; 
                color: white; 
                position: relative;">
<div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.4); border-radius: 15px;"></div>
<div style="position: relative; z-index: 1;">
<h1 style="font-size: 2.5rem; margin-bottom: 10px;">OGNI EVENTO RACCONTA<br>UNA STORIA</h1>
<p style="font-size: 1.2rem; max-width: 400px;">Scopri, partecipa e vivi le migliori esperienze universitarie</p>
</div>
</div>
<div style="margin-top: 40px; display: flex; justify-content: space-between; align-items: center;">
<h3 style="color: #9d4855;">EVENTI PIÙ RECENTI</h3>
<a href="{{ route('eventi') }}" style="color: #666; text-decoration: none; font-size: 14px;">Vedi tutto <i class="fa-solid fa-caret-right"></i></a>
</div>
<div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-top: 20px;">
    @forelse($events as $event)
<a href="{{ route('evento.dettaglio', $event->id) }}" style="text-decoration: none; color: inherit;">
<div style="background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
<img src="{{ $event->immagine === 'default.jpg' ? asset('img/events/default.jpg') : asset('storage/' . $event->immagine) }}" alt="{{ $event->titolo }}" style="width: 100%; height: 150px; object-fit: cover;">
<div style="padding: 15px;">
<h4 style="margin: 0; font-size: 14px; color: #333;">{{ $event->titolo }}</h4>
@if(isset($event->prezzo_finale) && (float)$event->prezzo_finale < (float)$event->costo)
<p style="margin: 5px 0 0 0; color: #888; font-size: 11px; text-decoration: line-through;">€ {{ $event->costo }}</p>
<p style="margin: 0; color: #9d4855; font-weight: bold;">€ {{ $event->prezzo_finale }} <span style="font-size: 11px;">(-{{ $event->last_minute_discount_percentage }}%)</span></p>
@else
<p style="margin: 5px 0 0 0; color: #9d4855; font-weight: bold;">€ {{ $event->costo }}</p>
@endif
<p style="margin: 0; font-size: 12px; color: #666;"><i class="fa-solid fa-location-dot"></i> {{ $event->citta }}</p>
</div>
</div>
</a>
    @empty
<p style="grid-column: span 4; text-align: center; color: #666;">Nessun evento disponibile al momento.</p>
    @endforelse
</div>
<div id="chi-siamo" style="margin-top: 50px; background: white; border-radius: 20px; padding: 40px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
<div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px;">
<i class="fa-solid fa-users" style="font-size: 32px; color: var(--primary-color);"></i>
<h2 style="color: var(--primary-color); margin: 0; font-size: 28px;">Chi siamo</h2>
</div>
<div style="color: #555; line-height: 1.8; font-size: 16px;">
<p style="margin-top: 0;">
<strong>UniFun</strong> è la piattaforma di riferimento per tutti gli eventi legati al mondo universitario e non solo. Nata dall'idea di semplificare la vita degli studenti e di chi vive la città, la nostra missione è connettere le persone attraverso esperienze uniche, concerti, fiere e momenti di aggregazione.
</p>
<p style="margin-bottom: 0;">
            Siamo un team di appassionati di tecnologia e vita sociale, impegnati a garantire che nessun evento passi inosservato. Che tu voglia scoprire il prossimo concerto rock, partecipare a una fiera di ingegneria, o semplicemente trovare l'evento perfetto per la tua serata, UniFun è il posto giusto per te!
</p>
</div>
</div>
@endsection