<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::all();
        return view('invoice', compact('invoices'));
    }

    public function index2(Request $request, $id) {
        $product = Product::find($id);
        $category = Category::find($product->categoryId)->name;
        return view('buyProductNow', compact('product', 'category'));
    }

    public function index3(Request $request, $id) {
        $cart = Cart::find($id);
        return view('buyProduct', compact('cart'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, $id)
    {
        $product = Product::find($id);
        
        $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:'.$product->stock],
            'address' => ['required', 'string', 'min:10', 'max:100'],
            'postalCode' => ['required', 'string', 'regex:/^\d{5}$/']
        ]);
        
        $category = Category::find($product->categoryId)->name;

        Invoice::create([
            'userId' => Auth::user()->id,
            'category' => $category,
            'productName' => $product->name,
            'productPrice' => $product->price,
            'productPhoto' => $product->photo,
            'quantity' => $request->quantity,
            'address' => $request->address,
            'postalCode' => $request->postalCode,
            'totalPrice' => $product->price*$request->quantity
        ]);

        Product::find($id)->update([
            'categoryId' => $product->categoryId,
            'name' => $product->name,
            'price' => $product->price,
            'stock' => $product->stock-$request->quantity,
            'photo' => $product->photo,
        ]);

        return redirect('/invoice');
    }

    public function create2(Request $request, $id) {
        $request->validate([
            'address' => ['required', 'string', 'min:10', 'max:100'],
            'postalCode' => ['required', 'string', 'regex:/^\d{5}$/']
        ]);
        
        $cart = Cart::find($id);

        Invoice::create([
            'userId' => Auth::user()->id,
            'category' => $cart->category,
            'productName' => $cart->productName,
            'productPrice' => $cart->productPrice,
            'productPhoto' => $cart->productPhoto,
            'quantity' => $cart->quantity,
            'address' => $request->address,
            'postalCode' => $request->postalCode,
            'totalPrice' => $cart->productPrice*$cart->quantity
        ]);

        Cart::destroy($id);

        return redirect('/invoice');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoiceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
