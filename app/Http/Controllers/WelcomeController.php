<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function index()
    {
        $category = DB::table('category')->get();
        $subcategory = DB::table('subcategory')->get();
        $sets = DB::table('sets')->get();
//        $category = Category::paginate(15);
//        return View::make('home', ['category' => $category]);
        return view('welcome', compact('category', 'subcategory', 'sets'));
    }
}
