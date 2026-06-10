@extends('layouts.app')
@section('title', 'Analisi vendite')
@section('content')
<div style="padding: 30px;">
    <h2>Analisi vendite</h2>
    <p style="color: #888; font-size: 14px;">Seleziona un evento per visualizzare i biglietti venduti e la percentuale rispetto ai disponibili.</p>

    <div style="background: white; border-radius: 16px; padding: 25px; margin-top: 20px; max-width: 600px;">
        <h4 style="margin-bottom: 15px;">SELEZIONA UN EVENTO</h4>
        <select id="evento-select" onchange="mostraAnalisi()" style="width: 100%; padding: 12px; border-radius: 8px; background-color: #7b2d3e; color: white; border: none; font-size: 15px; cursor: pointer;">
            <option value="">-- Seleziona --</option>
            @foreach($events as $event)
            <option value="{{ $event->id }}"
                data-venduti="{{ $event->biglietti_venduti }}"
                data-disponibili="{{ $event->posti_disponibili }}"
                data-totale-originale="{{ $event->posti_disponibili + $event->biglietti_venduti }}">
                {{ $event->titolo }}
            </option>
            @endforeach
        </select>

        <div id="risultato" style="display:none; margin-top: 25px;">
            <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                <span>Biglietti venduti: <strong id="venduti">0</strong></span>
                <span>Posti totali: <strong id="totali">0</strong></span>
            </div>
            <div style="background: #f0e6e6; border-radius: 20px; height: 20px; overflow: hidden;">
                <div id="barra" style="background: #7b2d3e; height: 100%; width: 0%; transition: width 0.5s;"></div>
            </div>
            <p style="text-align: center; margin-top: 10px; font-weight: bold; color: #7b2d3e;">
                <span id="percentuale">0</span>% venduto
            </p>
        </div>
    </div>

    {{-- Tabella riassuntiva --}}
    <div style="background: white; border-radius: 16px; padding: 25px; margin-top: 30px;">
        <h4 style="color: #a24a5b; margin-bottom: 20px;">RIEPILOGO VENDITE</h4>
        <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
            <thead>
                <tr style="color: #a24a5b;">
                    <th style="text-align: left; padding: 10px;">Evento</th>
                    <th style="text-align: center; padding: 10px;">Prezzo pieno</th>
                    <th style="text-align: center; padding: 10px;">Biglietti a prezzo pieno</th>
                    <th style="text-align: center; padding: 10px;">Prezzo scontato</th>
                    <th style="text-align: center; padding: 10px;">Biglietti scontati</th>
                    <th style="text-align: right; padding: 10px;">Totale incassi</th>
                </tr>
            </thead>
            <tbody>
                @php $totale_generale = 0; @endphp
                @foreach($events as $event)
                @php
                    $biglietti_pieni = $event->purchases()->where('totale', $event->costo)->count();
                    $biglietti_scontati = $event->purchases()->where('totale', '<', $event->costo)->count();
                    $prezzo_scontato = $event->last_minute_discount_percentage 
                        ? round($event->costo * (1 - $event->last_minute_discount_percentage / 100), 2) 
                        : '-';
                    $totale_evento = $event->purchases()->sum('totale');
                    $totale_generale += $totale_evento;
                @endphp
                <tr style="border-top: 1px solid #f0e6e6;">
                    <td style="padding: 12px 10px;">{{ $event->titolo }}</td>
                    <td style="padding: 12px 10px; text-align: center;">{{ $event->costo }}€</td>
                    <td style="padding: 12px 10px; text-align: center;">{{ $biglietti_pieni }}</td>
                    <td style="padding: 12px 10px; text-align: center;">{{ $prezzo_scontato === '-' ? '-' : $prezzo_scontato . '€' }}</td>
                    <td style="padding: 12px 10px; text-align: center;">{{ $biglietti_scontati }}</td>
                    <td style="padding: 12px 10px; text-align: right;">{{ $totale_evento }}€</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr style="border-top: 2px solid #ddd; font-weight: bold;">
                    <td colspan="5" style="padding: 12px 10px;">TOTALE FINALE</td>
                    <td style="padding: 12px 10px; text-align: right; color: #a24a5b;">{{ $totale_generale }}€</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<script>
function mostraAnalisi() {
    const select = document.getElementById('evento-select');
    const option = select.options[select.selectedIndex];
    if (!option.value) {
        document.getElementById('risultato').style.display = 'none';
        return;
    }
    const venduti = parseInt(option.dataset.venduti);
    const totaleOriginale = parseInt(option.dataset.totaleOriginale);
    const percentuale = totaleOriginale > 0 ? Math.round((venduti / totaleOriginale) * 100) : 0;
    document.getElementById('venduti').innerText = venduti;
    document.getElementById('totali').innerText = totaleOriginale;
    document.getElementById('percentuale').innerText = percentuale;
    document.getElementById('barra').style.width = percentuale + '%';
    document.getElementById('risultato').style.display = 'block';
}
</script>
@endsection