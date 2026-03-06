@extends('app')

@section('title')
{{-- TITOLO VUOTO: Il titolo è gestito nel content per la stilizzazione --}}
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
        text-shadow: 
            -1px -1px 0 #000,  
             1px -1px 0 #000,
            -1px  1px 0 #000,
             1px  1px 0 #000,
             2px  2px 4px rgba(0, 0, 0, 0.8);
    }
    
    /* STILE PER LO SFONDO (area2.png) */
    .create-background {
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
        padding: 50px 20px;
    }
    
    /* Stile personalizzato per la tabella */
    .table-medieval {
        /* Assicuriamo che la tabella occupi il 100% dello spazio del suo contenitore */
        width: 100%; 
        background-color: rgba(0, 0, 0, 0.85) !important; /* Sfondo scuro semi-trasparente (come le card) - FORZATO */
        color: white; /* Testo bianco */
        border: 2px solid #ffc107 !important; /* Bordo esterno giallo */
        border-radius: 8px;
        overflow: hidden; /* Per rispettare il border-radius */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        /* Eliminiamo i margini predefiniti di Bootstrap sulla tabella */
        margin-bottom: 0;
        border-collapse: collapse; /* Assicura che i bordi siano visibili e non doppi */
    }
    
    /* Applica lo sfondo scuro alle righe e alle celle con priorità e bordi verticali */
    .table-medieval tr, 
    .table-medieval th, 
    .table-medieval td {
        background-color: transparent !important; /* Le righe usano lo sfondo della tabella */
        border: 1px solid #ffc107 !important; /* Bordi interni gialli (verticali e orizzontali) */
        vertical-align: middle;
        padding: 12px;
        color: #fff; /* Assicura che il testo della tabella sia bianco */
        text-align: center; /* Centra il testo di tutte le celle */
    }
    
    /* Rimuove tutti i bordi dalla colonna Azioni per alleggerire lo stile */
    .table-medieval td:last-child {
        border: none !important;
        /* Aggiungo padding-top/bottom per evitare che i bottoni si attacchino troppo */
        padding-top: 15px !important;
        padding-bottom: 15px !important;
    }

    .table-medieval th {
        color: #ffc107; /* Intestazioni gialle/arancione (warning) */
        font-weight: 900;
        /* Rimuoviamo il bordo inferiore per usare quello della riga */
        border-bottom: 2px solid #ffc107 !important;
    }
    
    /* Allinea a sinistra le prime due colonne (Nome e Descrizione) */
    .table-medieval th:nth-child(1),
    .table-medieval td:nth-child(1),
    .table-medieval th:nth-child(2),
    .table-medieval td:nth-child(2) {
        text-align: left;
    }
    
    /* ************************************************************ */
    /* MODIFICHE PER ALLINEARE I BOTTONI E FORZARE LA STESSA GRANDEZZA */
    /* ************************************************************ */
    
    /* Stile per la cella delle azioni (ultima colonna) */
    .action-cell {
        display: flex;
        flex-direction: column; /* Impila verticalmente su schermi stretti */
        align-items: stretch; /* Stretch all children to fill the width on mobile */
        gap: 5px; /* Spazio tra i bottoni */
        width: 100%; /* Ensure it uses the full column width on mobile */
    }
    
    /* Ensure the form element behaves like other action elements */
    .action-cell form {
        margin: 0; /* Remove default form margin */
        width: 100%; /* Take full width on mobile */
    }

    /* Target all children (a and form) to ensure full width on mobile */
    .action-cell > * {
        width: 100%; 
        box-sizing: border-box; /* Include padding/border in width calculation */
    }
    
    @media (min-width: 768px) {
        .action-cell {
            flex-direction: row; /* Allinea orizzontalmente su desktop */
            justify-content: center;
            align-items: center; /* Center the buttons vertically */
        }

        /* Enforce uniform size on desktop */
        .action-cell > * {
            flex: 1 1 80px; /* Allow growing/shrinking, base size 80px */
            max-width: 100px; /* Maximum width for a clean look */
            width: auto; /* Reset width to be controlled by flex */
        }
        
        /* Ensure the button inside the form takes 100% of the form's width */
        .action-cell form button {
            width: 100%;
        }
    }
    /* ************************************************************ */
    
    /* Stile per i bottoni */
    .btn-medieval {
        background-color: #ffc107 !important; 
        border-color: #ffc107 !important;
        color: #212529 !important;
        font-weight: 700;
        transition: all 0.3s ease;
    }
    .btn-medieval:hover {
        background-color: #e0a800 !important;
        border-color: #e0a800 !important;
    }
    
    /* Stile specifico per il bottone Elimina (rosso) */
    .btn-delete-medieval {
        background-color: #dc3545 !important; /* Colore rosso scuro (danger) */
        border-color: #dc3545 !important;
        color: white !important;
    }
    .btn-delete-medieval:hover {
        background-color: #c82333 !important; 
        border-color: #c82333 !important;
    }

    /* Stile per il contenitore del bottone Aggiungi (usato per l'allineamento a destra) */
    .add-button-container {
        display: flex;
        justify-content: flex-end; /* Sposta il contenuto a destra */
        width: 100%;
        margin-top: 15px; /* Spazio sopra il bottone */
    }
</style>

@section('content')

{{-- Contenitore con Immagine di Sfondo e Centratura --}}
<div class="create-background">
    
    <div class="container my-5"> 
        
        {{-- TITOLO STILIZZATO (Centrato e con font "Antico Elegante") --}}
        <h1 class="text-center display-3 medieval-font text-warning mb-5">
            Lista Categorie
        </h1>

        <div class="row justify-content-center">
            {{-- Restringiamo la tabella per le categorie che hanno meno colonne --}}
            <div class="col-12 col-lg-8">
                
                {{-- RIMOSSO: Il bottone Aggiungi categoria è stato spostato in fondo --}}
                
                <div class="table-responsive">
                    {{-- Tabella con lo stile medievale --}}
                    <table class="table-medieval">
                        <thead>
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Descrizione</th>
                                <th scope="col" style="min-width: 180px;">Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->description }}</td>
                                <td>
                                    {{-- Contenitore per allineare i bottoni (ora con dimensione forzata) --}}
                                    <div class="action-cell">
                                        <a class="btn btn-medieval btn-sm"
                                            href="{{ route('categories.show',$category->id) }}">Apri</a>
                                        <a class="btn btn-medieval btn-sm"
                                            href="{{ route('categories.edit',$category->id) }}">Modifica</a>
                                        
                                        {{-- Form di Eliminazione (Ora trattato come elemento inline flessibile) --}}
                                        <form id="delete_category_form_{{ $category->id }}" action="{{ route('categories.destroy',$category->id) }}" method="POST" >
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-medieval btn-delete-medieval btn-sm">Elimina</button>
                                        </form>
                                    </div>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                {{-- NUOVO: Bottone Aggiungi categoria spostato in basso a destra --}}
                <div class="add-button-container mt-3">
                    <a class="btn btn-medieval btn-lg" 
                        href="{{ route('categories.create') }}">
                        <i class="bi bi-tags-fill me-2"></i> Aggiungi categoria
                    </a>
                </div>
                
            </div>
        </div>
        
    </div>
</div>

@endsection