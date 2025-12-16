<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Portal - Login & Sign Up</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #ffffff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-card {
            z-index: 9;
            background: #ffffff;
            border-radius: 24px;
            padding: 40px;
            width: 100%;
            max-width: 480px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            border: 1px solid #e2e8f0;
        }

        .header-logo {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            display: block;
            border-radius: 16px;
            padding: 10px;
            background: #f7fafc;
            border: 2px dotted #cbd5e0;
        }

        .form-section {
            display: none;
        }

        .form-section.active {
            display: block;
        }

        .btn-tab {
            border-radius: 12px;
            padding: 12px 24px;
            font-weight: 700;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .btn-tab.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            border-color: transparent !important;
            color: white !important;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-tab:not(.active) {
            background: #f7fafc !important;
            color: #4a5568 !important;
            border-color: #e2e8f0 !important;
        }

        .btn-tab:not(.active):hover {
            background: #edf2f7 !important;
            transform: translateY(-2px);
        }

        .form-control {
            border-radius: 12px;
            padding: 14px 18px;
            border: 2px solid #e2e8f0;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .input-group:focus-within {
            border-color: #667eea !important;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-weight: 700;
            font-size: 1rem;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        .btn-warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            border: none;
            border-radius: 12px;
            padding: 12px;
            font-weight: 700;
            color: white;
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
            transition: all 0.3s ease;
        }

        .btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(245, 158, 11, 0.4);
            color: white;
        }

        .alert {
            border-radius: 12px;
            border: none;
            padding: 14px 18px;
        }

        h3 {
            color: #2d3748;
            font-weight: 700;
            font-size: 1.8rem;
            margin-bottom: 30px;
        }

        .text-white {
            color: #2d3748 !important;
        }

        .text-light {
            color: #718096 !important;
        }

        .mainbg {
            background-image: url(bg1.jpg);
            background-size: cover;
            background-position: center;
        }

        .overf {
            position: absolute;
            width: 100dvw;
            height: 100dvh;
            background-color: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(8px);
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center vh-100 mainbg ">
    <div class="overf"></div>
    <div class="login-card text-center ">
        <img src="/logo.png" class="header-logo" alt="logo">

        <h3 class="mb-4" id="formTitle">
            <i class="fas fa-user-tie"></i> Welcome to Manager Portal
        </h3>

        <div class="d-flex mb-4 gap-2" id="tabButtons">
            <button class="btn flex-fill btn-tab active" data-tab="login">
                <i class="fas fa-sign-in-alt"></i> LOGIN
            </button>
            <button class="btn flex-fill btn-tab" data-tab="signup">
                <i class="fas fa-user-plus"></i> Sign Up
            </button>
        </div>

        <!-- Login Form -->
        <form id="loginForm" class="form-section active" method="POST" action="/login">
            @csrf

            @if($errors->any())
            <div class="alert alert-danger text-start">{{ $errors->first() }}</div>
            @endif

            <div class="mb-3">
                <div class="input-group" style="border-radius: 12px; overflow: hidden; border: 2px solid #e2e8f0;">
                    <span class="input-group-text"
                        style="background: #f7fafc; border: none; border-right: 2px solid #e2e8f0;">
                        <i class="fas fa-envelope text-muted"></i>
                    </span>
                    <input name="email" type="email" class="form-control" value="{{ old('email') }}"
                        placeholder="Enter your email" required style="border: none;">
                </div>
            </div>
            <div class="mb-3">
                <div class="input-group" style="border-radius: 12px; overflow: hidden; border: 2px solid #e2e8f0;">
                    <span class="input-group-text"
                        style="background: #f7fafc; border: none; border-right: 2px solid #e2e8f0;">
                        <i class="fas fa-lock text-muted"></i>
                    </span>
                    <input name="password" type="password" class="form-control" placeholder="Enter your password"
                        required style="border: none;">
                </div>
            </div>
            {{-- <a href="#" class="text-muted small d-block mb-3 text-decoration-none">
                <i class="fas fa-question-circle"></i> Forgot password?
            </a> --}}
            <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-sign-in-alt"></i> LOGIN
            </button>
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

            <div class="mb-3">
                <div class="input-group" style="border-radius: 12px; overflow: hidden; border: 2px solid #e2e8f0;">
                    <span class="input-group-text"
                        style="background: #f7fafc; border: none; border-right: 2px solid #e2e8f0;">
                        <i class="fas fa-user text-muted"></i>
                    </span>
                    <input name="name" type="text" class="form-control" value="{{ old('name') }}"
                        placeholder="Enter your name" required style="border: none;">
                </div>
            </div>
            <div class="mb-3">
                <div class="input-group" style="border-radius: 12px; overflow: hidden; border: 2px solid #e2e8f0;">
                    <span class="input-group-text"
                        style="background: #f7fafc; border: none; border-right: 2px solid #e2e8f0;">
                        <i class="fas fa-envelope text-muted"></i>
                    </span>
                    <input name="email" type="email" class="form-control" value="{{ old('email') }}"
                        placeholder="Enter your email" required style="border: none;">
                </div>
            </div>
            <div class="mb-3">
                <div class="input-group" style="border-radius: 12px; overflow: hidden; border: 2px solid #e2e8f0;">
                    <span class="input-group-text"
                        style="background: #f7fafc; border: none; border-right: 2px solid #e2e8f0;">
                        <i class="fas fa-lock text-muted"></i>
                    </span>
                    <input name="password" type="password" class="form-control" placeholder="Enter your password"
                        required style="border: none;">
                </div>
            </div>
            <div class="mb-3">
                <div class="input-group" style="border-radius: 12px; overflow: hidden; border: 2px solid #e2e8f0;">
                    <span class="input-group-text"
                        style="background: #f7fafc; border: none; border-right: 2px solid #e2e8f0;">
                        <i class="fas fa-lock text-muted"></i>
                    </span>
                    <input name="password_confirmation" type="password" class="form-control"
                        placeholder="Confirm your password" required style="border: none;">
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-user-plus"></i> CREATE ACCOUNT
            </button>
        </form>

        <p class="text-muted mt-4 mb-2 text-center">Not a manager?</p>
        <a href="{{ route('student.login') }}" class="btn btn-warning w-100">
            <i class="fas fa-graduation-cap"></i> STUDENT PORTAL
        </a>
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
                    formTitle.innerHTML = '<i class="fas fa-user-tie"></i> Welcome to Manager Portal';
                });
            });
        });
    </script>
    @include('partials.toasts')
</body>

</html>