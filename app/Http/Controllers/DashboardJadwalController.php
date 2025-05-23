<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Jadwal;
use App\Models\Ruangan;
use App\Models\JadwalDetail;
use Illuminate\Http\Request;
use SweetAlert2\Laravel\Swal;
use Illuminate\Support\Facades\DB;

class DashboardJadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("dashboard.jadwal.index", [
            "title" => "Jadwal",
            "jadwals" => Jadwal::with(['ruangan', 'kelas.matkul', 'kelas.dosen'])->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return "hello";
        return view("dashboard.jadwal.create", [
            "title" => "Jadwal",
            "kelases" => Kelas::all(),
            "ruangans" => Ruangan::all()
        ]);
    }

    public function createAcara()
    {
        // return "hel  lo";
        return view('dashboard.jadwal.createAcara', [
            "title" => "Jadwal",
            "kelases" => Kelas::all(),
            "ruangans" => Ruangan::all()
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
            // 'hari' => 'required|in:senin,selasa,rabu,kamis,jumat',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'details' => 'required|array|min:1',
            'details.*.pertemuan' => 'required|integer|min:1',
            'details.*.tanggal' => 'required|date',
            'details.*.status' => 'required|string|max:255',
        ]);

        foreach ($validated['details'] as $detail) {
            $tanggal = $detail['tanggal'];

            $bentrok = Jadwal::whereHas('details', function ($q) use ($tanggal) {
                $q->where('tanggal', $tanggal);
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
                    'text' => "Jadwal bentrok pada tanggal $tanggal, silakan pilih waktu atau ruangan lain.",
                    'confirmButtonText' => 'Oke'
                ]);
                return back()->withInput();
            }
        }

        DB::transaction(function () use ($validated) {
            $jadwal = Jadwal::create([
                'kelas_id' => $validated['kelas_id'],
                'ruangan_id' => $validated['ruangan_id'],
                // 'hari' => $validated['hari'],
                'jam_mulai' => $validated['jam_mulai'],
                'jam_selesai' => $validated['jam_selesai'],
            ]);

            foreach ($validated['details'] as $detail) {
                $jadwal->details()->create([
                    'pertemuan' => $detail['pertemuan'],
                    'tanggal' => $detail['tanggal'],
                    'status' => $detail['status'],
                ]);
            }
        });

        Swal::fire([
            'title' => 'Berhasil Tambah Data',
            'icon' => 'success',
            'confirmButtonText' => 'Oke'
        ]);

        return redirect('/dashboard/jadwal')->with('success', 'Data jadwal berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jadwal $jadwal)
    {
        // dd(JadwalDetail::where('jadwal_id', $jadwal->id)->get());
        return view(
            'dashboard.jadwal.show',
            [
                "title" => "Detail Jadwal",
                'detail_jadwal' => JadwalDetail::where('jadwal_id', $jadwal->id)->get()
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jadwal $jadwal)
    {
        return view('dashboard.jadwal.edit', [
            "title" => "Jadwal",
            "jadwal" => $jadwal,
            "kelases" => Kelas::all(),
            "ruangans" => Ruangan::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'ruangan_id' => 'required|exists:ruangan,id',
            // 'hari' => 'required|in:senin,selasa,rabu,kamis,jumat',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'details' => 'required|array|min:1',
            'details.*.pertemuan' => 'required|integer|min:1',
            'details.*.tanggal' => 'required|date',
            'details.*.status' => 'required|string|max:255',
        ]);

        // Validasi unik tanggal di details
        $tanggalList = array_column($validated['details'], 'tanggal');
        if (count($tanggalList) !== count(array_unique($tanggalList))) {
            Swal::fire([
                'title' => 'Error Validasi',
                'icon' => 'error',
                'text' => 'Tanggal di detail tidak boleh ada yang sama, silakan periksa kembali.',
                'confirmButtonText' => 'Oke'
            ]);
            return back()->withInput();
        }

        // Validasi unik pertemuan di details
        $pertemuanList = array_column($validated['details'], 'pertemuan');
        if (count($pertemuanList) !== count(array_unique($pertemuanList))) {
            Swal::fire([
                'title' => 'Error Validasi',
                'icon' => 'error',
                'text' => 'Pertemuan di detail tidak boleh ada yang sama, silakan periksa kembali.',
                'confirmButtonText' => 'Oke'
            ]);
            return back()->withInput();
        }

        // Cek bentrok jadwal per detail
        foreach ($validated['details'] as $detail) {
            $tanggal = $detail['tanggal'];

            $bentrok = Jadwal::whereHas('details', function ($q) use ($tanggal) {
                $q->where('tanggal', $tanggal);
            })
                ->where('ruangan_id', $validated['ruangan_id'])
                ->where('id', '<>', $id)
                ->where(function ($query) use ($validated) {
                    $query->where('jam_mulai', '<', $validated['jam_selesai'])
                        ->where('jam_selesai', '>', $validated['jam_mulai']);
                })
                ->exists();

            if ($bentrok) {
                Swal::fire([
                    'title' => 'Jadwal Bentrok',
                    'icon' => 'error',
                    'text' => "Jadwal bentrok pada tanggal $tanggal, silakan pilih waktu atau ruangan lain.",
                    'confirmButtonText' => 'Oke'
                ]);
                return back()->withInput();
            }
        }

        try {
            DB::transaction(function () use ($validated, $id) {
                $jadwal = Jadwal::findOrFail($id);

                $jadwal->update([
                    'kelas_id' => $validated['kelas_id'],
                    'ruangan_id' => $validated['ruangan_id'],
                    // 'hari' => $validated['hari'],
                    'jam_mulai' => $validated['jam_mulai'],
                    'jam_selesai' => $validated['jam_selesai'],
                ]);

                $jadwal->details()->delete();

                foreach ($validated['details'] as $detail) {
                    $jadwal->details()->create([
                        'pertemuan' => $detail['pertemuan'],
                        'tanggal' => $detail['tanggal'],
                        'status' => $detail['status'],
                    ]);
                }
            });

            Swal::fire([
                'title' => 'Berhasil Update Data',
                'icon' => 'success',
                'confirmButtonText' => 'Oke'
            ]);
            return redirect('/dashboard/jadwal')->with('success', 'Data jadwal berhasil diperbarui!');
        } catch (\Exception $e) {
            Swal::fire([
                'title' => 'Gagal Update Data',
                'icon' => 'error',
                'confirmButtonText' => 'Oke'
            ]);
            return back()->withInput();
        }
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jadwal $jadwal)
    {
        //

        Jadwal::destroy($jadwal->id);

        Swal::fire([
            'title' => 'Data berhasil di hapus',
            'icon' => 'success',
            'confirmButtonText' => 'Oke'
        ]);

        return redirect('/dashboard/jadwal');
    }
}
