<?php

namespace App\Http\Controllers;

use App\Models\PersonalData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index_users')
            ->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create_users');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Creazione del anagrafica persona
        $person = new PersonalData([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'email' => $request->input('contact_email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'birth_date' => $request->input('birth_date'),
        ]);
        $person->save();

        //Creazione del utente
        $user = new User([
            'name' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'is_blocked' => false,
            'blocked_until' => null,
            'role' => $request->input('role'),
            'status' => $request->input('status'),
            'fk_personal_data' => $person->id,
        ]);
        $user->save();

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show_users')
            ->with('user',$user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit_users')
            ->with('user',$user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->update([
            'name' => $request->input('username'),
            'email' => $request->input('email'),
            'is_blocked' => $request->input('is_blocked'),
            'blocked_until' => $request->input('blocked_until'),
            'role' => $request->input('role'),
            'status' => $request->input('status'),
        ]);
        $person = $user->personal_data;
        $person->update([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'email' => $request->input('contact_email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'birth_date' => $request->input('birth_date'),
        ]);

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $person = $user->personal_data;
        $person->delete();
        $user->delete();

        return redirect()->route('users.index');
    }
}
