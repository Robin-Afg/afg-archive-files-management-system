

    <ul class="nav nav-pills mb-1 float-right font-weight-bold d-none d-lg-flex" style="direction:rtl;" role="tablist" > 
        <li class="nav-item">
            <a class="nav-link {{ request()->is('panel_sadera') ? 'active' : '' }}"   href="{{url('panel_sadera')}}" role="tab"  >صادره ها </a>
        </li>
        <li class="nav-item">
            <a  class="nav-link {{ request()->is('panel_warada') ? 'active' : '' }}"   href="{{url('panel_warada')}}" role="tab">وارده ها </a>
        </li>
        <li class="nav-item">
            <a  class="nav-link {{ request()->is('panel_peshnehad') ? 'active' : '' }}"   href="{{url('panel_peshnehad')}}" role="tab">پیشنهادات </a>
        </li>
        <li class="nav-item">
            <a  class="nav-link {{ request()->is('panel_estelam') ? 'active' : '' }}"   href="{{url('panel_estelam')}}" role="tab">   استعلام ها  </a>
        </li>
        <a  class="nav-link {{ request()->is('panel_ahkam') ? 'active' : '' }}"   href="{{url('panel_ahkam')}}" role="tab">  احکام و فرامین   </a>
        </li>
        <li class="nav-item">
            <a  class="nav-link {{ request()->is('panel_saderamali') ? 'active' : '' }}"   href="{{url('panel_saderamali')}}" role="tab"> صادره های مالی   </a>
        </li>
        <li class="nav-item">
            <a  class="nav-link {{ request()->is('panel_report') ? 'active' : '' }}"   href="{{url('panel_report')}}" role="tab"> گزارش های تخنیکی   </a>
        </li>
    </ul>
