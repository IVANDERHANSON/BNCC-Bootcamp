<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carts = Cart::all();
        return view('cart', compact('carts'));
    }

    public function index2(Request $request, $id) {
        $product = Product::find($id);
        $category = Category::find($product->categoryId)->name;
        return view('addToCart', compact('product', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, $id)
    {
        $product = Product::find($id);
        
        $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:'.$product->stock]
        ]);
        
        $category = Category::find($product->categoryId)->name;

        Cart::create([
            'userId' => Auth::user()->id,
            'productId' => $product->id,
            'category' => $category,
            'productName' => $product->name,
            'productPrice' => $product->price,
            'productPhoto' => $product->photo,
            'quantity' => $request->quantity
        ]);

        Product::find($id)->update([
            'categoryId' => $product->categoryId,
            'name' => $product->name,
            'price' => $product->price,
            'stock' => $product->stock-$request->quantity,
            'photo' => $product->photo,
        ]);

        return redirect('/cart');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCartRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $cart = Cart::find($id);
        $product = Product::find($cart->productId);
        $category = Category::find($product->categoryId)->name;
        return view('editCart', compact('cart', 'product', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $cart = Cart::find($id);
        $product = Product::find($cart->productId);
        $category = Category::find($product->categoryId)->name;
        
        $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:'.$product->stock+$cart->quantity]
        ]);

        Cart::find($id)->update([
            'userId' => Auth::user()->id,
            'productId' => $cart->productId,
            'category' => $category,
            'productName' => $product->name,
            'productPrice' => $product->price,
            'productPhoto' => $product->photo,
            'quantity' => $request->quantity
        ]);

        Product::find($cart->productId)->update([
            'categoryId' => $product->categoryId,
            'name' => $product->name,
            'price' => $product->price,
            'stock' => $product->stock+$cart->quantity-$request->quantity,
            'photo' => $product->photo,
        ]);

        return redirect('/cart');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }

    public function delete($id) {
        $cart = Cart::find($id);
        $product = Product::find($cart->productId);
        
        Product::find($product->id)->update([
            'categoryId' => $product->categoryId,
            'name' => $product->name,
            'price' => $product->price,
            'stock' => $product->stock+$cart->quantity,
            'photo' => $product->photo,
        ]);

        Cart::destroy($id);
        return redirect('/cart');
    }
}
