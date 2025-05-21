<x-dashboard.layout>
     <form action="/dashboard/matkul" method="POST">
        @csrf
        <div class="modal-body">
                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm col-form-label">Kode Mata Kuliah</label>
                    <div class="col-sm-10">
                        <input class="form-control @error('kode_mata_kuliah') is-invalid @enderror" value="{{ old('kode_mata_kuliah') }}" type="text" placeholder="" name="kode_mata_kuliah" id="example-text-input">
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
                        <input class="form-control  @error('nama_mata_kuliah') is-invalid @enderror" type="text" value="{{ old('nama_mata_kuliah') }}" type="text" placeholder="" name="nama_mata_kuliah" id="example-text-input">
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
                        <input class="form-control @error('sks') is-invalid @enderror" type="text" value="{{ old('sks') }}" placeholder="" name="sks" id="example-text-input">
                        @error('sks')
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