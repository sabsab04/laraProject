@extends('layouts.app')

@section('title', 'Eventi gestiti')

@section('content')
@if(session('success'))
<div id="success-msg" style="position: fixed; top: 30px; left: 50%; transform: translateX(-50%); background: #d4edda; color: #155724; padding: 20px 40px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.2); z-index: 9999; font-weight: bold; font-size: 16px;">
    ✅ {{ session('success') }}
</div>
<script>
    setTimeout(function() {
        document.getElementById('success-msg').style.display = 'none';
    }, 3000);
</script>
@endif

<div style="padding: 30px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <div>
            <h2>Eventi gestiti</h2>
            <p style="color: #888; font-size: 14px;">Crea, modifica e elimina i tuoi eventi</p>
        </div>
        <a href="{{ route('organizer.create') }}" style="background-color: #7b2d3e; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: bold;">NUOVO EVENTO</a>
    </div>

    @forelse($events as $event)
    <div style="background: white; border-radius: 12px; padding: 15px; margin-bottom: 15px; display: flex; align-items: center; justify-content: space-between;">
        <div>
            <p style="font-weight: 600;">{{ $event->titolo }}</p>
            <p style="color: #888; font-size: 13px;">{{ $event->data }} - {{ $event->citta }}</p>
        </div>
        <div style="display: flex; gap: 10px;">
            <a href="{{ route('organizer.edit', $event->id) }}" style="background: #f0f0f0; border: none; padding: 8px 12px; border-radius: 8px; cursor: pointer; text-decoration: none;">✏️</a>
            <form method="POST" action="{{ route('organizer.destroy', $event->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" style="background: #7b2d3e; color: white; border: none; padding: 8px 12px; border-radius: 8px; cursor: pointer;">🗑️</button>
            </form>
        </div>
    </div>
    @empty
    <p style="color: #888;">Nessun evento creato ancora.</p>
    @endforelse
</div>
@endsection