<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategroyRequest;
use App\Http\Requests\UpdateCategroyRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        return view('category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategroyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategroyRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $categroy
     * @return \Illuminate\Http\Response
     */
    public function show(Category $categroy)
    {
        return view('category.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $categroy
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $categroy)
    {
        return view('category.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategroyRequest  $request
     * @param  \App\Models\Category  $categroy
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategroyRequest $request, Category $categroy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $categroy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $categroy)
    {
        //
    }
}
