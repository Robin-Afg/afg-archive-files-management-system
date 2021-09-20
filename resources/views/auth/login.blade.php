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

<body>
    <!-- ============================================================== -->
    <!-- login page  -->
    <!-- ============================================================== -->
    <?php $er = "is-invalid"; ?>

    <div class="splash-container">
        <div class="card ">
            <div class="card-header text-center"><img class="logo-img" src="{{url('/')}}/img/afgcircle.png" alt="logo" style="width: 40%;"><span class="splash-description mt-3" > لطفا  معلومات خود را بنویسید   </span></div>
                <div class="text">
                    @include('layouts.msg')
                </div>        
            <div class="card-body">   
                <form method="POST" action="{{ route('login') }}" >
                    {{ csrf_field() }}
                          
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <div class="form-group">
                        <input class="form-control form-control-lg  @if ($errors->has('email'))  <?php if(isset($er)){ echo $er;} ?> @endif " name="email" type="email" placeholder=" ایمیل خود را بنویسید  " autocomplete="off" value="{{ old('email') }}" required autofocus>
                             @if ($errors->has('email'))
                                    <span class="help-block" >
                                        <strong style="color:#bd1515;">{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                    </div>

                    


                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <div class="form-group">
                        <input class="form-control form-control-lg @if ($errors->has('password'))  <?php if(isset($er)){ echo $er;} ?> @endif " name="password" type="password" placeholder=" رمز عبور  خود را بنویسید   ">
                        @if ($errors->has('password'))
                                    <span class="help-block" >
                                        <strong style="color:#bd1515;">{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                   

                   


                    <div class="form-group">
                        <label class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}><span class="custom-control-label">   بخاطر سپردن  من     </span>
                        </label>
                    </div>
                   



                    <button type="submit" class="btn btn-primary btn-lg btn-block"> ورود   </button>
                </form>
            </div>
            
            <div class="card-footer bg-white p-0  text-center">
                <div class="card-footer-item card-footer-item-bordered">
                    <a href="{{ url('forgot-password') }}" class="footer-link">  رمز عبور خود را فراموش  کردید    </a>
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







