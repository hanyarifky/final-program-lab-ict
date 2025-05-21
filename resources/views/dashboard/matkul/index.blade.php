<x-dashboard.layout :title="$title">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                     <div class="d-flex justify-content-between">
                        
                        <h1 class="card-title mb-3">Data Mata Kuliah</h1>
                        {{-- <z href="#" class="btn btn-success font-weight-bolder waves-effect waves-light mb-3">Tambah Data</z> --}}
                        <a href="/dashboard/matkul/create" class="btn btn-success font-weight-bolder waves-effect waves-light mb-3" >Tambah Data</a>

                    </div>

                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th   style="width: 10%">Kode Mata Kuliah</th>
                            <th>Nama Mata Kuliah</th>
                            <th>SKS</th>
                            <th  style="width: 10%" class="text-center">Action</th>
                        </tr>
                        </thead>


                        <tbody>
                        @foreach ($matkuls as $matkul)
                        <tr>
                            <td>{{ $matkul->kode_mata_kuliah }}</td>
                            <td>{{ $matkul->nama_mata_kuliah}}</td>
                            <td>{{ $matkul->sks }}</td>
                            <td class="text-center d-flex gap-1 justify-content-center">
                                <a class="btn btn-outline-secondary btn-sm edit" href="/dashboard/matkul/{{ $matkul->kode_mata_kuliah }}/edit" title="Edit">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <form action="/dashboard/matkul/{{ $matkul->kode_mata_kuliah }}" method="POST">
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
