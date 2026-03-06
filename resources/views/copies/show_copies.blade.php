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
    
    /* STILE PER LO SFONDO (area1.png) */
    .show-background {
        background: url('{{ asset('images/area1.png') }}') no-repeat center center fixed;
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
        padding: 40px 20px;
    }
    
    /* Contenitore principale (Effetto Pergamena) - Aumentato a 600px */
    .show-card {
        background-color: rgba(10, 5, 0, 0.9); /* Sfondo molto scuro per enfasi */
        border: 4px solid #795548; /* Bordo color legno/cuoio */
        border-radius: 15px;
        padding: 40px;
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.95);
        width: 100%;
        max-width: 600px; /* Larghezza coerente con i form */
        color: #f5deb3; /* Colore testo crema/antico */
    }

    /* Stile per il titolo della pagina */
    .page-title {
        text-align: center;
        margin-bottom: 30px;
        font-size: 2.2rem;
        text-transform: uppercase;
    }

    /* Stile per le righe di dettaglio */
    .detail-row {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px dashed rgba(255, 255, 255, 0.2);
    }

    .detail-label {
        color: #ffc107; /* Oro chiaro per l'etichetta */
        font-weight: 900;
        font-family: 'IM Fell Double Pica', serif;
        text-shadow: 1px 1px 2px #000;
        flex-basis: 40%;
    }

    .detail-value {
        text-align: right;
        flex-basis: 60%;
    }
    
    /* Stili per lo stato (Disponibile/Non disponibile) */
    .status-available {
        color: #28a745; /* Verde scuro */
        font-weight: bold;
    }
    .status-unavailable {
        color: #dc3545; /* Rosso scuro */
        font-weight: bold;
    }

    /* Stili per la condizione */
    .condition-ok {
        color: #28a745; 
    }
    .condition-partial {
        color: #ffc107; /* Giallo */
    }
    .condition-damaged {
        color: #dc3545; 
    }

    /* Contenitore dei pulsanti - CENTRATO E SINGOLO */
    .action-buttons {
        display: flex;
        justify-content: center; /* Centra il contenuto */
        margin-top: 30px;
    }

    /* Stile per il bottone di Eliminazione (stile antico - rosso) */
    .btn-medieval-delete {
        background-color: #dc3545 !important; /* Rosso */
        border-color: #c82333 !important; 
        color: #f5deb3 !important; /* Testo Crema */
        font-weight: 900;
        text-transform: uppercase;
        transition: all 0.3s ease;
        padding: 10px 20px;
        border-radius: 8px;
        letter-spacing: 2px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.7);
        min-width: 250px; /* Assicura che sia ben visibile */
    }
    .btn-medieval-delete:hover {
        background-color: #c82333 !important;
        border-color: #bd2130 !important;
        box-shadow: 0 0 25px rgba(220, 53, 69, 0.7);
    }
</style>

@section('content')

<div class="show-background">
    <div class="show-card">
        
        <h1 class="page-title medieval-font">Dettaglio Copia</h1>

        <!-- Dettagli della Copia -->
        <div class="detail-row">
            <span class="detail-label">Titolo libro</span>
            <span class="detail-value">{{ $copy->book->title }}</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">ISBN libro</span>
            <span class="detail-value">{{ $copy->book->isbn }}</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Inventario</span>
            <span class="detail-value">{{ $copy->inventory }}</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Collocazione</span>
            <span class="detail-value">{{ $copy->position }}</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Data acquisto</span>
            <span class="detail-value">{{ $copy->buy_date }}</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Stato</span>
            <span class="detail-value">
                @if($copy->status == 1)
                    <span class="status-available">Disponibile</span>
                @else
                    <span class="status-unavailable">Non disponibile</span>
                @endif
            </span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Condizione</span>
            <span class="detail-value">
                @if($copy->condition == 1)
                    <span class="condition-ok">OK</span>
                @elseif($copy->condition == 2)
                    <span class="condition-partial">Parzialmente danneggiato</span>
                @else
                    <span class="condition-damaged">Danneggiato</span>
                @endif
            </span>
        </div>

        <!-- Azioni (Solo Elimina - Centrato) -->
        <div class="action-buttons">
            <!-- Form e Pulsante per l'eliminazione -->
            <form id="delete_copy_form" action="{{ route('copies.destroy', $copy->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-medieval-delete">
                    ELIMINA COPIA
                </button>
            </form>
        </div>
        
    </div>
</div>

@endsection

@section('action-buttons')
    {{-- La sezione action-buttons nell'header è stata rimossa e spostata nel contenuto per centralizzare il layout --}}
@endsection
