@extends('layouts.app')
@section('title', 'Eventi')
@section('content')
<div style="padding: 30px; max-width: 900px; margin: auto;">

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px;">
        <div>
            <h1 style="font-size: 32px; font-weight: normal; color: #111;">Eventi disponibili</h1>
            <p style="color: #666; font-size: 16px; margin-top: 5px;">Trova quello più adatto a te</p>
        </div>
        <div style="width: 150px; height: 100px; background-color: #f0e6e6; border-radius: 10px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
            <img src="{{ asset('img/events/eventi.jpg') }}" alt="Eventi" style="width: 100%; height: 100%; object-fit: cover;">
        </div>
    </div>

    {{-- Barra di ricerca --}}
    <form action="{{ route('eventi') }}" method="GET" style="display: flex; align-items: center; background: #f5ecec; padding: 8px 20px; border-radius: 25px; margin-bottom: 30px; box-shadow: 0 2px 8px rgba(0,0,0,0.15); border: 1px solid #d9b8be;">
        <i class="fa-solid fa-magnifying-glass" style="color: #a24a5b; margin-right: 10px;"></i>
        <input type="text" name="ricerca" placeholder="Cerca per città o usa * per cercare nella descrizione..." value="{{ request('ricerca') }}" style="border: none; outline: none; background: transparent; width: 100%; font-size: 14px;">
        <button type="submit" style="background-color: #a24a5b; color: white; border: none; padding: 8px 20px; border-radius: 20px; cursor: pointer; font-size: 13px;">Cerca</button>
    </form>

    @if(request('ricerca'))
    <p style="color: #888; font-size: 14px; margin-bottom: 20px;">
        Risultati per: <strong>{{ request('ricerca') }}</strong>
        <a href="{{ route('eventi') }}" style="color: #a24a5b; margin-left: 10px;">Cancella</a>
    </p>
    @endif

    <hr style="border: none; border-top: 1px solid #e0d5d5; margin-bottom: 30px;">

    @forelse ($eventi as $evento)
    <div style="display: flex; align-items: center; justify-content: space-between; background-color: #f7f3f3; padding: 15px; border-radius: 20px; margin-bottom: 20px;">
        <div style="display: flex; align-items: center; gap: 20px;">
            <img src="{{ $evento->immagine === 'default.jpg' ? asset('img/events/default.jpg') : asset('img/events/' . $evento->immagine) }}" alt="{{ $evento->titolo }}" style="border-radius: 10px; object-fit: cover; width: 200px; height: 120px;">
            <h3 style="font-size: 18px; color: #222; font-weight: 500; max-width: 250px;">
                {{ $evento->titolo }}
            </h3>
        </div>
        <a href="{{ route('evento.dettaglio', $evento->id) }}" style="background-color: #a24a5b; color: white; padding: 10px 30px; border-radius: 20px; text-decoration: none; font-size: 14px; margin-right: 20px;">
            Dettagli
        </a>
    </div>
    @empty
    <p style="text-align: center; color: #888; margin-top: 40px;">Nessun evento trovato.</p>
    @endforelse

    <div style="display: flex; justify-content: center; gap: 10px; margin-top: 40px;">
        <a href="{{ $eventi->appends(['ricerca' => request('ricerca')])->previousPageUrl() ?? '#' }}"
           style="width: 35px; height: 35px; border-radius: 50%; background-color: #d89fa9; color: white; display: flex; align-items: center; justify-content: center; cursor: pointer; text-decoration: none; {{ $eventi->onFirstPage() ? 'opacity: 0.5; pointer-events: none;' : '' }}">
            &lt;
        </a>
        @for ($i = 1; $i <= $eventi->lastPage(); $i++)
        <a href="{{ $eventi->appends(['ricerca' => request('ricerca')])->url($i) }}" ...
           style="width: 35px; height: 35px; border-radius: 50%; background-color: {{ $i == $eventi->currentPage() ? '#a24a5b' : '#d89fa9' }}; color: white; display: flex; align-items: center; justify-content: center; cursor: pointer; text-decoration: none; font-weight: {{ $i == $eventi->currentPage() ? 'bold' : 'normal' }};">
            {{ $i }}
        </a>
        @endfor
        <a href="{{ $eventi->appends(['ricerca' => request('ricerca')])->nextPageUrl() ?? '#' }}"
           style="width: 35px; height: 35px; border-radius: 50%; background-color: #d89fa9; color: white; display: flex; align-items: center; justify-content: center; cursor: pointer; text-decoration: none; {{ !$eventi->hasMorePages() ? 'opacity: 0.5; pointer-events: none;' : '' }}">
            &gt;
        </a>
    </div>

</div>
@endsection