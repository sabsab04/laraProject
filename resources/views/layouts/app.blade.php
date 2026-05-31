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
          <li><a href="/"><i class="fa-solid fa-image"></i> Home</a></li>
<li><a href="#"><i class="fa-regular fa-face-smile"></i> Eventi</a></li>
<li><a href="/#sezione-chi-siamo"><i class="fa-solid fa-users"></i> Chi siamo</a></li>
<li><a href="/dove-siamo"><i class="fa-solid fa-location-dot"></i> Dove siamo</a></li>
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
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Prendiamo il contenitore che scorre, i link e le sezioni
            const mainWrapper = document.querySelector('.main-wrapper');
            const navLinks = document.querySelectorAll('.nav-links a');
            const sections = document.querySelectorAll('[id^="sezione-"]');

            mainWrapper.addEventListener('scroll', () => {
                let currentId = 'sezione-home'; // Sezione di default

                // Controlla quale sezione è attualmente visibile
                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    // Se lo scroll supera la cima della sezione (con un po' di margine)
                    if (mainWrapper.scrollTop >= sectionTop - 100) {
                        currentId = section.getAttribute('id');
                    }
                });

                // Rimuovi la classe active da tutti i link e mettila solo a quello giusto
                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === '#' + currentId) {
                        link.classList.add('active');
                    }
                });
            });
        });
    </script>
</body>
</html>