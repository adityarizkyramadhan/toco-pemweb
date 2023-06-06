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
            max-width: none;
            width: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            max-width: none;
        }

        .container {
            width: 100%;
            max-width: none;
            padding-top: 40px;
        }

        td {
            padding-left: 8px;
            padding-right: 8px;
            text-align: left;
            width: calc(100%/8);
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr {
            height: 32px;
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

        .item-image {
            width: calc(100%);
            height: 128px;
            object-fit: cover;
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

        .chat-fab {
            height: 72px;
            width: 72px;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            background-color: white;
            position: fixed;
            bottom: 20px;
            right: 20px;
            border-radius: 50%;
        }

        .chat-fab-img-container {
            height: 100%;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .chat-fab-img {
            height: 32px;
            width: 32px;
            padding: 8px;
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
        <a class="chat-fab" href="/chat">
            <div class="chat-fab-img-container">
                <img class="chat-fab-img" src="../icon_chat.jpg" alt="">
            </div>
        </a>
        <<div class="container">>
            <table>
                <thead>
                    <tr>
                        <th>Created At</th>
                        <th>Message</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Product Name</th>
                        <th>Product Image</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $history)
                    <tr class="{{ $loop->iteration % 2 == 0 ? 'green' : '' }}">
                        <td>{{ $history->created_at }}</td>
                        <td>{{ $history->message }}</td>
                        <td>{{ $history->quantity }}</td>
                        <td>{{ $history->price }}</td>
                        <td>{{ $history['total-price'] }}</td>
                        <td class="status {{ $history->status == 'paid' ? 'green' : 'red' }}">{{ $history->status }}
                        </td>
                        <td>{{ $history->product_name }}</td>
                        <td><img class="item-image" src="{{ $history->product_image }}" alt="Product Image"></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
    </div>
</body>

</html>