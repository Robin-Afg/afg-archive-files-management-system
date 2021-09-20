<!doctype html>
<html lang="en">

 
<head>



 <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="Author" content="Robin Sedeqi" />
    <!-- Bootstrap CSS -->

      <link rel="stylesheet" href="{{url('/')}}/assets/vendor/bootstrap/css/bootstrap.min.css">
      <link href="{{url('/')}}/assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
      <link rel="stylesheet" href="{{url('/')}}/assets/libs/css/style.css">
      <link rel="stylesheet" href="{{url('/')}}/assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
      <link rel="shortcut icon" type="image/png" href="{{url('/')}}/img/fav.png"/>
      
      <!-- <link href="{{url('/')}}/trans/trans_styles.css" rel="stylesheet"> -->
    @yield('styles')

    <title>سیستم مدیریت فایل های آرشیف   </title>
<!-- *********************************** for scrollbars  ************************-->
    <style>

    /* width */
    ::-webkit-scrollbar {
      width: 10px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
      background: #f1f1f1; 
    }
    
    /* Handle */
    ::-webkit-scrollbar-thumb {
      background: #888; 
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
      background: #555; 
    }

    body{
      font-size:17px;
    }

    .td-control {
        max-width: 50px;
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap;
        direction:rtl;
    }


    /* 
    for making it rtl */

    /* .dashboard-wrapper{
      margin-left:0px;
      margin-right:264px;

    } */


    .btn-secondary {
      background-color: #3d405c;
      border-color: #3d405c;
    }

    .btn-secondary:hover:focus:active:focus-within {
      background-color: #666b99;
      border-color: #666b99;
    }
    .btn-secondary:hover {
      background-color: #3d405c;
      border-color: #3d405c;
    }

    
    
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
      
      linear-gradient(to bottom, #ffffff 0%, #f9f9f9 100%);
        background-image: linear-gradient(rgb(255, 255, 255) 0%, rgb(249, 249, 249) 100%);
        background-position-x: initial;
        background-position-y: initial;
        background-size: initial;
        background-repeat-x: initial;
        background-repeat-y: initial;
        background-attachment: initial;
        background-origin: initial;
        background-clip: initial;
        background-color: #585858;
        1px solid #fdf7f7;
        border-top-color: rgb(253, 247, 247);
        border-top-style: solid;
        border-top-width: 1px;
        border-right-color: rgb(253, 247, 247);
        border-right-style: solid;
        border-right-width: 1px;
        border-bottom-color: rgb(253, 247, 247);
        border-bottom-style: solid;
        border-bottom-width: 1px;
        border-left-color: rgb(253, 247, 247);
        border-left-style: solid;
        border-left-width: 1px;
        border-image-source: initial;
        border-image-slice: initial;
        border-image-width: initial;
        border-image-outset: initial;
        border-image-repeat: initial;

    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        box-sizing: border-box;
        display: inline-block;
        min-width: 1.5em;
        padding: 0.5em 0em;
        padding-top: 0.5em;
        padding-right: 0em;
        padding-bottom: 0.5em;
        padding-left: 0em;
        margin-left: 2px;
        text-align: center;
        text-decoration: none !important;
        text-decoration-line: none !important;
        text-decoration-style: initial !important;
        text-decoration-color: initial !important;
        cursor: pointer;
        *cursor: hand;
        color: #333 !important;
        border: 1px solid transparent;
        border-radius: 2px;
        border-top-left-radius: 2px;
        border-top-right-radius: 2px;
        border-bottom-right-radius: 2px;
        border-bottom-left-radius: 2px;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:active {
        outline: none;
        
        box-shadow: none;
    }
    </style>


</head>

<body>
<!-- ========================header and sidebar included here ===================================== -->
@include('layouts.header')
@include('layouts.sidebar')


        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content transition-swipe" id="swup">
              <div calss="row">
                   @yield('content')
              </div>
            
             
           </div>
        </div>
 @include('layouts.footer')
         
<!-- ==================== footer included here ======================================== -->




@yield('scripts')
<!-- <script src="{{url('/')}}/trans/swup.js"></script> 
<script defer src="{{url('/')}}/trans/trans_script.js"></script>    -->

  </body>
</html> 








