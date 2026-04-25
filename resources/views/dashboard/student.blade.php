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
        @include('pages.student.dashboard')
    </div>
    
    <!-- Profile Page -->
    <div id="page-profile" style="display: none;">
        @include('pages.student.profile')
    </div>
    
    <!-- My Courses Page -->
    <div id="page-mycourses" style="display: none;">
        @include('pages.student.mycourses')
    </div>
    
    <!-- Search Course Page -->
    <div id="page-search" style="display: none;">
        @include('pages.student.search')
    </div>
</x-dashboard.sidebar>