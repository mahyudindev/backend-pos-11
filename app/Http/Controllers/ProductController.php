<?php

// namespace App\Http\Controllers;

// use App\Models\Product;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;

// class ProductController extends Controller
// {
//     public function index(Request $request)
//     {
//         $products = Product::query()
//             ->select('products.*', 'categories.name as category_name')
//             ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
//             ->when($request->input('name'), function ($query, $name) {
//                 $query->where('products.name', 'like', '%' . $name . '%');
//             })
//             ->when($request->input('category'), function ($query, $category) {
//                 $query->where('categories.name', $category);
//             })
//             ->paginate(10);

//         $categories = DB::table('categories')->get();

//         return view('pages.products.index', compact('products', 'categories'));
//     }

//     public function create()
//     {
//         $categories = DB::table('categories')->get();
//         return view('pages.products.create', compact('categories'));
//     }

//     public function store(Request $request)
//     {
//         $request->validate([
//             'name' => 'required',
//             'description' => 'required',
//             'price' => 'required|numeric',
//             'category_id' => 'required',
//             'stock' => 'required|numeric',
//             'status' => 'required|boolean',
//             'is_favorite' => 'required|boolean',
//         ]);

//         $product = new Product;
//         $product->name = $request->name;
//         $product->description = $request->description;
//         $product->price = $request->price;
//         $product->category_id = $request->category_id;
//         $product->stock = $request->stock;
//         $product->status = $request->status;
//         $product->is_favorite = $request->is_favorite;

//         $product->save();

//         if ($request->hasFile('image')) {
//             $image = $request->file('image');
//             $image->storeAs('public/products', $product->id . '.' . $image->getClientOriginalExtension());
//             $product->image = 'storage/products/' . $product->id . '.' . $image->getClientOriginalExtension();
//             $product->save();
//         }

//         return redirect()->route('products.index')->with('success', 'Product created successfully');
//     }

//     public function show()
//     {
//         return view('pages.products.show');
//     }

//     public function edit($id)
//     {
//         $product = Product::findOrFail($id);
//         $categories = DB::table('categories')->get();
//         return view('pages.products.edit', compact('product', 'categories'));
//     }

//     public function update(Request $request, $id)
//     {
//         $request->validate([
//             'name' => 'required',
//             'description' => 'required',
//             'price' => 'required|numeric',
//             'category_id' => 'required',
//             'stock' => 'required|numeric',
//             'status' => 'required|boolean',
//             'is_favorite' => 'required|boolean',
//         ]);

//         $product = Product::find($id);
//         $product->name = $request->name;
//         $product->description = $request->description;
//         $product->price = $request->price;
//         $product->category_id = $request->category_id;
//         $product->stock = $request->stock;
//         $product->status = $request->status;
//         $product->is_favorite = $request->is_favorite;
//         $product->save();

//         if ($request->hasFile('image')) {
//             $image = $request->file('image');
//             $image->storeAs('public/products', $product->id . '.' . $image->getClientOriginalExtension());
//             $product->image = 'storage/products/' . $product->id . '.' . $image->getClientOriginalExtension();
//             $product->save();
//         }

//         return redirect()->route('products.index')->with('success', 'Product updated successfully');
//     }

//     public function destroy($id)
//     {
//         $product = Product::find($id);
//         $product->delete();

//         return redirect()->route('products.index')->with('success', 'Product deleted successfully');
//     }
// }

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::query()
            ->select('products.*', 'categories.name as category_name')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->when($request->input('name'), function ($query, $name) {
                $query->where('products.name', 'like', '%' . $name . '%');
            })
            ->when($request->input('category'), function ($query, $category) {
                $query->where('categories.name', $category);
            })
            ->paginate(10);

        $categories = DB::table('categories')->get();

        return view('pages.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = DB::table('categories')->get();
        return view('pages.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'stock' => 'required|numeric',
            'status' => 'required|boolean',
            'is_favorite' => 'required|boolean',
        ]);

        $product = new Product;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->stock = $request->stock;
        $product->status = $request->status;
        $product->is_favorite = $request->is_favorite;

        $product->save();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/products', $product->id . '.' . $image->getClientOriginalExtension());
            $product->image = 'storage/products/' . $product->id . '.' . $image->getClientOriginalExtension();
            $product->save();
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }

    public function show()
    {
        return view('pages.products.show');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = DB::table('categories')->get();
        return view('pages.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'stock' => 'required|numeric',
            'status' => 'required|boolean',
            'is_favorite' => 'required|boolean',
        ]);

        $product = Product::find($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->stock = $request->stock;
        $product->status = $request->status;
        $product->is_favorite = $request->is_favorite;
        $product->save();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/products', $product->id . '.' . $image->getClientOriginalExtension());
            $product->image = 'storage/products/' . $product->id . '.' . $image->getClientOriginalExtension();
            $product->save();
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}

