<?php

namespace App\Http\Controllers;

use App\Http\Requests\Student\UpdateRequest;
use App\Models\Student;
use App\Http\Requests\Student\StoreRequest;
use Illuminate\Auth\Events\Validated;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $title = "Sistem Sekolah - Daftar Siswa";

        $students = Student::select('id', 'nis', 'name', 'major', 'class')->get();

        return view('students.index', [
            'title' => $title,
            'students' => $students
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