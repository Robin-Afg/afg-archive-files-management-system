<?php 
//This check wheather an the read column of notification has a timestamp value or not if its null
//this shows a red dot in notificaiton bell 

$ind = '';
$notis = App\Models\Noti::where('notifiable_id', Auth::id())->where('user_id','!=',Auth::id());
    foreach($notis->where('read', null)->get() as $noti){
        $ind = 'rob';
    }
?>


<style type="text/css">
@media (min-width: 1024px) {
    .navbar-brand.abs
    {
        position: absolute;
        width: 100%;
        left: 0;
        text-align: center;
    }
}
@media (max-width: 382px) {
    .navbar-brand.abs
    {
        font-size: 21px
    }
}
@media (max-width: 1024px) {
    .top-search-bar
    {
        padding-left: 15px;
        padding-right: 15px;
    }
}
</style>
  <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
     <div class="dashboard-main-wrapper" >
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
       <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                    <a class="navbar-brand abs" style="color:#174c81; margin-right:0;"  href="<?php if(auth::user()->type == 0){ echo route('user_dashboard'); } else {echo route('dashboard'); } ?>">سیستم مدیریت اسناد  آرشیف    </a>

                    <button class="navbar-toggler custom-icon" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
                        <span class="navbar-toggler-icon"><i class="fas fa-angle-double-down"></i></span>
                    </button>
                    
                    <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <img src="{{url('/')}}/img/crida-logo54.png" width="180px"  class="img img-fluid ml-3 d-none d-lg-block">
                         
                        <ul class="navbar-nav ml-auto navbar-right-top">

                            @if(auth::user()->type != 0 )
                                <li class="nav-item" style="z-index:9999;">
                                    <div id="custom-search" class="top-search-bar">
                                        <form class="form" action="{{route('search')}}" method="post">
                                            @csrf
                                            <input class="form-control text-right" type="text" placeholder="... جستجو" name="search" required>
                                        </form>

                                    </div>
                                </li>
                            @endif

                            <li class="nav-item dropdown notification" id="cd-dropdown">
                                <a class="nav-link nav-icons" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-fw fa-bell fa-1x"></i> 
                                     <?php if($ind === 'rob'){echo '<span class="indicator"></span>';} ?> 
                                </a>
                                @include('layouts.notifications')
                                <li class="nav-item dropdown nav-user" id="user_dropdown">
                                    <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-fw fa-user"></i>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                        <div class="nav-user-info">
                                            <h5 class="mb-0 text-white nav-user-name">{{ Auth::user()->name }} - {{ Auth::user()->dept }} </h5>    
                                            <span class="status"></span><span class="ml-2">فعال <span class="indicator" style="background-color:#73f190;"></span></span>
                                    </div>
                                         
                                    <a class="dropdown-item" data-toggle="modal" data-target="#change_password" href="#"><i class="fas fa-user mr-2"></i>تغیر رمز عبور</a>
                                        


                                     <!-- Logout here -->
                                    <a class="dropdown-item" href="{{ route('logout') }}"    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-power-off mr-2"></i>خروج از سیستم</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                        
                                    </form>
                                     <!-- Logout here -->

                                    
                                </div>
                            </li>
                        </ul>
                    </div>
            </nav>
        </div>
    </div>
  <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- end navbar -->







      
        <!-- Modal used for shwoing change password for users -->
        
        <div class="modal fade " id="change_password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header ml-auto">
                        <h3 class="modal-title " id="exampleModalLabel">تغیر رمز عبور </h3>   
                    </div>
                    <div class="modal-body">
                            @if(Session::has('password_alert'))

                                     <p class="alert alert-danger">{{ Session::get('password_alert') }} <a href="#" class="close pl-2" data-dismiss="alert" aria-label="close">&times;</a></p>
                                @endif
                            <form action="{{url('/')}}/change_password" method="post" class="form">
                                {{csrf_field()}}
                                <input type ="password" class="form-control text-center @if ($errors->has('current_password')) {{ 'is-invalid' }}  @endif " placeholder=" رمز عبور فعلی" name="current_password" required>
                                    @if ($errors->has('current_password'))
                                         <span class="help-block">
                                            <strong style="color:#bd1515;">{{ $errors->first('current_password') }}</strong>
                                        </span>
                                    @endif
                                <input type ="password" class="form-control mt-2 text-center @if ($errors->has('new_password')) {{ 'is-invalid' }}  @endif" placeholder=" رمز عبور جدید" name="new_password" required>
                                   @if ($errors->has('new_password'))
                                         <span class="help-block">
                                            <strong style="color:#bd1515;">{{ $errors->first('new_password') }}</strong>
                                        </span>
                                    @endif
                                <input type ="password" class="form-control mt-2 text-center @if ($errors->has('confirm_new_password')) {{ 'is-invalid' }}  @endif" placeholder="تکرار رمز عبور جدید" name="confirm_new_password" required>
                                     @if ($errors->has('confirm_new_password'))
                                         <span class="help-block">
                                            <strong style="color:#bd1515;">{{ $errors->first('confirm_new_password') }}</strong>
                                        </span>
                                    @endif
                    </div>

                    <div class="modal-footer">
                        <a href="#" class="btn btn-primary" data-dismiss="modal">بستن</a>
                        <button type="submit" class="btn btn-primary"> تغیر رمز عبور </button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Modal used for shwoing authorized users ended -->

		
