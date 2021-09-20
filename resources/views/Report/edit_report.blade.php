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
                  <h1 class="card-header text-center">
                      <a href="<?php echo url()->previous(); ?>" class="btn btn-sm btn-outline-light text-primary float-left" > <i class="fas fa-2x fa-arrow-alt-circle-left">&nbsp; </i></a>  
                      <b> ویرایش گزارش تخنیکی      </b>
                  </h1> @include('layouts.msg')
                    
                    
                  <div class="card-body">
                    <form method="POST" action="{{url('edit_report')}}/{{$file->id}}" enctype="multipart/form-data">
                        {{csrf_field()}} {{ method_field('PUT') }}

         <div class="row">   

<div class="col">
       <div class="card text-right">
          <div class="card-header"><h3> معلومات فرعی   </h3></div>
            <div class="card-body">
              <div class="row ">

                

                <div class="col">
                  <label for="inputText3" class="col-form-label"> سال  </label>
                    <input id="ca2" onKeyDown="return false" type="text" tabindex=5 class="form-control text-right
                      @if ($errors->has('year'))  <?php if(isset($er)){ echo $er;} ?> @endif " name="year" value="{{$file->year}}">  
                      @if ($errors->has('year'))
                        <span class="help-block">
                              <strong style="color:#bd1515;">{{ $errors->first('year') }}</strong>
                          </span>
                      @endif        
                </div>

                <div class="col ">
                    <label for="inputText3" class=" col-form-label">  شماره تفصیلی گزارش     </label>
                    <input id="inputText3" tabindex=4 type="text" class="form-control text-right  @if ($errors->has('report_num'))  <?php if(isset($er)){ echo $er;} ?> @endif " name="report_num" value="{{$file->report_num}}">
                      @if ($errors->has('report_num'))
                        <span class="help-block">
                              <strong style="color:#bd1515;">{{ $errors->first('report_num') }}</strong>
                        </span>
                      @endif  
                </div>
                
                <div class="col">
                   <label for="inputText3" class="col-form-label">  اسم مولف  </label>
                   <input  type="text" tabindex=3 class="form-control text-right
                      @if ($errors->has('author'))  <?php if(isset($er)){ echo $er;} ?> @endif " name="author" value="{{ $file->author }}">  
                      @if ($errors->has('author'))
                        <span class="help-block">
                              <strong style="color:#bd1515;">{{ $errors->first('author') }}</strong>
                        </span>
                      @endif        
                </div>


                

              

                 
              
            </div>
         </div>
      </div>
    </div>




<div calss="col">
       <div class="card text-right">
          <div class="card-header"><h3> معلومات عمومی  </h3></div>
            <div class="card-body">
              <div class="row ">
              
               <div class="col">
                   <label for="inputText3" class="col-form-label">   تاریخ ثبت     </label>
                    <input id="ca3" onKeyDown="return false" type="text" tabindex=2 class="form-control text-right
                     @if ($errors->has('date_of_archiving'))  <?php if(isset($er)){ echo $er;} ?> @endif " name="date_of_archiving" value="{{ $file->date_of_archiving }}">  
                     @if ($errors->has('date_of_archiving'))
                        <span class="help-block">
                              <strong style="color:#bd1515;">{{ $errors->first('date_of_archiving') }}</strong>
                        </span>
                     @endif        
               </div>

               
               <div class="col">
                       <label for="inputText3" class="col-form-label"> شماره مسلسل     </label>
                        
                        <input id="inputText3" type="number" value="{{Helper::extract_number($file->crida_number)}}" class="form-control text-right @if ($errors->has('crida_number'))  <?php if(isset($er)){ echo $er;} ?> @endif "  name="crida_number">          
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



<div class="row mt-3">



<div class="col">
<div class="card text-right">
   <div class="card-header"><h3> آرشیف   </h3></div>
     <div class="card-body">
       <div class="row ">
            

           

           <div class="col">
               <label for="inputText3" class="col-form-label"> شماره تعدیل شده  </label>
               <input id="inputText3" type="text" tabindex=9 class="form-control text-right @if ($errors->has('revised_num'))  <?php if(isset($er)){ echo $er;} ?> @endif" name="revised_num" value="{{$file->revised_num}}" >          
                  @if ($errors->has('revised_num'))
                      <span class="help-block">
                            <strong style="color:#bd1515;">{{ $errors->first('revised_num') }}</strong>
                      </span>
                  @endif 
           </div>

           <div class="col">
               <label for="inputText3" class="col-form-label"> محل نگهداری  </label>
               <input id="inputText3" type="text" tabindex=8 class="form-control text-right @if ($errors->has('place'))  <?php if(isset($er)){ echo $er;} ?> @endif" name="place" value="{{$file->place}}" >          
                  @if ($errors->has('place'))
                      <span class="help-block">
                            <strong style="color:#bd1515;">{{ $errors->first('place') }}</strong>
                      </span>
                  @endif 
           </div>

           

           

          
           

     </div>
  </div>
</div>
</div>


<div class="col">
<div class="card text-right">
   <div class="card-header"><h3>   خلص مطلب     </h3></div>
     <div class="card-body">
       <div class="row">
         
            <div class="col">
                <textarea id="inputText3" type="text" tabindex=6 class="form-control text-right  @if ($errors->has('kholasmatlab'))  <?php if(isset($er)){ echo $er;} ?> @endif " name="kholasmatlab"  > {{$file->kholasmatlab}} </textarea>        
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

 <div class="col-md-6 ml-auto">
       <div class="card text-right">
          <div class="card-header"><h3>  ضمیمه نمودن فایل     </h3></div>
            <div class="card-body">
              <div class="row ">
                   
                <div class="col  custom-file " style="margin-top: 60px; margin-left: 0px;">
                    <div style="margin-top: -60px; padding:10px;"> 
                        <input type="text" tabindex=14 class="form-control text-right"  name="more" placeholder="یاداشت اضافی" value="{{$file->more}}">
                    </div>
                    <div>
                        <input type="file" tabindex=15 id="customFile" name="file"  class="form-control  text-right @if ($errors->has('file'))  <?php if(isset($er)){ echo $er;} ?> @endif" dir="rtl">
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
          <button type="submit" class="btn btn-rounded btn-primary" >  ویرایش   </button>
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

      $('#ca3').pDatepicker({
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

























































