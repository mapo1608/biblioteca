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
    .edit-card {
        background-color: rgba(0, 0, 0, 0.85); /* SCURO COERENTE */
        color: #f5deb3; /* Testo color crema/pergamena */
        border: 5px solid #795548; /* Bordo spesso color legno */
        border-radius: 10px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.7);
        padding: 30px;
        max-width: 800px;
        width: 90%;
    }

    /* Stile per le intestazioni e il titolo */
    .form-title {
        color: #ffc107; /* Giallo/Oro per il titolo su sfondo scuro */
        text-align: center;
        margin-bottom: 30px;
        padding-bottom: 10px;
        border-bottom: 3px double #795548; /* Linea decorativa */
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
        background-color: #333333 !important; /* Sfondo del campo scuro */
        color: #ffffff !important; /* Testo del campo bianco */
        border: 1px solid #795548 !important; /* Bordo marrone */
        border-radius: 4px;
        transition: border-color 0.3s, box-shadow 0.3s;
    }
    .form-control:focus, .form-select:focus {
        border-color: #ffc107 !important; /* Bordo giallo/oro al focus */
        box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.25);
        background-color: #444444 !important;
    }
    
    /* Stile per le opzioni di select (per contrasto) */
    .form-select option {
        background-color: #333333;
        color: #ffffff;
    }

    /* Sottotitoli/Sezioni */
    .section-subtitle {
        color: #add8e6; /* Azzurro chiaro per i sottotitoli */
        font-weight: bold;
        margin-top: 20px;
        margin-bottom: 15px;
        padding: 5px 0;
        border-bottom: 1px dashed #795548;
    }
    
    /* Stile per il bottone di modifica */
    .btn-medieval-primary {
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
        width: 100%; /* Bottone largo */
    }
    .btn-medieval-primary:hover {
        background-color: #1e7e34 !important;
        border-color: #155724 !important;
        box-shadow: 0 0 15px rgba(40, 167, 69, 0.5);
    }
</style>

@section('content')

<div class="create-background">
    <div class="edit-card">
        
        <h1 class="form-title medieval-font">
            REGISTRO UTENTE: {{ $user->name }}
        </h1>

        <form action="{{ route('users.update',$user->id) }}" method="POST">
            @csrf
            @method('PATCH')

            {{-- SEZIONE CAMPI UTENTE --}}
            <div class="row g-4">
                <div class="col-12 section-subtitle h4">
                    Campi Account e Permessi
                </div>

                <div class="col-12">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username"
                    value="{{ $user->name }}">
                </div>

                <div class="col-12">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                    value="{{ $user->email }}">
                </div>

                <div class="col-12 col-md-4">
                    <label for="role" class="form-label">Ruolo</label>
                    <select class="form-control form-select" id="role" name="role">
                        <option value="" disabled>Seleziona Ruolo</option>
                        <option @selected($user->role == 1) value=1>Direttore</option>
                        <option @selected($user->role == 2) value=2>Bibliotecario</option>
                        <option @selected($user->role == 3) value=3>Lettore</option>
                    </select>
                </div>

                <div class="col-12 col-md-4">
                    <label for="status" class="form-label">Stato Account</label>
                    <select class="form-control form-select" id="status" name="status">
                        <option @selected($user->status == 1) value=1>Attivato</option>
                        <option @selected($user->status == 0) value=0>Disattivato</option>
                    </select>
                </div>
                
                <div class="col-12 col-md-4">
                    <label for="is_blocked" class="form-label">Bloccato al prestito</label>
                    <select class="form-control form-select" id="is_blocked" name="is_blocked">
                        <option @selected($user->is_blocked == 1) value=1>SI</option>
                        <option @selected($user->is_blocked == 0) value=0>NO</option>
                    </select>
                </div>

                <div class="col-12">
                    <label for="blocked_until" class="form-label">Bloccato fino a (Opzionale)</label>
                    <input type="date" class="form-control" id="blocked_until" name="blocked_until"
                    value="{{ $user->blocked_until }}">
                </div>

                <hr style="border-top: 2px solid #795548;">
                
                {{-- SEZIONE CAMPI ANAGRAFICA --}}
                <div class="col-12 section-subtitle h4">
                    Campi Anagrafica (Dati Personali)
                </div>

                <div class="col-12 col-md-6">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="name" name="name"
                    value="@isset($user->personal_data->name){{ $user->personal_data->name }}@endisset">
                </div>

                <div class="col-12 col-md-6">
                    <label for="surname" class="form-label">Cognome</label>
                    <input type="text" class="form-control" id="surname" name="surname"
                    value="@isset($user->personal_data->surname){{ $user->personal_data->surname }}@endisset">
                </div>

                <div class="col-12 col-md-6">
                    <label for="contact_email" class="form-label">Email di Contatto</label>
                    <input type="email" class="form-control" id="contact_email" name="contact_email"
                    value="@isset($user->personal_data->email){{ $user->personal_data->email }}@endisset">
                </div>

                <div class="col-12 col-md-6">
                    <label for="phone" class="form-label">Telefono</label>
                    <input type="text" class="form-control" id="phone" name="phone"
                    value="@isset($user->personal_data->phone){{ $user->personal_data->phone }}@endisset">
                </div>
                
                <div class="col-12">
                    <label for="address" class="form-label">Indirizzo</label>
                    <input type="text" class="form-control" id="address" name="address"
                    value="@isset($user->personal_data->address){{ $user->personal_data->address }}@endisset">
                </div>

                <div class="col-12">
                    <label for="birth_date" class="form-label">Data di Nascita</label>
                    <input type="date" class="form-control" id="birth_date" name="birth_date"
                    value="@isset($user->personal_data->birth_date){{ $user->personal_data->birth_date }}@endisset">
                </div>

                <div class="col-12 pt-4">
                    <button type="submit" class="btn btn-medieval-primary">
                        SALVA MODIFICHE UTENTE
                    </button>
                </div>
                
            </div>
        </form>
    </div>
</div>

@endsection