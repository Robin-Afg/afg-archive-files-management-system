@extends('layouts.master')


<!--Title Reference -->
@section('active-menu-title') Archive Files @endsection
<!--Title Reference -->

<!-------------------------- Main content here .... ---------------------------------------->
@section('content')
<?php $er = "is-invalid"; ?> 

<center>
<div class="col-xl-9 col-lg-6 col-md-9 col-sm-12 col-12">

    <form class=""  method="POST" action="{{ route('register') }}" >
        {{ csrf_field() }}
        <div class="card">
            <div class="card-header text-center">
                <h3 class="mb-1">  فورم  راجستر  کاربر جدید     </h3>
                <p>   لطفا  معلومات خود را بنویسید     </p>
            </div>
            <div class="card-body">


                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                    <input class="form-control form-control-lg @if ($errors->has('name'))  <?php if(isset($er)){ echo $er;} ?> @endif " type="text"   placeholder=" نام و تخلص   " autocomplete="off" name="name"  required autofocus>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>



                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}"  > 
                    <input class="form-control form-control-lg @if ($errors->has('email'))  <?php if(isset($er)){ echo $er;} ?> @endif " type="email"  placeholder="   ایمیل     " autocomplete="off" name="email"  required>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>



                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                    <input class="form-control form-control-lg @if ($errors->has('password'))  <?php if(isset($er)){ echo $er;} ?> @endif " id="pass1" type="password"  placeholder=" رمز عبور    " name="password" required>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong style="color:#bd1515;">{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>



                <div class="form-group">
                    <input type="password"  class="form-control form-control-lg @if ($errors->has('password'))  <?php if(isset($er)){ echo $er;} ?> @endif " required="" placeholder="تایید  رمز عبور  " name="password_confirmation" required>
                </div>

                <div class="form-group">
                           

                            <div class="form-group">
                                <select name="type" class="form-control form-control-lg">
                                    <option value="0">User</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Archive</option>
                                    <option value="3">Viewer</option>
                                </select>

                            </div>
                        </div>


                         <div class="form-group">
                           

                            <div class="form-group">
                                <select name="dept" class="form-control form-control-lg">
                                    <option value="Act.CEO">Act.CEO</option>
                                    <option value="FDC">FDC</option>
                                    <option value="TDC">TDC</option>
                                    <option value="LA">LA</option>

                                    <option value="CA">CA</option>
                                    <option value="OC">OC</option>
                                    <option value="GIS">GIS</option>
                                    <option value="IT">IT</option>

                                    <option value="LE">LE</option>
                                    <option value="HR">HR</option>
                                    <option value="PM">PM</option>
                                    <option value="IS">IS</option>

                                    <option value="TP">TP</option>
                                    <option value="SD">SD</option>
                                    <option value="R&D">R&D</option>
                                    <option value="GEP">GEP</option>

                                    <option value="URP">URP</option>
                                    <option value="ISP">ISP</option>
                                    <option value="EZP">EZP</option>
                                    <option value="IAC">IAC</option>

                                    <option value="PP">PP</option>
                                    <option value="PR">PR</option>
                                    <option value="IR">IR</option>
                                    <option value="PC">PC</option>
                                    <option value="FI">FI</option>
                                    <option value="OS">OS</option>
                                </select>

                            </div>
                        </div>



            <center>
                <div class="row">
                    <div class="col-8">
                          <div class="form-group pt-2 ">
                            <button class="btn btn-block btn-primary col-3 " type="submit"> ایجاد کاربر   </button>
                           </div>
                    </div>
                    <!--Showing flash messages here  -->
                    <div class="col-4 flash-message float-right text-right">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if(Session::has('alert-' . $msg))

                            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close pl-2" data-dismiss="alert" aria-label="close">&times;</a></p>
                            @endif
                        @endforeach
                    </div> <!-- end .flash-message -->
                </div>
            </center>



            </div>
            
        </div>
    </form>
</div>
</center>


           
                   
                   

   
@endsection


