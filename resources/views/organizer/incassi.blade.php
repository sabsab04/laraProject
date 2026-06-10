@extends('layouts.app')
@section('title', 'Incassi')
@section('content')

<div style="padding: 30px;">
    <h2>Incassi</h2>
    <p style="color: #888; font-size: 14px;">Tabella riassuntiva di tutti gli eventi gestiti, con incasso calcolato sui biglietti venduti.</p>

    <div style="background: white; border-radius: 16px; padding: 25px; margin-top: 20px;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="color: #a24a5b; text-align: left; padding: 10px;">Evento</th>
                    <th style="color: #a24a5b; text-align: center; padding: 10px;">Prezzo</th>
                    <th style="color: #a24a5b; text-align: right; padding: 10px;">Totale incassi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                <tr style="border-top: 1px solid #f0e6e6;">
                    <td style="padding: 15px 10px;">{{ $event->titolo }}</td>
                    <td style="padding: 15px 10px; text-align: center;">{{ $event->costo }}€</td>
                    <td style="padding: 15px 10px; text-align: right;">{{ $event->purchases()->sum('totale') }}€</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr style="border-top: 2px solid #ddd;">
                    <td colspan="2" style="padding: 15px 10px; font-weight: bold;">TOTALE</td>
                    <td style="padding: 15px 10px; text-align: right; font-weight: bold;">{{ $totale }}€</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection