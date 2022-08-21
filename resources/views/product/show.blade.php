<x-layouts.master title="Show Page" name="Product Detail">
   <div class="col-md-6">
    <div class="card">
        <div class="card-header">
            {{$product->name}}
        </div>
        <div class="card-img-top">
            @foreach ($product->images as $image)
            <img src={{Storage::files($image->path)}} alt="hello">
            @endforeach
        </div>
            <div class="card-body">
                {{$product->description}}
            </div>
            <div class="card-footer">
                <a href="/products" class="btn btn-danger"> Back  </a>
            </div>
    </div>
   </div>
</x-layouts.master>