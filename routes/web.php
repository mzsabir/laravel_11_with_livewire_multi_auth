<?php

use Illuminate\Support\Facades\Route;
use app\http\Middleware\Admin;

Route::view('/', 'welcome');

/*Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');*/

Route::view('admin', 'admin')
    ->middleware(['auth', 'verified','admin'])
    ->name('admin');

Route::view('lawyer', 'lawyer')
    ->middleware(['auth', 'verified','lawyer'])
    ->name('lawyer');

Route::view('client', 'client')
    ->middleware(['auth', 'verified','client'])
    ->name('client');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
