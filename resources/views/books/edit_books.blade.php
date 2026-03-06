@extends('app')


@section('content')
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
    .edit-background {
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
        align-items: flex-start; /* Allinea il form in alto (se non è troppo lungo) */
        padding: 40px 20px;
    }
    
    /* Contenitore principale del form (Effetto Vecchio Libro/Pergamena) */
    .edit-card {
        background-color: rgba(10, 5, 0, 0.9); /* Sfondo molto scuro per enfasi */
        border: 4px solid #795548; /* Bordo color legno/cuoio */
        border-radius: 15px;
        padding: 40px;
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.95);
        width: 100%;
        max-width: 600px; 
        color: #f5deb3; /* Colore testo crema/antico */
    }

    /* Stile per il titolo della pagina (ad esempio, un h1 se fosse presente) */
    .page-title {
        text-align: center;
        margin-bottom: 30px;
        font-size: 2.5rem;
        text-transform: uppercase;
    }

    /* Stile per le label */
    .form-label {
        color: #ffc107; /* Oro chiaro per l'etichetta */
        font-weight: 900;
        font-family: 'IM Fell Double Pica', serif;
        text-shadow: 1px 1px 2px #000;
        margin-bottom: 5px;
    }

    /* Stile per gli input e le select (effetto pergamena scura) */
    .form-control, .form-select {
        background-color: rgba(0, 0, 0, 0.5) !important;
        border: 1px solid #795548 !important;
        color: #f5deb3 !important; /* Testo in colore crema */
        border-radius: 4px;
        padding: 10px 15px;
        transition: border-color 0.3s;
    }
    .form-control:focus, .form-select:focus {
        background-color: rgba(0, 0, 0, 0.6) !important;
        border-color: #ffc107 !important; /* Bordo giallo/oro al focus */
        box-shadow: 0 0 8px rgba(255, 193, 7, 0.7) !important;
    }

    /* Stile per le opzioni della select */
    .form-select option {
        background-color: #4b361e; /* Marrone scuro per lo sfondo delle opzioni */
        color: #f5deb3;
    }

    /* Stile per l'invalid feedback */
    .invalid-feedback {
        color: #ff6347 !important; /* Rosso pomodoro scuro per l'errore */
        font-weight: bold;
    }

    /* Stile per il bottone di Modifica (stile antico) */
    .btn-medieval-update {
        background-color: #ffc107 !important; /* Giallo Oro */
        border-color: #c49900 !important; 
        color: #4b361e !important; /* Marrone scuro per contrasto */
        font-weight: 900;
        text-transform: uppercase;
        transition: all 0.3s ease;
        padding: 12px 30px;
        border-radius: 8px;
        letter-spacing: 3px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.7);
        margin-top: 30px;
        width: 100%;
    }
    .btn-medieval-update:hover {
        background-color: #e0b400 !important;
        border-color: #9a7a00 !important;
        box-shadow: 0 0 25px rgba(255, 193, 7, 0.9);
    }
</style>

<div class="edit-background">
    <div class="edit-card">
        
        <h1 class="page-title medieval-font">{{ __('MODIFICA LIBRO') }}</h1>
        
        <form action="{{ route('books.update',$book->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="row g-4"> {{-- Aumento lo spazio tra gli elementi --}}

                <div class="col-12">
                    <label for="title" class="form-label">Titolo del Manoscritto</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                    id="title" name="title"
                        value="{{ $book->title }}">
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="isbn" class="form-label">Codice ISBN Arcaico</label>
                    <input type="text" class="form-control @error('isbn') is-invalid @enderror" 
                    id="isbn" name="isbn"
                        value="{{ $book->isbn }}">
                    @error('isbn')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="publish_year" class="form-label">Anno di Rilascio</label>
                    <input type="text" class="form-control @error('publish_year') is-invalid @enderror" 
                    id="publish_year" name="publish_year"
                        value="{{ $book->publish_year }}">
                    @error('publish_year')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="number_pages" class="form-label">Numero di Fogli (Pagine)</label>
                    <input type="number" class="form-control @error('number_pages') is-invalid @enderror" 
                    id="number_pages" name="number_pages"
                        value="{{ $book->number_pages }}">
                    @error('number_pages')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="language" class="form-label">Dialetto/Lingua</label>
                    <input type="text" class="form-control @error('language') is-invalid @enderror" 
                    id="language" name="language"
                        value="{{ $book->language }}">
                    @error('language')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="category" class="form-label">Categoria</label>
                    <select class="form-control form-select" id="category" name="category">
                        <option value="">Seleziona Categoria...</option>
                        @foreach ($categories as $category)
                            <option @selected($category->id == $book->category->id) 
                                value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12">
                    <label for="publisher" class="form-label">Casa Editrice</label>
                    <select class="form-control form-select" id="publisher" name="publisher">
                        <option value="">Seleziona Editore...</option>
                        @foreach ($publishers as $publisher)
                            <option @selected($publisher->id == $book->publisher->id)
                                value="{{ $publisher->id }}">{{ $publisher->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12">
                    <label for="author" class="form-label">Autore</label>
                    <select class="form-control form-select" id="author" name="author">
                        <option value="">Seleziona Autore...</option>
                        @foreach ($authors as $author)
                            <option @selected($author->id == $book->authors->first()->id)
                                value="{{ $author->id }}">
                                {{ ($author->name) . " " . ($author->surname) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-medieval-update">
                        {{ __('APPORTA MODIFICHE') }}
                    </button>
                </div>
                
            </div>
        </form>
        
    </div>
</div>

@endsection