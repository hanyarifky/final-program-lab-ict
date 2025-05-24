<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Jadwal Mata Kuliah</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="shortcut icon" href="{{ asset('image/remove-logo.png') }}">
</head>
<body>

<div class="container mt-4">
    <h2 class="mb-4">Jadwal Mata Kuliah untuk tanggal {{ \Carbon\Carbon::parse($tanggal)->format('d M Y') }}</h2>

    <div class="d-flex justify-content-between">
<form method="GET" action="{{ url()->current() }}" class="row g-3 align-items-center mb-4">
        <div class="col-auto">
            <label for="tanggal" class="col-form-label">Pilih Tanggal:</label>
        </div>
        <div class="col-auto">
            <input type="date" id="tanggal" name="tanggal" class="form-control" value="{{ $tanggal }}" />
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Tampilkan</button>
        </div>
        <div class="col-auto">
            <a href="booking-kp/create" class="btn btn-primary">Booking KP</a>
        </div>
    </form>
    <div class="">
        <a href="/login " class="btn btn-primary">Login</a>
    </div>
    </div>
    

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Mata Kuliah</th>
                    <th>Waktu</th>
                    <th>Kelompok</th>
                    <th>Ruang</th>
                    <th>Nama Dosen</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($jadwals as $jadwal)
                    <tr>
                        <td>{{ $jadwal->kelas->matkul->nama_mata_kuliah ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}</td>
                        <td>{{ $jadwal->kelas->kelompok ?? '-' }}</td>
                        <td>{{ $jadwal->ruangan->nama_ruangan ?? '-' }}</td>
                        <td>{{ $jadwal->kelas->dosen->nama ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data jadwal untuk tanggal ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@include('sweetalert2::index')
<!-- Bootstrap JS Bundle (opsional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
