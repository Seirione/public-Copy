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

    <!-- Display success message -->
    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <form action="{{ route('sub_home_insert') }}" method="POST">
        <!--- Protection natin-->
        @csrf
        <label for="category">Insert Category</label>
        <!-- Added value="{{ old('category') }}" to keep input on error -->
        <input type="text" name="category" id="category" placeholder="ex. Juice" value="{{ old('category') }}" required>
        <button type="submit">Submit</button>
    </form>

    <table border="1" style="margin-top: 20px; width: 50%; text-align: left;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Category</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- Moved the foreach loop outside <tr> so it loops rows, not cells -->
            @foreach($category as $item)
            <tr>
                <td>{{ $item->sub_category_pk }}</td>
                <td>{{ $item->Category }}</td>
                <td>
                    <!-- Placeholders for actions -->
                 <form action="{{ route('sub_update_table', $item->sub_category_pk) }}" method="GET">
                    <!-- No @csrf needed for GET requests -->
                    <button type="submit">Update</button>
                </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
