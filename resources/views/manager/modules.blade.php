<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modules Management</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        :root {
            --sidebar-bg: #223344;
            --accent: #2ea44f;
            --muted: #6c757d
        }

        body {
            background: #f5f7fa;
            font-family: Inter, Arial, sans-serif;
            margin: 0
        }

        .sidebar {
            background: var(--sidebar-bg);
            color: #fff;
            position: fixed;
            width: 220px;
            min-height: 100vh;
            padding: 22px
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
            color: #cfe6ff;
            text-decoration: none;
            margin-bottom: 6px
        }

        .sidebar a.nav-item.active {
            background: #2f88c6;
            color: #fff
        }

        .main-content {
            margin-left: 220px;
            padding: 22px
        }

        .top-card {
            background: #fff;
            border-radius: 10px;
            padding: 18px 22px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 6px 18px rgba(16, 24, 40, 0.06)
        }

        .search-input {
            border-radius: 8px;
            padding: 12px 14px;
            border: 1px solid #e6eef6
        }

        .modules-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 22px;
            margin-top: 18px;
            align-items: flex-start;
        }

        .module-card {
            width: 300px;
            min-height: 330px;
            border-radius: 12px;
            padding: 18px;
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 6px 14px rgba(16, 24, 40, 0.04);
            position: relative;
            display: flex;
            flex-direction: column;
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

        .btn-outline-open {
            border: 2px solid var(--accent);
            color: var(--accent);
            border-radius: 10px;
            padding: 8px 14px;
            background: #fff;
        }

        .btn-outline-edit {
            border: 2px solid #0d6efd;
            color: #0d6efd;
            border-radius: 10px;
            padding: 8px 14px;
            background: #fff;
        }

        .btn-outline-delete {
            border: 2px solid #dc3545;
            color: #dc3545;
            border-radius: 10px;
            padding: 8px 14px;
            background: #fff;
        }

        .module-date {
            position: absolute;
            right: 14px;
            top: 12px;
            color: var(--muted);
            font-size: 12px;
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
                <div class="user-info" style="background:#eef3f8;padding:8px 12px;border-radius:20px">
                    {{ auth()->user()->name ?? 'User' }}
                </div>
                <button class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal"
                    data-bs-target="#changePasswordModal">Change Password</button>
                <form method="POST" action="{{ route('logout') }}" style="display:inline">@csrf<button type="submit"
                        class="btn btn-sm btn-danger">Logout</button></form>
            </div>
        </div>

        <div class="mt-4 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0">Modules ({{ $modules->count() ?? 0 }})</h5>
                <small class="text-muted">Manage your course modules</small>
            </div>
            <button class="btn btn-success" style="border-radius:8px;padding:8px 14px" data-bs-toggle="modal"
                data-bs-target="#addModuleModal">+ Add Module</button>
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

                <div class="module-card" style="background: {{ $bg }}22;">
                    <div class="module-left-pill" style="background:{{ $bg }};">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 2C8.13 2 5 5.13 5 9V15C5 18.87 8.13 22 12 22C15.87 22 19 18.87 19 15V9C19 5.13 15.87 2 12 2Z"
                                fill="{{ $textColor }}" />
                        </svg>
                    </div>
                    <div class="module-date">{{ $module->created_at->format('M d, Y') }}</div>
                    <div class="module-title">{{ strtoupper($module->name) }}</div>
                    <div class="module-code" style="background:{{ $bg }};color:{{ $textColor }}">{{ $module->code }}</div>

                    <div style="margin-top:12px;">
                        <span class="stat-chip"><strong style="color:#dc3545">50</strong><br><small
                                style="color:var(--muted)">Hours</small></span>
                        <span class="stat-chip"><strong style="color:#0d6efd">10</strong><br><small
                                style="color:var(--muted)">Assignments</small></span>
                    </div>

                    @if($module->picture)
                        <div style="margin-top:12px;">
                            <img src="{{ asset('storage/' . $module->picture) }}" alt="{{ $module->name }}"
                                style="width:100%;height:120px;object-fit:cover;border-radius:8px;">
                        </div>
                    @endif

                    <div class="action-group">
                        <a href="{{ route("manager.modules.attachments.index", $module->id) }}               " class="btn-outline-open">Open</a>
                        <button class="btn-outline-edit"
                            onclick="editModule({{ $module->id }}, '{{ addslashes($module->name) }}', '{{ addslashes($module->code) }}', '{{ addslashes($module->description) }}', '{{ $module->color }}', '{{ $module->picture }}')"
                            data-bs-toggle="modal" data-bs-target="#editModuleModal">Edit</button>
                        <form action="{{ route('modules.destroy', $module) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-outline-delete"
                                onclick="return confirm('Delete module: {{ $module->name }}?')">Delete</button>
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