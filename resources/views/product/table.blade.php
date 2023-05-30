<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product</title>
    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin: -10px;
        }

        .col-md-4 {
            width: calc(33.33% - 20px);
            margin: 10px;
        }

        .card {
            border: 1px solid #ccc;
            border-radius: 16px;
            padding: 24px;
            background-color: #f9f9f9;
        }

        .card-body{
            flex: content;
            flex-direction: column;
            justify-content: flex-start;
        }

        .card-img-top {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
        }

        .card-title {
            font-size: 20px;
            font-weight: bold;
        }

        .card-text {
            font-size: 16px;
            margin-bottom: 32px;
        }

        .card-price {
            font-size: 20px;
            color: chocolate;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
            margin-bottom: 16px;
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Daftar Produk</h1>

        <div class="row">
            @foreach ($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ $product['image'] }}" class="card-img-top" alt="{{ $product['name'] }}">

                    <div class="card-body">
                        <div class="card-price">Harga: {{ $product['price'] }}</div>
                        <div class="card-title">{{ $product['name'] }}</div>
                        <div class="card-text">{{ $product['description'] }}</div>
                        <a href="/product/{{ $product['id'] }}" class="btn-primary">Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</body>

</html>