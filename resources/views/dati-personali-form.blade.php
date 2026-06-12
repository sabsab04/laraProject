@extends('layouts.app')

@section('title', 'Modifica Dati Personali')

@section('content')
<div style="padding: 30px;">
    <h2 style="color: #7b2d3e; margin-bottom: 5px;">Modifica i tuoi dati</h2>
    <p style="color: #777; font-size: 14px; margin-bottom: 20px;">Aggiorna le informazioni del tuo profilo.</p>

    @if ($errors->any())
        <div style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 10px; margin-bottom: 20px; max-width: 400px;">
            <ul style="margin: 0; font-size: 13px; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div style="background: white; border-radius: 16px; padding: 30px; width: 400px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
        <form action="{{ url('/dati-personali/modifica') }}" method="POST" style="display: flex; flex-direction: column; gap: 15px;">
            @csrf
            @method('PUT')

            <div>
                <label style="display: block; color: #888; font-size: 13px; margin-bottom: 5px;">Nome</label>
                <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required style="width: 100%; border: 1px solid #ddd; padding: 10px; border-radius: 8px; font-size: 14px; box-sizing: border-box;">
            </div>

            <div>
                <label style="display: block; color: #888; font-size: 13px; margin-bottom: 5px;">Cognome</label>
                <input type="text" name="surname" value="{{ old('surname', Auth::user()->surname) }}" required style="width: 100%; border: 1px solid #ddd; padding: 10px; border-radius: 8px; font-size: 14px; box-sizing: border-box;">
            </div>

            <div>
                <label style="display: block; color: #888; font-size: 13px; margin-bottom: 5px;">Data di nascita</label>
                <input type="date" name="birth_date" value="{{ old('birth_date', Auth::user()->birth_date) }}" required style="width: 100%; border: 1px solid #ddd; padding: 10px; border-radius: 8px; font-size: 14px; box-sizing: border-box;">
            </div>

            <div>
                <label style="display: block; color: #888; font-size: 13px; margin-bottom: 5px;">Nome utente</label>
                <input type="text" name="username" value="{{ old('username', Auth::user()->username) }}" required style="width: 100%; border: 1px solid #ddd; padding: 10px; border-radius: 8px; font-size: 14px; box-sizing: border-box;">
            </div>

            <div style="margin-top: 15px; display: flex; justify-content: space-between; align-items: center;">
                <a href="{{ url('/dati-personali') }}" style="color: #777; text-decoration: none; font-size: 14px; font-weight: bold;">Annulla</a>
                <button type="submit" style="background-color: #7b2d3e; color: white; border: none; padding: 10px 20px; border-radius: 8px; font-weight: bold; cursor: pointer;">
                    SALVA MODIFICHE
                </button>
            </div>
        </form>
    </div>
</div>
@endsection