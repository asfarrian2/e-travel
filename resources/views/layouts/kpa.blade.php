<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="BPKUK-Travel" />
	<meta name="author" content="Balai Pelatihan Koperasi dan Usaha Kecil Prov. Kalsel" />
	<meta name="robots" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="BPKUK-Travel" />
	<meta property="og:title" content="Sistem Informasi Pengelolaan Perjalanan Dinas" />
	<meta property="og:description" content="Sistem Informasi digital untuk pengelolaan perjalanan dinas yang terintegrasi, mulai dari pembuatan SPT, SPPD, hingga rincian biaya dan pelaporan. Dirancang untuk meningkatkan efisiensi dan akuntabilitas administrasi perjalanan dinas di lingkungan Balai Pelatihan Koperasi dan Usaha Kecil Prov. Kalsel" />
    <meta property="og:image" content="{{ url('images/profile/cover website.png') }}" />
	<meta name="format-detection" content="telephone=no">

	<!-- PAGE TITLE HERE -->
	<title>E-Travel BPKUK</title>

	<!-- FAVICONS ICON -->
	<link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/profile/Default Picture Profile.png') }}" />

	<link href="{{ asset('assets/vendor/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('assets/vendor/nouislider/nouislider.min.css') }}">
     <!-- Datatable -->
     <link href="{{ asset ('assets/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
     <!-- Sweat Alert -->
     <link href="{{ asset ('assets/vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
	<!-- Style css -->
    <link href="{{ asset ('assets/vendor/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset ('assets/vendor/select2/css/select2.min.css') }}">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">


</head>
<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="waviy">
		   <span style="--i:1">E</span>
		   <span style="--i:2">-</span>
		   <span style="--i:3">T</span>
		   <span style="--i:4">R</span>
		   <span style="--i:5">A</span>
		   <span style="--i:6">V</span>
		   <span style="--i:7">E</span>
           <span style="--i:8">L</span>
		</div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="/dashboard" class="brand-logo">
                <img src="{{asset ('assets/images/logo-kalsel.png') }}" height="60px">
                <img src="{{asset ('assets/images/logo-text-3.png') }}" class="brand-title">
            </a>
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        @yield('header')

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="dlabnav">
            <div class="dlabnav-scroll">
				<ul class="metismenu" id="menu">
					<li class="dropdown header-profile">
						<a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                            @if (Auth::user()->profile == 0)
                            <img src="{{ asset('assets/images/profile/profil-cewe.png') }}" width="20" alt=""/>
                            @else
							<img src="{{ asset('assets/images/profile/profil-cowo.png') }}" width="20" alt=""/>
                            @endif
							<div class="header-info ms-3">
								<span class="font-w600 ">{{ Auth::user()->nickname; }}</span>
								<small class="text-start font-w400">{{ Auth::user()->role; }}</small>
							</div>
						</a>
						<div class="dropdown-menu dropdown-menu-end">
							<a href="./email-inbox.html" class="dropdown-item ai-icon">
								<svg id="icon-keys" xmlns="http://www.w3.org/2000/svg" class="text-success" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
								<span class="ms-2">Ganti Password </span>
							</a>
							<a href="{{ Route('logout')}}" class="dropdown-item ai-icon">
								<svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
								<span class="ms-2">Logout </span>
							</a>
						</div>
					</li>
                    <div class="copyright">
					<p><strong>Home</strong></p>
				    </div>
                    <li>
                        <a class="ai-icon" href="/kpa/dashboard" aria-expanded="false" @if(Request::is('kpa/dashboard*')) style="background-color: #eefaf9;" @endif>
							<i class="flaticon-025-dashboard"></i>
							<span class="nav-text">Dashboard</span>
						</a>
                    </li>
                    <div class="copyright">
					<p><strong>Entry</strong></p>
				    </div>
                    <li>
                        <a class="ai-icon" href="/kpa/anggaran" aria-expanded="false" @if(Request::is('kpa/anggaran*')) style="background-color: #eefaf9;" @endif>
							<i class="flaticon-007-bulleye"></i>
							<span class="nav-text">Anggaran</span>
						</a>
                    </li>
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false"  @if(Request::is('kpa/perjalanan*')) style="background-color: #eefaf9;" @endif>
							<i class="flaticon-381-location-3" @if(Request::is('kpa/perjalanan*')) style="color: #5bcfc5;" @endif></i>
							<span class="nav-text">Perjalanan</span>
						</a>
                        <ul aria-expanded="false">
                            <li @if(Request::is('kpa/perjalanan/dinas*')) class="mm-active" @endif><a href="/kpa/perjalanan/dinas" @if(Request::is('kpa/perjalanan/dinas*')) class="mm-active" @endif>Dinas</a></li>
                            <li @if(Request::is('kpa/perjalanan/fasilitator*')) class="mm-active" @endif><a href="/kpa/perjalanan/fasilitator" @if(Request::is('kpa/perjalanan/fasilitator*')) class="mm-active" @endif>Fasilitator</a></li>
                            <li @if(Request::is('kpa/perjalanan/diklat*')) class="mm-active" @endif><a href="/kpa/perjalanan/diklat" @if(Request::is('kpa/perjalanan/diklat*')) class="mm-active" @endif>Peserta Diklat</a></li>
                        </ul>
                    </li>
                    <div class="copyright">
                    <p><strong>Other</strong></p>
                    </div>
                    <li><a class="ai-icon" href="javascript:void()" aria-expanded="false">
						<i class="flaticon-060-on"></i>
							<span class="nav-text">Informasi</span>
						</a>
                    </li>
                </ul>
				<div class="copyright">
					<p><strong>E-Travel v.1.0</strong> © 2026 BPKUK Prov. Kalsel</p>
				</div>
			</div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->
        @yield('content')


        <!--**********************************
            Footer start
        ***********************************-->

        <div class="footer">

            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="https://dexignlab.com/" target="_blank">Balatkop-uk Prov. Kalsel</a> 2026</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->




	</div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('assets/vendor/global/global.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @stack('myscript')
	<script src="{{ asset('assets/vendor/chart.js/Chart.bundle.min.js') }}"></script>
	<script src="{{ asset('assets/vendor/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script>

    <script src="{{ asset('assets/js/custom.min.js') }}"></script>
	<script src="{{ asset('assets/js/dlabnav-init.js') }}"></script>

</body>
</html>
