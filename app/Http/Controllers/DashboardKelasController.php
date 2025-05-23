<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Jadwal;
use App\Models\Matkul;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use SweetAlert2\Laravel\Swal;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class DashboardKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("dashboard.kelas.index", [
            "title" => "Kelas",
            "kelases" => Kelas::with(['dosen', 'matkul'])->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("dashboard.kelas.create", [
            "dosens" => Dosen::all(),
            "matkuls" => Matkul::all(),
            "ruangans" => Ruangan::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            // Validasi data kelas
            'dosen_id' => 'required|exists:dosen,id',
            'matkul_id' => 'required|exists:mata_kuliah,id',
            'kelompok' => 'required|string|max:10',
            'tanggal_mulai' => 'required|date',

            // Validasi data jadwal
            'ruangan_id' => 'required|exists:ruangan,id',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        // dd($validatedData);

        $tanggalMulai = Carbon::parse($validatedData['tanggal_mulai']);
        $pertemuanCount = 16;
        $tanggalList = [];

        for ($i = 0; $i < $pertemuanCount; $i++) {
            $tanggalList[] = $tanggalMulai->copy()->addWeeks($i)->toDateString();
        }

        // Cek bentrok jadwal per tanggal
        if ($this->cekBentrok($tanggalList, $validatedData)) {
            // jika bentrok, tampilkan alert dan kembali ke form
            Swal::fire([
                'title' => 'Jadwal Bentrok',
                'icon' => 'error',
                'text' => 'Jadwal bentrok dengan jadwal lain, silakan pilih waktu atau ruangan lain.',
                'confirmButtonText' => 'Oke'
            ]);
            return back()->withInput();
        }


        try {
            DB::transaction(function () use ($validatedData, $tanggalList) {
                $kelas = Kelas::create([
                    'dosen_id' => $validatedData['dosen_id'],
                    'matkul_id' => $validatedData['matkul_id'],
                    'kelompok' => $validatedData['kelompok'],
                    'tanggal_mulai' => $validatedData['tanggal_mulai'],
                ]);

                $jadwal = Jadwal::create([
                    'kelas_id' => $kelas->id,
                    'ruangan_id' => $validatedData['ruangan_id'],
                    'jam_mulai' => $validatedData['jam_mulai'],
                    'jam_selesai' => $validatedData['jam_selesai'],
                ]);

                $this->generatePertemuan($jadwal, $tanggalList);
            });

            Swal::fire([
                'title' => 'Berhasil Tambah Data',
                'icon' => 'success',
                'confirmButtonText' => 'Oke'
            ]);

            return redirect('/dashboard/kelas');
        } catch (\Exception $e) {
            Swal::fire([
                'title' => 'Gagal Tambah Data',
                'icon' => 'error',
                'confirmButtonText' => 'Oke'
            ]);
            return back()->withInput();
        }
    }

    protected function generatePertemuan(Jadwal $jadwal, array $tanggalList)
    {
        foreach ($tanggalList as $index => $tanggal) {
            $jadwal->details()->create([
                'pertemuan' => $index + 1,
                'tanggal' => $tanggal,
                'status' => 'Mata Kuliah',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelas $kelas) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        return view("dashboard.kelas.edit", [
            "kelas" => $kelas,
            "dosens" => Dosen::all(),
            "matkuls" => Matkul::all(),
            "ruangans" => Ruangan::all(),
            "jadwal" => Jadwal::where('kelas_id', $id)->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);
        $rulesData = [
            "dosen_id" => ["required", Rule::in(Dosen::pluck('id')->toArray())],
            "matkul_id" => ["required", Rule::in(Matkul::pluck('id')->toArray())],
            "kelompok" => "required|string",
        ];

        // if ($request->kode_mata_kuliah != $matkul->kode_mata_kuliah) {
        //     $rulesData['kode_mata_kuliah'] = "required|string";
        // }

        $validateData = $request->validate($rulesData);

        try {
            Kelas::where('id', $id)->update($validateData);

            Swal::fire([
                'title' => 'Berhasil Edit Data',
                'icon' => 'success',
                'confirmButtonText' => 'Oke'
            ]);
            return redirect('/dashboard/kelas');
        } catch (\Exception $e) {
            Swal::error([
                'title' => 'Gagal Tambah Data',
                'text' => "Data sudah pernah dibuat",
                'confirmButtonText' => 'Oke'
            ]);
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        Kelas::destroy($id);

        Swal::fire([
            'title' => 'Data berhasil di hapus',
            'icon' => 'success',
            'confirmButtonText' => 'Oke'
        ]);

        return redirect('/dashboard/kelas');
    }

    public function cekBentrok($tanggalList, $validatedData)
    {
        foreach ($tanggalList as $tanggal) {
            $bentrok = Jadwal::where('ruangan_id', $validatedData['ruangan_id'])
                ->whereHas('details', function ($q) use ($tanggal) {
                    $q->where('tanggal', $tanggal);
                })
                ->where(function ($query) use ($validatedData) {
                    $query->whereBetween('jam_mulai', [$validatedData['jam_mulai'], $validatedData['jam_selesai']])
                        ->orWhereBetween('jam_selesai', [$validatedData['jam_mulai'], $validatedData['jam_selesai']])
                        ->orWhere(function ($q2) use ($validatedData) {
                            $q2->where('jam_mulai', '<=', $validatedData['jam_mulai'])
                                ->where('jam_selesai', '>=', $validatedData['jam_selesai']);
                        });
                })
                ->exists();

            if ($bentrok) {
                return true;  // bentrok ditemukan
            }
        }

        return false; // tidak bentrok
    }
}
