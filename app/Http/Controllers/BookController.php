<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;


use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //prima versione

        $books = Book::all();

        return view('books.index_books')
            ->with('books',$books);

        //SE VOLESSI REPERIRE ANCHE GLI AUTORI E LE CATEGORIE DEI LIBRI CHE METTO IN ELENCO?
        //DAL PUNTO DI VISTA SQL CHE QUERY DOVREI FARE?

        
        // $books = Book::join('author_book','books.id','=','author_book.fk_book')
        //     ->join('authors','author_book.fk_author','=','authors.id')
        //     ->leftjoin('categories','books.fk_category','=','categories.id')
        //     ->select('books.*','authors.name as author_name','authors.surname as author_surname','categories.name as category')
        //     ->get();
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = Author::all();
        $categories = Category::all();
        $publishers = Publisher::all();

        return view('books.create_books')
            ->with('authors',$authors)
            ->with('categories',$categories)
            ->with('publishers',$publishers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $rules = [
            'title' => 'required|string|max:50',
            'isbn' => 'nullable|string|max:15',
            'publish_year' => 'required|integer|min:1000|max:2100',
            'number_pages' => 'required|integer|max:10000',
            'language' => 'nullable|string',
            'category' => 'required|integer',
            'publisher' => 'nullable|integer',
            'author' => 'required|integer',
        ];

        $messages = [
            'required' => 'Campo obbligatorio',
            'string' => 'Campo testuale',
            'max' => 'Il campo può essere lungo massimo :max',
            'min' => 'Il campo può essere lungo minimo :min',
            'email' => 'Il campo deve essere una email',
            'date' => 'Il campo deve essere una data valida',
            'integer' => 'Campo intero',
        ];

        Validator::make($request->all(),$rules,$messages)->validate();

        $book = new Book([
            'title' => $request->input('title'),
            'isbn' => $request->input('isbn'),
            'publish_year' => $request->input('publish_year'),
            'number_pages' => $request->input('number_pages'),
            'language' => $request->input('language'),
            'fk_category' => $request->input('category'),
            'fk_publisher' => $request->input('publisher'),
        ]);
        $book->save();

        $book->authors()->attach($request->input('author'));
        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $book = Book::find($id);
        return view('books.show_books')
            ->with('book',$book);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $book = Book::find($id);
        $authors = Author::all();
        $categories = Category::all();
        $publishers = Publisher::all();

        return view('books.edit_books')
            ->with('book',$book)
            ->with('authors',$authors)
            ->with('categories',$categories)
            ->with('publishers',$publishers);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'title' => 'required|string|max:50',
            'isbn' => 'nullable|string|max:15',
            'publish_year' => 'required|integer|min:1000|max:2100',
            'number_pages' => 'required|integer|max:10000',
            'language' => 'nullable|string',
            'category' => 'required|integer',
            'publisher' => 'nullable|integer',
            'author' => 'required|integer',
        ];

        $messages = [
            'required' => 'Campo obbligatorio',
            'string' => 'Campo testuale',
            'max' => 'Il campo può essere lungo massimo :max',
            'min' => 'Il campo può essere lungo minimo :min',
            'email' => 'Il campo deve essere una email',
            'date' => 'Il campo deve essere una data valida',
            'integer' => 'Campo intero',
        ];

        Validator::make($request->all(),$rules,$messages)->validate();

        $book = Book::find($id);

        DB::beginTransaction();
        try{
            $book->update([
                'title' => $request->input('title'),
                'isbn' => $request->input('isbn'),
                'publish_year' => $request->input('publish_year'),
                'number_pages' => $request->input('number_pages'),
                'language' => $request->input('language'),
                'fk_category' => $request->input('category'),
                'fk_publisher' => $request->input('publisher'),
            ]);
            $book->authors()->sync([$request->input('author')]);
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            return back()->with('err','Errore.');
        }

        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        if($book->copies->isEmpty())
        {
            DB::beginTransaction();
            try{
                $book->authors()->detach();
                $book->delete();
                /*codice per simulare un errore nel try-catch*/
                /*
                throw new \Exception("Errore di test manuale per try/catch e rollback.");
                */
                DB::commit();
            }catch(\Exception $e){
                DB::rollBack();
                return back()->with('err','Errore.');
            }
        }else{
            return back()->with('err','Impossibile eliminare. Sono presenti copie del libro.');
        }
        return redirect()->route('books.index');
    }

    /**
     * metodo che presenta il form di ricerca
     */

    public function search_view(){
        return view('user_reader.search_books');
    }


    /**
     * metodo che fa la ricerca semplice
     */

    public function search_book(Request $request){
        /*
        SELECT *
        FROM books
        WHERE title LIKE %termine%
        */

        $books = Book::where('title','LIKE', '%' . $request->input('title') . '%')->get();
        return view('books.index_books')
            ->with('books',$books);

    }

    /**
     * metodo che fa la ricerca avanzata del libro
     */
    public function search_advanced_book(Request $request){

        $query = Book::query();

        if ($request->has('title')) {
            if ($request->filled('title')) {
                $query->where('title', 'LIKE', '%' . $request->input('title') . '%');
            }
        }
        if ($request->has('isbn')) {
            if ($request->filled('isbn')) {
                $query->where('isbn', 'LIKE', '%' . $request->input('isbn') . '%');
            }
        }
        if ($request->has('publish_year')) {
            if ($request->filled('publish_year')) {
                $query->where('publish_year', 'LIKE', '%' . $request->input('publish_year') . '%');
            }
        }
        if ($request->has('language')) {
            if ($request->filled('language')) {
                $query->where('language', 'LIKE', '%' . $request->input('language') . '%');
            }
        }
        /** versione con Join sulla tabella */
        /*
        if($request->has('category')){
            if($request->filled('category')){
                $query->join('categories','books.fk_category','=','categories.id');
                $query->where('name','LIKE', '%' . $request->input('category') . '%');
            }
        }
        */
        /** versione con whereHas di Laravel */
        if($request->has('category')){
            if($request->filled('category')){
                $category_name = $request->input('category');
                $query->whereHas('category', function($q) use ($category_name){
                    $q->where('categories.name','LIKE', '%' . $category_name . '%');
                });
            }
        }

        if($request->has('author_name')){
            if($request->filled('author_name')){
                $author_name = $request->input('author_name');
                $query->whereHas('authors', function($q) use ($author_name){
                    $q->where('authors.name','LIKE', '%' . $author_name . '%');
                });
            }
        }

        if($request->has('author_surname')){
            if($request->filled('author_surname')){
                $author_surname = $request->input('author_surname');
                $query->whereHas('authors', function($q) use ($author_surname){
                    $q->where('authors.surname','LIKE', '%' . $author_surname . '%');
                });
            }
        }

        if ($request->has('min_pages')) {
            if ($request->filled('min_pages')) {
                $query->where('books.number_pages', '>=', $request->input('min_pages'));
            }
        }

        if ($request->has('max_pages')) {
            if ($request->filled('max_pages')) {
                $query->where('books.number_pages', '<=', $request->input('max_pages'));
            }
        }

        $books = $query->get();

        return view('books.index_books')
            ->with('books',$books);

    }
}
