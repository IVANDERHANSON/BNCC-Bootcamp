<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('addProduct', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'categoryId' => ['required'],
            'name' => ['required','string', 'min:5', 'max:80'],
            'price' => ['required', 'integer', 'min:1'],
            'stock' => ['required', 'integer', 'min:1'],
            'photo' => ['required', 'image'],
        ]);

        $category = Category::find($request->categoryId)->name;
        $filename = $request->file('photo')->getClientOriginalName();
        $request->file('photo')->storeAs('/public'.'/'.$category.'/'.$filename);

        Product::create([
            'categoryId' => $request->categoryId,
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'photo' => $filename,
        ]);

        return redirect('/dashboard');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $categories = Category::all();
        $product = Product::find($id);
        $category = Category::find($product->categoryId);
        return view('editProduct', compact('categories', 'product', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'categoryId' => ['required'],
            'name' => ['required','string', 'min:5', 'max:80'],
            'price' => ['required', 'integer', 'min:1'],
            'stock' => ['required', 'integer', 'min:1'],
            'photo' => ['required', 'image'],
        ]);

        $category = Category::find($request->categoryId)->name;
        $filename = $request->file('photo')->getClientOriginalName();
        $request->file('photo')->storeAs('/public'.'/'.$category.'/'.$filename);

        Product::find($id)->update([
            'categoryId' => $request->categoryId,
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'photo' => $filename,
        ]);

        return redirect('/dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }

    public function delete($id) {
        $product = Product::find($id);
        $category = Category::find($product->categoryId)->name;
        Product::destroy($id);
        Storage::delete('/public'.'/'.$category.'/'.$product->photo);
        return redirect('/dashboard');
    }
}
