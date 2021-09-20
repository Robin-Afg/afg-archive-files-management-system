<?php 
use App\User;
?>
@extends('layouts.master')
@section('dir')

@endsection


<!--Title Reference -->
@section('active-menu-title')
Archive Files
@endsection
<!--Title Reference -->


@section('content')

<!-- Basic form -->
<?php $er = "is-invalid"; ?>


<div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                
                <div class="card">
                  <h1 class="card-header text-center"> <b> نمایش مکتوب وارده    </b>
                  @if(Auth::user()->type == 1 || Auth::user()->type == 2)
                    <div class="btn-group dropright float-left">
                      <button type="button" class="btn btn-primary dropdown-toggle font-weight-bold" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        عملیات  
                      </button>
                      <div class="dropdown-menu text-right">
                        <!-- Dropdown menu links -->
                        <a class="dropdown-item" href="{{url('panel_warada/update',['file' => $files->id])}}">  ویرایش</a>
                        <a class="dropdown-item" href="{{route('panel_warada/access',['file' => $files->id])}}">  دسترسی دادن </a>
                        <!-- <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">  حذف  </a> -->
                      </div>
                    </div>
                    @endif
                     </h1>
                    
                    @include('layouts.msg')
                    <div class="card-body">


  <div class="row">   

      <div class="col">
             <div class="card text-right">
                <div class="card-header"><h3> نمبر و تاریخ مکتوب وارده   </h3></div>
                  <div class="card-body">
                    <div class="row ">

                      <div class="col ">
                              <label for="inputText3" class=" col-form-label">  مدیریت     </label>
                              <input id="inputText3"  type="text" dir="rtl" class="form-control text-right" name="moderyat" value="{{$files->moderyat}}" readonly>
                           
                        </div>

                      <div class="col">
                       <label for="inputText3" class="col-form-label"> 
                        ریاست     </label>
                        <input id="inputText3"  dir="rtl" type="text" class="form-control text-right
                        @if ($errors->has('reyasat'))  <?php if(isset($er)){ echo $er;} ?> @endif " name="reyasat" value="{{$files->reyasat}}" readonly>  
                             
                        </div>
                        <div class="col ">
                              <label for="inputText3" class=" col-form-label"> مرسل     </label>
                              <input id="inputText3"  type="text" class="form-control" dir="rtl" name="mursal" value="{{$files->mursal}}" readonly>
                              
                        </div>

                      <div class="col">
                       <label for="inputText3" class="col-form-label"> 
                       تاریخ     </label>
                        <input id="ca1" type="text"  class="form-control text-right" name="date_of_warada" value="{{Helper::gr_to_hejri($files->date_of_warada)}}" readonly>  
                        
                        </div>

                        <div class="col ">
                              <label for="inputText3" class=" col-form-label"> نمبر     </label>
                              <input id="inputText3"  type="text" class="form-control text-right" name="number_of_warada" value="{{$files->number_of_warada}}" readonly>
                             
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
                    
                       
                      <div class="col-md-8 ml-auto">
                        <label for="inputText3" class="col-form-label">  شماره مسلسل     </label>  
                        <input id="inputText3" type="number" class="form-control text-right"  name="crida_number" value="{{Helper::extract_number($files->crida_number)}}" readonly>          
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
                     
                       <textarea id="inputText3" type="text" class="form-control text-right" name="action" readonly > {{$files->action}}  </textarea>        
                      
                       
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
                     <input id="inputText3" type="text" class="form-control text-right" name="zamema" value="{{$files->zamema}}" readonly >          
                    
                 </div>
               
                 <div class="col">
                    <label for="inputText3" class="col-form-label"> 
                      کاپی      </label>
                     <input id="inputText3" type="text" class="form-control text-right" name="copy" value="{{$files->copy}}" readonly>          
                     
                 </div>

                 <div class="col">
                    <label for="inputText3" class="col-form-label"> 
                    اصل     </label>
                     <input id="inputText3" type="text" class="form-control text-right" name="asal" value="{{$files->asal}}" readonly>          
                     
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
                            <textarea class="form-control text-right " id="exampleFormControlTextarea1" rows="3" name="kholasmatlab" readonly> {{$files->kholasmatlab}} </textarea> 
                          
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
                              <input id="ca2" type="text" class="form-control text-right" name="date_of_archiving" value="{{Helper::gr_to_hejri($files->date_of_archiving)}}" readonly >          
                              
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
                            <input id="inputText3" type="text" class="form-control text-right" name="place" value="{{$files->place}}" readonly >          
                          
                        </div>


                        <div class="col">
                           <label for="inputText3" class="col-form-label"> 
                             الماری      </label>
                            <input id="inputText3" type="text" class="form-control text-right" name="almary" value="{{$files->almary}}" readonly>          
                            
                        </div>

                      

                          <div class="col">
                           <label for="inputText3" class="col-form-label"> 
                             نمبر دوسیه / کارتن    </label>
                            <input id="inputText3" type="text" class="form-control text-right" name="num_of_dosia" value="{{$files->num_of_dosia}}" readonly>          
                           
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
                            <input id="inputText3" type="text" class="form-control text-right" name="mursal_alia" value="{{$files->mursal_alia}}" readonly>          
                          
                        </div>
                      
                       
                        
          
                  </div>
               </div>
            </div></div>

       
        </div>
         


<!---------------------------other section -------------------------->



  <div class="row mt-3">    

  <div class="col-10 ml-auto">
             <div class="card text-right">
                <div class="card-header"><h3>  فایل ضمیمه شده      </h3></div>
                  <div class="card-body">
                    <div class="row ">
                        <div style="margin-top: 0px; padding-left:8px;"> 
                            <label>  یاداشت اضافی</label>
                            <textarea  cols="30" rows=" 3" class="form-control text-right"   name="more" placeholder="یاداشت اضافی" readonly> {{$files->more}}  </textarea>
                         </div>

                         
  <!---------------------------- access section of user -------------------------------------------------------->    
                      <div class="col mt-4 mb-5">
                        <div class="dropdown">
                          <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            قابل دسترس برای
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @foreach($files->authorizedUsers as $row)
                              <li class="dropdown-item">{{$row->user->name}} | {{$row->user->dept}} </li>
                            @endforeach  
                          </div>
                        </div>
                      </div>  
 <!------------------------------------------------------ access section of user ---------------------------->  
                    
                          

                          <div class="col mt-4 mb-5">
                          <!-- ِSecurely downloading file related file with form -->
                              <form action="{{url('/show_warada/'.$files->uuid.'/Download')}}" method="post">
                                     {{csrf_field()}}
                                    <input type="hidden" value="{{ session('s_key') }}" name="exchange_key">
                                    <button type="submit" class="btn btn-default btn-primary float-right fa fa-download">&nbsp;دریافت فایل </button>
                              </form>
                          </div>
                  </div>
               </div>
            </div>
          </div>




         


         
</div>
         
<!---------------------------other section -------------------------->



                        

                        
                      </form>
                  </div>
              </div>
          </div>
      </div>
















          
     <!-- ============================================================== -->
                        <!-- end basic form  -->
                                         







<div class="card col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-3" dir="rtl">
  <div class="card-header">
    <h2 class="text-center ">  <span class="fa fa-star"> &nbsp;</span>اجرات کاربران در مورد این فایل      </h2></div>
  
  <div class="card-body">
    
     <div style="overflow-y: scroll; max-height:400px;" class="col-12" >    
      @foreach($files->comments->sortByDesc('id') as $comment)  

      <div class="review-block border-bottom mt-3 pt-3 text-right" >
            
                  <img src="{{url('/')}}/img/user.png"  style="width:3%; display:block; padding-bottom:2px;" class="float-right" > 
                  <h3 class="text-dark font-weight-bold mt-3"> &nbsp;&nbsp;&nbsp;&nbsp;{{(App\Models\User::find($comment->user_id))->name}}</h3>
          
                  <div  class="ml-auto" >
                    <small class="text-mute" sytle="margin-right:-50px;"> دیپارتمنت :  {{(App\Models\User::find($comment->user_id))->dept}} </small>   
                  </div>


                  <div dir="ltr">
                     <small class="text-mute" style="opacity:0.5;"> {{$comment->created_at->diffForHumans()}} <span dir="rtl"> ایجاد شده :  </span> </small>
                  
                     <small class="text-mute" style="opacity:0.5;"> &nbsp;&nbsp; {{$comment->updated_at->diffForHumans()}}   <span dir="rtl"> بروز شده :  </span>
                       </small>
                  </div>

                  <!---------------------- EDIT and DELETE Section ---------------------------->
                  <div class="float-left">
                      @if($comment->user_id === Auth::user()->id) <!--handels that a user can only edit or delete his or her own comment -->
                          <button href="#" class="btn btn-xs btn-rounded btn-primary" data-toggle="modal" data-target="#editform{{$comment->id}}"> ویرایش    </button>
                      @endif
                      @if(Auth::user()->id === 1 || $comment->user_id === Auth::user()->id) <!-- shows delete button for admin and the user who posted the comment -->
                          <form method="post" style="display:inline;" action="{{route('panel_warada.view.delete_comment', $comment->id)}}">
                            <input type="hidden" name="user_id" value="{{$comment->user_id}}">
                            {{csrf_field()}}
                          <button class="btn btn-sm btn-rounded btn-primary" type="submit">  حذف    </button> 
                          </form>
                      @endif
                  </div>
                  <!---------------------- EDIT and DELETE Section ---------------------------->
                        

                  <?php  if(Auth::user()->id == $comment->user_id){ $font = "text-primary"; } else { $font = " ";} ?>
                  <p  class="review-text font-italic m-0 mt-3 <?php echo $font; ?>">&nbsp;&nbsp;&nbsp; {!!$comment->comment!!} </p>



 <!------------------------- Editing comments - user can edit their comments section ------------------>

                               <div class="modal fade" id="editform{{$comment->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" dir="ltr">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header ml-auto" >
                                            <h3 class="modal-title" id="exampleModalLabel"> ویرایش نظر   </h3>
                                            
                                        </div>
                                        <div class="modal-body">
                                              <form method="post" action="{{route('edit_comment_warada')}}">
                                                  {{csrf_field()}} {{ method_field('PUT') }}
                                                  <input type="hidden" name="comment_id" value="{{$comment->id}}">
                                                  <input type="hidden" name="user_id" value="{{$comment->user_id}}">
                                            <textarea name="comment" class="form-control text-right comment_editor">{!!$comment->comment!!}</textarea>
                                        </div>
                                        <div class="modal-footer" >
                                            <a href="#" class="btn btn-primary" data-dismiss="modal">بستن  </a>
                                            <button type="submit" class="btn btn-primary">ثبت  تغیرات </button> 
                                          </form>
                                        </div>
                                    </div>
                                </div>
                              </div>
<!------------------------- Editing comments - user can edit their comments section end ------------------>



        </div>
     @endforeach 
  </div>
</div>






                                    
<!--  ********************************* section post comment ******************************** -->
  <center>
   <div class="col-10 mb-3">
     <form method="POST" action="{{route('warada_comment')}}">
     
             {{csrf_field()}}
                                               
        
                  <div class="row">
                      <div class="col-8">
                        <textarea id="editor" name="comment" class="form-control text-right  @if ($errors->has('comment'))  <?php if(isset($er)){ echo $er;} ?> @endif "   placeholder="نظر خویش را بنویسید  "  ></textarea>
                        @if ($errors->has('comment'))
                                  <span class="help-block">
                                        <strong style="color:#bd1515;">{{ $errors->first('comment') }}</strong>
                                    </span>
                        @endif  
                      
                      </div>
                       <div class="col-4" >         
                          <button type="submit" class="btn btn-primary text-center">افزوذن نظر </button><input type="hidden" value="{{$files->id}}" name="warada_id" >
                       </div>
                   </div>                   
        
       </form>                                 
    </div>
    </center>            
 <!--  ********************************* section post comment ******************************** -->

</div>






@endsection



@section('scripts')



<script src="{{url('/')}}/js/tinymce/tinymce.min.js"></script>

<script>
  var editor_config = {
    path_absolute : "/",
    selector: "textarea#editor",
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    relative_urls: false,
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
      });
    }
  };

  tinymce.init(editor_config);
</script>



<script>
  var editor_config = {
    path_absolute : "/",
    selector: "textarea.comment_editor",
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar: "insert file undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    relative_urls: false,
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
      });
    }
  };

  tinymce.init(editor_config);
</script>



<!-- related to ckEditor -->
<!-- <script type="text/javascript" src="{{url('/')}}/js/ckeditor.js"></script>
<script>
  ClassicEditor
          .create( document.querySelector( '#editor' ) )
          .then( editor => {
                  console.log( editor );
          } )
          .catch( error => {
                  console.error( error );
          } );
</script>

<script>
  ClassicEditor
          .create( document.querySelector( '#editor2' ) )
          .then( editor => {
                  console.log( editor );
          } )
          .catch( error => {
                  console.error( error );
          } );
</script> -->
@endsection
 



