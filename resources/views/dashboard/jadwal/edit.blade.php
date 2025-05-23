<x-dashboard.layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4>Edit Data Jadwal Lab</h4>
                    <hr>
                    {{-- Asumsikan $jadwal adalah data jadwal yang diedit --}}
                    <form action="/dashboard/jadwal/{{ $jadwal->id }}" method="POST">
                        @csrf
                        @method('PUT') {{-- Method PUT untuk update --}}
                        <div class="modal-body">

                            {{-- Input Jadwal --}}
                            <div class="row mb-3">
                                <label class="col-sm col-form-label">Pilih Kelas</label>
                                <div class="col-sm-10">
                                    <select class="form-select @error('kelas_id') is-invalid @enderror" name="kelas_id" required>
                                        <option disabled>Pilih Kelas</option>
                                        @foreach ($kelases as $kelas)
                                            <option value="{{ $kelas->id }}"
                                                {{ (old('kelas_id', $jadwal->kelas_id) == $kelas->id) ? 'selected' : '' }}>
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
                                        <option disabled>Pilih Ruangan</option>
                                        @foreach ($ruangans->sortBy('kode_ruangan') as $ruangan)
                                            <option value="{{ $ruangan->id }}" {{ old('ruangan_id', $ruangan->id) == $ruangan->id ? 'selected' : '' }}>
                                                {{ $ruangan->nama_ruangan }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('ruangan_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Jam Mulai --}}
                            <div class="row mb-3">
                                <label class="col-sm col-form-label">Jam Mulai</label>
                                <div class="col-sm-10">
                                   <input type="time" name="jam_mulai" class="form-control @error('jam_mulai') is-invalid @enderror" value="{{ old('jam_mulai', \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i')) }}" required>
                                    @error('jam_mulai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Jam Selesai --}}
                            <div class="row mb-3">
                                <label class="col-sm col-form-label">Jam Selesai</label>
                                <div class="col-sm-10">
                                    <input type="time" name="jam_selesai" class="form-control @error('jam_selesai') is-invalid @enderror" value="{{ old('jam_selesai', \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i')) }}" required>
                                    @error('jam_selesai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Input Detail Jadwal Dinamis --}}
                            <h5>Detail Jadwal</h5>
                            <div id="detail-container">
                                @php
                                    $detailsOld = old('details');
                                    $details = $detailsOld ?? $jadwal->details; // Asumsi $jadwal->details adalah collection/detail array
                                @endphp

                                @if ($details)
                                    @foreach ($details as $i => $detail)
                                        <div class="row mb-3 detail-item">
                                            <div class="col-sm-3">
                                                <input type="number" name="details[{{ $i }}][pertemuan]" class="form-control" placeholder="Pertemuan" value="{{ $detail['pertemuan'] ?? $detail->pertemuan ?? '' }}" required min="1">
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="date" name="details[{{ $i }}][tanggal]" class="form-control" value="{{ $detail['tanggal'] ?? $detail->tanggal ?? '' }}" required>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" name="details[{{ $i }}][status]" class="form-control" placeholder="Status" value="{{ $detail['status'] ?? $detail->status ?? '' }}" required>
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
                            <button type="submit" class="btn btn-primary">Update Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Script untuk tambah/hapus input detail dinamis --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let detailIndex = {{ isset($details) ? count($details) : 1 }};

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
