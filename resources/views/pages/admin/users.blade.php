@extends('pages.admin.layout')

@section('title', 'Profile Pengguna - Admin')

@section('content')
<div class="page-header">
    <h1>Profile Pengguna</h1>
    <p>Kelola data pengguna sistem</p>
</div>
<div class="data-table">
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Admin</td>
                <td>admin@classin.com</td>
                <td>Admin</td>
                <td><span class="status-badge active">Aktif</span></td>
                <td>
                    <button class="btn btn-primary">Edit</button>
                    <button class="btn btn-danger" style="margin-left: 4px;">Hapus</button>
                </td>
            </tr>
            <tr>
                <td>Instructor</td>
                <td>instructor@classin.com</td>
                <td>Instructor</td>
                <td><span class="status-badge active">Aktif</span></td>
                <td>
                    <button class="btn btn-primary">Edit</button>
                    <button class="btn btn-danger" style="margin-left: 4px;">Hapus</button>
                </td>
            </tr>
            <tr>
                <td>Student</td>
                <td>student@classin.com</td>
                <td>Student</td>
                <td><span class="status-badge active">Aktif</span></td>
                <td>
                    <button class="btn btn-primary">Edit</button>
                    <button class="btn btn-danger" style="margin-left: 4px;">Hapus</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection