<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Portal - Login & Sign Up</title>

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

        .form-section {
            display: none;
        }

        .form-section.active {
            display: block;
        }

        .btn-tab.active {
            background: #0d6efd !important;
            border-color: #0d6efd !important;
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center vh-100">

    <div class="login-card text-center">
        <img src="/logo.png" class="header-logo" alt="logo">

        <h3 class="text-white mb-4" id="formTitle">Welcome to Manager Portal</h3>

        <div class="d-flex mb-3" id="tabButtons">
            <button class="btn btn-primary flex-fill btn-tab active" data-tab="login">LOGIN</button>
            <button class="btn btn-outline-light flex-fill ms-2 btn-tab" data-tab="signup">Sign Up</button>
        </div>

        <!-- Login Form -->
        <form id="loginForm" class="form-section active" method="POST" action="/login">
            @csrf

            @if($errors->any())
                <div class="alert alert-danger text-start">{{ $errors->first() }}</div>
            @endif

            <input name="email" type="email" class="form-control mb-3" value="{{ old('email') }}"
                placeholder="Enter your email" required>
            <input name="password" type="password" class="form-control mb-3" placeholder="Enter your password" required>
            <a href="#" class="text-light small d-block mb-3">Forgot password?</a>
            <button type="submit" class="btn btn-primary w-100">LOGIN</button>
        </form>

        <!-- Sign Up Form -->
        <form id="signupForm" class="form-section" method="POST" action="{{ route('register') }}">
            @csrf

            @if($errors->any())
                <div class="alert alert-danger text-start">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success text-start">{{ session('success') }}</div>
            @endif

            <input name="name" type="text" class="form-control mb-3" value="{{ old('name') }}" placeholder="Enter your name" required>
            <input name="email" type="email" class="form-control mb-3" value="{{ old('email') }}" placeholder="Enter your email" required>
            <input name="password" type="password" class="form-control mb-3" placeholder="Enter your password" required>
            <input name="password_confirmation" type="password" class="form-control mb-3" placeholder="Confirm your password" required>
            <button type="submit" class="btn btn-primary w-100">CREATE ACCOUNT</button>
        </form>

        <p class="text-white mt-3">Not a manager?</p>
        <a href="{{ route('student.login') }}" class="btn btn-warning w-100">STUDENT PORTAL</a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tabs = document.querySelectorAll('.btn-tab');
            const forms = document.querySelectorAll('.form-section');
            const formTitle = document.getElementById('formTitle');
            const tabButtons = document.getElementById('tabButtons');

            // Tab switching functionality
            tabs.forEach(tab => {
                tab.addEventListener('click', function () {
                    const targetTab = this.getAttribute('data-tab');

                    // Update active tab
                    tabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');

                    // Update active form
                    forms.forEach(form => {
                        form.classList.remove('active');
                        if (form.id === targetTab + 'Form') {
                            form.classList.add('active');
                        }
                    });

                    // Show tab buttons and reset title
                    tabButtons.style.display = 'flex';
                    formTitle.textContent = 'Welcome to Manager Portal';
                });
            });
        });
    </script>
    @include('partials.toasts')
</body>

</html>