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
        @include('pages.admin.dashboard')
    </div>
    
    <!-- Users Page -->
    <div id="page-users" style="display: none;">
        @include('pages.admin.users')
    </div>
    
    <!-- Courses Page -->
    <div id="page-courses" style="display: none;">
        @include('pages.admin.courses')
    </div>
    
    <!-- Instructors Page -->
    <div id="page-instructors" style="display: none;">
        @include('pages.admin.instructors')
    </div>
    
    <!-- Students Page -->
    <div id="page-students" style="display: none;">
        @include('pages.admin.students')
    </div>
    
    <!-- Assignments Page -->
    <div id="page-assignments" style="display: none;">
        @include('pages.admin.assignments')
    </div>
</x-dashboard.sidebar>