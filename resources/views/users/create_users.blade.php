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
        background: url('{{ asset('images/area6.png') }}') no-repeat center center fixed;
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
    
    /* Contenitore principale del Form (stile medievale scuro) */
    .create-card {
        background-color: rgba(0, 0, 0, 0.85); /* SCURO COERENTE */
        color: #f5deb3; /* Testo color crema/pergamena */
        border: 5px solid #795548; /* Bordo spesso color legno */
        border-radius: 10px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.7);
        padding: 30px;
        max-width: 800px;
        width: 90%;
    }

    /* Stile per il titolo */
    .form-title {
        color: #ffc107; /* Giallo/Oro */
        text-align: center;
        margin-bottom: 30px;
        padding-bottom: 10px;
        border-bottom: 3px double #795548;
        font-weight: bold;
        text-shadow: 1px 1px 2px #000;
        font-size: 2rem;
    }
    
    /* Stile per le label */
    .form-label {
        color: #f5deb3; /* Crema */
        font-weight: 900;
        text-transform: uppercase;
        margin-bottom: 5px;
        display: block;
    }

    /* Stile per i campi di input e select */
    .form-control, .form-select {
        background-color: #333333 !important; /* Sfondo scuro */
        color: #ffffff !important; /* Testo bianco */
        border: 1px solid #795548 !important; 
        border-radius: 4px;
        transition: border-color 0.3s, box-shadow 0.3s;
    }
    .form-control:focus, .form-select:focus {
        border-color: #ffc107 !important; 
        box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.25);
        background-color: #444444 !important;
    }
    
    /* Stile per le opzioni di select */
    .form-select option {
        background-color: #333333;
        color: #ffffff;
    }

    /* Sottotitoli/Sezioni */
    .section-subtitle {
        color: #add8e6; /* Azzurro chiaro */
        font-weight: bold;
        margin-top: 20px;
        margin-bottom: 15px;
        padding: 5px 0;
        border-bottom: 1px dashed #795548;
    }
    
    /* Stile per il bottone di creazione */
    .btn-medieval-create {
        background-color: #28a745 !important; /* Verde scuro/successo */
        border-color: #1e7e34 !important; 
        color: #fff !important; 
        font-weight: 900;
        text-transform: uppercase;
        transition: all 0.3s ease;
        padding: 10px 20px;
        border-radius: 4px;
        letter-spacing: 1px;
        margin-top: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        width: 100%; 
    }
    .btn-medieval-create:hover {
        background-color: #1e7e34 !important;
        border-color: #155724 !important;
        box-shadow: 0 0 15px rgba(40, 167, 69, 0.5);
    }
</style>

@section('content')

<div class="create-background">
    <div class="create-card">
        
        <h1 class="form-title medieval-font">
            NUOVO UTENTE
        </h1>

        <form action="{{ route('users.store') }}" method="POST" class="my-2">
            @csrf

            <div class="row g-4">

                {{-- SEZIONE CAMPI UTENTE --}}
                <div class="col-12 section-subtitle h4">
                    Campi Account e Permessi
                </div>

                <div class="col-12">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>

                <div class="col-12">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="col-12">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="col-12 col-md-6">
                    <label for="role" class="form-label">Ruolo</label>
                    <select class="form-control form-select" id="role" name="role" required>
                        <option value="" disabled selected>Seleziona Ruolo</option>
                        <option value="1">Direttore</option>
                        <option value="2">Bibliotecario</option>
                        <option value="3">Lettore</option>
                    </select>
                </div>

                <div class="col-12 col-md-6">
                    <label for="status" class="form-label">Stato</label>
                    <select class="form-control form-select" id="status" name="status" required>
                        <option value="1" selected>Attivato</option>
                        <option value="0">Disattivato</option>
                    </select>
                </div>

                <hr style="border-top: 2px solid #795548;">
                
                {{-- SEZIONE CAMPI ANAGRAFICA --}}
                <div class="col-12 section-subtitle h4">
                    Campi Anagrafica (Dati Personali)
                </div>

                <div class="col-12 col-md-6">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>

                <div class="col-12 col-md-6">
                    <label for="surname" class="form-label">Cognome</label>
                    <input type="text" class="form-control" id="surname" name="surname">
                </div>

                <div class="col-12 col-md-6">
                    <label for="contact_email" class="form-label">Email di Contatto</label>
                    <input type="email" class="form-control" id="contact_email" name="contact_email">
                </div>

                <div class="col-12 col-md-6">
                    <label for="phone" class="form-label">Telefono</label>
                    <input type="text" class="form-control" id="phone" name="phone">
                </div>

                <div class="col-12">
                    <label for="address" class="form-label">Indirizzo</label>
                    <input type="text" class="form-control" id="address" name="address">
                </div>

                <div class="col-12">
                    <label for="birth_date" class="form-label">Data nascita</label>
                    <input type="date" class="form-control" id="birth_date" name="birth_date">
                </div>

                <div class="col-12 pt-4">
                    <button type="submit" class="btn btn-medieval-create">
                        AGGIUNGI UTENTE
                    </button>
                </div>
                
            </div>
        </form>
        
    </div>
</div>

@endsection