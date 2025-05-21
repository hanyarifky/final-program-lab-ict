<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page | Sistem Penjadadwalan</title>
    <link rel="icon" href="{{ asset('image/remove-logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <style>
        .btn-color{
            background-color: #0e1c36;
            color: #fff;
        }

        .profile-image-pic{
            height: 200px;
            width: 200px;
            object-fit: cover;
        }
        .cardbody-color{
         background-color: #ebf2fa;
        }

        a{
        text-decoration: none;
        }
    </style>
</head>
<body>

    <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <div class="card my-5">

          <form action="/login" method="POST" class="card-body cardbody-color p-lg-5">
            @csrf

            <div class="text-center">
              <h1>Sistem Penjadwalan</h1>
              
              <img src="{{ asset('image/logo.jpeg') }}" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3"
                width="200px" alt="profile">

            </div>

            <div class="mb-3">
              <input 
              type="text" 
              class="form-control @error('nim') is-invalid @enderror" 
              id="nim" name="nim" 
              aria-describedby="emailHelp"
              placeholder="Masukkan NIM Anda"
              >                
              @error('nim')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>    
              @enderror
            </div>
            <div class="mb-3">
              <input type="password" 
              name="password" 
              class="form-control @error('password') is-invalid @enderror" 
              id="password" placeholder="Masukkan Password Anda"
              >
              @error('password') <div class="invalid-feedback"> {{ $message }}</div> @enderror
            </div>
            <div class="text-center"><button type="submit" class="btn btn-color px-5 mb-5 w-100">Login</button></div>
          </form>
        </div>

      </div>
    </div>
  </div>
  @include('sweetalert2::index')
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js" integrity="sha384-RuyvpeZCxMJCqVUGFI0Do1mQrods/hhxYlcVfGPOfQtPJh0JCw12tUAZ/Mv10S7D" crossorigin="anonymous"></script>
</body>
</html>