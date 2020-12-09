    <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto"><a class="navbar-brand" href="#">
					
                    
					<h4 class="brand-text mb-0" style="font-size: 1.32rem;">PREZ MANAGER</h4>
					</a></li>
                <li class="nav-item nav-toggle">
				<a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
				<i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i>
				<i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i>
				</a>
				</li>
            </ul>
        </div>
        <div class="shadow-bottom" style="display: block;"></div>
        <div class="main-menu-content" style="margin-top: 20px;">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <?php $uri=Route::getFacadeRoot()->current()->uri()?>
				
                <li class="{{ (Request::is('/') ) ? 'active' : '' }} nav-item"><a href="{{ URL::to('/') }}"><i class="feather icon-home"></i>
				<span class="menu-title" data-i18n="Email">Accueil</span></a>
                </li>
				
				
                <li class="{{ (Request::is('presentation*')) ? 'active' : '' }} nav-item"><a href="{{ URL::to('presentation') }}"><i class="feather icon-folder"></i>
				<span class="menu-title" data-i18n="Email">Présentations</span></a>
                </li>
				
                <li class="{{ (Request::is('product*')) ? 'active' : '' }} nav-item"><a href="{{ URL::to('product') }}"><i class="feather icon-grid"></i>
				<span class="menu-title" data-i18n="Email">Produits</span></a>
                </li>
				
                <li class="{{ (Request::is('personnel*')) ? 'active' : '' }} nav-item"><a href="{{ URL::to('personnel') }}"><i class="feather icon-user"></i>
				<span class="menu-title" data-i18n="Email">Personnels</span></a>
                </li>
				
                <li class="{{ (Request::is('groupe*')) ? 'active' : '' }} nav-item"><a href="{{ URL::to('groupe') }}"><i class="feather icon-users"></i>
				<span class="menu-title" data-i18n="Email">Groupes</span></a>
                </li>
            </ul>
        </div>
    </div>
   