@extends('app')

@section('title')
{{-- Il titolo è gestito nel content per la stilizzazione --}}
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
        align-items: flex-start; /* Allinea in alto */
        padding: 40px 20px;
    }
    
    /* Stile personalizzato per la tabella */
    .table-medieval {
        width: 100%; 
        background-color: rgba(0, 0, 0, 0.85) !important;
        color: white;
        border: 2px solid #795548 !important; /* Bordo color legno/cuoio */
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.7);
        margin-bottom: 0;
        border-collapse: collapse;
    }
    
    /* Celle e Righe */
    .table-medieval tr, 
    .table-medieval th, 
    .table-medieval td {
        background-color: transparent !important;
        border: 1px solid #795548 !important; 
        vertical-align: middle;
        padding: 12px;
        color: #f5deb3; /* Testo crema/antico */
        text-align: center;
    }
    
    .table-medieval th {
        color: #ffc107; /* Giallo oro per le intestazioni */
        font-weight: 900;
        border-bottom: 2px solid #ffc107 !important;
    }
    
    /* Contenitore per il titolo e il bottone (RIMOSSO il justify-content: space-between) */
    .header-container {
        width: 100%;
        max-width: 1000px;
        padding: 0 15px;
        margin-bottom: 30px;
        display: flex;
        justify-content: center; /* Centra il titolo */
        align-items: center;
        flex-wrap: wrap; 
    }

    /* Contenitore per la tabella e il pulsante in basso a destra */
    .table-wrapper {
        position: relative;
        padding-bottom: 60px; /* Spazio per il bottone in basso */
    }

    /* Stile per il bottone Aggiungi Utente (Giallo/Oro) */
    .btn-medieval-add {
        background-color: #ffc107 !important; 
        border-color: #e0a800 !important; 
        color: #4b361e !important; 
        font-weight: 900;
        text-transform: uppercase;
        transition: all 0.3s ease;
        padding: 8px 20px;
        border-radius: 6px;
        letter-spacing: 1px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        
        /* POSIZIONAMENTO IN BASSO A DESTRA */
        position: absolute;
        bottom: 0;
        right: 15px; /* Spazio dal bordo destro del contenitore */
        z-index: 10;
    }
    /* Per schermi piccoli, centrato in basso */
    @media (max-width: 768px) {
        .btn-medieval-add {
            position: relative;
            margin-top: 20px;
            right: auto;
            bottom: auto;
            display: block;
            width: 100%;
        }
        .table-wrapper {
            padding-bottom: 0; /* Rimuovi lo spazio extra se il bottone è riposizionato */
        }
    }
    .btn-medieval-add:hover {
        background-color: #e0a800 !important;
        border-color: #c69500 !important;
        box-shadow: 0 0 15px rgba(255, 193, 7, 0.7);
    }

    /* Stili per i bottoni di azione (Apri/Modifica) */
    .btn-medieval-action {
        background-color: #007bff !important; /* Blu per azioni */
        border-color: #0056b3 !important;
        color: #fff !important;
        font-weight: 700;
        padding: 4px 10px;
        margin: 2px;
        border-radius: 4px;
        transition: all 0.3s ease;
    }
    .btn-medieval-action:hover {
        background-color: #0056b3 !important;
        border-color: #004085 !important;
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.7);
    }
    
    /* Stile per la colonna delle Azioni */
    .action-column {
        min-width: 160px; /* Assicura spazio per i due bottoni */
    }

</style>

@section('content')

<div class="create-background">
    
    <div class="container my-5"> 
        
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                
                {{-- HEADER PERSONALIZZATO (Solo per il titolo centrato) --}}
                <div class="header-container">
                    <h1 class="display-3 medieval-font text-warning">
                        {{ __('REGISTRO UTENTI') }}
                    </h1>
                </div>

                <div class="table-wrapper">
                    <div class="table-responsive">
                        <table class="table-medieval">
                            <thead>
                                <tr>
                                    <th scope="col">Email</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Cognome</th>
                                    <th scope="col" class="action-column">Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @isset($user->personal_data->name)
                                            {{ $user->personal_data->name }}
                                        @else
                                            <span class="fst-italic text-muted">-</span>
                                        @endisset
                                    </td>
                                    <td>
                                        @isset($user->personal_data->surname)
                                            {{ $user->personal_data->surname }}
                                        @else
                                            <span class="fst-italic text-muted">-</span>
                                        @endisset
                                    </td>
                                    <td>
                                        <a class="btn btn-medieval-action btn-sm"
                                        href="{{ route('users.show',$user->id) }}">
                                            Apri
                                        </a>
                                        <a class="btn btn-medieval-action btn-sm"
                                        href="{{ route('users.edit',$user->id) }}">
                                            Modifica
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                
                                @if($users->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center fst-italic py-4" style="color:#aaa;">
                                            Nessun utente registrato.
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    {{-- PULSANTE AGGIUNGI UTENTE SPOSTATO IN BASSO A DESTRA --}}
                    <a class="btn btn-medieval-add" href="{{ route('users.create') }}">
                        Aggiungi utente
                    </a>
                </div>
                
            </div>
        </div>
        
    </div>
</div>

@endsection