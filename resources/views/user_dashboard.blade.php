@extends('layouts.master')
<!--Title Reference -->
@section('active-menu-title')
    Archive Files
@endsection

@section('styles')
<style>
           
   .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        color:#fff;
        background-clip: border-box;
        border: 1px solid rgba(0,0,0,0.125);
        border-radius: .5rem;
    }
    h3{
        color:#fff;
        font-weight:bold;
    }
    h1{
        
        font-weight:bold;
    }
    a:hover {
        color:#fff;
    }
    .w-75{
        color:#fff;  
    }
    .logo {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        font-size: 4rem;
        left: 1rem;
        color: rgba(255,255,255,0.4);
        transition: 0.15s all ease;
    }
    body{
        background-color:#fff;
    }

    .shadow-lg {
    box-shadow: 0 2rem 1.5rem -1.5rem rgba(33,37,41,0.15),0 0 1.5rem 0.5rem rgba(33,37,41,0.05) !important;
    }


</style>

@endsection
<!-------------------------- Main content here .... ---------------------------------------->
@section('content')
  <!-- hoverable table -->

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))

        <p class="alert text-right alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close pl-2" data-dismiss="alert" aria-label="close">&times;</a></p>
        @endif
    @endforeach
       
        <div class="row">
                             <div class="col-lg-4 col-md-8 mb-5 mb-lg-0 mx-auto">
                                <a href="{{route('sadera')}}" class="after-loop-item card border-0 card-snippets shadow-lg acard" style="background-color: #2092ed;">
                                    <div class="card-body d-flex align-items-end flex-column text-right">
                                       
                                        <h2 class="w-75"> رفتن به صادره ها </h2>
                                        <i class="fas fa-clipboard-check logo"></i> 
                                    </div>
                                </a>
                            </div>

                       

                            <div class="col-lg-4 col-md-8 mb-5 mb-lg-0 mx-auto">
                                <a href="{{route('warada')}}" class="after-loop-item card border-0 card-snippets shadow-lg acard" style="background-color: #ffc107;">
                                    <div class="card-body d-flex align-items-end flex-column text-right">
                                     
                                        <h2 class="w-75"> رفتن به وارده ها </h2>
                                        <i class="fas fa-file logo"></i> 
                                    </div>
                                </a>
                            </div>

                            <div class="col-lg-4 col-md-8 mb-5 mb-lg-0 mx-auto">
                                <a href="{{route('peshnehad')}}" class="after-loop-item card border-0 card-snippets shadow-lg acard" style="background-color: #28a745;">
                                    <div class="card-body d-flex align-items-end flex-column text-right">
                                     
                                        <h2 class="w-75"> رفتن به پیشنهاد ها  </h2>
                                        <i class="fas fa-folder-open logo"></i> 
                                    </div>
                                </a>
                            </div>
              </div>

              <div class="row mt-4">
                             <div class="col-lg-4 col-md-8 mb-5 mb-lg-0 mx-auto">
                                <a href="{{route('estelam')}}" class="after-loop-item card border-0 card-snippets shadow-lg acard" style="background-color: #127d8e;">
                                    <div class="card-body d-flex align-items-end flex-column text-right">
                                       
                                        <h2 class="w-75"> رفتن به استعلام ها  </h2>
                                        <i class="fas fa-tags logo"></i> 
                                    </div>
                                </a>
                            </div>

                       

                            <div class="col-lg-4 col-md-8 mb-5 mb-lg-0 mx-auto">
                                <a href="{{route('ahkam')}}" class="after-loop-item card border-0 card-snippets shadow-lg acard" style="background-color: #77540a;">
                                    <div class="card-body d-flex align-items-end flex-column text-right">
                                       
                                        <h2 class="w-75">رفتن به احکام و فرامین  </h2>
                                        <i class="far fa-handshake logo"></i> 
                                    </div>
                                </a>
                            </div>

                            <div class="col-lg-4 col-md-8 mb-5 mb-lg-0 mx-auto">
                                <a href="{{route('saderamali')}}" class="after-loop-item card border-0 card-snippets shadow-lg acard" style="background-color: #a72847;">
                                    <div class="card-body d-flex align-items-end flex-column text-right">
                                    
                                        <h2 class="w-75"> رفتن به صادره های مالی  </h2>
                                        <i class="fas fa-th-list logo"></i> 
                                    </div>
                                </a>
                            </div>
              </div>

              
              <div class="row mt-4">
                             <div class="col-lg-4 col-md-4 mb-5 mb-lg-0 mx-auto">
                                <a href="{{route('report')}}" class="after-loop-item card border-0 card-snippets shadow-lg acard" style="background-color: #f75511;">
                                    <div class="card-body d-flex align-items-end flex-column text-right">
                                        <h3>  رفتن به گزارش های تخنیکی  </h3>
                                       
                                        <i class="fab fa-firstdraft logo"></i> 
                                    </div>
                                </a>
                            </div>

                            
              </div>


           
              
    </div>
       
        
  
@endsection









