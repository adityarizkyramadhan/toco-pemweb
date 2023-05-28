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
            border-radius: 5px;
            padding: 10px;
            background-color: #f9f9f9;
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
            margin-bottom: 10px;
        }

        .card-text {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .card-subtitle {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
            padding: 8px 16px;
            border-radius: 5px;
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
                                <h5 class="card-title">{{ $product['name'] }}</h5>
                                <p class="card-text">{{ $product['description'] }}</p>
                                <h6 class="card-subtitle mb-2 text-muted">Harga: {{ $product['price'] }}</h6>
                                <a href="#" class="btn btn-primary">Beli</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

</body>

</html>
