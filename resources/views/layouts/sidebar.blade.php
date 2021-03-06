<style>

    .nav-left-sidebar .navbar-toggler {
        background-color: #fff0;
    }

    .dot {
        height: 10px;
        width: 10px;
        background-color: #21ae41;
        border-radius: 50%;
        display: inline-block;
    }
    .nav-left-sidebar{
        background-color:#174c81;
        
    }
    .sidebar-dark.nav-left-sidebar .navbar-nav .nav-link {
        color:#fff;
    }
    
    .sidebar-dark.nav-left-sidebar .nav-link i {
        color:#fff;
    }
    
    
    .sidebar-dark.nav-left-sidebar .navbar-nav .nav-link:focus, .sidebar-dark.nav-left-sidebar .navbar-nav .nav-link.active{
        background-color:#4082c4;
    }

    .sidebar-dark.nav-left-sidebar .navbar-nav .nav-link:hover{
        background-color:#4082c4;
    }

    .sidebar-dark.nav-left-sidebar .submenu .nav .nav-item .nav-link:hover{
        background-color:#174c81;
    }

     .menu-list {
        background-color:#174c81; 
     }
    .sidebar-dark .nav-divider {
        color:#fff;
        background-color:#315f8c;
        border-radius: 25px;
        margin-bottom:10px;
    }
    #online_users{
        color:#fff;
        font-size:13px;
        font-weight:lighter;
    }
    #developed_by{
        color:#fff;
        position: -webkit-sticky; /* Safari */
        position: absolute;
        bottom: 65px;
        left: 150px;
        font-size:10px;

    }

    .nav-left-sidebar .submenu {
        background-color:#4082c4;
    }
    .nav-left-sidebar .submenu :hover {
        background-color:#4082c4;
    }

   


</style>

  <!-- left sidebar -->
        <!-- ============================================================== -->
      <div class="nav-left-sidebar sidebar-dark" >
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">  <img src="{{url('/')}}/img/cridatransparent.png" width="180px"  class="img img-fluid ml-3 "></a>

                        <span class="fas fa-bars text-white navbar-toggler"  data-toggle="collapse" aria-controls="navbarNav" aria-expanded="false" data-target="#navbarNav"></span>
 
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider text-center">
                            <!-- <i class="fas fa-bars m-2">  </i>    --> ?????? ????
                            </li>
                           
                            @if(!Auth::user()->type === 1)
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('/')}}" data-toggle="collapse show" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class="fa fa-fw fa-file"></i>
                                    ???????? ???????? ????
                                </a>
                                <div id="submenu-2" class="collapse submenu show " style="">
                                   </div>
                            </li>
                            @endif

                        <!-- we are not showing it for others -->

                         
                            <!-- we are not showing it for others -->
                        
                        @if(Auth::user()->type === 1 || Auth::user()->type === 2)

                           <li class="nav-item">
                                <a class="nav-link text" href="#"  data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1"> <i class="fas fa-pencil-alt"></i><b>   ?????????? ????????  ?????????? </b></a>

                                     <div id="submenu-1" class="collapse submenu" style="">
                                        
                                        <ul class="nav flex-column text-center">
                                      
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('add_sadera')}}"> ??????  ??????????   </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('add_warada')}}">  ??????   ??????????    </a>     
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('add_peshnehad')}}">  ??????   ??????????????   </a>      
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('add_estelam')}}">  ??????  ??????????????     </a>
                                        </li>
                                        
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('add_ahkam')}}">  ??????  ??????????  ???????????? ?? ???????????? ????????????    </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('add_saderamali')}}">  ??????  ??????????  ????????    </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('add_report')}}">  ??????  ?????????? ????????????    </a>
                                        </li>
                                    </ul>
                                   </div>
                            </li>

                        @if(!(Auth::user()->type === 2 || Auth::user()->type === 0))

                            <li class="nav-item">
                                <a class="nav-link" href="#"  data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"> <i class="fas fa-users"></i><b>   ???????????? ?????????????? </b> </a>
                                    <div id="submenu-2" class="collapse submenu" style="">  
                                        <ul class="nav flex-column text-center">
                                
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{route('register')}}">  ?????????? ?????????? ?????????? ????????   </a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" href="{{route('panel_user')}}">  ???????????? ??????????????   </a>
                                            </li>
                                
                                        </ul>
                                    </div>
                            </li>

                        @endif
                          <!-- not showing this for archive users and normal users -->

                          <li class="nav-item">
                                <a class="nav-link" href="#"  data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"> <i class="far fa-copy"></i> <b> ???????????? ??????????   </b></a>

                                     <div id="submenu-3" class="collapse submenu" style="">
                                        
                                        <ul class="nav flex-column text-center">
                                      
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('panel_sadera')}}"> ???????????? ?????????? ????   </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('panel_warada')}}">  ???????????? ?????????? ????    </a>     
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('panel_peshnehad')}}">  ???????????? ?????????????? ????  </a>      
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('panel_estelam')}}"> ???????????? ?????????????? ????     </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('panel_ahkam')}}">   ???????????? ??????????  ???????????? ?? ???????????? ????????????    </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('panel_saderamali')}}"> ???????????? ?????????? ?????? ????????    </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('panel_report')}}">    ???????????? ?????????? ?????? ????????????    </a>
                                        </li>
                                    </ul>
                                   </div>
                            </li>
                            @endif
                            <!-- showing a menu for normal users  -->


                            @if(auth::user()->type == 3 )

                          <li class="nav-item">
                                <a class="nav-link" href="#"  data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"> <i class="far fa-copy"></i> <b> ?????????? ??????????   </b></a>

                                     <div id="submenu-3" class="collapse submenu" style="">
                                        
                                        <ul class="nav flex-column text-center">
                                      
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('panel_sadera')}}"> ?????????? ?????????? ????   </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('panel_warada')}}">  ?????????? ?????????? ????    </a>     
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('panel_peshnehad')}}">  ?????????? ?????????????? ????  </a>      
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('panel_estelam')}}"> ?????????? ?????????????? ????     </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('panel_ahkam')}}">   ?????????? ??????????  ???????????? ?? ???????????? ????????????    </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('panel_saderamali')}}"> ?????????? ?????????? ?????? ????????    </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('panel_report')}}"> ??????????  ?????????? ?????? ????????????      </a>
                                        </li>
                                    </ul>
                                   </div>
                            </li>

                            @endif


                            @if(auth::user()->type == 0 )
                                <li class="nav-item">
                                    <a class="nav-link" href="#"  data-toggle="collapse" aria-expanded="false" data-target="#submenu-4" aria-controls="submenu-4"> <i class="far fa-copy"></i><b>    ??????????  ??????????   </b></a>

                                        <div id="submenu-4" class="collapse submenu" style="">
                                            
                                            <ul class="nav flex-column text-center">
                                        
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{route('sadera')}}"> ?????????? ?????????? ????   </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{route('warada')}}">  ?????????? ?????????? ????    </a>     
                                            </li>   
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{route('peshnehad')}}">  ?????????? ?????????????? ????  </a>      
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{route('estelam')}}"> ?????????? ?????????????? ????     </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{route('ahkam')}}">   ?????????? ??????????  ???????????? ?? ???????????? ????????????    </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{route('saderamali')}}"> ?????????? ?????????? ?????? ????????    </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{route('report')}}"> ??????????   ?????????? ?????? ????????????    </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            @endif


                            <!-- showing a menu for normal users  -->
                            
                            <!-- Show activity log page -->
                            @if(Auth::user()->type === 1 || Auth::user()->type === 3)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('activity_log') }}"  aria-expanded="false" ><i class=" fab fa-firstdraft"></i>
                                   <b> ???????????? ???????????? ???? </b>
                                </a>
                            </li>
                            @endif


                            <!-- Show activity log page -->
                            @if(Auth::user()->type === 1)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('backup') }}"  aria-expanded="false" ><i class="fas fa-people-carry"></i>
                                   <b> ???????????? ???????? ?????? ?????????????? </b>
                                </a>
                            </li>
                            @endif




                             <!-- shows help page -->
                            
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('help') }}"  aria-expanded="false" ><i class=" fas fa-question"></i>
                                   <b> ?????????????? ?????????????? ???? ?????????? </b>
                                </a>
                            </li>
                         
                          

                            <!-- Log out form -->

                             <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}"  aria-expanded="false"  onclick="event.preventDefault(); document.getElementById('logout-form1').submit();">
                                <i class="fa fa-fw fas fa-undo"></i>
                                   <b> ???????? ???? ?????????? </b>
                                </a>
                                <form id="logout-form1" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                    
                                </form> 
                            </li>

                            <li class="nav-divider text-center" style="font-size: 80%; font-weight:lighter ;padding: 0px;margin: 12px 0px;margin-top: 12px;border-radius: 0px;background: none;text-align: left!important;border-bottom: 1px solid white;" >
                                <i class="fas fa-users m-2 fa-1x">  </i>  ?????????????? ???????? - <span id="online_users_count">   </span>
                            </li>
                            
                            <ul class="nav" id="online_users" >
                                
                            </ul>
                            
                           
                          

                            <!-- Log out form -->
                           


                       
                        </ul>
                    </div>
                    <!-- added recently -->
                        <!-- </li>
                        </ul>
                        </div> -->
                    <!-- added recently -->

              
                      
                           
                </nav> 
               
            </div>
            
        </div>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <span id="base_url" hidden>{{asset('/')}}</span>

<script src="{{url('/')}}/assets/vendor/jquery/jquery-3.3.1.min.js"></script>
<script>
    var base_url = $("#base_url").text();
    
    $( document ).ready(function() {
        get_online_users();
        
        setInterval(function(){ 
           get_online_users();
        }, 5000);

    });

    function get_online_users(){
        $.ajax({
                type: "GET",
                url: base_url + 'get_online_user',
                dataType: "json",
                data: $('#data-form').serialize(),
                success: function (response) {
                    $("#online_users").html(``);
                    $.each(response, function(key, user) {
                        $("#online_users").append(` 
                                                <li class="nav-item w-100 mb-1" > 
                                                        <i class="fas fa-user" style="color:#6eff6e;">  </i> 
                                                        <span><b> &nbsp; ${user} </b></span>
                                                      
                                                </li>
                        `);
                        var total = response.length;
                        $('#online_users_count').html(total);
                    });
                },
                error: function (xhr, status, errorThrown) {
                    
                }
            });

    }



</script>