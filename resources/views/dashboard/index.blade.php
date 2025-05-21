<x-dashboard.layout>

   <div class="row">
       <div class="col-xl-3 col-md-6">
           <div class="card">
               <div class="card-body">
                   <div class="d-flex">
                       <div class="flex-grow-1">
                           <p class="text-truncate font-size-14 mb-2">Total Dosen</p>
                           <h4 class="mb-2">{{ $totalDosen }}</h4>
                       </div>
                       <div class="avatar-sm">
                           <span class="avatar-title bg-light text-primary rounded-3">
                               <a href="/dashboard/dosen">
                                    <i class="fas fa-chalkboard-teacher"></i> 
                               </a>
                           </span>
                       </div>
                   </div>                                            
               </div><!-- end cardbody -->
           </div><!-- end card -->
       </div><!-- end col -->
       <div class="col-xl-3 col-md-6">
           <div class="card">
               <div class="card-body">
                   <div class="d-flex">
                       <div class="flex-grow-1">
                           <p class="text-truncate font-size-14 mb-2">Total Ruangan</p>
                           <h4 class="mb-2">{{ $totalRuangan }}</h4>
                       </div>
                       <div class="avatar-sm">
                           <span class="avatar-title bg-light text-primary rounded-3">
                               <a href="/dashboard/ruangan">
                                <i class="fas fa-desktop"></i>  
                               </a>
                           </span>
                       </div>
                   </div>                                            
               </div><!-- end cardbody -->
           </div><!-- end card -->
       </div><!-- end col -->
       <div class="col-xl-3 col-md-6">
           <div class="card">
               <div class="card-body">
                   <div class="d-flex">
                       <div class="flex-grow-1">
                           <p class="text-truncate font-size-14 mb-2">Total Mata Kuliah</p>
                           <h4 class="mb-2">{{ $totalMatkul }}</h4>
                       </div>
                       <div class="avatar-sm">
                           <span class="avatar-title bg-light text-primary rounded-3">
                               <a href="/dashboard/matkul">
                                <i class="fas fa-book"></i> 
                               </a>
                           </span>
                       </div>
                   </div>                                            
               </div><!-- end cardbody -->
           </div><!-- end card -->
       </div><!-- end col -->
       
                        </div><!-- end row -->

</x-dashboard.layout>