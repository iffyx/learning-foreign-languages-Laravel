<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = DB::table('category')->get();
//        $category = Category::paginate(15);
//        return View::make('home', ['category' => $category]);
        return view('home', compact('category'));
    }



    /*public function index(Request $request)
    {
        $request->user()->authorizeRoles('admin');
        return view('admin');
    }*/
}
