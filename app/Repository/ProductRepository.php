<?php 

namespace App\Repository;
use App\Models\Product;
use App\Interfaces\ProductRepositoryInterface;
use App\Http\Resources\ProductResource;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductRepository implements ProductRepositoryInterface {

    public function getAllOrders() 
    {
        return Product::all();
    }

    public function getOrderById($orderId) 
    {
        return Product::findOrFail($orderId);
    }

    public function deleteOrder($orderId) 
    {
        Product::destroy($orderId);
    }

    public function createOrder(array $orderDetails) 
    {
        return Product::create($orderDetails);
    }

    public function updateOrder($orderId, array $newDetails) 
    {
        return Product::whereId($orderId)->update($newDetails);
    }

}