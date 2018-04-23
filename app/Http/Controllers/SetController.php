<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Set;
use Illuminate\Support\Facades\DB;


class SetController extends Controller
{
    public function index()
    {
        $set = Set::latest()->paginate(10);
        return view('sets.index', compact('sets'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function show(Set $set)
    {
        return view('sets.show', compact('set'));
    }

    public function learning1($id)
    {
        $set = DB::table('sets')->where('id',$id)->first();

        return view('sets.learning1', compact('set'));
    }
    public function learning2($id)
    {
        $set = DB::table('sets')->where('id',$id)->first();

        return view('sets.learning2', compact('set'));
    }
    public function learning3($id)
    {
        $set = DB::table('sets')->where('id',$id)->first();

        return view('sets.learning3', compact('set'));
    }
    public function test1($id)
    {
        $set = DB::table('sets')->where('id',$id)->first();

        return view('sets.test1', compact('set'));
    }
    public function test2($id)
    {
        $set = DB::table('sets')->where('id',$id)->first();

        return view('sets.test2', compact('set'));
    }
    public function result(Request $request)
    {
        $id = $request->input('id');
        $set = DB::table('sets')->where('id',$id)->first();

        $input = $request->except('_token', 'id');

        return view('sets.result', compact( 'input', 'set'));


    }

}
