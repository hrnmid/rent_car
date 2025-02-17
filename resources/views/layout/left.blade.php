{{-- @php use Illuminate\Support\Facades\DB; @endphp
<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
    <!--begin::Menu Container-->
    <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
        <!--begin::Menu Nav-->
        <ul class="menu-nav">
            <li class="menu-item menu-item-open" aria-haspopup="true">
                <a href="{{ route('dashboard') }}" class="menu-link">
                    <span class="svg-icon menu-icon">
                        <i class="fa fa-home icon-lg"></i>
                    </span>
                    <span class="menu-text">DASHBOARD</span>
                </a>
            </li>
            @php
            // var_dump(); exit;
            if (Auth::user()->role >= 6){
            $dpmenu = DB::select("SELECT id,menu,link,icon FROM menu WHERE isactive='1' AND TYPE='1' AND groupmenu ='1'
            ORDER BY orderid");
            } else {
            $dpmenu = DB::select("SELECT id,menu,link,icon FROM menu WHERE isactive='1' AND TYPE='1'
            ORDER BY orderid");
            }

            @endphp
            @foreach ($dpmenu as $item)
            <li class="menu-item menu-item-submenu menu-item-open" aria-haspopup="true" data-menu-toggle="hover">
                <a href="{{ '/'.$item->link }}" class="menu-link menu-toggle">
                    <span class="svg-icon menu-icon">
                        <i class="fa fa-{{ $item->icon }} icon-lg"></i>
                    </span>
                    <span class="menu-text">{{ $item->menu }}</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="menu-submenu" kt-hidden-height="120">
                    <i class="menu-arrow"></i>
                    <ul class="menu-subnav">
                        @php
                        $isactive = "";
                        $parentid = $item->id;
                        if (Auth::user()->role >= 6){
                        $dpmenudetail = DB::select("SELECT id,menu,link,icon FROM menu WHERE isactive='1' AND TYPE='2'
                        AND groupmenu ='1'
                        and parentid='" . $parentid . "' ORDER BY orderid");
                        } else {
                        $dpmenudetail = DB::select("SELECT id,menu,link,icon FROM menu WHERE isactive='1' AND TYPE='2'
                        AND groupmenu ='0'
                        and parentid='" . $parentid . "' ORDER BY orderid");
                        }
                        @endphp
                        @foreach ($dpmenudetail as $itemdetail)
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ '/'.$itemdetail->link }}" class="menu-link">
                                <span class="menu-text">
                                    <i style="width:30px;" class="fa fa-{{ $itemdetail->icon }} "></i>
                                    {{ $itemdetail->menu }}
                                </span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </li>
            @endforeach
        </ul>
        <!--end::Menu Nav-->
    </div>
    <!--end::Menu Container-->
</div> --}}


@php use Illuminate\Support\Facades\DB; @endphp
<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
    <!--begin::Menu Container-->
    <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
        <!--begin::Menu Nav-->
        <ul class="menu-nav">
            <li class="menu-item menu-item-open" aria-haspopup="true">
                @if(Auth::check())
                    <a href="{{ route('dashboard') }}" class="menu-link">
                        <span class="svg-icon menu-icon">
                            <i class="fa fa-home icon-lg"></i>
                        </span>
                        <span class="menu-text">DASHBOARD</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="menu-link">
                        <span class="svg-icon menu-icon">
                            <i class="fa fa-sign-in-alt icon-lg"></i>
                        </span>
                        <span class="menu-text">LOGIN</span>
                    </a>
                @endif
            </li>

            @if(Auth::check())
                @php
                if (Auth::user()->role >= 6){
                    $dpmenu = DB::select("SELECT id,menu,link,icon FROM menu WHERE isactive='1' AND TYPE='1' AND groupmenu ='1'
                    ORDER BY orderid");
                } else {
                    $dpmenu = DB::select("SELECT id,menu,link,icon FROM menu WHERE isactive='1' AND TYPE='1'
                    ORDER BY orderid");
                }
                @endphp
                @foreach ($dpmenu as $item)
                <li class="menu-item menu-item-submenu menu-item-open" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="{{ '/'.$item->link }}" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <i class="fa fa-{{ $item->icon }} icon-lg"></i>
                        </span>
                        <span class="menu-text">{{ $item->menu }}</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu" kt-hidden-height="120">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            @php
                            $isactive = "";
                            $parentid = $item->id;
                            if (Auth::user()->role >= 6){
                                $dpmenudetail = DB::select("SELECT id,menu,link,icon FROM menu WHERE isactive='1' AND TYPE='2'
                                AND groupmenu ='1'
                                and parentid='" . $parentid . "' ORDER BY orderid");
                            } else {
                                $dpmenudetail = DB::select("SELECT id,menu,link,icon FROM menu WHERE isactive='1' AND TYPE='2'
                                AND groupmenu ='0'
                                and parentid='" . $parentid . "' ORDER BY orderid");
                            }
                            @endphp
                            @foreach ($dpmenudetail as $itemdetail)
                            <li class="menu-item" aria-haspopup="true">
                                <a href="{{ '/'.$itemdetail->link }}" class="menu-link">
                                    <span class="menu-text">
                                        <i style="width:30px;" class="fa fa-{{ $itemdetail->icon }} "></i>
                                        {{ $itemdetail->menu }}
                                    </span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
                @endforeach
            @endif
        </ul>
        <!--end::Menu Nav-->
    </div>
    <!--end::Menu Container-->
</div>
