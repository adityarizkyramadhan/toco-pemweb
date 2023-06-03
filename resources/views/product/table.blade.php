<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product</title>
    <style>
        body{
            margin: 0;
            padding: 0;
            width: 100%;
            max-width: none;
        }

        .container {
            width: 100%;
            max-width: none;
        }

        .banner-container{
            display: flex;
            justify-content: center;
            background-color: gray;
            border-radius: 16px;
            width: calc(100% - 64px);
            max-width: none;
            margin: 32px;
        }

        .banner{
            max-width: 50%;
            height: auto;
        }

        .daftar-product-title{
            margin: 16px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .col-md-4 {
            width: calc(25%);
            max-width: none;
        }

        .card {
            /* border: 1px solid #ccc; */
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            border-radius: 8px;
            padding: 12px;
            margin: 16px;
            background-color: #f9f9f9;
        }

        .card-body {
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

        .navbar {
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            max-width: none;
            height: 72px;
        }

        .navbar-icon {
            height: 72px;
        }

        .navbar-menu{
            display: flex;
            flex-direction: row;
        }

        .navbar-menu-item{
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
                <a class = "navbar-menu-item" href="/cart">Keranjang</a>
            </div>
        </div>
        <div class="container">
            <div class="banner-container">
                <img class="banner" src="/dummy_banner.jpg" alt="">
            </div>
            <h1 class="daftar-product-title">Daftar Produk</h1>
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
    </div>
</body>

</html>