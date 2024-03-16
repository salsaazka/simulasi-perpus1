<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Book PDF</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

{{-- 
    <style>
       table, th, td {
  border: 1px solid;
}
    </style> --}}
</head>
<body>
    <div class="container">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th><h6>No</h6></th>
                    <th><h6>Title</h6></th>
                    <th><h6>Writer</h6></th>
                    <th><h6>Publisher</h6></th>
                    <th><h6>Name Image</h6></th>
                    <th><h6>Year</h6></th>
                </tr>
            </thead>
            <tbody >
                @foreach ($dataBook as $book )
                <tr>
                    <td>{{ $book['id'] }}</td>
                    <td>{{ $book['title'] }}</td>
                    <td>{{ $book['writer'] }}</td>
                    <td>{{ $book ['publisher']}}</td>
                    <td>{{ $book['image'] }}</td>
                    <td>{{ \Carbon\Carbon::parse ($book['year'])->format('j F, Y') }}</td>
                    {{-- <td> <p class="text-muted"><span class="date">{{ 
                    is_null($book['done_time']) ? '-' : \Carbon\Carbon::parse($book['done_time'])->format('j F, Y') 
                    }}</span></p></td> --}}
                </tr>
                @endforeach
            <tbody>  
        </table>
    </div>
   
</body>
</html>