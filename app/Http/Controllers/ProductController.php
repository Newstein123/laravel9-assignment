<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $categories = Category::all();
        return view('product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
       $product= Product::create([
            'name' =>  $request->name,
            'slug' =>  $request->slug,
            'description' =>  $request->description,
            'price'  => $request->price,
            'quantity' =>  $request->quantity,
        ]);

        $file =  $request->file('image');
        $filename = time()  . '_' .$file->getClientOriginalName();
        $dir = '/upload/images';
        $path =$file->storeAs($dir, $filename);

        $product->images()->create([
            'path' => $path,
        ]);

        $categorId = $request->categoryIds;
        $product->categories()->attach($categorId);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $product = Product::findOrFail($id);
        $categories = Category::all();
        
        $oldcategories = $product->categories()->pluck('id')->toArray();
        return view('product.edit', compact('product', 'oldcategories', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
    
        $product = Product::findOrFail($id);

        $product->update([
            'name' =>  $request->name,
            'slug' =>  $request->slug,
            'description' =>  $request->description,
            'price'  => $request->price,
            'quantity' =>  $request->quantity,
        ]);
        // Delete from DB 
        $product->images()->delete('/upload/images');
        // Delete from Storage 

           foreach ($product->images as $image) {
            Storage::delete($image->path);
           }

           $file =  $request->file('image');
           $filename = time()  . '_' .$file->getClientOriginalName();
           $dir = '/upload/images';
           $path =$file->storeAs($dir, $filename);
   
        $product->images()->create([
            'path' => $path,
        ]);
       

        $categorId = $request->categoryIds;
        $product->categories()->sync($categorId);
        return "done";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::destroy($id);
        return redirect('/products');
    }
}
