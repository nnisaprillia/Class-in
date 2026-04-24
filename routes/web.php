<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Role-based Dashboard Routes
Route::get('/admin/dashboard', function () {
    return view('dashboard.admin');
})->middleware(['auth', 'verified', 'role:admin'])->name('admin.dashboard');

Route::get('/instructor/dashboard', function () {
    return view('dashboard.instructor');
})->middleware(['auth', 'verified', 'role:instructor'])->name('instructor.dashboard');

Route::get('/student/dashboard', function () {
    return view('dashboard.student');
})->middleware(['auth', 'verified', 'role:student'])->name('student.dashboard');

// Default dashboard - redirect based on role
Route::get('/dashboard', function () {
    $user = auth()->user();
    
    return match ($user->role) {
        'admin' => redirect()->route('admin.dashboard'),
        'instructor' => redirect()->route('instructor.dashboard'),
        'student' => redirect()->route('student.dashboard'),
        default => redirect('/'),
    };
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
