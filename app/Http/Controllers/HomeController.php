<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $user = DB::table('users')->get();
        $sets = DB::table('sets')->get();
        $result = DB::table('results')->where('user_id', Auth::id())->get();
//        $category = Category::paginate(15);
//        return View::make('home', ['category' => $category]);
        return view('home', compact('user', 'result', 'sets'));
    }



    /*public function index(Request $request)
    {
        $request->user()->authorizeRoles('admin');
        return view('admin');
    }*/
}
