<x-dashboard.layout :title="$title">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex justify-content-between">
                        
                        <h1 class="card-title mb-3">Data Dosen</h1>
                        {{-- <z href="#" class="btn btn-success font-weight-bolder waves-effect waves-light mb-3">Tambah Data</z> --}}
                        <a href="/dashboard/dosen/create" class="btn btn-success font-weight-bolder waves-effect waves-light mb-3" >Tambah Data</a>

                    </div>
                        <!-- Small modal -->

                    <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Data Dosen</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="/dashboard/dosen" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm col-form-label">NIP</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" placeholder="" name="nip" id="example-text-input">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm col-form-label">Nama</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" placeholder="" name="nama" id="example-text-input">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm col-form-label">E-mail</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="email" placeholder="" name="email" id="example-text-input">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">No Telepon</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" placeholder="" name="no_telepon" id="example-text-input">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm col-form-label">Fakultas</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" placeholder="" name="fakultas" id="example-text-input">
                                                </div>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                                </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->                                        
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>E-mail</th>
                            <th>No. Telepon</th>
                            <th>Fakultas</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>


                        <tbody>
                        @foreach ($dosens as $dosen)
                        <tr>
                            <td>{{ $dosen->nip }}</td>
                            <td>{{ $dosen->nama }}</td>
                            <td>{{ $dosen->email }}</td>
                            <td>{{ $dosen->no_telepon }}</td>
                            <td>{{ $dosen->fakultas }}</td>
                            <td class="text-center d-flex gap-1 justify-content-center">
                                <a class="btn btn-outline-secondary btn-sm edit" href="/dashboard/dosen/{{ $dosen->nip }}/edit" title="Edit">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <form action="/dashboard/dosen/{{ $dosen->nip }}" method="POST">
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
