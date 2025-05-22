<?php

use App\Models\Dosen;
use App\Models\Matkul;
use App\Models\Ruangan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MatkulController;
use App\Http\Controllers\DashboardDosenController;
use App\Http\Controllers\DashboardKelasController;
use App\Http\Controllers\DashboardJadwalController;
use App\Http\Controllers\DashboardMatkulController;
use App\Http\Controllers\DashboardRuanganController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    // return redirect('/dashboard');
    return view('welcome');
});

// Fitur Login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

// Fitur Dashboard
Route::get('/dashboard', function () {
    return view('dashboard.index', [
        "totalDosen" => Dosen::count(),
        "totalMatkul" => Matkul::count(),
        "totalRuangan" => Ruangan::count()
    ]);
})->middleware('auth');

// Dashboard Matkul
Route::resource('/dashboard/matkul', DashboardMatkulController::class);

// Dashboard Jadwal
Route::get('/dashboard/jadwal', function () {
    return view('dashboard.jadwal.index');
});

// Dashboard Dosen
Route::resource('/dashboard/dosen', DashboardDosenController::class);

// Dashboard Ruangan
Route::resource('/dashboard/ruangan', DashboardRuanganController::class);

// Dashboard Kelas
Route::resource('/dashboard/kelas', DashboardKelasController::class);

// Dashboard Jadwal
Route::resource('/dashboard/jadwal', DashboardJadwalController::class);
