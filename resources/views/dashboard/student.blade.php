<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - Class-in</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: system-ui, -apple-system, sans-serif; background-color: #f3f4f6; min-height: 100vh; }
        
        /* Sidebar Styles */
        .sidebar { position: fixed; left: 0; top: 0; height: 100vh; width: 260px; background: #1e293b; color: white; transition: transform 0.3s ease; z-index: 1000; overflow-y: auto; }
        .sidebar.closed { transform: translateX(-100%); }
        .sidebar-header { padding: 20px; border-bottom: 1px solid #334155; }
        .sidebar-header h2 { font-size: 20px; font-weight: 600; }
        .sidebar-header .role-badge { display: inline-block; padding: 4px 12px; background: #f59e0b; border-radius: 20px; font-size: 12px; margin-top: 8px; }
        .sidebar-menu { padding: 16px 0; }
        .menu-item { display: block; padding: 12px 20px; color: #94a3b8; text-decoration: none; transition: all 0.2s; cursor: pointer; }
        .menu-item:hover { background: #334155; color: white; }
        .menu-item.active { background: #f59e0b; color: white; }
        .sidebar-footer { position: absolute; bottom: 0; left: 0; right: 0; padding: 16px 20px; border-top: 1px solid #334155; }
        .user-info { display: flex; align-items: center; gap: 12px; }
        .user-avatar { width: 40px; height: 40px; border-radius: 50%; background: #f59e0b; display: flex; align-items: center; justify-content: center; font-weight: 600; }
        .user-details { flex: 1; }
        .user-name { font-weight: 500; font-size: 14px; }
        .user-email { font-size: 12px; color: #94a3b8; }
        
        /* Toggle Button */
        .sidebar-toggle { position: fixed; left: 260px; top: 20px; z-index: 1001; background: #1e293b; color: white; border: none; padding: 10px 14px; border-radius: 0 6px 6px 0; cursor: pointer; transition: left 0.3s ease; }
        .sidebar-toggle.closed { left: 0; }
        
        /* Main Content */
        .main-content { margin-left: 260px; padding: 30px; transition: margin-left 0.3s ease; }
        .main-content.expanded { margin-left: 0; }
        
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
        .btn-primary { background: #f59e0b; color: white; }
        .btn-danger { background: #dc2626; color: white; }
        .logout-form { margin-top: 12px; }
        
        /* Search Box */
        .search-box { display: flex; gap: 12px; margin-bottom: 24px; }
        .search-box input { flex: 1; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 14px; }
        .search-box button { padding: 12px 24px; background: #f59e0b; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: 500; }
        
        /* Course Cards */
        .course-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px; }
        .course-card { background: white; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden; }
        .course-card-image { height: 140px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .course-card-body { padding: 20px; }
        .course-card-body h4 { font-size: 16px; font-weight: 600; color: #1e293b; margin-bottom: 8px; }
        .course-card-body p { font-size: 14px; color: #64748b; margin-bottom: 12px; }
        .course-card-body .instructor { font-size: 13px; color: #94a3b8; margin-bottom: 12px; }
    </style>
</head>
<body>
    <button class="sidebar-toggle" onclick="toggleSidebar()">☰</button>
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h2>Class-in</h2>
            <span class="role-badge">Student</span>
        </div>
        <nav class="sidebar-menu">
            <a class="menu-item active" onclick="showPage('dashboard')">📊 Dashboard</a>
            <a class="menu-item" onclick="showPage('profile')">👤 Profile Pengguna</a>
            <a class="menu-item" onclick="showPage('mycourses')">📚 Kursus Saya</a>
            <a class="menu-item" onclick="showPage('search')">🔍 Cari Kursus</a>
        </nav>
        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">S</div>
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
                <h1>Ini adalah dashboard student</h1>
                <p>Selamat datang di halaman student</p>
            </div>
            <div class="content-grid">
                <div class="card"><h3>Kursus Diikuti</h3><div class="value">2</div></div>
                <div class="card"><h3>Tugas Selesai</h3><div class="value">15</div></div>
                <div class="card"><h3>Progres Belajar</h3><div class="value">65%</div></div>
                <div class="card"><h3>Sertifikat</h3><div class="value">1</div></div>
            </div>
        </div>
        
        <!-- Profile Page -->
        <div id="page-profile" style="display: none;">
            <div class="page-header"><h1>Profile Pengguna</h1><p>Kelola data profile Anda</p></div>
            <div class="card">
                <h3>Nama: {{ auth()->user()->name }}</h3>
                <p style="margin-top: 12px;">Email: {{ auth()->user()->email }}</p>
                <p style="margin-top: 8px;">Role: Student</p>
                <button class="btn btn-primary" style="margin-top: 16px;">Edit Profile</button>
            </div>
        </div>
        
        <!-- My Courses Page -->
        <div id="page-mycourses" style="display: none;">
            <div class="page-header"><h1>Kursus Saya</h1><p>Kursus yang Anda ikuti</p></div>
            <div class="course-grid">
                <div class="course-card">
                    <div class="course-card-image"></div>
                    <div class="course-card-body">
                        <h4>Pemrograman PHP Dasar</h4>
                        <p class="instructor">Instructor: Budi Santoso</p>
                        <p>Progres: 75%</p>
                        <button class="btn btn-primary" style="margin-top: 12px; width: 100%;">Lanjutkan Belajar</button>
                    </div>
                </div>
                <div class="course-card">
                    <div class="course-card-image" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);"></div>
                    <div class="course-card-body">
                        <h4>Web Development dengan Laravel</h4>
                        <p class="instructor">Instructor: Siti Rahayu</p>
                        <p>Progres: 45%</p>
                        <button class="btn btn-primary" style="margin-top: 12px; width: 100%;">Lanjutkan Belajar</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Search Course Page -->
        <div id="page-search" style="display: none;">
            <div class="page-header"><h1>Cari Kursus</h1><p>Tem kursus yang Anda inginkan</p></div>
            <div class="search-box">
                <input type="text" placeholder="Cari kursus...">
                <button>Cari</button>
            </div>
            <div class="course-grid">
                <div class="course-card">
                    <div class="course-card-image" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);"></div>
                    <div class="course-card-body">
                        <h4>Database MySQL</h4>
                        <p class="instructor">Instructor: Ahmad Fauzi</p>
                        <p>50 Peserta</p>
                        <button class="btn btn-primary" style="margin-top: 12px; width: 100%;">Enroll</button>
                    </div>
                </div>
                <div class="course-card">
                    <div class="course-card-image" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);"></div>
                    <div class="course-card-body">
                        <h4>JavaScript Fundamental</h4>
                        <p class="instructor">Instructor: Diana</p>
                        <p>30 Peserta</p>
                        <button class="btn btn-primary" style="margin-top: 12px; width: 100%;">Enroll</button>
                    </div>
                </div>
                <div class="course-card">
                    <div class="course-card-image" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);"></div>
                    <div class="course-card-body">
                        <h4>React JS untuk Pemula</h4>
                        <p class="instructor">Instructor: Reza</p>
                        <p>40 Peserta</p>
                        <button class="btn btn-primary" style="margin-top: 12px; width: 100%;">Enroll</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('closed');
            document.querySelector('.sidebar-toggle').classList.toggle('closed');
            document.getElementById('mainContent').classList.toggle('expanded');
        }
        function showPage(pageId) {
            ['dashboard', 'profile', 'mycourses', 'search'].forEach(p => {
                document.getElementById('page-' + p).style.display = 'none';
            });
            document.getElementById('page-' + pageId).style.display = 'block';
            document.querySelectorAll('.menu-item').forEach(item => item.classList.remove('active'));
            event.target.classList.add('active');
        }
    </script>
</body>
</html>
        </div>
        
        <div class="content">
            <h2>Student Panel</h2>
            <p>Selamat datang di halaman student. Di sini Anda dapat:</p>
            <ul>
                <li>Melihat daftar kursus yang tersedia</li>
                <li>Meng enroll ke kursus</li>
                <li>Mengakses materi pembelajaran</li>
                <li>Melihat progres belajar</li>
            </ul>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>
</body>
</html>