<?php

namespace App\Http\Controllers;

use App\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{
    public function index()
    {

    }

    public function create(Request $request)
    {
        $data=$request->except('_token');
        $data['created_at'] = date('Y-m-d H:i:s');
        DB::table('results')->insert(
            //['result' => $request->result, 'user_id' => $request->user_id, set_id => $request->set_id]
            $data
        );

        //Result::create($data);
        return redirect('/');
    }

    public function store(Request $request)
    {

        /*request()->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        Role::create($request->all());
        return redirect()->route('roles.index')
            ->with('success', 'Role created successfully');*/
    }

   /* public function show(Role $role)
    {
//        return view('roles.show', compact('role'));
    }*/


}
