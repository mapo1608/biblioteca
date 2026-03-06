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
    
    /* STILE PER LO SFONDO (area4.png) */
    .edit-background {
        background: url('{{ asset('images/area4.png') }}') no-repeat center center fixed;
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
        padding: 80px 20px;
    }
    
    /* Contenitore principale del form (Effetto Vecchio Libro/Pergamena) */
    .edit-card {
        background-color: rgba(10, 5, 0, 0.9); /* Sfondo molto scuro per enfasi */
        border: 4px solid #795548; /* Bordo color legno/cuoio */
        border-radius: 15px;
        padding: 40px;
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.95);
        width: 100%;
        max-width: 600px; /* AUMENTATO il max-width per allargare il form */
        color: #f5deb3; /* Colore testo crema/antico */
    }

    /* Stile per il titolo della pagina */
    .page-title {
        text-align: center;
        margin-bottom: 30px;
        font-size: 2.2rem;
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

    /* Stile per gli input e la textarea (effetto pergamena scura) */
    .form-control {
        background-color: rgba(0, 0, 0, 0.5) !important;
        border: 1px solid #795548 !important;
        color: #f5deb3 !important; /* Testo in colore crema */
        border-radius: 4px;
        padding: 10px 15px;
        transition: border-color 0.3s;
    }
    .form-control:focus {
        background-color: rgba(0, 0, 0, 0.6) !important;
        border-color: #ffc107 !important; /* Bordo giallo/oro al focus */
        box-shadow: 0 0 8px rgba(255, 193, 7, 0.7) !important;
    }
    /* Aumento dell'altezza della textarea */
    textarea.form-control {
        min-height: 150px;
        resize: vertical;
    }

    /* Stile per l'invalid feedback */
    .invalid-feedback {
        color: #ff6347 !important; /* Rosso pomodoro scuro per l'errore */
        font-weight: bold;
    }

    /* Stile per il bottone di Modifica (stile antico - oro/giallo per modifica) */
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
</style>

@section('content')

<div class="edit-background">
    <div class="edit-card">
        
        <h1 class="page-title medieval-font">{{ __('MODIFICA CATEGORIA') }}</h1>

        <form action="{{ route('categories.update',$category->id) }}" method="POST" class="my-2">
            @csrf
            @method('PATCH')

            <div class="row g-4">

                <div class="col-12">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                        id="name" name="name" 
                        value="{{ old('name', $category->name) }}" required>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="description" class="form-label">Descrizione</label>
                    {{-- Sostituito input text con textarea per un campo più grande --}}
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                        id="description" name="description">{{ old('description', $category->description) }}</textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
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