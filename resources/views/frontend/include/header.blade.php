<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar sticky" style="background: linear-gradient(to right, #0ca728, #E91E63);">
    <div class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar"
                    class="nav-link nav-link-lg
                          collapse-btn "> <i data-feather="align-justify"
                        style="color: white !important;"></i></a></li>

        </ul>
    </div>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown dropdown-list-toggle">
            <p class=" text-white">
                ID : 12345
            </p>

        </li>

        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image"
                    src="{{ asset('backend') }}/assets/img/user.png" class="user-img-radious-style"> <span
                    class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
                <div class="dropdown-title"></div>
                <a href="{{ route('user.profile') }}" class="dropdown-item has-icon"> <i
                        class="far
                              fa-user"></i> My Profile

                </a>
                <a href=" " class="dropdown-item has-icon"> <i class="	fas fa-dollar-sign"></i>Money</a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('user.logout') }}" class="dropdown-item has-icon text-danger"> <i
                        class="fas fa-sign-out-alt"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
<div class="main-sidebar sidebar-style-2" style="background: linear-gradient(to bottom, #0ca728, #c21717,#E91E63);">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="/">
                <img alt="image" src="{{ asset('backend/assets/img/banner/1.png') }}"
                    class="rounded-circle author-box-picture" style="width: 70px; height:70px; " />

            </a>
        </div>
        <ul class="sidebar-menu  ">
            <li class="menu-header text-white"></li>
            <li class="dropdown {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                <a href="{{ route('user.dashboard') }}" class="nav-link text-white"><i
                        data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown ">
                <a href="{{ route('user.profile') }}" class="nav-link  text-white"><i data-feather="monitor"></i><span>
                        My Profile </span></a>
            </li>
            <li class="dropdown ">
                <a href="{{ route('user.my_team') }}" class="nav-link  text-white"><i data-feather="monitor"></i><span>
                        My Team </span></a>
            </li>
            <li class="dropdown ">
                <a href="{{ route('user.my_aceive') }}" class="nav-link  text-white"><i data-feather="monitor"></i><span>
                        My Achievement </span></a>
            </li>
            <li class="dropdown ">
                <a href=" " class="nav-link  text-white"><i data-feather="monitor"></i><span>
                        Notice Board</span></a>
            </li>
            <li class="dropdown ">
                <a href="{{ route('user.leader_board') }}" class="nav-link  text-white"><i data-feather="monitor"></i><span>
                        Leader Board</span></a>
            </li>
            <li class="dropdown ">
                <a href="{{ route('user.top_board') }}" class="nav-link  text-white"><i data-feather="monitor"></i><span>
                        Top Board</span></a>
            </li>
            <li class="dropdown ">
                <a href=" " class="nav-link  text-white"><i data-feather="monitor"></i><span>
                        Learning</span></a>
            </li>
            <li class="dropdown ">
                <a href=" " class="nav-link  text-white"><i data-feather="monitor"></i><span>
                        Job</span></a>
            </li>
            <li class="dropdown ">
                <a href=" " class="nav-link  text-white"><i data-feather="monitor"></i><span>
                        Enterpreneur</span></a>
            </li>
            <li class="dropdown ">
                <a href=" " class="nav-link  text-white"><i data-feather="monitor"></i><span>
                        Earning</span></a>
            </li>
            <li class="dropdown ">
                <a href=" " class="nav-link  text-white"><i data-feather="monitor"></i><span>
                        Leading</span></a>
            </li>





        </ul>
    </aside>
</div>
