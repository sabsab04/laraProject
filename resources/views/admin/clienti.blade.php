@extends('layouts.app')

@section('content')
<div style="max-width: 900px; margin: 0 auto; font-family: sans-serif;">
    <h2 style="margin-top: 0; color: #333; margin-bottom: 5px; font-size: 24px;">Clienti</h2>
    <p style="color: #777; font-size: 14px; margin-bottom: 30px;">Elimina gli account clienti.</p>

    @if(session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 10px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <div style="display: grid; grid-template-columns: 2fr 1.5fr 2fr 80px; padding: 0 20px; font-weight: bold; color: #a24a5b; margin-bottom: 10px; font-size: 15px;">
        <div>Nome</div>
        <div>Creato il</div>
        <div>Username</div>
        <div></div>
    </div>

    @forelse($clienti as $cliente)
        <div style="display: grid; grid-template-columns: 2fr 1.5fr 2fr 80px; align-items: center; background-color: #f7f3f3; padding: 15px 20px; border-radius: 30px; margin-bottom: 10px; color: #555; font-size: 14px;">
            <div>{{ $cliente->name }} {{ $cliente->surname }}</div>
            <div>{{ $cliente->created_at->format('d/m/Y') }}</div>
            <div>{{ $cliente->username }}</div>
            
            <div style="text-align: right;">
                <form action="{{ route('admin.utenti.destroy', $cliente->id) }}" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare questo cliente?');" style="margin: 0;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background-color: #a24a5b; color: white; border: none; width: 40px; height: 40px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center;">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div style="text-align: center; padding: 20px; color: #777;">Nessun cliente registrato al momento.</div>
    @endforelse

</div>
@endsection