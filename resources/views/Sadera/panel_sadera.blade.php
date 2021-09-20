@extends('layouts.master')

<!--Title Reference -->
@section('active-menu-title')
Archive Files
@endsection

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

@endsection
<!-------------------------- Main content here .... ---------------------------------------->
@section('content')
  <!-- hoverable table -->
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        
    <div class="card">
        <div class="card-header"><h2 class="float-left"><b> تمام   اسناد  </b></h2>
            @include('layouts.panel_titles')
        </div>


<div class="card-body">
    <div class="col-4 ml-auto" >
          @include('layouts.msg')
    </div>


@include('layouts.panel_search')



    <div class="table-responsive">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">
          <div class="pills-regular">
    
              <table id="dtBasicExample" class="table table-hover" >
                        <thead>
                            <tr>
                                    
                                <th scope="col">  عملیات  </th>
                                <th scope="col">  مرسل  الیه    </th>
                                <th scope="col">  مرسل   </th>
                                <th scope="col">  تاریخ  مکتوب    </th>
                                <th scope="col">    شماره مسلسل   </th>
                                     
                            </tr>
                        </thead>
                         <tbody class="text-right">
                            <?php $style = ""; ?>
                            @foreach($sadera as $file)
                                <?php 
                                    if($file->comments->first() ){
                                        $style = "border-right: 6px solid rgba(76, 175, 80, 0.7);";
                                    } else {
                                        $style = "";
                                    } 
                                ?>  
                                
                                <tr>
                                    <td>
                                        <div class="btn-group text-center" style="direction:rtl;">
                                                <a href="{{url('panel_sadera/view',['file' => $file->id])}}"   title="نمایش سند" class="btn btn-sm btn-outline-light text-dark"> <i class="far fas fa-eye"></i></a>
                                                @if(!(Auth::user()->type === 3))  
                                                    <a href="#" class="btn btn-sm btn-outline-light text-dark view-users" title="کاربرانی که بالای این فایل دسترسی دارند" data-id="{{$file->id}}"> <i class="far fas fa-lock-open"></i> </a>  
                                                    <a href="{{url('panel_sadera/access',['file' => $file->id])}}" title="دسترسی دادن کاربران" class="btn btn-sm btn-outline-light text-dark" > <i class="far fas fa-user"></i></a>
                                                    <a href="{{ url('panel_sadera/update',['file' => $file->id]) }}" title="ویرایش سند" class="btn btn-sm btn-outline-light text-dark" > <i class="far fas fa-edit"></i></a>
                                                @endif
                                                @if(Auth::user()->type === 1)
                                                    <a href="#" data-id="{{$file->id}}" title="حذف سند" class="btn btn-sm btn-outline-light text-dark delete" > <i class="far fa-trash-alt"></i></a>
                                                @endif
                                        </div>
                                    </td>
                                    <td class="td-control">{{$file->mursal_alia}}</td>
                                    <td class="td-control">{{$file->mursal}}</td>
                                    <td class="td-control" style="direction:ltr;">{{Helper::gr_to_hejri_style2($file->date_of_archiving)}}</td>
                                    <td scope="row" class="td-control text-center" style="{{ $style }}" >{{Helper::extract_number($file->crida_number)}}</td>
                                    
                                    
                                    
                                    
                                    
                                
                                 </tr>
                              @endforeach

                     </tbody>
                </table>
        </div></div></div></div></div></div>
      <span id="base_url" hidden>{{asset('/')}}</span>




        <!-- Modal -->
        <div class="modal fade" id="sadera_users" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header ml-auto">
                        <h5 class="modal-title " id="exampleModalLabel">کاربرانی که بالای این فایل دسترسی دارند</h5>        
                    </div>
                    <div class="modal-body">
                        <span class="badge badge-pill badge-success fa-1x">   </span>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-secondary" data-dismiss="modal">بستن</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->   



@endsection






@section('scripts')
<!-- related to data table -->
<script type="text/javascript" src="{{url('/')}}/assets/vendor/datatables/DataTables/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{{url('/')}}/assets/vendor/datatables/DataTables/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="{{url('/')}}/assets/vendor/datatables/Buttons/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="{{url('/')}}/assets/vendor/datatables/Buttons/js/buttons.bootstrap4.min.js"></script>
<script type="text/javascript" src="{{url('/')}}/assets/vendor/datatables/Buttons/js/buttons.html5.min.js"></script> <!-- this is responsible for buttons !-->
<script type="text/javascript" src="{{url('/')}}/assets/vendor/datatables/pdfmake/pdfmake.min.js"></script>
<script type="text/javascript" src="{{url('/')}}/assets/vendor/datatables/JSZip/jszip.min.js"></script>
<script type="text/javascript" src="{{url('/')}}/assets/vendor/datatables/pdfmake/vfs_fonts.js"></script>
<!-- related to date picker -->
<script type="text/javascript" src="{{url('/')}}/assets/vendor/pdatepicker/persian-date.js"></script>
<script type="text/javascript" src="{{url('/')}}/assets/vendor/pdatepicker/persian-datepicker.js"></script>
<!-- realted to sweet alert -->
<script type="text/javascript" src="{{url('/')}}/js/sweetalert.min.js"></script>



<script type="text/javascript">
$(document).ready(function () {
    var base_url = $("#base_url").text();

       // showing and getting authorized users in panels ...
       $(".view-users").click(function () {
      var id = $(this).attr('data-id');
       $.get(base_url+"get_data/panel_sadera/"+id, function(data){
        var string = "";
        data = data[0].authorized_users;
        for (var i = 0; i < data.length ; i++) {
           string += ' <span class="badge badge-pill badge-info fa-1x" >'+data[i].user.name+'</span>';
        }
               $("#sadera_users .modal-body").html(string);
               $("#sadera_users").modal();
            });
    });
// showing and getting authorized users in panels ...end 





    // Setup - add a text input to each footer cell
    $('#dtBasicExample thead tr').clone(true).appendTo( '#dtBasicExample thead' );
    $('#dtBasicExample thead tr:eq(1) th').each( function (i) {
        if (i!= 6) {
            var title = $(this).text();
            $(this).html( '<input type="text" width="2%" placeholder="جستجو'+title+'" />' );
     
            $( 'input', this ).on( 'keyup change', function () {
                if ( table.column(i).search() !== this.value ) {
                    table
                        .column(i)
                        .search( this.value )
                        .draw();
                }
            } );
        }
    });
   // pdfMake.fonts = {
   //      Arial: {
   //          normal: 'Ariali.ttf',
   //          bold: 'Ariali.ttf',
   //          italics: 'Ariali.ttf',
   //          bolditalics: 'Ariali.ttf'
   //      }
   //  }

 
    var table = $('#dtBasicExample').DataTable( {
        orderCellsTop: true,
        fixedHeader: true,
        responsive: true,
        dom: 'Bfrtip',
        buttons: [ 'pageLength', 'copy',  'excel'],
        "order": [],
        language: {
            emptyTable :     " در این تاریخ اسنادی دریافت نشد ",
            search:         "جستجو ",
            info:           "نمایش _START_ الی _END_  که مجموعا _TOTAL_ اسناد دریافت شد",
            infoEmpty:      "اسنادی دریافت نگردید",
            infoFiltered:   "***** فلتر از  _MAX_ اسنادی دریافت شده  ",
            zeroRecords:    "هیج اسنادی دریافت نگردید",
            paginate: {
                    "first":      "اولی",
                    "last":       "آخری",
                    "next":       "بعدی",
                    "previous":   "قبلی"
                },
            buttons: {
                  pageLength: {
                     _: "نمایش %d سند",
                   '-1': "Tout afficher"
                }
            }
            
            
            }
        
            });


//  related to sweet alert **********************************

$(".delete").click(function(){
        var element = $(this);
        var id = $(this).attr('data-id');
        swal({
        title: "آیا موافق به حذف این فایل استید ؟؟",
        text: " ! بعد از حذف، این فایل قابل برگشت نیست   ",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $.get(base_url+"panel_sadera/delete/"+id, function(data){
                // data = JSON.parse(data);
                if(data.result == "success"){
                    element.parent().parent().parent().remove();
                    swal("انجام شد! این فایل حذف گردید ", {
                    icon: "success",
                    });
                   
                }else{
                    swal("انجام نشد ! لطفا با احمد روبین صدیقی به تماس شوید");
                }
            });
          }
        });
    });


//  related to sweet alert **********************************


//persian date picker
    $('#d1').pDatepicker({
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
    
      $('#d2').pDatepicker({
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








