<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudyProgramController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes(['register' => false]);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::patch('/profile', [DashboardController::class, 'updateProfile'])->name('profile.update');
    Route::patch('/profile/password', [DashboardController::class, 'updatePassword'])->name('profile.password');

    Route::resource('letters', LetterController::class);

    Route::patch('/letters/{id}/approve', [LetterController::class, 'approve'])->name('letters.approve');
    Route::patch('/letters/{id}/reject', [LetterController::class, 'reject'])->name('letters.reject');
    Route::patch('/letters/{id}/archive', [LetterController::class, 'archive'])->name('letters.archive');

    Route::get('/templates', [TemplateController::class, 'index'])->name('templates.index');
    Route::get('/letter-template', [LetterController::class, 'letterTemplate'])->name('letters.letter-template');

    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');

    Route::get('/archives', function () {
        return view('archives.index');
    })->middleware('role:admin,lecturer')->name('archives');

    Route::get('/lecturers', [LecturerController::class, 'index'])->name('lecturers');
    Route::get('/lecturers/create', [LecturerController::class, 'create'])->name('lecturers.create');
    Route::post('/lecturers', [LecturerController::class, 'store'])->name('lecturers.store');
    Route::get('/lecturers/{lecturer}/edit', [LecturerController::class, 'edit'])->name('lecturers.edit');
    Route::put('/lecturers/{lecturer}', [LecturerController::class, 'update'])->name('lecturers.update');
    Route::delete('/lecturers/{lecturer}', [LecturerController::class, 'destroy'])->name('lecturers.destroy');

    Route::get('/students', [StudentController::class, 'index'])->name('students');
    Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
    Route::post('/students', [StudentController::class, 'store'])->name('students.store');
    Route::get('/students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');
    Route::put('/students/{student}', [StudentController::class, 'update'])->name('students.update');
    Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');

    Route::get('/study-programs', [StudyProgramController::class, 'index'])->name('study_programs');

    Route::get('/classes', [ClassController::class, 'index'])->name('classes.index');
    Route::get('/classes/create', [ClassController::class, 'create'])->name('classes.create');
    Route::post('/classes', [ClassController::class, 'store'])->name('classes.store');
    Route::get('/classes/{class}/edit', [ClassController::class, 'edit'])->name('classes.edit');
    Route::put('/classes/{class}', [ClassController::class, 'update'])->name('classes.update');
    Route::delete('/classes/{class}', [ClassController::class, 'destroy'])->name('classes.destroy');
    Route::post('import-classes', [ClassController::class, 'import'])->name('classes.import');

    Route::get('/study_programs', [StudyProgramController::class, 'index'])->name('study_programs.index');
    Route::get('/study_programs/create', [StudyProgramController::class, 'create'])->name('study_programs.create');
    Route::post('/study_programs', [StudyProgramController::class, 'store'])->name('study_programs.store');
    Route::get('/study_programs/{studyProgram}/edit', [StudyProgramController::class, 'edit'])->name('study_programs.edit');
    Route::put('/study_programs/{studyProgram}', [StudyProgramController::class, 'update'])->name('study_programs.update');
    Route::delete('/study_programs/{studyProgram}', [StudyProgramController::class, 'destroy'])->name('study_programs.destroy');
    Route::post('import-study-programs', [StudyProgramController::class, 'import'])->name('study_programs.import');

    Route::get('/templates', [TemplateController::class, 'index'])->name('templates.index');
    Route::get('/templates/create', [TemplateController::class, 'create'])->name('templates.create');
    Route::post('/templates', [TemplateController::class, 'store'])->name('templates.store');
    Route::delete('/templates/{template}', [TemplateController::class, 'destroy'])->name('templates.destroy');
});

// Route::get('/reset', function () {
//     Artisan::call('migrate:refresh');
//     Artisan::call('db:seed');
//     return redirect()->back()->with('success', 'Database reset successfully.');
// })->name('reset');

// Route::fallback(function () {
//   return redirect()->route('dashboard');
// });
