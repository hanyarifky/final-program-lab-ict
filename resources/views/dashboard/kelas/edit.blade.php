<x-dashboard.layout>
    {{-- {{ dd($jadwal) }} --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4>Edit Data Kelas</h4><hr>
                    <form action="/dashboard/kelas/{{ $kelas->id }}" method="POST">
                       @csrf
                       @method("put")
                       <div class="modal-body">
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm col-form-label">Dosen</label>
                                <div class="col-sm-10">
                                    <select class="form-select @error('dosen_id') is-invalid @enderror" name="dosen_id" aria-label="Default select example">
                                        <option selected disabled>Pilih Dosen</option>
                                        @foreach ($dosens as $dosen )
                                        <option   {{ old('dosen_id', $kelas->dosen_id) == $dosen->id ? "selected" : ''}} value="{{ $dosen->id }}">{{ $dosen->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('dosen_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm col-form-label">Mata Kuliah</label>
                                <div class="col-sm-10">
                                    <select class="form-select @error('matkul_id') is-invalid @enderror"" name="matkul_id" aria-label="Default select example">
                                        <option selected disabled>Pilih Mata Kuliah</option>
                                        @foreach ($matkuls as $matkul )
                                        <option {{ old('matkul_id', $kelas->matkul_id) == $matkul->id ? "selected" : ''}}  value="{{ $matkul->id }}">{{ $matkul->nama_mata_kuliah }}</option>
                                        @endforeach
                                    </select>
                                    @error('matkul_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                 <label for="example-text-input" class="col-sm col-form-label">Kelompok</label>
                                   <div class="col-sm-10">
                                       <input class="form-control  @error('kelompok') is-invalid @enderror" type="text" value="{{ old('kelompok', $kelas->kelompok) }}" type="text" placeholder="" name="kelompok" id="example-text-input">
                                       @error('kelompok')
                                           <div class="invalid-feedback">
                                               {{ $message }}
                                           </div>
                                       @enderror
                                   </div>
                            </div>
                            <input type="hidden" name="tanggal_mulai" 
                            value="{{ old('tanggal_mulai', \Carbon\Carbon::parse($kelas->tanggal_mulai)->format('Y-m-d')) }}" 
                            readonly />

                            <div class="row mb-3">
                                <label class="col-sm col-form-label">Ruangan Lab</label>
                                <div class="col-sm-10">
                                    <select class="form-select @error('ruangan_id') is-invalid @enderror" name="ruangan_id" required>
                                        <option selected disabled>Pilih Ruangan</option>
                                        @foreach ($ruangans->sortBy('kode_ruangan') as $ruangan)
                                        <option value="{{ $ruangan->id }}" {{ old('ruangan_id', $jadwal->ruangan->id) == $ruangan->id ? 'selected' : '' }}>
                                            {{ $ruangan->nama_ruangan }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('ruangan_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                             <div class="row mb-3">
                                <label class="col-sm col-form-label">Jam Mulai</label>
                                <div class="col-sm-10">
                                    <input type="time" name="jam_mulai" class="form-control @error('jam_mulai') is-invalid @enderror" value="{{ old('jam_mulai', \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i')) }}" required>
                                    @error('jam_mulai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm col-form-label">Jam Selesai</label>
                                <div class="col-sm-10">
                                    <input type="time" name="jam_selesai" class="form-control @error('jam_selesai') is-invalid @enderror" value="{{ old('jam_selesai', \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i')) }}" required>
                                    @error('jam_selesai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        </div>
                              
                </div>
                       <div class="modal-footer">
                           <a href="/dashboard/kelas" class="btn btn-secondary">Back</a>
                           <button type="submit" class="btn btn-primary">Save changes</button>
                       </div>
                   </form>
                </div>
            </div>
        </div>
    </div>

</x-dashboard.layout>