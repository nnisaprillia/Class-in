@extends('pages.instructor.layout')

@section('title', 'Daftar Kursus - Instructor')

@section('content')
<div class="page-header">
    <h1>Daftar Kursus</h1>
    <p>Kursus yang ditugaskan kepada Anda</p>
</div>
<div class="data-table">
    <table>
        <thead>
            <tr>
                <th>Nama Kursus</th>
                <th>Peserta</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Pemrograman PHP Dasar</td>
                <td>25</td>
                <td><span class="status-badge active">Aktif</span></td>
                <td>
                    <button class="btn btn-primary">Kelola</button>
                    <button class="btn btn-primary" style="margin-left: 4px;">Materi</button>
                </td>
            </tr>
            <tr>
                <td>Web Development dengan Laravel</td>
                <td>18</td>
                <td><span class="status-badge active">Aktif</span></td>
                <td>
                    <button class="btn btn-primary">Kelola</button>
                    <button class="btn btn-primary" style="margin-left: 4px;">Materi</button>
                </td>
            </tr>
            <tr>
                <td>Database MySQL</td>
                <td>32</td>
                <td><span class="status-badge active">Aktif</span></td>
                <td>
                    <button class="btn btn-primary">Kelola</button>
                    <button class="btn btn-primary" style="margin-left: 4px;">Materi</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection