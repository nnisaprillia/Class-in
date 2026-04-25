@php
$menuItems = [
    ['id' => 'dashboard', 'label' => 'Dashboard', 'icon' => '📊'],
    ['id' => 'profile', 'label' => 'Profile Pengguna', 'icon' => '👤'],
    ['id' => 'courses', 'label' => 'Daftar Kursus', 'icon' => '📚'],
    ['id' => 'schedule', 'label' => 'Jadwal Mengajar', 'icon' => '📅'],
];
@endphp

<x-dashboard.sidebar :role="'instructor'" :menuItems="$menuItems">
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
</x-dashboard.sidebar>