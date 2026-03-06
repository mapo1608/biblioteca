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
    .create-background {
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
        text-align: center; 
    }
    
    .table-medieval th {
        color: #ffc107; /* Intestazioni gialle/arancione (warning) */
        font-weight: 900;
        /* Rimuoviamo il bordo inferiore per usare quello della riga */
        border-bottom: 2px solid #ffc107 !important;
    }

    /* Centra il contenuto delle prime tre colonne a sinistra per leggibilità */
    .table-medieval th:not(:last-child),
    .table-medieval td:not(:last-child) {
        text-align: left;
    }

    /* MODIFICA PER CENTRARE I BOTTONI NELLA COLONNA AZIONI (Ultimo TD) */
    .table-medieval td:last-child {
        /* NUOVO: Rimuove tutti i bordi della cella Azioni */
        border: none !important; 
        /* Utilizza Flexbox per centrare orizzontalmente e verticalmente (soprattutto su mobile) */
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column; /* Impila i bottoni in verticale su schermi stretti */
        height: 100%; /* Assicura che il contenitore prenda tutta l'altezza */
        padding: 12px; /* Ripristina il padding per non attaccare i bottoni ai bordi */
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
        .table-medieval td:last-child a {
            padding: 5px 8px; /* Rendi i bottoni più piccoli */
            margin-bottom: 5px;
            display: block;
            width: 100%; /* I bottoni occupano tutta la larghezza della cella per essere più grandi al tocco */
        }
    }
    
    /* Stile per il contenitore del bottone Aggiungi Libro */
    .add-book-container {
        display: flex;
        justify-content: flex-end; /* Sposta il contenuto a destra */
        width: 100%;
        margin-top: 15px; /* Spazio sopra il bottone */
    }
</style>

@section('content')

{{-- Contenitore con Immagine di Sfondo e Centratura --}}
<div class="create-background">
    
    {{-- Rimuoviamo il padding orizzontale dal container per evitare il bordo --}}
    {{-- Rimosso px-0 per ripristinare il padding orizzontale del contenuto --}}
    <div class="container my-5"> 
        
        {{-- TITOLO STILIZZATO (Centrato e con font "Antico Elegante") --}}
        <h1 class="text-center display-3 medieval-font text-warning mb-5">
            Lista Libri
        </h1>

        {{-- Rimosso mx-0 per usare il padding del container e centrato il contenuto --}}
        <div class="row justify-content-center">
            {{-- MODIFICATO: Rimosso col-lg-10 per permettere alla tabella di estendersi fino a col-12 --}}
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table-medieval">
                        <thead>
                            <tr>
                                <th scope="col">Titolo</th>
                                <th scope="col">Autore</th>
                                <th scope="col">Categoria</th>
                                <th scope="col" style="min-width: 150px;">Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($books as $book)
                            <tr>
                                <td>{{ $book->title }}</td>
                                <td>
                                    {{-- LOGICA MODIFICATA PER LA VIRGOLA TRA GLI AUTORI --}}
                                    @foreach ($book->authors as $index => $author)
                                        {{ $author->name }} {{ $author->surname }}
                                        {{-- Aggiunge la virgola e spazio se non è l'ultimo autore --}}
                                        @if (!$loop->last)
                                            , 
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{ $book->category->name }}</td>
                                <td>
                                    <a class="btn btn-medieval btn-sm mb-1 mb-md-0"
                                    href="{{ route('books.show',$book->id) }}">Apri</a>
                                    @if(Auth::user()->role != 3)
                                        <a class="btn btn-medieval btn-sm"
                                        href="{{ route('books.edit',$book->id) }}">Modifica</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                {{-- NUOVO: Bottone Aggiungi libro in basso a destra --}}
                @if(Auth::user()->role != 3)
                <div class="add-book-container">
                    <a class="btn btn-medieval btn-lg" 
                        href="{{ route('books.create') }}">
                        <i class="bi bi-plus-lg"></i> Aggiungi libro
                    </a>
                </div>
                @endif
                
            </div>
        </div>
        
    </div>
</div>

@endsection