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
    
    /* Contenitore principale del form */
    .create-card {
        background-color: rgba(10, 5, 0, 0.9); /* Sfondo molto scuro per enfasi */
        border: 4px solid #795548; /* Bordo color legno/cuoio */
        border-radius: 15px;
        padding: 40px;
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.95);
        width: 100%;
        max-width: 600px; 
        color: #f5deb3; /* Colore testo crema/antico */
    }

    /* Stile per il titolo della pagina */
    .page-title {
        text-align: center;
        margin-bottom: 10px;
        font-size: 2rem;
        text-transform: uppercase;
    }
    .page-subtitle {
        text-align: center;
        margin-bottom: 30px;
        font-size: 1.2rem;
        color: #f5deb3;
        font-style: italic;
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
        background-color: #4b361e; 
        color: #f5deb3;
    }

    /* Feedback errori */
    .invalid-feedback {
        color: #ff6347 !important;
        font-weight: bold;
    }

    /* Stile per il bottone di Aggiunta (stile antico - blu) */
    .btn-medieval-add {
        background-color: #007bff !important; 
        border-color: #0056b3 !important; 
        color: #f5deb3 !important;
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
    .btn-medieval-add:hover {
        background-color: #0056b3 !important;
        border-color: #004085 !important;
        box-shadow: 0 0 25px rgba(0, 123, 255, 0.7);
    }
</style>

@section('content')

<div class="create-background">
    <div class="create-card">
        
        <h1 class="page-title medieval-font">{{ __('REGISTRA NUOVA COPIA') }}</h1>
        <p class="page-subtitle">{{ $book->title }}</p>

        <form action="{{ route('copies.store') }}" method="POST" class="my-2">
            @csrf

            <input type="hidden" value="{{ $book->id }}" name="book">

            <div class="row g-4">

                <div class="col-12">
                    <label for="inventory" class="form-label">Codice Inventario</label>
                    <input type="text" class="form-control @error('inventory') is-invalid @enderror" 
                    id="inventory" name="inventory" value="{{ old('inventory') }}" required>
                    @error('inventory')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="position" class="form-label">Collocazione</label>
                    <input type="text" class="form-control @error('position') is-invalid @enderror" 
                    id="position" name="position" value="{{ old('position') }}" required>
                    @error('position')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="buy_date" class="form-label">Data Acquisto</label>
                    <input type="date" class="form-control @error('buy_date') is-invalid @enderror"
                    id="buy_date" name="buy_date" value="{{ old('buy_date') }}" required>
                    @error('buy_date')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="status" class="form-label">Stato Iniziale</label>
                    <select class="form-control form-select" id="status" name="status">
                        <option value="1">Disponibile</option>
                        <option value="2">Non disponibile</option>
                    </select>
                </div>

                <div class="col-12">
                    <label for="condition" class="form-label">Condizione Fisica</label>
                    <select class="form-control form-select" id="condition" name="condition">
                        <option value="1">OK (Intatto)</option>
                        <option value="2">Parzialmente danneggiato</option>
                        <option value="3">Danneggiato</option>
                    </select>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-medieval-add">
                        {{ __('AGGIUNGI COPIA') }}
                    </button>
                </div>
                
            </div>
        </form>
        
    </div>
</div>

@endsection