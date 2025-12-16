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
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 15px 30px;
        }

        .content-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .module-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
            transition: all 0.3s ease;
        }

        .module-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .sidebar a.nav-item {
            display: block;
            padding: 12px 15px;
            border-radius: 5px;
            margin-bottom: 5px;
            color: white;
            text-decoration: none;
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
            background: rgba(0, 0, 0, 0.08);
            color: inherit;
            border: none;
            padding: 8px 15px;
            border-radius: 6px;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .course-content {
            background: rgba(255, 255, 255, 0.6);
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
    </style>
</head>

<body>

    <div class="sidebar">
        <div class="d-flex align-items-center mb-4">
            <img src="/logo.png" class="logo" alt="logo">
            <h5 class="mb-0">Student Portal</h5>
        </div>

        <a href="{{ route('student.modules') }}" class="nav-item active">📚 My Modules</a>
    </div>

    <div class="main-content">
        <div class="navbar d-flex justify-content-between align-items-center">
            <div>
                <h3 class="mb-0">My Modules</h3>
                <small class="text-muted">{{ date('F d, Y') }}</small>
            </div>
            <div class="d-flex align-items-center">
                <span class="user-info me-3">Student Name</span>
                <form method="POST" action="{{ route('logout') }}" style="display:inline">
                    @csrf
                    <button type="submit" class="btn btn-logout">🚪 Logout</button>
                </form>
            </div>
        </div>

        <div class="mt-4">
            <h5 class="mb-4">Available Modules</h5>

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
                        <div class="module-code" style="background:{{ $bg }};color:{{ $textColor }}">{{ $module->code }}
                        </div>

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
                            <a href="{{ route('student.modules.attachments', $module) }}" class="btn-outline-open">Open</a>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted">No modules available.</div>
                @endforelse
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.btn-view').forEach((btn, idx) => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                const moduleCard = this.closest('.module-card');
                const course = moduleCard.querySelector('.course-content');
                if (course.style.display === 'block') {
                    course.style.display = 'none';
                    this.innerHTML = '👁️ View Course';
                } else {
                    document.querySelectorAll('.course-content').forEach(c => c.style.display = 'none');
                    document.querySelectorAll('.btn-view').forEach(b => b.innerHTML = '👁️ View Course');
                    course.style.display = 'block';
                    this.innerHTML = '👁️ Hide Course';
                }
            });
        });
    </script>
    @include('partials.toasts')
</body>

</html>