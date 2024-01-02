<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            <li class="nav-item  ">
                <a href="{{ url('/') }}" class="nav-link ">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            @if(!empty(session('menus')))
            @foreach(session('menus') as $menu)
            @if(!empty($menu->url))
            <li class="nav-item  ">
                <a href="{{ url('/'.$menu->url) }}" class="nav-link ">
                    <i class="{{ $menu->icon }}"></i>
                    <span class="title">{{ $menu->name }}</span>
                </a>
            </li>
            @else
            <li class="nav-item  ">           
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="{{ $menu['icon'] }}"></i>
                    <span class="title">{{ $menu['head'] }}</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                @foreach($menu['detail'] as $det)
                    <li class="nav-item  ">
                        <a href="{{ url('/'.$det->url) }}" class="nav-link ">
                            <i class="{{ $det->icon }}"></i>
                            <span class="title">{{ $det->name }}</span>
                        </a>
                    </li>
                @endforeach
                </ul>
                
            </li>
            @endif
            @endforeach
            @endif
        </ul>
    </div>
</div>
