@extends('app')


<style>
    /* Torniamo al font IM Fell Double Pica */
    @import url('https://fonts.googleapis.com/css2?family=IM+Fell+Double+Pica:wght@700&display=swap');
    
    .medieval-font {
        /* Usiamo IM Fell Double Pica. Il browser forzerà il bold se non ha il 700. */
        font-family: 'IM Fell Double Pica', serif; 
        
        /* Forza un peso molto alto. Aggiungo !important per sovrascrivere qualsiasi stile ereditato. */
        font-weight: 900 !important; 
        
        /* Rimosso text-shadow come richiesto */
    }

    /* Stile personalizzato per i bottoni (Corrisponde a btn-warning medievale) */
    .btn-medieval-warning {
        /* AGGIUNTO !important per forzare il colore su eventuali override di Bootstrap */
        background-color: #ffc107 !important; 
        border-color: #ffc107 !important;
        color: #212529 !important; /* Testo scuro, coerente con il bottone "Accedi" */
        font-size: 1.25rem; 
        padding: 10px 20px;
        transition: all 0.3s ease;
        
        /* Applica il Merriweather Bold */
        font-family: 'IM Fell Double Pica', serif; 
        font-weight: 900 !important; /* FORZIAMO IL GRASSETTO */
    }

    .btn-medieval-warning:hover {
        /* AGGIUNTO !important per forzare il colore al passaggio del mouse */
        background-color: #e0a800 !important; /* Tonalità più scura al passaggio */
        border-color: #e0a800 !important;
        transform: translateY(-2px);
    }
    
    /* NUOVO STILE PER LO SFONDO E CENTRATURA */
    .home-background {
        /* Immagine di sfondo specificata */
        background: url('{{ asset('images/area3.png') }}') no-repeat center center;
        background-size: cover; /* Estende l'immagine per coprire l'area */
        
        /* Altezza minima per dare spazio allo sfondo */
        min-height: 80vh; 
        
        /* Centratura verticale dei bottoni */
        display: flex;
        align-items: center; /* Centra verticalmente */
        justify-content: center; /* Centra orizzontalmente (anche se Bootstrap row lo fa già) */
        
        /* Opzionale: Rimuove i margini predefiniti della row/container */
        margin-left: 0;
        margin-right: 0;
        margin-top: -15px;
        padding: 30px 0; /* Padding interno */
    }
</style>

@section('content')

{{-- Contenitore con Immagine di Sfondo e Centratura --}}
<div class="home-background">
    <div class="row justify-content-center w-100">
        <div class="col-12 col-sm-8 col-md-6 col-lg-4">
            {{-- Bottone AUTORI --}}
            <div class="d-grid mb-3">
                <a href="{{ route('authors.index') }}" class="btn btn-medieval-warning medieval-font">
                    <i class="bi bi-people-fill me-2"></i> GESTIONE AUTORI
                </a>
            </div>
            
            {{-- Bottone LIBRI --}}
            <div class="d-grid mb-3">
                <a href="{{ route('books.index') }}" class="btn btn-medieval-warning medieval-font">
                    <i class="bi bi-book-fill me-2"></i> GESTIONE LIBRI
                </a>
            </div>
            
            {{-- Bottone CATEGORIE --}}
            <div class="d-grid mb-3">
                <a href="{{ route('categories.index') }}" class="btn btn-medieval-warning medieval-font">
                    <i class="bi bi-tags-fill me-2"></i> GESTIONE CATEGORIE
                </a>
            </div>
            
            {{-- Bottone PRESTITI --}}
            <div class="d-grid mb-3">
                <a href="{{ route('loans.index') }}" class="btn btn-medieval-warning medieval-font">
                    <i class="bi bi-arrow-left-right me-2"></i> GESTIONE PRESTITI
                </a>
            </div>
            
            {{-- Bottone RICERCA --}}
            <div class="d-grid">
                <a href="{{ route('books.search_view') }}" class="btn btn-medieval-warning medieval-font">
                    <i class="bi bi-search me-2"></i> RICERCA LIBRI
                </a>
            </div>
        </div>
    </div>
</div>
@endsection