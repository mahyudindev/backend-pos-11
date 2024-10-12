<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{



    public function index (Request $request){
        $categories = DB::table('categories')
        ->when($request->input('name'), function ($query, $name) {
            $query->where('name', 'like', '%' . $name . '%');

        })
        ->paginate(10);
    return view('pages.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('pages.categories.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $category = new Category;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();
        return redirect()->route('categories.index')->with('success', 'Category created successfully');
    }

    public function show($id)
    {
        return view('pages.categories.show');
    }
    public function edit($id)
    {
        $category = Category::find($id);
        return view('pages.categories.edit', compact('category'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $category = Category::find($id);
        $category->name = $request->name;
        $category->description = $request->description;
        if ($request->has('image')){
            if (file_exists(public_path('storage/categories/' . $category->id . '.' . $category->image))) {
                unlink(public_path('storage/categories/' . $category->id . '.' . $category->image));
            }
            $category->image = null;
        }
        $category->save();
        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if (file_exists(public_path('storage/categories/' . $category->id . '.' . $category->image))) {
            unlink(public_path('storage/categories/' . $category->id . '.' . $category->image));
        }
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
    }
}

