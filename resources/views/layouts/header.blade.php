<style>
    /* Inclusione del font per coerenza */
    @import url('https://fonts.googleapis.com/css2?family=IM+Fell+Double+Pica:wght@700&display=swap');

    .medieval-font {
        font-family: 'IM Fell Double Pica', serif; 
        font-weight: 900 !important; 
        text-shadow: 1px 1px 2px #000;
    }

    /* Stile generale per la Navbar */
    .navbar-medieval {
        background-color: rgba(0, 0, 0, 0.95) !important; /* Quasi completamente nero */
        border-bottom: 3px solid #ffc107; /* Bordo giallo/oro */
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.7);
        padding: 10px 0;
    }

    /* Stile per il brand (logo) */
    .navbar-medieval .navbar-brand {
        padding: 0;
    }
    .navbar-medieval .navbar-brand img {
        height: 40px; /* Altezza del logo */
        width: auto;
        border-radius: 5px; /* Angoli leggermente arrotondati */
    }

    /* Stile per i link della navbar (non attivi) */
    .navbar-medieval .nav-link {
        color: #f5deb3 !important; /* Color pergamena */
        font-size: 1.1rem;
        transition: all 0.3s ease;
        padding: 8px 15px !important;
        border-radius: 5px;
        margin: 0 5px;
    }

    /* Stile per i link della navbar all'hover */
    .navbar-medieval .nav-link:hover,
    .navbar-medieval .nav-link:focus {
        color: #ffc107 !important; /* Giallo oro */
        background-color: rgba(255, 193, 7, 0.1); /* Leggero sfondo oro */
    }

    /* Stile per il link attivo (opzionale, basato sulla classe Bootstrap attiva) */
    .navbar-medieval .nav-item.active .nav-link {
        color: #ffc107 !important; 
        font-weight: bold;
    }

    /* Stile per l'icona del Toggler (Menu mobile) */
    .navbar-medieval .navbar-toggler {
        border-color: #ffc107 !important;
        background-color: #212529;
    }
    .navbar-medieval .navbar-toggler-icon {
        filter: invert(1); /* Rende l'icona bianca su sfondo scuro */
    }

    /* Stile per il Dropdown (Menu utente) */
    .navbar-medieval .dropdown-menu {
        background-color: rgba(33, 37, 41, 0.95); /* Sfondo scuro per il menu */
        border: 1px solid #ffc107;
    }
    .navbar-medieval .dropdown-item {
        color: #f5deb3;
        transition: all 0.2s ease;
    }
    .navbar-medieval .dropdown-item:hover,
    .navbar-medieval .dropdown-item:focus {
        background-color: #ffc107;
        color: #000000;
    }

</style>

<nav class="navbar navbar-expand-md navbar-medieval sticky-top">
    <div class="container">
        
        {{-- LOGO BRAND --}}
        @auth
            <a class="navbar-brand" href="{{ url('/home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name', 'Laravel') }} Logo">
            </a>
        @else
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name', 'Laravel') }} Logo">
            </a> 
        @endauth
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            
            {{-- Link Dinamici basati sul Ruolo (Left Side Of Navbar) --}}
            <ul class="navbar-nav me-auto medieval-font">
                @auth
                    {{-- Ruoli Bibliotecario/Amministratore (Role 1 o 2) --}}
                    @if(Auth::user()->role == 1 || Auth::user()->role == 2)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('users.index') }}">{{ __('Utenti') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('authors.index') }}">{{ __('Autori') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('categories.index') }}">{{ __('Categorie') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('books.index') }}">{{ __('Libri') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('loans.index') }}">{{ __('Prestiti') }}</a>
                        </li>
                    @endif

                    {{-- Ruoli Lettore (Role 3) --}}
                    @if(Auth::user()->role == 3)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('books.index') }}">{{ __('Catalogo Libri') }}</a>
                        </li>
      
                    @endif
                @endauth
            </ul>

            {{-- Right Side Of Navbar (Login/Logout/Nome Utente) --}}
            <ul class="navbar-nav ms-auto medieval-font">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Accedi') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Registrati') }}</a>
                        </li>
                    @endif
                @else
                    {{-- Menu Dropdown Utente Autenticato --}}
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            {{-- Link alla home (utile per tornare alla dashboard principale) --}}
                            <a class="dropdown-item" href="{{ url('/home') }}">
                                {{ __('Dashboard') }}
                            </a>
                            
                            {{-- Link Logout --}}
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Esci') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>