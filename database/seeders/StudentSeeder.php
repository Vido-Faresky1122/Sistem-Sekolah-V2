<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = [
            ['nis' => '1001', 'name' => 'John Doe', 'gender' => 'Laki-laki', 'major' => 'TKJ', 'class' => 'X TKJ 1'],
            ['nis' => '1002', 'name' => 'Jane Smith', 'gender' => 'Perempuan', 'major' => 'AKL', 'class' => 'X AKL 1'],
            ['nis' => '1003', 'name' => 'Michael Johnson', 'gender' => 'Laki-laki', 'major' => 'BiD', 'class' => 'X BiD 1'],
            ['nis' => '1004', 'name' => 'Emily Brown', 'gender' => 'Perempuan', 'major' => 'TKJ', 'class' => 'X TKJ 2'],
            ['nis' => '1005', 'name' => 'William Davis', 'gender' => 'Laki-laki', 'major' => 'AKL', 'class' => 'X AKL 2'],
        ];

        Student::upsert($students, ['nis'], ['name', 'major', 'class']);
    }
}
