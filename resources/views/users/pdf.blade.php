<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Convert to pdf</title>
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <h1>Users List</h1>
    <table>
        <thead>
            <tr>
                <th>Qr Code</th>
                <th>ID</th>
                <th>Fullname</th>
                <th>Username</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @php $count = 0; @endphp
            @foreach($users as $user)
                @if($count++ > 10)
                <div style="page-break-after: always"> &nbsp; </div>
                @php $count = 0; @endphp
                @endif
            <tr>
                <td><img src="data:image/png;base64,{{ base64_encode(QrCode::size(80)->generate($user->username ?? 'No Name')) }}" alt="QR Code"></td>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->full_name }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
