<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    public function index()
    {
        /*$permissions = Permission::latest()->paginate(10);
        return view('permissions.index', compact('permissions'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

    */
        return view('users.index');
    }

    public function create()
    {
        //return view('permissions.create');
    }

    public function store(Request $request)
    {
        return redirect()->route('permissions.index');
    }

    public function show(Permission $permission)
    {
//        return view('roles.show', compact('role'));
    }

    public function edit(Request $request, $user)
    {
        $subcategories = DB::table('subcategories')->get();
        return view('users.pedit', compact('user', 'subcategories'));
    }

    public function update(Request $request, $t, $id1, $id2)
    {

        if ($t == 't') {
            DB::table('permissions')->insert(
                ['user_id' => $id1, 'subcategory_id' => $id2]
            );
        } else {
            DB::table('permissions')->where('user_id', '=', $id1)->where('subcategory_id', '=', $id2)->delete();
        }

        return redirect()->route('permissions.edit', compact('id1'));
    }

    public function destroy($id)
    {
        Permission::destroy($id);
        return redirect()->route('permissions.index')
            ->with('success', 'Kategoria usunięta prawidłowo');
    }
}
