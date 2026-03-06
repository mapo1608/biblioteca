@extends('app')

@section('title')
{{-- Il titolo è gestito nel content per la stilizzazione --}}
@endsection

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
    
    /* Contenitore principale dei dettagli (stile pergamena/registro) */
    .detail-card {
        background-color: rgba(0, 0, 0, 0.85); /* SCURO COERENTE */
        color: #f5deb3; /* Testo color crema/pergamena */
        border: 5px solid #795548; /* Bordo spesso color legno */
        border-radius: 10px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.7);
        padding: 30px;
        max-width: 800px;
        width: 90%;
        transition: transform 0.3s ease;
    }
    .detail-card:hover {
        transform: translateY(-5px); /* Piccolo effetto di sollevamento al passaggio del mouse */
    }

    /* Stile per le intestazioni e il titolo */
    .detail-title {
        color: #ffc107; /* Giallo/Oro per il titolo su sfondo scuro */
        text-align: center;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 3px double #795548; /* Linea decorativa */
        font-weight: bold;
        text-shadow: 1px 1px 2px #000;
    }
    
    /* Stile per i box informativi (Righe) */
    .info-row {
        margin-bottom: 10px;
        padding: 8px 0;
        border-bottom: 1px dashed #795548; /* Linea tratteggiata */
    }
    
    .info-label {
        font-weight: 900;
        color: #f5deb3; /* Label color crema */
        padding-left: 10px;
        text-transform: uppercase;
    }
    
    .info-value {
        font-weight: 500;
        color: #ffffff; /* Valore in bianco per contrasto */
        font-style: italic;
    }

    /* Stile per le sezioni */
    .section-header {
        color: #add8e6; /* Azzurro chiaro per le sezioni su sfondo scuro */
        font-weight: bold;
        margin-top: 20px;
        margin-bottom: 15px;
        padding-top: 10px;
        border-top: 3px double #795548;
        text-align: center;
    }

    /* Stile per il bottone di eliminazione (Rosso pericoloso) */
    .btn-medieval-delete {
        background-color: #8b0000 !important; 
        border-color: #550000 !important; 
        color: #fff !important; 
        font-weight: 900;
        text-transform: uppercase;
        transition: all 0.3s ease;
        padding: 8px 15px;
        border-radius: 4px;
        letter-spacing: 1px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
    }
    .btn-medieval-delete:hover {
        background-color: #550000 !important;
        border-color: #330000 !important;
        box-shadow: 0 0 15px rgba(139, 0, 0, 0.9);
    }
    
    /* Stile per i badge di stato/ruolo */
    .badge-role {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 5px;
        font-weight: bold;
        color: white;
        text-shadow: 1px 1px 1px #000;
    }

    /* Colori dei badge per i ruoli */
    .role-direttore { background-color: #ffc107; color: #4b361e;} /* Oro */
    .role-bibliotecario { background-color: #007bff; } /* Blu */
    .role-lettore { background-color: #28a745; } /* Verde */
    
    /* Colori dei badge per lo stato */
    .status-active { background-color: #28a745; } /* Verde */
    .status-inactive { background-color: #dc3545; } /* Rosso */
    .status-blocked { background-color: #ffc107; color: #4b361e; } /* Giallo avviso */

</style>

@section('content')

<div class="create-background">
    
    <div class="detail-card">
        
        {{-- HEADER E BOTTONE ELIMINA --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="detail-title medieval-font">
                {{ __('REGISTRO UTENTE:') }} {{ $user->name }}
            </h1>
            
            <form id="delete_user_form" action="{{ route('users.destroy',$user->id) }}" method="POST" class="m-0">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-medieval-delete" 
                    onclick="return confirm('Sei sicuro di voler eliminare questo utente? Questa operazione è irreversibile.');">
                    ELIMINA UTENTE
                </button>
            </form>
        </div>
        
        
        {{-- SEZIONE DATI ACCOUNT --}}
        <h3 class="section-header medieval-font">DATI ACCOUNT</h3>
        
        <div class="row info-row">
            <div class="col-12 col-md-6 info-label">
                Username
            </div>
            <div class="col-12 col-md-6 info-value">
                {{ $user->name }}
            </div>
        </div>
        
        <div class="row info-row">
            <div class="col-12 col-md-6 info-label">
                Email
            </div>
            <div class="col-12 col-md-6 info-value">
                {{ $user->email }}
            </div>
        </div>
        
        <div class="row info-row">
            <div class="col-12 col-md-6 info-label">
                Ruolo
            </div>
            <div class="col-12 col-md-6 info-value">
                @if($user->role == 1)
                    <span class="badge-role role-direttore">DIRETTORE</span>
                @elseif($user->role == 2)
                    <span class="badge-role role-bibliotecario">BIBLIOTECARIO</span>
                @else
                    <span class="badge-role role-lettore">LETTORE</span>
                @endif
            </div>
        </div>
        
        <div class="row info-row">
            <div class="col-12 col-md-6 info-label">
                Stato account
            </div>
            <div class="col-12 col-md-6 info-value">
                @if($user->status == 1)
                    <span class="badge-role status-active">ATTIVO</span>
                @else
                    <span class="badge-role status-inactive">DISATTIVATO</span>
                @endif
            </div>
        </div>
        
        {{-- SEZIONE BLOCCO PRESTITO --}}
        <div class="row info-row">
            <div class="col-12 col-md-6 info-label">
                Bloccato al prestito
            </div>
            <div class="col-12 col-md-6 info-value">
                @if($user->is_blocked == 1)
                    <span class="badge-role status-blocked">SI</span>
                @else
                    <span class="badge-role status-active">NO</span>
                @endif
            </div>
        </div>
        
        @if($user->is_blocked == 1)
            <div class="row info-row">
                <div class="col-12 col-md-6 info-label">
                    Bloccato al prestito fino
                </div>
                <div class="col-12 col-md-6 info-value">
                    {{ $user->blocked_until }}
                </div>
            </div>
        @endif
        
        <hr class="my-4" style="border-top: 2px solid #795548;">

        {{-- SEZIONE DATI PERSONALI --}}
        @isset($user->personal_data)
        
            <h3 class="section-header medieval-font">DATI PERSONALI</h3>

            <div class="row info-row">
                <div class="col-12 col-md-6 info-label">
                    Nome
                </div>
                <div class="col-12 col-md-6 info-value">
                    {{ $user->personal_data->name }}
                </div>
            </div>
            
            <div class="row info-row">
                <div class="col-12 col-md-6 info-label">
                    Cognome
                </div>
                <div class="col-12 col-md-6 info-value">
                    {{ $user->personal_data->surname }}
                </div>
            </div>
            
            <div class="row info-row">
                <div class="col-12 col-md-6 info-label">
                    Data nascita
                </div>
                <div class="col-12 col-md-6 info-value">
                    {{ $user->personal_data->birth_date }}
                </div>
            </div>

            <div class="row info-row">
                <div class="col-12 col-md-6 info-label">
                    Email di contatto
                </div>
                <div class="col-12 col-md-6 info-value">
                    {{ $user->personal_data->email }}
                </div>
            </div>
            
            <div class="row info-row">
                <div class="col-12 col-md-6 info-label">
                    Telefono
                </div>
                <div class="col-12 col-md-6 info-value">
                    {{ $user->personal_data->phone }}
                </div>
            </div>
            
            <div class="row info-row">
                <div class="col-12 col-md-6 info-label">
                    Indirizzo
                </div>
                <div class="col-12 col-md-6 info-value">
                    {{ $user->personal_data->address }}
                </div>
            </div>

        @else
            <h3 class="section-header medieval-font text-warning">DATI PERSONALI NON DISPONIBILI</h3>
        @endisset
        
    </div>
</div>

@endsection