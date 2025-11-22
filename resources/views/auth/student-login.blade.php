<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal - Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background: url('/background.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .login-card {
            backdrop-filter: blur(12px);
            background: rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 30px;
            width: 450px;
        }

        .header-logo {
            width: 80px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">

    <div class="login-card text-center">
        <img src="/logo.png" class="header-logo" alt="logo">

        <h3 class="text-white mb-4">Welcome to Student Portal</h3>

    

        <form method="POST" action="{{ route('student.login') }}">
            @csrf
            <input type="email" class="form-control mb-3" name="email" placeholder="Enter your email" required>
            <input type="password" class="form-control mb-3" name="password" placeholder="Enter your password" required>
            <a href="#" class="text-light small d-block mb-3">Forgot password?</a>
            <button type="submit" class="btn btn-primary w-100">LOGIN</button>
        </form>
        <p class="text-white mt-3">Not a student?</p>
        <a href="{{ route('login') }}" class="btn btn-warning w-100">MANAGER PORTAL</a>
    </div>

</body>
</html>
