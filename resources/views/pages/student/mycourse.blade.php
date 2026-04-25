@extends('pages.student.layout')

@section('title', 'Kursus Saya - Student')

@section('content')
<div class="page-header">
    <h1>Kursus Saya</h1>
    <p>Kursus yang Anda ikuti</p>
</div>
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
@endsection