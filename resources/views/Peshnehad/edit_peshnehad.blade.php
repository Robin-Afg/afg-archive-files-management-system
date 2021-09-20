@extends('layouts.master')
<!--Title Reference -->
@section('active-menu-title')
Archive Files
@endsection
<!--Title Reference -->

@section('styles')
<link rel="stylesheet" type="text/css" href="{{url('/')}}/assets/vendor/pdatepicker/persian-datepicker.min.css">
@endsection




@section('content')


<!-- intiaalizing the invalid variable -->
<?php $er = "is-invalid"; ?>




<!-- Basic form -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                
                <div class="card">
                    <h1 class="card-header text-center"><b> اضافه نمودن فایل پیشنهاد    </b></h1>
                       @include('layouts.msg')
                    
                  
                   
<div class="card-body">

    <form method="POST" action="{{url('edit_peshnehad')}}/{{$file->id}}" enctype="multipart/form-data" id="form_peshnehad">
        {{csrf_field()}} {{ method_field('PUT') }}


  <div class="row">   

      <div class="col">
             <div class="card text-right">
                <div class="card-header"><h3> معلومات عمومی    </h3></div>
                  <div class="card-body">
                    <div class="row ">

                      <div class="col ">
                              <label for="inputText3" class=" col-form-label">  آدرس پیشنهاد کننده     </label>
                              <input id="inputText3" tabindex=4 type="text" class="form-control text-right  @if ($errors->has('add_of_peshnehader'))  <?php if(isset($er)){ echo $er;} ?> @endif " name="add_of_peshnehader" value="{{$file->add_of_peshnehader}}">
                              @if ($errors->has('add_of_peshnehader'))
                                  <span class="help-block">
                                        <strong style="color:#bd1515;">{{ $errors->first('add_of_peshnehader') }}</strong>
                                    </span>
                                @endif  
                        </div>

                      <div class="col">
                          <label for="inputText3" class="col-form-label">   تاریخ ثبت      </label>                                                      
                          <input id="ca2" onKeyDown="return false" type="text" tabindex=2 class="form-control text-right
                              @if ($errors->has('date_of_archiving'))  <?php if(isset($er)){ echo $er;} ?> @endif " name="date_of_archiving" value="{{Helper::gr_to_hejri($file->date_of_archiving)}}">  
                              @if ($errors->has('date_of_archiving'))
                                <span class="help-block">
                                      <strong style="color:#bd1515;">{{ $errors->first('date_of_archiving') }}</strong>
                                  </span>
                              @endif        
                      </div>

                      <div class="col">
                         <label for="inputText3" class="col-form-label">   تاریخ پیشنهاد      </label>                                                      
                             <input id="ca1" onKeyDown="return false" type="text" tabindex=3 class="form-control text-right
                                @if ($errors->has('date_of_peshnehad'))  <?php if(isset($er)){ echo $er;} ?> @endif " name="date_of_peshnehad" value="{{Helper::gr_to_hejri($file->date_of_peshnehad)}}">  
                                @if ($errors->has('date_of_peshnehad'))
                                  <span class="help-block">
                                        <strong style="color:#bd1515;">{{ $errors->first('date_of_peshnehad') }}</strong>
                                    </span>
                                @endif        
                        </div>

                        


                        <div class="col">
                           <label for="inputText3" class="col-form-label">  شماره مسلسل     </label>
                              <input id="inputText3" tabindex=1 type="number" class="form-control text-right @if ($errors->has('crida_number'))  <?php if(isset($er)){ echo $er;} ?> @endif "  name="crida_number" value="{{Helper::extract_number($file->crida_number)}}">          
                                @if ($errors->has('crida_number'))
                                  <span class="help-block">
                                        <strong style="color:#bd1515;">{{ $errors->first('crida_number') }}</strong>
                                    </span>
                                @endif  
                        </div>

                       
                    
                  </div>
               </div>
            </div>
          </div>

</div>

<!---------------------------other section -------------------------->



<!---------------------------other section -------------------------->




<div class="row mt-3">     
      
         
          <div class="col-6">
             <div class="card text-right">
                <div class="card-header"><h3> ارسال به شعبه مربوطه  </h3></div>
                  <div class="card-body">
                    <div class="row ">
                    <div class="col">
                           <label for="exampleFormControlTextarea1"> ارسال به شعبه مربوطه </label>
                            <textarea tabindex=6 class="form-control text-right @if ($errors->has('to'))  <?php if(isset($er)){ echo $er;} ?> @endif " id="exampleFormControlTextarea1" rows="3" name="to">{{$file->to}}</textarea> 
                            @if ($errors->has('to'))
                                  <span class="help-block">
                                        <strong style="color:#bd1515;">{{ $errors->first('to') }}</strong>
                                    </span>
                                @endif
                           </div>

                  </div>
               </div>
            </div>
          </div>



          <div class="col-6">
             <div class="card text-right">
                <div class="card-header"><h3> خلص مطلب  </h3></div>
                  <div class="card-body">
                    <div class="row ">
                         <div class="col">
                           <label for="exampleFormControlTextarea1">  خلص مطلب </label>
                            <textarea tabindex=5 class="form-control text-right @if ($errors->has('kholasmatlab'))  <?php if(isset($er)){ echo $er;} ?> @endif " id="exampleFormControlTextarea1" rows="3" name="kholasmatlab">{{$file->kholasmatlab}}</textarea> 
                            @if ($errors->has('kholasmatlab'))
                                  <span class="help-block">
                                        <strong style="color:#bd1515;">{{ $errors->first('kholasmatlab') }}</strong>
                                    </span>
                                @endif
                           </div>
                    </div>
                 </div>
            </div>
          </div>


</div>
         
<!---------------------------other section -------------------------->



<!---------------------------other section -------------------------->


<div class="row mt-3">

<div class="col">
      <div class="card text-right">
         <div class="card-header"><h3> تعداد    </h3></div>
           <div class="card-body">
             <div class="row ">
             
             
             
                  <div class="col">
                    <label for="inputText3" class="col-form-label">  تسلیمی     </label>
                       <input id="inputText3" tabindex=10 type="text" class="form-control text-right @if ($errors->has('taslemi'))  <?php if(isset($er)){ echo $er;} ?> @endif" name="taslemi" value="{{$file->taslemi}}">          
                          @if ($errors->has('taslemi'))
                           <span class="help-block">
                                 <strong style="color:#bd1515;">{{ $errors->first('taslemi') }}</strong>
                             </span>
                          @endif 
                   </div>


                  <div class="col">
                    <label for="inputText3" class="col-form-label">  ضمیمه     </label>
                      <input id="inputText3" tabindex=9 type="text" class="form-control text-right @if ($errors->has('zamema'))  <?php if(isset($er)){ echo $er;} ?> @endif" name="zamema" value="{{$file->zamema}}">          
                         @if ($errors->has('zamema'))
                           <span class="help-block">
                                 <strong style="color:#bd1515;">{{ $errors->first('zamema') }}</strong>
                             </span>
                         @endif 
                  </div>

               
                 <div class="col">
                    <label for="inputText3" class="col-form-label">  کاپی      </label>
                       <input id="inputText3" tabindex=8 type="text" class="form-control text-right @if ($errors->has('copy'))  <?php if(isset($er)){ echo $er;} ?> @endif" name="copy" value="{{$file->copy}}">          
                         @if ($errors->has('copy'))
                           <span class="help-block">
                                 <strong style="color:#bd1515;">{{ $errors->first('copy') }}</strong>
                             </span>
                         @endif 
                  </div>

                 <div class="col">
                    <label for="inputText3" class="col-form-label">  اصل     </label>
                     <input id="inputText3" tabindex=7 type="text" class="form-control text-right @if ($errors->has('asal'))  <?php if(isset($er)){ echo $er;} ?> @endif" name="asal" value="{{$file->asal}}">          
                        @if ($errors->has('asal'))
                              <span class="help-block">
                                    <strong style="color:#bd1515;">{{ $errors->first('asal') }}</strong>
                                </span>
                         @endif 
                 </div>
   
   
           


            </div>
         </div>
       </div>
     </div>



 </div>
  


<!---------------------------other section -------------------------->






  <div class="row mt-3">    

       <div class="col-md-6 ml-auto">
             <div class="card text-right">
                <div class="card-header"><h3>  ضمیمه نمودن فایل     </h3></div>
                  <div class="card-body">
                    <div class="row ">
                      <div class="col-5"> 
                          <p class=" alert alert-danger float-left text-right">
                                در صورتی که میخواهید فایل ضمیمه شده تغیر نکند این قسمت را دست نخورده گذارید
                                <a href="#" class="close pl-2" data-dismiss="alert" aria-label="close">&times;</a>
                          </p>
                      </div>


                          <div class="col  custom-file " style="margin-top: 60px; margin-left: 0px;">

                              <div style="margin-top: -60px; padding:10px;"> 
                                  <input type="text" tabindex=11 class="form-control text-right"  name="more" placeholder="یاداشت اضافی" value="{{$file->more}}">
                              </div>

                              <div>
                                  <input type="file" tabindex=12 id="customFile" name="file"  class="form-control  text-right @if ($errors->has('file'))  <?php if(isset($er)){ echo $er;} ?> @endif" dir="rtl" value="{{$file->file}}">
                              </div>
                                @if ($errors->has('file'))
                                  <span class="help-block">
                                        <strong style="color:#bd1515;">{{ $errors->first('file') }}</strong>
                                    </span>
                                @endif                   
                           </div>



                  </div>
               </div>
            </div>
          </div>
         
</div>
         
<!---------------------------other section -------------------------->

          <div class="form-group text-center mb-3 mt-3">
              <button type="submit" class="btn btn-rounded btn-primary" name="save">  ویرایش فایل </button>
          </div>

                    
                      </form>
                  </div>
              </div>
          </div>
      </div>
<!-- ============================================================== -->
<!-- end basic form  -->



@endsection




@section('scripts')

<script type="text/javascript" src="{{url('/')}}/assets/vendor/pdatepicker/persian-date.js"></script>
<script type="text/javascript" src="{{url('/')}}/assets/vendor/pdatepicker/persian-datepicker.js"></script>


<script type="text/javascript">
  $(document).ready(function() {
    
      $('#ca1').pDatepicker({
        format: 'YYYY-MM-DD',
        showHint:true,
        toolbox:{
            calendarSwitch:false,
          },
        calendar:{
          'gregorian': {
            'locale': 'en',
            'showHint': true
            }
          }  
      });

      $('#ca2').pDatepicker({
        format: 'YYYY-MM-DD',
        showHint:true,
        toolbox:{
            calendarSwitch:false,
          },
        calendar:{
          'gregorian': {
            'locale': 'en',
            'showHint': true
            }
          }  
      });


  });
</script>

@endsection

























































