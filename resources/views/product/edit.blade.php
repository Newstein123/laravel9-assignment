<x-layouts.master title="Product Page" name="Products">
    <div class="col-md-6">
       <x-form action="/products/{{$product->id}}" method="POST">
        @method('PUT')
        <x-inputedit type="text" name="name" placeholder="Product Name" value="{{$product->name}}"/>
        <x-inputedit type="text" name="slug" placeholder="Slug" value="{{$product->slug}}"/>
        <x-inputedit type="text" name="description" placeholder="Description" value="{{$product->description}}"/>
        <input type="file" name="image" class="form-control mt-3 mb-3">
        <x-inputedit type="number" name="price" placeholder="Price" value="{{$product->price}}"/>
        <x-inputedit type="number" name="quantity" placeholder="Quantity" value="{{$product->quantity}}"/>
            <select class="form-select" aria-label="Default select example"  name="categoryIds[]"
            multiple>
                @foreach ($categories as $category)
                    <option value="{{$category->id}}"
                        @if(in_array($category->id, old('categoryIds', $oldcategories)))
                         selected
                        @endif
                        > {{$category->name}}</option>
                @endforeach
              </select>
        <x-submit title="Submit" />
        </x-form>
    </div>
</x-layouts.master>


   

    
