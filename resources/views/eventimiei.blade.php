@extends('layouts.app')

@section('title', 'I miei eventi')

@section('content')
<div style="padding: 30px;">
    <p style="color: #7b2d3e;">Ciao, Ecco i tuoi prossimi eventi!</p>
    
    <h2 style="margin-bottom: 20px;">Biglietti acquistati</h2>
    <div style="display: flex; gap: 20px; flex-wrap: wrap;">
        @forelse(Auth::user()->purchases ?? [] as $purchase)
        <div style="background: white; border-radius: 16px; padding: 15px; width: 200px;">
            <img src="#" style="width: 100%; border-radius: 8px;">
            <p>{{ $purchase->event->title ?? '-' }}</p>
        </div>
        @empty
        <p style="color: #888;">Nessun biglietto acquistato</p>
        @endforelse
    </div>

    <h2 style="margin: 30px 0 20px;">I tuoi "Parteciperò"</h2>
    <div style="display: flex; gap: 20px; flex-wrap: wrap;">
        @forelse(Auth::user()->attendances ?? [] as $attendance)
        <div style="background: white; border-radius: 16px; padding: 15px; width: 200px;">
            <img src="#" style="width: 100%; border-radius: 8px;">
            <p>{{ $attendance->event->title ?? '-' }}</p>
        </div>
        @empty
        <p style="color: #888;">Nessun evento</p>
        @endforelse
    </div>
</div>
@endsection