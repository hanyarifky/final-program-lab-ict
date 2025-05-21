<x-dashboard.layout>
     <form action="/dashboard/matkul/{{ $matkul->kode_mata_kuliah }}" method="POST">
        @method("put")
        @csrf
        <div class="modal-body">
                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm col-form-label">Kode Mata Kuliah</label>
                    <div class="col-sm-10">
                        <input value="{{ old('kode_mata_kuliah', $matkul->kode_mata_kuliah) }}" class="form-control @error('kode_mata_kuliah') is-invalid @enderror" type="text" placeholder="" name="kode_mata_kuliah" id="example-text-input">
                        @error('kode_mata_kuliah')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm col-form-label">Nama Mata Kuliah</label>
                    <div class="col-sm-10">
                        <input value="{{ old('nama_mata_kuliah', $matkul->nama_mata_kuliah) }}" class="form-control @error('nama_mata_kuliah') is-invalid @enderror" placeholder="" name="nama_mata_kuliah" id="example-text-input">
                        @error('nama_mata_kuliah')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm col-form-label">SKS</label>
                    <div class="col-sm-10">
                        <input value="{{ old('sks', $matkul->sks) }}" class="form-control @error('sks') is-invalid @enderror" placeholder="" name="sks" id="example-text-input">
                        @error('sks')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
        </div>
        <div class="modal-footer">
            <a href="/dashboard/matkul" class="btn btn-secondary" data-bs-dismiss="modal">Back</a>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>
</x-dashboard.layout>