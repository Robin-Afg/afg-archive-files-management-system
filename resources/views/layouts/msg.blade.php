<div class="col-12 flash-message float-right text-center mb-1 mt-2" >
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))

                <p class="alert text-right alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close pl-2" data-dismiss="alert" aria-label="close">&times;</a></p>
                @endif
        @endforeach
</div> 