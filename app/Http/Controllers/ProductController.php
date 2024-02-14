<?php

namespace App\Http\Controllers;

use App\Models\Product;
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
        return view('admin.show', [
            'products' => Product::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'productName' => 'required|min:5|max:80',
            'categoryId' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'image' => 'required|image',
        ]);

        $validatedData['image'] = $request->file('image')->store('product-images');

        Product::create($validatedData);

        return redirect('/admin/products')->with('success', 'New product has been added.');
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
    public function edit(Product $product)
    {
        return view('admin.edit', [
            'product' => $product,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'productName' => 'required|min:5|max:80',
            'categoryId' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'image' => 'image',
        ]);

        if($request->file('image')){
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('product-images');
        }

        Product::where('id', $product->id)
                ->update($validatedData);

        return redirect('/admin/products')->with('success', 'Product has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if($product->image){
            Storage::delete($product->image);
        }

        Product::destroy($product->id);

        return redirect('/admin/products')->with('success', 'Product has been deleted.');
    }
}
