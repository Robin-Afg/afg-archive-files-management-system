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
  @include('layouts.msg')
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            
    <div class="card col-md-12">
        <div class="card-header"><h2 class="float-left"><b> جستجوی اسناد </b></h2>
            @include('layouts.panel_titles')
        </div>


<div class="card-body">
        <div class="col-md-4 ml-auto float-right" >
            @if(isset($searchResults))<div class="alert alert-info"><b>  نمایش {{ $searchResults->count() }} نتیجه برای جستجوی {{ request('search') }}  </b></div>@endif
        </div>

    <div class="row">
        <div class="col-md-8 float-left">
            <form class="form" action="{{route('search')}}" method="post">
                    @csrf
                <div class="row">  
                    <div class="col-md-10 mb-3">
                       
                        <input   type="text"  class="form-control" placeholder="جستجوی مورد نظر" name="search" required >
                    </div>
                    <div class="col-md-2 ">  

                        <button class="btn btn-sm btn-dark " type="submit"> جستجو   </button>  
                    </div>
                </div>        
            </form>        
        </div>
    </div> 


    
        @if(isset($searchResults))
            <div class="table-responsive">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">
                   <div class="pills-regular">
                      <table id="dtBasicExample" class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">  عملیات  </th>
                                <th scope="col">  نوع   </th>
                                <th scope="col">  خلص موضوع   </th>
                                <th scope="col">  تاریخ  ثبت    </th>
                                <th scope="col">    شماره مسلسل سند   </th>
                            </tr>
                        </thead>
                        
                        <tbody class="text-right">
                        @foreach($searchResults->groupByType() as $type => $modelSearchResults)
                            @foreach($modelSearchResults as $searchResult)      

                            


                                <tr>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <?php $a_url = 'panel_'.$searchResult->searchable->file_type.'/view/'.$searchResult->searchable->id; ?> 
                                                <a href="{{ url($a_url) }}"   class="btn btn-sm btn-outline-light text-dark"> <i class="far fas fa-eye"></i></a>
                                        </div>
                                    </td>
                                            <!-- to replace the names of database with farsi names -->
                                    <?php  if($searchResult->searchable->file_type == "ahkam"){
                                                $searchResult->searchable->file_type = 'احکام'; 
                                                }elseif($searchResult->searchable->file_type == "sadera" ){
                                                    $searchResult->searchable->file_type = 'صادره';
                                                }elseif($searchResult->searchable->file_type == "report" ){
                                                    $searchResult->searchable->file_type = 'راپور تخنیکی';
                                                }elseif($searchResult->searchable->file_type == "warada" ){
                                                $searchResult->searchable->file_type = 'وارده';
                                                }elseif($searchResult->searchable->file_type == "peshnehad" ){
                                                $searchResult->searchable->file_type = 'پیشنهاد';
                                                }elseif($searchResult->searchable->file_type == "estelam" ){
                                                    $searchResult->searchable->file_type = 'استعلام';
                                                }elseif($searchResult->searchable->file_type == "saderamali" ){
                                                    $searchResult->searchable->file_type = ' صادره مالی ';
                                                }else($searchResult->searchable->file_type = $searchResult->searchable->file_type);   
                                    ?> 
                                    <td class="td-control text-center"> {{$searchResult->searchable->file_type}}</td>
                                    <td class="td-control">{{$searchResult->searchable->kholasmatlab}}</td>
                                    <td class="td-control" style="direction:ltr;" >{{Helper::gr_to_hejri_style2($searchResult->searchable->date_of_archiving )}}</td>
                                    <td class="td-control text-center" scope="row">{{Helper::extract_number( $searchResult->searchable->crida_number )}}</td>               
                                 </tr>
                                 
                            @endforeach              
                         @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
              
        </div>
    </div>
</div>
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
