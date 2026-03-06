@extends('app')

@section('title')
{{-- TITOLO VUOTO: Il titolo è gestito nel content per la stilizzazione --}}
@endsection

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
    .create-background {
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
    }
    
    /* Stile personalizzato per la tabella */
    .table-medieval {
        width: 100%; 
        background-color: rgba(0, 0, 0, 0.85) !important;
        color: white;
        border: 2px solid #ffc107 !important;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        margin-bottom: 0;
        border-collapse: collapse;
    }
    
    /* Celle e Righe */
    .table-medieval tr, 
    .table-medieval th, 
    .table-medieval td {
        background-color: transparent !important;
        border: 1px solid #ffc107 !important;
        vertical-align: middle;
        padding: 12px;
        color: #fff;
        text-align: center;
    }
    
    /* Rimuove bordi dalla colonna Azioni */
    .table-medieval td:last-child {
        border: none !important;
        padding-top: 15px !important;
        padding-bottom: 15px !important;
    }

    .table-medieval th {
        color: #ffc107;
        font-weight: 900;
        border-bottom: 2px solid #ffc107 !important;
    }
    
    /* Allineamento a sinistra per le colonne informative */
    .table-medieval th:nth-child(1),
    .table-medieval td:nth-child(1), /* Titolo */
    .table-medieval th:nth-child(2),
    .table-medieval td:nth-child(2), /* Inventario */
    .table-medieval th:nth-child(3),
    .table-medieval td:nth-child(3) { /* Utente */
        text-align: left;
    }
    
    /* Stile per i bottoni */
    .btn-medieval {
        background-color: #ffc107 !important; 
        border-color: #ffc107 !important;
        color: #212529 !important;
        font-weight: 700;
        transition: all 0.3s ease;
    }
    .btn-medieval:hover {
        background-color: #e0a800 !important;
        border-color: #e0a800 !important;
    }
    
    /* Stile per gli stati */
    .status-late {
        color: #dc3545; /* Rosso per ritardo */
        font-weight: bold;
    }
    .status-active {
        color: #198754; /* Verde per in corso */
        font-weight: bold;
    }
    .status-ended {
        color: #adb5bd; /* Grigio per terminato */
        font-style: italic;
    }
</style>

@section('content')

<div class="create-background">
    
    <div class="container my-5"> 
        
        {{-- TITOLO STILIZZATO --}}
        <h1 class="text-center display-3 medieval-font text-warning mb-5">
            Lista Prestiti
        </h1>

        <div class="row justify-content-center">
            <div class="col-12">
                
                <div class="table-responsive">
                    <table class="table-medieval">
                        <thead>
                            <tr>
                                <th scope="col">Titolo</th>
                                <th scope="col">Inventario</th>
                                <th scope="col">Utente</th>
                                <th scope="col">Stato</th>
                                <th scope="col" style="min-width: 100px;">Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($loans as $loan)
                            <tr>
                                {{-- Colonna Titolo --}}
                                <td>
                                    @if(isset($loan->copy))
                                        {{ $loan->copy->book->title }}
                                    @else
                                        <span class="text-danger fst-italic">LIBRO ELIMINATO</span>
                                    @endif
                                </td>

                                {{-- Colonna Inventario --}}
                                <td>
                                    @if(isset($loan->copy))
                                        {{ $loan->copy->inventory }}
                                    @else
                                        <span class="text-danger">---</span>
                                    @endif
                                </td>

                                {{-- Colonna Utente --}}
                                <td>
                                    @if(isset($loan->user))
                                        {{ $loan->user->personal_data->surname . " " . $loan->user->personal_data->name}}
                                    @else
                                        <span class="text-danger fst-italic">UTENTE ELIMINATO</span>
                                    @endif
                                </td>

                                {{-- Colonna Stato --}}
                                <td>
                                    @if($loan->status == true)
                                        @if(date('Y-m-d') > $loan->loan_expiration_date)
                                            <span class="status-late">IN RITARDO</span>
                                        @else
                                            <span class="status-active">IN CORSO</span>
                                        @endif
                                    @else
                                        <span class="status-ended">TERMINATO</span>
                                    @endif
                                </td>

                                {{-- Colonna Azioni (Senza Bordo) --}}
                                <td>
                                    <a class="btn btn-medieval btn-sm"
                                       href="{{ route('loans.show',$loan->id) }}">
                                       Apri
                                    </a>
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