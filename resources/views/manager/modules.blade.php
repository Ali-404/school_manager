<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modules Management</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --sidebar-bg: #ffffff;
            --accent: #2ea44f;
            --muted: #6c757d
        }

        body {
            background: #ffffff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0
        }

        .sidebar {
            background: #ffffff;
            color: #2d3748;
            position: fixed;
            width: 220px;
            min-height: 100vh;
            padding: 22px;
            border-right: 2px dotted #cbd5e0;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
        }

        .sidebar .logo {
            width: 36px;
            margin-right: 10px
        }

        .sidebar a.nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px;
            border-radius: 8px;
            color: #4a5568;
            text-decoration: none;
            margin-bottom: 6px;
            border: 1px dotted transparent;
            transition: all 0.3s ease;
        }

        .sidebar a.nav-item:hover {
            background: #f7fafc;
            color: #2d3748;
            border-color: #cbd5e0;
        }

        .sidebar a.nav-item.active {
            background: #edf2f7;
            color: #2d3748;
            border: 1px dotted #2f88c6;
        }

        .main-content {
            margin-left: 220px;
            padding: 22px
        }

        .top-card {
            background: #fff;
            border-radius: 16px;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
            margin-bottom: 30px;
        }

        .search-input {
            border-radius: 8px;
            padding: 12px 14px;
            border: 1px solid #e6eef6
        }

        .modules-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 25px;
            margin-top: 25px;
        }

        .module-card {
            background: white;
            border-radius: 20px;
            padding: 0;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            overflow: hidden;
            position: relative;
            border: 1px solid #e2e8f0;
        }

        .module-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
        }

        .module-left-pill {
            position: absolute;
            left: 12px;
            top: 18px;
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .module-title {
            font-weight: 700;
            letter-spacing: 0.5px;
            margin-left: 68px;
        }

        .module-code {
            display: inline-block;
            margin-left: 68px;
            margin-top: 8px;
            padding: 6px 10px;
            border-radius: 12px;
            font-weight: 700;
        }

        .stat-chip {
            display: inline-block;
            background: #fff;
            padding: 10px 14px;
            border-radius: 14px;
            margin-right: 8px;
            border: 1px solid rgba(0, 0, 0, 0.04);
            box-shadow: 0 6px 12px rgba(16, 24, 40, 0.04);
        }

        .action-group {
            display: flex;
            gap: 10px;
            margin-left: 0;
            margin-top: auto;
        }

        .module-header {
            padding: 25px;
            position: relative;
            min-height: 120px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .module-icon-wrapper {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: bold;
            flex-shrink: 0;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .module-info {
            flex: 1;
        }

        .module-body {
            padding: 0 25px 25px 25px;
        }

        .module-action {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: block;
            text-align: center;
            color: white;
            margin-bottom: 10px;
        }

        .btn-outline-open {
            background: linear-gradient(135deg, var(--accent) 0%, #20c997 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(46, 164, 79, 0.3);
        }

        .btn-outline-open:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(46, 164, 79, 0.4);
        }

        .btn-outline-edit {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .btn-outline-edit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        .btn-outline-delete {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
        }

        .btn-outline-delete:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
        }

        .module-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .module-stats {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .stat-item {
            flex: 1;
            text-align: center;
            padding: 12px;
            background: #f7fafc;
            border-radius: 12px;
        }

        .stat-item strong {
            display: block;
            font-size: 1.3rem;
            color: #2d3748;
            margin-bottom: 4px;
        }

        .stat-item small {
            color: #718096;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .module-description {
            color: #4a5568;
            font-size: 0.9rem;
            line-height: 1.6;
            margin-bottom: 20px;
            min-height: 40px;
        }

        .module-code {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .module-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 5px;
            line-height: 1.3;
        }

        .module-date {
            font-size: 0.85rem;
            color: rgba(0, 0, 0, 0.6);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .fab {
            position: fixed;
            right: 28px;
            bottom: 28px;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #0d6efd;
            color: #fff;
            box-shadow: 0 10px 30px rgba(13, 110, 253, 0.18);
            border: none;
            font-size: 22px;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <div class="d-flex align-items-center mb-4">
            <img src="/logo.png" class="logo" alt="logo">
            <h5 class="mb-0">School Portal</h5>
        </div>

        <a href="{{ route('manager.dashboard') }}" class="nav-item"><span>📊</span> Dashboard</a>
        <a href="{{ route('manager.students') }}" class="nav-item"><span>👥</span> Students</a>
        <a href="{{ route('manager.modules') }}" class="nav-item active"><span>📚</span> Modules</a>
    </div>

    <div class="main-content">
        <div class="top-card">
            <div>
                <h4 class="mb-0">Modules</h4>
                <small class="text-muted">{{ date('F d, Y') }}</small>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="user-info" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding:10px 20px;border-radius:25px; font-weight: 600; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);">
                    <i class="fas fa-user"></i> {{ auth()->user()->name ?? 'User' }}
                </div>
                <button class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal"
                    data-bs-target="#changePasswordModal" style="border-radius: 12px; font-weight: 600;">
                    <i class="fas fa-key"></i> Change Password
                </button>
                <form method="POST" action="{{ route('logout') }}" style="display:inline">@csrf<button type="submit"
                        class="btn btn-sm" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; border: none; border-radius: 25px; font-weight: 600; padding: 10px 20px; box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button></form>
            </div>
        </div>

        <div class="mt-4 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0">Modules ({{ $modules->count() ?? 0 }})</h5>
                <small class="text-muted">Manage your course modules</small>
            </div>
            <button class="btn btn-success" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); border: none; border-radius:12px;padding:12px 24px; font-weight: 700; box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);" data-bs-toggle="modal"
                data-bs-target="#addModuleModal">
                <i class="fas fa-plus"></i> Add Module
            </button>
        </div>

        <div class="mt-3">
            <input type="text" id="searchInput" class="search-input w-50" placeholder="🔍 Search modules...">
        </div>

        <div class="modules-grid">
            @forelse($modules as $module)
                @php
                    $bg = $module->color ?? '#f6f8fa';
                    $hex = ltrim($bg, '#');
                    $r = hexdec(substr($hex, 0, 2));
                    $g = hexdec(substr($hex, 2, 2));
                    $b = hexdec(substr($hex, 4, 2));
                    $luminance = (0.299 * $r + 0.587 * $g + 0.114 * $b) / 255;
                    $textColor = $luminance > 0.6 ? '#000' : '#fff';
                @endphp

                <div class="module-card">
                    <div class="module-header" style="background: linear-gradient(135deg, {{ $bg }} 0%, {{ $bg }}dd 100%);">
                        <div class="module-icon-wrapper" style="background: rgba(255, 255, 255, 0.2); color: {{ $textColor }};">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <div class="module-info">
                            <div class="module-code" style="background: rgba(255, 255, 255, 0.25); color: {{ $textColor }};">
                                {{ $module->code }}
                            </div>
                            <div class="module-title" style="color: {{ $textColor }};">
                                {{ $module->name }}
                            </div>
                            <div class="module-date" style="color: {{ $textColor }}dd;">
                                <i class="far fa-calendar-alt"></i>
                                {{ $module->created_at->format('M d, Y') }}
                            </div>
                        </div>
                    </div>

                    <div class="module-body">
                        @if($module->picture)
                            <img src="{{ asset('storage/' . $module->picture) }}" alt="{{ $module->name }}" class="module-image">
                        @endif

                        @if($module->description)
                            <div class="module-description">
                                {{ \Illuminate\Support\Str::limit($module->description, 100) }}
                            </div>
                        @endif

                        <div class="module-stats">
                            <div class="stat-item">
                                <strong style="color: {{ $bg }};">{{ $module->attachments()->count() }}</strong>
                                <small>Attachments</small>
                            </div>
                            <div class="stat-item">
                                <strong style="color: {{ $bg }};">Active</strong>
                                <small>Status</small>
                            </div>
                        </div>

                        <a href="{{ route('manager.modules.attachments.index', $module->id) }}" 
                           class="module-action btn-outline-open">
                            <i class="fas fa-folder-open"></i> View Attachments
                        </a>
                        <button class="module-action btn-outline-edit"
                            onclick="editModule({{ $module->id }}, '{{ addslashes($module->name) }}', '{{ addslashes($module->code) }}', '{{ addslashes($module->description) }}', '{{ $module->color }}', '{{ $module->picture }}')"
                            data-bs-toggle="modal" data-bs-target="#editModuleModal">
                            <i class="fas fa-edit"></i> Edit Module
                        </button>
                        <form action="{{ route('modules.destroy', $module) }}" method="POST" style="display:block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="module-action btn-outline-delete w-100"
                                onclick="return confirm('Delete module: {{ $module->name }}?')">
                                <i class="fas fa-trash"></i> Delete Module
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted">No modules found.</div>
            @endforelse
        </div>

        <!-- Floating Add Button -->
        <button class="fab" title="Add module" data-bs-toggle="modal" data-bs-target="#addModuleModal">+</button>

    </div>

    <style>
        /* Ensure modal overlays above FAB and any stacking contexts */
        .modal {
            z-index: 2500 !important;
            position: fixed !important;
        }

        .modal-backdrop {
            z-index: 2400 !important;
        }

        .fab {
            z-index: 1000;
        }
    </style>
    <style>
        /* Ensure modal overlays above FAB and any stacking contexts */
        html,
        body {
            height: 100%;
        }




        .fab {
            z-index: 1000;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Modals placed at end of body to avoid stacking-context issues -->
    <!-- Add Module Modal -->
    <div class="modal fade " id="addModuleModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Module</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('modules.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Module Name *</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Module Code *</label>
                            <input type="text" class="form-control" name="code" placeholder="e.g., CS101" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Color (Unique)</label>
                            <input type="color" class="form-control form-control-color" name="color" id="addColor"
                                title="Choose a unique color for this module">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Picture</label>
                            <input type="file" class="form-control" name="picture" accept="image/*">
                            <small class="text-muted">Max size: 2MB (JPEG, PNG, GIF)</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Create Module</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Module Modal -->
    <div class="modal fade" id="editModuleModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Module</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="editForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Module Name *</label>
                            <input type="text" class="form-control" id="editName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Module Code *</label>
                            <input type="text" class="form-control" id="editCode" name="code" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" id="editDescription" name="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Color (Unique)</label>
                            <input type="color" class="form-control form-control-color" id="editColor" name="color"
                                title="Choose a unique color for this module">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Picture</label>
                            <div id="editPicturePreview" class="mb-2"></div>
                            <input type="file" class="form-control" id="editPicture" name="picture" accept="image/*">
                            <small class="text-muted">Leave empty to keep current picture. Max size: 2MB (JPEG, PNG,
                                GIF)</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Module</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Ensure modals are direct children of <body> at show time to avoid transform/stacking issues
        document.addEventListener('DOMContentLoaded', function () {
            ['addModuleModal', 'editModuleModal'].forEach(function (id) {
                var el = document.getElementById(id);
                if (!el) return;
                el.addEventListener('show.bs.modal', function () {
                    // move to body so fixed positioning is relative to viewport
                    if (el.parentNode !== document.body) document.body.appendChild(el);
                });
            });
        });

        function editModule(id, name, code, description, color, picture) {
            document.getElementById('editName').value = name || '';
            document.getElementById('editCode').value = code || '';
            document.getElementById('editDescription').value = description || '';
            document.getElementById('editColor').value = color || '#ffffff';

            const previewDiv = document.getElementById('editPicturePreview');
            if (picture) {
                previewDiv.innerHTML = '<img src="' + `{{ asset('storage') }}/${picture}` + '" alt="Module Picture" style="width:100px;height:100px;object-fit:cover;border-radius:6px">';
            } else {
                previewDiv.innerHTML = '';
            }

            document.getElementById('editForm').action = `/manager/modules/${id}`;
        }

        // Search functionality (card filter)
        document.getElementById('searchInput').addEventListener('input', function () {
            const term = this.value.toLowerCase();
            document.querySelectorAll('.module-card').forEach(card => {
                const title = card.querySelector('.module-title')?.textContent.toLowerCase() || '';
                const code = card.querySelector('.module-code')?.textContent.toLowerCase() || '';
                if (title.includes(term) || code.includes(term)) card.style.display = '';
                else card.style.display = 'none';
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function editModule(id, name, code, description, color, picture) {
        document.getElementById('editName').value = name;
        document.getElementById('editCode').value = code;
        document.getElementById('editDescription').value = description;
        document.getElementById('editColor').value = color || '#ffffff';

        // Show picture preview if it exists
        const previewDiv = document.getElementById('editPicturePreview');
        if (picture) {
            previewDiv.innerHTML = '<img src="{{ asset("storage/") }}' + picture + '" alt="Module Picture" style="width: 100px; height: 100px; object-fit: cover; border-radius: 4px;">';
        } else {
            previewDiv.innerHTML = '';
        }

        document.getElementById('editForm').action = `/manager/modules/${id}`;
    }

    // Search functionality
    document.getElementById('searchInput').addEventListener('keyup', function () {
        const searchTerm = this.value.toLowerCase();
        const tableRows = document.querySelectorAll('table tbody tr');

        tableRows.forEach(row => {
            const name = row.cells[1].textContent.toLowerCase();
            const code = row.cells[2].textContent.toLowerCase();

            if (name.includes(searchTerm) || code.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
</body>

</html>