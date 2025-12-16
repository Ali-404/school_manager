<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Dashboard</title>
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

        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            margin-bottom: 20px;
            height: 100%;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 1px solid #e2e8f0;
        }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
        }

        .stat-card .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 24px;
            color: white;
        }

        .stat-card:nth-child(1) .stat-icon {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .stat-card:nth-child(2) .stat-icon {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .stat-card:nth-child(3) .stat-icon {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .stat-number {
            font-size: 2.8rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 10px;
        }

        .stat-label {
            color: #718096;
            font-size: 1rem;
            font-weight: 500;
        }

        .add-student-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            margin-bottom: 20px;
            text-align: center;
            height: 100%;
            border: 1px solid #e2e8f0;
            transition: all 0.4s ease;
        }

        .add-student-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
        }

        .add-student-card .add-icon {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 24px;
            color: white;
        }

        .content-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            margin-bottom: 20px;
            height: 100%;
            border: 1px solid #e2e8f0;
        }

        .content-card h5 {
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 20px;
            font-size: 1.3rem;
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

        .list-group-item {
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 10px;
            background: #f7fafc;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .list-group-item:hover {
            background: #edf2f7;
            transform: translateX(5px);
        }

        .btn-outline-primary {
            border-radius: 12px;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);
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

        <!-- Statistics -->
        <div class="row mt-4">
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="stat-number">{{ $modulesCount ?? 0 }}</div>
                    <div class="stat-label">Total Modules</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <div class="stat-number">{{ $studentsCount ?? 0 }}</div>
                    <div class="stat-label">Total Students</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-paperclip"></i>
                    </div>
                    <div class="stat-number">{{ $attachmentsCount ?? 0 }}</div>
                    <div class="stat-label">Total Attachments</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="add-student-card">
                    <div class="add-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <h5 style="font-weight: 700; color: #2d3748; margin-bottom: 10px;">Add New Student</h5>
                    <p class="text-muted mb-3" style="font-size: 0.9rem;">Register new students to the system</p>
                    <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                        <i class="fas fa-plus"></i> Add Student
                    </button>
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
                    <a href="{{ route('manager.modules') }}" class="btn btn-outline-primary btn-sm mt-3 w-100">
                        <i class="fas fa-arrow-right"></i> View All
                    </a>
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
                    <a href="{{ route('manager.students') }}" class="btn btn-outline-primary btn-sm mt-3 w-100">
                        <i class="fas fa-arrow-right"></i> View All
                    </a>
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