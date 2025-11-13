<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    //
    public function index(){
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    public function create(){

        return view('admin.category.create');
    }

    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create($data);

        return redirect()->route('admin.category.index')->with('success', 'Category created successfully.');
    }

   
    public function destroy($id)
    {
        $category = category::findOrFail($id);

        $category->delete();

        return redirect()->route('admin.category.index')->with('success', 'Category deleted successfully.');
    }

}

