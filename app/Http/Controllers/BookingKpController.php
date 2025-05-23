<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Jadwal;
use App\Models\Ruangan;
use App\Models\BookingKp;
use Illuminate\Http\Request;
use SweetAlert2\Laravel\Swal;
use Illuminate\Support\Facades\DB;

class BookingKpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create-booking', [
            "ruangans" => Ruangan::all(),
            "kelases" => Kelas::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'ruangan_id' => 'required|exists:ruangan,id',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'pertemuan' => 'required|integer|min:1',
            'tanggal' => 'required|date',
            // hapus validasi status karena sudah pasti "KP"
        ]);

        // Cek bentrok jadwal
        $bentrok = Jadwal::whereHas('details', function ($q) use ($validated) {
            $q->where('tanggal', $validated['tanggal']);
        })
            ->where('ruangan_id', $validated['ruangan_id'])
            ->where(function ($query) use ($validated) {
                $query->whereBetween('jam_mulai', [$validated['jam_mulai'], $validated['jam_selesai']])
                    ->orWhereBetween('jam_selesai', [$validated['jam_mulai'], $validated['jam_selesai']])
                    ->orWhere(function ($q2) use ($validated) {
                        $q2->where('jam_mulai', '<=', $validated['jam_mulai'])
                            ->where('jam_selesai', '>=', $validated['jam_selesai']);
                    });
            })
            ->exists();

        if ($bentrok) {
            Swal::fire([
                'title' => 'Jadwal Bentrok',
                'icon' => 'error',
                'text' => "Jadwal bentrok pada tanggal {$validated['tanggal']}, silakan pilih waktu atau ruangan lain.",
                'confirmButtonText' => 'Oke'
            ]);
            return back()->withInput();
        }

        // Tambahkan status 'KP' manual sebelum simpan
        $validated['status'] = 'KP';

        BookingKp::create($validated);

        Swal::fire([
            'title' => 'Berhasil Tambah Booking KP',
            'icon' => 'success',
            'confirmButtonText' => 'Oke'
        ]);

        return redirect('/')->with('success', 'Data booking KP berhasil disimpan!');
    }


    /**
     * Display the specified resource.
     */
    public function show(BookingKp $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BookingKp $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BookingKp $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BookingKp $booking)
    {
        //
    }
}
