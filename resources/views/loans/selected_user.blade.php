@extends('app')

@section('title')
{{-- TITOLO VUOTO: Il titolo è gestito nel content per la stilizzazione --}}
@endsection

<style>
    /* Inclusione del font in stile "Antico Elegante" */
    @import url('https://fonts.googleapis.com/css2?family=IM+Fell+Double+Pica:wght@700&display=swap');
    
    /* FIX AGGRESSIVO: Rimuove margini e padding globali */
    * {
        box-sizing: border-box;
    }
    
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

    /* STILE PER LO SFONDO (area5.png) */
    .search-background {
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
        flex-direction: column;
        align-items: center;
        padding: 30px 0;
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
    
    /* Stile per il bottone "Seleziona" (Verde) */
    .btn-medieval-select {
        background-color: #28a745 !important; /* Verde */
        border-color: #1e7e34 !important;
        color: #fff !important;
        font-weight: 700;
        text-transform: uppercase;
        transition: all 0.3s ease;
        padding: 5px 15px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.5);
    }
    .btn-medieval-select:hover {
        background-color: #218838 !important;
        border-color: #1c7430 !important;
        box-shadow: 0 0 10px rgba(40, 167, 69, 0.7);
    }
</style>

@section('content')

<div class="search-background">
    
    <div class="container my-5"> 
        
        {{-- TITOLO STILIZZATO --}}
        <h1 class="text-center display-3 medieval-font text-warning mb-5">
            Risultati Ricerca Utente
        </h1>

        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                
                <div class="table-responsive">
                    <table class="table-medieval">
                        <thead>
                            <tr>
                                <th scope="col">Email</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Cognome</th>
                                <th scope="col" style="min-width: 120px;">Azioni</th>
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
                                    <a class="btn btn-medieval-select btn-sm"
                                    href="{{ route('loans.selected_user',$user->id) }}">
                                        Seleziona
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            
                            @if($users->isEmpty())
                                <tr>
                                    <td colspan="4" class="text-center fst-italic py-4">
                                        Nessun utente trovato nel registro.
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
        
    </div>
</div>

@endsection