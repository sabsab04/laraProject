<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniFun - @yield('title', 'Home')</title>
    
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <header class="topbar">
        <div class="logo-container">
            <i class="fa-regular fa-calendar-check"></i> UniFun
        </div>
        
        <div class="search-bar">
            <i class="fa-solid fa-bars" style="color: #666; margin-right: 10px;"></i>
            <input type="text" placeholder="Cerca evento">
            <i class="fa-solid fa-magnifying-glass" style="color: #666;"></i>
        </div>
    </header>

    <div class="body-wrapper">
        
        <aside class="sidebar">
         <ul class="nav-links">
          <li><a href="{{ url('/') }}" class="link-home {{ request()->is('/') ? 'active' : '' }}"><i class="fa-regular fa-image"></i> Home</a></li>
          <li><a href="{{ route('eventi') }}" class="{{ request()->routeIs('eventi') || request()->routeIs('evento.dettaglio') ? 'active' : '' }}"><i class="fa-regular fa-face-smile"></i> Eventi</a></li>
          <li><a href="{{ url('/') }}#chi-siamo" class="link-chi-siamo {{ request()->is('/') ? 'active' : '' }}"><i class="fa-solid fa-users"></i> Chi siamo</a></li>
          <li><a href="{{ route('dove-siamo') }}" class="{{ request()->routeIs('dove-siamo') ? 'active' : '' }}"><i class="fa-solid fa-location-dot"></i> Dove siamo</a></li>
          <li><a href="#"><i class="fa-regular fa-envelope"></i> Contatti</a></li>
         </ul>

         @auth
        <ul class="nav-links">
        <li><a href="/eventimiei"><i class="fa-solid fa-music"></i> I miei eventi</a></li>
        <li><a href="/dati-personali"><i class="fa-solid fa-gear"></i> Dati personali</a></li>
       </ul>
        @endauth

<div class="auth-buttons">
    @auth
        <a href="/dashboard" class="btn btn-primary">{{ Auth::user()->email }}</a>
        <form method="POST" action="/logout">
            @csrf
            <button type="submit" class="btn btn-outline">LOG OUT</button>
        </form>
        @if(Auth::user()->role === 'organizzatore')
        <ul class="nav-links" style="margin-top: 10px; border-top: 1px solid #ddd; padding-top: 10px;">
            <li><a href="{{ route('organizer.eventi') }}"><i class="fa-solid fa-music"></i> Eventi</a></li>
            <li><a href="{{ route('organizer.sconti') }}"><i class="fa-solid fa-dollar-sign"></i> Sconti</a></li>
            <li><a href="{{ route('organizer.analisi') }}"><i class="fa-solid fa-chart-line"></i> Analisi vendite</a></li>
            <li><a href="{{ route('organizer.incassi') }}"><i class="fa-solid fa-dollar-sign"></i> Incassi</a></li>
        </ul>
        @endif
    @else
        <a href="/login" class="btn btn-primary">ACCEDI</a>
        <a href="/register" class="btn btn-outline">REGISTRATI</a>
    @endauth
</div>
  </aside>

        <div class="main-wrapper">
            <main class="content">
                @yield('content')
            </main>

            <footer class="footer">
                @2026 univpm - Corso di tecnologie web
            </footer>
        </div>

    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>