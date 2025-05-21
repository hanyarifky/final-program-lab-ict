<x-dashboard.layout>
     <form action="/dashboard/ruangan/{{ $ruangan->kode_ruangan }}" method="POST">
        @method("put")
        @csrf
        <div class="modal-body">
                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm col-form-label">Kode Ruangan</label>
                    <div class="col-sm-10">
                        <input value="{{ old('kode_ruangan', $ruangan->kode_ruangan) }}" class="form-control @error('kode_ruangan') is-invalid @enderror" type="text" placeholder="" name="kode_ruangan" id="example-text-input">
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
                        <input value="{{ old('nomor_ruangan', $ruangan->nomor_ruangan) }}" class="form-control @error('nomor_ruangan') is-invalid @enderror" placeholder="" name="nomor_ruangan" id="example-text-input">
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
                        <input value="{{ old('nama_ruangan', $ruangan->nama_ruangan) }}" class="form-control @error('nama_ruangan') is-invalid @enderror" placeholder="" name="nama_ruangan" id="example-text-input">
                        @error('nama_ruangan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
        </div>
        <div class="modal-footer">
            <a href="/dashboard/ruangan" class="btn btn-secondary" data-bs-dismiss="modal">Back</a>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>
</x-dashboard.layout>