<!DOCTYPE html>
<html>

<head>
    <title>Checkout</title>
    <style>
        body{

        }
    </style>
</head>

<body>
    <div class="checkout-container">
        <form action="{{ route('product.checkout') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="message">Pesan Opsional:</label>
                <input type="text" id="message" name="message">
            </div>
            <div class="form-group">
                <label for="quantity">Jumlah Barang:</label>
                <input type="number" id="quantity" name="quantity" min="1">
            </div>
            <div class="form-group">
                <label for="price">Harga Barang:</label>
                <input type="number" id="price" name="price" step="0.01" min="0" readonly value="{{ $price }}">
            </div>
            <div class="form-group">
                <label for="totalprice">Total Harga:</label>
                <p id="totalprice" name="totalprice" class="form-price">0.00</p>
            </div>
            <button type="submit" class="checkout-button">Checkout</button>
            <input type="hidden" name="id_product" value="{{ $idProduct }}">
        </form>
    </div>

    <script>
        // JavaScript for calculating total price
        document.addEventListener('DOMContentLoaded', function() {
            const quantityInput = document.getElementById('quantity');
            const priceInput = document.getElementById('price');
            const totalPriceElement = document.getElementById('totalprice');

            function calculateTotalPrice() {
                const quantity = quantityInput.value;
                const price = priceInput.value;
                const totalPrice = (quantity * price).toFixed(2);
                totalPriceElement.textContent = totalPrice;
            }

            quantityInput.addEventListener('input', calculateTotalPrice);
            priceInput.addEventListener('input', calculateTotalPrice);
        });
    </script>
</body>

</html>
