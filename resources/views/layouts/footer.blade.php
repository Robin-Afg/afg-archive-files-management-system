
    <div class="footer d-none d-xl-block" style="TEXT-ALIGN: center;">
            <div class="ml-auto text-responsive col-9">
                <div class="row ml-auto">
                        <div class="col-xl-9 col-lg-6 col-md-6 col-sm-9 col-9 ml-auto d-none d-xl-block" style="font-size:15px;">
                        سیستم مدیریت  اسناد آرشیف - تمام حقوق برای   نویسنده   محفوظ است <br><a href="http://172.16.0.3 "></a>
                        <span style="">Archive &amp; Files Management System <small>(MIS)</small></span> 
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3" style="font-size:15px;">
                        <div class="text-md-right footer-links d-none d-xl-block ml-auto">
                            <a href="mailto:robsedeqi@gmail.com">   برای معلومات بیشتر به تماس شوید  </a>
                        </div>
                    </div>
                </div>
            </div>
    </div>
   
   
    <!-- Optional JavaScript -->
    <script src="{{url('/')}}/assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="{{url('/')}}/assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="{{url('/')}}/assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <script src="{{url('/')}}/assets/libs/js/main-js.js"></script>



<script type="text/javascript">
    @if($errors->first('confirm_password') || $errors->first('new_password') || $errors->first('confirm_new_password') || Session::has('password_alert'))
            $("#change_password").modal();
    @endif
</script>


 