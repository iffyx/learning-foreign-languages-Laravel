<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use Illuminate\Http\Request;
use App\Subcategory;
use Illuminate\Support\Facades\DB;

class SubcategoryController extends Controller
{
    public function index()
    {
        //$categories = DB::table('categories')->get();
        //$subcategories = Subcategory::latest()->paginate(10);
        //return view('subcategories.index', compact('subcategories', 'categories'))
         //   ->with('i', (request()->input('page', 1) - 1) * 5);
        $subcategories = DB::table('subcategories')->join('categories', function ($join) {
                $join->on('subcategories.category_id', '=', 'categories.id');
            })->select('subcategories.id','subcategories.name', 'subcategories.description',  'categories.name as catname')
            ->get();

        return view('subcategories.index', compact('subcategories'))
           ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $category = Category::pluck('name', 'id');
        return view('subcategories.create', compact('category'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required'
        ]);
        Subcategory::create($request->all());
        return redirect()->route('subcategories.index')
            ->with('success', 'Podkategoria dodana prawidłowo');
    }

    public function show(Subcategory $subcategory)
    {
        return view('subcategories.show', compact('subcategory'));
    }

    public function edit(Subcategory $subcategory)
    {
        $category = Category::pluck('name', 'id');
        return view('subcategories.edit', compact('subcategory', 'category'));
    }

    public function update(Request $request, Subcategory $subcategory)
    {
        request()->validate([
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required'
        ]);
        $subcategory->update($request->all());
        return redirect()->route('subcategories.index')
            ->with('success', 'Podkategoria edytowana prawidłowo');
    }

    public function destroy($id)
    {
        Subcategory::destroy($id);
        return redirect()->route('subcategories.index')
            ->with('success', 'Podkategoria usunięta prawidłowo');
    }
}
