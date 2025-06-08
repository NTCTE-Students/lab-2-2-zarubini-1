<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <style>
        * {
            background: rgb(255, 231, 235)
        }
    </style>
</head>
<body>
    <h1>Login</h1>
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
        </div>
        <br>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>
        <br>
        <button type="submit">Login</button>
    </form>
    <br>
    <div>
        <a href="{{ route('register') }}">Don't have an account? Register here</a>
    </div>
</body>
</html>
