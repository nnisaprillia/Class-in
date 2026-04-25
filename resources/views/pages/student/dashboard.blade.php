@extends('pages.student.layout')

@section('title', 'Dashboard Student')

@section('content')
<div class="page-header">
    <h1>Dashboard Student</h1>
    <p>Selamat datang di halaman student</p>
</div>
<div class="content-grid">
    <div class="card"><h3>Kursus Diikuti</h3><div class="value">2</div></div>
    <div class="card"><h3>Tugas Selesai</h3><div class="value">15</div></div>
    <div class="card"><h3>Progres Belajar</h3><div class="value">65%</div></div>
    <div class="card"><h3>Sertifikat</h3><div class="value">1</div></div>
</div>
@endsection