<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LetterController;
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

  Route::get('/messages', [DashboardController::class, 'index'])->name('messages');

  Route::get('/archives', function () {
    return view('archives.index');
  })->middleware('role:admin,lecturer')->name('archives');
});

// Route::fallback(function () {
//   return redirect()->route('dashboard');
// });
