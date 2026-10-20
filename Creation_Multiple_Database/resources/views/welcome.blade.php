<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Product</title>
</head>
<body>

    <h2>Add New Product</h2>

    <!-- Replace "/products" with your actual form submission URL -->
    <form action="/products" method="POST">
        
        <!-- Product Name -->
        <p>
            <label for="products_name">Product Name:</label><br>
            <input type="text" id="products_name" name="products_name" required>
        </p>

        <!-- Product Amount -->
        <p>
            <label for="products_amount">Amount / Price:</label><br>
            <input type="number" id="products_amount" name="products_amount" step="0.01" required>
        </p>

        <!-- SKU -->
        <p>
            <label for="SKU">SKU:</label><br>
            <input type="text" id="SKU" name="SKU" required>
        </p>

        <!-- Category Dropdown -->
        <p>
          
            <label for="products_category_fk">Category:</label><br>
            <select id="products_category_fk" name="products_category_fk" required>
                <option value="" disabled selected>-- Choose Category --</option>
                  @foreach($subcategory as $s)
                        <option value="{{$s->sub_category_pk}}" disabled selected>{{$s->Category}}</option>
                  @endforeach
            </select>
       =
        </p>

      

        <!-- Sub Category Table Name (hidden value) -->
        <input type="hidden" name="sub_category_tb" value="sub_categories_tb">

        <!-- Submit Button -->
        <button type="submit">Save Product</button>

    </form>

</body>
</html>
