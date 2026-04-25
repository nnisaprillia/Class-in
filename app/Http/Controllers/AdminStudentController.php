<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdminStudentController extends Controller
{
    public function index(): View
    {
        $students = User::query()
            ->where('role', 'student')
            ->with('certificates')
            ->latest()
            ->get();

        return view('pages.admin.students', [
            'students' => $students,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'link_cv' => ['nullable', 'url'],
            'certificates' => ['nullable', 'array'],
            'certificates.*.cert_name' => ['required_with:certificates.*.cert_link', 'nullable', 'string', 'max:255'],
            'certificates.*.cert_link' => ['required_with:certificates.*.cert_name', 'nullable', 'url'],
        ]);

        $student = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'student',
            'link_cv' => $validated['link_cv'] ?? null,
        ]);

        $this->syncCertificates($student, $validated['certificates'] ?? []);

        return redirect()->route('admin.students')
            ->with('student_success', 'Peserta berhasil ditambahkan.');
    }

    public function update(Request $request, User $student): RedirectResponse
    {
        if ($student->role !== 'student') {
            return redirect()->route('admin.students')->withErrors('User yang dipilih bukan peserta.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($student->id)],
            'password' => ['nullable', 'string', 'min:8'],
            'link_cv' => ['nullable', 'url'],
            'certificates' => ['nullable', 'array'],
            'certificates.*.cert_name' => ['required_with:certificates.*.cert_link', 'nullable', 'string', 'max:255'],
            'certificates.*.cert_link' => ['required_with:certificates.*.cert_name', 'nullable', 'url'],
        ]);

        $student->name = $validated['name'];
        $student->email = $validated['email'];
        $student->link_cv = $validated['link_cv'] ?? null;

        if (!empty($validated['password'])) {
            $student->password = Hash::make($validated['password']);
        }

        $student->save();
        $this->syncCertificates($student, $validated['certificates'] ?? []);

        return redirect()->route('admin.students')
            ->with('student_success', 'Data peserta berhasil diperbarui.');
    }

    public function destroy(User $student): RedirectResponse
    {
        if ($student->role !== 'student') {
            return redirect()->route('admin.students')->withErrors('User yang dipilih bukan peserta.');
        }

        $student->delete();

        return redirect()->route('admin.students')
            ->with('student_success', 'Data peserta berhasil dihapus.');
    }

    private function syncCertificates(User $student, array $certificates): void
    {
        Certificate::where('id_user', $student->id)->delete();

        foreach ($certificates as $certificate) {
            $name = trim($certificate['cert_name'] ?? '');
            $link = trim($certificate['cert_link'] ?? '');

            if ($name === '' && $link === '') {
                continue;
            }

            Certificate::create([
                'id_user' => $student->id,
                'cert_name' => $name,
                'cert_link' => $link,
            ]);
        }
    }
}