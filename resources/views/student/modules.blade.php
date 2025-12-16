<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Modules - Student Portal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #ffffff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            padding-bottom: 20px;
        }

        .sidebar {
            background: #ffffff;
            color: #2d3748;
            min-height: 100vh;
            position: fixed;
            width: 280px;
            padding: 30px 20px;
            left: 0;
            border-right: 2px dotted #cbd5e0;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
        }

        .sidebar .logo-section {
            display: flex;
            align-items: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 2px dotted #cbd5e0;
        }

        .sidebar .logo {
            width: 50px;
            height: 50px;
            margin-right: 12px;
            border-radius: 12px;
            background: #f7fafc;
            padding: 8px;
            border: 1px dotted #cbd5e0;
        }

        .sidebar h5 {
            font-weight: 600;
            font-size: 1.1rem;
            margin: 0;
            color: #2d3748;
        }

        .sidebar a.nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 18px;
            border-radius: 12px;
            margin-bottom: 8px;
            color: #4a5568;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
            border: 1px dotted transparent;
        }

        .sidebar a.nav-item:hover {
            background: #f7fafc;
            color: #2d3748;
            transform: translateX(5px);
            border-color: #cbd5e0;
        }

        .sidebar a.nav-item.active {
            background: #edf2f7;
            color: #2d3748;
            border: 1px dotted #667eea;
            box-shadow: 0 2px 8px rgba(102, 126, 234, 0.2);
        }

        .main-content {
            margin-left: 280px;
            padding: 30px;
        }

        .navbar {
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
            padding: 20px 30px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h3 {
            font-weight: 700;
            color: #2d3748;
            margin: 0;
            font-size: 1.5rem;
        }

        .navbar small {
            color: #718096;
            font-size: 0.9rem;
        }

        .user-section {
            display: flex;
            align-items: center;
            gap: 15px;
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

        .btn-logout {
            background: #ef4444;
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
            background: #dc2626;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
        }

        .page-header {
            margin-bottom: 30px;
        }

        .page-header h4 {
            color: #2d3748;
            font-weight: 700;
            font-size: 1.8rem;
            margin-bottom: 8px;
        }

        .page-header p {
            color: #718096;
            font-size: 1rem;
        }

        .modules-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 25px;
        }

        .module-card {
            background: white;
            border-radius: 20px;
            padding: 0;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            overflow: hidden;
            position: relative;
        }

        .module-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
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

        .module-body {
            padding: 0 25px 25px 25px;
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

        .module-action {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: block;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .module-action::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .module-action:hover::before {
            width: 300px;
            height: 300px;
        }

        .module-action span {
            position: relative;
            z-index: 1;
        }

        .empty-state {
            text-align: center;
            padding: 80px 20px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        .empty-state i {
            font-size: 4rem;
            color: #cbd5e0;
            margin-bottom: 20px;
        }

        .empty-state h5 {
            color: #4a5568;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .empty-state p {
            color: #718096;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: relative;
                min-height: auto;
            }

            .main-content {
                margin-left: 0;
                padding: 20px;
            }

            .modules-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <div class="logo-section">
            <img src="/logo.png" class="logo" alt="logo">
            <h5>Student Portal</h5>
        </div>

        <a href="{{ route('student.modules') }}" class="nav-item active">
            <i class="fas fa-book"></i>
            <span>My Modules</span>
        </a>
    </div>

    <div class="main-content">
        <div class="navbar">
            <div>
                <h3>My Modules</h3>
                <small><i class="far fa-calendar"></i> {{ date('F d, Y') }}</small>
            </div>
            <div class="user-section">
                <span class="user-info">
                    <i class="fas fa-user-graduate"></i> {{ auth()->user()->name ?? 'Student' }}
                </span>
                <form method="POST" action="{{ route('logout') }}" style="display:inline">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <div class="page-header">
            <h4><i class="fas fa-graduation-cap"></i> Available Modules</h4>
            <p>Explore your course modules and access learning materials</p>
        </div>

        <div class="modules-grid">
            @forelse($modules as $module)
                @php
                    $bg = $module->color ?? '#667eea';
                    $hex = ltrim($bg, '#');
                    $r = hexdec(substr($hex, 0, 2));
                    $g = hexdec(substr($hex, 2, 2));
                    $b = hexdec(substr($hex, 4, 2));
                    $luminance = (0.299 * $r + 0.587 * $g + 0.114 * $b) / 255;
                    $textColor = $luminance > 0.6 ? '#1a202c' : '#ffffff';
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

                        <a href="{{ route('student.modules.attachments', $module) }}" 
                           class="module-action" 
                           style="background: linear-gradient(135deg, {{ $bg }} 0%, {{ $bg }}dd 100%);">
                            <span><i class="fas fa-arrow-right"></i> View Module</span>
                        </a>
                    </div>
                </div>
            @empty
                <div class="empty-state" style="grid-column: 1 / -1;">
                    <i class="fas fa-inbox"></i>
                    <h5>No Modules Available</h5>
                    <p>There are no modules assigned to you at this time. Please contact your instructor.</p>
                </div>
            @endforelse
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @include('partials.toasts')
</body>

</html>