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
                      <b> ویرایش نمودن سند احکام    </b>
                  </h1> @include('layouts.msg')
                    
                    
  <div class="card-body">
     <form method="POST" action="{{url('edit_ahkam')}}/{{$file->id}}" enctype="multipart/form-data">
        {{csrf_field()}} {{ method_field('PUT') }}


        <div class="row">   

<div class="col">
       <div class="card text-right">
          <div class="card-header"><h3> معلومات عمومی   </h3></div>
            <div class="card-body">
              <div class="row ">

                <div class="col">
                   <label for="inputText3" class="col-form-label">  تاریخ این سند    </label>
                   <input id="ca1" onKeyDown="return false" type="text" tabindex=4 class="form-control text-right
                      @if ($errors->has('date_of_document'))  <?php if(isset($er)){ echo $er;} ?> @endif " name="date_of_document" value="{{Helper::gr_to_hejri($file->date_of_document)}}">  
                      @if ($errors->has('date_of_document'))
                        <span class="help-block">
                              <strong style="color:#bd1515;">{{ $errors->first('date_of_document') }}</strong>
                        </span>
                      @endif        
                </div>


                  <div class="col ">
                    <label for="inputText3" class=" col-form-label">  شماره این سند     </label>
                    <input id="inputText3" tabindex=5 type="text" class="form-control text-right  @if ($errors->has('number_of_document'))  <?php if(isset($er)){ echo $er;} ?> @endif " name="number_of_document" value="{{$file->number_of_document}}">
                      @if ($errors->has('number_of_document'))
                        <span class="help-block">
                              <strong style="color:#bd1515;">{{ $errors->first('number_of_document') }}</strong>
                        </span>
                      @endif  
                  </div>
                  
                


                <div class="col">
                  <label for="inputText3" class="col-form-label"> نوعیت این  </label>
                    <input  type="text" tabindex=3 class="form-control text-right
                      @if ($errors->has('type_of_document'))  <?php if(isset($er)){ echo $er;} ?> @endif " name="type_of_document" value="{{$file->type_of_document}}">  
                      @if ($errors->has('type_of_document'))
                        <span class="help-block">
                              <strong style="color:#bd1515;">{{ $errors->first('type_of_document') }}</strong>
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
                    <input id="ca2" onKeyDown="return false" type="text" tabindex=2 class="form-control text-right
                     @if ($errors->has('date_of_archiving'))  <?php if(isset($er)){ echo $er;} ?> @endif " name="date_of_archiving" value="{{Helper::gr_to_hejri($file->date_of_archiving)}}">  
                     @if ($errors->has('date_of_archiving'))
                        <span class="help-block">
                              <strong style="color:#bd1515;">{{ $errors->first('date_of_archiving') }}</strong>
                        </span>
                     @endif        
               </div>


              <div class="col">
                   <label for="inputText3" class="col-form-label">   شماره مسلسل     </label>
                   <input id="inputText3" type="number" tabindex=1 class="form-control text-right @if ($errors->has('crida_number'))  <?php if(isset($er)){ echo $er;} ?> @endif "  name="crida_number" value="{{ Helper::extract_number($file->crida_number)}}">          
                   @if ($errors->has('crida_number'))
                      <span class="help-block">
                            <strong style="color:#bd1515;">{{ $errors->first('crida_number') }}</strong>
                      </span>
                   @endif  
              </div>

                
            </div>
         </div>
      </div></div>

     
</div>













<!---------------------------other section -------------------------->



<div class="row mt-3">

<div class="col">
<div class="card text-right">
    <div class="card-header"><h3>   ملاحظات     </h3></div>
      <div class="card-body">
        <div class="row">
          
            <div class="col">
                <textarea id="inputText3" type="text" tabindex=6 class="form-control text-right  @if ($errors->has('molahezat'))  <?php if(isset($er)){ echo $er;} ?> @endif " name="molahezat"  > {{$file->molahezat}} </textarea>        
                  @if ($errors->has('molahezat'))
                      <span class="help-block">
                            <strong style="color:#bd1515;">{{ $errors->first('molahezat') }}</strong>
                      </span>
                  @endif  
              </div>

      </div>
  </div>
</div>
</div>



<div class="col">
<div class="card text-right">
    <div class="card-header"><h3>   موضوع    </h3></div>
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
                              <input type="text" tabindex=14 class="form-control text-right"  name="more" placeholder="یاداشت اضافی" value="{{$file->more}}" >
                      </div>

                      <div>
                          <input type="file" tabindex=15 id="customFile" name="file"  class="form-control  text-right @if ($errors->has('file'))  <?php if(isset($er)){ echo $er;} ?> @endif" dir="rtl" value="{{$file->file}}">
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
                  <button type="submit" class="btn btn-rounded btn-primary" >  ذخیره نمودن فایل </button>
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

























































