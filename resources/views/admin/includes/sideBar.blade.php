<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu" style="background: #0f4373;">
            <li class="nav-header">
                <div class="dropdown profile-element">

                    <img alt="image" class="rounded-circle" src="{!!  asset('uploads/settings/avatar.png')  !!}"  height="60px" width="60px"/>
                    
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="block m-t-xs font-bold">{{  \Auth::user()->name }}<b class="caret"></b></span>
                    </a>
{{--                    <ul class="dropdown-menu animated fadeInLeft m-t-xs">--}}
{{--                        <li><a class="dropdown-item" href="{{ route('admin.profile') }}">Profile</a></li>--}}
{{--                        <li class="dropdown-divider"></li>--}}
{{--                        <li><a class="dropdown-item" href="{{ route('admin.logout') }}">Logout</a></li>--}}
{{--                    </ul>--}}

                </div>
                <div class="logo-element">
                    <a href="{{Route('admin.dashboard')}}">
                        <img alt="image" class="rounded-circle" src=""  height="40px" width="40px"/>
                    </a>
                </div>
            </li>

            <li class="@if(Request::segment('2') == 'dashboard') active @endif">
                <a href="{{ route('admin.dashboard') }}" data-toggle="tooltip" title="Dashboard">
                    <i class="fa fa-home"></i>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>

            @php
                $userPermission = \App\Helper\Helper::getUserPermission(['user-view','user-create','user-edit','user-delete']);
            @endphp
            @if($userPermission)
                <li class="@if(Request::segment('2') == 'user') active @endif">
                    <a href="{{ route('admin.users.index') }}" data-toggle="tooltip" title="Dashboard">
                        <i class="fa fa-user"></i>
                        <span class="nav-label">User</span>
                    </a>
                </li>
            @endif

            @php
                $postPermission = \App\Helper\Helper::getUserPermission(['post-view','post-create','post-edit','post-delete']);
            @endphp
            @if($postPermission)
            <li class="@if(Request::segment('2') == 'post') active @endif">
                <a href="{{ route('admin.post.index') }}" data-toggle="tooltip" title="Dashboard">
                    <i class="fa fa-list"></i>
                    <span class="nav-label">Post</span>
                </a>
            </li>
            @endif

            <li class="@if(Request::segment('2') == 'dashboard' || Request::segment('2') == 'role' || Request::segment('2') == 'permission') active @endif">
                <a href="{{ route('admin.dashboard') }}" data-toggle="tooltip" title="Dashboard">
                    <i class="fa fa-list"></i>
                    <span class="nav-label">Role Permission</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li class="@if(Request::segment('2') == 'role') active @endif">
                        <a href="{{route('admin.role.index')}}" data-toggle="tooltip">
                            <i class="fa fa-user-plus"></i>
                            <span class="nav-label font_size">Role</span>
                        </a>
                    </li>
                    <li class="@if(Request::segment('2') == 'permission') active @endif">
                        <a href="{{route('admin.permission.index')}}" data-toggle="tooltip" >
                            <i class="fa fa-user-plus"></i>
                            <span class="nav-label font_size">Permission</span>
                        </a>
                    </li>

{{--                    <li class="@if(Request::segment('2') == 'setpermission') active @endif">--}}
{{--                        <a href="{{route('admin.permission.create')}}" data-toggle="tooltip" >--}}
{{--                            <i class="fa fa-user-plus"></i>--}}
{{--                            <span class="nav-label font_size">Set Permission</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
                </ul>
            </li>
        </ul>
    </div>
</nav>

<style type="text/css">
    .danger{color: #721c24;}
    .success{color: #155724;}
    .font_size{font-size: 11px;}
    body{background-color:#0f4373;}

    #side-menu{/*background: #2f4050;*/background: #0f4373;}
    ul.nav-second-level {background: #0f4373;}
    .nav-header{background-image:url({{asset('images/back.png')}});}
.nav > li > a{color:#FFF;}
.nav > li.active{background: #ff000052; border-left: 4px solid #7db018}
.navbar-default .nav > li > a:hover, .navbar-default .nav > li > a:focus{background-color:#0087ff80;color:#fff;}

</style>
