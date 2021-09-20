@extends('layouts.master')


<!--Title Reference -->
@section('active-menu-title') Archive Files @endsection
<!--Title Reference -->
@section('styles')

<link rel="stylesheet" href="{{url('/')}}/select/dist/css/select2.min.css">
@endsection
<!-------------------------- Main content here .... ---------------------------------------->
@section('content')


<div class="col-xl-12 col-lg-6 col-md-12 col-sm-12 col-12">
    <div class="card">
      <div class="card-header">
    
        <h3 class=" text-center">    مدیریت دسترسی برای مکتوب صادره مالی  نمبر  : {{$file->crida_number}}  

        <div >   تاریخ مکتوب   : {{Helper::gr_to_hejri_style2($file->date_of_archiving)}} </div> </h3>
      </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <h3 class="text-center">     دسترسی کاربران بر فایل  </h3>
              </hr>

              <table class="table table-hover  text-center ml-3 ">
                  <thead>
                      <tr>

                          <th scope="col"> کاربر </th>
                          <th scope="col"> دیپارتمنت </th>
                          <th scope="col"> ایمیل کاربر </th>
                          <th scope="col"> حذف دسترسی </th>

                      </tr>
                  </thead>
                  <tbody>
                    <?php $filtered = array();$i = 0; ?>
                    @foreach($file->authorizedUsers as $row)
                      <?php $filtered[$i] = $row->user->id; $i++;?>
                      <tr>
                          <td scope="row">{{$row->user->name}}</td>
                          <td scope="row">{{$row->user->dept}}</td>
                          <td scope="row">{{$row->user->email}}</td>

                          <td>
                              <div class="btn-group ml-auto">

                                  <a href="{{url('panel/saderamali')}}/revoke/{{$row->id}}/{{$row->user->id}}">
                                      <button class="btn btn-sm btn-primary">
                                          <i class="far fa-trash-alt"></i>
                                      </button>
                                  </a>

                              </div>
                          </td>
                      </tr>
                    @endforeach
                  </tbody>
              </table>

  </div>
  <div class="col-12 pt-3">
    <form method="POST" action="{{route('grant_saderamali')}}">
       
        {{csrf_field()}}
        <div class="form-group">
           <label class="float-right"><b> لیست کاربران   </b></label>
            <select class="form-control" id="input-select" name="user_id[]" multiple="multiple">
                <option></option> <!-- you may concatanate a lastname with name if you wanted -->
                @foreach(App\Models\User::whereNotIn('id', $filtered)->get() as $user)
                <option value="{{$user->id}}">{{$user->name . ' - ' . $user->dept}}</option>
                @endforeach
            </select>
        </div>
        <input type="hidden" value="{{$file->id}}" name="saderamali_id" />
         <button type="submit" class="btn btn-primary float-right"> دسترسی دادن</button>

      

          <!--         Showing flash messages here          -->

            <div class="col-8 flash-message float-right text-right">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
              @if(Session::has('alert-' . $msg))

              <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close pl-2" data-dismiss="alert" aria-label="close">&times;</a></p>
              @endif
            @endforeach
          </div> <!-- end .flash-message -->





    </form>
  </div>
          </div>
        </div>
    </div>
</div>

@endsection




@section('scripts')
    <script src="{{url('/')}}/select/dist/js/select2.min.js"></script>
    
    <script type="text/javascript">
      $(document).ready(function () {
        $('#input-select').select2({
          placeholder: "    کاربران را که میخواهید به این فایل دسترسی داشته باشند انتخاب نمایید    "
        });
      });
    </script>
@endsection