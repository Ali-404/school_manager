<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Portal - Login</title>

    <!-- Bootstrap 5 -->
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

        <h3 class="text-white mb-4">Welcome to Manager Portal</h3>

        <div class="d-flex mb-3">
            <button class="btn btn-primary flex-fill">LOGIN</button>
            <button class="btn btn-outline-light flex-fill ms-2">Sign Up</button>
        </div>

        <form>
            <input type="email" class="form-control mb-3" placeholder="Enter your email">
            <input type="password" class="form-control mb-3" placeholder="Enter your password">
            <a href="#" class="text-light small d-block mb-3">Forgot password?</a>
            <button class="btn btn-primary w-100">LOGIN</button>
        </form>
        <p class="text-white mt-3">Not a manager?</p>
        <a href="{{ route('student.login') }}" class="btn btn-warning w-100">STUDENT PORTAL</a>
    </div>

</body>
</html>