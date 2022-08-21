<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository) 
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index() 
    {
       return response()->json([
        'data' => $this->categoryRepository->getAllCategory(),
       ]);
    }

    public function store(Request $request)
    {   
        $category  = request()->only([
            'name',
            'slug',
            'description',
        ]);

       return response()->json([
        'data' => $this->categoryRepository->getCategoryById($category),
       ]);
    }

    public function show($id)
    {
        return response()->json([
            'data' => $this->categoryRepository->getCategoryById($id),
           ]);
    }

    public function update(Request $request, $id)
    
    {
        $category = Category::find($id);

       $category = request()->only([
        'name',
        'slug',
        'description'
       ]);

        return response()->json([
            'data' => $this->categoryRepository->updateCategory($id, $category)
        ]);
    }
    
    public function destroy($id)
    {   
        $this->orderRepository->deleteOrder($id);

        return response()->json([], 200);
    }
}
