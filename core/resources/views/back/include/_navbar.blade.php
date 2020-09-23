<div class="navbar navbar-inverse navbar-fixed-top">
    <!-- start: TOP NAVIGATION CONTAINER -->
    <div class="container">
        <div class="navbar-header">
            <!-- start: RESPONSIVE MENU TOGGLER -->
            <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                <span class="clip-list-2"></span>
            </button>
            <!-- end: RESPONSIVE MENU TOGGLER -->
            <!-- start: LOGO -->
            <a class="navbar-brand" href="http://dpm.bpsdm.dephub.go.id/admin/public">BADAN PENGEMBANGAN SDM PERHUBUNGAN</a>
            <!-- end: LOGO -->
        </div>
        <div class="navbar-tools">
            <!-- start: TOP NAVIGATION MENU -->
            <ul class="nav navbar-right">
                <!-- start: TO-DO DROPDOWN -->
              
                <!-- end: TO-DO DROPDOWN-->
            
               
                <!-- start: USER DROPDOWN -->
                <li class="dropdown current-user">
                    <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true"
                        href="#">
                        <img src="{{ asset('file_app/user_avatar/'.auth()->user()->avatar) }}" style="width: 30px" class="circle-img" alt="">
                        <span class="username">{{ auth()->user()->name }}</span>
                        <i class="clip-chevron-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route('profil.edit') }}">
                                <i class="clip-user-2"></i> &nbsp;Profil
                            </a>
                        </li>
                        {{-- <li>
                            <a href="pages_calendar.html">
                                <i class="clip-calendar"></i> &nbsp;My Calendar
                            </a>
                        <li>
                            <a href="pages_messages.html">
                                <i class="clip-bubble-4"></i> &nbsp;My Messages (3)
                            </a>
                        </li> --}}
                        <li class="divider"></li>
                        {{-- <li>
                            <a href="utility_lock_screen.html">
                                <i class="clip-locked"></i> &nbsp;Lock Screen
                            </a>
                        </li> --}}
                        <li>
                            <a href="javascript:void(0)" onclick="logout()">
                                <i class="clip-exit"></i> &nbsp;Log Out
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- end: USER DROPDOWN -->
                <!-- start: PAGE SIDEBAR TOGGLE -->
               
                <!-- end: PAGE SIDEBAR TOGGLE -->
            </ul>
            <!-- end: TOP NAVIGATION MENU -->
        </div>
    </div>
    <!-- end: TOP NAVIGATION CONTAINER -->
</div>