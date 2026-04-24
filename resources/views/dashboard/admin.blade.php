<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Class-in</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: system-ui, -apple-system, sans-serif; background-color: #f3f4f6; min-height: 100vh; }
        
        /* Sidebar Styles */
        .sidebar { position: fixed; left: 0; top: 0; height: 100vh; width: 260px; background: #1e293b; color: white; transition: transform 0.3s ease; z-index: 1000; overflow-y: auto; }
        .sidebar.closed { transform: translateX(-100%); }
        .sidebar-header { padding: 20px; border-bottom: 1px solid #334155; }
        .sidebar-header h2 { font-size: 20px; font-weight: 600; }
        .sidebar-header .role-badge { display: inline-block; padding: 4px 12px; background: #3b82f6; border-radius: 20px; font-size: 12px; margin-top: 8px; }
        .sidebar-menu { padding: 16px 0; }
        .menu-item { display: block; padding: 12px 20px; color: #94a3b8; text-decoration: none; transition: all 0.2s; cursor: pointer; }
        .menu-item:hover { background: #334155; color: white; }
        .menu-item.active { background: #3b82f6; color: white; }
        .sidebar-footer { position: absolute; bottom: 0; left: 0; right: 0; padding: 16px 20px; border-top: 1px solid #334155; }
        .user-info { display: flex; align-items: center; gap: 12px; }
        .user-avatar { width: 40px; height: 40px; border-radius: 50%; background: #3b82f6; display: flex; align-items: center; justify-content: center; font-weight: 600; flex-shrink: 0; }
        .user-details { flex: 1; min-width: 0; }
        .user-name { font-weight: 500; font-size: 14px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .user-email { font-size: 12px; color: #94a3b8; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        
        /* Toggle Button - Fixed position */
        .sidebar-toggle { position: fixed; left: 20px; top: 20px; z-index: 1001; background: #1e293b; color: white; border: none; padding: 12px 14px; border-radius: 8px; cursor: pointer; transition: left 0.3s ease, transform 0.3s ease; }
        .sidebar-toggle:hover { background: #334155; }
        .sidebar-toggle.shifted { left: 280px; }
        
        /* Main Content Wrapper */
        .content-wrapper { padding: 30px; padding-top: 80px; transition: padding-left 0.3s ease; }
        
        /* Page Header */
        .page-header { background: white; padding: 24px; border-radius: 8px; margin-bottom: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        .page-header h1 { font-size: 24px; font-weight: 600; color: #1e293b; }
        .page-header p { color: #64748b; margin-top: 4px; }
        
        .content-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-bottom: 24px; }
        .card { background: white; padding: 24px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        .card h3 { font-size: 14px; color: #64748b; font-weight: 500; margin-bottom: 8px; }
        .card .value { font-size: 32px; font-weight: 700; color: #1e293b; }
        
        .data-table { background: white; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden; }
        .data-table table { width: 100%; border-collapse: collapse; }
        .data-table th, .data-table td { padding: 16px 20px; text-align: left; border-bottom: 1px solid #e2e8f0; }
        .data-table th { background: #f8fafc; font-weight: 600; font-size: 14px; color: #475569; }
        .data-table td { font-size: 14px; }
        .status-badge { display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 500; }
        .status-badge.active { background: #dcfce7; color: #166534; }
        
        .btn { display: inline-block; padding: 8px 16px; border-radius: 6px; font-size: 14px; font-weight: 500; cursor: pointer; border: none; text-decoration: none; }
        .btn-primary { background: #3b82f6; color: white; }
        .btn-danger { background: #dc2626; color: white; }
        .logout-form { margin-top: 12px; }
        
        /* Responsive - Mobile */
        @media (max-width: 768px) {
            .sidebar { width: 280px; }
            .sidebar.closed { transform: translateX(-100%); }
            .sidebar-toggle.shifted { left: 290px; }
            .content-wrapper { padding: 20px; padding-top: 80px; }
            .page-header { padding: 20px; }
            .page-header h1 { font-size: 20px; }
            .content-grid { grid-template-columns: 1fr; }
            .data-table { overflow-x: auto; }
            .data-table table { min-width: 600px; }
        }
        
        /* Overlay for mobile */
        .sidebar-overlay { display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 999; }
        .sidebar-overlay.show { display: block; }
    </style>
</head>
<body>
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>
    <button class="sidebar-toggle" id="sidebarToggle" onclick="toggleSidebar()">☰</button>
    <aside class="sidebar closed" id="sidebar">
        <div class="sidebar-header">
            <h2>Class-in</h2>
            <span class="role-badge">Admin</span>
        </div>
        <nav class="sidebar-menu">
            <a class="menu-item active" onclick="showPage('dashboard')">📊 Dashboard</a>
            <a class="menu-item" onclick="showPage('users')">👥 Profile Pengguna</a>
            <a class="menu-item" onclick="showPage('courses')">📚 Manajemen Kursus</a>
            <a class="menu-item" onclick="showPage('instructors')">👨‍🏫 Manajemen Pengajar</a>
            <a class="menu-item" onclick="showPage('students')">🎓 Manajemen Peserta</a>
            <a class="menu-item" onclick="showPage('assignments')">📋 Penugasan</a>
        </nav>
        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">A</div>
                <div class="user-details">
                    <div class="user-name">{{ auth()->user()->name }}</div>
                    <div class="user-email">{{ auth()->user()->email }}</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="logout-form">
                @csrf
                <button type="submit" class="btn btn-danger" style="width: 100%; margin-top: 12px;">Logout</button>
            </form>
        </div>
    </aside>

    <div class="content-wrapper" id="contentWrapper">
        <!-- Dashboard Page -->
        <div id="page-dashboard">
            <div class="page-header">
                <h1>Ini adalah dashboard admin</h1>
                <p>Selamat datang di halaman administrator</p>
            </div>
            <div class="content-grid">
                <div class="card"><h3>Total Kursus</h3><div class="value">12</div></div>
                <div class="card"><h3>Total Pengajar</h3><div class="value">5</div></div>
                <div class="card"><h3>Total Peserta</h3><div class="value">150</div></div>
                <div class="card"><h3>Total Pengguna</h3><div class="value">165</div></div>
            </div>
        </div>
        
        <!-- Users Page -->
        <div id="page-users" style="display: none;">
            <div class="page-header"><h1>Profile Pengguna</h1><p>Kelola data pengguna sistem</p></div>
            <div class="data-table">
                <table>
                    <thead><tr><th>Nama</th><th>Email</th><th>Role</th><th>Status</th><th>Aksi</th></tr></thead>
                    <tbody>
                        <tr><td>Admin</td><td>admin@classin.com</td><td>Admin</td><td><span class="status-badge active">Aktif</span></td><td><button class="btn btn-primary">Edit</button></td></tr>
                        <tr><td>Instructor</td><td>instructor@classin.com</td><td>Instructor</td><td><span class="status-badge active">Aktif</span></td><td><button class="btn btn-primary">Edit</button></td></tr>
                        <tr><td>Student</td><td>student@classin.com</td><td>Student</td><td><span class="status-badge active">Aktif</span></td><td><button class="btn btn-primary">Edit</button></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Courses Page -->
        <div id="page-courses" style="display: none;">
            <div class="page-header"><h1>Manajemen Kursus</h1><p>Kelola semua kursus dalam sistem</p></div>
            <div class="data-table">
                <table>
                    <thead><tr><th>Nama Kursus</th><th>Instructor</th><th>Peserta</th><th>Status</th><th>Aksi</th></tr></thead>
                    <tbody>
                        <tr><td>Pemrograman PHP Dasar</td><td>Budi Santoso</td><td>25</td><td><span class="status-badge active">Aktif</span></td><td><button class="btn btn-primary">Edit</button></td></tr>
                        <tr><td>Web Development dengan Laravel</td><td>Siti Rahayu</td><td>18</td><td><span class="status-badge active">Aktif</span></td><td><button class="btn btn-primary">Edit</button></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Instructors Page -->
        <div id="page-instructors" style="display: none;">
            <div class="page-header"><h1>Manajemen Pengajar</h1><p>Kelola data pengajar/instructor</p></div>
            <div class="data-table">
                <table>
                    <thead><tr><th>Nama</th><th>Email</th><th>Kursus Ditugaskan</th><th>Status</th><th>Aksi</th></tr></thead>
                    <tbody>
                        <tr><td>Budi Santoso</td><td>budi@classin.com</td><td>3</td><td><span class="status-badge active">Aktif</span></td><td><button class="btn btn-primary">Edit</button></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Students Page -->
        <div id="page-students" style="display: none;">
            <div class="page-header"><h1>Manajemen Peserta</h1><p>Kelola data peserta/pelajar</p></div>
            <div class="data-table">
                <table>
                    <thead><tr><th>Nama</th><th>Email</th><th>Kursus Diikuti</th><th>Status</th><th>Aksi</th></tr></thead>
                    <tbody>
                        <tr><td>John Doe</td><td>john@email.com</td><td>2</td><td><span class="status-badge active">Aktif</span></td><td><button class="btn btn-primary">Edit</button></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Assignments Page -->
        <div id="page-assignments" style="display: none;">
            <div class="page-header"><h1>Penugasan</h1><p>Tugaskan pengajar ke dalam kursus</p></div>
            <div class="data-table">
                <table>
                    <thead><tr><th>Kursus</th><th>Instructor Ditugaskan</th><th>Tanggal</th><th>Status</th><th>Aksi</th></tr></thead>
                    <tbody>
                        <tr><td>Pemrograman PHP Dasar</td><td>Budi Santoso</td><td>2024-01-15</td><td><span class="status-badge active">Aktif</span></td><td><button class="btn btn-primary">Edit</button></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const toggle = document.getElementById('sidebarToggle');
            const overlay = document.getElementById('sidebarOverlay');
            
            sidebar.classList.toggle('closed');
            toggle.classList.toggle('shifted');
            overlay.classList.toggle('show');
        }
        function showPage(pageId) {
            ['dashboard', 'users', 'courses', 'instructors', 'students', 'assignments'].forEach(p => {
                const el = document.getElementById('page-' + p);
                if (el) el.style.display = 'none';
            });
            const selected = document.getElementById('page-' + pageId);
            if (selected) selected.style.display = 'block';
            document.querySelectorAll('.menu-item').forEach(item => item.classList.remove('active'));
            if (event) event.target.classList.add('active');
        }
    </script>
</body>
</html>