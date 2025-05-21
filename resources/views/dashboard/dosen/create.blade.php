<x-dashboard.layout>
     <form action="/dashboard/dosen" method="POST">
        @csrf
        <div class="modal-body">
                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm col-form-label">NIP</label>
                    <div class="col-sm-10">
                        <input class="form-control @error('nip') is-invalid @enderror" value="{{ old('nip') }}" type="text" placeholder="" name="nip" id="example-text-input">
                        @error('nip')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" value="{{ old('nama') }}" placeholder="" name="nama" id="example-text-input">
                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm col-form-label">E-mail</label>
                    <div class="col-sm-10">
                        <input class="form-control @error('email') is-invalid @enderror" type="text" value="{{ old('email') }}" placeholder="" name="email" id="example-text-input">
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <label for="example-text-input" class="col-sm-2 col-form-label">No Telepon</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" placeholder="" name="no_telepon" value="{{ old('no_telepon') }}" id="example-text-input">
                        @error('no_telepon')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm col-form-label">Fakultas</label>
                        <div class="col-sm-10">
                            <select class="form-select" name="fakultas" aria-label="Default select example">
                                <option selected disabled>Pilih Fakultas</option>
                                <option value="fto">Fakultas Teknologi Informasi</option>
                                <option value="fkdk">Fakultas Komunikasi dan Desain Kreatif</option>
                                <option value="feb">Fakultas Ekonomi dan Bisnis</option>
                                <option value="fissig">Fakultas Ilmu Sosial dan Ilmu Politik</option>
                                <option value="ft">Fakultas Teknik</option>
                                </select>
                                @error('fakultas')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                    </div>
                        {{-- <input class="form-control" type="text" placeholder="" value="{{ old('fakultas') }}" name="fakultas" id="example-text-input">
                        @error('fakultas')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror --}}
                    </div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>
</x-dashboard.layout>