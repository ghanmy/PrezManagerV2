<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
	@include('layouts.head')
	<!-- Scripts   -->
    <script>
        window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token(),]); ?>
    </script>
	
	
</head>
<body class="vertical-layout vertical-menu-modern semi-dark-layout 2-columns  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="semi-dark-layout">


	@include('layouts.subheader')
	@include('layouts.sidebar')
	  <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
			@section('content')
	  </div>	
	@show


<div class="sidenav-overlay"></div>
<div class="drag-target"></div>
<footer class="footer footer-static footer-light">
        <p class="clearfix blue-grey lighten-2 mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT &copy; <script>
                        document.write(new Date().getFullYear())
                    </script><a class="text-bold-800 grey darken-2" href="www.pixelstrade.com" target="_blank">Pixels Trade,</a>All rights Reserved</span>
           <!-- <button class="btn btn-primary btn-icon scroll-top" type="button"><i class="feather icon-arrow-up"></i></button>-->
        </p>
    </footer>
    
@include('layouts.dialog')
@include('layouts.footer')
</body>
</html>