<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Exception;
use Illuminate\Http\Request;
use SweetAlert2\Laravel\Swal;

class DashboardDosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.dosen.index', [
            'title' => "Dosen",
            'dosens' => Dosen::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.dosen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            "nip" => "required|string|size:10",
            "nama" => "required|string",
            "email" => "required|email",
            "no_telepon" => "required|max:12",
            "fakultas" => "required"
        ]);

        try {
            Dosen::create($validateData);

            Swal::fire([
                'title' => 'Berhasil Tambah Data',
                'icon' => 'success',
                'confirmButtonText' => 'Oke'
            ]);
            return redirect('/dashboard/dosen');
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
    public function show(Dosen $dosen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dosen $dosen)
    {
        return view('dashboard.dosen.edit', [
            "dosen" => $dosen
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dosen $dosen)
    {
        $rulesData = [
            "nama" => "required|string",
            "email" => "required|email",
            "no_telepon" => "required|max:12",
            "fakultas" => "required"
        ];

        if ($request->nip != $dosen->nip) {
            $rulesData['nip'] = "required|string|size:10";
        }

        $validateData = $request->validate($rulesData);

        try {
            Dosen::where('id', $dosen->id)->update($validateData);

            Swal::fire([
                'title' => 'Berhasil Edit Data',
                'icon' => 'success',
                'confirmButtonText' => 'Oke'
            ]);
            return redirect('/dashboard/dosen');
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
    public function destroy(Dosen $dosen)
    {
        Dosen::destroy($dosen->id);

        Swal::fire([
            'title' => 'Data berhasil di hapus',
            'icon' => 'success',
            'confirmButtonText' => 'Oke'
        ]);

        return redirect('/dashboard/dosen');
    }
}
