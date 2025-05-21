<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;
use SweetAlert2\Laravel\Swal;

class DashboardRuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view(
            "dashboard.ruangan.index",
            [
                'title' => "Ruangan",
                "ruangans" => Ruangan::all()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.ruangan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            "kode_ruangan" => "required|string",
            "nomor_ruangan" => "required|string",
            "nama_ruangan" => "required|string",
        ]);

        try {
            Ruangan::create($validateData);

            Swal::fire([
                'title' => 'Berhasil Tambah Data',
                'icon' => 'success',
                'confirmButtonText' => 'Oke'
            ]);
            return redirect('/dashboard/ruangan');
        } catch (\Exception $e) {
            return $e;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Ruangan $ruangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ruangan $ruangan)
    {
        return view(
            "dashboard.ruangan.edit",
            [
                "ruangan" => $ruangan
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ruangan $ruangan)
    {
        $rulesData = [
            "nomor_ruangan" => "required|string",
            "nama_ruangan" => "required|string",
        ];

        if ($request->kode_ruangan != $ruangan->kode_ruangan) {
            $rulesData['kode_ruangan'] = "required|string";
        }

        $validateData = $request->validate($rulesData);

        try {
            Ruangan::where('id', $ruangan->id)->update($validateData);

            Swal::fire([
                'title' => 'Berhasil Edit Data',
                'icon' => 'success',
                'confirmButtonText' => 'Oke'
            ]);
            return redirect('/dashboard/ruangan');
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
    public function destroy(Ruangan $ruangan)
    {
        Ruangan::destroy($ruangan->id);

        Swal::fire([
            'title' => 'Berhasil di hapus',
            'icon' => 'success',
            'confirmButtonText' => 'Oke'
        ]);

        return redirect("/dashboard/ruangan");
    }
}
