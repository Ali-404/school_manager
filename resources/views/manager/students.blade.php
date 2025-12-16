<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        .sidebar {
            background: #2c3e50;
            color: white;
            min-height: 100vh;
            position: fixed;
            width: 250px;
            padding: 20px;
            left: 0;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
            min-height: 100vh;
        }

        .navbar {
            background: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 15px 30px;
        }

        .content-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .sidebar a.nav-item {
            display: block;
            padding: 12px 15px;
            border-radius: 5px;
            margin-bottom: 5px;
            color: white;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .sidebar a.nav-item:hover {
            background: #34495e;
        }

        .sidebar a.nav-item.active {
            background: #3498db;
        }

        .logo {
            width: 40px;
            margin-right: 10px;
        }

        .btn-add {
            background: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            font-size: 1rem;
        }

        .btn-logout {
            background: #dc3545;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 6px;
            font-size: 0.9rem;
        }

        .user-info {
            background: #e9ecef;
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: 500;
        }

        .table th {
            background: #f8f9fa;
            border-top: none;
        }

        .drag-drop-area {
            border: 2px dashed #dee2e6;
            border-radius: 10px;
            padding: 30px;
            text-align: center;
            background: #f8f9fa;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .drag-drop-area:hover {
            border-color: #3498db;
            background: #e3f2fd;
        }

        .drag-drop-area.dragover {
            border-color: #28a745;
            background: #e8f5e8;
        }

        .modal-body {
            max-height: 60vh;
            overflow-y: auto;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="d-flex align-items-center mb-4">
            <img src="/logo.png" class="logo" alt="logo">
            <h5 class="mb-0">School Portal</h5>
        </div>

        <a href="{{ route('manager.dashboard') }}" class="nav-item">📊 Dashboard</a>
        <a href="{{ route('manager.students') }}" class="nav-item active">👥 Students</a>
        <a href="{{ route('manager.modules') }}" class="nav-item">📚 Modules</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Bar -->
        <div class="navbar d-flex justify-content-between align-items-center">
            <div>
                <h3 class="mb-0">Students</h3>
                <small class="text-muted">{{ date('F d, Y') }}</small>
            </div>
            <div class="d-flex align-items-center">
                <span class="user-info me-3">{{ auth()->user()->name ?? 'User' }}</span>
                <button class="btn btn-outline-secondary btn-sm me-2" data-bs-toggle="modal"
                    data-bs-target="#changePasswordModal">Change Password</button>
                <form method="POST" action="{{ route('logout') }}" style="display:inline">
                    @csrf
                    <button type="submit" class="btn btn-logout">🚪 Logout</button>
                </form>
            </div>
        </div>

        <!-- Students Content -->
        <div class="content-card mt-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="mb-0">Students List ({{ $students->count() ?? 0 }})</h5>
                <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addStudentModal">+ Add
                    Student</button>
            </div>

            <!-- Search Bar -->
            <div class="mb-4">
                <input type="text" id="searchInput" class="form-control" placeholder="🔍 Search by name or email...">
            </div>

            <!-- Success/Error Messages -->
            @if($errors->any())
                <div class="alert alert-danger">
                    <strong>Error:</strong> {{ $errors->first() }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- New Credentials Display -->
            @if(session('student_created'))
                <div class="alert alert-success"
                    style="background: #d4edda; border-color: #c3e6cb; color: #155724; padding: 15px; border-radius: 6px; margin-bottom: 20px;">
                    <h5 class="mb-3">✅ Student Account Created Successfully!</h5>
                    <p class="mb-2"><strong>Name:</strong> {{ session('student_created')['name'] }}</p>
                    <p class="mb-2"><strong>Email:</strong> {{ session('student_created')['email'] }}</p>
                    <p class="mb-2">
                        <strong>Password:</strong>
                        <code
                            style="background: #fff; padding: 4px 8px; border-radius: 4px;">{{ session('student_created')['password'] }}</code>
                        <button class="btn btn-sm btn-outline-success" style="margin-left: 10px;"
                            onclick="copyToClipboard('{{ session('student_created')['email'] }}:{{ session('student_created')['password'] }}')">
                            📋 Copy Email (default password: student123)
                        </button>
                    </p>
                    <small class="text-muted">Share these credentials with the student. They should change the password on
                        first login.</small>
                </div>
            @endif

            <!-- Students Table -->
            @if(isset($students) && $students->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Joined</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $index => $student)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-success"
                                            onclick="copyToClipboard('{{ $student->email }}:student123')">
                                            📋 Copy (default password: student123)
                                        </button>
                                        <button class="btn btn-sm btn-outline-primary"
                                            onclick="editStudent({{ $student->id }}, '{{ addslashes($student->name) }}', '{{ $student->email }}')"
                                            data-bs-toggle="modal" data-bs-target="#editStudentModal">
                                            Edit
                                        </button>
                                        <form action="{{ route('students.destroy', $student) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Delete student: {{ $student->name }}?')">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted text-center py-4">No students found. Create one to get started!</p>
            @endif
        </div>
    </div>

    <!-- Add Student Modal -->
    <div class="modal fade" id="addStudentModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('students.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Full Name *</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                placeholder="Enter student name" required>
                            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Email *</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                placeholder="Enter email address" required>
                            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Age *</label>
                                <input type="number" name="age" class="form-control @error('age') is-invalid @enderror"
                                    placeholder="Enter age" min="5" max="100" required>
                                @error('age') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Gender *</label>
                                <select name="gender" class="form-select @error('gender') is-invalid @enderror"
                                    required>
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                                @error('gender') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="form-text text-muted">
                            A random password will be generated and displayed after creation.
                        </div>

                        <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" id="termsCheck" name="terms">
                            <label class="form-check-label" for="termsCheck">
                                I confirm that all information is correct
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create Student</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Student Modal -->
    <div class="modal fade" id="editStudentModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Full Name *</label>
                            <input type="text" id="editName" name="name" class="form-control"
                                placeholder="Enter student name" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Email *</label>
                            <input type="email" id="editEmail" name="email" class="form-control"
                                placeholder="Enter email address" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Password</label>
                            <input type="password" id="editPassword" name="password" class="form-control"
                                placeholder="Leave empty to keep current password">
                            <small class="text-muted">Leave empty to keep current password.</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Student</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function editStudent(id, name, email) {
            document.getElementById('editName').value = name;
            document.getElementById('editEmail').value = email;
            document.getElementById('editPassword').value = '';
            document.getElementById('editForm').action = `/manager/students/${id}`;
        }

        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                if (window.appShowToast) appShowToast('Credentials copied to clipboard!', 'success');
            }).catch(() => {
                if (window.appShowToast) appShowToast('Failed to copy. Please copy manually.', 'error');
            });
        }

        // Search functionality
        document.getElementById('searchInput').addEventListener('keyup', function () {
            const searchTerm = this.value.toLowerCase();
            const tableRows = document.querySelectorAll('table tbody tr');

            tableRows.forEach(row => {
                const name = row.cells[1].textContent.toLowerCase();
                const email = row.cells[2].textContent.toLowerCase();

                if (name.includes(searchTerm) || email.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
    <!-- Change Password Modal -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('manager.password.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Current Password</label>
                            <input type="password" name="current_password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Confirm New Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('partials.toasts')
</body>

</html>