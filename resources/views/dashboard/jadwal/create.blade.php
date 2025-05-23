<x-dashboard.layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4>Tambah Data Jadwal Lab</h4>
                    <hr>
                    <form action="/dashboard/jadwal" method="POST">
                        @csrf
                        <div class="modal-body">

                            {{-- Input Jadwal --}}
                            <div class="row mb-3">
                                <label class="col-sm col-form-label">Pilih Kelas</label>
                                <div class="col-sm-10">
                                    <select class="form-select @error('kelas_id') is-invalid @enderror" name="kelas_id" required>
                                        <option selected disabled>Pilih Kelas</option>
                                        @foreach ($kelases as $kelas)
                                        <option value="{{ $kelas->id }}" {{ old('kelas_id') == $kelas->id ? 'selected' : '' }}>
                                            {{ $kelas->matkul->nama_mata_kuliah }} | {{ $kelas->kelompok }} | {{ $kelas->dosen->nama }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('kelas_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm col-form-label">Ruangan Lab</label>
                                <div class="col-sm-10">
                                    <select class="form-select @error('ruangan_id') is-invalid @enderror" name="ruangan_id" required>
                                        <option selected disabled>Pilih Ruangan</option>
                                        @foreach ($ruangans as $ruangan)
                                        <option value="{{ $ruangan->id }}" {{ old('ruangan_id') == $ruangan->id ? 'selected' : '' }}>
                                            {{ $ruangan->nomor_ruangan }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('ruangan_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- <div class="row mb-3">
                                <label class="col-sm col-form-label">Hari</label>
                                <div class="col-sm-10">
                                    <select class="form-select @error('hari') is-invalid @enderror" name="hari" required>
                                        <option selected disabled>Pilih Hari</option>
                                        <option value="senin" {{ old('hari') == 'senin' ? 'selected' : '' }}>Senin</option>
                                        <option value="selasa" {{ old('hari') == 'selasa' ? 'selected' : '' }}>Selasa</option>
                                        <option value="rabu" {{ old('hari') == 'rabu' ? 'selected' : '' }}>Rabu</option>
                                        <option value="kamis" {{ old('hari') == 'kamis' ? 'selected' : '' }}>Kamis</option>
                                        <option value="jumat" {{ old('hari') == 'jumat' ? 'selected' : '' }}>Jum'at</option>
                                    </select>
                                    @error('hari')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div> --}}

                            <div class="row mb-3">
                                <label class="col-sm col-form-label">Jam Mulai</label>
                                <div class="col-sm-10">
                                    <input type="time" name="jam_mulai" class="form-control @error('jam_mulai') is-invalid @enderror" value="{{ old('jam_mulai') }}" required>
                                    @error('jam_mulai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror   
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm col-form-label">Jam Selesai</label>
                                <div class="col-sm-10">
                                    <input type="time" name="jam_selesai" class="form-control @error('jam_selesai') is-invalid @enderror" value="{{ old('jam_selesai') }}" required>
                                    @error('jam_selesai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Input Detail Jadwal Dinamis --}}
                            <h5>Detail Jadwal</h5>
                            <div id="detail-container">
                                @if(old('details'))
                                    @foreach(old('details') as $i => $detail)
                                        <div class="row mb-3 detail-item">
                                            <div class="col-sm-3">
                                                <input type="number" name="details[{{ $i }}][pertemuan]" class="form-control" placeholder="Pertemuan" value="{{ $detail['pertemuan'] ?? '' }}" required min="1">
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="date" name="details[{{ $i }}][tanggal]" class="form-control" value="{{ $detail['tanggal'] ?? '' }}" required>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" name="details[{{ $i }}][status]" class="form-control" placeholder="Status" value="{{ $detail['status'] ?? '' }}" required>
                                            </div>
                                            <div class="col-sm-2">
                                                <button type="button" class="btn btn-danger remove-detail">Hapus</button>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="row mb-3 detail-item">
                                        <div class="col-sm-3">
                                            <input type="number" name="details[0][pertemuan]" class="form-control" placeholder="Pertemuan" required min="1">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="date" name="details[0][tanggal]" class="form-control" required>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" name="details[0][status]" class="form-control" placeholder="Status" required>
                                        </div>
                                        <div class="col-sm-2">
                                            <button type="button" class="btn btn-danger remove-detail">Hapus</button>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <button type="button" id="add-detail" class="btn btn-primary">Tambah Detail</button>

                        </div>
                        <div class="modal-footer">
                            <a href="/dashboard/jadwal" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Script untuk tambah/hapus input detail dinamis --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let detailIndex = {{ old('details') ? count(old('details')) : 1 }};

            document.getElementById('add-detail').addEventListener('click', function() {
                const container = document.getElementById('detail-container');

                const div = document.createElement('div');
                div.classList.add('row', 'mb-3', 'detail-item');
                div.innerHTML = `
                    <div class="col-sm-3">
                        <input type="number" name="details[${detailIndex}][pertemuan]" class="form-control" placeholder="Pertemuan" required min="1">
                    </div>
                    <div class="col-sm-4">
                        <input type="date" name="details[${detailIndex}][tanggal]" class="form-control" required>
                    </div>
                    <div class="col-sm-3">
                        <input type="text" name="details[${detailIndex}][status]" class="form-control" placeholder="Status" required>
                    </div>
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-danger remove-detail">Hapus</button>
                    </div>
                `;
                container.appendChild(div);

                div.querySelector('.remove-detail').addEventListener('click', function() {
                    div.remove();
                });

                detailIndex++;
            });

            // Event untuk tombol hapus di setiap detail yang sudah ada
            document.querySelectorAll('.remove-detail').forEach(btn => {
                btn.addEventListener('click', function() {
                    btn.closest('.detail-item').remove();
                });
            });
        });
    </script>
</x-dashboard.layout>
