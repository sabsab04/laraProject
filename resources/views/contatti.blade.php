@extends('layouts.app')

@section('title', 'Contatti')

@section('content')
<div style="padding: 40px; max-width: 850px; margin: auto; font-family: sans-serif;">

    <h1 style="font-family: 'Georgia', serif; font-size: 36px; font-weight: normal; color: #000; margin-bottom: 25px;">Contattaci!</h1>

    <div style="margin-bottom: 45px;">
        <h3 style="font-size: 18px; color: #333; font-weight: bold; margin-bottom: 5px;">Sei uno studente e hai bisogno di qualche informazione?</h3>
        <p style="color: #777; font-size: 14px; margin-bottom: 20px;">Scrivici un'email o chiamaci</p>

        <div style="display: flex; gap: 40px; align-items: center;">
            
            <div style="display: flex; align-items: center; gap: 15px;">
                <div style="width: 45px; height: 45px; background-color: #a24a5b; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white;">
                    <i class="fa-solid fa-envelope" style="font-size: 18px;"></i>
                </div>
                <div>
                    <span style="display: block; font-weight: bold; color: #333; font-size: 15px;">Email</span>
                    <a href="mailto:unifun@email.com" style="color: #666; font-size: 14px; text-decoration: underline;">unifun@email.com</a>
                </div>
            </div>

            <div style="display: flex; align-items: center; gap: 15px;">
                <div style="width: 45px; height: 45px; background-color: #a24a5b; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white;">
                    <i class="fa-solid fa-phone" style="font-size: 16px;"></i>
                </div>
                <div>
                    <span style="display: block; font-weight: bold; color: #333; font-size: 15px;">
                        Chiamaci <span style="font-weight: normal; color: #888; font-size: 13px; margin-left: 10px;">lun-ven, 8:00 - 18:00</span>
                    </span>
                    <span style="color: #666; font-size: 14px;">077 - 8534 - 22</span>
                </div>
            </div>

        </div>
    </div>

    <div style="margin-bottom: 20px;">
        <h3 style="font-size: 18px; color: #333; font-weight: bold; margin-bottom: 10px; line-height: 1.4;">
            Sei un'organizzazione e sei interessato<br>a pubblicare i tuoi eventi sul nostro sito?
        </h3>
        
        <p style="color: #777; font-size: 14px; margin-bottom: 5px;">Compila il questionario con</p>
        <ul style="color: #777; font-size: 14px; margin: 0 0 15px 0; padding-left: 20px; line-height: 1.6;">
            <li>Nome</li>
            <li>Cognome</li>
            <li>Email</li>
            <li>Organizzazione di appartenenza</li>
        </ul>
        
        <p style="color: #777; font-size: 14px; margin-bottom: 25px; max-width: 600px; line-height: 1.5;">
            Dopo gli opportuni controlli vi comunicheremo username e password per accedere alla vostra area personale
        </p>
    </div>

@if(session('success'))
    <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 10px; margin-bottom: 20px; max-width: 450px; font-size: 14px;">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 10px; margin-bottom: 20px; max-width: 450px; border: 1px solid #f5c6cb;">
        <strong style="font-size: 14px;">Attenzione, ci sono degli errori:</strong>
        <ul style="font-size: 13px; margin-top: 10px; padding-left: 20px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div style="background-color: #f7f3f3; padding: 30px; border-radius: 25px; max-width: 450px;">
    <form action="{{ route('organizer.request.store') }}" method="POST" style="display: flex; flex-direction: column; gap: 15px;">
        @csrf

        <div>
            <label style="display: block; color: #555; font-size: 13px; font-weight: bold; margin-bottom: 8px; margin-left: 5px;">Nome</label>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="Es: Giulio" required style="width: 100%; background-color: white; border: none; padding: 12px 20px; border-radius: 20px; font-size: 14px; color: #333; box-sizing: border-box;">
            @error('name') <span style="color: red; font-size: 12px; margin-left: 5px;">{{ $message }}</span> @enderror
        </div>

        <div>
            <label style="display: block; color: #555; font-size: 13px; font-weight: bold; margin-bottom: 8px; margin-left: 5px;">Cognome</label>
            <input type="text" name="surname" value="{{ old('surname') }}" placeholder="Es: Bianchi" required style="width: 100%; background-color: white; border: none; padding: 12px 20px; border-radius: 20px; font-size: 14px; color: #333; box-sizing: border-box;">
            @error('surname') <span style="color: red; font-size: 12px; margin-left: 5px;">{{ $message }}</span> @enderror
        </div>

        <div>
            <label style="display: block; color: #555; font-size: 13px; font-weight: bold; margin-bottom: 8px; margin-left: 5px;">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="Es: giuliobianchi@email.org" required style="width: 100%; background-color: white; border: none; padding: 12px 20px; border-radius: 20px; font-size: 14px; color: #333; box-sizing: border-box;">
            @error('email') <span style="color: red; font-size: 12px; margin-left: 5px;">{{ $message }}</span> @enderror
        </div>

        <div>
            <label style="display: block; color: #555; font-size: 13px; font-weight: bold; margin-bottom: 8px; margin-left: 5px;">Organizzazione</label>
            <input type="text" name="organization" value="{{ old('organization') }}" placeholder="Es: Azienda 2" required style="width: 100%; background-color: white; border: none; padding: 12px 20px; border-radius: 20px; font-size: 14px; color: #333; box-sizing: border-box;">
            @error('organization') <span style="color: red; font-size: 12px; margin-left: 5px;">{{ $message }}</span> @enderror
        </div>

        <div style="margin-top: 10px; text-align: right;">
            <button type="submit" style="background-color: #a24a5b; color: white; border: none; padding: 12px 30px; border-radius: 20px; font-size: 14px; cursor: pointer; font-weight: bold;">
                Invia richiesta
            </button>
        </div>

    </form>
</div>

</div>
@endsection