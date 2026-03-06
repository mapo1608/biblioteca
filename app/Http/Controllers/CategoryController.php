<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index_categories')
            ->with('categories',$categories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create_categories');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:500',
        ];

        $messages = [
            'required' => 'Campo obbligatorio',
            'string' => 'Campo testuale',
            'max' => 'Il campo può essere lungo massimo :max',
            'email' => 'Il campo deve essere una email',
            'date' => 'Il campo deve essere una data valida',
        ];

        Validator::make($request->all(),$rules,$messages)->validate();

        $category = new Category([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            
        ]);
        $category->save();
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = Category::find($id);
        return view('categories.show_categories')
            ->with('category',$category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('categories.edit_categories')
            ->with('category',$category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);

        $category->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if($category->books->isEmpty()){
            $category->delete();
        }else{
            return back();
        }
        return redirect()->route('categories.index');
    }
}
