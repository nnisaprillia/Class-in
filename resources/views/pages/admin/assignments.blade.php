@extends('pages.admin.layout')

@section('title', 'Penugasan - Admin')

@section('content')
<div class="page-header">
    <h1>Penugasan</h1>
    <p>Tugaskan pengajar ke dalam kursus</p>
    <button class="btn btn-primary" style="margin-top: 16px;">+ Tambah Penugasan</button>
</div>
<div class="data-table">
    <table>
        <thead>
            <tr>
                <th>Kursus</th>
                <th>Instructor Ditugaskan</th>
                <th>Tanggal Penugasan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Pemrograman PHP Dasar</td>
                <td>Budi Santoso</td>
                <td>2024-01-15</td>
                <td><span class="status-badge active">Aktif</span></td>
                <td>
                    <button class="btn btn-primary">Edit</button>
                    <button class="btn btn-danger" style="margin-left: 4px;">Batal</button>
                </td>
            </tr>
            <tr>
                <td>Web Development dengan Laravel</td>
                <td>Siti Rahayu</td>
                <td>2024-01-20</td>
                <td><span class="status-badge active">Aktif</span></td>
                <td>
                    <button class="btn btn-primary">Edit</button>
                    <button class="btn btn-danger" style="margin-left: 4px;">Batal</button>
                </td>
            </tr>
            <tr>
                <td>Database MySQL</td>
                <td>Ahmad Fauzi</td>
                <td>2024-02-01</td>
                <td><span class="status-badge active">Aktif</span></td>
                <td>
                    <button class="btn btn-primary">Edit</button>
                    <button class="btn btn-danger" style="margin-left: 4px;">Batal</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection