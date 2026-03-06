@extends('app')


<style>
    /* Inclusione del font in stile "Antico Elegante" */
    @import url('https://fonts.googleapis.com/css2?family=IM+Fell+Double+Pica:wght@700&display=swap');
    
    /* FIX GLOBALE: Altezza massima e rimozione scroll orizzontale */
    html, body {
        height: 100%;
        margin: 0 !important;
        padding: 0 !important;
        overflow-x: hidden; 
    }
    
    .medieval-font {
        font-family: 'IM Fell Double Pica', serif; 
        font-weight: 900 !important; 
        text-shadow: 
            -1px -1px 0 #000,  
             1px -1px 0 #000,
            -1px  1px 0 #000,
             1px  1px 0 #000,
             2px  2px 4px rgba(0, 0, 0, 0.8);
    }

    /* STILE PER LO SFONDO (area6.png) */
    .home-background {
        background: url('{{ asset('images/area6.png') }}') no-repeat center center fixed;
        background-size: cover;
        min-height: 100vh; 
        width: 100vw; 
        position: relative;
        left: 50%;
        right: 50%;
        margin-left: -50vw;
        margin-right: -50vw;
        margin-top: -15px;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 40px 0;
    }
    
    /* Contenitore principale (stile medievale scuro) */
    .home-card {
        background-color: rgba(0, 0, 0, 0.9); /* SCURO COERENTE, più opaco per visibilità */
        color: #f5deb3; /* Testo color crema/pergamena */
        border: 5px solid #795548; /* Bordo spesso color legno */
        border-radius: 10px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.7);
        padding: 40px;
        max-width: 600px;
        width: 90%;
        text-align: center;
    }

    /* Stile per il titolo */
    .portal-title {
        color: #ffc107; /* Giallo/Oro per il titolo */
        margin-bottom: 30px;
        padding-bottom: 15px;
        border-bottom: 3px double #795548; /* Linea decorativa */
        font-weight: bold;
        text-shadow: 1px 1px 2px #000;
        font-size: 2.5rem;
    }
    
    /* STILE PER I BOTTONI (FORZATO COLORE GIALLO E TESTO NERO) */
    .btn-medieval {
        /* Colore di sfondo Giallo Oro nello stato NORMALE */
        background-color: #D4AF37 !important; 
        /* Colore del testo forzato a nero per massima leggibilità */
        color: #000000 !important; 
        border-color: #A67C00; /* Bordo marrone scuro/oro */
        
        font-weight: 900;
        text-transform: uppercase;
        transition: all 0.3s ease;
        padding: 18px 30px; 
        border-radius: 6px;
        letter-spacing: 1.5px;
        margin: 10px 0;
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.6); 
        font-size: 1.25rem; 
        min-width: 250px; 
        display: block; 
    }

    /* Stile al passaggio del mouse (HOVER) */
    .btn-medieval:hover {
        background-color: #ffc107 !important; /* Giallo più brillante all'hover */
        border-color: #A67C00;
        box-shadow: 0 0 15px rgba(255, 193, 7, 0.8);
        transform: translateY(-2px);
        color: #000000 !important; /* Mantieni il testo nero anche all'hover */
    }

    /* Stile per il MODAL (Messaggi di ATTENZIONE) */
    .modal-content-medieval {
        background-color: #212529; /* Sfondo scuro per il modale */
        color: #f5deb3; 
        border: 3px solid #795548;
        border-radius: 8px;
    }
    .modal-header-medieval {
        border-bottom: 2px solid #ffc107; /* Linea divisoria oro */
        background-color: #343a40;
        color: #ffc107;
    }
    .modal-title-medieval {
        font-weight: bold;
        font-size: 1.5rem;
    }
    .modal-body-medieval {
        font-size: 1.1rem;
    }
    .btn-medieval-secondary {
        background-color: #6c757d;
        border-color: #5a6268;
        color: #fff;
    }
    .btn-medieval-secondary:hover {
        background-color: #5a6268;
    }
</style>

@section('content')

<div class="home-background">
    <div class="home-card">
        
        <h1 class="portal-title medieval-font">
            PORTALE DEL LETTORE
        </h1>

        {{-- LAYOUT AGGIORNATO: Bottone uno sotto l'altro --}}
        <div class="row g-4 text-center justify-content-center">
            
            {{-- Colonna che centra il bottone e lo riduce leggermente (8/12) --}}
            <div class="col-12 col-sm-10 col-md-8">
                <a href="{{ route('books.index') }}" class="btn btn-medieval w-100">
                    Sfoglia LIBRI
                </a>
            </div>
            
            <div class="col-12 col-sm-10 col-md-8">
                <a href="{{ route('loans.my_loans') }}" class="btn btn-medieval w-100">
                    I Miei PRESTITI
                </a>
            </div>
            
            <div class="col-12 col-sm-10 col-md-8">
                <a href="{{ route('books.search_view') }}" class="btn btn-medieval w-100">
                    RICERCA Avanzata
                </a>
            </div>
            
        </div>
        
    </div>
</div>

@if(session('trigger_modal') != null)
    {{-- Il Modal di Bootstrap 5 con stile medievale --}}
    <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-content-medieval">
                
                {{-- Intestazione del Modal --}}
                <div class="modal-header modal-header-medieval">
                    <h5 class="modal-title modal-title-medieval" id="messageModalLabel">ATTENZIONE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Chiudi" style="filter: invert(1);"></button>
                </div>

                {{-- Corpo del Modal con il Messaggio di Sessione --}}
                <div class="modal-body modal-body-medieval">
                    @foreach(session('messages') as $message)
                        {{ $message }}<br>
                    @endforeach
                </div>

                {{-- Footer del Modal con il bottone di chiusura --}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-medieval-secondary" data-bs-dismiss="modal">Chiudi</button>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        {{-- Script JavaScript per mostrare il Modal --}}
        document.addEventListener('DOMContentLoaded', function () {
            // Verifica che Bootstrap sia disponibile
            if (typeof bootstrap !== 'undefined' && typeof bootstrap.Modal !== 'undefined') {
                const myModal = document.getElementById('messageModal');
                if (myModal) {
                    // Inizializza il modal di Bootstrap
                    const messageModal = new bootstrap.Modal(myModal);
                    // Mostra il modal
                    messageModal.show();
                }
            } else {
                console.error('Bootstrap 5 non è caricato correttamente o la classe Modal non è disponibile.');
            }
        });
    </script>

@endif

@endsection