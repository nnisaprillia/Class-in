<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InstructorApplicationController;
use App\Http\Controllers\AdminStudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

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

// Admin Routes
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.admin.dashboard');
    })->name('dashboard');
    
    Route::get('/users', function () {
        return view('pages.admin.users');
    })->name('users');
    
    Route::get('/courses', function () {
        return view('pages.admin.courses');
    })->name('courses');
    
    Route::get('/instructors', [InstructorApplicationController::class, 'index'])->name('instructors');
    Route::patch('/instructors/{application}/status', [InstructorApplicationController::class, 'updateStatus'])->name('instructors.update-status');
    
    Route::get('/students', [AdminStudentController::class, 'index'])->name('students');
    Route::post('/students', [AdminStudentController::class, 'store'])->name('students.store');
    Route::patch('/students/{student}', [AdminStudentController::class, 'update'])->name('students.update');
    Route::delete('/students/{student}', [AdminStudentController::class, 'destroy'])->name('students.destroy');
    
    Route::get('/assignments', function () {
        return view('pages.admin.assignments');
    })->name('assignments');
});

// Instructor Routes
Route::middleware(['auth', 'verified', 'role:instructor'])->prefix('instructor')->name('instructor.')->group(function () {
    Route::get('/dashboard', function () {
        $application = auth()->user()->instructorApplication()->with('user.certificates')->first();

        return view('pages.instructor.dashboard', [
            'application' => $application,
        ]);
    })->name('dashboard');
    Route::post('/application', [InstructorApplicationController::class, 'store'])->name('application.store');
    
    Route::get('/profile', function () {
        return view('pages.instructor.profile');
    })->middleware('instructor.verified')->name('profile');
    
    Route::get('/courses', function () {
        return view('pages.instructor.courses');
    })->middleware('instructor.verified')->name('courses');
    
    Route::get('/schedule', function () {
        return view('pages.instructor.schedule');
    })->middleware('instructor.verified')->name('schedule');
});

// Student Routes
Route::middleware(['auth', 'verified', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.student.dashboard');
    })->name('dashboard');
    
    Route::get('/profile', function () {
        return view('pages.student.profile');
    })->name('profile');
    
    Route::get('/mycourses', function () {
        return view('pages.student.mycourses');
    })->name('mycourses');
    
    Route::get('/search', function () {
        return view('pages.student.search');
    })->name('search');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';