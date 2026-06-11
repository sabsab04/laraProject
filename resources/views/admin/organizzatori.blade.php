@extends('layouts.app')

@section('content')
<div style="max-width: 900px; margin: 0 auto; font-family: sans-serif;">
    <h2 style="margin-top: 0; color: #333; margin-bottom: 5px; font-size: 24px;">Organizzatori</h2>
    <p style="color: #777; font-size: 14px; margin-bottom: 20px;">Crea, modifica o elimina gli account organizzatore.</p>

    @if(session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 10px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <div style="margin-bottom: 30px;">
        <a href="{{ route('admin.organizzatori.create') }}" style="background-color: #a24a5b; color: white; text-decoration: none; padding: 10px 20px; border-radius: 20px; font-size: 13px; font-weight: bold; display: inline-block;">
            NUOVO ORGANIZZATORE
        </a>
    </div>

    <div style="display: grid; grid-template-columns: 2fr 2fr 2fr 120px; padding: 0 20px; font-weight: bold; color: #a24a5b; margin-bottom: 10px; font-size: 15px;">
        <div>Nome</div>
        <div>Organizzazione</div>
        <div>Username</div>
        <div style="text-align: right;">Azioni</div>
    </div>

    @forelse($organizzatori as $org)
        <div style="display: grid; grid-template-columns: 2fr 2fr 2fr 120px; align-items: center; background-color: #f7f3f3; padding: 10px 20px; border-radius: 30px; margin-bottom: 10px; color: #555; font-size: 14px;">
            <div>{{ $org->name }} {{ $org->surname }}</div>
            <div>{{ $org->organization ?? 'N/A' }}</div>
            <div>{{ $org->username }}</div>
            
            <div style="display: flex; gap: 10px; justify-content: flex-end;">
                
                <a href="{{ route('admin.organizzatori.edit', $org->id) }}" style="background-color: white; color: #a24a5b; border: 1px solid #ccc; width: 35px; height: 35px; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none;">
                    <i class="fa-solid fa-pen"></i>
                </a>

                <form action="{{ route('admin.utenti.destroy', $org->id) }}" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare questo organizzatore?');" style="margin: 0;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background-color: #a24a5b; color: white; border: none; width: 35px; height: 35px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center;">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div style="text-align: center; padding: 20px; color: #777;">Nessun organizzatore registrato al momento.</div>
    @endforelse

</div>
@endsection