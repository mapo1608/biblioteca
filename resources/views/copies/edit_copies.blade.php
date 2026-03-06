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
        align-items: flex-start; /* Allinea in alto */
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
        max-width: 500px; /* Larghezza contenuta */
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

    /* Stile per il bottone di Modifica (stile antico - oro/giallo) */
    .btn-medieval-edit {
        background-color: #ffc107 !important; /* Giallo Oro */
        border-color: #e0a800 !important; 
        color: #4b361e !important; /* Testo Marrone Scuro */
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
    .btn-medieval-edit:hover {
        background-color: #e0a800 !important;
        border-color: #c69500 !important;
        box-shadow: 0 0 25px rgba(255, 193, 7, 0.7);
    }
    
    /* Feedback errori */
    .invalid-feedback {
        color: #ff6347 !important;
        font-weight: bold;
    }
</style>

@section('content')

<div class="edit-background">
    <div class="edit-card">
        
        <h1 class="page-title medieval-font">{{ __('MODIFICA COPIA') }}</h1>
        <p class="page-subtitle">{{ $copy->book->title }}</p>

        <form action="{{ route('copies.update',$copy->id) }}" method="POST" class="my-2">
            @csrf
            @method('PATCH')

            <div class="row g-4">

                <div class="col-12">
                    <label for="inventory" class="form-label">Codice Inventario</label>
                    <input type="text" class="form-control @error('inventory') is-invalid @enderror" 
                        id="inventory" name="inventory"
                        value="{{ old('inventory', $copy->inventory) }}" required>
                    @error('inventory')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="position" class="form-label">Collocazione</label>
                    <input type="text" class="form-control @error('position') is-invalid @enderror" 
                        id="position" name="position"
                        value="{{ old('position', $copy->position) }}" required>
                    @error('position')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="buy_date" class="form-label">Data Acquisto</label>
                    <input type="date" class="form-control @error('buy_date') is-invalid @enderror" 
                        id="buy_date" name="buy_date"
                        value="{{ old('buy_date', $copy->buy_date) }}" required>
                    @error('buy_date')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="status" class="form-label">Stato Attuale</label>
                    <select class="form-control form-select @error('status') is-invalid @enderror" id="status" name="status">
                        <option @selected($copy->status == 1) value="1">Disponibile</option>
                        <option @selected($copy->status == 2) value="2">Non disponibile</option>
                    </select>
                    @error('status')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="condition" class="form-label">Condizione Fisica</label>
                    <select class="form-control form-select @error('condition') is-invalid @enderror" id="condition" name="condition">
                        <option @selected($copy->condition == 1) value="1">OK (Intatto)</option>
                        <option @selected($copy->condition == 2) value="2">Parzialmente danneggiato</option>
                        <option @selected($copy->condition == 3) value="3">Danneggiato</option>
                    </select>
                    @error('condition')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-medieval-edit">
                        {{ __('SALVA MODIFICHE') }}
                    </button>
                </div>
                
            </div>
        </form>
        
    </div>
</div>

@endsection