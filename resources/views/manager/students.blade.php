<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #ffffff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        .sidebar {
            background: #ffffff;
            color: #2d3748;
            min-height: 100vh;
            position: fixed;
            width: 250px;
            padding: 20px;
            left: 0;
            border-right: 2px dotted #cbd5e0;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
            min-height: 100vh;
        }

        .navbar {
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
            padding: 20px 30px;
            margin-bottom: 30px;
        }

        .content-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            margin-bottom: 20px;
            border: 1px solid #e2e8f0;
        }

        .sidebar a.nav-item {
            display: block;
            padding: 12px 15px;
            border-radius: 5px;
            margin-bottom: 5px;
            color: #4a5568;
            text-decoration: none;
            transition: all 0.3s ease;
            border: 1px dotted transparent;
        }

        .sidebar a.nav-item:hover {
            background: #f7fafc;
            color: #2d3748;
            border-color: #cbd5e0;
        }

        .sidebar a.nav-item.active {
            background: #edf2f7;
            color: #2d3748;
            border: 1px dotted #3498db;
        }

        .logo {
            width: 40px;
            margin-right: 10px;
        }

        .btn-add {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            border: none;
            padding: 14px 28px;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
        }

        .btn-logout {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
        }

        .btn-logout:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
        }

        .user-info {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.95rem;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .students-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            margin-top: 25px;
        }

        .student-card {
            background: white;
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 1px solid #e2e8f0;
        }

        .student-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
        }

        .student-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 2px dotted #e2e8f0;
        }

        .student-avatar {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            font-weight: bold;
        }

        .student-info h6 {
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 5px;
            font-size: 1.1rem;
        }

        .student-info small {
            color: #718096;
            font-size: 0.85rem;
        }

        .student-details {
            margin-bottom: 20px;
        }

        .student-detail-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 0;
            color: #4a5568;
            font-size: 0.9rem;
        }

        .student-detail-item i {
            color: #667eea;
            width: 20px;
        }

        .student-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn-action {
            flex: 1;
            padding: 10px;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-action-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .btn-action-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        .btn-action-success {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
        }

        .btn-action-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
        }

        .btn-action-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
        }

        .btn-action-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
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
                <span class="user-info me-3">
                    <i class="fas fa-user"></i> {{ auth()->user()->name ?? 'User' }}
                </span>
                <button class="btn btn-outline-secondary btn-sm me-2" data-bs-toggle="modal"
                    data-bs-target="#changePasswordModal" style="border-radius: 12px; font-weight: 600;">
                    <i class="fas fa-key"></i> Change Password
                </button>
                <form method="POST" action="{{ route('logout') }}" style="display:inline">
                    @csrf
                    <button type="submit" class="btn btn-logout">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Students Content -->
        <div class="content-card mt-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="mb-0">Students List ({{ $students->count() ?? 0 }})</h5>
                <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                    <i class="fas fa-user-plus"></i> Add Student
                </button>
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