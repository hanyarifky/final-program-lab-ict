<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Form Booking KP</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>

<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <h4>Tambah Data Booking KP</h4>
            <hr>
            <form action="/booking-kp" method="POST">
                @csrf

               
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

                <!-- Pilih Ruangan -->
                  <div class="row mb-3">
                        <label class="col-sm col-form-label">Ruangan Lab</label>
                        <div class="col-sm-10">
                            <select class="form-select @error('ruangan_id') is-invalid @enderror" name="ruangan_id" required>
                                <option selected disabled>Pilih Ruangan</option>
                                @foreach ($ruangans->sortBy('kode_ruangan') as $ruangan)
                                <option value="{{ $ruangan->id }}" {{ old('ruangan_id') == $ruangan->id ? 'selected' : '' }}>
                                    {{ $ruangan->nama_ruangan }}
                                </option>
                                @endforeach
                            </select>
                            @error('ruangan_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                <!-- Tanggal -->
                <div class="mb-3 row">
                    <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
                        @error('tanggal')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Jam Mulai -->
                <div class="mb-3 row">
                    <label for="jam_mulai" class="col-sm-2 col-form-label">Jam Mulai</label>
                    <div class="col-sm-10">
                        <input type="time" class="form-control @error('jam_mulai') is-invalid @enderror" id="jam_mulai" name="jam_mulai" value="{{ old('jam_mulai') }}" required>
                        @error('jam_mulai')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Jam Selesai -->
                <div class="mb-3 row">
                    <label for="jam_selesai" class="col-sm-2 col-form-label">Jam Selesai</label>
                    <div class="col-sm-10">
                        <input type="time" class="form-control @error('jam_selesai') is-invalid @enderror" id="jam_selesai" name="jam_selesai" value="{{ old('jam_selesai') }}" required>
                        @error('jam_selesai')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Pertemuan -->
                <div class="mb-3 row">
                    <label for="pertemuan" class="col-sm-2 col-form-label">Pertemuan</label>
                    <div class="col-sm-10">
                        <input type="number" min="1" class="form-control @error('pertemuan') is-invalid @enderror" id="pertemuan" name="pertemuan" value="{{ old('pertemuan') ?? 1 }}" required>
                        @error('pertemuan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Status -->
                {{-- <div class="mb-3 row">
                    <label for="status" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="disetujui" {{ old('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                            <option value="batal" {{ old('status') == 'batal' ? 'selected' : '' }}>Batal</option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div> --}}

                <div class="d-flex justify-content-end gap-2">
                    <a href="/" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS Bundle -->
@include('sweetalert2::index')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
