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
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 15px 30px;
        }
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            height: 100%;
        }
        .add-student-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
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
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
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
            <span class="user-info me-3">Khalid</span>
            <a href="{{ route('login') }}" class="btn btn-logout">🚪 Logout</a>
        </div>
    </div>

    <!-- Statistics -->
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-number">1500</div>
                <div class="stat-label">Total Modules</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-number">1500</div>
                <div class="stat-label">Total Students</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-number">1500</div>
                <div class="stat-label">Total Attachments</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="add-student-card">
                <h5>Add New Student</h5>
                <p class="text-muted mb-3">Register new students to the system</p>
                <a href="{{ route('manager.students') }}" class="btn-add" style="text-decoration: none; display: inline-block;">+ Add Student</a>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="content-card">
                <h5 class="mb-3">Recent Created Modules</h5>
                <div class="list-group">
                    <div class="list-group-item border-0 d-flex justify-content-between align-items-center">
                        Français V
                        <small class="text-muted">01-02-2023</small>
                    </div>
                    <div class="list-group-item border-0 d-flex justify-content-between align-items-center">
                        Français V
                        <small class="text-muted">01-02-2023</small>
                    </div>
                    <div class="list-group-item border-0 d-flex justify-content-between align-items-center">
                        Français V
                        <small class="text-muted">01-02-2023</small>
                    </div>
                </div>
                <a href="{{ route('manager.modules') }}" class="btn btn-outline-primary btn-sm mt-3 w-100">View All</a>
            </div>
        </div>

        <div class="col-md-6">
            <div class="content-card">
                <h5 class="mb-3">Recent Students</h5>
                <div class="list-group">
                    <div class="list-group-item border-0 d-flex justify-content-between align-items-center">
                        Ahmed Ahmed
                        <small class="text-muted">01-02-2023</small>
                    </div>
                    <div class="list-group-item border-0 d-flex justify-content-between align-items-center">
                        Rachel Salm
                        <small class="text-muted">01-02-2023</small>
                    </div>
                    <div class="list-group-item border-0 d-flex justify-content-between align-items-center">
                        Blabla Blabla
                        <small class="text-muted">01-02-2023</small>
                    </div>
                </div>
                <a href="{{ route('manager.students') }}" class="btn btn-outline-primary btn-sm mt-3 w-100">View All</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>