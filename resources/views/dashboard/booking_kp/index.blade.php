<x-dashboard.layout :title="$title">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                     <div class="d-flex justify-content-between">
                        
                        <h1 class="card-title mb-3">Data Booking</h1>
                        {{-- <z href="#" class="btn btn-success font-weight-bolder waves-effect waves-light mb-3">Tambah Data</z> --}}
                        {{-- <a href="/dashboard/booking-kp/create" class="btn btn-success font-weight-bolder waves-effect waves-light mb-3" >Tambah Data</a> --}}

                    </div>

                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Nama Dosen</th>
                            <th>Nama Mata Kuliah</th>
                            <th>Kelompok</th>
                            <th>Ruangan</th>
                            <th>Waktu (tgl, pertemuan, jam)</th>
                            <th  style="width: 10%" class="text-center">Action</th>
                        </tr>
                        </thead>


                        <tbody>
                        @foreach ($bookings as $booking)
                        <tr>
                            <td>{{ $booking->kelas->dosen->nama }}</td>
                            <td>{{ $booking->kelas->matkul->nama_mata_kuliah}}</td>
                            <td>{{ $booking->kelas->kelompok}}</td>
                            <td>{{ $booking->ruangan->nama_ruangan }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->tanggal)->format('d') }} | Pertemuan | {{ Carbon\Carbon::parse($booking->jam_mulai)->format('H:i')}}</td>
                            <td class="text-center d-flex gap-1 justify-content-center">
                                <form action="{{ route('booking-kp.setujui', $booking->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm">Setujui</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                       
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</x-dashboard.layout>
