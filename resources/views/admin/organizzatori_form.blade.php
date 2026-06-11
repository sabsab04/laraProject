@extends('layouts.app')

@section('content')
<div style="max-width: 500px; margin: 0 auto; font-family: sans-serif;">
    
    <h2 style="margin-top: 0; color: #333; margin-bottom: 5px; font-size: 24px;">
        {{ isset($organizzatore) ? 'Modifica Organizzatore' : 'Nuovo Organizzatore' }}
    </h2>
    <p style="color: #777; font-size: 14px; margin-bottom: 30px;">
        {{ isset($organizzatore) ? 'Aggiorna i dati dell\'account.' : 'Crea un nuovo account di livello 3.' }}
    </p>

    @if ($errors->any())
        <div style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 10px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
            <ul style="margin: 0; font-size: 13px; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div style="background-color: #f7f3f3; padding: 30px; border-radius: 25px;">
        <form action="{{ isset($organizzatore) ? route('admin.organizzatori.update', $organizzatore->id) : route('admin.organizzatori.store') }}" method="POST" style="display: flex; flex-direction: column; gap: 15px;">
            @csrf
            
            @if(isset($organizzatore))
                @method('PUT')
            @endif

            <div>
                <label style="display: block; color: #555; font-size: 13px; font-weight: bold; margin-bottom: 8px; margin-left: 5px;">Nome</label>
                <input type="text" name="name" value="{{ old('name', $organizzatore->name ?? '') }}" required style="width: 100%; background-color: white; border: none; padding: 12px 20px; border-radius: 20px; font-size: 14px; box-sizing: border-box;">
            </div>

            <div>
                <label style="display: block; color: #555; font-size: 13px; font-weight: bold; margin-bottom: 8px; margin-left: 5px;">Cognome</label>
                <input type="text" name="surname" value="{{ old('surname', $organizzatore->surname ?? '') }}" required style="width: 100%; background-color: white; border: none; padding: 12px 20px; border-radius: 20px; font-size: 14px; box-sizing: border-box;">
            </div>

            <div>
                <label style="display: block; color: #555; font-size: 13px; font-weight: bold; margin-bottom: 8px; margin-left: 5px;">Organizzazione</label>
                <input type="text" name="organization" value="{{ old('organization', $organizzatore->organization ?? '') }}" required style="width: 100%; background-color: white; border: none; padding: 12px 20px; border-radius: 20px; font-size: 14px; box-sizing: border-box;">
            </div>

            <div>
                <label style="display: block; color: #555; font-size: 13px; font-weight: bold; margin-bottom: 8px; margin-left: 5px;">Username</label>
                <input type="text" name="username" value="{{ old('username', $organizzatore->username ?? '') }}" required style="width: 100%; background-color: white; border: none; padding: 12px 20px; border-radius: 20px; font-size: 14px; box-sizing: border-box;">
            </div>

            <div>
                <label style="display: block; color: #555; font-size: 13px; font-weight: bold; margin-bottom: 8px; margin-left: 5px;">Password {{ isset($organizzatore) ? '(Lascia vuoto per non cambiare)' : '' }}</label>
                <input type="password" name="password" {{ isset($organizzatore) ? '' : 'required' }} style="width: 100%; background-color: white; border: none; padding: 12px 20px; border-radius: 20px; font-size: 14px; box-sizing: border-box;">
            </div>

            <div style="margin-top: 10px; display: flex; justify-content: space-between; align-items: center;">
                <a href="{{ route('admin.organizzatori') }}" style="color: #777; text-decoration: none; font-size: 14px; font-weight: bold;">Annulla</a>
                
                <button type="submit" style="background-color: #a24a5b; color: white; border: none; padding: 12px 30px; border-radius: 20px; font-size: 14px; cursor: pointer; font-weight: bold;">
                    {{ isset($organizzatore) ? 'Salva Modifiche' : 'Crea Organizzatore' }}
                </button>
            </div>

        </form>
    </div>
</div>
@endsection