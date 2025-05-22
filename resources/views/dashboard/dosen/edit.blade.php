<x-dashboard.layout>
    {{ dd($dosen) }}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4>Edit Data Dosen</h4><hr>
                    <form action="/dashboard/dosen/{{ $dosen->nip }}" method="POST">
                       @method("put")
                       @csrf
                       <div class="modal-body">
                               <div class="row mb-3">
                                   <label for="example-text-input" class="col-sm col-form-label">NIP</label>
                                   <div class="col-sm-10">
                                       <input readonly class="form-control" value="{{ old('nip', $dosen->nip) }}" @error('nip') is-invalid @enderror" value="{{ old('nip') }}" type="text" placeholder="" name="nip" id="example-text-input">
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
                                       <input class="form-control" value="{{ old("nama",$dosen->nama) }}" type="text" value="{{ old('nama') }}" placeholder="" name="nama" id="example-text-input">
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
                                       <input class="form-control" value="{{ old("email", $dosen->email) }}" @error('email') is-invalid @enderror" type="text" value="{{ old('email') }}" placeholder="" name="email" id="example-text-input">
                                       @error('email')
                                       <div class="invalid-feedback">
                                           {{ $message }}
                                       </div>
                                       @enderror
                                   </div>
                               </div>
                               <div class="row mb-3">
                                   <label for="example-text-input" class="col-sm-2 col-form-label">No Telepon</label>
                                   <div class="col-sm-10">
                                       <input class="form-control" value="{{ old('no_telepon', $dosen->no_telepon) }}" type="text" placeholder="" name="no_telepon" value="{{ old('no_telepon') }}" id="example-text-input">
                                       @error('no_telepon')
                                           <div class="invalid-feedback">
                                               {{ $message }}
                                           </div>
                                       @enderror
                                   </div>
                               </div>
                               <div class="row ">
                                   <label for="example-text-input" class="col-sm col-form-label">Fakultas</label>
                                       <div class="col-sm-10">
                                           <select class="form-select" name="fakultas" aria-label="Default select example">
                                               <option selected disabled>Pilih Fakultas</option>
                                               <option  {{ old('fakultas', $dosen->fakultas) == "fti" ?  'selected' : ''}} value="fti">Fakultas Teknologi Informasi</option>
                                               <option  {{ old('fakultas', $dosen->fakultas) == "fkdk" ?  'selected' : ''}} value="fkdk">Fakultas Komunikasi dan Desain Kreatif</option>
                                               <option  {{ old('fakultas', $dosen->fakultas) == "feb" ?  'selected' : ''}} value="feb">Fakultas Ekonomi dan Bisnis</option>
                                               <option  {{ old('fakultas', $dosen->fakultas) == "fissig" ?  'selected' : ''}} value="fissig">Fakultas Ilmu Sosial dan Ilmu Politik</option>
                                               <option  {{ old('fakultas', $dosen->fakultas) == "ft" ?  'selected' : ''}} value="ft">Fakultas Teknik</option>
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
                           <a href="/dashboard/dosen" class="btn btn-secondary">Back</a>
                           <button type="submit" class="btn btn-primary">Save changes</button>
                       </div>
                   </form>
                </div>
            </div>
        </div>
    </div>

</x-dashboard.layout>