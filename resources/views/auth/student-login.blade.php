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
            margin: 0;
            padding: 20px;
        }
        .login-card {
            backdrop-filter: blur(12px);
            background: rgba(0, 0, 0, 0.7);
            border-radius: 20px;
            padding: 30px;
            width: 450px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            margin: 50px auto;
        }
        .header-logo {
            width: 80px;
            margin-bottom: 10px;
        }
        .text-white {
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.8);
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center min-vh-100">

    <div class="login-card text-center">
      
        <img src="/logo.png" class="header-logo" alt="student logo">
        
        <h3 class="text-white mb-4">Welcome to Student Portal</h3>
        
        <div class="d-flex mb-3">
            <button class="btn btn-success flex-fill">LOGIN</button>
            <button class="btn btn-outline-light flex-fill ms-2">Sign Up</button>
        </div>
        
        <form method="POST" action="{{ route('student.login') }}">
            @csrf
            <div class="text-white text-start mb-1">Email</div>
            <input type="email" class="form-control mb-3" name="email" placeholder="Enter your email" required>
            
            <div class="text-white text-start mb-1">Password</div>
            <input type="password" class="form-control mb-3" name="password" placeholder="Enter your password" required>
            
            <a href="#" class="text-light small d-block mb-3 text-decoration-none">Forgot password?</a>
            <button type="submit" class="btn btn-success w-100">LOGIN</button>
        </form>

        <p class="text-white mt-3">Not a student?</p>
        <a href="{{ route('login') }}" class="btn btn-info w-100">MANAGER PORTAL</a>
    </div>

</body>
</html>