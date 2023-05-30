<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        h2 {
            text-align: center;
        }

        form {
            max-width: 300px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        input[type="checkbox"] {
            margin-bottom: 10px;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        button[type="button"] {
            background-color: #F15A59;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="button"]:hover {
            background-color: #D21312;
        }
    </style>
</head>

<body>
    <!-- Form login -->
    <h2>Login</h2>

    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
            {{-- <button type="button" class="close" data-dismiss="alert">×</button> --}}
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <form method="POST" action="{{ route('login') }}">
        @csrf


        <div>
            <label for="email">Email</label>
            <input type="email" name="email" required autofocus>
        </div>

        <div>
            <label for="password">Password</label>
            <input type="password" name="password" required>
        </div>

        <div style="display: flex; justify-content: space-between;">
            <div>
                <button type="submit">Login</button>
            </div>
            <div>
                <a href="{{ route('home') }}">
                    <button type="button">Back</button>
                </a>
            </div>
        </div>
    </form>
</body>

</html>
