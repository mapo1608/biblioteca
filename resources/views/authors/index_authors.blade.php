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
        padding: 40px 20px;
    }
    
    /* Stile personalizzato per la tabella */
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
    
    /* Applica lo sfondo scuro alle righe e alle celle con priorità e bordi verticali */
    .table-medieval tr, 
    .table-medieval th, 
    .table-medieval td {
        background-color: transparent !important; /* Le righe usano lo sfondo della tabella */
        border: 1px solid #ffc107 !important; /* Bordi interni gialli (verticali e orizzontali) */
        vertical-align: middle;
        padding: 12px;
        color: #fff; /* Assicura che il testo della tabella sia bianco */
        text-align: center; /* Centra il testo di tutte le celle */
    }
    
    /* NUOVO: Rimuove tutti i bordi dalla colonna Azioni per alleggerire lo stile */
    .table-medieval td:last-child {
        border: none !important;
    }

    .table-medieval th {
        color: #ffc107; /* Intestazioni gialle/arancione (warning) */
        font-weight: 900;
        /* Rimuoviamo il bordo inferiore per usare quello della riga */
        border-bottom: 2px solid #ffc107 !important;
    }
    
    /* Allinea a sinistra le prime due colonne (Nome e Cognome) */
    .table-medieval th:nth-child(1),
    .table-medieval td:nth-child(1),
    .table-medieval th:nth-child(2),
    .table-medieval td:nth-child(2) {
        text-align: left;
    }
    
    /* Rimuove le forzature di centratura flexbox su schermi grandi */
    @media (min-width: 768px) {
        .table-medieval td:last-child {
            display: table-cell; /* Ripristina il display predefinito */
            text-align: center; /* Centra il testo all'interno della cella */
            padding: 12px; /* Ripristina il padding standard */
        }
        
        /* Diamo un po' di margine tra i bottoni su desktop */
        .table-medieval td:last-child a {
            margin: 0 5px;
            display: inline-block !important; 
        }
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
    
    /* Riduce la larghezza della colonna azioni su mobile */
    @media (max-width: 768px) {
        /* I bottoni sono impilati e centrati sul mobile */
        .table-medieval td:last-child {
             text-align: center; 
        }
        .table-medieval td:last-child a {
            padding: 5px 8px; /* Rendi i bottoni più piccoli */
            margin-bottom: 5px;
            display: block;
        }
    }
    
    /* Stile per il contenitore del bottone Aggiungi Autore */
    .add-button-container {
        display: flex;
        justify-content: flex-end; /* Sposta il contenuto a destra */
        width: 100%;
        margin-top: 15px; /* Spazio sopra il bottone */
    }
</style>

@section('content')

{{-- Contenitore con Immagine di Sfondo e Centratura --}}
<div class="create-background">
    
    <div class="container my-5"> 
        
        {{-- TITOLO STILIZZATO (Centrato e con font "Antico Elegante") --}}
        <h1 class="text-center display-3 medieval-font text-warning mb-5">
            Lista Autori
        </h1>

        <div class="row justify-content-center">
            {{-- MODIFICATO: Aggiunta la larghezza massima per centrare e restringere la tabella --}}
            <div class="col-12 col-md-10 col-lg-8">
                <div class="table-responsive">
                    {{-- Tabella con lo stile medievale --}}
                    <table class="table-medieval">
                        <thead>
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Cognome</th>
                                <th scope="col" style="min-width: 150px;">Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($authors as $author)
                            <tr>
                                <td>{{ $author->name }}</td>
                                <td>{{ $author->surname }}</td>
                                {{-- NOTA: La centratura è gestita dal CSS .table-medieval td:last-child --}}
                                <td>
                                    <a class="btn btn-medieval btn-sm mb-1 mb-md-0"
                                    href="{{ route('authors.show',$author->id) }}">Apri</a>
                                    <a class="btn btn-medieval btn-sm"
                                    href="{{ route('authors.edit',$author->id) }}">Modifica</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                {{-- Bottone Aggiungi autore in basso a destra --}}
                <div class="add-button-container">
                    <a class="btn btn-medieval btn-lg" 
                        href="{{ route('authors.create') }}">
                        <i class="bi bi-person-plus-fill me-2"></i> Aggiungi autore
                    </a>
                </div>
                
            </div>
        </div>
        
    </div>
</div>

@endsection