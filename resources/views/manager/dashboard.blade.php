<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Dashboard</title>
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

        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            height: 100%;
        }

        .add-student-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            text-align: center;
            height: 100%;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .stat-label {
            color: #7f8c8d;
            font-size: 1rem;
        }

        .content-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            height: 100%;
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
            padding: 12px 25px;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
        }

        .btn-add:hover {
            background: #218838;
            transform: translateY(-2px);
            transition: all 0.3s ease;
        }

        .btn-logout {
            background: #dc3545;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 6px;
            font-size: 0.9rem;
        }

        .btn-logout:hover {
            background: #c82333;
        }

        .user-info {
            background: #e9ecef;
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: 500;
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

        <a href="{{ route('manager.dashboard') }}" class="nav-item active">📊 Dashboard</a>
        <a href="{{ route('manager.students') }}" class="nav-item">👥 Students</a>
        <a href="{{ route('manager.modules') }}" class="nav-item">📚 Modules</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Bar -->
        <div class="navbar d-flex justify-content-between align-items-center">
            <div>
                <h3 class="mb-0">Dashboard</h3>
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

        <!-- Statistics -->
        <div class="row mt-4">
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-number">{{ $modulesCount ?? 0 }}</div>
                    <div class="stat-label">Total Modules</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-number">{{ $studentsCount ?? 0 }}</div>
                    <div class="stat-label">Total Students</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-number">{{ $attachmentsCount ?? 0 }}</div>
                    <div class="stat-label">Total Attachments</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="add-student-card">
                    <h5>Add New Student</h5>
                    <p class="text-muted mb-3">Register new students to the system</p>
                    <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addStudentModal">+ Add
                        Student</button>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="content-card">
                    <h5 class="mb-3">Recent Created Modules</h5>
                    <div class="list-group">
                        @forelse($recentModules as $module)
                            <div class="list-group-item border-0 d-flex justify-content-between align-items-center">
                                {{ $module->name }}
                                <small class="text-muted">{{ optional($module->created_at)->format('d-m-Y') }}</small>
                            </div>
                        @empty
                            <div class="list-group-item border-0 text-muted">No recent modules.</div>
                        @endforelse
                    </div>
                    <a href="{{ route('manager.modules') }}" class="btn btn-outline-primary btn-sm mt-3 w-100">View
                        All</a>
                </div>
            </div>

            <div class="col-md-6">
                <div class="content-card">
                    <h5 class="mb-3">Recent Students</h5>
                    <div class="list-group">
                        @forelse($recentStudents as $student)
                            <div class="list-group-item border-0 d-flex justify-content-between align-items-center">
                                {{ $student->name }}
                                <small class="text-muted">{{ optional($student->created_at)->format('d-m-Y') }}</small>
                            </div>
                        @empty
                            <div class="list-group-item border-0 text-muted">No recent students.</div>
                        @endforelse
                    </div>
                    <a href="{{ route('manager.students') }}" class="btn btn-outline-primary btn-sm mt-3 w-100">View
                        All</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Student Modal -->
    <div class="modal fade" id="addStudentModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <!-- Student Photo -->
                        <!-- Student information fields (no photo) -->

                        <!-- Student Information -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Full Name *</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter full name" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Email *</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter email address"
                                required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Age *</label>
                                <input type="number" name="age" class="form-control" placeholder="Enter age" min="5"
                                    max="100" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Gender *</label>
                                <select name="gender" class="form-select" required>
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>

                        <!-- Confirmation checkbox -->
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="termsCheck" name="terms">
                            <label class="form-check-label" for="termsCheck">
                                I confirm that all information is correct
                            </label>
                        </div>

                        <div class="form-text text-muted">
                            A random password will be generated and displayed after creation.
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Drag and drop handlers only if photo inputs exist (removed for students without photos)
        (function () {
            const dropArea = document.getElementById('photoDropArea');
            const photoInput = document.getElementById('photoInput');
            if (!dropArea || !photoInput) return;

            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                dropArea.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, unhighlight, false);
            });

            function highlight() {
                dropArea.classList.add('dragover');
            }

            function unhighlight() {
                dropArea.classList.remove('dragover');
            }

            dropArea.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                handleFiles(files);
            }

            photoInput.addEventListener('change', function () {
                handleFiles(this.files);
            });

            function handleFiles(files) {
                if (files.length > 0) {
                    const file = files[0];
                    if (file.type.startsWith('image/')) {
                        dropArea.innerHTML = `
                    <div class="text-success mb-2">✅</div>
                    <p class="text-success mb-1">Photo uploaded successfully!</p>
                    <small class="text-muted">${file.name}</small>
                `;
                    }
                }
            }
        })();
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