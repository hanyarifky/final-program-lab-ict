<x-dashboard.layout :title="$title">
    {{-- {{ dd($detail_jadwal) }} --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                     <div class="d-flex justify-content-between">
                        
                        <h1 class="card-title mb-3">Detail Jadwal Lab</h1>
                        {{-- <z href="#" class="btn btn-success font-weight-bolder waves-effect waves-light mb-3">Tambah Data</z> --}}
                        {{-- <a href="/dashboard/jadwal/create" class="btn btn-success font-weight-bolder waves-effect waves-light mb-3" >Tambah Data</a> --}}

                    </div>

                    <table id="datatable-buttons" class="pb-5 table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Mata Kuliah</th>
                            <th>Pertemuan</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            {{-- <th  style="width: 10%" class="text-center">Action</th> --}}
                        </tr>
                        </thead>


                        <tbody>
                        @foreach ($detail_jadwal as $detail)
                        <tr>
                            <td>{{ $detail->jadwal->kelas->matkul->nama_mata_kuliah}}</td>
                            <td>{{ $detail->pertemuan}}</td>
                            <td>{{ $detail->tanggal}}</td>
                            <td>{{ $detail->status}}</td>
                            {{-- <td class="text-center d-flex gap-1 justify-content-center">
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
                            </td> --}}
                        </tr>
                        @endforeach
                       
                        </tbody>
                    </table>
                            <a href="/dashboard/jadwal" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</x-dashboard.layout>
