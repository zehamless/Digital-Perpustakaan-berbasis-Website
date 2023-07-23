<!DOCTYPE html>
<html>
<head>
    <title>Books List</title>
    <style>
        /* Define your CSS styles for the PDF here */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<h2>Books List</h2>
<table>
    <thead>
    <tr>
        <th>Title</th>
        <th>Category</th>
        <th>Amount</th>
        <th>Description</th>
        <th>Cover</th>
    </tr>
    </thead>
    <tbody>
    @foreach($books as $book)
        <tr>
            <td>{{ $book->title }}</td>
            <td>{{ $book->category->name }}</td>
            <td>{{ $book->amount }}</td>
            <td>{{ $book->description }}</td>
            <td>
                <img src="{{ public_path('storage/'. $book->cover) }}" width="50px" height="80px">
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
