<!DOCTYPE html>
<html>

<head>
    <title>Detail Produk</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            position: relative;
        }

        .product-container {
            display: flex;
            justify-content: center;
            align-items: start;
            flex-direction: column;
            margin-top: 50px;
        }

        .product-image {
            width: 300px;
            height: 300px;
        }

        .product-image-container {
            background-color: #333;
            display: flex;
            flex-direction: row;
            justify-content: center;
            max-width: none;
            width: 100%;
        }

        .product-description {
            text-align: start;
            margin-bottom: 20px;
        }

        .product-price {
            margin: 16px;
            font-weight: bold;
        }

        .product-title {
            font-weight: bold;
            font-size: 18px;
            text-align: start;
        }

        .product-back {
            text-align: center;
            margin-top: 20px;
        }

        .back-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #f1f1f1;
            color: #333;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .back-button:hover {
            background-color: #ddd;
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

        .navbar-menu {
            display: flex;
            flex-direction: row;
        }

        .navbar-menu-item {
            margin: 8px;
        }

        .product-bottombar-container {
            padding: 32px 32px;
        }

        .bottombar {
            position: absolute;
            box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgba(14, 30, 37, 0.32) 0px 2px 16px 0px;
            bottom: 0;
            background-color: #ebfef6;
            padding-top: 24px;
            padding-bottom: 24px;
            max-width: none;
            width: calc(100%);
            display: flex;
            justify-content: space-between;
            align-content: center;
        }

        .bottombar-button-container {
            display: flex;
            align-content: center;
        }

        .button {
            background-color: green;
            color: white;
            padding: 10px 20px;
            border: none;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            border-radius: 8px;
            margin: 8px;
        }

        .button:hover {
            background-color: darkgreen;
        }
    </style>
</head>

<body>
    <div>
        <div class="navbar">
            <img class="navbar-icon" src="../logo_rigthttext.jpg" alt="" />
            <div class="navbar-menu">
                <a class="navbar-menu-item" href="">Pesanan</a>
                <a class="navbar-menu-item" href="">Produk</a>
                <a class="navbar-menu-item" href="">Penjualan</a>
            </div>
        </div>
        <div class="product-bottombar-container">
            <div class="product-container">
                <div class="product-image-container">
                    <img class="product-image" src="{{ $product['image'] }}" alt="Gambar Produk">
                </div>
                <div>
                    <p class="product-title">{{ $product['name'] }}</p>
                    <p class="product-description">{{ $product['description'] }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="bottombar">
        <p class="product-price">Total harga : Rp {{ $product['price'] }}</p>
        <div class="bottombar-button-container">
            <a class="button" href="">Tambah ke Keranjang</a>
            <a class="button" href="/product/{{$product['id']}}/price/{{$product['price']}}">Beli Langsung</a>
        </div>
    </div>
</body>

</html>