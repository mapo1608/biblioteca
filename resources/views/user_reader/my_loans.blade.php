@extends('app')


<style>
    /* Inclusione del font in stile "Antico Elegante" */
    @import url('https://fonts.googleapis.com/css2?family=IM+Fell+Double+Pica:wght@700&display=swap');
    
    
    /* FIX GLOBALE: Garantiamo che l'altezza sia massima per un buon background */
    html, body {
        height: 100%;
        margin: 0 !important; /* Forza la rimozione dei margini */
        padding: 0 !important; /* Forza la rimozione del padding */
        /* Nasconde qualsiasi scorrimento orizzontale in eccesso */
        overflow-x: hidden; 
    }
    
    .medieval-font {
        font-family: 'IM Fell Double Pica', serif; 
        /* Forza un peso alto per il grassetto */
        font-weight: 900 !important; 
        /* Bordo nero attorno al testo per farlo risaltare sullo sfondo */
        text-shadow: 
            -1px -1px 0 #000,  
             1px -1px 0 #000,
            -1px  1px 0 #000,
             1px  1px 0 #000,
             2px  2px 4px rgba(0, 0, 0, 0.8);
    }

    /* STILE PER LO SFONDO E CENTRATURA (area6.png per i prestiti) */
    .list-background {
        /* Immagine di sfondo specificata (area6.png) */
        background: url('{{ asset('images/area6.png') }}') no-repeat center center fixed;
        background-size: cover; /* Estende l'immagine per coprire l'area */
        
        /* Altezza minima forzata al 100% della viewport */
        min-height: 100vh; 

        /* FIX: Tecnica per forzare il riempimento orizzontale a schermo intero (Viewport Width) */
        width: 100vw; 
        position: relative;
        left: 50%;
        right: 50%;
        margin-left: -762px; /* Sposta a sinistra di metà viewport */
        margin-right: -50vw; /* Sposta a destra di metà viewport */
        margin-top: -15px;
        
        /* Centratura verticale/orizzontale del contenuto */
        display: flex;
        flex-direction: column; /* Impila verticalmente */
        align-items: center; /* Centra orizzontalmente */
        
        padding: 30px 0; /* Padding interno */
    }
    
    /* MODIFICATO: Stile personalizzato per la tabella (Come le card di welcome.blade.php) */
    .table-medieval {
        /* Assicuriamo che la tabella occupi il 100% dello spazio del suo contenitore */
        width: 100%; 
        background-color: rgba(0, 0, 0, 0.85) !important; /* Sfondo scuro semi-trasparente (come le card) - FORZATO */
        color: white; /* Testo bianco */
        border: 2px solid #ffc107 !important; /* Bordo esterno giallo */
        border-radius: 8px;
        overflow: hidden; /* Per rispettare il border-radius */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        /* Eliminiamo i margini predefiniti di Bootstrap sulla tabella */
        margin-bottom: 0;
        border-collapse: collapse; /* Assicura che i bordi siano visibili e non doppi */
    }
    
    /* Applica lo sfondo scuro alle righe e alle celle con priorità */
    .table-medieval tr, 
    .table-medieval th, 
    .table-medieval td {
        background-color: transparent !important; /* Le righe usano lo sfondo della tabella */
        /* AGGIUNTO: Aggiunge un bordo laterale (verticale) a celle e intestazioni */
        border: 1px solid #ffc107 !important; 
        vertical-align: middle;
        padding: 12px;
        color: #fff; /* Assicura che il testo della tabella sia bianco */
        /* NUOVO: Centra il contenuto delle celle per coerenza */
        text-align: left; 
    }
    
    .table-medieval th {
        color: #ffc107; /* Intestazioni gialle/arancione (warning) */
        font-weight: 900;
        /* Rimuoviamo il bordo inferiore per usare quello della riga */
        border-bottom: 2px solid #ffc107 !important;
        text-align: center !important; /* Le intestazioni sono centrate */
    }

    /* Stato delle righe per RITARDO/TERMINATO */
    .table-medieval tr.loan-late {
        background-color: rgba(139, 0, 0, 0.7) !important; /* Rosso scuro per i ritardi */
        border-left: 5px solid red !important;
    }
    .status-late {
        color: #FF6347; /* Rosso chiaro per IN RITARDO */
        font-weight: 900;
    }
    .status-active {
        color: #90EE90; /* Verde chiaro per IN CORSO */
    }
    .status-terminated {
        color: #CCCCCC; /* Grigio per TERMINATO */
    }
    .status-deleted {
        color: #ffc107; /* Giallo per elementi non trovati */
        font-style: italic;
    }


    /* MODIFICA PER CENTRARE IL BOTTONE NELLA COLONNA AZIONI (Ultimo TD) */
    .table-medieval td:last-child {
        /* Rimuove i bordi della cella Azioni per un look più pulito */
        border: none !important; 
        /* Utilizza Flexbox per centrare orizzontalmente e verticalmente */
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column; /* Impila i bottoni in verticale su schermi stretti */
        height: 100%; /* Assicura che il contenitore prenda tutta l'altezza */
        padding: 12px; 
        text-align: center !important;
    }
    
    /* Regola lo spazio tra i bottoni */
    @media (min-width: 768px) {
        .table-medieval td:last-child {
            flex-direction: row; /* Su schermi più grandi, allineali orizzontalmente */
        }
        .table-medieval td:last-child a {
            margin: 0 5px; /* Aggiungi margine laterale tra i bottoni */
            display: inline-block !important;
        }
    }
    /* FINE MODIFICA COLONNA AZIONI */

    /* Stile per i bottoni (PROROGA) - Giallo Oro del Portale Lettore */
    .btn-medieval {
        background-color: #D4AF37 !important; /* Giallo Oro Scuro */
        border-color: #A67C00 !important;
        color: #000000 !important;
        font-weight: 700;
        transition: all 0.3s ease;
        padding: 6px 12px;
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5); 
    }
    .btn-medieval:hover {
        background-color: #ffc107 !important; /* Giallo più brillante all'hover */
        border-color: #ffc107 !important;
        transform: translateY(-1px);
    }
    
    /* Riduce la larghezza della colonna azioni su mobile */
    @media (max-width: 768px) {
        .table-medieval td:last-child a {
            padding: 5px 8px; /* Rendi i bottoni più piccoli */
            margin-bottom: 5px;
            display: block;
            width: 100%; 
        }
    }
    
    /* Avviso di ritardo sopra la tabella */
    .alert-late-header {
        background-color: #B22222; /* Rosso mattone */
        color: #FFD700; /* Oro */
        border: 2px solid #FFD700;
        border-radius: 5px;
        padding: 15px;
        margin-bottom: 20px;
        text-align: center;
        font-weight: bold;
        font-size: 1.2rem;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
    }
</style>

@section('content')

{{-- Contenitore con Immagine di Sfondo e Centratura --}}
<div class="list-background w-100">
    
    <div class="container my-5"> 
        
        {{-- TITOLO STILIZZATO (Centrato e con font "Antico Elegante") --}}
        <h1 class="text-center display-3 medieval-font text-warning mb-5">
            LISTA DEI MIEI PRESTITI
        </h1>

        @if($late == true)
            <div class="row">
                <div class="col-12 alert-late-header medieval-font">
                    <i class="bi bi-exclamation-triangle-fill"></i> ATTENZIONE: Hai prestiti in RITARDO!
                </div>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table-medieval">
                        <thead>
                            <tr class="medieval-font">
                                <th scope="col">Titolo</th>
                                <th scope="col">Autore</th>
                                <th scope="col">Inizio</th>
                                <th scope="col">Scadenza</th>
                                <th scope="col" style="min-width: 100px;">Stato</th>
                                <th scope="col" style="min-width: 120px;">Azione</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($loans as $loan)
                            {{-- Controlla se il prestito è in ritardo per applicare la classe di riga --}}
                            @php
                                $isLate = ($loan->status == true && date('Y-m-d') > $loan->loan_expiration_date);
                            @endphp
                            <tr class="{{ $isLate ? 'loan-late' : '' }}">
                                <td>
                                    @if(isset($loan->copy))
                                        {{ $loan->copy->book->title }}
                                    @else
                                        <span class="status-deleted">LIBRO ELIMINATO</span>
                                    @endif
                                </td>
                                <td>
                                    @if(isset($loan->copy))
                                        @foreach ($loan->copy->book->authors as $index => $author)
                                            {{ $author->name }} {{ $author->surname }}
                                            @if (!$loop->last)
                                                , 
                                            @endif
                                        @endforeach
                                    @else
                                        <span class="status-deleted">AUTORE SCONOSCIUTO</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    {{ $loan->loan_start_date }}
                                </td>
                                <td class="text-center">
                                    {{ $loan->loan_expiration_date }}
                                </td>
                                <td class="text-center">
                                    @if($loan->status == true)
                                        @if(date('Y-m-d') > $loan->loan_expiration_date)
                                            <span class="status-late medieval-font">IN RITARDO</span>
                                        @else
                                            <span class="status-active">IN CORSO</span>
                                        @endif
                                    @else
                                        <span class="status-terminated">TERMINATO</span>
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $start = new DateTime($loan->loan_start_date);
                                        $end = new DateTime($loan->loan_expiration_date);
                                        $today = new DateTime(date('Y-m-d'));
                                    @endphp
                                    @if($loan->status == true 
                                        && $end->diff($start)->days < 90
                                        && $end->diff($today)->days <= 5)
                                    <a href="{{ route('extend_loan', $loan->id) }}" class="btn btn-medieval btn-sm">
                                        PROROGA
                                    </a>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
    </div>
</div>

@endsection