<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ورود </title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{url('/')}}/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="{{url('/')}}/assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="{{url('/')}}/assets/libs/css/style.css">
    <link rel="stylesheet" href="{{url('/')}}/assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="shortcut icon" type="image/png" href="{{url('/')}}/img/fav.png"/>
    <style>
    html,
    body {
        height: 100%;
    }

    body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-image: url('{{url('/')}}/img/Hazar-ZIna-view.jpg');
        /* Location of the image */

      
      /* Background image is centered vertically and horizontally at all times */
      background-position: center center;
      
      /* Background image doesn't tile */
      background-repeat: no-repeat;
      
      /* Background image is fixed in the viewport so that it doesn't move when 
         the content's height is greater than the image's height */
      background-attachment: fixed;
      
      /* This is what makes the background image rescale based
         on the container's size */
      background-size: cover;
      
      /* Set a background color that will be displayed
         while the background image is loading */
      background-color: #464646;
    }
    
    </style>
</head>


<?php $er = "is-invalid"; ?>

<div class="splash-container">
        <div class="card ">
            <div class="card-header text-center"><a href="http://172.16.0.3"><img class="logo-img" src="{{url('/')}}/img/afgcircle.png" alt="logo" style="width: 40%;"></a><span class="splash-description">   ایمیل و رمز جدید تان را بنویسید  </span></div>
            <div class="card-body">

                    <form class="form-horizontal text-right" method="POST" action="{{ route('password.request') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ request()->route('token') }}">
                       
                        
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-12 control-label">  ایمیل </label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @if ($errors->has('email'))  <?php if(isset($er)){ echo $er;} ?> @endif " name="email" value="{{ $email or old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong style="color:#bd1515;">{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-12 control-label">  پاسورد  </label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control @if ($errors->has('password'))  <?php if(isset($er)){ echo $er;} ?> @endif " name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong style="color:#bd1515;">{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">  تاییدی پاسورد  </label>
                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control @if ($errors->has('password_confirmation'))  <?php if(isset($er)){ echo $er;} ?> @endif " name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong style="color:#bd1515;">{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group ml-auto">
                            <div class="col-md-4 ">
                                <button type="submit" class="btn btn-primary">
                                    بازنشانی رمز جدید
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


  
    <!-- ============================================================== -->
    <!-- end login page  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="{{url('/')}}/assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="{{url('/')}}/assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
</body>
 
</html>
