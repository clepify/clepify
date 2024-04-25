<?php

use App\Http\Controllers\ClassController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudyProgramController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

  Route::resource('letters', LetterController::class);

  Route::patch('/letters/{id}/approve', [LetterController::class, 'approve'])->name('letters.approve');
  Route::patch('/letters/{id}/archive', [LetterController::class, 'archive'])->name('letters.archive');

  Route::get('/letter-template', [LetterController::class, 'letterTemplate'])->name('letters.letter-template');

  Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');

  Route::get('/archives', function () {
    return view('archives.index');
  })->middleware('role:admin,lecturer')->name('archives');

  Route::get('/lecturers', [LecturerController::class, 'index'])->name('lecturers');
  Route::get('/students', [StudentController::class, 'index'])->name('students');

  Route::get('/study-programs', [StudyProgramController::class, 'index'])->name('study_programs');


  Route::get('/classes', [ClassController::class, 'index'])->name('class');
  Route::get('/classes/create', [ClassController::class, 'create'])->name('classes.create');
  Route::post('/classes', [ClassController::class, 'store'])->name('classes.store');
  Route::get('/classes/{class}/edit', [ClassController::class, 'edit'])->name('classes.edit');
  Route::put('/classes/{class}', [ClassController::class, 'update'])->name('classes.update');
  Route::delete('/classes/{class}', [ClassController::class, 'destroy'])->name('classes.destroy');


  Route::get('/study_programs', [StudyProgramController::class, 'index'])->name('study_programs.index');
  Route::get('/study_programs/create', [StudyProgramController::class, 'create'])->name('study_programs.create');
  Route::post('/study_programs', [StudyProgramController::class, 'store'])->name('study_programs.store');
  Route::get('/study_programs/{studyProgram}/edit', [StudyProgramController::class, 'edit'])->name('study_programs.edit');
  Route::put('/study_programs/{studyProgram}', [StudyProgramController::class, 'update'])->name('study_programs.update');
  Route::delete('/study_programs/{studyProgram}', [StudyProgramController::class, 'destroy'])->name('study_programs.destroy');

});

// Route::fallback(function () {
//   return redirect()->route('dashboard');
// });
