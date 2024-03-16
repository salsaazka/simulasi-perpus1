<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Borrow PDF</title>
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
                    <th><h6>Name User</h6></th>
                    <th><h6>Title</h6></th>
                    <th><h6>Start</h6></th>
                    <th><h6>End</h6></th>
                    <th><h6>Status</h6></th>
                </tr>
            </thead>
            <tbody >
                @foreach ($dataBorrow as $borrow )
                <tr>
                    <td>{{ $borrow['no'] }}</td>
                    <td>{{ $borrow['user'] }}</td>
                    <td>{{ $borrow['title'] }}</td>
                    <td>{{ $borrow['start_date'] }}</td>
                    <td>{{ $borrow['end_date'] }}</td>
                    <td>{{ $borrow['status'] }}</td>
                </tr>
                @endforeach
            <tbody>  
        </table>
    </div>
   
</body>
</html>