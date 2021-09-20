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
          <h1 class="card-header text-center"><b> نمایش فایل صادره مالی      </b>
                @if(Auth::user()->type == 1 || Auth::user()->type == 2)
                <div class="btn-group dropright float-left">
                    <button type="button" class="btn btn-primary dropdown-toggle font-weight-bold" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      عملیات  
                    </button>
                    <div class="dropdown-menu text-right">
                      <!-- Dropdown menu links -->
                      <a class="dropdown-item" href="{{url('panel_saderamali/update',['file' => $file->id])}}">  ویرایش</a>
                      <a class="dropdown-item" href="{{url('panel_saderamali/access',['file' => $file->id])}}">  دسترسی دادن </a>
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
          <div class="card-header"><h3> تاریخ و آدرس برای مکتوب صادر مالی   </h3></div>
            <div class="card-body">
              <div class="row ">

                <div class="col ">
                    <label for="inputText3" class=" col-form-label">  مرسل الیه     </label>
                    <input id="inputText3" tabindex=5 type="text" class="form-control text-right" name="mursal_alia" value="{{$file->mursal_alia}}" readonly>
                      
                  </div>
                  
                <div class="col">
                   <label for="inputText3" class="col-form-label">  مرسل   </label>
                   <input  type="text" tabindex=4 class="form-control text-right" name="mursal" value="{{$file->mursal}}" readonly>  
                            
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

                <div class="col-md-8">
                  <label for="inputText3" class="col-form-label"> تاریخ صدور  </label>
                    <input id="ca2" type="text" tabindex=3 class="form-control text-right" name="date_of_sodor" value="{{Helper::gr_to_hejri($file->date_of_sodor)}}" readonly>          
                </div>
            


              <div class="col-md-4">
                   <label for="inputText3" class="col-form-label">   شماره مسلسل     </label>
                   <input id="inputText3" type="number" tabindex=1 class="form-control text-right"  name="crida_number" value="{{Helper::extract_number($file->crida_number)}}" readonly>          
                   
              </div>

                
            </div>
         </div>
      </div></div>

     
</div>













<!---------------------------other section -------------------------->



<div class="row mt-3">



<div class="col">
<div class="card text-right">
   <div class="card-header"><h3> تعداد   </h3></div>
     <div class="card-body">
       <div class="row ">
            

           <div class="col">
               <label for="inputText3" class="col-form-label"> ضمیمه  </label>
               <input id="inputText3" type="text" tabindex=9 class="form-control text-right " name="zamema" value="{{$file->zamema}}" readonly >          
                 
           </div>

           <div class="col">
               <label for="inputText3" class="col-form-label"> کاپی  </label>
               <input id="inputText3" type="text" tabindex=8 class="form-control text-right " name="copy" value="{{$file->copy}}" readonly>          
                 
           </div>

           <div class="col">
               <label for="inputText3" class="col-form-label"> اصل  </label>
               <input id="inputText3" type="text" tabindex=7 class="form-control text-right " name="asal" value="{{$file->asal}}" readonly>          
                 
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
                <textarea id="inputText3" type="text" tabindex=6 class="form-control text-right" name="kholasmatlab"  readonly> {{$file->kholasmatlab}} </textarea>        
                   
             </div>

     </div>
  </div>
</div>
</div>




</div>



<!---------------------------other section -------------------------->



<div class="row mt-3">


 <div class="col-12">
       <div class="card text-right">
          <div class="card-header"><h3>   حفظ  و کاپی     </h3></div>
            <div class="card-body">
              <div class="row">


                  <div class="col">
                      <label for="inputText3" class="col-form-label">  محل نگهداری    </label>
                      <input id="inputText3" type="text" tabindex=13 class="form-control text-right" name="place" value="{{$file->place}}" readonly>          
                        
                  </div>

                  <div class="col">
                    <label for="inputText3" class="col-form-label">   تاریخ ثبت     </label>
                      <input id="ca1" type="text" tabindex=2 class="form-control text-right" name="date_of_archiving" value="{{Helper::gr_to_hejri($file->date_of_archiving)}}" readonly>  
                             
                  </div>


                  <div class="col">
                      <label for="inputText3" class="col-form-label">  نمبر    </label>
                      <input id="inputText3" type="text" tabindex=12 class="form-control text-right" name="number_of_archive" value="{{$file->number_of_archive}}" readonly>          
                         
                  </div>

                

                  <div class="col">
                      <label for="inputText3" class="col-form-label">  نمبر دوسیه / کارتن    </label>
                      <input id="inputText3" type="text" tabindex=11 class="form-control text-right" name="num_of_dosia" value="{{$file->num_of_dosia}}" readonly>          
                          
                  </div>
                       
            </div>
         </div>
      </div>
    </div>



  </div>


<!--------------------------- file  section -------------------------->



  <div class="row mt-3">    

  <div class="col-10 ml-auto">
             <div class="card text-right">
                <div class="card-header"><h3>  فایل ضمیمه شده      </h3></div>
                  <div class="card-body">
                    <div class="row ">
                        <div style="margin-top: 0px; padding-left:8px;"> 
                            <label>  یاداشت اضافی</label>
                            <textarea  cols="30" rows=" 3" class="form-control text-right"   name="more" placeholder="یاداشت اضافی" readonly> {{$file->more}}  </textarea>
                         </div>

                         
  <!---------------------------- access section of user -------------------------------------------------------->    
                      <div class="col mt-4 mb-5">
                        <div class="dropdown">
                          <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            قابل دسترس برای
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @foreach($file->authorizedUsers as $row)
                              <li class="dropdown-item">{{$row->user->name}} | {{$row->user->dept}} </li>
                            @endforeach  
                          </div>
                        </div>
                      </div>  
 <!------------------------------------------------------ access section of user ---------------------------->  
              
                      <div class="col mt-4 mb-5">
                        <!-- ِSecurely downloading file related file with form -->
                        <form action="{{url('/show_saderamali/'.$file->uuid.'/Download')}}" method="post">
                                {{csrf_field()}}
                              <input type="hidden" value="{{ session('s_key') }}" name="exchange_key">
                              <button type="submit" class="btn btn-default btn-primary float-right fa fa-download">&nbsp;دریافت فایل </button>
                        </form>
                    </div>
<!------------------------------------------------------ access section of user ---------------------------->                           
          </div>
        </div>
    </div>
  </div>
         
</div>
         
<!---------------------------main  section end -------------------------->


      </div>
    </div>
  </div>
</div>                     

         
  


<!-------------------------------- comment section ------------------------------------------------------>


<div class="card col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-3" dir="rtl">
  <div class="card-header">
    <h2 class="text-center ">  <span class="fa fa-star"> &nbsp;</span>اجرات کاربران در مورد این فایل      </h2></div>
  
  <div class="card-body">
     <div style="overflow-y: scroll; max-height:400px;" class="col-12" >    
         @foreach($file->comments->sortByDesc('id') as $comment)  
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


                  <!------------------------- Editing and Delete  ------------------> 
                <div class="float-left">
                    @if($comment->user_id === Auth::user()->id) <!-- handels that a user can only edit or delete his or her own comment -->
                        <button href="#" class="btn btn-xs btn-rounded btn-primary" data-toggle="modal" data-target="#editform{{$comment->id}}"> ویرایش    </button>
                    @endif

                    @if(Auth::user()->id === 1 || $comment->user_id === Auth::user()->id) <!-- shows delete button for admin and the user who posted the comment -->
                        <form method="post" style="display:inline;" action="{{route('panel_saderamali.view.delete_comment', $comment->id)}}">
                          <input type="hidden" name="user_id" value="{{$comment->user_id}}">
                              {{csrf_field()}}
                          <button class="btn btn-sm btn-rounded btn-primary" type="submit">  حذف    </button> 
                        </form>
                    @endif
                </div>
                <!------------------------- Editing and Delete  ------------------> 
          
                            
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
                                  <form method="post" action="{{route('edit_comment_saderamali')}}">
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
<!-- ----------------------- Editing comments - user can edit their comments section end ------------------>



             
        </div>
     @endforeach 
  </div>
</div>






                                    
<!--  ********************************* section post comment ******************************** -->
  <center>
   <div class="col-10 mb-3">
     <form method="POST" action="{{route('saderamali_comment')}}">
        {{csrf_field()}}

            <div class="row">
                <div class="col-8">
                  <textarea id="editor" name="comment" class="form-control text-right  @if ($errors->has('comment'))  <?php if(isset($er)){ echo $er;} ?> @endif"   placeholder="نظر خویش را بنویسید  "  ></textarea>
                    @if ($errors->has('comment'))
                          <span class="help-block">
                                <strong style="color:#bd1515;">{{ $errors->first('comment') }}</strong>
                          </span>
                    @endif            
                </div>

                <div class="col-4" >         
                    <button type="submit" class="btn btn-primary text-center">افزوذن نظر </button><input type="hidden" value="{{$file->id}}" name="saderamali_id" >
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
 



