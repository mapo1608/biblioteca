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
        color: #ffc107; /* Giallo oro per i titoli */
        text-shadow: 
            -1px -1px 0 #000,  
             1px -1px 0 #000,
            -1px  1px 0 #000,
             1px  1px 0 #000,
             2px  2px 4px rgba(0, 0, 0, 0.8);
    }
    
    /* STILE PER LO SFONDO (area4.png) */
    .detail-background {
        background: url('{{ asset('images/area4.png') }}') no-repeat center center fixed;
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
        align-items: flex-start; /* Allinea in alto */
        padding: 80px 20px;
    }
    
    /* Contenitore principale dei dettagli (Effetto Pergamena) */
    .detail-card {
        background-color: rgba(10, 5, 0, 0.9); /* Sfondo scuro quasi nero */
        border: 4px solid #795548; /* Bordo color legno/cuoio */
        border-radius: 15px;
        padding: 40px;
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.95);
        width: 100%;
        max-width: 600px;
        color: #f5deb3; /* Colore testo crema/antico */
    }

    /* Stile per il titolo della pagina */
    .page-title {
        text-align: center;
        margin-bottom: 30px;
        font-size: 2.2rem;
        text-transform: uppercase;
        padding-bottom: 10px;
        border-bottom: 2px solid #795548;
    }
    
    /* Stile per le righe dei dati (simulazione di linee di testo su pergamena) */
    .data-row {
        margin-bottom: 15px;
        padding: 10px 0;
        border-bottom: 1px solid rgba(121, 85, 72, 0.5); /* Linea sottile di separazione */
    }

    /* Colonna del Titolo/Label (sinistra) */
    .data-label {
        color: #ffc107; /* Oro chiaro */
        font-weight: 900;
        font-family: 'IM Fell Double Pica', serif;
        text-transform: uppercase;
        font-size: 1.1rem;
        text-shadow: 1px 1px 2px #000;
    }

    /* Colonna del Valore (destra) */
    .data-value {
        color: #f5deb3; /* Crema/bianco antico */
        font-size: 1.1rem;
        word-wrap: break-word; /* Assicura che i testi lunghi vadano a capo */
    }

    /* STILI DEI BOTTONI */
    .action-buttons {
        text-align: center;
        margin-top: 30px;
        border-top: 2px solid #795548;
        padding-top: 20px;
        display: flex;
        justify-content: space-around;
        gap: 20px;
    }

    /* Bottone ELIMINA (Rosso 'Pericolo') */
    .btn-medieval-danger {
        background-color: #dc3545 !important; /* Rosso scuro */
        border-color: #c82333 !important; 
        color: #f5deb3 !important; /* Testo crema */
        font-weight: 900;
        text-transform: uppercase;
        transition: all 0.3s ease;
        padding: 12px 30px;
        border-radius: 8px;
        letter-spacing: 2px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.7);
        flex-grow: 1; /* Occupa lo spazio disponibile */
    }
    .btn-medieval-danger:hover {
        background-color: #c82333 !important;
        border-color: #bd2130 !important;
        box-shadow: 0 0 20px rgba(220, 53, 69, 0.8);
    }
    
</style>

@section('content')

<div class="detail-background">
    <div class="detail-card">
        
        <h1 class="page-title medieval-font">{{ __('DETTAGLIO CATEGORIA') }}</h1>

        {{-- Contenuto dei Dettagli --}}
        <div class="container">
            <div class="row data-row">
                <div class="col-12 col-md-4 data-label">
                    Nome
                </div>
                <div class="col-12 col-md-8 data-value">
                    {{ $category->name }}
                </div>
            </div>
            
            <div class="row data-row">
                <div class="col-12 col-md-4 data-label">
                    Descrizione
                </div>
                <div class="col-12 col-md-8 data-value">
                    {{ $category->description }}
                </div>
            </div>
        </div>


        {{-- Sezione Bottoni --}}
        <div class="action-buttons">
            
            {{-- Form per la cancellazione --}}
            <form id="delete_category_form" action="{{ route('categories.destroy',$category->id) }}" method="POST" class="d-none">
                @csrf
                @method('DELETE')
            </form>
            

            {{-- Bottone Elimina --}}
            <button type="button" class="btn btn-medieval-danger" 
            onclick="document.getElementById('delete_category_form').submit();">
                ELIMINA CATEGORIA
            </button>
        </div>
        
    </div>
</div>

@endsection