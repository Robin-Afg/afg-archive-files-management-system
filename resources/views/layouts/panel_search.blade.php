<?php 
   $url = "/";
   if(request()->is('panel_sadera')){
        $url = "panel_sadera";
    }elseif(request()->is('panel_warada')){
        $url = "panel_warada";
    }elseif(request()->is('panel_estelam')){
        $url = "panel_estelam";
    }elseif(request()->is('panel_peshnehad')){
        $url = "panel_peshnehad";
    }elseif(request()->is('panel_ahkam')){
        $url = "panel_ahkam";
    }elseif(request()->is('panel_saderamali')){
        $url = "panel_saderamali";
    }elseif(request()->is('panel_report')){
        $url = "panel_report";   
    }else{
        $url = "";
    }

?>

<div class="row mb-4">
            <div class="col-12">
                <form class="form" action="{{route($url)}}" method="get">
                    <div class="row">  
                            <div class="col-md-2 mb-3">
                                <label>   از تاریخ     </label>
                                <input   type="text" onKeyDown="return false" id="d1" class="form-control" name="start_date"  >
                            </div>

                            <div class="col-md-2">
                                <label>   الی   تاریخ     </label>
                                <input  type="text" onKeyDown="return false" id="d2" class="form-control" name="end_date" >   
                            </div>

                            <div class="col-md-2 mt-4">  

                                <button class="btn btn-sm btn-dark " type="submit"> بار گیری   </button>  
                            </div>
                            

                                
                </form>
                        <div class="col-md-2">  
                                <?php $year = Helper::current_year_full(); ?>    
                                <a class="btn btn-sm btn-info mt-4" href=" {{route($url)}}?start_date={{$year}}"> سال  فعلی    </a>  
                                
                                </div>
                        </div>
            </div>
        </div> 