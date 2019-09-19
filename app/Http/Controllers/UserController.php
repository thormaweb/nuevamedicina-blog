<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        return view('back.users.index')->withUsers(User::all());
    }

    public function create()
    {
        return view('back.users.create');
    }

    public function store(UserRequest $request)
    {
        $user = new User;
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        $user->save();

        $role = Role::where('id', $request->get('role_id'))->first();
        $user->attachRole($role);

        Session::flash('flash_message', 'success');
        Session::flash('message_strong', 'Bien hecho!');
        Session::flash('message', 'El usuario se ha agregado satisfactoriamente');

        return redirect()->route('userBack');
    }

    public function view($id)
    {
        return view('back.users.edit')->withUser(User::findOrFail($id));
    }

    public function edit($id, UserRequest $request)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        $user->roles()->sync([$request->get('role_id')]);

        Session::flash('flash_message', 'success');
        Session::flash('message_strong', 'Bien hecho!');
        Session::flash('message', 'El usuario se ha modificado satisfactoriamente');

        return redirect()->route('userBack');
    }

    public function destroy($id)
    {

        User::destroy($id);

        Session::flash('flash_message', 'success');
        Session::flash('message_strong', 'Aviso!');
        Session::flash('message', 'El usuario se ha eliminado del sitio');

        return redirect()->route('userBack');
    }
}
