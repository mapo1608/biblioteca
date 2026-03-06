@extends('app')


@section('content')
<style>
    /* Inclusione del font in stile "Antico Elegante" */
    @import url('https://fonts.googleapis.com/css2?family=IM+Fell+Double+Pica:wght@700&display=swap');
    
    /* FIX GLOBALE */
    html, body {
        height: 100%;
        margin: 0 !important;
        padding: 0 !important;
        overflow-x: hidden; 
    }
    
    * { box-sizing: border-box; }

    .medieval-font {
        font-family: 'IM Fell Double Pica', serif; 
        font-weight: 900 !important; 
        text-shadow: 
            -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000,
            2px 2px 4px rgba(0, 0, 0, 0.8);
    }

    /* STILE PER LO SFONDO (area1.png) */
    .detail-background {
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
        flex-direction: column;
        align-items: center;
        padding: 50px 20px;
    }
    
    /* --- STILE PARTE SUPERIORE (Come Dettaglio Autore) --- */
    .book-detail-card {
        background-color: rgba(10, 5, 0, 0.9); 
        border: 3px solid #795548; 
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.9);
        width: 100%;
        max-width: 800px; /* Un po' più largo per i dettagli del libro */
        color: #f5deb3;
        margin-bottom: 50px; /* Spazio prima della tabella */
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px dashed rgba(255, 255, 255, 0.2);
        align-items: center;
    }
    .detail-row:last-child { border-bottom: none; }

    .detail-label {
        color: #ffc107; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; flex: 1;
    }
    .detail-value {
        color: #f5deb3; flex: 1; text-align: right; word-break: break-word;
    }

    /* --- STILE PARTE INFERIORE (Come Lista Autori/Libri) --- */
    .table-medieval {
        width: 100%; 
        background-color: rgba(0, 0, 0, 0.85) !important; 
        color: white; 
        border: 2px solid #ffc107 !important; 
        border-radius: 8px; 
        overflow: hidden; 
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        margin-bottom: 0; 
        border-collapse: collapse;
    }
    
    .table-medieval tr, .table-medieval th, .table-medieval td {
        background-color: transparent !important; 
        border: 1px solid #ffc107 !important; 
        vertical-align: middle; 
        padding: 12px; 
        color: #fff; 
        text-align: center;
    }
    
    .table-medieval th {
        color: #ffc107; font-weight: 900; border-bottom: 2px solid #ffc107 !important;
    }
    
    .table-medieval td:last-child {
        border: none !important; /* Nessun bordo per la colonna azioni */
    }

    /* BOTTONI */
    .btn-medieval {
        background-color: #ffc107 !important; border-color: #ffc107 !important; color: #212529 !important;
        font-weight: 700; transition: all 0.3s ease;
    }
    .btn-medieval:hover {
        background-color: #e0a800 !important; border-color: #e0a800 !important;
    }

    .btn-medieval-danger {
        background-color: #dc3545 !important; border-color: #8b0000 !important; color: #f5deb3 !important;
        font-weight: 900; text-transform: uppercase; letter-spacing: 1px;
    }
    
    .btn-medieval-add {
        background-color: #28a745 !important; border-color: #1e7e34 !important; color: white !important;
        font-weight: 700; text-transform: uppercase; padding: 10px 20px;
    }

    /* Cella azioni flessibile */
    .action-cell {
        display: flex; flex-direction: column; gap: 5px; align-items: center;
    }
    @media (min-width: 992px) {
        .action-cell { flex-direction: row; justify-content: center; }
        .action-cell .btn { margin: 0 3px; }
    }
    
    .add-copy-container {
        display: flex; justify-content: flex-end; width: 100%; margin-top: 15px;
    }
</style>

@section('content')

<div class="detail-background">
    
    {{-- TITOLO PAGINA --}}
    <h1 class="text-center display-4 medieval-font text-warning mb-5">
         {{ $book->title }}
    </h1>

    {{-- PARTE 1: DETTAGLIO LIBRO (Stile Card/Registro) --}}
    <div class="book-detail-card">
        <h3 class="text-center medieval-font text-white mb-4" style="font-size: 1.8rem;">Scheda Tecnica</h3>
        
        <div class="detail-row">
            <div class="detail-label">Titolo</div>
            <div class="detail-value">{{ $book->title }}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">ISBN</div>
            <div class="detail-value">{{ $book->isbn }}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Anno Pubblicazione</div>
            <div class="detail-value">{{ $book->publish_year }}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Pagine</div>
            <div class="detail-value">{{ $book->number_pages }}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Lingua</div>
            <div class="detail-value">{{ $book->language }}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Categoria</div>
            <div class="detail-value">{{ $book->category->name }}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Editore</div>
            <div class="detail-value">{{ $book->publisher->name }}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Autore/i</div>
            <div class="detail-value">
                @foreach ($book->authors as $author)
                    {{ $author->name }} {{ $author->surname }}<br>
                @endforeach
            </div>
        </div>

        {{-- Pulsante Elimina Libro (se admin) --}}
        @if(Auth::user()->role != 3)
            <div class="text-center mt-4">
                <form id="delete_book_form" action="{{ route('books.destroy',$book->id) }}" method="POST" hidden>
                    @csrf @method('DELETE')
                </form>
                <button type="button" class="btn btn-sm btn-medieval-danger" 
                onclick="if(confirm('Bruciare questo tomo definitivamente?')){document.getElementById('delete_book_form').submit();}">
                    ELIMINA LIBRO
                </button>
            </div>
        @endif
    </div>

    {{-- PARTE 2: TABELLA COPIE (Stile Lista Medievale) --}}
    <div class="container-fluid px-0" style="max-width: 1000px;">
        <h2 class="text-center medieval-font text-warning mb-3">Copie in Archivio</h2>
        
        <div class="table-responsive">
            <table class="table-medieval">
                <thead>
                    <tr>
                        <th scope="col">Inventario</th>
                        <th scope="col">Collocazione</th>
                        <th scope="col">Stato</th>
                        <th scope="col" style="min-width: 200px;">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($book->copies as $copy)
                    <tr>
                        <td>{{ $copy->inventory }}</td>
                        <td>{{ $copy->position }}</td>
                        <td>
                            @if($copy->status == 1)
                                <span class="text-success fw-bold">Disponibile</span>
                            @else
                                <span class="text-danger fw-bold">Non disponibile</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-cell">
                                @if(Auth::user()->role != 3)
                                    <a class="btn btn-medieval btn-sm"
                                    href="{{ route('copies.show',$copy->id) }}">Apri</a>
                                    <a class="btn btn-medieval btn-sm"
                                    href="{{ route('copies.edit',$copy->id) }}">Modifica</a>
                                @endif
                                
                                {{-- Logica Prestito --}}
                                @if($copy->status == 1)
                                    <a class="btn btn-primary btn-sm fw-bold"
                                    href="{{ route('loans.create',$copy->id) }}">Prestito</a>
                                @else
                                    <button class="btn btn-secondary btn-sm disabled" disabled>Prestito</button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @if($book->copies->isEmpty())
                        <tr>
                            <td colspan="4" class="fst-italic text-white-50">Nessuna copia fisica registrata per questo tomo.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        {{-- Pulsante Aggiungi Nuova Copia --}}
        @if(Auth::user()->role != 3)
            <div class="add-copy-container">
                <a href="{{ route('copies.create',$book->id) }}"
                   class="btn btn-medieval-add shadow">
                   <i class="bi bi-plus-circle me-2"></i> AGGIUNGI NUOVA COPIA
                </a>
            </div>
        @endif
    </div>

</div>

@endsection