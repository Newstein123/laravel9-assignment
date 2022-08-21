<?php

namespace App\Repository;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Interfaces\CategoryRepositoryInterface;

class OrderRepository implements CategoryRepositoryInterface 
{
    public function getAllCategory() 
    {
        $category =  Category::all();
        return CategoryResource::collection($category);
    }

    public function getCategoryById($id) 
    {
        $category = Category::findOrFail($id);
        return new CategoryResource($category);
        
    }

    public function deleteCategory($id) 
    {
        Category::destroy($id);
    }

    public function createCategory(array $category) 
    {
        return Category::create($category);
    }

    public function updateCategory($id, array $category) 
    {
        return Category::whereId($id)->update($category);
    }

}