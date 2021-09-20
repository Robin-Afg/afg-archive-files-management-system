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

<style>
   
.card-hover .reveal {
    visibility: hidden;
    opacity: 0;
    height: 0;
    padding: 0;
}

.card-hover:hover .reveal {
    height: auto;
    visibility: visible;
    opacity: 10;
    transition: opacity 1s ease;
}
</style>



@endsection
<!-------------------------- Main content here .... ---------------------------------------->
@section('content')
  <!-- hoverable table -->
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        
<div class="card">
         <div class="card-header"><h2 class="float-left"><b>   تمام   اسناد  </b></h2>
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
    
              <table id="dtBasicExample" class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">  عملیات  </th> 
                                <th scope="col">  خلص مطلب    </th>
                                <th scope="col">  صادر کننده استعلام </th>
                                <th scope="col">  تاریخ ثبت استعلام    </th>
                                <th scope="col">    شماره مسلسل   </th>                                    
                            </tr>
                        </thead>
                         <tbody class="text-right">
                            @foreach($estelam as $file)
                                    <?php 
                                        if($file->comments->first() ){
                                            $style = "border-right: 6px solid rgba(76, 175, 80, 0.7)";
                                        } else {
                                            $style = "";
                                        } 
                                    ?>

                                <tr>
                                    <td>
                                        <div class="btn-group ml-auto" style="direction:rtl;">
                                            <a href="{{url('panel_estelam/view',['file' => $file->id])}}" title="نمایش سند"  class="btn btn-sm btn-outline-light text-dark"> <i class="far fas fa-eye"></i></a> 
                                            @if(!(Auth::user()->type === 3))   
                                            <a href="#" class="btn btn-sm btn-outline-light text-dark view-users" title="کاربرانی که بالای این فایل دسترسی دارند" data-id="{{$file->id}}"> <i class="far fas fa-lock-open"></i> </a>
                                            <a href="{{url('panel_estelam/access',['file' => $file->id])}}" title="دسترسی دادن کاربران" class="btn btn-sm btn-outline-light text-dark" > <i class="far fas fa-user"></i> </a>
                                            <a href="{{url('panel_estelam/update',['file' => $file->id])}}" title="ویرایش سند" class="btn btn-sm btn-outline-light text-dark" > <i class="far fas fa-edit"></i></a>
                                            @endif
                                            @if(Auth::user()->type === 1)
                                                <a href="#" data-id="{{$file->id}}" title="حذف سند" class="btn btn-sm btn-outline-light text-dark delete" > <i class="far fa-trash-alt"></i></a>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="td-control">{{$file->kholasmatlab}}</td>
                                    <td class="td-control">{{$file->add_of_sender}}</td>
                                    <td class="td-control" style="direction:ltr;" >{{Helper::gr_to_hejri_style2($file->date_of_archiving)}}</td>
                                    <td class="td-control text-center" scope="row" style="{{$style}}">{{Helper::extract_number($file->crida_number)}}</td>
                                </tr>
                              @endforeach

                     </tbody>
                </table>
        </div></div></div></div></div></div>
      <span id="base_url" hidden>{{asset('/')}}</span>






        <!-- Modal used for shwoing authorized users started -->
        <div class="modal fade" id="estelam_users" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header ml-auto">
                        <h5 class="modal-title " id="exampleModalLabel">کاربرانی که بالای این فایل دسترسی دارند</h5>   
                    </div>
                    <div class="modal-body">

                      </div>

                    <div class="modal-footer">
                        <a href="#" class="btn btn-secondary" data-dismiss="modal">بستن</a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Modal used for shwoing authorized users ended -->

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


<script type="text/javascript">
$(document).ready(function () {

    var base_url = $("#base_url").text();
    // showing and getting authorized users in panels ...
    $(".view-users").click(function () {
      var id = $(this).attr('data-id');
       $.get(base_url+"get_data/panel_estelam/"+id, function(data){
        var string = "";
        data = data[0].authorized_users;
        for (var i = 0; i < data.length ; i++) {
           string += ' <span class="badge badge-pill badge-info fa-1x">'+data[i].user.name+'</span>';
        }
               $("#estelam_users .modal-body").html(string);
               $("#estelam_users").modal();
            });
    });
// showing and getting authorized users in panels ...end 




//data table starts 
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
        responsive:true,
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


<!-- realted to sweet alert -->

<script type="text/javascript" src="{{url('/')}}/js/sweetalert.min.js"></script>

<script type="text/javascript">
$(document).ready(function () {
    var base_url = $("#base_url").text();
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
            $.get(base_url+"panel_estelam/delete/"+id, function(data){
                // data = JSON.parse(data);
                if(data.result == "success"){
                    element.parent().parent().parent().remove();
                    swal("انجام شد! این سند حذف گردید ", {
                    icon: "success",
                    });
                }else{
                    swal("انجام نشد ! لطفا با سازنده این سیستم به تماس شوید");
                }
            });
          }
        });
    });


});

</script>

@endsection








