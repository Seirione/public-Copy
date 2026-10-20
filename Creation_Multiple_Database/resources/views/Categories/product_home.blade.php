<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Form</title>
</head>
<body>
      <hr style="margin: 40px 0;">

    <h2>Product Inventory List</h2>
    
    <table border="1" style="width: 100%; border-collapse: collapse; text-align: left; margin-top: 20px;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th style="padding: 10px;">ID</th>
                <th style="padding: 10px;">Product Name</th>
                <th style="padding: 10px;">Price / Amount</th>
                <th style="padding: 10px;">SKU</th>
                <th style="padding: 10px;">Category Assigned</th>
            </tr>
        </thead>
        <tbody>
            @if($products->isEmpty())
                <tr>
                    <td colspan="5" style="text-align: center; padding: 15px; color: gray;">
                        No products available yet.
                    </td>
                </tr>
            @else
                @foreach($products as $item)
                <tr>
                    <td style="padding: 10px;">{{ $item->products_pk }}</td>
                    <td style="padding: 10px;">{{ $item->products_name }}</td>
                    <!-- Formatted to currency layout -->
                    <td style="padding: 10px;">₱{{ number_format($item->products_amount, 2) }}</td>
                    <td style="padding: 10px;"><code>{{ $item->SKU }}</code></td>
                    <td style="padding: 10px;">
                    <!-- Changed $item->category_name to $item->category -->
                    {{ $item->category ? $item->category->Category : 'No Category Assigned' }}
                </td>

                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>


    <!-- Display Validation Errors -->
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Display Success Message -->
    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif
    
    <form action="{{ route('product_insert') }}" method="POST">
        @csrf

        <div>
            <label for="products_name">Product Name:</label>
            <input type="text" name="products_name" id="products_name" value="{{ old('products_name') }}" required>
        </div><br>

        <div>
            <label for="products_amount">Amount/Price:</label>
            <input type="number" step="0.01" name="products_amount" id="products_amount" value="{{ old('products_amount') }}" required>
        </div><br>

        <div>
            <label for="SKU">SKU:</label>
            <input type="text" name="SKU" id="SKU" value="{{ old('SKU') }}" required>
        </div><br>

        <div>
            <label for="sub_categories">Category:</label>
            <select name="sub_categories" id="sub_categories" required>
                <option value="" selected disabled>--Select Categories--</option>
                @foreach($sub as $categories)
                    <option value="{{ $categories->sub_category_pk }}" {{ old('sub_categories') == $categories->sub_category_pk ? 'selected' : '' }}>
                        {{ $categories->Category }}
                    </option>
                @endforeach
            </select>
        </div><br>

        <button type="submit">Submit Product</button>
    </form>
</body>
</html>
