<!DOCTYPE html>
<html>

<head>
    <title>Checkout</title>
    <style>
        body {
            padding: 0;
            margin: 0;
            width: 100%;
            max-width: none;
        }

        .top-logo{
            width: 50%;
        }

        .main-container {
            display: flex;
            flex-direction: column;
            align-content: center;
            align-items: center;
            width: 100%;
            max-width: none;
            height: 100%;
            max-height: none;
        }

        .info-container {
            margin: 64px;
            max-width: none;
            width: calc(100% - 196px);
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            border-radius: 8px;
            padding: 32px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            margin-top: 16px;
            margin-bottom: 16px;
            margin-left: 8px;
            margin-right: 8px;
            max-width: none;
            width: 50%;
        }

        .jumlah-harga-container {
            display: flex;
            align-content: center;
            justify-content: center;
            width: 100%;
        }

        .input-form {
            padding: 6px 12px;
            font-size: 16px;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            appearance: none;
            border-radius: 4px;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        .input-form:focus {
            color: #212529;
            background-color: #fff;
            border-color: #86b7fe;
            outline: 0;
            box-shadow: 0 0 0 0.25rem rgb(13 110 253 / 25%);
        }

        .input-form:read-only {
            color: gray;
        }

        .pesan-opsional-warning-container {
            display: flex;
            flex-direction: column;
            align-content: center;
            justify-content: center;
            width: 50%;
            margin: 8px;
            height: 100%;
        }

        .pesan-opsional-warning {
            color: green;
            font-weight: bold;
            font-size: 16px;
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
            width: 100%;
            margin: 8px;
        }

        .button:hover {
            background-color: darkgreen;
        }
    </style>
</head>

<body>
    <div class="main-container">
        <img class="top-logo" src="../../../logo_rigthttext.jpg" alt="">
        <div class="info-container">
            @foreach($products as $item)
                <form action="" method="">
                    @csrf
                    <div class="jumlah-harga-container">
                        <div class="form-group">
                            <label for="quantity">Nama Barang: {{$item->name}}</label> 
                        </div>
                        <div class="form-group">
                            <label for="quantity">Jumlah Barang:</label>
                            <input class="input-form {{"quantity"}}" type="number" id="quantity" name="quantity" min="1">
                        </div>
                        <div class="form-group">
                            <label for="price">Harga Barang:</label>
                            <input class="input-form price" type="number" id="price" name="price" step="0.01" min="0" readonly value="{{$item->price}}">
                        </div>
                    </div>

                    <hr>

                </form>
                @endforeach
                

            <form action="{{ route('cart.checkout.post') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="totalprice">Total Harga:</label>
                    <p id="totalprice" name="totalprice" class="form-price">0.00</p>
                </div>
                <div class="jumlah-harga-container">
                    <div class="form-group">
                        <label for="message">Pesan Opsional:</label>
                        <input class="input-form" type="text" id="message" name="message">
                    </div>
                    <div class="pesan-opsional-warning-container">
                        <p class="pesan-opsional-warning">NB. Pesan ini digunakan untuk memaksimalkan pengiriman paket sesuai dengan yang pembeli inginkan.</p>
                    </div>
                </div>
                <button type="submit" class="button">Checkout</button>
                <input type="hidden" name="totalprice" id="totalprice_co"> 
                <input type="hidden" name="quantity" id="quantity_co">
                <input type="hidden" name="quantity_arr" id="quantity_arr">

            </form>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
        const quantityInput = document.getElementsByClassName('quantity');
        const priceInput = document.getElementsByClassName('price');
        const totalPriceElement = document.getElementById('totalprice');
        const totalPriceCOElement = document.getElementById('totalprice_co');
        console.log(quantityInput[0])

        function totalQuantity() {
            let sum = 0;
            let quantity_arr = [];
            for (let i = 0; i < quantityInput.length; i++) {
                const quantity = quantityInput[i].value;
                quantity_arr.push(quantity);
                sum += Number(quantity);
            }
            document.getElementById('quantity_arr').value = quantity_arr;
            document.getElementById('quantity_co').value = sum; 
        }
        function calculateTotalPrice() {
            quantities = document.getElementsByClassName('quantity')
            let sum = 0;
            for (let i = 0; i < quantities.length; i++) {
                const quantity = quantities[i].value;
                const price = priceInput[i].value;
                const totalPrice = (quantity * price).toFixed(2);
                sum += Number(totalPrice);
            }

            totalPriceElement.textContent = sum;
            totalPriceCOElement.value = sum;
        }


        quantityInput[quantityInput.length - 1].addEventListener('input', calculateTotalPrice);
        quantityInput[quantityInput.length - 1].addEventListener('input', totalQuantity);
        priceInput[priceInput.length - 1].addEventListener('input', calculateTotalPrice);

        });
    </script>
</body>
</html>
