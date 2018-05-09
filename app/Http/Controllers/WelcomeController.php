<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function index()
    {
        $category = DB::table('categories')->get();
        $subcategory = DB::table('subcategories')->get();
        $sets = DB::table('sets')->join('languages as l1', function ($join) {
            $join->on('sets.language1_id', '=', 'l1.id');
        })
            ->join('languages as l2', function ($join){
                $join->on('sets.language2_id', '=', 'l2.id');
            })
            ->select('sets.id','sets.name','sets.user_id', 'sets.set', 'sets.private','sets.subcategory_id', 'sets.language1_id','sets.language2_id','l1.name as language1', 'l2.name as language2')
            ->get();
//        $category = Category::paginate(15);
//        return View::make('home', ['category' => $category]);
        return view('welcome', compact('category', 'subcategory', 'sets'));
    }
}
