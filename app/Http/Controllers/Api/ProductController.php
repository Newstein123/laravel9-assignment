<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Api\ProductStoreRequest;
use App\Http\Requests\Api\ProductUpdateRequest;
use App\Http\Requests\Api\ProductUpdateeRequest;
use App\Http\Resources\ProductResource;
use App\Interfaces\ProductRepositoryInterface;
use App\Repository\InterfaceProductRepo;
use App\Repository\ProductInterface;
use App\Repository\ProductRepository;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{   
    private ProductRepositoryInterface $productRepository;

    public function __construct (ProductRepository $productRepository){
        $this->productRepository = $productRepository;
    }

    public function index(): JsonResponse
    {
        return response()->json([
            'data' => $this->orderRepository->getAllProdcuts()
        ]);
    }

    public function store(ProductStoreRequest $request)
    {
        $product = Product::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
        ]);
        $file = $request->file('image');
        $path = $file->store('/upload/images');
        $product->images()->create([
            'path' => $path,
        ]);
        $categoryId = $request->categoryIds;
        $product->categories()->attach($categoryId);

       return ProductResource::make($product);  
    }

    public function show($id)
    {
        // return $this->productRepository->find($id);
    }
    public function update(ProductUpdateRequest $request, $id)
    
    {
        dd($request->all());
        $product = Product::find($id);

        if(!$product) {
            return response()->json([], 400);
        }

        $product->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
        ]);
        $product->images()->delete();
        Storage::delete('upload/images');

        $file = $request->file('image');
        $path = $file->store('/upload/images');
        $product->images()->create([
            'path' => $path,
        ]);

        $categoryId = $request->categoryIds;
        $product->categories()->attach($categoryId);

        return ProductResource::make($product);  
    }
    
    public function destroy($id)
    {   
        $product = Product::find($id);

       if(!$product) {
        return response()->json([
            'product' => "No Result for product",
        ], 400);
        }
       return $product->destroy($id);
        }
}
