<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::latest()->paginate(10);
        return view('roles.index', compact('roles'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        Role::create($request->all());
        return redirect()->route('roles.index')
            ->with('success', 'Role created successfully');
    }

    public function show(Role $role)
    {
//        return view('roles.show', compact('role'));
    }

    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        request()->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        $role->update($request->all());
        return redirect()->route('roles.index')
            ->with('success', 'Role updated successfully');
    }

    public function destroy($id)
    {
        Role::destroy($id);
        return redirect()->route('roles.index')
            ->with('success', 'Role deleted successfully');
    }

}
