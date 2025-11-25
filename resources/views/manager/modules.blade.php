<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modules Management</title>
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
    <a href="{{ route('manager.students') }}" class="nav-item">👥 Students</a>
    <a href="{{ route('manager.modules') }}" class="nav-item active">📚 Modules</a>
</div>

<!-- Main Content -->
<div class="main-content">
    <!-- Top Bar -->
    <div class="navbar d-flex justify-content-between align-items-center">
        <div>
            <div>
    <h3 class="mb-0">Modules</h3>
    <small class="text-muted">{{ date('F d, Y') }}</small>
</div>
        
        </div>
        <div class="d-flex align-items-center">
            <span class="user-info me-3">Khalid</span>
            <a href="{{ route('login') }}" class="btn btn-logout">🚪 Logout</a>
        </div>
    </div>

    <!-- Add Module Button -->
    <div class="content-card mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0">All Modules</h5>
            <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addModuleModal">+ Add Module</button>
        </div>

        <!-- Modules List -->
        <div class="module-card">
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
            
            <div class="mt-3">
                <button class="btn btn-sm btn-outline-primary me-2">Edit</button>
                <button class="btn btn-sm btn-outline-danger">Delete</button>
            </div>
        </div>

        <!-- More modules can be added here -->
        <div class="module-card">
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
            <div class="mt-3">
                <button class="btn btn-sm btn-outline-primary me-2">Edit</button>
                <button class="btn btn-sm btn-outline-danger">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Add Module Modal -->
<div class="modal fade" id="addModuleModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Module</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Module Title *</label>
                    <input type="text" class="form-control" placeholder="Enter module title" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Total Hours *</label>
                    <input type="number" class="form-control" placeholder="Enter total hours" required>
                </div>

                <!-- File Upload Area -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Upload Files</label>
                    <div class="drag-drop-area" id="fileDropArea">
                        <div class="mb-2">📁</div>
                        <p class="text-muted mb-1">Drag & drop files here</p>
                        <small class="text-muted">or</small>
                        <div class="mt-2">
                            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="document.getElementById('fileInput').click()">Browse Files</button>
                            <input type="file" id="fileInput" multiple style="display: none;">
                        </div>
                    </div>
                </div>

                <!-- Format -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Format</label>
                    <select class="form-select">
                        <option>Online</option>
                        <option>Classroom</option>
                        <option>Hybrid</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Confirm</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Drag and drop functionality for files
    const fileDropArea = document.getElementById('fileDropArea');
    const fileInput = document.getElementById('fileInput');

    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        fileDropArea.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        fileDropArea.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        fileDropArea.addEventListener(eventName, unhighlight, false);
    });

    function highlight() {
        fileDropArea.classList.add('dragover');
    }

    function unhighlight() {
        fileDropArea.classList.remove('dragover');
    }

    fileDropArea.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        handleFiles(files);
    }

    fileInput.addEventListener('change', function() {
        handleFiles(this.files);
    });

    function handleFiles(files) {
        if (files.length > 0) {
            let fileNames = [];
            for (let i = 0; i < files.length; i++) {
                fileNames.push(files[i].name);
            }
            
            fileDropArea.innerHTML = `
                <div class="text-success mb-2">✅</div>
                <p class="text-success mb-1">${files.length} file(s) uploaded successfully!</p>
                <small class="text-muted">${fileNames.join(', ')}</small>
            `;
        }
    }
</script>
</body>
</html>