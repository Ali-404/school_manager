<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $module->name }} – Attachments (Manager)</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --sidebar-bg: #ffffff;
            --accent: #2ea44f;
            --muted: #6c757d;
        }

        body {
            background: #ffffff;
            font-family: Inter, Arial, sans-serif;
            margin: 0;
        }

        /* Sidebar */
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
            margin-right: 10px;
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
            padding: 22px;
        }

        .top-card {
            margin-bottom: 30px;
            background: #fff;
            border-radius: 16px;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        /* Module Header */
        .module-header {
            background: #fff;
            border-radius: 20px;
            padding: 25px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            margin-bottom: 30px;
            border: 1px solid #e2e8f0;
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
            border-radius: 20px;
            padding: 20px 25px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            border: 1px solid #e2e8f0;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .attachment-row:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.2);
        }

        .file-left {
            display: flex;
            align-items: center;
            gap: 15px;
            flex: 1;
        }

        .pdf-icon {
            text-transform: uppercase;
            width: 50px;
            height: 50px;
            color: #fff;
            border-radius: 12px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .file-info h6 {
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 5px;
            font-size: 1rem;
        }

        .file-info small {
            color: #718096;
            font-size: 0.85rem;
        }

        .open-btn {
            color: #fff;
            border: none;
            padding: 12px 24px;
            border-radius: 12px;
            font-size: 0.9rem;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .open-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        .fab {
            position: fixed;
            right: 28px;
            bottom: 28px;
            width: 64px;
            height: 64px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: #fff;
            box-shadow: 0 10px 30px rgba(40, 167, 69, 0.4);
            border: none;
            z-index: 9999;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .fab:hover {
            transform: scale(1.1) translateY(-4px);
            box-shadow: 0 15px 40px rgba(40, 167, 69, 0.5);
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
        <button class="fab" title="Add Attachment" data-bs-toggle="modal" data-bs-target="#addAttachmentModal">
            <i class="fas fa-plus"></i>
        </button>

        <!-- Module Header -->
        <div class="module-header " style="background-color: {{ $module->color ?? "#fff" }};">
            <div class="module-left">
                @if($module->picture)
                    <img src="{{ asset('storage/' . $module->picture) }}" alt="{{ $module->name }}"
                        style="width:120px;height: 120px; object-fit:contain;border-radius:8px;">
                @endif
                <div>
                    <h5 class="mb-0 mb-2 p-2 bg-white rounded" style="font-weight: 700; font-size: 1.3rem;">{{ strtoupper($module->name) }}</h5>
                    <small class="text-muted bg-white p-2 rounded" style="font-size: 0.9rem;">
                        <i class="fas fa-paperclip"></i> Module Attachments
                    </small>
                </div>
            </div>

        </div>

        <!-- Attachments List -->
        <div class="attachments-list">
            @forelse($attachments as $att)
                <div class="attachment-row">
                    <div class="file-left">
                        <div class="pdf-icon" style="background: linear-gradient(135deg, {{ $module->color ?? '#667eea' }} 0%, {{ $module->color ?? '#764ba2' }}dd 100%);">
                            <i class="fas fa-file"></i>
                        </div>
                        <div class="file-info">
                            <h6>{{ $att->title }}</h6>
                            <small>
                                <i class="far fa-calendar-alt"></i> {{ $att->created_at->format('M d, Y') }}
                                • <i class="fas fa-user"></i> {{ optional($att->uploader)->name ?? 'Unknown' }}
                            </small>
                        </div>
                    </div>

                    <div class="d-flex gap-2 align-items-center">
                        <a href="{{ route('manager.modules.attachments.download', [$module, $att]) }}" class="open-btn"
                            style="background: linear-gradient(135deg, {{ $module->color ?? '#667eea' }} 0%, {{ $module->color ?? '#764ba2' }}dd 100%);">
                            <i class="fas fa-download"></i> Download
                        </a>

                        <form method="POST" action="{{ route('manager.modules.attachments.destroy', [$module, $att]) }}"
                            onsubmit="return confirm('Delete this attachment?')" style="margin: 0;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; border: none; border-radius: 12px; padding: 10px 15px; font-weight: 700;">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center py-5" style="padding: 80px 20px;">
                    <i class="fas fa-inbox" style="font-size: 4rem; color: #cbd5e0; margin-bottom: 20px;"></i>
                    <h5 style="color: #4a5568; font-weight: 600; margin-bottom: 10px;">No Attachments</h5>
                    <p style="color: #718096;">No attachments have been uploaded for this module yet.</p>
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