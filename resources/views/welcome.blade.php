<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .button-group {
            margin-top: 20px;
        }

        .button-group a {
            display: inline-block;
            margin-right: 10px;
            text-decoration: none;
        }

        .button-group button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: #fff;
            cursor: pointer;
        }

        .button-group button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome to the Website</h2>

        <div class="button-group">
            <a href="{{ route('register') }}">
                <button type="button">Register</button>
            </a>
            <a href="{{ route('login') }}">
                <button type="button">Login</button>
            </a>
        </div>
    </div>
</body>
</html>
