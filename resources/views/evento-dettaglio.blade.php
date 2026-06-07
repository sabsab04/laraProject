@extends('layouts.app')

@section('title', $evento->titolo)

@section('content')
<div style="padding: 30px; max-width: 900px; margin: auto;">

    <div style="background-color: #f7f3f3; padding: 20px; border-radius: 20px; display: flex; gap: 30px; align-items: center; margin-bottom: 30px;">
        <img src="{{ asset('img/events/' . $evento->immagine) }}" alt="{{ $evento->titolo }}" style="border-radius: 15px; width: 350px; height: 220px; object-fit: cover;">
        
        <div>
            <h1 style="font-size: 28px; font-weight: normal; color: #111; margin-bottom: 20px;">
                {!! nl2br(e($evento->titolo)) !!}
            </h1>
            
            <div style="display: flex; gap: 15px; align-items: center;">
                <button style="background-color: #a24a5b; color: white; padding: 12px 25px; border: none; border-radius: 20px; font-size: 14px; cursor: pointer;">Compra biglietto</button>
                <button style="background-color: white; color: #555; padding: 12px 25px; border: 1px solid #ccc; border-radius: 20px; font-size: 14px; cursor: pointer; display: flex; gap: 10px;">
                    Parteciperò <span style="color: #a24a5b; font-weight: bold;">(0)</span>
                </button>
            </div>
        </div>
    </div>

    <div style="display: flex; gap: 40px;">
        
        <div style="flex: 2;">
            <h3 style="color: #a24a5b; font-weight: normal; margin-bottom: 10px;">Descrizione e programma</h3>
            <p style="color: #666; font-size: 15px; line-height: 1.6; margin-bottom: 30px;">
                {{ $evento->descrizione }}
            </p>

            @if($evento->punti_riferimento)
            <h3 style="color: #a24a5b; font-weight: normal; margin-bottom: 10px;">Punti di riferimento</h3>
            <p style="color: #666; font-size: 15px; margin-bottom: 30px;">{{ $evento->punti_riferimento }}</p>
            @endif

            <h3 style="color: #a24a5b; font-weight: normal; margin-bottom: 10px;">Organizzatore</h3>
            <p style="color: #666; font-size: 15px;">{{ $evento->organizzatore }}</p>
        </div>

        <div style="flex: 1; background-color: #f7f3f3; padding: 25px; border-radius: 20px;">
            <h3 style="color: #a24a5b; font-weight: bold; font-size: 16px; margin-bottom: 20px;">DETTAGLI EVENTO</h3>
            
            <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 15px; color: #444; font-size: 14px;">
                <li style="display: flex; gap: 15px;"><i class="fa-regular fa-calendar" style="font-size: 18px;"></i> <div><strong>Data</strong><br>{{ \Carbon\Carbon::parse($evento->data)->format('d mye Y') }}</div></li>
                <li style="display: flex; gap: 15px;"><i class="fa-regular fa-clock" style="font-size: 18px;"></i> <div><strong>Orario</strong><br>{{ $evento->orario }}</div></li>
                <li style="display: flex; gap: 15px;"><i class="fa-solid fa-location-dot" style="font-size: 18px;"></i> <div><strong>Luogo</strong><br>{{ $evento->luogo }}</div></li>
                <li style="display: flex; gap: 15px;"><i class="fa-regular fa-user" style="font-size: 18px;"></i> <div><strong>Posti disponibili</strong><br>{{ $evento->posti_disponibili }}</div></li>
                <li style="display: flex; gap: 15px;"><i class="fa-regular fa-star" style="font-size: 18px;"></i> <div><strong>Costo</strong><br>{{ $evento->costo == 0 ? 'Gratuito' : $evento->costo . '€' }}</div></li>
            </ul>
        </div>

    </div>

</div>
@endsection