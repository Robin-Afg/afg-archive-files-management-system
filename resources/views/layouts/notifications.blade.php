<?php 
$notis = App\Models\Noti::where('notifiable_id', auth::id())->where('user_id','!=',auth::id())->with(['SaderaUser','WaradaUser']);
$notis = $notis->take(100)->get()->sortByDesc('id');
?>


<ul class="dropdown-menu dropdown-menu-right notification-dropdown">
    
    <li>
        <li>
            <div class="list-footer"> <a href="#">  آگاهی ها </a></div>
        </li>
        
        <div class="notification-list">
            <div class="list-group">
                @if(!$notis->isEmpty())
                   @foreach($notis as $row)
                      <?php  $href = url('/')."/notification/".$row->id;  ?>     

                        <a href="{{$href}}" class="list-group-item list-group-item-action <?php if($row->read === null){echo 'active'; }else{echo '';} ?> ">
                        
                        <div class="notification-info">
                            @if($row->noti_for == 0) <!-- show notification if there are any comments -->
                                <div class="notification-list-user-img float-right mt-2">
                                    <span class="fas fa-pen-square fa-2x"></span>
                                </div>
                                    <?php  
                                        $user = "";
                                        if( $row->user_id != null) {
                                            $user = App\User::find($row->user_id); 
                                        }

                                    ?>
                                   <span class="">   <span class="text-primary"> @if($user) {{ $user->name}} @endif</span> 
                                <div class="notification-list-user-block">اجرات خود را بالای این فایل اضافه کرد  </div></span> 
                                <div class="notification-date">{{$row->created_at->diffForHumans()}}</div>
                            @endif 
                            
                            @if($row->noti_for == 1) <!-- show notification if a user is granted access on a file -->
                                <div class="notification-list-user-img float-right">
                                    <span class="fas fa-book fa-2x"></span>
                                </div>
                                <div class="notification-list-user-block float-right pr-3">  این مکتوب به شما راجع شده است </div>
                                <div class="notification-date float-left">{{$row->created_at->diffForHumans()}}</div>
                            @endif 
                              
                                
                           
                        </div>
                     </a> 
                    @endforeach
                @endif
  
                </div>
        </div>
    </li>

        <li>
            <div class="list-footer"> <a href="#">  </a></div>
        </li>
</ul>
                       