
    <ul class="nav nav-pills mb-1 float-right font-weight-bold  d-none d-lg-flex"  role="tablist" >
        
        <li class="nav-item">
            <a class="nav-link {{ request()->is('sadera') ? 'active' : '' }}"   href="{{url('sadera')}}" role="tab"  >صادره ها </a>
        </li>
        <li class="nav-item">
            <a  class="nav-link {{ request()->is('warada') ? 'active' : '' }}"   href="{{url('warada')}}" role="tab">وارده ها </a>
        </li>
        <li class="nav-item">
            <a  class="nav-link {{ request()->is('peshnehad') ? 'active' : '' }}"   href="{{url('peshnehad')}}" role="tab">پیشنهادات </a>
        </li>
        <li class="nav-item">
            <a  class="nav-link {{ request()->is('estelam') ? 'active' : '' }}"   href="{{url('estelam')}}" role="tab">   استعلام ها  </a>
        </li>
        <li class="nav-item">
        <a  class="nav-link {{ request()->is('ahkam') ? 'active' : '' }}"   href="{{url('ahkam')}}" role="tab">  احکام و فرامین   </a>
        </li>
        <li class="nav-item">
            <a  class="nav-link {{ request()->is('saderamali') ? 'active' : '' }}"   href="{{url('saderamali')}}" role="tab"> صادره های مالی   </a>
        </li>
        <li class="nav-item">
            <a  class="nav-link {{ request()->is('report') ? 'active' : '' }}"   href="{{url('report')}}" role="tab"> گزارش های تخنیکی  </a>
        </li>
    </ul>
