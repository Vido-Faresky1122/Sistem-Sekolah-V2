<?php

namespace App\Http\Controllers;

use App\Http\Requests\Student\UpdateRequest;
use App\Models\Major;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Http\Requests\Student\StoreRequest;
use Illuminate\Auth\Events\Validated;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $title = "Sistem Sekolah - Daftar Siswa";

        $search = $request->query('search');
        $class = $request->query('class');
        $major = $request->query('major');
        $students = Student::with(['schoolClass', 'major'])->select('id', 'nis', 'name', 'class_id', 'major_id')
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('nis', 'like', "%{$search}%");
                });
            })
            ->when($class, fn($query, $class) => $query->where('class_id', '=', $class))
            ->when($major, fn($query, $major) => $query->where('major_id', '=', $major))
            ->paginate(10)
            ->withQueryString();

        $schoolClasses = SchoolClass::get(['id', 'name']);

        $majors = Major::get(['id', 'name']);

        return view('students.index', [
            'title' => $title,
            'students' => $students,
            'schoolClasses' => $schoolClasses,
            'majors' => $majors,
        ]);
    }

    public function create()
    {
        $title = "Sistem Sekolah - Tambah Siswa";

        return view('students.create', [
            'title' => $title
        ]);
    }

    public function store(StoreRequest $request)
    {
        Student::create($request->validated());

        return redirect()->route('students.index');
    }

    public function show(Student $student)
    {
        $title = "Sistem Sekolah - Detail Siswa";


        return view('students.show', [
            'title' => $title,
            'student' => $student
        ]);
    }

    public function edit(Student $student)
    {
        $title = "Sistem Sekolah - Edit Siswa";

        return view('students.edit', [
            'title' => $title,
            'student' => $student
        ]);

    }

    public function update(Student $student, UpdateRequest $request)
    {
        $student->update($request->validated());

        return redirect()->route('students.index');
    }

    public function destroy(Student $student, Request $request)
    {
        $student->delete();

        return redirect()->route('students.index');
    }
}