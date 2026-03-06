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
    
    /* STILE PER LO SFONDO (area2.png) */
    .edit-background {
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
        padding: 50px 20px;
    }
    
    /* Contenitore principale del form */
    .edit-card {
        background-color: rgba(10, 5, 0, 0.85); /* Sfondo scuro per contrasto */
        border: 3px solid #795548; /* Bordo color legno/cuoio */
        border-radius: 12px;
        padding: 40px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.9);
        width: 100%;
        max-width: 500px;
        color: #f5deb3; /* Colore testo crema/antico */
    }

    /* Stile per le label */
    .form-label {
        color: #ffc107; /* Giallo oro per l'etichetta */
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 5px;
    }

    /* Stile per gli input (effetto pergamena scura) */
    .form-control {
        background-color: rgba(0, 0, 0, 0.6) !important;
        border: 1px solid #795548 !important;
        color: #f5deb3 !important;
        border-radius: 4px;
        padding: 10px 15px;
        transition: border-color 0.3s;
    }
    .form-control:focus {
        background-color: rgba(0, 0, 0, 0.7) !important;
        border-color: #ffc107 !important; /* Bordo giallo/oro al focus */
        box-shadow: 0 0 5px rgba(255, 193, 7, 0.5) !important;
    }

    /* Stile per l'invalid feedback */
    .invalid-feedback {
        color: #ff6347 !important; /* Rosso pomodoro scuro per l'errore */
        font-weight: bold;
    }

    /* Stile per il bottone di salvataggio (stile antico) */
    .btn-medieval-submit {
        background-color: #4CAF50 !important; /* Verde scuro */
        border-color: #38761d !important; /* Verde oliva scuro */
        color: #f5deb3 !important;
        font-weight: 900;
        text-transform: uppercase;
        transition: all 0.3s ease;
        padding: 10px 20px;
        margin-top: 25px;
        border-radius: 6px;
        letter-spacing: 2px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.7);
        width: 100%;
    }
    .btn-medieval-submit:hover {
        background-color: #45a049 !important;
        border-color: #38761d !important;
        box-shadow: 0 0 20px rgba(76, 175, 80, 0.7);
    }
</style>

@section('content')

<div class="edit-background">
    <div class="edit-card">
        
        {{-- TITOLO PRINCIPALE --}}
        <h1 class="text-center display-6 medieval-font text-warning mb-5">
            Modifica Autore
        </h1>

        <form action="{{ route('authors.update',$author->id) }}" method="POST" class="my-2">
            @csrf
            @method('PATCH')

            <div class="row g-4">

                <div class="col-12">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                    id="name" name="name"
                    value="{{ $author->name }}" required>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="surname" class="form-label">Cognome</label>
                    <input type="text" class="form-control @error('surname') is-invalid @enderror" 
                    id="surname" name="surname"
                    value="{{ $author->surname }}" required>
                    @error('surname')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                    id="email" name="email"
                    value="{{ $author->email }}" required>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="birth_date" class="form-label">Data nascita</label>
                    <input type="date" class="form-control @error('birth_date') is-invalid @enderror"
                    id="birth_date" name="birth_date"
                    value="{{ $author->birth_date }}" required>
                    @error('birth_date')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-medieval-submit">
                        SIGILLARE LA MODIFICA
                    </button>
                </div>
                
            </div>
        </form>

    </div>
</div>

@endsection