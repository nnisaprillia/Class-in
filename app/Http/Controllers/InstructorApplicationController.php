<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\InstructorApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class InstructorApplicationController extends Controller
{
    private const STATUSES = ['Submitted', 'Review', 'Interview', 'Declined', 'Accepted'];

    public function store(Request $request): RedirectResponse
    {
        $user = $request->user();

        if (!$user || $user->role !== 'instructor') {
            return redirect()->route('login');
        }

        if ($user->instructor_verified) {
            return redirect()->route('instructor.dashboard')
                ->withErrors('Akun Anda sudah terverifikasi sebagai instruktur.');
        }

        if (InstructorApplication::where('user_id', $user->id)->exists()) {
            return redirect()->route('instructor.dashboard')
                ->withErrors('Pengajuan sudah pernah dikirim. Silakan tunggu proses validasi admin.');
        }

        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:25'],
            'gmail' => ['required', 'email', 'max:255'],
            'address' => ['required', 'string', 'max:2000'],
            'cv_link' => ['required', 'url', 'regex:/drive\.google\.com/i'],
            'certificates' => ['required', 'array', 'min:1'],
            'certificates.*.cert_name' => ['required', 'string', 'max:255'],
            'certificates.*.cert_link' => ['required', 'url', 'regex:/drive\.google\.com/i'],
        ], [
            'cv_link.regex' => 'Link CV harus berupa link Google Drive.',
            'certificates.*.cert_link.regex' => 'Semua link sertifikat harus berupa link Google Drive.',
        ]);

        $application = InstructorApplication::updateOrCreate(
            ['user_id' => $user->id],
            [
                'full_name' => $validated['full_name'],
                'phone_number' => $validated['phone_number'],
                'gmail' => $validated['gmail'],
                'address' => $validated['address'],
                'status' => 'Submitted',
            ]
        );

        $user->update([
            'link_cv' => $validated['cv_link'],
        ]);

        Certificate::where('id_user', $user->id)->delete();
        foreach ($validated['certificates'] as $certificate) {
            Certificate::create([
                'id_user' => $user->id,
                'cert_name' => $certificate['cert_name'],
                'cert_link' => $certificate['cert_link'],
            ]);
        }

        return redirect()->route('instructor.dashboard')
            ->with('application_success', "Pengajuan instruktur berhasil dikirim dengan status {$application->status}.");
    }

    public function index(): View
    {
        $applications = InstructorApplication::with(['user.certificates'])
            ->latest()
            ->get();

        return view('pages.admin.instructors', [
            'applications' => $applications,
            'statuses' => self::STATUSES,
        ]);
    }

    public function updateStatus(Request $request, InstructorApplication $application): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(self::STATUSES)],
        ]);

        $application->update([
            'status' => $validated['status'],
        ]);

        if ($validated['status'] === 'Accepted') {
            $application->user()->update([
                'role' => 'instructor',
                'instructor_verified' => true,
            ]);
        } else {
            $application->user()->update(['instructor_verified' => false]);
        }

        return redirect()->route('admin.instructors')
            ->with('status_success', 'Status pengajuan instruktur berhasil diperbarui.');
    }
}