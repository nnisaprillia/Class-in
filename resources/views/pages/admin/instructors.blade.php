@extends('pages.admin.layout')

@section('title', 'Manajemen Pengajar - Admin')

@section('content')
<div class="page-header">
    <h1>Manajemen Instruktur</h1>
    <p>Kelola status pengajuan instruktur sebelum akun instruktur diaktifkan.</p>
</div>

@if (session('status_success'))
    <div style="background: #dcfce7; color: #166534; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px;">
        {{ session('status_success') }}
    </div>
@endif

@if ($errors->any())
    <div style="background: #fee2e2; color: #991b1b; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px;">
        {{ $errors->first() }}
    </div>
@endif

@php
    $currentTab = request('tab', 'pending');
    $pendingStatuses = ['Submitted', 'Review', 'Interview'];
    $pendingApplications = $applications->whereIn('status', $pendingStatuses)->values();
    $acceptedApplications = $applications->where('status', 'Accepted')->values();
    $declinedApplications = $applications->where('status', 'Declined')->values();

    $tabApplications = match ($currentTab) {
        'accepted' => $acceptedApplications,
        'declined' => $declinedApplications,
        default => $pendingApplications,
    };
@endphp

<div style="display: flex; gap: 10px; margin-bottom: 20px;">
    <a href="{{ route('admin.instructors', ['tab' => 'pending']) }}"
       class="btn {{ $currentTab === 'pending' ? 'btn-primary' : '' }}"
       style="{{ $currentTab === 'pending' ? '' : 'background: #e2e8f0; color: #334155;' }}">
        Perlu Validasi ({{ $pendingApplications->count() }})
    </a>
    <a href="{{ route('admin.instructors', ['tab' => 'accepted']) }}"
       class="btn {{ $currentTab === 'accepted' ? 'btn-primary' : '' }}"
       style="{{ $currentTab === 'accepted' ? '' : 'background: #e2e8f0; color: #334155;' }}">
        Accepted ({{ $acceptedApplications->count() }})
    </a>
    <a href="{{ route('admin.instructors', ['tab' => 'declined']) }}"
       class="btn {{ $currentTab === 'declined' ? 'btn-primary' : '' }}"
       style="{{ $currentTab === 'declined' ? '' : 'background: #e2e8f0; color: #334155;' }}">
        Declined ({{ $declinedApplications->count() }})
    </a>
</div>

<div class="data-table">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Kontak</th>
                <th>Status</th>
                <th>CV</th>
                <th>Sertifikat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tabApplications as $application)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $application->full_name }}</td>
                    <td>{{ $application->gmail }}</td>
                    <td>
                        <div>{{ $application->phone_number }}</div>
                        <small style="color: #64748b;">{{ $application->address }}</small>
                    </td>
                    <td>
                        <span class="status-badge active">{{ $application->status }}</span>
                    </td>
                    <td>
                        @if($application->user?->link_cv)
                            <a href="{{ $application->user->link_cv }}" target="_blank" rel="noopener noreferrer">Lihat CV</a>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if($application->user && $application->user->certificates->count())
                            @php
                                $certificatePayload = $application->user->certificates->map(function ($certificate) {
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
                    <td>
                        <form method="POST" action="{{ route('admin.instructors.update-status', $application) }}">
                            @csrf
                            @method('PATCH')
                            <select name="status" onchange="this.form.submit()" style="padding: 8px; border: 1px solid #cbd5e1; border-radius: 6px; min-width: 140px;">
                                @foreach($statuses as $status)
                                    <option value="{{ $status }}" @selected($application->status === $status)>{{ $status }}</option>
                                @endforeach
                            </select>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center; color: #64748b;">Tidak ada data pada tab ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div id="certificate-modal" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.45); z-index: 999; align-items: center; justify-content: center; padding: 20px;">
    <div style="width: min(720px, 100%); max-height: 85vh; overflow-y: auto; background: #fff; border-radius: 12px; box-shadow: 0 20px 40px rgba(15, 23, 42, 0.2); padding: 20px;">
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom: 16px;">
            <h3 style="font-size: 20px; color: #1e293b;">Daftar Sertifikat</h3>
            <button type="button" class="btn btn-danger" onclick="closeCertificateModal()">Tutup</button>
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

<script>
    function openCertificateModal(certificates) {
        const modal = document.getElementById('certificate-modal');
        const body = document.getElementById('certificate-modal-body');

        body.innerHTML = '';

        certificates.forEach((certificate, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${index + 1}</td>
                <td>${certificate.cert_name ?? '-'}</td>
                <td>
                    <a href="${certificate.cert_link}" target="_blank" rel="noopener noreferrer">
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