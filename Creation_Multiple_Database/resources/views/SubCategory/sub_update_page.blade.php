<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

 <!-- Display generic error message if validation fails -->
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    
    <h1>UPDATE PAGE</h1>
    <form action="{{route('sub_updating_table', $category_update->sub_category_pk)}}" method="POST">
        <!--- Protection natin-->
        @csrf
        @method('PUT')
        <label for="category">Insert Category</label>
        <input type="text" name="category" id="category" placeholder="ex. Juice" value="{{$category_update->Category}}" required>
        <button type="submit">Submit</button>
    </form>

</body>
</html>