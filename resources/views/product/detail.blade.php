<!DOCTYPE html>
<html>

<head>
    <title>Detail Produk</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            position: fixed;
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

        .popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            z-index: 9999;
            display: none;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9998;
            display: none;
        }


        .chat-fab {
            height: 72px;
            width: 72px;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            background-color: white;
            position: fixed;
            bottom: 122px;
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
            <form action="/cart" method="POST">
                @csrf
                <input type="hidden" name="productId" value="{{ $product['id'] }}">
                <button type="submit" class="button" onclick="showPopup(event, {{ $product['id'] }})">Tambah ke Keranjang</button>
            </form>
            <a class="button" href="/product/{{ $product['id'] }}/price/{{ $product['price'] }}">Beli Langsung</a>
        </div>
    </div>
    <a class="chat-fab" href="/chat">
        <div class="chat-fab-img-container">
            <img class="chat-fab-img" src="../icon_chat.jpg" alt="">
        </div>
    </a>
    <div id="popup" class="popup">
        <h3>Item berhasil ditambahkan ke keranjang!</h3>
        <button onclick="closePopup()">Tutup</button>
    </div>

    <div id="popup-error" class="popup">
        <h3>Gagal menambahkan ke keranjang!</h3>
        <button onclick=" closePopupError()">Tutup</button>
    </div>

    <div id="overlay" class="overlay"></div>

</body>

<script>
    function showPopup(event, id) {
        event.preventDefault();
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var productId = id; // ID produk yang ingin ditambahkan ke keranjang
        fetch("/cart", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify({
                productId: productId
            })
        }).then(function(response) {
            if (response.status == 200) {
                var popup = document.getElementById('popup');
                var overlay = document.getElementById('overlay');
                popup.style.display = 'block';
                overlay.style.display = 'block';
            } else {
                var popup = document.getElementById('popup-error');
                var overlay = document.getElementById('overlay');
                popup.style.display = 'block';
                overlay.style.display = 'block';
            }
        });
    }



    function closePopup() {
        var popup = document.getElementById('popup');
        popup.style.display = 'none';
        var overlay = document.getElementById('overlay');
        overlay.style.display = 'none';
    }

    function closePopupError() {
        var popup = document.getElementById('popup-error');
        popup.style.display = 'none';
        var overlay = document.getElementById('overlay');
        overlay.style.display = 'none';
    }
</script>



</html>