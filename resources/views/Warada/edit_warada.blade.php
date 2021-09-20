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
                    <b> ویرایش نمودن مکتوب وارده    </b></h1>
                    
                    @include('layouts.msg')
                    <div class="card-body">
    <form method="POST" action="{{url('edit_warada')}}/{{$files->id}}" enctype="multipart/form-data">
    {{csrf_field()}} {{ method_field('PUT') }}


  <div class="row">   

      <div class="col">
             <div class="card text-right">
                <div class="card-header"><h3> نمبر و تاریخ مکتوب وارده   </h3></div>
                  <div class="card-body">
                    <div class="row ">

                      <div class="col ">
                              <label for="inputText3" class=" col-form-label">  مدیریت     </label>
                              <input id="inputText3" tabindex=6 type="text" class="form-control text-right  @if ($errors->has('moderyat'))  <?php if(isset($er)){ echo $er;} ?> @endif " name="moderyat" value="{{$files->moderyat}}">
                              @if ($errors->has('moderyat'))
                                  <span class="help-block">
                                        <strong style="color:#bd1515;">{{ $errors->first('moderyat') }}</strong>
                                    </span>
                                @endif  
                        </div>

                      <div class="col">
                       <label for="inputText3" class="col-form-label"> 
                        ریاست     </label>
                        <input id="inputText3" tabindex=5 type="text" class="form-control text-right
                        @if ($errors->has('reyasat'))  <?php if(isset($er)){ echo $er;} ?> @endif " name="reyasat" value=" {{$files->reyasat}}">  
                        @if ($errors->has('reyasat'))
                                  <span class="help-block">
                                        <strong style="color:#bd1515;">{{ $errors->first('reyasat') }}</strong>
                                    </span>
                                @endif        
                        </div>
                        <div class="col ">
                              <label for="inputText3" class=" col-form-label"> مرسل     </label>
                              <input id="inputText3" tabindex=4 type="text" class="form-control text-right  @if ($errors->has('mursal'))  <?php if(isset($er)){ echo $er;} ?> @endif " name="mursal" value="{{$files->mursal}}">
                              @if ($errors->has('mursal'))
                                  <span class="help-block">
                                        <strong style="color:#bd1515;">{{ $errors->first('mursal') }}</strong>
                                    </span>
                                @endif  
                        </div>

                      <div class="col">
                       <label for="inputText3" class="col-form-label"> 
                       تاریخ     </label>
                        <input id="ca1" onKeyDown="return false" type="text" tabindex=3 class="form-control text-right
                        @if ($errors->has('date_of_warada'))  <?php if(isset($er)){ echo $er;} ?> @endif " name="date_of_warada" value="{{$files->date_of_warada}}">  
                        @if ($errors->has('date_of_warada'))
                                  <span class="help-block">
                                        <strong style="color:#bd1515;">{{ $errors->first('date_of_warada') }}</strong>
                                    </span>
                                @endif        
                        </div>

                        <div class="col ">
                              <label for="inputText3" class=" col-form-label"> نمبر     </label>
                              <input id="inputText3" tabindex=2 type="text" class="form-control text-right  @if ($errors->has('number_of_warada'))  <?php if(isset($er)){ echo $er;} ?> @endif " name="number_of_warada" value="{{$files->number_of_warada}}">
                              @if ($errors->has('number_of_warada'))
                                  <span class="help-block">
                                        <strong style="color:#bd1515;">{{ $errors->first('number_of_warada') }}</strong>
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
                       <label for="inputText3" class="col-form-label"> 
                        شماره مسلسل     </label>
                        <input id="inputText3" type="number" tabindex=1 class="form-control text-right @if ($errors->has('crida_number'))  <?php if(isset($er)){ echo $er;} ?> @endif "  name="crida_number" value="{{$crida_number}}">          
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
         <div class="card-header"><h3>   مراجعه و اقدام     </h3></div>
           <div class="card-body">
             <div class="row">
               
               
                <div class="col">
                     
                       <textarea id="inputText3" tabindex=10 type="text" class="form-control text-right  @if ($errors->has('action'))  <?php if(isset($er)){ echo $er;} ?> @endif " name="action"  > {{$files->action}} </textarea>        
                       @if ($errors->has('action'))
                           <span class="help-block">
                                 <strong style="color:#bd1515;">{{ $errors->first('action') }}</strong>
                             </span>
                         @endif  
                   </div>

                  
                 

           
               
           </div>
        </div>
     </div>

   </div>








<div class="col">
      <div class="card text-right">
         <div class="card-header"><h3> تعداد    </h3></div>
           <div class="card-body">
             <div class="row ">
                 
                  <div class="col">
                    <label for="inputText3" class="col-form-label"> 
                     ضمیمه     </label>
                     <input id="inputText3" type="text" tabindex=9 class="form-control text-right @if ($errors->has('zamema'))  <?php if(isset($er)){ echo $er;} ?> @endif" name="zamema" value="{{$files->zamema}}" >          
                     @if ($errors->has('zamema'))
                           <span class="help-block">
                                 <strong style="color:#bd1515;">{{ $errors->first('zamema') }}</strong>
                             </span>
                         @endif 
                 </div>
               
                 <div class="col">
                    <label for="inputText3" class="col-form-label"> 
                      کاپی      </label>
                     <input id="inputText3" type="text" tabindex=8 class="form-control text-right @if ($errors->has('copy'))  <?php if(isset($er)){ echo $er;} ?> @endif" name="copy" value=" {{$files->copy}}">          
                     @if ($errors->has('copy'))
                           <span class="help-block">
                                 <strong style="color:#bd1515;">{{ $errors->first('copy') }}</strong>
                             </span>
                         @endif 
                 </div>

                 <div class="col">
                    <label for="inputText3" class="col-form-label"> 
                    اصل     </label>
                     <input id="inputText3" type="text" tabindex=7 class="form-control text-right @if ($errors->has('asal'))  <?php if(isset($er)){ echo $er;} ?> @endif" name="asal" value=" {{$files->asal}}">          
                     @if ($errors->has('asal'))
                           <span class="help-block">
                                 <strong style="color:#bd1515;">{{ $errors->first('asal') }}</strong>
                             </span>
                         @endif 
                 </div>

                
                 
   
           </div>
        </div>
     </div></div>


 </div>
  


<!---------------------------other section -------------------------->





















<!---------------------------other section -------------------------->




  <div class="row mt-3">      
      <div class="col-12">
             <div class="card text-right">
                <div class="card-header"><h3> خلص مطلب  </h3></div>
                  <div class="card-body">
                    <div class="row ">
                         <div class="col">
                           <label for="exampleFormControlTextarea1">  خلص مطلب </label>
                            <textarea tabindex=11 class="form-control text-right @if ($errors->has('kholasmatlab'))  <?php if(isset($er)){ echo $er;} ?> @endif " id="exampleFormControlTextarea1" rows="3" name="kholasmatlab">{{$files->kholasmatlab}}</textarea> 
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



  <div class="col">
             <div class="card text-right">
                <div class="card-header"><h3>  تاریخ وارده      </h3></div>
                  <div class="card-body">
                    <div class="row ">
                         
                    <div class="col">
                    <label for="inputText3" class="col-form-label"> 
                           &nbsp;    </label>
                              <input id="ca2" onKeyDown="return false" type="text" tabindex=16 class="form-control text-right  @if ($errors->has('date_of_archiving'))  <?php if(isset($er)){ echo $er;} ?> @endif " name="date_of_archiving" value=" {{$files->date_of_archiving}}" >          
                              @if ($errors->has('date_of_archiving'))
                                  <span class="help-block">
                                        <strong style="color:#bd1515;">{{ $errors->first('date_of_archiving') }}</strong>
                                    </span>
                                @endif  
                          </div>
                      
                  </div>
               </div>
            </div>
          </div>


       <div class="col-8">
             <div class="card text-right">
                <div class="card-header"><h3> محل  حفظ  و کاپی     </h3></div>
                  <div class="card-body">
                    <div class="row">


                        <div class="col">
                          
                          <label for="inputText3" class="col-form-label"> 
                            محل      </label>
                            <input id="inputText3" type="text" tabindex=15 class="form-control text-right  @if ($errors->has('place'))  <?php if(isset($er)){ echo $er;} ?> @endif " name="place" value="{{$files->place}}" >          
                            @if ($errors->has('place'))
                                <span class="help-block">
                                      <strong style="color:#bd1515;">{{ $errors->first('place') }}</strong>
                                  </span>
                              @endif  
                        </div>


                        <div class="col">
                           <label for="inputText3" class="col-form-label"> 
                             الماری      </label>
                            <input id="inputText3" tabindex=14 type="text" class="form-control text-right @if ($errors->has('almary'))  <?php if(isset($er)){ echo $er;} ?> @endif" name="almary" value="{{$files->almary}}">          
                            @if ($errors->has('almary'))
                                  <span class="help-block">
                                        <strong style="color:#bd1515;">{{ $errors->first('almary') }}</strong>
                                    </span>
                                @endif  
                        </div>

                      

                          <div class="col">
                           <label for="inputText3" class="col-form-label"> 
                             نمبر دوسیه / کارتن    </label>
                            <input id="inputText3" tabindex=13 type="text" class="form-control text-right @if ($errors->has('num_of_dosia'))  <?php if(isset($er)){ echo $er;} ?> @endif " name="num_of_dosia" value="{{$files->num_of_dosia}}">          
                            @if ($errors->has('num_of_dosia'))
                                  <span class="help-block">
                                        <strong style="color:#bd1515;">{{ $errors->first('num_of_dosia') }}</strong>
                                    </span>
                                @endif 
                        </div>
                      
                        
                         
                        

                  
                      
                  </div>
               </div>
            </div>

          </div>








      <div class="col">
             <div class="card text-right">
                <div class="card-header"><h3>  مرسل الیه   </h3></div>
                  <div class="card-body">
                    <div class="row ">
                        
                         <div class="col">
                           <label for="inputText3" class="col-form-label"> 
                           &nbsp;    </label>
                            <input id="inputText3" tabindex=12 type="text" class="form-control text-right @if ($errors->has('mursal_alia'))  <?php if(isset($er)){ echo $er;} ?> @endif" name="mursal_alia" value="{{$files->mursal_alia}}" >          
                            @if ($errors->has('mursal_alia'))
                                  <span class="help-block">
                                        <strong style="color:#bd1515;">{{ $errors->first('mursal_alia') }}</strong>
                                    </span>
                                @endif 
                        </div>
                      
                       
                        
          
                  </div>
               </div>
            </div></div>

       
        </div>
         


<!---------------------------other section -------------------------->



  <div class="row mt-3">    

       <div class="col-md-6 ml-auto">
             <div class="card text-right">
                <div class="card-header"><h3>  ضمیمه نمودن فایل     </h3></div>
                  <div class="card-body">
                    <div class="row ">
                      <div class="col-7"> 
                          <p class=" alert alert-danger float-left text-right">
                          در صورتی که میخواهید فایل ضمیمه شده تغیر نکند این قسمت را دست نخورده گذارید
                                      <a href="#" class="close pl-2" data-dismiss="alert" aria-label="close">&times;</a>
                          </p>
                      </div> 
                      <div class="col  custom-file " style="margin-top: 60px; margin-left: 0px;">
                          
                          <div style="margin-top: -90px; padding:10px;"> 
                          <label for="inputText3" class="col-form-label"> 
                           یاداشت اضافی  </label>
                              <input type="text" tabindex=17 class="form-control text-right"  name="more" placeholder="یاداشت اضافی" value="{{$files->more}}">
                          </div>

                              <div style="margin-top: 0px; padding:10px;">
                                  <input type="file" tabindex=18  id="customFile" name="file"  class="form-control  text-right @if ($errors->has('file'))  <?php if(isset($er)){ echo $er;} ?> @endif" value="{{$files->file}}" dir="rtl">
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
                              <button type="submit" tabindex=19 class="btn btn-rounded btn-primary" >  ویرایش نمودن فایل </button>
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

























































