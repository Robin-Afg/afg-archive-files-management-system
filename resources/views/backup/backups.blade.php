@extends('layouts.master')


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
         <div class="card-header"><h2 class="text-center">   مدیریت فایل های پشتیبان   </h2></div>
            

<div class="card-body">
    <div class="col-4 ml-auto" >
          @include('layouts.msg')
    </div>

    <a id="create-new-backup-button" href="{{ url('backup/create') }}" class="btn btn-success pull-right ml-3" style="margin-bottom:2em;">
    <i class="fa fa-plus"></i>   ایجاد پشتیبان دیتابیس    </a>
    
    



    <div class="table-responsive">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">
          <div class="pills-regular">
    
          @if (count($backups))

            <table class="table table-striped table-bordered" id="dtBasicExample">
                <thead>
                    <tr>
                        <th>نام فایل  </th>
                        <th> سایز </th>
                        <th>تاریخ ایجاد </th>
                        <th>تاریخ</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($backups as $backup)
                    <tr>
                        <td>{{ $backup['file_name'] }}</td>
                        <td>{{ Helper::humanFilesize($backup['file_size']) }}</td>
                        
                        <td>
                            {{  $backup['last_modified'] }}
                        </td>

                        <td>
                            {{ $backup['last_modified']->diffForHumans() }}
                        </td>

                        
                        <td class="text-right">
                            <form style=" display:inline;" method="post" action="{{ url('backup/download/'.$backup['file_name']) }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{ session('s_key') }}" name="exchange_key">
                                <button type="submit" class="btn"> <i class="fa fas fa-download"></i> </button>
                            </form>

                            <form method="post" style=" display:inline;" action="{{ url('backup/delete/'.$backup['file_name']) }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{ session('s_key') }}" name="exchange_key">
                                <button type="submit" class="btn">  <i class="fa fas fa-trash-alt"></i> </button>
                            </form>
                            
                        </td>
                    </tr>
                @endforeach
                </tbody>
        </table>
            @else
            <div class="well">
                <h4>! فایل پشتیبانی دریافت نشد </h4>
            </div>
            @endif


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


