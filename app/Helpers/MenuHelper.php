<?php

namespace App\Helpers;

class MenuHelper
{
    public static function getMenuItems($user)
    {
        $role = is_string($user) ? $user : $user->role;

        $menus = [
            'admin' => [
                ['id' => 'dashboard', 'label' => 'Dashboard', 'icon' => '📊', 'route' => 'admin.dashboard'],
                ['id' => 'users', 'label' => 'Profile Pengguna', 'icon' => '👥', 'route' => 'admin.users'],
                ['id' => 'courses', 'label' => 'Manajemen Kursus', 'icon' => '📚', 'route' => 'admin.courses'],
                ['id' => 'instructors', 'label' => 'Manajemen Pengajar', 'icon' => '👨‍🏫', 'route' => 'admin.instructors'],
                ['id' => 'students', 'label' => 'Manajemen Peserta', 'icon' => '🎓', 'route' => 'admin.students'],
                ['id' => 'assignments', 'label' => 'Penugasan', 'icon' => '📋', 'route' => 'admin.assignments'],
            ],
            'instructor' => [
                ['id' => 'dashboard', 'label' => 'Dashboard', 'icon' => '📊', 'route' => 'instructor.dashboard'],
                ['id' => 'profile', 'label' => 'Profile Pengguna', 'icon' => '👤', 'route' => 'instructor.profile'],
                ['id' => 'courses', 'label' => 'Daftar Kursus', 'icon' => '📚', 'route' => 'instructor.courses'],
                ['id' => 'schedule', 'label' => 'Jadwal Mengajar', 'icon' => '📅', 'route' => 'instructor.schedule'],
            ],
            'student' => [
                ['id' => 'dashboard', 'label' => 'Dashboard', 'icon' => '📊', 'route' => 'student.dashboard'],
                ['id' => 'profile', 'label' => 'Profile Pengguna', 'icon' => '👤', 'route' => 'student.profile'],
                ['id' => 'mycourses', 'label' => 'Kursus Saya', 'icon' => '📚', 'route' => 'student.mycourses'],
                ['id' => 'search', 'label' => 'Cari Kursus', 'icon' => '🔍', 'route' => 'student.search'],
            ],
        ];

        if (!is_string($user) && $role === 'instructor' && !$user->instructor_verified) {
            return [
                ['id' => 'dashboard', 'label' => 'Dashboard', 'icon' => '📊', 'route' => 'instructor.dashboard'],
            ];
        }

        return $menus[$role] ?? [];
    }
}
