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
    
    /* STILE PER LO SFONDO (area5.png) */
    .loan-background {
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
        padding: 60px 20px;
    }
    
    /* Contenitore principale del form (Effetto Vecchio Registro) */
    .loan-card {
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
        margin-bottom: 30px;
        font-size: 2rem;
        text-transform: uppercase;
    }

    /* Stile per le label */
    .form-label {
        color: #ffc107; /* Oro chiaro per l'etichetta */
        font-weight: 900;
        font-family: 'IM Fell Double Pica', serif;
        text-shadow: 1px 1px 2px #000;
        margin-bottom: 5px;
        display: block; /* Assicura che le label occupino tutta la larghezza */
    }

    /* Campi di input e select */
    .form-control, .form-select {
        background-color: rgba(0, 0, 0, 0.5) !important;
        border: 1px solid #795548 !important;
        color: #f5deb3 !important; 
        border-radius: 4px;
        padding: 10px 15px;
        transition: border-color 0.3s;
        width: 100%;
    }
    .form-control:focus, .form-select:focus {
        background-color: rgba(0, 0, 0, 0.6) !important;
        border-color: #ffc107 !important; 
        box-shadow: 0 0 8px rgba(255, 193, 7, 0.7) !important;
    }
    .form-select option {
        background-color: #4b361e; 
        color: #f5deb3;
    }

    /* Testo informativo (Titolo/Inventario) */
    .loan-info-value {
        font-size: 1.1rem;
        font-weight: bold;
        color: #ffffff; /* Bianco per i valori del libro */
        display: block;
        padding-top: 5px;
    }
    .loan-section-title {
        color: #ffc107; 
        font-size: 1.5rem;
        margin-top: 20px;
        margin-bottom: 15px;
        border-bottom: 2px solid #795548;
        padding-bottom: 5px;
    }

    /* Stile per il bottone di Ricerca (oro/giallo) */
    .btn-medieval-search {
        background-color: #ffc107 !important; 
        border-color: #e0a800 !important; 
        color: #4b361e !important; 
        font-weight: 900;
        text-transform: uppercase;
        transition: all 0.3s ease;
        padding: 12px 30px;
        border-radius: 8px;
        letter-spacing: 2px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.7);
        margin-top: 30px;
        width: 100%;
    }
    .btn-medieval-search:hover {
        background-color: #e0a800 !important;
        border-color: #c69500 !important;
        box-shadow: 0 0 25px rgba(255, 193, 7, 0.7);
    }

    /* Stile per il bottone di Avvio Prestito (blu scuro) */
    .btn-medieval-start {
        background-color: #007bff !important; 
        border-color: #0056b3 !important; 
        color: #f5deb3 !important;
        font-weight: 900;
        text-transform: uppercase;
        transition: all 0.3s ease;
        padding: 12px 30px;
        border-radius: 8px;
        letter-spacing: 2px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.7);
        margin-top: 30px;
        width: 100%;
    }
    .btn-medieval-start:hover {
        background-color: #0056b3 !important;
        border-color: #004085 !important;
        box-shadow: 0 0 25px rgba(0, 123, 255, 0.7);
    }
</style>

@section('content')

<div class="loan-background">
    <div class="loan-card">
        
        <h1 class="page-title medieval-font">{{ __('REGISTRO PRESTITI') }}</h1>

        {{-- PRIMA FASE: RICERCA UTENTE (Solo per Admin/Bibliotecari non auto-prestando) --}}
        @if (Auth::user()->role != 3 && session()->missing('search_user_id'))
            <h2 class="loan-section-title">Fase 1: Identificazione Utente</h2>

            <form action="{{ route('loans.search_user') }}" method="GET" class="my-2">
                @csrf

                <div class="row g-4">

                    <div class="col-12">
                        <label for="name" class="form-label">Titolo del Volume:</label>
                        <span class="loan-info-value">{{ $copy->book->title }}</span>
                    </div>

                    <div class="col-12">
                        <label for="name" class="form-label">Codice Inventario:</label>
                        <span class="loan-info-value">{{ $copy->inventory }}</span>
                    </div>

                    <div class="col-12 mt-4">
                        <label for="search_user_name" class="form-label">Digita username o email per la ricerca</label>
                        <input type="text" id="search_user_name" name="search_user_name" class="form-control" required>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-medieval-search">
                            {{ __('CERCA UTENTE') }}
                        </button>
                    </div>

                </div>
            </form>
            
        {{-- SECONDA FASE: AVVIO PRESTITO (Dopo ricerca o per auto-prestito Utente Semplice) --}}
        @else
            <h2 class="loan-section-title">Fase 2: Conferma Prestito</h2>
        
            <form action="{{ route('loans.start_loan') }}" method="POST" class="my-2">
                @csrf
                <div class="row g-4">
                    <input type="hidden" name="fk_copy" value="{{ $copy->id }}">
                    
                    <div class="col-12">
                        <label for="name" class="form-label">Titolo del Volume:</label>
                        <span class="loan-info-value">{{ $copy->book->title }}</span>
                    </div>
                    
                    <div class="col-12">
                        <label for="name" class="form-label">Codice Inventario:</label>
                        <span class="loan-info-value">{{ $copy->inventory }}</span>
                    </div>
                    
                    <div class="col-12 mt-4">
                        <label for="fk_user" class="form-label">Utente Beneficiario</label>
                        
                        {{-- Select per l'utente (o l'utente cercato, o l'utente loggato) --}}
                        <select name="fk_user" class="form-control form-select" required>
                            @if (session()->missing('search_user_id'))
                                {{-- Utente che si presta da solo (Ruolo 3) --}}
                                <option value="{{ Auth::user()->id }}">
                                    {{ Auth::user()->name . ' - ' . Auth::user()->personal_data->name . ' ' . Auth::user()->personal_data->surname }}
                                </option>
                            @else
                                {{-- Utente cercato (Ruolo diverso da 3) --}}
                                @php
                                    $user = \App\Models\User::find(session('search_user_id'));
                                @endphp
                                <option value="{{ $user->id }}">
                                    {{ $user->name . ' - ' . $user->personal_data->name . ' ' . $user->personal_data->surname }}
                                </option>
                            @endif
                        </select>
                        

                    </div>
                    
                    <div class="col-12">
                        <button type="submit" class="btn btn-medieval-start">
                            {{ __('AVVIA PRESTITO') }}
                        </button>
                    </div>

                </div>
            </form>
        @endif
        
    </div>
</div>

@endsection