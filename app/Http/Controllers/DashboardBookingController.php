<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\BookingKp;
use Illuminate\Http\Request;
use SweetAlert2\Laravel\Swal;
use Illuminate\Support\Facades\DB;

class DashboardBookingController extends Controller
{
    public function index()
    {
        // return "berhasil";
        return view("dashboard.booking_kp.index", [
            "title" => "Booking",
            "bookings" => BookingKp::all()
        ]);
    }

    public function setujui($id)
    {
        $booking = BookingKp::findOrFail($id);

        DB::transaction(function () use ($booking) {

            $jadwal = Jadwal::create([
                'kelas_id' => $booking->kelas_id,
                'ruangan_id' => $booking->ruangan_id,
                'jam_mulai' => $booking->jam_mulai,
                'jam_selesai' => $booking->jam_selesai,

            ]);

            if ($jadwal->details() && $booking->pertemuan && $booking->tanggal) {
                $jadwal->details()->create([
                    'pertemuan' => $booking->pertemuan,
                    'tanggal' => $booking->tanggal,
                    'status' => 'KP',
                ]);
            }


            $booking->delete();
        });

        Swal::fire([
            'title' => 'Berhasil Disetujui',
            'icon' => 'success',
            'confirmButtonText' => 'Oke'
        ]);

        return redirect()->back();
    }
}
