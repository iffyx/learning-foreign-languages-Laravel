<?php

namespace App\Http\Controllers;

use App\Subcategory;
use App\User;
use Illuminate\Http\Request;
use App\Category;
class CategoryController extends Controller
{
    /*public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('home', compact('categories'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }*/

    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('categories.index', compact('categories'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'description' => 'required',
        ]);



        Category::create($request->all());
        return redirect()->route('categories.index')
            ->with('success', 'Kategoria dodana prawidłowo');
    }

    public function show(Category $category)
    {
//        return view('roles.show', compact('role'));
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        request()->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        $category->update($request->all());
        return redirect()->route('categories.index')
            ->with('success', 'Kategoria edytowana prawidłowo');
    }

    public function destroy($id)
    {
        Category::destroy($id);
        return redirect()->route('categories.index')
            ->with('success', 'Kategoria usunięta prawidłowo');
    }
}
