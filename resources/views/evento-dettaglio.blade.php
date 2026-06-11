@extends('layouts.app')
@section('title', $evento->titolo)
@section('content')

@if(session('success'))
<div id="success-msg" style="position: fixed; top: 30px; left: 50%; transform: translateX(-50%); background: #d4edda; color: #155724; padding: 20px 40px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.2); z-index: 9999; font-weight: bold; font-size: 16px;">
     {{ session('success') }}
</div>
<script>setTimeout(function() { document.getElementById('success-msg').style.display = 'none'; }, 3000);</script>
@endif

<div style="padding: 30px; max-width: 900px; margin: auto;">
    <h2 style="margin-bottom: 20px;">Acquista i tuoi biglietti!</h2>

    {{-- Card evento --}}
    <div style="background: #f7f3f3; border-radius: 16px; padding: 20px; display: flex; gap: 20px; align-items: center; margin-bottom: 30px;">
        <img src="{{ $evento->immagine === 'default.jpg' ? asset('img/events/default.jpg') : asset('img/events/' . $evento->immagine) }}" alt="{{ $evento->titolo }}" style="width: 200px; height: 130px; object-fit: cover; border-radius: 12px;">
        <h2 style="font-size: 24px; font-weight: normal;">{{ $evento->titolo }}</h2>
    </div>

    <div style="display: flex; gap: 30px;">
        {{-- Dettagli evento --}}
        <div style="flex: 1; background: #f7f3f3; border-radius: 16px; padding: 25px;">
            <h4 style="color: #a24a5b; margin-bottom: 15px;">DETTAGLI EVENTO</h4>
            <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 12px; font-size: 14px; color: #444;">
                <li><i class="fa-regular fa-calendar"></i> <strong>Data</strong><br>{{ \Carbon\Carbon::parse($evento->data)->format('d F Y') }}</li>
                <li><i class="fa-regular fa-clock"></i> <strong>Orario</strong><br>{{ $evento->orario }}</li>
                <li><i class="fa-solid fa-location-dot"></i> <strong>Luogo</strong><br>{{ $evento->luogo }}</li>
                <li><i class="fa-regular fa-user"></i> <strong>Posti disponibili</strong><br>{{ $evento->posti_disponibili }}</li>
                <li><i class="fa-regular fa-star"></i> <strong>Costo</strong><br>
                    @if(isset($evento->prezzo_finale) && (float)$evento->prezzo_finale < (float)$evento->costo)
                        <span style="text-decoration: line-through; color: #888;">{{ $evento->costo }}€</span>
                        <span style="color: #a24a5b; font-weight: bold;">{{ $evento->prezzo_finale }}€ <span style="font-size: 12px;">(-{{ $evento->last_minute_discount_percentage }}%)</span></span>
                    @else
                        {{ $evento->costo == 0 ? 'Gratuito' : $evento->costo . '€' }}
                    @endif
                </li>
                <li><i class="fa-solid fa-users"></i> <strong>Parteciperò</strong><br>{{ $conteggio_partecipanti }} persone intendono partecipare</li>
            </ul>
        </div>
        
        <div style="flex: 1;">
            <h3 style="color: #333; margin-bottom: 10px;">Informazioni sull'evento</h3>
            <p style="color: #555; font-size: 14px; line-height: 1.6; margin-bottom: 25px; background: #fff; padding: 15px; border-radius: 12px; border: 1px solid #eee;">
                {{ $evento->descrizione }}
            </p>

        {{-- Form acquisto --}}
        <div style="flex: 1;">
            @auth
            <form method="POST" action="{{ route('acquista', $evento->id) }}" id="form-acquisto">
                @csrf
                <h3 style="margin-bottom: 15px;">Numero biglietti</h3>
                <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 25px;">
                    <button type="button" onclick="cambiaQ(-1)" style="width: 35px; height: 35px; border-radius: 50%; border: 1px solid #ccc; background: white; font-size: 18px; cursor: pointer;">−</button>
                    <span id="quantita" style="font-size: 18px; font-weight: bold;">1</span>
                    <input type="hidden" name="quantita" id="input-quantita" value="1">
                    <button type="button" onclick="cambiaQ(1)" style="width: 35px; height: 35px; border-radius: 50%; border: 1px solid #ccc; background: white; font-size: 18px; cursor: pointer;">+</button>
                </div>

                <h3 style="margin-bottom: 15px;">Modalità di pagamento</h3>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 25px;">
                    <label style="display: flex; align-items: center; gap: 8px;"><input type="radio" name="pagamento" value="paypal" checked> Paypal</label>
                    <label style="display: flex; align-items: center; gap: 8px;"><input type="radio" name="pagamento" value="klarna"> Klarna</label>
                    <label style="display: flex; align-items: center; gap: 8px;"><input type="radio" name="pagamento" value="carta"> Carta di debito</label>
                    <label style="display: flex; align-items: center; gap: 8px;"><input type="radio" name="pagamento" value="dal_vivo"> Dal vivo</label>
                </div>
                <button type="submit" style="width: 100%; background-color: #a24a5b; color: white; border: none; padding: 14px; border-radius: 25px; font-size: 16px; cursor: pointer;">COMPRA</button>
            </form>

            <form method="POST" action="{{ route('partecipa', $evento->id) }}" style="margin-top: 15px;">
                @csrf
                @php
                    $partecipa = \App\Models\Attendance::where('user_id', Auth::id())->where('event_id', $evento->id)->exists();
                @endphp
                <button type="submit" style="width: 100%; background-color: white; color: #a24a5b; border: 2px solid #a24a5b; padding: 14px; border-radius: 25px; font-size: 16px; cursor: pointer;">
                    {{ $partecipa ? '✅ Parteciperò' : 'Parteciperò' }}
                </button>
            </form>

            @else
            <p>Devi <a href="/login" style="color: #a24a5b;">accedere</a> per acquistare un biglietto.</p>
            @endauth
        </div>
    </div>
</div>

{{-- Modal riepilogo --}}
<div id="modal-riepilogo" style="display:none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 9998; justify-content: center; align-items: center;">
    <div style="background: white; border-radius: 16px; padding: 30px; max-width: 500px; width: 90%;">
        <h2 style="margin-bottom: 20px;">Riepilogo acquisto</h2>
        <div style="background: #f7f3f3; border-radius: 12px; padding: 15px; display: flex; gap: 15px; align-items: center; margin-bottom: 20px;">
            <img src="{{ $evento->immagine === 'default.jpg' ? asset('img/events/default.jpg') : asset('storage/' . $evento->immagine) }}" style="width: 120px; height: 80px; object-fit: cover; border-radius: 8px;">
            <h3>{{ $evento->titolo }}</h3>
        </div>
        <p><i class="fa-regular fa-calendar"></i> <strong>Data:</strong> {{ \Carbon\Carbon::parse($evento->data)->format('d F Y') }}</p>
        <p><i class="fa-regular fa-clock"></i> <strong>Orario:</strong> {{ $evento->orario }}</p>
        <p><i class="fa-solid fa-location-dot"></i> <strong>Luogo:</strong> {{ $evento->luogo }}</p>
        <p style="margin-top: 10px;"><strong>Numero biglietti acquistati</strong><br><span id="riepilogo-quantita">1 biglietto</span></p>
        <p style="margin-top: 10px;"><strong>Modalità di pagamento scelta</strong><br><span id="riepilogo-pagamento">Paypal</span></p>
        <p style="margin-top: 10px;"><strong>Prezzo totale:</strong> <span id="riepilogo-prezzo" style="color: #a24a5b; font-weight: bold;"></span></p>
        <p style="color: #7b2d3e; font-style: italic; margin-top: 10px;">Grazie per aver acquistato con noi! 🎉</p>
        <button onclick="confermaAcquisto()" style="width: 100%; background-color: #a24a5b; color: white; border: none; padding: 14px; border-radius: 25px; font-size: 16px; cursor: pointer; margin-top: 20px;">CHIUDI</button>
    </div>
</div>

<script>
function cambiaQ(val) {
    let q = parseInt(document.getElementById('quantita').innerText) + val;
    if (q < 1) q = 1;
    if (q > {{ $evento->posti_disponibili }}) q = {{ $evento->posti_disponibili }};
    document.getElementById('quantita').innerText = q;
    document.getElementById('input-quantita').value = q;
}

document.getElementById('form-acquisto')?.addEventListener('submit', function(e) {
    e.preventDefault();
    let q = parseInt(document.getElementById('quantita').innerText);
    let p = document.querySelector('input[name="pagamento"]:checked').value;
    let prezzo = {{ isset($evento->prezzo_finale) ? $evento->prezzo_finale : $evento->costo }};
    document.getElementById('riepilogo-quantita').innerText = q + ' biglietto/i';
    document.getElementById('riepilogo-pagamento').innerText = p;
    document.getElementById('riepilogo-prezzo').innerText = (prezzo * q).toFixed(2) + '€';
    document.getElementById('modal-riepilogo').style.display = 'flex';
});

function confermaAcquisto() {
    document.getElementById('modal-riepilogo').style.display = 'none';
    document.getElementById('form-acquisto').submit();
}
</script>

@endsection