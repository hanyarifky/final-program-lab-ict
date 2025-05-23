<x-dashboard.layout :title="$title">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                     <div class="d-flex justify-content-between mb-3">
                        
                        <h1 class="card-title mb-3">Jadwal Lab</h1>
                        {{-- <z href="#" class="btn btn-success font-weight-bolder waves-effect waves-light mb-3">Tambah Data</z> --}}
                        <div class="dropdown">
                            <a class="btn btn-success dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Tambah Data
                            </a>

                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="jadwal/create">Tambah Data Kelas</a></li>
                                <li><a class="dropdown-item" href="jadwal/createAcara">Tambah Data Acara</a></li>
                            </ul>
                        </div>

                    </div>

                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Mata Kuliah</th>
                            <th>Waktu</th>
                            <th>Kelompok</th>
                            <th>Ruang</th>
                            <th>Nama Dosen</th>
                            <th  style="width: 10%" class="text-center">Action</th>
                        </tr>
                        </thead>


                        <tbody>
                        @foreach ($jadwals as $jadwal)
                        <tr>
                            <td>
                                @if($jadwal->details->contains('status', 'KP')) 
                                KP 
                                @endif
                                {{ $jadwal->kelas->matkul->nama_mata_kuliah }}
                            </td>
                            <td>{{ $jadwal->jam_mulai}} - {{ $jadwal->jam_selesai }}</td>
                            <td>{{ $jadwal->kelas->kelompok}}</td>
                            <td>{{ $jadwal->ruangan->nomor_ruangan }}</td>
                            <td>{{ $jadwal->kelas->dosen->nama }}</td>
                            <td class="text-center d-flex gap-1 justify-content-center">
                                <a class="btn btn-outline-secondary btn-sm edit" href="/dashboard/jadwal/{{ $jadwal->id }}/" title="Edit">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a class="btn btn-outline-secondary btn-sm edit" href="/dashboard/jadwal/{{ $jadwal->id }}/edit" title="Edit">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <form action="/dashboard/jadwal/{{ $jadwal->id }}" method="POST">
                                    @method("delete")
                                    @csrf
                                    <button onclick="return confirm('Are you sure want to delete this?')" class="btn btn-outline-secondary btn-sm delete" title="Edit">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                       
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</x-dashboard.layout>
