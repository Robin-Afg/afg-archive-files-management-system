
@extends('layouts.master')


@section('styles')
<link rel="stylesheet" href="{{url('/')}}/assets/vendor/datatables/DataTables/css/jquery.dataTables.min.css">
<!-- 
<link rel="stylesheet" href="{{url('/')}}/assets/vendor/datatables/DataTables/css/dataTables.bootstrap4.min.css">

 -->
<link rel="stylesheet" href="{{url('/')}}/assets/vendor/datatables/Buttons/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="{{url('/')}}/assets/vendor/datatables/Buttons/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="{{url('/')}}/assets/vendor/datatables/FixedHeader/css/fixedHeader.dataTables.min.css">
<link rel="stylesheet" href="{{url('/')}}/assets/vendor/datatables/FixedHeader/css/fixedHeader.bootstrap4.min.css">

<!-- related to date picker -->
<link rel="stylesheet" type="text/css" href="{{url('/')}}/assets/vendor/pdatepicker/persian-datepicker.min.css">
<!-- related to date picker end -->
<style>

.ibox-content {
  background-color: #ffffff;
  color: inherit;
  padding: 15px 20px 20px 20px;
  border-color: #e7eaec;
  border-image: none;
  border-style: solid solid none;
  border-width: 1px 0;
}

</style>

@endsection
<!-------------------------- Main content here .... ---------------------------------------->
@section('content')

      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"> 
            <div class="col-4 ml-auto" >
                @include('layouts.msg')
            </div>

            <div class="col-md-12 ibox-content " dir="rtl">
                                
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="m-b-md ">
                                <h2 class="text-center font-weight-bold">جزییات پیشینه فعالیت </h2>
                            </div> 
                            <a href="{{url()->previous()}}" class="btn btn-white btn-xs pull-right"><span class="badge badge-danger"> برگشت </span> </a>
                            
                        
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-5 text-right">
                            <dl class="dl-horizontal">
                                
                                @if($activity->description == "updated")
                                    <dt> چگونگی عمل </dt><dd><span class="label label-primary">ویرایش شده</span></dd>
                                @endif
                                @if($activity->description == "created")
                                    <dt>چگونگی عمل </dt><dd> <span class="label label-success"> ایجاد شده </span></dd>
                                @endif
                                @if($activity->description == "deleted")
                                    <dt>چگونگی عمل </dt><dd> <span class="label label-danger">حذف شده</span></dd>
                                @endif
                                
                                <?php $user = App\Models\User::find($activity->causer_id);
                                    if($user){
                                        $username = $user->name;
                                    }else {
                                        $username = "Someone";
                                    }
                                ?>

                                <dt> توسط </dt><dd><span class="badge badge-info"> {{$username}} </span></dd>

                                <?php  
                                    use Illuminate\Support\Arr;
                                    $old = "";
                                    $current = "";
                                    $deleted = "";       
                                    if(count($activity->changes()) > 1){
                                        if(Arr::has($activity->changes(), 'attributes.comment')){
                                            $current =  $activity->changes['attributes']['comment'];
                                            $old =  $activity->changes['old']['comment'];
                                            $show_changes = true;
                                        }else{
                                            $show_changes = false;  
                                        }
                                    }
                                                              
                                    if(Arr::has($activity->properties, 'attributes.comment')){
                                        $deleted = $activity->properties['attributes']['comment'];
                                    }
                                    
                                    if(Arr::has($activity->properties, 'attributes.crida_number')){
                                        $crida_number = $activity->properties['attributes']['crida_number'];
                                        $rec_id = $activity->properties['attributes']['id'];
                                    } 


                                  
                                    ?>

                                @if(isset($show_changes))
                                    <dt>قبلی </dt><dd> {!! $old !!} </dd>
                                    <dt>فعلی </dt><dd> {!! $current !!} </dd>
                                @endif


                                @if($activity->description == "deleted")
                                    <dt>حذف شده </dt><dd> {!! $deleted !!} </dd>
                                @endif
                                    <dt> شماره ردیابی فعالیت </dt><dd> {{$activity->subject_id }}  </dd>
                                
                            </dl>
                        </div>
                        <div class="col-lg-2" id="cluster_info" >
                            <dl class="dl-horizontal text-right">

                                <dt> تاریخ انجام عمل </dt> <dd>{{ Helper::gr_to_hejri($activity->created_at) }}</dd>
                                <dt>زمان </dt> <dd dir="ltr"> 	{{ $activity->created_at->diffForHumans() }} </dd>
                                <dt class="mt-3"> نوع سند / عمل </dt> <dd > <span class="badge badge-success">	{{ $activity->log_name }} </span> </dd>
                            </dl>
                        </div>

                        @if(isset($crida_number))
                        <div class="col-lg-2" id="cluster_info" >
                            <dl class="dl-horizontal text-right">

                                <dt>   شماره سند </dt> <dd>{{ $crida_number }}</dd>
                                <dt>شماره مسلسل سند یا ای دی </dt> <dd dir="ltr"> 	{{ $rec_id }} </dd>
                                
                            </dl>
                        </div>
                        @endif



                    </div>
                </div>
                <div class="footer">
                         <span> یادداشت : در صورتی ردیابی اسناد و اجرات با دیپارتمنت حکومت داری خوب و دیجیتلی به تماس شوید </span>
                        <p>Call GEP : 153 </p>
                </div>
            </div>
            
                       

      
<span id="base_url" hidden>{{asset('/')}}</span>
@endsection




