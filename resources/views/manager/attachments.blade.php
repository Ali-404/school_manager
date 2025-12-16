<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $module->name }} – Attachments (Manager)</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <style>
        :root {
            --sidebar-bg: #223344;
            --accent: #2ea44f;
            --muted: #6c757d;
        }

        body {
            background: #f5f7fa;
            font-family: Inter, Arial, sans-serif;
            margin: 0;
        }

        /* Sidebar */
        .sidebar {
            background: var(--sidebar-bg);
            color: #fff;
            position: fixed;
            width: 220px;
            min-height: 100vh;
            padding: 22px;
        }

        .sidebar .logo {
            width: 36px;
            margin-right: 10px;
        }

        .sidebar a.nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px;
            border-radius: 8px;
            color: #cfe6ff;
            text-decoration: none;
            margin-bottom: 6px;
        }

        .sidebar a.nav-item.active {
            background: #2f88c6;
            color: #fff;
        }

        .main-content {
            margin-left: 220px;
            padding: 22px;
        }

        .top-card {
            margin-bottom: 10px;
            background: #fff;
            border-radius: 10px;
            padding: 18px 22px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 6px 18px rgba(16, 24, 40, 0.06);
        }

        /* Module Header */
        .module-header {
            background: #fff;
            border-radius: 10px;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 12px rgba(16, 24, 40, 0.06);
            margin-bottom: 22px;
        }

        .module-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .module-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: bold;
            font-size: 24px;
        }

        /* Attachments */
        .attachment-row {
            background: #fff;
            border-radius: 12px;
            padding: 14px 18px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
            box-shadow: 0 2px 6px rgba(16, 24, 40, .04);
        }

        .file-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .pdf-icon {
            text-transform: uppercase;
            width: 36px;
            height: 36px;
            color: #fff;
            border-radius: 8px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
        }

        .open-btn {
            color: #fff;
            border: none;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            text-decoration: none;
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
            z-index: 9999;
            font-size: 22px;
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

        <a href="{{ route('manager.dashboard') }}" class="nav-item"><span>📊</span> Dashboard</a>
        <a href="{{ route('manager.students') }}" class="nav-item"><span>👥</span> Students</a>
        <a href="{{ route('manager.modules') }}" class="nav-item active"><span>📚</span> Modules</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">

        <!-- Top Card -->
        <div class="top-card">
            <div>
                <h4 class="mb-0">{{ strtoupper($module->name) }} – Attachments</h4>
                <small class="text-muted">{{ $module->created_at->format('F d, Y') }}</small>
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
        <button class="fab" title="Add module" data-bs-toggle="modal" data-bs-target="#addAttachmentModal">+</button>

        <!-- Module Header -->
        <div class="module-header " style="background-color: {{ $module->color ?? "#fff" }};">
            <div class="module-left">
                @if($module->picture)
                    <img src="{{ asset('storage/' . $module->picture) }}" alt="{{ $module->name }}"
                        style="width:120px;height: 120px; object-fit:contain;border-radius:8px;">
                @endif
                <div>
                    <h5 class="mb-0 mb-2 p-2  bg-white rounded">{{ strtoupper($module->name) }}</h5>
                    <small class="text-muted bg-white p-2  rounded">Module Attachments</small>
                </div>
            </div>

        </div>

        <!-- Attachments List -->
        <div class="attachments-list">
            @forelse($attachments as $att)
                <div class="attachment-row">
                    <div class="file-left">
                        <div class="pdf-icon" style="background: {{ $module->color ?? '#ff4d4f' }}">{{ $att->extension }}
                        </div>
                        <div>
                            <strong>{{ $att->title }}</strong><br>
                            <small class="text-muted">
                                {{ $att->created_at->format('D M d, Y') }}
                                • by {{ optional($att->uploader)->name ?? '—' }}
                            </small>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('manager.modules.attachments.download', [$module, $att]) }}" class="open-btn"
                            style="background: {{ $module->color ?? '#2dd4bf' }}">
                            Open
                        </a>

                        <form method="POST" action="{{ route('manager.modules.attachments.destroy', [$module, $att]) }}"
                            onsubmit="return confirm('Delete this attachment?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">✕</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-muted text-center mt-4">
                    No attachments for this module.
                </div>
            @endforelse

            <div class="mt-4">
                {{ $attachments->links() }}
            </div>
        </div>

    </div>

    <!-- Add Attachment Modal -->
    <div class="modal fade" id="addAttachmentModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="POST" action="{{ route('manager.modules.attachments.store', $module) }}"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title">Add Attachment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">File</label>
                            <input type="file" name="file" class="form-control" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary"
                            style="background: {{ $module->color ?? '#0d6efd' }}">Upload</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @include('partials.toasts')
</body>

</html>