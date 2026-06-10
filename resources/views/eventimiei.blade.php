@extends('layouts.app')
@section('title', 'I miei eventi')
@section('content')
<div style="padding: 30px;">
    <p style="color: #7b2d3e; font-size: 18px;">Ciao {{ Auth::user()->name }}, ecco i tuoi prossimi eventi!</p>

    <h2 style="margin-bottom: 20px;">Biglietti acquistati</h2>
    <div style="display: flex; gap: 20px; flex-wrap: wrap;">
        @php
            $purchases = Auth::user()->purchases()->with('event')->get()->groupBy('event_id');
        @endphp
        @forelse($purchases as $event_id => $gruppo)
            @php $event = $gruppo->first()->event; @endphp
            <div style="background: white; border-radius: 16px; padding: 20px; width: 280px; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
                <img src="{{ $event->immagine === 'default.jpg' ? asset('img/events/default.jpg') : asset('storage/' . $event->immagine) }}" style="width: 100%; border-radius: 8px; height: 140px; object-fit: cover;">
                <p style="font-weight: bold; font-size: 16px; margin: 12px 0 8px;">{{ $event->titolo }}</p>
                <p style="color: #888; font-size: 13px; margin: 4px 0;">
                    <i class="fa-regular fa-calendar"></i> {{ \Carbon\Carbon::parse($event->data)->format('d F Y') }}
                </p>
                <p style="color: #888; font-size: 13px; margin: 4px 0;">
                    <i class="fa-regular fa-clock"></i> {{ $event->orario }}
                </p>
                <p style="color: #888; font-size: 13px; margin: 4px 0;">
                    <i class="fa-solid fa-location-dot"></i> {{ $event->luogo }}
                </p>
                <div style="border-top: 1px solid #f0e6e6; margin-top: 10px; padding-top: 10px;">
                    <p style="color: #a24a5b; font-weight: bold; margin: 4px 0;">
                        <i class="fa-solid fa-ticket"></i> {{ $gruppo->sum('quantita') }} biglietto/i
                    </p>
                    <p style="color: #a24a5b; font-weight: bold; margin: 4px 0;">
                        <i class="fa-regular fa-star"></i> Totale pagato: {{ $gruppo->sum('totale') }}€
                    </p>
                </div>
                <p style="color: #7b2d3e; font-size: 12px; margin-top: 10px; font-style: italic;">
                    Grazie per aver acquistato con noi! 🎉
                </p>
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
            <div style="background: white; border-radius: 16px; padding: 15px; width: 200px; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
                <img src="{{ $attendance->event->immagine === 'default.jpg' ? asset('img/events/default.jpg') : asset('storage/' . $attendance->event->immagine) }}" style="width: 100%; border-radius: 8px; height: 120px; object-fit: cover;">
                <p style="font-weight: bold; margin: 8px 0 4px;">{{ $attendance->event->titolo }}</p>
                <p style="color: #888; font-size: 13px; margin: 4px 0;">
                    <i class="fa-regular fa-calendar"></i> {{ \Carbon\Carbon::parse($attendance->event->data)->format('d F Y') }}
                </p>
                <p style="color: #888; font-size: 13px; margin: 4px 0;">
                    <i class="fa-regular fa-clock"></i> {{ $attendance->event->orario }}
                </p>
                <a href="{{ route('evento.dettaglio', $attendance->event->id) }}" style="display: block; margin-top: 10px; background-color: #7b2d3e; color: white; text-align: center; padding: 8px; border-radius: 8px; text-decoration: none; font-size: 13px;">
                    🎟️ Compra un biglietto ora!
                </a>
            </div>
        @empty
            <p style="color: #888;">Nessun evento</p>
        @endforelse
    </div>
</div>
@endsection