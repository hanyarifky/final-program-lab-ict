<x-dashboard.layout>
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
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>
</x-dashboard.layout>