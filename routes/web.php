<?php
use App\Http\Controllers\SchoolClass\EditController;
use App\Http\Controllers\SchoolClass\IndexController;
use App\Http\Controllers\SchoolClass\CreateController;
use App\Http\Controllers\SchoolClass\ShowController;
use App\Http\Controllers\SchoolClass\StoreController;
use App\Http\Controllers\SchoolClass\UpdateController;
use App\Http\Controllers\SchoolClass\DestroyController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->prefix('students')->name('students.')->group(function () {
    Route::get('/', [StudentController::class, 'index'])->name('index')->middleware('role:student,teacher');

    Route::get('/create', [StudentController::class, 'create'])->name('create')->middleware('role:teacher');

    Route::post('/store', [StudentController::class, 'store'])->name('store')->middleware('role:teacher');

    Route::get('/{student}', [StudentController::class, 'show'])->name('show')->whereNumber('id')->middleware('role:student,teacher');

    Route::get('/{student}/edit', [StudentController::class, 'edit'])->name('edit')->whereNumber('id')->middleware('role:teacher');

    Route::put('/{student}', [StudentController::class, 'update'])->name('update')->whereNumber('id')->middleware('role:teacher');

    Route::delete('/{student}', [StudentController::class, 'destroy'])->name('destroy')->whereNumber('id')->middleware('role:teacher');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginView'])->name('login-view');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login-post');

    Route::get('/register', [AuthController::class, 'registerView'])->name('register-view');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register-post');
});



Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



Route::prefix('teachers')->name('teachers.')->group(function () {
    Route::get('/', [TeacherController::class, 'index'])->name('index');

    Route::get('/create', [TeacherController::class, 'create'])->name('create');

    Route::post('/store', [TeacherController::class, 'store'])->name('store');

    Route::get('/{id}', [TeacherController::class, 'show'])->name('show')->whereNumber('id');

    Route::get('/{id}/edit', [TeacherController::class, 'edit'])->name('edit')->whereNumber('id');

    Route::put('/{id}', [TeacherController::class, 'update'])->name('update')->whereNumber('id');

    Route::delete('/{id}', [TeacherController::class, 'destroy'])->name('destroy')->whereNumber('id');
});

Route::prefix('classes')->name('classes.')->group(function () {
    Route::get('/', IndexController::class)->name('index');

    Route::get('/create', CreateController::class)->name('create');

    Route::post('/store', StoreController::class)->name('store');

    Route::get('/{id}', ShowController::class)->name('show')->whereNumber('id');

    Route::get('/{id}/edit', EditController::class)->name('edit')->whereNumber('id');

    Route::put('/{id}', UpdateController::class)->name('update')->whereNumber('id');

    Route::delete('/{id}', DestroyController::class)->name('destroy')->whereNumber('id');
});

Route::resource('majors', MajorController::class);
