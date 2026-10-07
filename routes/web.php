<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing_page');
})->name('home');

Route::get('/dashboard_siswa', function () {
    return view('Siswa.page.dashboard_siswa');
})->name('dashboard_siswa');

Route::get('/dashboard-siswa', function () {
    return redirect()->route('dashboard_siswa');
})->name('dashboard.siswa');

Route::get('/dashboard', function () {
    return redirect()->route('dashboard_siswa');
})->name('dashboard');
