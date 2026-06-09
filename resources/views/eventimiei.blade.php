@extends('layouts.app')
@section('title', 'I miei eventi')
@section('content')
<div style="padding: 30px;">
    <p style="color: #7b2d3e;">Ciao {{ Auth::user()->name }}, ecco i tuoi prossimi eventi!</p>

    <h2 style="margin-bottom: 20px;">Biglietti acquistati</h2>
    <div style="display: flex; gap: 20px; flex-wrap: wrap;">
        @php
            $purchases = Auth::user()->purchases()->with('event')->get()->groupBy('event_id');
        @endphp
        @forelse($purchases as $event_id => $gruppo)
            @php $event = $gruppo->first()->event; @endphp
            <div style="background: white; border-radius: 16px; padding: 15px; width: 200px;">
                <img src="{{ $event->immagine === 'default.jpg' ? asset('img/events/default.jpg') : asset('storage/' . $event->immagine) }}" style="width: 100%; border-radius: 8px; height: 120px; object-fit: cover;">
                <p style="font-weight: bold; margin: 8px 0 4px;">{{ $event->titolo }}</p>
                <p style="color: #a24a5b; margin: 0;">{{ $gruppo->sum('quantita') }} biglietto/i</p>
            </div>
        @empty
            <p style="color: #888;">Nessun biglietto acquistato</p>
        @endforelse
    </div>

    <h2 style="margin: 30px 0 20px;">I tuoi "Parteciperò"</h2>
    <div style="display: flex; gap: 20px; flex-wrap: wrap;">
        @php
            $attendances = Auth::user()->attendances()->with('event')->get();
        @endphp
        @forelse($attendances as $attendance)
            <div style="background: white; border-radius: 16px; padding: 15px; width: 200px;">
                <img src="{{ $attendance->event->immagine === 'default.jpg' ? asset('img/events/default.jpg') : asset('storage/' . $attendance->event->immagine) }}" style="width: 100%; border-radius: 8px; height: 120px; object-fit: cover;">
                <p style="font-weight: bold; margin: 8px 0 4px;">{{ $attendance->event->titolo }}</p>
            </div>
        @empty
            <p style="color: #888;">Nessun evento</p>
        @endforelse
    </div>
</div>
@endsection