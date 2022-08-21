<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{


    public function index()
    {
       $category =  Category::orderBy('id', 'desc')->get();
       return CategoryResource::collection($category);
    }

    public function store(Request $request)
    {
        $category = Category::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
        ]);

       return response()->json([compact('category')], 201);  
    }

    public function show($id)
    {
        $category = Category::find($id);

        if(!$category) {
            return response()->json([], 404);
        }

        return new CategoryResource($category);
    }

    public function update(Request $request, $id)
    
    {
        $category = Category::find($id);

        if(!$category) {
            return response()->json([], 400);
        }

        $category->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
        ]);

        return response()->json([]);
    }
    
    public function destroy($id)
    {   
        $category = Category::find($id);

       if(!$category) {
        return response()->json([
            '$category' => "No Result for cate$category",
        ], 400);
        }
       return $category->destroy($id);
        }
}

