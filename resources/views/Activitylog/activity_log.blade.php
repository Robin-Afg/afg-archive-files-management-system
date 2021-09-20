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

<!-- related to date picker -->
<link rel="stylesheet" type="text/css" href="{{url('/')}}/assets/vendor/pdatepicker/persian-datepicker.min.css">
<!-- related to date picker end -->

@endsection
<!-------------------------- Main content here .... ---------------------------------------->
@section('content')
  <!-- hoverable table -->
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        
    <div class="card">
        <div class="card-header mt-2"><h2 class=" text-center"><b>  پیشینه فعالیت ها </b></h2></div>
        <div class="card-body">
            <div class="col-4 ml-auto" >
                @include('layouts.msg')
            </div>


    <div class="table-responsive">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">
          <div class="pills-regular">
            <div class="table-responsive">
              <table id="dtBasicExample" class="table table-hover">
                        <thead>
                                <tr>
                                <th scope="col">   جزییات   </th>
                                <th scope="col">  زمان و تاریخ   </th>
                                <th scope="col">  توسط   </th>
                                <th scope="col">  فعالیت   </th>
                                <th scope="col">  نوعیت سند   </th>                
                            </tr>
                        </thead>
                         <tbody>
                      
                            @foreach($activity->sortByDesc('id')->take(200) as $u_activity)
                                  
                                <?php 
                                    
                                    
                                    if($u_activity->log_name == 'کاربران'){
                                        switch($u_activity->description){
                                            case 'created':
                                                $act = ' این کاربر ایجاد گردیده است ! '; 
                                            break;
                                            case 'updated':
                                                $act = ' این کاربر ویرایش گردیده است ! '; 
                                            break;
                                            case 'deleted':
                                                $act = ' این کاربر حذف گردیده است ! '; 
                                            break;
                                            default:
                                               $act = $u_activity->description;
                                            break;
                                          }  
                                    }else{
                                    switch($u_activity->description){
                                    case 'created':
                                        $act = ' این سند / اجرات ایجاد گردیده است ! '; 
                                    break;
                                    case 'updated':
                                        $act = ' این سند / اجرات ویرایش گردیده است ! '; 
                                    break;
                                    case 'deleted':
                                        $act = ' این سند / اجرات حذف گردیده است ! '; 
                                    break;
                                    default:
                                       $act = $u_activity->description;
                                    break;
                                  }   }
                                ?>  
                               
                            <tr>
                                    <td>  <a href="d_activity_log/{{$u_activity->id}}"   class="btn btn-sm btn-outline-light text-dark"> <i class="far fas fa-street-view"></i></a>  </td>
                                    <td  > {{ $u_activity->created_at->diffForHumans() }} </td>
                                    <?php $user = App\Models\User::find($u_activity->causer_id);
                                        if($user){
                                            $username = $user->name;
                                        }else {
                                            $username = "Someone";
                                        }
                                    ?>
                                    <td class="td-control">{{ $username }} </td>
                                    <td class="td-control"> {{$act}} </td>
                                    <td class="td-control"> {{$u_activity->log_name}}   </td>
                          
                            </tr> 
                            @endforeach
                             

                     </tbody>
                </table>
                </div>
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


var table = $('#dtBasicExample').DataTable( {
    orderCellsTop: true,
    fixedHeader: true,
    responsive:true,
    dom: 'Bfrtip',
    buttons: [ 'pageLength', 'copy',  'excel'],
    "order": [],
    language: {
        emptyTable :     " در این تاریخ فعالیت دریافت نشد ",
        search:         "جستجو ",
        info:           "نمایش _START_ الی _END_  که مجموعا _TOTAL_ فعالیت دریافت شد",
        infoEmpty:      "فعالیت دریافت نگردید",
        infoFiltered:   "***** فلتر از  _MAX_ فعالیت دریافت شده  ",
        zeroRecords:    "هیج فعالیت دریافت نگردید",
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
            
});

</script>




@endsection
