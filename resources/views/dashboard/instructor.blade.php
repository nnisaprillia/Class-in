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
        @include('pages.instructor.dashboard')
    </div>
    
    <!-- Profile Page -->
    <div id="page-profile" style="display: none;">
        @include('pages.instructor.profile')
    </div>
    
    <!-- Courses Page -->
    <div id="page-courses" style="display: none;">
        @include('pages.instructor.courses')
    </div>
    
    <!-- Schedule Page -->
    <div id="page-schedule" style="display: none;">
        @include('pages.instructor.schedule')
    </div>
</x-dashboard.sidebar>