@extends('pages.student.layout')

@section('title', 'Profile Pengguna - Student')

@section('content')
<div class="page-header">
    <h1>Profile Pengguna</h1>
    <p>Kelola data profile Anda</p>
</div>
<div class="card">
    <form>
        <div style="margin-bottom: 16px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 500;">Nama</label>
            <input type="text" value="{{ auth()->user()->name }}" style="width: 100%; padding: 12px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 14px;">
        </div>
        <div style="margin-bottom: 16px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 500;">Email</label>
            <input type="email" value="{{ auth()->user()->email }}" style="width: 100%; padding: 12px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 14px;">
        </div>
        <div style="margin-bottom: 16px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 500;">Role</label>
            <input type="text" value="Student" disabled style="width: 100%; padding: 12px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 14px; background: #f8fafc;">
        </div>
        <div style="margin-bottom: 16px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 500;">Password Baru</label>
            <input type="password" placeholder="Kosongkan jika tidak ingin mengubah" style="width: 100%; padding: 12px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 14px;">
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection