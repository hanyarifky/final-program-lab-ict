<?php

namespace App\Http\Controllers;

use App\Models\Matkul;
use Illuminate\Http\Request;
use SweetAlert2\Laravel\Swal;

class DashboardMatkulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view(
            'dashboard.matkul.index',
            [
                "title" => "Matkul",
                "matkuls" => Matkul::all()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.matkul.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            "kode_mata_kuliah" => "required|string",
            "nama_mata_kuliah" => "required|string",
            "sks" => "required|integer",
        ]);

        try {
            Matkul::create($validateData);

            Swal::fire([
                'title' => 'Berhasil Tambah Data',
                'icon' => 'success',
                'confirmButtonText' => 'Oke'
            ]);
            return redirect('/dashboard/matkul');
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
     * Display the specified resource.
     */
    public function show(Matkul $matkul)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Matkul $matkul)
    {
        return view(
            'dashboard.matkul.edit',
            [
                "matkul" => $matkul
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Matkul $matkul)
    {

        $rulesData = [
            "nama_mata_kuliah" => "required|string",
            "sks" => "required|integer",
        ];

        if ($request->kode_mata_kuliah != $matkul->kode_mata_kuliah) {
            $rulesData['kode_mata_kuliah'] = "required|string";
        }

        $validateData = $request->validate($rulesData);

        try {
            Matkul::where('id', $matkul->id)->update($validateData);

            Swal::fire([
                'title' => 'Berhasil Edit Data',
                'icon' => 'success',
                'confirmButtonText' => 'Oke'
            ]);
            return redirect('/dashboard/matkul');
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
    public function destroy(Matkul $matkul)
    {
        Matkul::destroy($matkul->id);

        Swal::fire([
            'title' => 'Data berhasil di hapus',
            'icon' => 'success',
            'confirmButtonText' => 'Oke'
        ]);

        return redirect('/dashboard/matkul');
    }
}
