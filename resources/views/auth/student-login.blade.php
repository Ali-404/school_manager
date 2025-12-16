<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal - Login</title>
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

        .btn-credentials {
            background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 12px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-top: 15px;
            width: 100%;
            box-shadow: 0 4px 15px rgba(23, 162, 184, 0.3);
            transition: all 0.3s ease;
        }

        .btn-credentials:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(23, 162, 184, 0.4);
        }

        .credentials-modal .form-control {
            background: #f8f9fa;
            border: 2px solid #e2e8f0;
            padding: 12px;
            font-family: 'Courier New', monospace;
            border-radius: 12px;
        }

        .copy-field {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }

        .copy-field input {
            flex: 1;
        }

        .btn-copy {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 12px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
            transition: all 0.3s ease;
        }

        .btn-copy:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
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

        .text-muted {
            color: #718096 !important;
        }

        .mainbg {
            background-image: url(bg2.jpg);
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

<body class="mainbg d-flex justify-content-center align-items-center vh-100">
    <div class="overf"></div>
    <div class="login-card text-center">
        <img src="/logo.png" class="header-logo" alt="logo">

        <h3 class="mb-4">
            <i class="fas fa-graduation-cap"></i> Welcome to Student Portal
        </h3>

        <form method="POST" action="/student-login">
            @csrf

            @if($errors->any())
                <div class="alert alert-danger text-start">
                    <i class="fas fa-exclamation-circle"></i> {{ $errors->first() }}
                </div>
            @endif

            <div class="mb-3">
                <div class="input-group" style="border-radius: 12px; overflow: hidden; border: 2px solid #e2e8f0;">
                    <span class="input-group-text"
                        style="background: #f7fafc; border: none; border-right: 2px solid #e2e8f0;">
                        <i class="fas fa-envelope text-muted"></i>
                    </span>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                        placeholder="Enter your email" required style="border: none;">
                </div>
            </div>
            <div class="mb-3">
                <div class="input-group" style="border-radius: 12px; overflow: hidden; border: 2px solid #e2e8f0;">
                    <span class="input-group-text"
                        style="background: #f7fafc; border: none; border-right: 2px solid #e2e8f0;">
                        <i class="fas fa-lock text-muted"></i>
                    </span>
                    <input type="password" class="form-control" name="password" placeholder="Enter your password"
                        required style="border: none;">
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-sign-in-alt"></i> LOGIN
            </button>
        </form>

        <p class="text-muted mt-4 mb-2 text-center">Not a student?</p>
        <a href="{{ route('login') }}" class="btn btn-warning w-100">
            <i class="fas fa-user-tie"></i> MANAGER PORTAL
        </a>
    </div>

    <!-- Credentials Modal -->
    <div class="modal fade credentials-modal" id="credentialsModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-clipboard-list"></i> Student Credentials
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted mb-4">Copy your login credentials below:</p>

                    <div class="copy-field">
                        <input type="text" id="credentialsEmail" class="form-control" placeholder="Email" readonly>
                        <button class="btn btn-copy" onclick="copyField('credentialsEmail')">Copy</button>
                    </div>

                    <div class="copy-field">
                        <input type="text" id="credentialsPassword" class="form-control" placeholder="Password"
                            readonly>
                        <button class="btn btn-copy" onclick="copyField('credentialsPassword')">Copy</button>
                    </div>

                    <button class="btn btn-success w-100" onclick="copyBoth()"
                        style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); border: none; border-radius: 12px; padding: 12px; font-weight: 600; box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);">
                        <i class="fas fa-copy"></i> Copy Both
                    </button>
                    <small class="text-muted d-block mt-3">
                        ⚠️ <strong>Important:</strong> Your manager will provide you with your email and password.
                        Paste them above to view and copy. Keep them secure!
                    </small>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function copyField(fieldId) {
            const field = document.getElementById(fieldId);
            if (field.value.trim() === '') {
                if (window.appShowToast) appShowToast('Please paste your credentials in the field first.', 'warning');
                return;
            }
            navigator.clipboard.writeText(field.value).then(() => {
                if (window.appShowToast) appShowToast('Copied to clipboard!', 'success');
            }).catch(() => {
                if (window.appShowToast) appShowToast('Failed to copy. Please try again.', 'error');
            });
        }

        function copyBoth() {
            const email = document.getElementById('credentialsEmail').value.trim();
            const password = document.getElementById('credentialsPassword').value.trim();

            if (!email || !password) {
                if (window.appShowToast) appShowToast('Please fill in both email and password fields.', 'warning');
                return;
            }

            const credentials = `Email: ${email}\nPassword: ${password}`;
            navigator.clipboard.writeText(credentials).then(() => {
                if (window.appShowToast) appShowToast('Both credentials copied to clipboard!', 'success');
            }).catch(() => {
                if (window.appShowToast) appShowToast('Failed to copy. Please try again.', 'error');
            });
        }
    </script>

    @include('partials.toasts')
</body>

</html>