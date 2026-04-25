@extends('pages.instructor.layout')

@section('title', 'Jadwal Mengajar - Instructor')

@section('content')
<div class="page-header">
    <h1>Jadwal Mengajar</h1>
    <p>Jadwal kursus yang harus Anda ajarkan</p>
</div>
<div class="data-table">
    <table>
        <thead><tr><th>Hari</th><th>Jam</th><th>Kursus</th><th>Ruangan</th><th>Status</th></tr></thead>
        <tbody>
            <tr><td>Senin</td><td>08:00 - 10:00</td><td>Pemrograman PHP Dasar</td><td>Ruang 101</td><td><span class="status-badge active">Terjadwal</span></td></tr>
            <tr><td>Selasa</td><td>10:00 - 12:00</td><td>Web Development Laravel</td><td>Ruang 102</td><td><span class="status-badge active">Terjadwal</span></td></tr>
            <tr><td>Rabu</td><td>13:00 - 15:00</td><td>Database MySQL</td><td>Ruang 103</td><td><span class="status-badge active">Terjadwal</span></td></tr>
            <tr><td>Kamis</td><td>08:00 - 10:00</td><td>Pemrograman PHP Dasar</td><td>Ruang 101</td><td><span class="status-badge active">Terjadwal</span></td></tr>
            <tr><td>Jumat</td><td>10:00 - 12:00</td><td>Web Development Laravel</td><td>Ruang 102</td><td><span class="status-badge active">Terjadwal</span></td></tr>
        </tbody>
    </table>
</div>
@endsection
            </tr>
        </tbody>
    </table>
</div>