<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\Author;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::all();
        return view('authors.index_authors')
            ->with('authors',$authors);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('authors.create_authors');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $rules = [
            'name' => 'required|string|max:100',
            'surname' => 'required|string|max:100',
            'email' => 'required|string|max:50|email',
            'birth_date' => 'nullable|date|before:today'
        ];

        $messages = [
            'required' => 'Campo obbligatorio',
            'string' => 'Campo testuale',
            'max' => 'Il campo può essere lungo massimo :max',
            'email' => 'Il campo deve essere una email',
            'date' => 'Il campo deve essere una data valida',
        ];

        Validator::make($request->all(),$rules,$messages)->validate();

        $author = new Author([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'email' => $request->input('email'),
            'birth_date' => $request->input('birth_date'),
        ]);
        $author->save();
        return redirect()->route('authors.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $author = Author::find($id);
        return view('authors.show_authors')
            ->with('author',$author);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $author = Author::find($id);
        return view('authors.edit_authors')
            ->with('author',$author);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|string|max:100',
            'surname' => 'required|string|max:100',
            'email' => 'required|string|max:50|email',
            'birth_date' => 'nullable|date|before:today'
        ];

        $messages = [
            'required' => 'Campo obbligatorio',
            'string' => 'Campo testuale',
            'max' => 'Il campo può essere lungo massimo :max',
            'email' => 'Il campo deve essere una email',
            'date' => 'Il campo deve essere una data valida',
        ];

        Validator::make($request->all(),$rules,$messages)->validate();

        $author = Author::find($id);

        $author->update([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'email' => $request->input('email'),
            'birth_date' => $request->input('birth_date'),
        ]);

        return redirect()->route('authors.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $author = Author::find($id);
        if($author->books->isEmpty()){
            $author->delete();
        }else{
            return back();
        }
        return redirect()->route('authors.index');
    }
}
