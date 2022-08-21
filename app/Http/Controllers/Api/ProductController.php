<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Api\ProductStoreRequest;
use App\Interfaces\ProductRepositoryInterface;
use App\Http\Requests\Api\ProductUpdateRequest;


class ProductController extends Controller
{   
    private ProductRepositoryInterface $productRepository;

    public function __construct (ProductRepositoryInterface $productRepository){
        $this->productRepository = $productRepository;
    }

    public function index(): JsonResponse
    {
        return response()->json([
            'data' => $this->productRepository->getAllProducts()
        ]);
    }

    public function store(ProductStoreRequest $request)
    {      
        $product = App\Models\Product::class;
        $products = $request->only(
            [
                'name',
                'slug',
                'description',
                'price',
                'quantity',
            ]
        );
        // $file = $request->file('image');
        // $path = $file->store('/upload/images');
        // $image = $product->images()->create([
        //     'path' => $path,
        // ]);
        // $categoryId = $request->categoryIds;
        // $category = $product->categories()->attach($categoryId);

        return response()->json(
            [
                'data' => $this->productRepository->createProduct($products, $category, $image)
            ], 201);
    }

    public function show($id)
    {
        return response()->json([
            'data' => $this->productRepository->getProductById($id)
        ]);
    }
    public function update(ProductUpdateRequest $request, $id)
    
    {
        $product = Product::find($id);

        if(!$product) {
            return response()->json([], 400);
        }

        $products = request()->only([
                'name',
                'slug',
                'description',
                'price',
                'quantity',
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

        return response()->json([
            'data' => $this->productRepository->updateProduct($id, $products)
        ]);
    }
    
    public function destroy($id): JsonResponse
    {   
        $this->productRepository->deleteProduct($id);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
