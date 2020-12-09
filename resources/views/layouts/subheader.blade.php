    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-light navbar-shadow">
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
					<img src="{{ URL::asset('assets/img/logo.png') }}" alt="logo" class="brand" data-src="{{ URL::asset('assets/img/logo_white.png') }}" data-src-retina="{{ URL::asset('assets/img/logo_white_2x.png')}}" width="100">
                    </div>
                    <ul class="nav navbar-nav float-right">
                      
                        <li class="nav-item d-none d-lg-block">
						<a class="nav-link nav-link-expand"><i class="ficon feather icon-maximize"></i></a></li>
						
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link" href="#logout" data-toggle="modal" data-target="#logout"><i class="ficon feather icon-power"></i></a></li>
						
                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <div class="user-nav d-sm-flex d-none"><span class="user-name text-bold-600">{{Auth::user()->nom}} {{Auth::user()->prenom}}</span><span class="user-status"></span></div><span><img class="round" src="{{ asset('app-assets/images/portrait/small/avatar-s-5.jpg') }}" alt="avatar" height="40" width="40"></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    