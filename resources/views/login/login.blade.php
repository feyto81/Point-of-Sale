<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Login | Kasir</title>
  <link href="{{asset('backend/images/favicon.png')}}" rel="icon">
  <link href="{{ asset('backend/login/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="{{ asset('backend/login/css/sb-admin-2.min.css') }}" rel="stylesheet">
   @toastr_css
  <style type="text/css">
    body{
      background-image: url('{{ asset('backend/login/images/BackgroundSample.jpg') }}');
      background-size: cover;
      background-position: center;
    }
    .top-margin{
      margin-top: 70px;
    }
    .first-account{
      background-position: center;
      background-image: url('{{ asset('backend/login/icon/undraw_welcome_3gvl.svg')  }}');
      background-size: 300px;
      background-repeat: no-repeat;
    }
    .card-login{
      background-position: center;
      background-image: url('{{ asset('backend/login/images/Internship-Rendi-Juliarto-UIUX.png')  }}');
      background-size: cover;
    }
  </style>
</head>
<body class="">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9 top-margin">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0" style="background-color: ">
            <div class="row ">
              <div class="col-lg-6 d-none d-lg-block card-login"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome To Kasir Aplication</h1>
                    <h1 class="h6 text-gray-900 mb-4">Start Your Session</h1>
                  </div>
                  <form class="user" method="POST" action="postlogin">
                    @csrf
                    <div class="form-group">
                      <input type="text" name="name" class="form-control form-control-user" id="name" placeholder="Name">
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control form-control-user" id="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>
                    <button class="btn btn-user btn-block" style="background-color: #9800e1; color: white;" type="submit">Login</button>
                  </form>
                  <hr>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    @include('sweetalert::alert')
  <script src="{{ asset('backend/login/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('backend/login/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('backend/login/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('backend/login/js/sb-admin-2.min.js') }}"></script>
  <script src="{{ asset('backend/login/js/sweetalert.js') }}"></script>
    @toastr_js
    @toastr_render
</body>
</html>
