<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Copy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class CopyController extends Controller
{
    /**
     * Metodo che ritorna la view di creazione di una copia
     */
    public function create_from_book($id)
    {
        $book = Book::find($id);
        return view('copies.create_copies')
            ->with('book',$book);
    }

    /**
     * Metodo che crea una nuova copia di un libro dentro al database
     */
    public function store_copy(Request $request)
    {

         $rules = [
            'inventory' => 'required|string|max:10|unique:copies,inventory',
            'status' => 'required|boolean',
            'condition' => 'required|integer|in:1,2,3',
            'position' => 'required|string|max:20',
            'buy_date' => 'nullable|date|before:today',
            'book' => 'required|integer',
        ];

        $messages = [
            'required' => 'Campo obbligatorio',
            'string' => 'Campo testuale',
            'max' => 'Il campo può essere lungo massimo :max',
            'min' => 'Il campo può essere lungo minimo :min',
            'email' => 'Il campo deve essere una email',
            'date' => 'Il campo deve essere una data valida',
            'integer' => 'Campo intero',
            'unique' => 'Il campo deve essere univoco.'
        ];

        Validator::make($request->all(),$rules,$messages)->validate();

        $copy = new Copy([
            'inventory' => $request->input('inventory'),
            'status' => $request->input('status'),
            'condition' => $request->input('condition'),
            'position' => $request->input('position'),
            'buy_date' => $request->input('buy_date'),
            'fk_book' => $request->input('book'),
        ]);
        $copy->save();

        return redirect()
            ->route('books.show',$copy->fk_book);
    }

    /**
     * Metodo che visualizza i dettagli di una copia di un libro
     */
    public function show_copy($id)
    {
        $copy = Copy::find($id);
        return view('copies.show_copies')
            ->with('copy',$copy);
    }

    /**
     * Metodo che elimina la copia di un libro
     */
    public function destroy_copy($id)
    {
        $copy = Copy::find($id);
        $book_id = $copy->fk_book;
        $copy->delete();

        return redirect()->route('books.show',$book_id);
    }

    /**
     * Metodo che presenta il form di modifica della copia di un libro
     */
    public function edit_copy($id)
    {
        $copy = Copy::find($id);
        return view('copies.edit_copies')
            ->with('copy',$copy);
    }

    /**
     * Metodo che salva nel database le modifiche a una copia di un libro
     */
    public function update_copy(Request $request, $id)
    {
        $copy = Copy::find($id);
        $copy->update([
            'inventory' => $request->input('inventory'),
            'position' => $request->input('position'),
            'buy_date' => $request->input('buy_date'),
            'status' => $request->input('status'),
            'condition' => $request->input('condition'),
        ]);

        return redirect()->route('books.show',$copy->fk_book);
    }
}
