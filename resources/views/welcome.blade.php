@extends('app')

@section('content')

{{-- Inclusione del font esterno (IM Fell Double Pica) --}}
<link href="https://fonts.googleapis.com/css2?family=IM+Fell+Double+Pica&display=swap" rel="stylesheet">


<style>
    /* * Stili per lo sfondo */
    .hero-background {
        /* Immagine con estensione .png */
        background: url('{{ asset('images/biblioteca.png') }}') no-repeat center center fixed;
        background-size: cover;
        min-height: 100vh;
        width: 100%;
        margin-top: -15px;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        padding-top: 50px;
    }

    .content-container {
        /* Rimuovo ogni stile di sfondo/overlay, agisce come un semplice wrapper */
        min-height: 100vh;
        width: 100%;
        color: white; 
    }

        /* * Classe per il font in stile "Antico Elegante" (MODIFICATA) */
    .medieval-font {
        font-family: 'IM Fell Double Pica', serif; 
        font-weight: 400;
        /* NUOVO: Ombra testuale più spessa per simulare il bordino nero */
        text-shadow: 
            -1px -1px 0 #000,  
             1px -1px 0 #000,
            -1px  1px 0 #000,
             1px  1px 0 #000,
             2px  2px 4px rgba(0, 0, 0, 0.8); /* Mantenuto un leggero shadow per profondità */
    }
    
    /* Stili per la galleria orizzontale (MODIFICATI per le frecce) */
    .gallery-container {
        position: relative; /* Contenitore padre per posizionare le frecce in modo assoluto */
        padding: 0 40px; /* Spazio per le frecce laterali */
    }

    .scroll-gallery-wrapper {
        display: block;
        overflow-x: auto;
        white-space: nowrap; 
        padding-bottom: 15px;
        scroll-behavior: smooth; /* NUOVO: Rende lo scorrimento fluido */
        scrollbar-width: none;  
        -ms-overflow-style: none;
    }
    .scroll-gallery-wrapper::-webkit-scrollbar {
        display: none;
    }

    .book-card {
        display: inline-block;
        width: 250px; 
        margin-right: 15px;
        text-align: center;
        vertical-align: top;
        white-space: normal; 
    }
    .book-card img {
        width: 100%;
        height: 350px; 
        object-fit: cover; 
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.5);
    }
    
    /* Stili per le Frecce di Navigazione */
    .scroll-arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0, 0, 0, 0.5);
        color: white;
        border: none;
        padding: 10px;
        z-index: 10;
        cursor: pointer;
        font-size: 2rem;
        transition: background 0.3s;
        border-radius: 50%;
        height: 50px;
        width: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .scroll-arrow:hover {
        background: rgba(0, 0, 0, 0.8);
    }

    #scrollLeft {
        left: 0;
    }

    #scrollRight {
        right: 0;
    }
</style>

<div class="hero-background">
    <div class="content-container">
        
        <div class="container text-center py-5">
            
            {{-- SEZIONE 1: Titolo principale e sottotitolo --}}
            <h1 class="display-1 medieval-font mb-4">
                Benvenuto nella Tana del Libro. <br> Accomodati!
            </h1>
            
            <hr class="w-50 mx-auto border-light">

            <h2 class="medieval-font mt-5 mb-5 fs-2">
                Tanti libri, un solo luogo
            </h2>
            
            <hr class="w-75 mx-auto border-light">
            
            {{-- SEZIONE 2: Galleria di immagini orizzontale scorrevole (AGGIUNTE FRECCE) --}}
            
            <div class="gallery-container my-5">
                
                {{-- Freccia Sinistra --}}
                <button class="scroll-arrow" id="scrollLeft" aria-label="Scorri a sinistra">
                    &#10094; 
                </button>
                
                <div class="scroll-gallery-wrapper" id="bookGallery">
                    
                    {{-- CARD LIBRO 1 --}}
                    <div class="book-card bg-dark p-2 rounded">
                        <img src="{{ asset('images/libro1.png') }}" alt="Copertina Libro 1" class="img-fluid mb-2">
                        <h4 class="fs-5 text-warning">Codice Ombra</h4>
                        <p class="text-white-50 small">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        </p>
                    </div>

                    {{-- CARD LIBRO 2 --}}
                    <div class="book-card bg-dark p-2 rounded">
                        <img src="{{ asset('images/libro2.png') }}" alt="Copertina Libro 2" class="img-fluid mb-2">
                        <h4 class="fs-5 text-warning">Il Signore degli Anelli - La Compagnia dell'Anello</h4>
                        <p class="text-white-50 small">
                            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </p>
                    </div>
                    
                    {{-- CARD LIBRO 3 --}}
                    <div class="book-card bg-dark p-2 rounded">
                        <img src="{{ asset('images/libro3.png') }}" alt="Copertina Libro 3" class="img-fluid mb-2">
                        <h4 class="fs-5 text-warning">Il Signore degli Anelli - Le Due Torri</h4>
                        <p class="text-white-50 small">
                            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                        </p>
                    </div>

                    {{-- CARD LIBRO 4 --}}
                    <div class="book-card bg-dark p-2 rounded">
                        <img src="{{ asset('images/libro4.png') }}" alt="Copertina Libro 4" class="img-fluid mb-2">
                        <h4 class="fs-5 text-warning">Il Signore degli Anelli - Il Ritorno del Re</h4>
                        <p class="text-white-50 small">
                            Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                    </div>

                    {{-- CARD LIBRO 5 --}}
                    <div class="book-card bg-dark p-2 rounded">
                        <img src="{{ asset('images/libro5.png') }}" alt="Copertina Libro 5" class="img-fluid mb-2">
                        <h4 class="fs-5 text-warning">The Celestial Mechanic</h4>
                        <p class="text-white-50 small">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ac felis a diam tempor efficitur eu sed enim. Donec in eros consectetur, luctus elit vel, scelerisque neque.
                        </p>
                    </div>

                    {{-- CARD LIBRO 6 --}}
                    <div class="book-card bg-dark p-2 rounded">
                        <img src="{{ asset('images/libro6.png') }}" alt="Copertina Libro 6" class="img-fluid mb-2">
                        <h4 class="fs-5 text-warning">Whispers of the Forgotten Grove</h4>
                        <p class="text-white-50 small">
                            Proin pharetra aliquam enim, eu egestas diam pulvinar ac. Suspendisse finibus massa in massa cursus, et venenatis erat consectetur.
                        </p>
                    </div>

                    {{-- CARD LIBRO 7 --}}
                    <div class="book-card bg-dark p-2 rounded">
                        <img src="{{ asset('images/libro7.png') }}" alt="Copertina Libro 7" class="img-fluid mb-2">
                        <h4 class="fs-5 text-warning">The Atlas of Lost Stars</h4>
                        <p class="text-white-50 small">
                            Nullam pellentesque tortor nibh, eu convallis justo congue ultrices.
                        </p>
                    </div>

                    {{-- CARD LIBRO 8 --}}
                    <div class="book-card bg-dark p-2 rounded">
                        <img src="{{ asset('images/libro8.png') }}" alt="Copertina Libro 8" class="img-fluid mb-2">
                        <h4 class="fs-5 text-warning">The Whispering Labirinsk</h4>
                        <p class="text-white-50 small">
                            Fusce pulvinar sapien tellus, id gravida magna laoreet ac. Nam vel sapien dictum, tempus mauris in, finibus dui.
                        </p>
                    </div>

                    {{-- CARD LIBRO 9 --}}
                    <div class="book-card bg-dark p-2 rounded">
                        <img src="{{ asset('images/libro9_1.png') }}" alt="Copertina Libro 9" class="img-fluid mb-2">
                        <h4 class="fs-5 text-warning">The Dragon's Echo</h4>
                        <p class="text-white-50 small">
                            Pellentesque porttitor dictum ipsum, sit amet ornare nisi bibendum sed. Pellentesque rhoncus placerat venenatis.
                        </p>
                    </div>

                    {{-- CARD LIBRO 10 --}}
                    <div class="book-card bg-dark p-2 rounded">
                        <img src="{{ asset('images/libro10.png') }}" alt="Copertina Libro 9" class="img-fluid mb-2">
                        <h4 class="fs-5 text-warning">Echoes of the Lumina Crystal</h4>
                        <p class="text-white-50 small">
                            Quisque mauris diam, viverra sit amet placerat vel, malesuada blandit elit. Nam vel bibendum tortor, in facilisis neque.
                        </p>
                    </div>
                    
                </div>
                
                {{-- Freccia Destra --}}
                <button class="scroll-arrow" id="scrollRight" aria-label="Scorri a destra">
                    &#10095; 
                </button>
            
            </div>
            
            <hr class="w-75 mx-auto border-light">

            {{-- SEZIONE 3: Invito al Login --}}
            <h3 class="medieval-font mt-5 mb-4 fs-3">
                Accedi alla tua area personale
            </h3>

            {{-- Il bottone "Accedi" deve puntare alla rotta 'login' --}}
            <a href="{{ route('login') }}" class="btn btn-warning btn-lg medieval-font text-dark">
                <i class="bi bi-person-fill"></i> Accedi
            </a>

        </div>
        
    </div>
</div>

{{-- Il Modal di Bootstrap 5 (mantenuto) --}}
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            {{-- Intestazione del Modal (opzionale, ma consigliata) --}}
            <div class="modal-header">
                <h5 class="modal-title" id="messageModalLabel">ATTENZIONE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Chiudi"></button>
            </div>

            {{-- Corpo del Modal con il Messaggio di Sessione --}}
            <div class="modal-body">
                @php
                    $errorMessage = request()->query('errorMessage');
                @endphp
                @isset($errorMessage)
                    {{ $errorMessage }}
                @endisset
            </div>

            {{-- Footer del Modal con il solo bottone di chiusura --}}
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    {{-- Script JavaScript per mostrare il Modal (mantenuto) --}}
    document.addEventListener('DOMContentLoaded', function () {
        const myModal = document.getElementById('messageModal');
        let errorMessage = null;
        @isset($errorMessage)
            errorMessage = "{{ $errorMessage }}";
        @endisset
        if (errorMessage && myModal) {
            const messageModal = new bootstrap.Modal(myModal);
            messageModal.show();
        }

        {{-- NUOVO SCRIPT: Gestione dello scorrimento con le frecce --}}
        const gallery = document.getElementById('bookGallery');
        const scrollLeftBtn = document.getElementById('scrollLeft');
        const scrollRightBtn = document.getElementById('scrollRight');

        if (gallery && scrollLeftBtn && scrollRightBtn) {
            // Valore di scorrimento: la larghezza di circa due card
            const scrollDistance = 550; 

            scrollLeftBtn.addEventListener('click', function() {
                gallery.scrollBy({
                    left: -scrollDistance, // Scorri indietro
                    behavior: 'smooth'
                });
            });

            scrollRightBtn.addEventListener('click', function() {
                gallery.scrollBy({
                    left: scrollDistance, // Scorri avanti
                    behavior: 'smooth'
                });
            });

            // Opzionale: Mostra/Nascondi le frecce se lo scroll non è necessario (solo su dispositivi desktop/schermi grandi)
            const checkScroll = () => {
                if (gallery.scrollWidth <= gallery.clientWidth) {
                    scrollLeftBtn.style.display = 'none';
                    scrollRightBtn.style.display = 'none';
                } else {
                    scrollLeftBtn.style.display = 'flex'; // Riabilita le frecce per lo scorrimento
                    scrollRightBtn.style.display = 'flex';
                }
            };
            
            // Esegui il controllo iniziale
            checkScroll();

            // Raggruppa l'azione di checkScroll sull'evento resize dello schermo
            window.addEventListener('resize', checkScroll);
        }
    });
</script>


@endsection