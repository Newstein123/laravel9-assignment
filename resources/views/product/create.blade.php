<x-layouts.master title="Product Page" name="Products">
    <div class="col-md-6">
       <x-form action="/products" method="POST">
        <x-inputcreate type="text" name="name" placeholder="Product Name"/>
        <x-inputcreate type="text" name="slug" placeholder="Slug"/>
        <x-inputcreate type="text" name="description" placeholder="Description"/>
        <x-inputcreate type="file" name="image" placeholder="Images"/>
        <x-inputcreate type="number" name="price" placeholder="Price"/>
        <x-inputcreate type="number" name="quantity" placeholder="Quantity"/>
        <select class="form-select" aria-label="Default select example"  name="categoryIds[]" multiple>
            @foreach ($categories as $category)
                <option value="{{$category->id}}"> {{$category->name}}</option>
            @endforeach
          </select>
        <x-submit title="Submit" />
        </x-form>
    </div>
</x-layouts.master>


   

    
