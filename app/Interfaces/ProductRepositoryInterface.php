<?php 

namespace App\Interfaces;

interface ProductRepositoryInterface 
{
    public function getAllProducts();
    public function getProductById($id);
    public function deleteProduct($id);
    public function createProduct(array $products, $image, $category);
    public function updateProduct($id, array $products, $image, $category);
}