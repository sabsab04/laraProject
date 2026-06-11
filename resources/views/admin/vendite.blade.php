@extends('layouts.app')

@section('content')
<div style="max-width: 900px; margin: 0 auto; font-family: sans-serif;">
    
    <h2 style="margin-top: 0; color: #333; margin-bottom: 5px; font-size: 24px;">Vendite</h2>
    <p style="color: #777; font-size: 14px; margin-bottom: 30px;">Seleziona un organizzatore per visualizzare biglietti venduti e incasso totale della relativa organizzazione.</p>

    <div style="background-color: #f7f3f3; padding: 40px; border-radius: 25px;">
        
        <form action="{{ route('admin.vendite') }}" method="GET" style="margin-bottom: 30px;">
            <label style="display: block; color: #333; font-size: 14px; font-weight: bold; margin-bottom: 10px; text-transform: uppercase;">Seleziona un'organizzazione</label>
            
            <select name="organizzatore_id" onchange="this.form.submit()" style="background-color: #a24a5b; color: white; border: none; padding: 12px 20px; border-radius: 20px; font-size: 15px; width: 350px; cursor: pointer; outline: none; appearance: auto;">
                <option value="">Seleziona...</option>
                @foreach($organizzatori as $org)
                    <option value="{{ $org->id }}" {{ (isset($selectedOrg) && $selectedOrg->id == $org->id) ? 'selected' : '' }}>
                        {{ $org->organization ?? ($org->name . ' ' . $org->surname) }}
                    </option>
                @endforeach
            </select>
        </form>

        @if($selectedOrg)
            
            <div style="color: #555; font-size: 15px; margin-bottom: 30px; padding-left: 5px;">
                {{ $selectedOrg->name }} {{ $selectedOrg->surname }}
            </div>

            <div style="display: flex; gap: 20px;">
                
                <div style="background-color: white; border-radius: 25px; padding: 30px; flex: 1; display: flex; flex-direction: column; justify-content: center;">
                    <div style="color: #999; font-size: 14px; margin-bottom: 15px;">Biglietti venduti</div>
                    <div style="font-size: 60px; font-weight: bold; color: #000; text-align: center;">
                        {{ $bigliettiVenduti }}
                    </div>
                </div>

                <div style="background-color: #a24a5b; border-radius: 25px; padding: 30px; flex: 1; display: flex; flex-direction: column; justify-content: center;">
                    <div style="color: #e0b0b9; font-size: 14px; margin-bottom: 15px;">Incassi</div>
                    <div style="font-size: 60px; font-weight: bold; color: white; text-align: center;">
                        {{ $incassoTotale }}
                    </div>
                </div>

            </div>
            
        @else
            <div style="color: #999; font-size: 14px; padding-top: 20px;">
                <i class="fa-solid fa-arrow-up"></i> Scegli un'organizzazione dal menu per vedere i dati.
            </div>
        @endif

    </div>
</div>
@endsection