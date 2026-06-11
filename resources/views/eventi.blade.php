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
            <img src="{{ asset('img/events/eventi.jpg') }}" alt="Illustrazione Eventi" style="width: 100%; height: 100%; object-fit: cover;">
        </div>
    </div>

    <hr style="border: none; border-top: 1px solid #e0d5d5; margin-bottom: 30px;">

    @foreach ($eventi as $evento)
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
    @endforeach
    

    <div style="display: flex; justify-content: center; gap: 10px; margin-top: 40px;">

        <a href="{{ $eventi->previousPageUrl() ?? '#' }}" 
           style="width: 35px; height: 35px; border-radius: 50%; background-color: #d89fa9; color: white; display: flex; align-items: center; justify-content: center; cursor: pointer; text-decoration: none; {{ $eventi->onFirstPage() ? 'opacity: 0.5; pointer-events: none;' : '' }}">
            &lt;
        </a>

        @for ($i = 1; $i <= $eventi->lastPage(); $i++)
        <a href="{{ $eventi->url($i) }}" 
           style="width: 35px; height: 35px; border-radius: 50%; background-color: {{ $i == $eventi->currentPage() ? '#a24a5b' : '#d89fa9' }}; color: white; display: flex; align-items: center; justify-content: center; cursor: pointer; text-decoration: none; font-weight: {{ $i == $eventi->currentPage() ? 'bold' : 'normal' }};">
            {{ $i }}
        </a>
        @endfor

        <a href="{{ $eventi->nextPageUrl() ?? '#' }}" 
           style="width: 35px; height: 35px; border-radius: 50%; background-color: #d89fa9; color: white; display: flex; align-items: center; justify-content: center; cursor: pointer; text-decoration: none; {{ !$eventi->hasMorePages() ? 'opacity: 0.5; pointer-events: none;' : '' }}">
            &gt;
        </a>

    </div>

</div>
@endsection