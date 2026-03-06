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
        color: #ffc107; /* Colore oro/giallo per il titolo */
        text-shadow: 
            -1px -1px 0 #000, 
             1px -1px 0 #000,
            -1px 1px 0 #000,
             1px 1px 0 #000,
             2px 2px 4px rgba(0, 0, 0, 0.8);
    }

    /* STILE PER LO SFONDO */
    .detail-background {
        background: url('{{ asset('images/area5.png') }}') no-repeat center center fixed;
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
        box-sizing: border-box;
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
    .detail-row:last-of-type {
        border-bottom: none;
    }

    /* Colonna del titolo (es. Nome, Cognome) */
    .detail-label {
        color: #ffc107; /* Giallo oro */
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 1px;
        flex: 1;
        padding-right: 15px;
    }

    /* Colonna del valore (es. Mario Rossi) */
    .detail-value {
        color: #f5deb3;
        flex: 1;
        text-align: right;
        word-break: break-word; /* Gestisce testi lunghi */
        font-weight: 500;
    }

    /* Stile per il bottone di terminazione (pericolo in stile antico) */
    .btn-medieval-danger {
        background-color: #dc3545 !important; 
        border-color: #8b0000 !important; /* Bordeaux scuro */
        color: #f5deb3 !important;
        font-weight: 900;
        text-transform: uppercase;
        transition: all 0.3s ease;
        padding: 10px 20px;
        margin-top: 30px;
        border-radius: 6px;
        letter-spacing: 1px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        display: block; /* Bottone a tutta larghezza se in un contenitore */
        width: 100%;
        max-width: 300px;
        margin-left: auto;
        margin-right: auto;
    }
    .btn-medieval-danger:hover {
        background-color: #c82333 !important;
        border-color: #8b0000 !important;
        box-shadow: 0 0 15px rgba(220, 53, 69, 0.7);
    }
    
    /* Colori speciali per lo stato */
    .status-ritardo {
        color: #ff6347; /* Rosso chiaro */
        font-weight: bold;
    }
    .status-in-corso {
        color: #90ee90; /* Verde chiaro */
        font-weight: bold;
    }
    .status-terminato {
        color: #ccc; /* Grigio/Bianco */
        font-style: italic;
    }
</style>

@section('content')

<div class="detail-background">
    <div class="detail-card">
        
        {{-- TITOLO PRINCIPALE --}}
        <h1 class="text-center display-5 medieval-font mb-5">
            Dettaglio Prestito del Tomo
        </h1>
        
        {{-- DETTAGLI PRESTITO --}}
        <div class="container-fluid p-0">
            
            <div class="detail-row">
                <div class="detail-label">
                    Titolo
                </div>
                <div class="detail-value">
                    @if(isset($loan->copy))
                        {{ $loan->copy->book->title }}
                    @else
                        <span class="status-terminato">{{ __('TOMO RIMOSSO') }}</span>
                    @endif
                </div>
            </div>
            
            <div class="detail-row">
                <div class="detail-label">
                    Inventario
                </div>
                <div class="detail-value">
                    @if(isset($loan->copy))
                        {{ $loan->copy->inventory }}
                    @else
                        <span class="status-terminato">{{ __('TOMO RIMOSSO') }}</span>
                    @endif
                </div>
            </div>
            
            <div class="detail-row">
                <div class="detail-label">
                    Utente
                </div>
                <div class="detail-value">
                    @if(isset($loan->user) && isset($loan->user->personal_data))
                        {{ $loan->user->personal_data->surname . " " . $loan->user->personal_data->name}}
                    @else
                        <span class="status-terminato">{{ __('UTENTE ELIMINATO') }}</span>
                    @endif
                </div>
            </div>
            
            <div class="detail-row">
                <div class="detail-label">
                    Data inizio
                </div>
                <div class="detail-value">
                    {{ $loan->loan_start_date }}
                </div>
            </div>
            
            <div class="detail-row">
                <div class="detail-label">
                    Data scadenza prevista
                </div>
                <div class="detail-value">
                    {{ $loan->loan_expiration_date }}
                </div>
            </div>
            
            <div class="detail-row">
                <div class="detail-label">
                    Data rientro
                </div>
                <div class="detail-value">
                    {{ $loan->loan_real_end_date ?? 'N/D' }}
                </div>
            </div>
            
            <div class="detail-row">
                <div class="detail-label">
                    Stato
                </div>
                <div class="detail-value">
                    @if($loan->status == true)
                        @if(date('Y-m-d') > $loan->loan_expiration_date)
                            <span class="status-ritardo">{{ __('IN RITARDO') }}</span>
                        @else
                            <span class="status-in-corso">{{ __('IN CORSO') }}</span>
                        @endif
                    @else
                        <span class="status-terminato">{{ __('TERMINATO') }}</span>
                    @endif
                </div>
            </div>
            
        </div>
        
        {{-- BOTTONE TERMINA PRESTITO (visibile solo se in corso) --}}
        @if($loan->status == true)
            <div class="text-center">
                {{-- Uso form per il metodo POST sicuro, anche se il link usa GET --}}
                <a href="{{ route('loans.stop_loan',$loan->id) }}" class="btn btn-medieval-danger">
                    {{ __('TERMINA PRESTITO') }}
                </a>
            </div>
        @endif

    </div>
</div>

@endsection