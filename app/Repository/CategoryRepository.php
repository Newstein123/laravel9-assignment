<?php

namespace App\Repository;

use App\Models\Category;
use App\Http\Resources\CategoryResource;
use App\Interfaces\CategoryRepositoryInterface;

class CategroyRepository implements CategoryRepositoryInterface {

    public function getAllCategory()
    {
        $category = Category::orderBy('id', 'desc')->panginate(5);
        return CategoryResource::collection($category);
    }
    public function getCategoryById($id)
    {   
        $category = Category::findOrFail($id);
        return new CategoryResource($category);
    }
    public function deleteCategory($id)
    {
        return Category::destroy($id);
    }
    public function createCategory (array $category)
    {
        return Category::created($category);
    }
    public function updateCategory ($id, array $category)
    {
        return Category::created($category);
    }
}