@php
$menuItems = [
    ['id' => 'dashboard', 'label' => 'Dashboard', 'icon' => '📊'],
    ['id' => 'profile', 'label' => 'Profile Pengguna', 'icon' => '👤'],
    ['id' => 'mycourses', 'label' => 'Kursus Saya', 'icon' => '📚'],
    ['id' => 'search', 'label' => 'Cari Kursus', 'icon' => '🔍'],
];
@endphp

<x-dashboard.sidebar :role="'student'" :menuItems="$menuItems">
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
        <div class="course-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px;">
            <div class="course-card" style="background: white; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden;">
                <div class="course-card-image" style="height: 140px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);"></div>
                <div class="course-card-body" style="padding: 20px;">
                    <h4 style="font-size: 16px; font-weight: 600; color: #1e293b; margin-bottom: 8px;">Pemrograman PHP Dasar</h4>
                    <p style="font-size: 13px; color: #94a3b8; margin-bottom: 12px;">Instructor: Budi Santoso</p>
                    <p>Progres: 75%</p>
                    <button class="btn btn-primary" style="margin-top: 12px; width: 100%;">Lanjutkan Belajar</button>
                </div>
            </div>
            <div class="course-card" style="background: white; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden;">
                <div class="course-card-image" style="height: 140px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);"></div>
                <div class="course-card-body" style="padding: 20px;">
                    <h4 style="font-size: 16px; font-weight: 600; color: #1e293b; margin-bottom: 8px;">Web Development dengan Laravel</h4>
                    <p style="font-size: 13px; color: #94a3b8; margin-bottom: 12px;">Instructor: Siti Rahayu</p>
                    <p>Progres: 45%</p>
                    <button class="btn btn-primary" style="margin-top: 12px; width: 100%;">Lanjutkan Belajar</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Search Course Page -->
    <div id="page-search" style="display: none;">
        <div class="page-header"><h1>Cari Kursus</h1><p>Temukan kursus yang Anda inginkan</p></div>
        <div class="search-box" style="display: flex; gap: 12px; margin-bottom: 24px;">
            <input type="text" placeholder="Cari kursus..." style="flex: 1; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 14px;">
            <button style="padding: 12px 24px; background: #f59e0b; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: 500;">Cari</button>
        </div>
        <div class="course-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px;">
            <div class="course-card" style="background: white; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden;">
                <div class="course-card-image" style="height: 140px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);"></div>
                <div class="course-card-body" style="padding: 20px;">
                    <h4 style="font-size: 16px; font-weight: 600; color: #1e293b; margin-bottom: 8px;">Database MySQL</h4>
                    <p style="font-size: 13px; color: #94a3b8; margin-bottom: 12px;">Instructor: Ahmad Fauzi</p>
                    <p>50 Peserta</p>
                    <button class="btn btn-primary" style="margin-top: 12px; width: 100%;">Enroll</button>
                </div>
            </div>
            <div class="course-card" style="background: white; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden;">
                <div class="course-card-image" style="height: 140px; background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);"></div>
                <div class="course-card-body" style="padding: 20px;">
                    <h4 style="font-size: 16px; font-weight: 600; color: #1e293b; margin-bottom: 8px;">JavaScript Fundamental</h4>
                    <p style="font-size: 13px; color: #94a3b8; margin-bottom: 12px;">Instructor: Diana</p>
                    <p>30 Peserta</p>
                    <button class="btn btn-primary" style="margin-top: 12px; width: 100%;">Enroll</button>
                </div>
            </div>
            <div class="course-card" style="background: white; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden;">
                <div class="course-card-image" style="height: 140px; background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);"></div>
                <div class="course-card-body" style="padding: 20px;">
                    <h4 style="font-size: 16px; font-weight: 600; color: #1e293b; margin-bottom: 8px;">React JS untuk Pemula</h4>
                    <p style="font-size: 13px; color: #94a3b8; margin-bottom: 12px;">Instructor: Reza</p>
                    <p>40 Peserta</p>
                    <button class="btn btn-primary" style="margin-top: 12px; width: 100%;">Enroll</button>
                </div>
            </div>
        </div>
    </div>
</x-dashboard.sidebar>