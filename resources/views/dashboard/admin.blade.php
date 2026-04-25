@php
$menuItems = [
    ['id' => 'dashboard', 'label' => 'Dashboard', 'icon' => '📊'],
    ['id' => 'users', 'label' => 'Profile Pengguna', 'icon' => '👥'],
    ['id' => 'courses', 'label' => 'Manajemen Kursus', 'icon' => '📚'],
    ['id' => 'instructors', 'label' => 'Manajemen Pengajar', 'icon' => '👨‍🏫'],
    ['id' => 'students', 'label' => 'Manajemen Peserta', 'icon' => '🎓'],
    ['id' => 'assignments', 'label' => 'Penugasan', 'icon' => '📋'],
];
@endphp

<x-dashboard.sidebar :role="'admin'" :menuItems="$menuItems">
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
</x-dashboard.sidebar>