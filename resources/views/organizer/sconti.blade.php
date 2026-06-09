@extends('layouts.app')
@section('title', 'Sconti')
@section('content')

@if(session('success'))
<div id="success-msg" style="position: fixed; top: 30px; left: 50%; transform: translateX(-50%); background: #d4edda; color: #155724; padding: 20px 40px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.2); z-index: 9999; font-weight: bold; font-size: 16px;">
    ✅ {{ session('success') }}
</div>
<script>setTimeout(function() { document.getElementById('success-msg').style.display = 'none'; }, 3000);</script>
@endif

<div style="padding: 30px;">
    <h2>Sconti Last-Minute</h2>
    <p style="color: #888; font-size: 14px;">Aggiungi sconti last-minute ai tuoi eventi</p>

    @forelse($events as $event)
    <div style="background: white; border-radius: 12px; padding: 20px; margin-bottom: 20px;">
        <h4 style="margin-bottom: 15px;">{{ $event->titolo }}</h4>
        <form method="POST" action="{{ route('organizer.sconti.update', $event->id) }}">
            @csrf
            @method('PUT')
            <div style="display: flex; gap: 15px; align-items: center;">
                <div>
                    <label style="color: #888; font-size: 13px;">Giorni prima</label>
                    <input type="number" name="last_minute_days" value="{{ $event->last_minute_days }}" placeholder="Es: 3" style="width: 100px; padding: 8px; border: 1px solid #ddd; border-radius: 8px; display: block; margin-top: 5px;">
                </div>
                <div>
                    <label style="color: #888; font-size: 13px;">Sconto %</label>
                    <input type="number" name="last_minute_discount_percentage" value="{{ $event->last_minute_discount_percentage }}" placeholder="Es: 20" step="0.01" style="width: 100px; padding: 8px; border: 1px solid #ddd; border-radius: 8px; display: block; margin-top: 5px;">
                </div>
                <div style="margin-top: 20px;">
                    <button type="submit" style="background-color: #7b2d3e; color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer;">SALVA</button>
                </div>
            </div>
        </form>
    </div>
    @empty
    <p style="color: #888;">Nessun evento disponibile.</p>
    @endforelse
</div>
@endsection