<?php

use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Jadwal;
use App\Models\Matkul;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MatkulController;
use App\Http\Controllers\BookingKpController;
use App\Http\Controllers\DashboardBookingController;
use App\Http\Controllers\DashboardDosenController;
use App\Http\Controllers\DashboardKelasController;
use App\Http\Controllers\DashboardJadwalController;
use App\Http\Controllers\DashboardMatkulController;
use App\Http\Controllers\DashboardRuanganController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function (Request $request) {
    $tanggal = $request->input('tanggal', Carbon::today('Asia/Jakarta')->toDateString());
    // dd($tanggal);

    $jadwals = Jadwal::whereHas('details', function ($query) use ($tanggal) {
        $query->where('tanggal', $tanggal);
    })
        ->with([
            'kelas.matkul',       // relasi kelas dan matkul
            'kelas.dosen',        // relasi kelas dan dosen
            'kelas',              // relasi kelas
            'ruangan',            // relasi ruangan
            'details' => function ($query) use ($tanggal) { // hanya details dengan tanggal itu
                $query->where('tanggal', $tanggal);
            }
        ])
        ->get();

    // Kirim data ke view 'welcome' dengan variabel jadwals dan tanggal
    return view('welcome', compact('jadwals', 'tanggal'));
});

Route::resource('/booking-kp', BookingKpController::class);

Route::get('dashboard/booking-kp', [DashboardBookingController::class, 'index']);
Route::post('dashboard/booking-kp/{id}/setujui', [DashboardBookingController::class, 'setujui'])->name('booking-kp.setujui');;

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
Route::resource('/dashboard/matkul', DashboardMatkulController::class)->middleware('auth');;

// Dashboard Jadwal
Route::get('/dashboard/jadwal', function () {
    return view('dashboard.jadwal.index');
})->middleware('auth');;

// Dashboard Dosen
Route::resource('/dashboard/dosen', DashboardDosenController::class)->middleware('auth');;

// Dashboard Ruangan
Route::resource('/dashboard/ruangan', DashboardRuanganController::class)->middleware('auth');;

// Dashboard Kelas
Route::resource('/dashboard/kelas', DashboardKelasController::class)->middleware('auth');;

// Dashboard Jadwal
Route::resource('/dashboard/jadwal', DashboardJadwalController::class)->middleware('auth');;
