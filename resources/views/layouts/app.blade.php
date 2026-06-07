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

            <div class="auth-buttons">
                <a href="#" class="btn btn-primary">ACCEDI</a>
                <a href="#" class="btn btn-outline">REGISTRATI</a>
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