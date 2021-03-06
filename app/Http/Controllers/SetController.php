<?php

namespace App\Http\Controllers;

use App\Language;
use App\Subcategory;
use Illuminate\Http\Request;
use App\Set;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class SetController extends Controller
{
    public function index()
    {
        $user = DB::table('users')->get();
        $permission = DB::table('permissions')->where('user_id', Auth::id())->get();

        $sets = DB::table('sets')->join('languages as l1', function ($join) {
            $join->on('sets.language1_id', '=', 'l1.id');
        })
            ->join('languages as l2', function ($join) {
                $join->on('sets.language2_id', '=', 'l2.id');
            })
            ->join('subcategories', function ($join) {
                $join->on('sets.subcategory_id', '=', 'subcategories.id');
            })
            ->select('sets.id', 'sets.name', 'sets.set', 'sets.private', 'sets.user_id', 'l1.name as language1', 'l2.name as language2', 'subcategories.id as subid', 'subcategories.name as subcategory')
            ->get();

        return view('sets.index', compact('sets', 'user', 'permission'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $languages = Language::pluck('name', 'id');
        if (Auth::user()->hasRole('redaktor') or Auth::user()->hasRole('superredaktor')) {

            $subcategory2 = DB::table('subcategories')->join('permissions', function ($join) {
                $join->on('subcategories.id', '=', 'permissions.subcategory_id');
            })
                ->select('subcategories.id', 'subcategories.name')->where('user_id', '=', Auth::id())
                ->get();
            $subcategory = $subcategory2->pluck('name', 'id');
        } else
            $subcategory = Subcategory::pluck('name', 'id');
        return view('sets.create', compact('languages', 'subcategory'));
    }

    public function store(Request $request)
    {
        $request->request->add(['user_id', 1]);
        request()->validate([
            'name' => 'required',
            'set' => 'required',
            'language1_id' => 'required',
            'language2_id' => 'required',
            'subcategory_id' => 'required'
        ]);

        $private = $request->input('private');

        $visible = $request->input('visible');

        $new = Set::create($request->all());

        if ($private == true) {
            DB::table('sets')
                ->where('id', $new->id)
                ->update(['private' => true]);
        }

        if ($visible == false) {
            DB::table('sets')
                ->where('id', $new->id)
                ->update(['visible' => false]);
        }


        DB::table('sets')
            ->where('id', $new->id)
            ->update(['user_id' => Auth::id()]);

        if (Auth::user()->hasRole('user')) {
            DB::table('sets')
                ->where('id', $new->id)
                ->update(['private' => true]);
        }
        return redirect()->route('sets.index')
            ->with('success', 'Zestaw dodany prawidłowo');
    }

    public function show(Set $sets)
    {
        return view('sets.show', compact('sets'));
    }

    public function edit(Set $set)
    {
        // $set = DB::table('sets')->get();
        /*$setsss = DB::table('sets')->join('languages as l1', function ($join) {
            $join->on('sets.language1_id', '=', 'l1.id');
        })
            ->join('languages as l2', function ($join) {
                $join->on('sets.language2_id', '=', 'l2.id');
            })
            ->join('subcategories', function ($join) {
                $join->on('sets.subcategory_id', '=', 'subcategories.id');
            })
            ->select('sets.id', 'sets.name', 'sets.set', 'l1.name as language1', 'l2.name as language2', 'subcategories.name as subcategory')->where('sets.id', '=', $s->id)
            ->get();*/

        $languages = Language::pluck('name', 'id');


        if (Auth::user()->hasRole('redaktor') or Auth::user()->hasRole('superredaktor')) {

            $subcategory2 = DB::table('subcategories')->join('permissions', function ($join) {
                $join->on('subcategories.id', '=', 'permissions.subcategory_id');
            })
                ->select('subcategories.id', 'subcategories.name')->where('user_id', '=', Auth::id())
                ->get();
            $subcategory = $subcategory2->pluck('name', 'id');
        } else
            $subcategory = Subcategory::pluck('name', 'id');

        return view('sets.edit', compact('set', 'languages', 'subcategory', 'permission'));
    }

    public function update(Request $request, Set $set)
    {
        request()->validate([
            'name' => 'required',
            'set' => 'required'
        ]);
        $set->update($request->all());

        $private = $request->input('private');

        $visible = $request->input('visible');

        if ($private == true) {
            DB::table('sets')
                ->where('id', $set->id)
                ->update(['private' => true]);
        } else {
            DB::table('sets')
                ->where('id', $set->id)
                ->update(['private' => false]);
        }

        if ($visible == false) {
            DB::table('sets')
                ->where('id', $set->id)
                ->update(['visible' => false]);
        } else {
            DB::table('sets')
                ->where('id', $set->id)
                ->update(['visible' => true]);
        }

        return redirect()->route('sets.index')
            ->with('success', 'Zestaw edytowany prawidłowo');
    }

    public function destroy($id)
    {
        Set::destroy($id);
        return redirect()->route('sets.index')
            ->with('success', 'Zestaw usunięty prawidłowo');
    }

    public function learning1($id, $language)
    {
        $set = DB::table('sets')->join('languages as l1', function ($join) {
            $join->on('sets.language1_id', '=', 'l1.id');
        })
            ->join('languages as l2', function ($join) {
                $join->on('sets.language2_id', '=', 'l2.id');
            })
            ->join('subcategories', function ($join) {
                $join->on('sets.subcategory_id', '=', 'subcategories.id');
            })
            ->select('sets.id', 'sets.name', 'sets.set', 'l1.id as lan1', 'l1.id as lan2', 'l1.name as language1', 'l2.name as language2', 'subcategories.id as subid', 'subcategories.name as subcategory')->where('sets.id', $id)->first();

        $s = DB::table('sets')->where('id', $id)->value('set');
        $lines = explode(PHP_EOL, $s);
        shuffle($lines);

        return view('sets.learning1', compact('set', 'language', 'lines'));
    }

    public function learning2($id, $language)
    {
       // $set = DB::table('sets')->where('id', $id)->first();

        $set = DB::table('sets')->join('subcategories', function ($join) {
                $join->on('sets.subcategory_id', '=', 'subcategories.id');
            })
            ->select('sets.id', 'sets.name', 'sets.language1_id','sets.language2_id','subcategories.name as subcategory')->where('sets.id', $id)->first();


        $s = DB::table('sets')->where('id', $id)->value('set');
        $line = explode(PHP_EOL, $s);
        shuffle($line);

        return view('sets.learning2', compact('set', 'language', 'line'));
    }

    public function learning3($id, $language)
    {
        $set = DB::table('sets')->join('subcategories', function ($join) {
            $join->on('sets.subcategory_id', '=', 'subcategories.id');
        })
            ->select('sets.id', 'sets.name', 'sets.language1_id','sets.language2_id','subcategories.name as subcategory')->where('sets.id', $id)->first();
        $s = DB::table('sets')->where('id', $id)->value('set');
        $line = explode(PHP_EOL, $s);
        shuffle($line);

        return view('sets.learning3', compact('set', 'language', 'line'));
    }

    public function learning4($id, $language)
    {

        $set = DB::table('sets')->join('subcategories', function ($join) {
            $join->on('sets.subcategory_id', '=', 'subcategories.id');
        })
            ->select('sets.id', 'sets.name', 'sets.language1_id','sets.language2_id','subcategories.name as subcategory')->where('sets.id', $id)->first();
        $s = DB::table('sets')->where('id', $id)->value('set');
        $line = explode(PHP_EOL, $s);
        shuffle($line);

        return view('sets.learning4', compact('set', 'language', 'line'));
    }

    public function test($id, $language)
    {
        $set = DB::table('sets')->where('id', $id)->first();

        return view('sets.test', compact('set', 'language'));
    }

    public function result(Request $request)
    {
        $id = $request->input('id');
        $nr = $request->input('nr');

        $set = DB::table('sets')->where('id', $id)->first();

        $input = $request->except('_token', 'id', 'nr', 'str');

        return view('sets.result', compact('input', 'set', 'id', 'nr'));

    }

}
