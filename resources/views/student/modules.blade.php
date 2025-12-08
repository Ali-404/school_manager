<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Modules</title>
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
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 15px 30px;
        }
        .content-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .module-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 15px;
            border-left: 4px solid #3498db;
            transition: all 0.3s ease;
        }
        .module-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
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
        .btn-view {
            background: #17a2b8;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 6px;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .btn-view:hover {
            background: #138496;
            transform: translateY(-1px);
        }
        .course-content {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-top: 15px;
            display: none;
        }
        .course-item {
            padding: 10px;
            border-bottom: 1px solid #dee2e6;
            display: flex;
            justify-content: between;
            align-items: center;
        }
        .course-item:last-child {
            border-bottom: none;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <div class="d-flex align-items-center mb-4">
        <img src="/logo.png" class="logo" alt="logo">
        <h5 class="mb-0">Student Portal</h5>
    </div>
    
    <a href="{{ route('student.modules') }}" class="nav-item active">📚 My Modules</a>
</div>

<!-- Main Content -->
<div class="main-content">
    <!-- Top Bar -->
    <div class="navbar d-flex justify-content-between align-items-center">
        <div>
            <h3 class="mb-0">My Modules</h3>
            <small class="text-muted">{{ date('F d, Y') }}</small>
        </div>
        <div class="d-flex align-items-center">
            <span class="user-info me-3">Student Name</span>
            <a href="{{ route('student.login') }}" class="btn btn-logout">🚪 Logout</a>
        </div>
    </div>

    <!-- Modules Content -->
    <div class="content-card mt-4">
        <h5 class="mb-4">Available Modules</h5>

        <!-- Module 1 -->
        <div class="module-card">
            <div class="d-flex justify-content-between align-items-start">
                <div class="flex-grow-1">
                    <h4 class="text-primary mb-3">FRANCAIS V</h4>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="fw-bold">Made/Set</h6>
                            <ul class="list-unstyled">
                                <li class="text-muted">Cover 1</li>
                                <li class="text-muted">Cover 1</li>
                                <li class="text-muted">Cover 1</li>
                            </ul>
                        </div>
                        
                        <div class="col-md-6">
                            <h6 class="fw-bold">New Age:</h6>
                            <ul class="list-unstyled">
                                <li class="text-muted">2006</li>
                                <li class="text-muted">2006</li>
                                <li class="text-muted">2006</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <button class="btn btn-view view-course-btn" data-module="francais">
                    👁️ View Course
                </button>
            </div>
            
            <!-- Course Content (Hidden by default) -->
            <div class="course-content" id="francais-course">
                <h6 class="fw-bold mb-3">Course Materials:</h6>
                <div class="course-item">
                    <span>📄 Introduction to French Literature</span>
                    <small class="text-muted">PDF - 2.3MB</small>
                </div>
                <div class="course-item">
                    <span>🎥 Grammar Lesson Video</span>
                    <small class="text-muted">MP4 - 15:30</small>
                </div>
                <div class="course-item">
                    <span>📝 Assignment 1</span>
                    <small class="text-muted">Due: 2024-01-15</small>
                </div>
            </div>
        </div>

        <!-- Module 2 -->
        <div class="module-card">
            <div class="d-flex justify-content-between align-items-start">
                <div class="flex-grow-1">
                    <h5 class="text-primary">MATHEMATICS</h5>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <strong>Made/Set:</strong>
                            <div class="text-muted">Algebra Basics</div>
                        </div>
                        <div class="col-md-6">
                            <strong>New Age:</strong>
                            <div class="text-muted">2023</div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-view view-course-btn" data-module="mathematics">
                    👁️ View Course
                </button>
            </div>
            
            <!-- Course Content (Hidden by default) -->
            <div class="course-content" id="mathematics-course">
                <h6 class="fw-bold mb-3">Course Materials:</h6>
                <div class="course-item">
                    <span>📄 Algebra Fundamentals</span>
                    <small class="text-muted">PDF - 1.8MB</small>
                </div>
                <div class="course-item">
                    <span>🎥 Equation Solving Tutorial</span>
                    <small class="text-muted">MP4 - 22:15</small>
                </div>
                <div class="course-item">
                    <span>📝 Weekly Quiz</span>
                    <small class="text-muted">Due: 2024-01-20</small>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // View Course functionality
    document.querySelectorAll('.view-course-btn').forEach(button => {
        button.addEventListener('click', function() {
            const moduleId = this.getAttribute('data-module');
            const courseContent = document.getElementById(moduleId + '-course');
            
            // Toggle course content visibility
            if (courseContent.style.display === 'block') {
                courseContent.style.display = 'none';
                this.innerHTML = '👁️ View Course';
            } else {
                // Hide all other course contents
                document.querySelectorAll('.course-content').forEach(content => {
                    content.style.display = 'none';
                });
                // Reset all buttons
                document.querySelectorAll('.view-course-btn').forEach(btn => {
                    btn.innerHTML = '👁️ View Course';
                });
                // Show current course content
                courseContent.style.display = 'block';
                this.innerHTML = '👁️ Hide Course';
            }
        });
    });
</script>
</body>
</html>