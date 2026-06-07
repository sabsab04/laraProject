@extends('layouts.app')

@section('title', 'Dove siamo')

@section('content')
<div style="padding: 20px;">
    
    <h2 style="font-size: 28px; color: #333; margin-bottom: 30px; font-weight: normal;">Dove siamo?</h2>

    <div style="width: 100%; max-width: 800px; height: 400px; border-radius: 5px; overflow: hidden; margin-bottom: 30px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
        <iframe 
         src="https://maps.google.com/maps?q=Via+Brecce+Bianche+69,+60131+Ancona&t=&z=15&ie=UTF8&iwloc=&output=embed" 
         width="100%" 
         height="100%" 
         style="border:0;" 
         allowfullscreen="" 
         loading="lazy" 
         referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>

    <div style="display: flex; align-items: flex-start; gap: 15px; color: #444; font-size: 16px; line-height: 1.6;">
        <i class="fa-solid fa-location-dot" style="font-size: 20px; color: #555; margin-top: 4px;"></i>
        <div>
            Via Brecce Bianche 69<br>
            60131<br>
            Ancona, Marche, Italy
        </div>
    </div>

</div>
@endsection