<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjank!</title>
</head>
<body>
    <h1>Keranjang</h1>
    <table>
        <th>No.</th>
        <th>harga</th>
        <th>Nama Produk</th>
        <th>Delete Produk</th>

        @foreach ($products as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->price }}</td>
                <td>{{ $item->name }}</td>
                <td>
                    <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>

            </tr>
        @endforeach
    </table>

    <form action="{{ route('cart.checkout') }}" method="GET">
        @csrf
        <input type="submit" value="Checkout">
    </form>
</body>
</html>