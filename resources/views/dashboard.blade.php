@extends('layouts.app')

@section('title', 'Dati personali')

@section('content')
<div style="padding: 30px;">
    <h2 style="color: #7b2d3e; margin-bottom: 20px;">Le tue informazioni</h2>
    
    @if(session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 10px; margin-bottom: 20px; max-width: 400px;">
            {{ session('success') }}
        </div>
    @endif

    <div style="display: flex; align-items: flex-start; gap: 40px;">
        <div style="background: white; border-radius: 16px; padding: 30px; width: 400px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
            <div style="display: flex; gap: 40px; margin-bottom: 20px;">
                <div>
                    <div style="color: #888; font-size: 13px;">Nome</div>
                    <div style="font-weight: 600;">{{ Auth::user()->name ?? '-' }}</div>
                </div>
                <div>
                    <div style="color: #888; font-size: 13px;">Cognome</div>
                    <div style="font-weight: 600;">{{ Auth::user()->surname ?? '-' }}</div>
                </div>
            </div>
            
            <div style="margin-bottom: 20px;">
                <div style="color: #888; font-size: 13px;">Data di nascita</div>
                <div style="font-weight: 600;">
                    {{ Auth::user()->birth_date ? \Carbon\Carbon::parse(Auth::user()->birth_date)->format('d/m/Y') : '-' }}
                </div>
            </div>
            
            <div>
                <div style="color: #888; font-size: 13px;">Nome utente</div>
                <div style="font-weight: 600;">{{ Auth::user()->username ?? '-' }}</div>
            </div>
        </div>
    </div>

    <div style="margin-top: 20px;">
        <a href="{{ url('/dati-personali/modifica') }}" style="background-color: #7b2d3e; color: white; border: none; padding: 12px 30px; border-radius: 8px; font-weight: bold; cursor: pointer; text-decoration: none; display: inline-block;">
            MODIFICA
        </a>
    </div>
</div>
@endsection