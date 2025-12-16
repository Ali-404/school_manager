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

        .btn-credentials {
            background: #17a2b8;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            font-size: 0.9rem;
            margin-top: 15px;
            width: 100%;
        }

        .btn-credentials:hover {
            background: #138496;
        }

        .credentials-modal .form-control {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            padding: 10px;
            font-family: 'Courier New', monospace;
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
            background: #28a745;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            font-size: 0.9rem;
            cursor: pointer;
        }

        .btn-copy:hover {
            background: #218838;
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center vh-100">

    <div class="login-card text-center">
        <img src="/logo.png" class="header-logo" alt="logo">

        <h3 class="text-white mb-4">Welcome to Student Portal</h3>



        <form method="POST" action="/student-login">
            @csrf

            @if($errors->any())
                <div class="alert alert-danger text-start">{{ $errors->first() }}</div>
            @endif

            <input type="email" class="form-control mb-3" name="email" value="{{ old('email') }}"
                placeholder="Enter your email" required>
            <input type="password" class="form-control mb-3" name="password" placeholder="Enter your password" required>
            <button type="submit" class="btn btn-primary w-100">LOGIN</button>
        </form>

        <p class="text-white mt-3">Not a student?</p>
        <a href="{{ route('login') }}" class="btn btn-warning w-100">MANAGER PORTAL</a>
    </div>

    <!-- Credentials Modal -->
    <div class="modal fade credentials-modal" id="credentialsModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">📋 Student Credentials</h5>
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

                    <button class="btn btn-success w-100" onclick="copyBoth()">📋 Copy Both</button>
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