@extends('pages.admin.layout')

@section('title', 'Dashboard Admin')

@section('content')
<div class="page-header">
    <h1>Dashboard Admin</h1>
    <p>Selamat datang di halaman administrator</p>
</div>
<div class="content-grid">
    <div class="card"><h3>Total Kursus</h3><div class="value">12</div></div>
    <div class="card"><h3>Total Pengajar</h3><div class="value">5</div></div>
    <div class="card"><h3>Total Peserta</h3><div class="value">150</div></div>
    <div class="card"><h3>Total Pengguna</h3><div class="value">165</div></div>
</div>
@endsection