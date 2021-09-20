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
         <div class="card-header"><h2 class="float-left">  تمام فایل  ها  </h2>
             @include('layouts.home_titles')
             </div>


<div class="card-body">

    <div class="col-5 ml-auto"> @include('layouts.msg')</div>
    <div class="table-responsive">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">
          <div class="pills-regular">
    
              <table id="dtBasicExample" class="table table-hover">
                        <thead>
                            <tr>
                              <th scope="col">  عملیات  </th>   
                              <th scope="col">  آدرس پیشنهاد کننده    </th>
                              <th scope="col">  خلص مطلب   </th>
                              <th scope="col">  تاریخ  ثبت پیشنهاد    </th>
                              <th scope="col">    شماره مسلسل   </th>                        
                            </tr>
                        </thead>
                        <tbody class="text-right">
                        @foreach($user as $file)
                            <tr>
                                <td>
                                  <div class="btn-group ml-auto">
                                      <a href="{{route('panel_peshnehad/view',['file' => $file->id])}}"   class="btn btn-sm btn-outline-light text-dark"> <i class="far fas fa-eye"></i></a>
                                  </div>
                                </td>
                                <td class="td-control" >{{$file->add_of_peshnehader}}</td>
                                <td class="td-control" >{{$file->kholasmatlab}}</td>
                                <td class="td-control" style="direction:ltr;">{{Helper::gr_to_hejri_style2($file->date_of_archiving)}}</td>
                                <td class="td-control text-center" scope="row">{{Helper::extract_number($file->crida_number)}}</td>                            
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


<script type="text/javascript">
$(document).ready(function () {
    var base_url = $("#base_url").text();
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



@endsection








