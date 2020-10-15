<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Size;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        $size = Size::all();
        $products = Product::paginate(10);
        return view('auth.product.index', compact('products', 'category', 'size'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'category' => 'required',
            'size' => 'required',
            'product_price' => 'required',
            'stock' => 'required',
            'product_description' => 'required',
        ]);
        $product = new Product();
        $product->product_name = $request->product_name;
        $product->category = $request->category;
        $product->size = $request->size;
        $product->product_price = $request->product_price;
        $product->stock = $request->stock;
        $product->product_description = $request->product_description;
        $product->save();
        return redirect('/product')->with('success', 'Product added successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::all();
        $size = Size::all();
        $product = Product::findorfail($id);
        return view('auth.product.edit', compact('product', 'category', 'size'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_name' => 'required',
            'category' => 'required',
            'size' => 'required',
            'product_price' => 'required',
            'stock' => 'required',
            'product_description' => 'required',
        ]);
        $product = Product::findorfail($id);
        $product->product_name = $request->product_name;
        $product->category = $request->category;
        $product->size = $request->size;
        $product->product_price = $request->product_price;
        $product->stock = $request->stock;
        $product->product_description = $request->product_description;
        $product->update($request->all());
        return redirect('/product')->with('success', 'Product updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findorfail($id);
        $product->delete();
        return redirect('/product')->with('success', 'Product deleted successfully!');
    }
}
