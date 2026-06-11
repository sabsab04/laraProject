@extends('layouts.app')
@section('title', 'Richieste Organizzatori')
@section('content')
<div style="padding: 30px;">

    @if(session('success'))
    <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
        ✅ {{ session('success') }}
    </div>
    @endif

    <h2 style="margin-bottom: 20px;">Richieste Organizzatori</h2>

    @forelse($richieste as $richiesta)
    <div style="background: white; border-radius: 12px; padding: 20px; margin-bottom: 15px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
        <p><strong>Nome:</strong> {{ $richiesta->name }} {{ $richiesta->surname }}</p>
        <p><strong>Email:</strong> {{ $richiesta->email }}</p>
        <p><strong>Organizzazione:</strong> {{ $richiesta->organization }}</p>
        <p><strong>Data richiesta:</strong> {{ $richiesta->created_at->format('d/m/Y H:i') }}</p>
        <div style="display: flex; gap: 10px; margin-top: 15px;">
            <form method="POST" action="{{ route('admin.richieste.approva', $richiesta->id) }}">
                @csrf
                <button type="submit" style="background: #28a745; color: white; border: none; padding: 8px 20px; border-radius: 8px; cursor: pointer;">✅ Approva</button>
            </form>
            <form method="POST" action="{{ route('admin.richieste.rifiuta', $richiesta->id) }}">
                @csrf
                <button type="submit" style="background: #dc3545; color: white; border: none; padding: 8px 20px; border-radius: 8px; cursor: pointer;">❌ Rifiuta</button>
            </form>
        </div>
    </div>
    @empty
    <p style="color: #888;">Nessuna richiesta in attesa.</p>
    @endforelse

</div>
@endsection