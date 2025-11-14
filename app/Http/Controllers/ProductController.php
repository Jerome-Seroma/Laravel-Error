<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        $category = Category::all();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // updated validation
        ]);

        // Prepare the data to be saved, excluding the image
        $data = $request->except(['image']);

        // Handle the image upload
        if ($request->hasFile('image')) {
            // Store the image in the 'products' directory of the public disk
            $path = $request->file('image')->store('products', ['disk' => 'public']);
            // Store the image path in the $data array
            $data['image'] = $path;
        }

        // Create a new product with the provided data
        Product::create($request->all());

        // Redirect back to the products index with a success message
        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }
    // public function destroy($id)
    // {
    //     $Product = Product::findOrFail($id);

    //     $Product->delete();

    //     return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    // }

    public function destroy(Product $product)
    {
        if($product->image){
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
   public function update(Request $request, Product $product)
   {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = $request->except('image');

        if($request->hasFile('image')){
            if($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $path = $request->file('image')->store('products', 'public');
            $data["image"] = $path;
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
   }
   public function edit(Product $product)
   {
        
        $categories = Category::all();
        
        return view('admin.products.edit', compact('product', 'categories'));
   }
}