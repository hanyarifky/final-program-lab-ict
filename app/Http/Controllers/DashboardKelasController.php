<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Matkul;
use Illuminate\Http\Request;
use SweetAlert2\Laravel\Swal;
use Illuminate\Validation\Rule;

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
            "matkuls" => Matkul::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validateDosens = Dosen::pluck('id')->toArray();
        $validateMatkuls = Matkul::pluck('id')->toArray();

        $validateData = $request->validate([
            "dosen_id" => ["required", Rule::in($validateDosens)],
            "matkul_id" => ["required", Rule::in($validateMatkuls)],
            "kelompok" => "required|string",
        ]);

        try {
            Kelas::create($validateData);

            Swal::fire([
                'title' => 'Berhasil Tambah Data',
                'icon' => 'success',
                'confirmButtonText' => 'Oke'
            ]);
            return redirect('/dashboard/matkul');
        } catch (\Exception $e) {
            echo $e;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        return view("dashboard.kelas.edit", [
            "kelas" => $kelas,
            "dosens" => Dosen::all(),
            "matkuls" => Matkul::all()
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
}
