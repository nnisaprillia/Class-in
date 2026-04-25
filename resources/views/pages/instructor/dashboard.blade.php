@extends('pages.instructor.layout')

@section('title', 'Dashboard Instructor')

@section('content')
<div class="page-header">
    <h1>Dashboard Instructor</h1>
    <p>Lengkapi formulir pengajuan validasi instruktur Anda.</p>
</div>

@if (session('application_success'))
    <div style="background: #dcfce7; color: #166534; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px;">
        {{ session('application_success') }}
    </div>
@endif

@if (session('instructor_notice'))
    <div style="background: #fef3c7; color: #92400e; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px;">
        {{ session('instructor_notice') }}
    </div>
@endif

@if ($errors->any())
    <div style="background: #fee2e2; color: #991b1b; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px;">
        {{ $errors->first() }}
    </div>
@endif

@php
    $isSubmitted = !is_null($application);
    $certificates = $isSubmitted
        ? $application->user?->certificates?->map(fn ($item) => [
            'cert_name' => $item->cert_name,
            'cert_link' => $item->cert_link,
        ])->toArray()
        : old('certificates', [['cert_name' => '', 'cert_link' => '']]);

    if (empty($certificates)) {
        $certificates = [['cert_name' => '', 'cert_link' => '']];
    }
@endphp

<div class="card">
    <h3 style="font-size: 20px; margin-bottom: 12px; color: #1e293b;">Form Pengajuan Instruktur</h3>
    <p style="color: #64748b; margin-bottom: 16px;">
        Status saat ini: <strong>{{ $application?->status ?? 'Belum submit' }}</strong>
    </p>

    <form method="POST" action="{{ route('instructor.application.store') }}" style="display: grid; gap: 14px;">
        @csrf

        <div>
            <label style="display:block; margin-bottom: 6px; font-weight: 600;">Nama Lengkap</label>
            <input type="text" name="full_name" value="{{ old('full_name', $application?->full_name ?? auth()->user()->name) }}" {{ $isSubmitted ? 'disabled' : '' }} required>
        </div>

        <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 12px;">
            <div>
                <label style="display:block; margin-bottom: 6px; font-weight: 600;">Nomor Telepon</label>
                <input type="text" name="phone_number" value="{{ old('phone_number', $application?->phone_number) }}" {{ $isSubmitted ? 'disabled' : '' }} required>
            </div>
            <div>
                <label style="display:block; margin-bottom: 6px; font-weight: 600;">Gmail</label>
                <input type="email" name="gmail" value="{{ old('gmail', $application?->gmail ?? auth()->user()->email) }}" {{ $isSubmitted ? 'disabled' : '' }} required>
            </div>
        </div>

        <div>
            <label style="display:block; margin-bottom: 6px; font-weight: 600;">Alamat</label>
            <textarea name="address" rows="3" {{ $isSubmitted ? 'disabled' : '' }} required>{{ old('address', $application?->address) }}</textarea>
        </div>

        <div>
            <label style="display:block; margin-bottom: 6px; font-weight: 600;">Link CV (Google Drive)</label>
            <input type="url" name="cv_link" value="{{ old('cv_link', auth()->user()->link_cv) }}" {{ $isSubmitted ? 'disabled' : '' }} required>
        </div>

        <div>
            <label style="display:block; margin-bottom: 8px; font-weight: 600;">Sertifikat</label>
            <div id="certificate-table" style="display:grid; gap:10px;">
                @foreach($certificates as $index => $certificate)
                    <div class="cert-row" style="display:grid; grid-template-columns: 1fr 1fr auto; gap:10px;">
                        <input type="text" name="certificates[{{ $index }}][cert_name]" value="{{ $certificate['cert_name'] ?? '' }}" placeholder="Nama sertifikat" {{ $isSubmitted ? 'disabled' : '' }} required>
                        <input type="url" name="certificates[{{ $index }}][cert_link]" value="{{ $certificate['cert_link'] ?? '' }}" placeholder="Link Google Drive" {{ $isSubmitted ? 'disabled' : '' }} required>
                        @if(!$isSubmitted)
                            <button type="button" class="btn btn-danger remove-cert">Hapus</button>
                        @endif
                    </div>
                @endforeach
            </div>
            @if(!$isSubmitted)
                <button type="button" id="add-cert" class="btn btn-primary" style="margin-top: 10px;">+ Tambah Sertifikat</button>
            @endif
        </div>

        @if(!$isSubmitted)
            <div>
                <button type="submit" class="btn btn-primary">Submit Pengajuan</button>
            </div>
        @endif
    </form>
</div>

@if(!$isSubmitted)
    <script>
        const certTable = document.getElementById('certificate-table');
        const addCertButton = document.getElementById('add-cert');

        function reindexCertificates() {
            certTable.querySelectorAll('.cert-row').forEach((row, index) => {
                const nameInput = row.querySelector('input[name*="[cert_name]"]');
                const linkInput = row.querySelector('input[name*="[cert_link]"]');
                nameInput.name = `certificates[${index}][cert_name]`;
                linkInput.name = `certificates[${index}][cert_link]`;
            });
        }

        addCertButton?.addEventListener('click', () => {
            const index = certTable.querySelectorAll('.cert-row').length;
            const row = document.createElement('div');
            row.className = 'cert-row';
            row.style.display = 'grid';
            row.style.gridTemplateColumns = '1fr 1fr auto';
            row.style.gap = '10px';
            row.innerHTML = `
                <input type="text" name="certificates[${index}][cert_name]" placeholder="Nama sertifikat" required>
                <input type="url" name="certificates[${index}][cert_link]" placeholder="Link Google Drive" required>
                <button type="button" class="btn btn-danger remove-cert">Hapus</button>
            `;
            certTable.appendChild(row);
        });

        certTable?.addEventListener('click', (event) => {
            if (!event.target.classList.contains('remove-cert')) {
                return;
            }

            const rows = certTable.querySelectorAll('.cert-row');
            if (rows.length <= 1) {
                return;
            }

            event.target.closest('.cert-row').remove();
            reindexCertificates();
        });
    </script>
@endif
@endsection