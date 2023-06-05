<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        table {
            border-collapse: collapse;
        }

        body{
            margin: 0;
            padding: 0;
            width: 100%;
            max-width: none;
        }

        .container {
            width: 100%;
            max-width: none;
            padding: 40px;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: white;
        }

        tr:nth-child(odd) {
            background-color: white;
        }

        td.status {
            font-weight: bold;
        }

        td.status.green {
            background-color: green;
        }

        td.status.red {
            background-color: red;
            color: white;
        }

        .navbar {
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            max-width: none;
            height: 72px;
            position: absolute;
        }

        .navbar-icon {
            height: 72px;
        }

        .navbar-menu {
            display: flex;
            flex-direction: row;
        }

        .navbar-menu-item {
            margin: 8px;
        }
    </style>
</head>

<body>
    <div>
        <div class="navbar">
            <a href="/product">
                <img class="navbar-icon" src="../logo_rigthttext.jpg" alt="" />
            </a>
            <div class="navbar-menu">
                <a class="navbar-menu-item" href="/cart">Keranjang</a>
                <a class="navbar-menu-item" href="/history">History</a>
            </div>
        </div>
        <<div class="container">>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Message</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>User ID</th>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Product Image</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $history)
                        <tr class="{{ $loop->iteration % 2 == 0 ? 'green' : '' }}">
                            <td>{{ $history->id }}</td>
                            <td>{{ $history->created_at }}</td>
                            <td>{{ $history->updated_at }}</td>
                            <td>{{ $history->message }}</td>
                            <td>{{ $history->quantity }}</td>
                            <td>{{ $history->price }}</td>
                            <td>{{ $history['total-price'] }}</td>
                            <td class="status {{ $history->status == 'paid' ? 'green' : 'red' }}">{{ $history->status }}
                            </td>
                            <td>{{ $history->user_id }}</td>
                            <td>{{ $history->product_id }}</td>
                            <td>{{ $history->product_name }}</td>
                            <td><img src="{{ $history->product_image }}" alt="Product Image"></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
