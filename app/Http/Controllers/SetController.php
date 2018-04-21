<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Set;

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
}
