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

    /* STILE PER LO SFONDO (area2.png) */
    .detail-background {
        background: url('{{ asset('images/area2.png') }}') no-repeat center center fixed;
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
    
    /* Contenitore principale del dettaglio */
    .detail-card {
        background-color: rgba(10, 5, 0, 0.85); /* Sfondo scuro per contrasto */
        border: 3px solid #795548; /* Bordo color legno/cuoio */
        border-radius: 12px;
        padding: 40px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.9);
        width: 100%;
        max-width: 600px;
        color: #f5deb3; /* Colore testo crema/antico */
    }

    /* Stile per le righe dei dettagli (come una pergamena o un registro) */
    .detail-row {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px dashed rgba(255, 255, 255, 0.2);
    }
    .detail-row:last-child {
        border-bottom: none;
    }

    /* Colonna del titolo (es. Nome, Cognome) */
    .detail-label {
        color: #ffc107; /* Giallo oro */
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 1px;
        flex: 1;
    }

    /* Colonna del valore (es. Mario Rossi) */
    .detail-value {
        color: #f5deb3;
        flex: 1;
        text-align: right;
        word-break: break-word; /* Gestisce testi lunghi */
    }

    /* Stile per il bottone di eliminazione (pericolo in stile antico) */
    .btn-medieval-danger {
        background-color: #dc3545 !important; 
        border-color: #8b0000 !important; /* Bordeaux scuro */
        color: #f5deb3 !important;
        font-weight: 900;
        text-transform: uppercase;
        transition: all 0.3s ease;
        padding: 8px 16px;
        margin-top: 20px;
        border-radius: 6px;
        letter-spacing: 1px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
    }
    .btn-medieval-danger:hover {
        background-color: #c82333 !important;
        border-color: #8b0000 !important;
        box-shadow: 0 0 15px rgba(220, 53, 69, 0.7);
    }
</style>

@section('content')

<div class="detail-background">
    <div class="detail-card">
        
        {{-- TITOLO PRINCIPALE --}}
        <h1 class="text-center display-5 medieval-font text-warning mb-5">
            Registro dell'Autore
        </h1>
        
        {{-- DETTAGLI AUTORE --}}
        <div class="container-fluid">
            
            <div class="detail-row">
                <div class="detail-label">
                    Nome
                </div>
                <div class="detail-value">
                    {{ $author->name }}
                </div>
            </div>
            
            <div class="detail-row">
                <div class="detail-label">
                    Cognome
                </div>
                <div class="detail-value">
                    {{ $author->surname }}
                </div>
            </div>
            
            <div class="detail-row">
                <div class="detail-label">
                    Email
                </div>
                <div class="detail-value">
                    {{ $author->email }}
                </div>
            </div>
            
            <div class="detail-row">
                <div class="detail-label">
                    Data nascita
                </div>
                <div class="detail-value">
                    {{ $author->birth_date }}
                </div>
            </div>
        </div>
        
        {{-- FORM E BOTTONE DI ELIMINAZIONE --}}
        <div class="text-center mt-4">
            <form id="delete_author_form" action="{{ route('authors.destroy',$author->id) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>

            <button type="button" class="btn btn-sm btn-medieval-danger" 
            onclick="if(confirm('Sei sicuro di voler eliminare questo autore e tutte le sue opere? Non potrai annullare questa azione!')) { document.getElementById('delete_author_form').submit(); }">
            ELIMINA AUTORE
            </button>
        </div>

    </div>
</div>

@endsection