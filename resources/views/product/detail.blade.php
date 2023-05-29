<!DOCTYPE html>
<html>

<head>
    <title>Detail Produk</title>
    <style>
        .product-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin-top: 50px;
        }

        .product-image {
            width: 300px;
            height: 300px;
            margin-bottom: 20px;
        }

        .product-description {
            text-align: center;
            margin-bottom: 20px;
        }

        .product-price {
            font-weight: bold;
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
    </style>
</head>

<body>
    <div class="product-container">
        <img class="product-image" src="{{ $product['image'] }}" alt="Gambar Produk">
        <div class="product-description">
            <h2>{{ $product['name'] }}</h2>
            <p>{{ $product['description'] }}</p>
        </div>
        <div class="product-price">
            <p>{{ $product['price'] }}</p>
        </div>
    </div>
    <!-- back button -->
    <div class="product-back">
        <a href="/product" class="back-button">Kembali</a>
    </div>

</body>

</html>
