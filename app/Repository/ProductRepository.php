<?php 

namespace App\Repository;
use App\Models\Product;
use App\Interfaces\ProductRepositoryInterface;
use App\Http\Resources\ProductResource;

class ProductRepository implements ProductRepositoryInterface {

    public function getAllProducts() 
    {
        $product =Product::orderBy('id', 'desc')->paginate(5);
        return ProductResource::collection($product);
    }

    public function getProductById($id) 
    {
        $product =  Product::findOrFail($id);
        return new ProductResource($product);
    }

    public function deleteProduct($id) 
    {   
        
       return Product::destroy($id);
    }

    public function createProduct(array $products, $image, $category) 
    {
        return Product::create($products, $image, $category);
    }

    public function updateProduct($id, array $products, $image, $category) 
    {
        return Product::whereId($id)->update($products, $image, $category);
    }

}