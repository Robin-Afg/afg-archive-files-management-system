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
<link rel="shortcut icon" type="image/png" href="{{url('/')}}/img/fav.png"/>
<!-- related to date picker -->
<link rel="stylesheet" type="text/css" href="{{url('/')}}/assets/vendor/pdatepicker/persian-datepicker.min.css">
<!-- related to date picker end -->

@endsection
<!-------------------------- Main content here .... ---------------------------------------->
@section('content')
  <!-- hoverable table -->
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        
    <div class="card">
         <div class="card-header"><h2 class="float-left">  تمام کاربران  </h2>
            @include('layouts.panel_titles')
             </div>


<div class="card-body">
    <div class="col-4 ml-auto" >
          @include('layouts.msg')
    </div>



    <div class="table-responsive">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">
          <div class="pills-regular">
    
              <table id="dtBasicExample" class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">    نام کاربر </th>
                                <th scope="col">  ایمیل کاربر  </th>
                                <th scope="col">  دیپارتمنت کاربر   </th>
                                <th scope="col">  نوع کاربر    </th>
                                
                                <th scope="col">  عملیات  </th> 
                                    
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users->where('status', 1) as $user)
                                <tr>
                                    <td scope="row" class="td-control">{{$user->name}}</td>
                                    <td >{{$user->email}}</td>
                                    <td class="td-control">{{$user->dept}}</td>
                                    @if($user->type == 0)
                                    <td class="td-control"><span class="badge badge-info">Normal User</span></td>
                                    @endif
                                    @if($user->type == 1)
                                    <td class="td-control"><span class="badge badge-danger">Admin User</span></td>
                                    @endif
                                    @if($user->type == 2)
                                    <td class="td-control"><span class="badge badge-warning">Archive User</span></td>
                                    @endif
                                    @if($user->type == 3)
                                    <td class="td-control"><span class="badge badge-success">Viewer</span></td>
                                    @endif
                                    <td>
                                        <div class="btn-group ml-auto">
                                            <a href="#" class="btn btn-sm btn-outline-light text-dark delete" data-id="{{$user->id}}"> <i class="far fas fa-trash-alt"></i> </a>  
                                        </div>
                                    </td>
                                
                                 </tr>
                              @endforeach

                     </tbody>
                </table>
        </div></div></div></div></div></div>
      <span id="base_url" hidden>{{asset('/')}}</span>




       

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

    // Setup - add a text input to each footer cell
    $('#dtBasicExample thead tr').clone(true).appendTo( '#dtBasicExample thead' );
    $('#dtBasicExample thead tr:eq(1) th').each( function (i) {
        if (i != 6) {
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
            emptyTable :     " در این تاریخ کاربری دریافت نشد ",
            search:         "جستجو ",
            info:           "نمایش _START_ الی _END_  که مجموعا _TOTAL_ کاربر دریافت شد",
            infoEmpty:      "کاربری دریافت نگردید",
            infoFiltered:   "***** فلتر از  _MAX_ کاربری دریافت شده  ",
            zeroRecords:    "هیج کاربری دریافت نگردید",
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
        var base_url = $("#base_url").text();
        swal({
            title: "آیا موافق به حذف این کاربر استید ؟؟",
            text: " ! بعد از حذف، این معلومات این کاربر قابل برگشت نیست   ",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $.get(base_url+"delete_user/"+ id, function(data){
                if(data == "success"){
                    element.parent().parent().parent().remove();
                    swal("انجام شد! این کاربر حذف گردید ", {
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




});


</script>    




@endsection








