@extends('layouts.master')
@section('title')
@section('name')
@section('content')
@foreach ($products as $product)
<div class="col-md-4 mt-3 mb-3">
    <div class="card">
        <div class="card-header"> {{$product->name}} 
        @foreach ($product->categories as $category)
           <b> {{$category->name}}</b>
        @endforeach
        </div>
       
        <div class="card-img-top">
            @foreach ($product->images as $image)
                <img src="{{Storage::url($image->path)}}" alt="hello">
            @endforeach
        </div>
        <div class="card-body"> 
            <div class="card-text">
                <p>{{$product->description}}</p>
            </div>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-between">
                
                <a href="/products/{{$product->id}}/edit" class="btn btn-success"> Edit </a>
                <a href="/products/{{$product->id}}" class="btn btn-primary"> View </a>
               <form action="/products/{{$product->id}}" method="POST" onclick="return confirm('Are You Sure to delete')">
            @csrf 
            @method('DELETE')
            <button class="btn btn-danger">
                Delete
            </button>
            </form>
            </div>
        </div>
    </div>
</div>
@endforeach 
@endsection
             
{{ $product->links() }}
