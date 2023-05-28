<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <script>
        function checkPasswordMatch() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("password_confirmation").value;

            if (password !== confirmPassword) {
                document.getElementById("password_confirmation").setCustomValidity("Passwords do not match");
            } else {
                document.getElementById("password_confirmation").setCustomValidity("");
            }
        }
    </script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        h2 {
            text-align: center;
        }

        .formquiz {
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

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
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
    <h2>Register</h2>
    <div class="formquiz">
        <form method="POST" action="{{ route('register.post') }}" style="padding:10px">
            @csrf

            <div>
                <label for="name">Name</label>
                <input type="text" name="name" required autofocus>
            </div>

            <div>
                <label for="email">Email</label>
                <input type="email" name="email" required>
            </div>

            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>

            <div>
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                    oninput="checkPasswordMatch()">
                <span id="password-match-warning" style="color: red;"></span>
            </div>


            <div>
                <label for="address">Address</label>
                <input type="text" name="address" required>
            </div>

            <div>
                <label for="age">Age</label>
                <input type="number" name="age" required>
            </div>

            <div style="display: flex; justify-content: space-between;">
                <div>
                    <button type="submit">Register</button>
                </div>
                <div>
                    <a href="{{ route('home') }}">
                        <button type="button">Back</button>
                    </a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>
