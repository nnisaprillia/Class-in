<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Dashboard - Class-in</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: system-ui, -apple-system, sans-serif; background-color: #f3f4f6; min-height: 100vh; }
        
        /* Sidebar Styles */
        .sidebar { position: fixed; left: 0; top: 0; height: 100vh; width: 260px; background: #1e293b; color: white; transition: transform 0.3s ease; z-index: 1000; overflow-y: auto; }
        .sidebar.closed { transform: translateX(-100%); }
        .sidebar-header { padding: 20px; border-bottom: 1px solid #334155; }
        .sidebar-header h2 { font-size: 20px; font-weight: 600; }
        .sidebar-header .role-badge { display: inline-block; padding: 4px 12px; background: #10b981; border-radius: 20px; font-size: 12px; margin-top: 8px; }
        .sidebar-menu { padding: 16px 0; }
        .menu-item { display: block; padding: 12px 20px; color: #94a3b8; text-decoration: none; transition: all 0.2s; cursor: pointer; }
        .menu-item:hover { background: #334155; color: white; }
        .menu-item.active { background: #10b981; color: white; }
        .sidebar-footer { position: absolute; bottom: 0; left: 0; right: 0; padding: 16px 20px; border-top: 1px solid #334155; }
        .user-info { display: flex; align-items: center; gap: 12px; }
        .user-avatar { width: 40px; height: 40px; border-radius: 50%; background: #10b981; display: flex; align-items: center; justify-content: center; font-weight: 600; }
        .user-details { flex: 1; }
        .user-name { font-weight: 500; font-size: 14px; }
        .user-email { font-size: 12px; color: #94a3b8; }
        
        /* Toggle Button - Fixed position */
        .sidebar-toggle { position: fixed; left: 20px; top: 20px; z-index: 1001; background: #1e293b; color: white; border: none; padding: 12px 14px; border-radius: 8px; cursor: pointer; transition: left 0.3s ease, transform 0.3s ease; }
        .sidebar-toggle:hover { background: #334155; }
        .sidebar-toggle.shifted { left: 280px; }
        
        /* Main Content Wrapper */
        .content-wrapper { padding: 30px; padding-top: 80px; transition: padding-left 0.3s ease; }
        
        .page-header { background: white; padding: 24px; border-radius: 8px; margin-bottom: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        .page-header h1 { font-size: 24px; font-weight: 600; color: #1e293b; }
        .page-header p { color: #64748b; margin-top: 4px; }
        
        .content-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin-bottom: 24px; }
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
        .btn-primary { background: #10b981; color: white; }
        .btn-danger { background: #dc2626; color: white; }
        .logout-form { margin-top: 12px; }
    </style>
</head>
<body>
    <button class="sidebar-toggle" onclick="toggleSidebar()">☰</button>
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h2>Class-in</h2>
            <span class="role-badge">Instructor</span>
        </div>
        <nav class="sidebar-menu">
            <a class="menu-item active" onclick="showPage('dashboard')">📊 Dashboard</a>
            <a class="menu-item" onclick="showPage('profile')">👤 Profile Pengguna</a>
            <a class="menu-item" onclick="showPage('courses')">📚 Daftar Kursus</a>
            <a class="menu-item" onclick="showPage('schedule')">📅 Jadwal Mengajar</a>
        </nav>
        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">I</div>
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

    <main class="main-content" id="mainContent">
        <!-- Dashboard Page -->
        <div id="page-dashboard">
            <div class="page-header">
                <h1>Ini adalah dashboard instructor</h1>
                <p>Selamat datang di halaman instructor</p>
            </div>
            <div class="content-grid">
                <div class="card"><h3>Kursus Ditugaskan</h3><div class="value">3</div></div>
                <div class="card"><h3>Total Siswa</h3><div class="value">75</div></div>
                <div class="card"><h3>Tugas Dinilai</h3><div class="value">45</div></div>
                <div class="card"><h3>Materi Diupload</h3><div class="value">20</div></div>
            </div>
        </div>
        
        <!-- Profile Page -->
        <div id="page-profile" style="display: none;">
            <div class="page-header"><h1>Profile Pengguna</h1><p>Kelola data profile Anda</p></div>
            <div class="card">
                <h3>Nama: {{ auth()->user()->name }}</h3>
                <p style="margin-top: 12px;">Email: {{ auth()->user()->email }}</p>
                <p style="margin-top: 8px;">Role: Instructor</p>
                <button class="btn btn-primary" style="margin-top: 16px;">Edit Profile</button>
            </div>
        </div>
        
        <!-- Courses Page -->
        <div id="page-courses" style="display: none;">
            <div class="page-header"><h1>Daftar Kursus</h1><p>Kursus yang ditugaskan kepada Anda</p></div>
            <div class="data-table">
                <table>
                    <thead><tr><th>Nama Kursus</th><th>Peserta</th><th>Status</th><th>Aksi</th></tr></thead>
                    <tbody>
                        <tr><td>Pemrograman PHP Dasar</td><td>25</td><td><span class="status-badge active">Aktif</span></td><td><button class="btn btn-primary">Kelola</button></td></tr>
                        <tr><td>Web Development dengan Laravel</td><td>18</td><td><span class="status-badge active">Aktif</span></td><td><button class="btn btn-primary">Kelola</button></td></tr>
                        <tr><td>Database MySQL</td><td>32</td><td><span class="status-badge active">Aktif</span></td><td><button class="btn btn-primary">Kelola</button></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Schedule Page -->
        <div id="page-schedule" style="display: none;">
            <div class="page-header"><h1>Jadwal Mengajar</h1><p>Jadwal kursus yang harus Anda ajarkan</p></div>
            <div class="data-table">
                <table>
                    <thead><tr><th>Hari</th><th>Jam</th><th>Kursus</th><th>Ruangan</th><th>Status</th></tr></thead>
                    <tbody>
                        <tr><td>Senin</td><td>08:00 - 10:00</td><td>Pemrograman PHP Dasar</td><td>Ruang 101</td><td><span class="status-badge active">Terjadwal</span></td></tr>
                        <tr><td>Selasa</td><td>10:00 - 12:00</td><td>Web Development Laravel</td><td>Ruang 102</td><td><span class="status-badge active">Terjadwal</span></td></tr>
                        <tr><td>Rabu</td><td>13:00 - 15:00</td><td>Database MySQL</td><td>Ruang 103</td><td><span class="status-badge active">Terjadwal</span></td></tr>
                        <tr><td>Kamis</td><td>08:00 - 10:00</td><td>Pemrograman PHP Dasar</td><td>Ruang 101</td><td><span class="status-badge active">Terjadwal</span></td></tr>
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
            ['dashboard', 'profile', 'courses', 'schedule'].forEach(p => {
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
        </div>
        
        <div class="content">
            <h2>Instructor Panel</h2>
            <p>Selamat datang di halaman instructor. Di sini Anda dapat:</p>
            <ul>
                <li>Membuat dan mengelola kursus</li>
                <li>Melihat daftar siswa yang enroll</li>
                <li>Menilai tugas siswa</li>
                <li>Mengupload materi pembelajaran</li>
            </ul>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>
</body>
</html>