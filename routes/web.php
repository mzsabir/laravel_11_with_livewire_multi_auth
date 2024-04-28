<?php

use App\Http\Controllers\CaseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HearingController;
use Illuminate\Support\Facades\Route;

//Route::view('/', 'welcome');
Route::get('/',[HomeController::class, 'home'])->name('home');
Route::view('practice-areas','practice-areas')->name('practice-areas');
Route::view('case-studies','case-studies')->name('case-studies');

Route::get('appointment/{id}',[HomeController::class, 'appointment']);
Route::get('/close/{id}', [HomeController::class, 'close_case'])->name('case.close');
Route::post('/rate', [HomeController::class, 'rate_case'])->name('case.rate');
Route::post('/book', [HomeController::class, 'book_appointment'])->name('appointment.book');
Route::resource('/case', CaseController::class);
Route::resource('/hearing', HearingController::class);
Route::view('dashboard', 'dashboard')->middleware(['auth', 'verified', 'admin'])->name('dashboard');
Route::get('admin',[HomeController::class, 'admin_dashboard'])->middleware(['auth', 'verified', 'admin'])->name('admin');
Route::get('lawyer',[HomeController::class, 'lawyer_dashboard'])->middleware(['auth', 'verified', 'lawyer'])->name('lawyer');
Route::get('client',[HomeController::class, 'client_dashboard'])->middleware(['auth', 'verified', 'client'])->name('client');
Route::view('profile', 'profile')->middleware(['auth'])->name('profile');

require __DIR__ . '/auth.php';
