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
    
    /* STILE PER LO SFONDO (biblioteca.png) */
    .register-background {
        background: url('{{ asset('images/biblioteca.png') }}') no-repeat center center fixed;
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
        align-items: center; /* Centra verticalmente il form */
        padding: 20px;
    }
    
    /* Contenitore principale del form (Effetto Vecchio Libro/Pergamena) */
    .register-card {
        background-color: rgba(10, 5, 0, 0.9); /* Sfondo molto scuro per enfasi */
        border: 4px solid #795548; /* Bordo color legno/cuoio */
        border-radius: 15px;
        padding: 40px;
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.95);
        width: 100%;
        max-width: 500px; /* Leggermente più largo per 4 campi */
        color: #f5deb3; /* Colore testo crema/antico */
    }

    /* Stile per l'header del Card */
    .card-header {
        background-color: transparent !important;
        border-bottom: 2px solid #795548;
        margin-bottom: 25px;
        padding-bottom: 15px;
        font-size: 2rem;
        text-align: center;
        text-transform: uppercase;
    }

    /* Stile per le label */
    .form-label {
        color: #f5deb3; /* Crema/Pergamena per l'etichetta */
        font-weight: 500;
    }

    /* Stile per gli input (effetto pergamena scura) */
    .form-control {
        background-color: rgba(0, 0, 0, 0.5) !important;
        border: 1px solid #795548 !important;
        color: #ffc107 !important; /* Testo in colore oro chiaro */
        border-radius: 4px;
        padding: 10px 15px;
        transition: border-color 0.3s;
    }
    .form-control:focus {
        background-color: rgba(0, 0, 0, 0.6) !important;
        border-color: #ffc107 !important; /* Bordo giallo/oro al focus */
        box-shadow: 0 0 8px rgba(255, 193, 7, 0.7) !important;
    }

    /* Stile per l'invalid feedback */
    .invalid-feedback strong {
        color: #ff6347 !important; /* Rosso pomodoro scuro per l'errore */
        font-weight: bold;
    }

    /* Stile per il bottone di Registrazione (stile antico) */
    .btn-medieval-register {
        background-color: #ffc107 !important; /* Giallo Oro */
        border-color: #c49900 !important; 
        color: #4b361e !important; /* Marrone scuro per contrasto */
        font-weight: 900;
        text-transform: uppercase;
        transition: all 0.3s ease;
        padding: 10px 25px;
        border-radius: 6px;
        letter-spacing: 2px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.7);
        width: 100%; /* Bottone a tutta larghezza */
        margin-top: 15px;
    }
    .btn-medieval-register:hover {
        background-color: #e0b400 !important;
        border-color: #9a7a00 !important;
        box-shadow: 0 0 25px rgba(255, 193, 7, 0.9);
    }
</style>

@section('footer')
    {{-- Sovrascriviamo la sezione footer con contenuto vuoto per nasconderlo in questa pagina --}}
@endsection

@section('content')

<div class="register-background">
    <div class="register-card">
        
        <div class="card-header medieval-font">{{ __('REGISTRAZIONE NUOVO UTENTE') }}</div>

        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-4">
                    <label for="name" class="form-label">{{ __('Nome Utente') }}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="form-label">{{ __('Indirizzo Email') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label">{{ __('Parola d\'Ordine Segreta') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password-confirm" class="form-label">{{ __('Conferma Parola d\'Ordine') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>

                <div class="mb-0">
                    <button type="submit" class="btn btn-primary btn-medieval-register">{{ __('CREA ACCOUNT') }}</button>
                </div>
            </form>
        </div>
        
    </div>
</div>
@endsection