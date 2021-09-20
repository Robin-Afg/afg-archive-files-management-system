@extends('layouts.master')


@section('content')

    <center class="mt-5">
        <a href="{{url()->previous()}}" > <img src="{{url('/')}}/img/access_denied.png"></a>
    </center>

@endsection