<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @if(session('error'))
    <div style="color: red; background-color: #fee2e2; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
        <strong>Error:</strong> {{ session('error') }}
    </div>
@endif
   



   
<form action="{{route('downloadDatabase')}}">
    @csrf
<button type="submit">
    Download Database
</button>
</form>



<form action="{{route('demo_insert')}}" method="post">
    @csrf
    <label for="products_name">Products Name</label>
    <input type="text" name="products_name" id="products_name">

    <label for="products_amount">Products Amount</label>
    <input type="number" name="products_amount" id="products_amount">


     <label for="SKU">SKU</label>
    <input type="text" name="SKU" id="SKU">

    <label for="products_category_fk"> Category</label>
    <Select name="products_category_fk" required>
       
        <option value="" select disabled>
            Please Select Categories
        </option>
         @foreach($car as $category)
        <option value="{{$category->sub_category_pk}}">
            {{$category->Category}}
        </option>
        @endforeach
    </Select>

    <button type="submit">Submit</button>
</form>

</body>
</html>