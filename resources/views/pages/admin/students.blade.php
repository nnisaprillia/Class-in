@extends('pages.admin.layout')

@section('title', 'Manajemen Peserta - Admin')

@section('content')
<div class="page-header">
    <h1>Manajemen Peserta</h1>
    <p>Kelola data user dengan role student</p>
    <button type="button" class="btn btn-primary" style="margin-top: 16px;" onclick="openCreateModal()">+ Tambah Peserta</button>
</div>

@if (session('student_success'))
    <div style="background: #dcfce7; color: #166534; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px;">
        {{ session('student_success') }}
    </div>
@endif

@if ($errors->any())
    <div style="background: #fee2e2; color: #991b1b; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px;">
        {{ $errors->first() }}
    </div>
@endif

<div class="data-table">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>CV</th>
                <th>Sertifikat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($students as $student)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>
                        @if($student->link_cv)
                            <a href="{{ $student->link_cv }}" target="_blank" rel="noopener noreferrer">Lihat CV</a>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if($student->certificates->count())
                            @php
                                $certificatePayload = $student->certificates->map(function ($certificate) {
                                    return [
                                        'cert_name' => $certificate->cert_name,
                                        'cert_link' => $certificate->cert_link,
                                    ];
                                })->values()->all();
                            @endphp
                            <button type="button" class="btn btn-primary" onclick='openCertificateModal(@json($certificatePayload))'>Lihat</button>
                        @else
                            -
                        @endif
                    </td>
                    <td style="display: flex; gap: 8px; align-items: center;">
                        @php
                            $studentPayload = [
                                'id' => $student->id,
                                'name' => $student->name,
                                'email' => $student->email,
                                'link_cv' => $student->link_cv,
                                'certificates' => $student->certificates->map(function ($item) {
                                    return [
                                        'cert_name' => $item->cert_name,
                                        'cert_link' => $item->cert_link,
                                    ];
                                })->values()->all(),
                            ];
                        @endphp
                        <button type="button"
                                class="btn btn-primary"
                                onclick='openEditModal(@json($studentPayload))'>
                            Edit
                        </button>

                        <form method="POST" action="{{ route('admin.students.destroy', $student) }}" onsubmit="return confirm('Hapus peserta ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: #64748b;">Belum ada data peserta.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div id="create-student-modal" class="modal-backdrop" style="display: none;">
    <div class="modal-card">
        <div class="modal-header">
            <h3>Tambah Peserta</h3>
            <button type="button" class="modal-close" onclick="closeCreateModal()">x</button>
        </div>
        <form method="POST" action="{{ route('admin.students.store') }}" class="modal-form">
            @csrf
            <div>
                <label>Nama</label>
                <input type="text" name="name" required value="{{ old('name') }}">
            </div>
            <div>
                <label>Email</label>
                <input type="email" name="email" required value="{{ old('email') }}">
            </div>
            <div>
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <div>
                <label>Link CV</label>
                <input type="url" name="link_cv" value="{{ old('link_cv') }}" placeholder="https://drive.google.com/...">
            </div>
            <div>
                <div class="cert-header">
                    <label>Sertifikat</label>
                    <button type="button" class="btn btn-primary" onclick="addCertificateRow('create-cert-list')">+ Sertifikat</button>
                </div>
                <div id="create-cert-list" class="cert-list"></div>
            </div>
            <div style="display: flex; justify-content: flex-end; gap: 8px;">
                <button type="button" class="btn" onclick="closeCreateModal()">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div id="edit-student-modal" class="modal-backdrop" style="display: none;">
    <div class="modal-card">
        <div class="modal-header">
            <h3>Edit Peserta</h3>
            <button type="button" class="modal-close" onclick="closeEditModal()">x</button>
        </div>
        <form id="edit-student-form" method="POST" action="" class="modal-form">
            @csrf
            @method('PATCH')
            <div>
                <label>Nama</label>
                <input id="edit-name" type="text" name="name" required>
            </div>
            <div>
                <label>Email</label>
                <input id="edit-email" type="email" name="email" required>
            </div>
            <div>
                <label>Password Baru (Opsional)</label>
                <input type="password" name="password">
            </div>
            <div>
                <label>Link CV</label>
                <input id="edit-link-cv" type="url" name="link_cv" placeholder="https://drive.google.com/...">
            </div>
            <div>
                <div class="cert-header">
                    <label>Sertifikat</label>
                    <button type="button" class="btn btn-primary" onclick="addCertificateRow('edit-cert-list')">+ Sertifikat</button>
                </div>
                <div id="edit-cert-list" class="cert-list"></div>
            </div>
            <div style="display: flex; justify-content: flex-end; gap: 8px;">
                <button type="button" class="btn" onclick="closeEditModal()">Batal</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>

<div id="certificate-modal" class="modal-backdrop" style="display: none;">
    <div class="modal-card" style="width: min(720px, 100%);">
        <div class="modal-header">
            <h3>Daftar Sertifikat</h3>
            <button type="button" class="modal-close" onclick="closeCertificateModal()">x</button>
        </div>
        <div class="data-table">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Sertifikat</th>
                        <th>Lihat</th>
                    </tr>
                </thead>
                <tbody id="certificate-modal-body"></tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .modal-backdrop {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.45);
        z-index: 999;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }
    .modal-card {
        width: min(760px, 100%);
        max-height: 90vh;
        overflow-y: auto;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 20px 40px rgba(15, 23, 42, 0.2);
        padding: 20px;
    }
    .modal-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 16px;
    }
    .modal-close {
        background: transparent;
        border: none;
        font-size: 18px;
        cursor: pointer;
        color: #475569;
    }
    .modal-form {
        display: grid;
        gap: 12px;
    }
    .modal-form label {
        display: block;
        margin-bottom: 6px;
        font-size: 13px;
        color: #334155;
        font-weight: 600;
    }
    .modal-form input {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
    }
    .cert-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }
    .cert-list {
        display: grid;
        gap: 8px;
    }
    .cert-row {
        display: grid;
        grid-template-columns: 1fr 1fr auto;
        gap: 8px;
        align-items: center;
    }
</style>

<script>
    function escapeHtml(value) {
        return String(value ?? '')
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    function createCertRow(targetId, certName = '', certLink = '') {
        const wrapper = document.getElementById(targetId);
        const index = wrapper.querySelectorAll('.cert-row').length;

        const row = document.createElement('div');
        row.className = 'cert-row';
        row.innerHTML = `
            <input type="text" name="certificates[${index}][cert_name]" placeholder="Nama Sertifikat" value="${escapeHtml(certName)}">
            <input type="url" name="certificates[${index}][cert_link]" placeholder="Link Sertifikat" value="${escapeHtml(certLink)}">
            <button type="button" class="btn btn-danger" onclick="removeCertRow(this, '${targetId}')">Hapus</button>
        `;

        wrapper.appendChild(row);
    }

    function reindexCertRows(targetId) {
        const rows = document.querySelectorAll(`#${targetId} .cert-row`);
        rows.forEach((row, index) => {
            const nameInput = row.querySelector('input[name*="[cert_name]"]');
            const linkInput = row.querySelector('input[name*="[cert_link]"]');
            nameInput.name = `certificates[${index}][cert_name]`;
            linkInput.name = `certificates[${index}][cert_link]`;
        });
    }

    function removeCertRow(button, targetId) {
        button.closest('.cert-row').remove();
        reindexCertRows(targetId);
    }

    function addCertificateRow(targetId) {
        createCertRow(targetId);
    }

    function openCreateModal() {
        document.getElementById('create-student-modal').style.display = 'flex';
        const list = document.getElementById('create-cert-list');
        if (!list.children.length) {
            createCertRow('create-cert-list');
        }
    }

    function closeCreateModal() {
        document.getElementById('create-student-modal').style.display = 'none';
    }

    function openEditModal(student) {
        const modal = document.getElementById('edit-student-modal');
        const form = document.getElementById('edit-student-form');
        const certList = document.getElementById('edit-cert-list');

        form.action = `{{ url('admin/students') }}/${student.id}`;
        document.getElementById('edit-name').value = student.name || '';
        document.getElementById('edit-email').value = student.email || '';
        document.getElementById('edit-link-cv').value = student.link_cv || '';

        certList.innerHTML = '';
        if (student.certificates && student.certificates.length) {
            student.certificates.forEach((item) => {
                createCertRow('edit-cert-list', item.cert_name || '', item.cert_link || '');
            });
        } else {
            createCertRow('edit-cert-list');
        }

        modal.style.display = 'flex';
    }

    function closeEditModal() {
        document.getElementById('edit-student-modal').style.display = 'none';
    }

    function openCertificateModal(certificates) {
        const modal = document.getElementById('certificate-modal');
        const body = document.getElementById('certificate-modal-body');

        body.innerHTML = '';
        certificates.forEach((certificate, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${index + 1}</td>
                <td>${escapeHtml(certificate.cert_name ?? '-')}</td>
                <td>
                    <a href="${escapeHtml(certificate.cert_link)}" target="_blank" rel="noopener noreferrer">
                        <button type="button" class="btn btn-primary" title="Lihat Sertifikat">👁️</button>
                    </a>
                </td>
            `;
            body.appendChild(row);
        });

        modal.style.display = 'flex';
    }

    function closeCertificateModal() {
        document.getElementById('certificate-modal').style.display = 'none';
    }
</script>
@endsection