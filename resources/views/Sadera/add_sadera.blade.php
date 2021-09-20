@extends('layouts.master')

<!--Title Reference -->
@section('active-menu-title')
Archive Files
@endsection
<!--Title Reference -->

@section('styles')
<link rel="stylesheet" type="text/css" href="{{url('/')}}/assets/vendor/pdatepicker/persian-datepicker.min.css">

<link rel="stylesheet" href="{{url('/')}}/select/dist/css/select2.min.css">
@endsection




@section('content')
<!-- intiaalizing the invalid variable -->
 <?php $er = "is-invalid"; ?>




<!-- Basic form -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                
                <div class="card">
                    <h1 class="card-header text-center">
                      <b> اضافه نمودن مکتوب صادره    </b>
                    </h1>

                    @include('layouts.msg')
                    <div class="card-body">
                     <form method="POST" action="{{route('save_sadera')}}" enctype="multipart/form-data" id="form_sadera">
                        {{csrf_field()}}


  <div class="row">   

      <div class="col">
             <div class="card text-right">
                <div class="card-header"><h3> آدرس   </h3></div>
                  <div class="card-body">
                    <div class="row ">

                    <div class="col ">
                              <label for="inputText3" class=" col-form-label">  کاپی به     </label>
                              <input id="inputText3" tabindex=4 type="text" class="form-control text-right  @if ($errors->has('copyto'))  <?php if(isset($er)){ echo $er;} ?> @endif " name="copyto" value="{{old('copyto')}}">
                              @if ($errors->has('copyto'))
                                  <span class="help-block">
                                        <strong style="color:#bd1515;">{{ $errors->first('copyto') }}</strong>
                                    </span>
                                @endif  
                    </div>

                      <div class="col ">
                              <label for="inputText3" class=" col-form-label">  مرسل الیه     </label>
                              <input id="inputText3" tabindex=4 type="text" class="form-control text-right  @if ($errors->has('mursal'))  <?php if(isset($er)){ echo $er;} ?> @endif " name="mursal_alia" value="{{old('mursal_alia')}}">
                              @if ($errors->has('mursal_alia'))
                                  <span class="help-block">
                                        <strong style="color:#bd1515;">{{ $errors->first('mursal_alia') }}</strong>
                                    </span>
                                @endif  
                        </div>

                      <div class="col">
                       <label for="inputText3" class="col-form-label"> 
                        مرسل     </label>
                        <input id="inputText3" tabindex=3 type="text" class="form-control text-right
                        @if ($errors->has('mursal'))  <?php if(isset($er)){ echo $er;} ?> @endif " name="mursal" value="{{old('mursal')}}">  
                        @if ($errors->has('mursal'))
                                  <span class="help-block">
                                        <strong style="color:#bd1515;">{{ $errors->first('mursal') }}</strong>
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
                         <label for="inputText3" class="col-form-label"> تاریخ   مکتوب   </label>
                        <input id="ca1" onKeyDown="return false" type="text" dir="rtl" tabindex=2 class="form-control text-right  @if ($errors->has('tarikh_maktoob'))  <?php if(isset($er)){ echo $er;} ?> @endif" name="tarikh_maktoob" value="{{old('tarikh_maktoob')}}">
                        @if ($errors->has('tarikh_maktoob'))
                                  <span class="help-block">
                                        <strong style="color:#bd1515;">{{ $errors->first('tarikh_maktoob') }}</strong>
                                    </span>
                                @endif   
                      </div>
                       
                      <div class="col">
                       <label for="inputText3" class="col-form-label"> 
                        شماره مسلسل     </label>
                        <input id="inputText3" type="number" class="form-control text-right @if ($errors->has('crida_number'))  <?php if(isset($er)){ echo $er;} ?> @endif " tabindex=1  name="crida_number" value="{{ $last_id  }}">          
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
      <div class="col-12">
             <div class="card text-right">
                <div class="card-header"><h3> خلص مطلب  </h3></div>
                  <div class="card-body">
                    <div class="row ">
                         <div class="col">
                           <label for="exampleFormControlTextarea1">  خلص مطلب </label>
                            <textarea tabindex=5 class="form-control text-right @if ($errors->has('kholas_matlab'))  <?php if(isset($er)){ echo $er;} ?> @endif " id="exampleFormControlTextarea1" rows="3" name="kholas_matlab">{{old('kholas_matlab')}}</textarea> 
                            @if ($errors->has('kholas_matlab'))
                                  <span class="help-block">
                                        <strong style="color:#bd1515;">{{ $errors->first('kholas_matlab') }}</strong>
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

       <div class="col-8">
             <div class="card text-right">
                <div class="card-header"><h3> محل  حفظ  و کاپی     </h3></div>
                  <div class="card-body">
                    <div class="row">
                       <div class="col">
                             <label for="inputText3" class="col-form-label"> 
                              محل      </label>
                              <input id="inputText3" tabindex=12 type="text" class="form-control text-right  @if ($errors->has('place'))  <?php if(isset($er)){ echo $er;} ?> @endif " name="place" value="{{old('place')}}" >          
                              @if ($errors->has('place'))
                                  <span class="help-block">
                                        <strong style="color:#bd1515;">{{ $errors->first('place') }}</strong>
                                    </span>
                                @endif  
                          </div>

                           <div class="col">
                           <label for="inputText3" class="col-form-label"> 
                            تاریخ       </label>
                            <input  type="text" onKeyDown="return false" id="ca2" tabindex=11 class="form-control text-right @if ($errors->has('date_of_archiving'))  <?php if(isset($er)){ echo $er;} ?> @endif" name="date_of_archiving" value="{{old('date_of_archiving')}}" >          
                            @if ($errors->has('date_of_archiving'))
                                  <span class="help-block">
                                        <strong style="color:#bd1515;">{{ $errors->first('date_of_archiving') }}</strong>
                                    </span>
                                @endif  
                        </div>
                        
                        <div class="col">
                            <label for="inputText3" class="col-form-label"> 
                             الماری      </label>
                            <input id="inputText3" type="text" tabindex=10 class="form-control text-right @if ($errors->has('almary'))  <?php if(isset($er)){ echo $er;} ?> @endif" name="almary" value="{{old('almary')}}">          
                            @if ($errors->has('almary'))
                              <span class="help-block">
                                    <strong style="color:#bd1515;">{{ $errors->first('almary') }}</strong>
                              </span>
                            @endif  
                        </div>

                        <div class="col">
                           <label for="inputText3" class="col-form-label"> 
                             نمبر دوسیه / کارتن    </label>
                            <input id="inputText3" type="text" tabindex=9 class="form-control text-right @if ($errors->has('num_of_dosia'))  <?php if(isset($er)){ echo $er;} ?> @endif " name="num_of_dosia" value="{{old('num_of_dosia')}}">          
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
                <div class="card-header"><h3> تعداد    </h3></div>
                  <div class="card-body">
                    <div class="row ">
                        
                         <div class="col">
                           <label for="inputText3" class="col-form-label"> 
                            ضمیمه     </label>
                            <input id="inputText3" type="text" tabindex=8 class="form-control text-right @if ($errors->has('zamema'))  <?php if(isset($er)){ echo $er;} ?> @endif" name="zamema" value="{{old('zamema')}}" >          
                            @if ($errors->has('zamema'))
                                  <span class="help-block">
                                        <strong style="color:#bd1515;">{{ $errors->first('zamema') }}</strong>
                                    </span>
                                @endif 
                        </div>
                      
                        <div class="col">
                           <label for="inputText3" class="col-form-label"> 
                             کاپی      </label>
                            <input id="inputText3" type="text" tabindex=7 class="form-control text-right @if ($errors->has('copy'))  <?php if(isset($er)){ echo $er;} ?> @endif" name="copy" value="{{old('copy')}}">          
                            @if ($errors->has('copy'))
                                  <span class="help-block">
                                        <strong style="color:#bd1515;">{{ $errors->first('copy') }}</strong>
                                    </span>
                                @endif 
                        </div>

                        <div class="col">
                           <label for="inputText3" class="col-form-label"> 
                              اصلی     </label>
                            <input id="inputText3" type="text" tabindex=6 class="form-control text-right @if ($errors->has('asal'))  <?php if(isset($er)){ echo $er;} ?> @endif" name="asal" value="{{old('asal')}}">          
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



  <div class="row mt-3">    

       <div class="col">
             <div class="card text-right">
                <div class="card-header"><h3>  ضمیمه نمودن فایل     </h3></div>
                  <div class="card-body">
                    <div class="row ">
                         
                      <div class="col  custom-file " style="margin-top: 60px; margin-left: 0px;">
                          
                          <div style="margin-top: -60px; padding:10px;"> 
                              <input type="text" tabindex=14 class="form-control text-right"  name="more" placeholder="یاداشت اضافی">
                          </div>
                              <div>
                                  <input type="file"  id="customFile" name="file" tabindex=15 class="form-control  text-right @if ($errors->has('file'))  <?php if(isset($er)){ echo $er;} ?> @endif" dir="rtl">
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



      <div class="col">
        <div class="card text-right">
          <div class="card-header"><h3>  چگونگی  مراجعه و اقدام    </h3></div>
            <div class="card-body">
              <div class="row ">
                    <div class="col">

                      <label for="exampleFormControlTextarea1"> مراجعه و اقدام  </label>
                      <textarea tabindex=13 class="form-control text-right @if ($errors->has('action'))  <?php if(isset($er)){ echo $er;} ?> @endif" id="exampleFormControlTextarea1" rows="3" name="action">{{old('action')}}</textarea> 
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
</div>

<!-- Accessing users on documents from add page       -->
<div class="row pt-3 float-right">
  <div class="col">
    <div class="card text-right">
      <div class="card-body">
        <div class="row ">
          <div class="col">

                <div class="form-group">
                  <label class="float-right"><b> &nbsp;&nbsp; لیست کاربران   </b> </label>
                  <select class="form-control" id="input-select" name="user_id[]" multiple="multiple">
                      <option></option> <!-- you may concatanate a lastname with name if you wanted -->
                      @foreach(App\Models\User::all() as $user)
                      <option value="{{$user->id}}">{{$user->name . ' - ' . $user->dept}}</option>
                      @endforeach
                  </select>
                </div>
                
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Accessing users on documents from add page       -->


<!---------------------------other section -------------------------->



                          <div class="form-group text-center mb-3 mt-3">
                              <input type="hidden" id="s_new" name=" ">
                              <button type="submit" class="btn btn-rounded btn-primary" name="save">  ذخیره نمودن فایل </button>
                              <a href="#" class="btn btn-rounded btn-primary" onclick="document.getElementById('s_new').name = 'save_and_new'; document.getElementById('form_sadera').submit();" name="save_and_new">    ذخیره نمودن فایل و صفحه جدید </a>
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
<script src="{{url('/')}}/select/dist/js/select2.min.js"></script>
    
    <script type="text/javascript">
      $(document).ready(function () {
        $('#input-select').select2({
          placeholder: "    کاربران را که میخواهید به این فایل دسترسی داشته باشند انتخاب نمایید    "
        });
      });
    </script>

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