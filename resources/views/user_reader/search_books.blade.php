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

    /* STILE PER LO SFONDO (area6.png) */
    .search-background {
        background: url('{{ asset('images/area6.png') }}') no-repeat center center fixed;
        background-size: cover;
        min-height: 100vh; 
        width: 100vw; 
        position: relative;
        left: 50%;
        right: 50%;
        margin-left: -50vw;
        margin-right: -50vw;
        display: flex;
        justify-content: center;
        align-items: flex-start; /* Allinea in alto */
        padding: 50px 20px;
    }
    
    /* Contenitore principale del modulo */
    .form-container-wrapper {
        background-color: rgba(10, 5, 0, 0.85); /* Sfondo scuro per contrasto */
        border: 3px solid #795548; /* Bordo color legno/cuoio */
        border-radius: 12px;
        padding: 40px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.9);
        width: 100%;
        max-width: 800px;
        color: #f5deb3; /* Colore testo crema/antico */
    }

    /* Titoli interni (Ricerca Semplice / Ricerca Avanzata) */
    .form-container-wrapper h4 {
        color: #ffc107; /* Giallo oro */
        text-transform: uppercase;
        border-bottom: 2px solid #795548;
        padding-bottom: 10px;
        margin-bottom: 20px;
        font-weight: 900;
        letter-spacing: 1.5px;
        font-family: 'IM Fell Double Pica', serif; 
    }

    /* Stile per le etichette (Label) */
    .form-label {
        color: #f5deb3;
        font-weight: bold;
        margin-bottom: 5px;
    }

    /* Stile per i campi di input */
    .form-control {
        background-color: rgba(255, 255, 255, 0.1); 
        border: 1px solid #795548;
        color: #f5deb3;
        border-radius: 4px;
        padding: 10px;
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .form-control:focus {
        background-color: rgba(255, 255, 255, 0.15);
        border-color: #ffc107;
        box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.25);
        color: #fff;
    }
    
    /* Stile per il separatore (hr) */
    hr {
        border-top: 3px solid #795548;
        opacity: 0.8;
        margin: 30px 0;
    }

    /* Stile per i bottoni */
    .btn-medieval {
        background-color: #ffc107 !important; 
        border-color: #ffc107 !important;
        color: #212529 !important;
        font-weight: 900;
        text-transform: uppercase;
        transition: all 0.3s ease;
        padding: 10px 20px;
        margin-top: 20px;
        border-radius: 6px;
        letter-spacing: 1px;
    }
    .btn-medieval:hover {
        background-color: #e0a800 !important;
        border-color: #e0a800 !important;
        box-shadow: 0 0 10px rgba(255, 193, 7, 0.5);
    }
</style>

@section('content')

<div class="search-background">
    <div class="form-container-wrapper">
        
        {{-- TITOLO PRINCIPALE --}}
        <h1 class="text-center display-4 medieval-font text-warning mb-5">
            Mappa del Sapere Perduto
        </h1>
        
        {{-- RICERCA SEMPLICE --}}
        <form action="{{ route('books.search') }}" method="GET" class="my-2">
            @csrf

            <div class="row g-3">
                <div class="col-12">
                    <h4>Ricerca Rapida (Pergamena)</h4>
                </div>
                <div class="col-12">
                    <label for="title" class="form-label">Digita un titolo</label>
                    <input type="text" class="form-control"
                      id="title" name="title" value="{{ old('title', request('title')) }}">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-medieval w-100">
                        Cerca negli scaffali
                    </button>
                </div>
            </div>
        </form>

        <hr>

        {{-- RICERCA AVANZATA --}}
        <form action="{{ route('books.search_advanced') }}" method="GET" class="my-2">
            @csrf

            <div class="row g-3">
                <div class="col-12">
                    <h4>Ricerca Avanzata (Palantir)</h4>
                </div>
                
                {{-- CAMPI PRINCIPALI --}}
                <div class="col-12">
                    <label for="title" class="form-label">Titolo (Parola Chiave)</label>
                    <input type="text" class="form-control"
                      id="title" name="title" value="{{ old('title', request('title')) }}">
                </div>
                <div class="col-md-6 col-12">
                    <label for="isbn" class="form-label">Codice (ISBN/Sigillo)</label>
                    <input type="text" class="form-control"
                      id="isbn" name="isbn" value="{{ old('isbn', request('isbn')) }}">
                </div>
                <div class="col-md-6 col-12">
                    <label for="publish_year" class="form-label">Anno di Pubblicazione</label>
                    <input type="text" class="form-control"
                      id="publish_year" name="publish_year" value="{{ old('publish_year', request('publish_year')) }}">
                </div>
                <div class="col-md-6 col-12">
                    <label for="language" class="form-label">Lingua (Dialetto)</label>
                    <input type="text" class="form-control"
                      id="language" name="language" value="{{ old('language', request('language')) }}">
                </div>
                <div class="col-md-6 col-12">
                    <label for="category" class="form-label">Categoria (Filone del Sapere)</label>
                    <input type="text" class="form-control"
                      id="category" name="category" value="{{ old('category', request('category')) }}">
                </div>

                {{-- AUTORE --}}
                <div class="col-12">
                    <hr style="margin-top: 10px; margin-bottom: 20px;">
                    <label class="form-label text-warning">Autore (Custode della Conoscenza)</label>
                </div>
                <div class="col-md-6 col-12">
                    <label for="author_name" class="form-label">Nome dell'Autore</label>
                    <input type="text" class="form-control"
                      id="author_name" name="author_name" value="{{ old('author_name', request('author_name')) }}">
                </div>
                <div class="col-md-6 col-12">
                    <label for="author_surname" class="form-label">Cognome dell'Autore</label>
                    <input type="text" class="form-control"
                      id="author_surname" name="author_surname" value="{{ old('author_surname', request('author_surname')) }}">
                </div>
                
                {{-- PAGINE --}}
                <div class="col-12">
                    <hr style="margin-top: 10px; margin-bottom: 20px;">
                    <label class="form-label text-warning">Dimensioni del Volume</label>
                </div>
                <div class="col-6">
                    <label for="min_pages" class="form-label">Pagine minime</label>
                    <input type="number" class="form-control"
                      id="min_pages" name="min_pages" value="{{ old('min_pages', request('min_pages')) }}">
                </div>
                <div class="col-6">
                    <label for="max_pages" class="form-label">Pagine massime</label>
                    <input type="number" class="form-control"
                      id="max_pages" name="max_pages" value="{{ old('max_pages', request('max_pages')) }}">
                </div>
                
                {{-- BOTTONE DI INVIO --}}
                <div class="col-12">
                    <button type="submit" class="btn btn-medieval w-100">
                        Affina la Ricerca
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection