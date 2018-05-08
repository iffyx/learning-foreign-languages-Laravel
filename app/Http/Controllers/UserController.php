<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = DB::table('users')->join('roles', function ($join) {
            $join->on('users.role_id', '=', 'roles.id');
        })
            ->select('users.id','users.name', 'users.surname', 'users.email', 'roles.name as role')
            ->get();

       // $permissions = DB::table('permissions')->get();
        //$users = User::latest()->paginate(10);
        return view('users.index', compact('users'));
            //->with('i', (request()->input('page', 1) - 1) * 5);
    }




    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required',
        ]);
        User::create($request->all());
        return redirect()->route('users.index')
            ->with('success', 'Użytkownik dodany poprawnie');
    }

    public function show(User $user)
    {
//        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::all()->except(1)->pluck('name', 'id');
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        request()->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required',
        ]);
        $user->update($request->all());
        return redirect()->route('users.index')
            ->with('success', 'Użytkownik edytowany poprawnie');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('users.index')
            ->with('success', 'Użytkownik usunięty poprawnie');
    }

}
