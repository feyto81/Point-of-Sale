
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('backend/css/main.css')}}">
    <link href="{{asset('backend/images/favicon.png')}}" rel="icon">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    @toastr_css
    <title>Login Ticket</title>
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        <h1>POS</h1>
      </div>
      <div class="login-box">
        <form class="login-form" action="postlogin" method="POST">
            @csrf
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>SIGN IN</h3>
          <div class="form-group">
            <label class="control-label" for="name">NAME</label>
            <input class="form-control" type="text" name="name" id="name" placeholder="Name" autofocus>
          </div>
          <div class="form-group">
            <label class="control-label" for="password">PASSWORD</label>
            <input class="form-control" name="password" id="password" type="password" placeholder="Password">
          </div>
          <div class="form-group">
            <div class="utility">
              <div class="animated-checkbox">
                <label>
                  <input type="checkbox"><span class="label-text" {{ old('remember') ? 'checked' : '' }}>Remember Me</span>
                </label>
              </div>
              
              @if (Route::has('password.request'))
              <a class="btn btn-link" href="{{ route('password.request') }}">
                <p class="semibold-text mb-2"><a href="{{ route('password.request') }}" data-toggle="flip">Forgot Password ?</a></p>
                  {{ __('Forgot Your Password?') }}
              </a>
              @endif
              
            </div>
          </div>
          <div class="form-group btn-container">
            <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN IN</button>
          </div>
        </form>
      </div>
    </section>
    @include('sweetalert::alert')
    <!-- Essential javascripts for application to work-->
    <script src="{{asset('backend/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('backend/js/popper.min.js')}}"></script>
    <script src="{{asset('backend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('backend/js/main.js')}}"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
    @jquery
    @toastr_js
    @toastr_render
    <script type="text/javascript">
      // Login Page Flipbox control
      $('.login-content [data-toggle="flip"]').click(function() {
      	$('.login-box').toggleClass('flipped');
      	return false;
      });
    </script>
  </body>
</html>