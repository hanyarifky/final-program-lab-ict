<x-dashboard.layout>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class=" mb-3">Tambah Data Ruangan</h4><hr>
                    <form action="/dashboard/ruangan" method="POST">
                       @csrf
                       <div class="modal-body">
                               <div class="row mb-3">
                                   <label for="example-text-input" class="col-sm col-form-label">Kode Ruangan</label>
                                   <div class="col-sm-10">
                                       <input class="form-control @error('kode_ruangan') is-invalid @enderror" value="{{ old('kode_ruangan') }}" type="text" placeholder="" name="kode_ruangan" id="example-text-input">
                                       @error('kode_ruangan')
                                           <div class="invalid-feedback">
                                               {{ $message }}
                                           </div>
                                       @enderror
                                   </div>
                               </div>
                               <div class="row mb-3">
                                   <label for="example-text-input" class="col-sm col-form-label">Nomor Ruangan</label>
                                   <div class="col-sm-10">
                                       <input class="form-control  @error('nomor_ruangan') is-invalid @enderror" type="text" value="{{ old('nomor_ruangan') }}" type="text" placeholder="" name="nomor_ruangan" id="example-text-input">
                                       @error('nomor_ruangan')
                                           <div class="invalid-feedback">
                                               {{ $message }}
                                           </div>
                                       @enderror
                                   </div>
                               </div>
                               <div class="row mb-3">
                                   <label for="example-text-input" class="col-sm col-form-label">Nama Ruangan</label>
                                   <div class="col-sm-10">
                                       <input class="form-control @error('nama_ruangan') is-invalid @enderror" type="text" value="{{ old('nama_ruangan') }}" placeholder="" name="nama_ruangan" id="example-text-input">
                                       @error('nama_ruangan')
                                       <div class="invalid-feedback">
                                           {{ $message }}
                                       </div>
                                       @enderror
                                   </div>
                               </div>
                       </div>
                       <div class="modal-footer">
                           <a href="/dashboard/ruangan" class="btn btn-secondary">Back</a>
                           <button type="submit" class="btn btn-primary">Simpan</button>
                       </div>
                   </form>
                </div>
            </div>
        </div>
    </div>
</x-dashboard.layout>