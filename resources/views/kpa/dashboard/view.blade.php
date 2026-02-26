@extends('layouts.kpa')

@section('header')

		<!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
							<div class="dashboard_bar">
                                Dashboard
                            </div>
                        </div>
                         <ul class="navbar-nav header-right">
                            <li class="nav-item">
								<span class="btn btn-secondary d-sm-inline-block d-none">{{ Auth::user()->tahun->tahun; }}<i class="las la-calendar ms-3 scale5"></i></span>
							</li>
                        </ul>
                    </div>
				</nav>
			</div>
		</div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->
@endsection

@section('content')
		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
        <!-- Start Pemberitahuan -->
        @csrf
        @php
        $messagesuccess = Session::get('success');
        $messagewarning = Session::get('warning');
        @endphp
        @if (Session::get('success'))
                <div class="alert alert-success solid alert-dismissible fade show">
					<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
					<strong>Sukses!</strong> {{ $messagesuccess }}.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                    </button>
                </div>
        @endif
        @if (Session::get('warning'))
                <div class="alert alert-danger solid alert-dismissible fade show">
                <svg viewBox="0 0 24 24" width="24 " height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                <strong>Gagal!</strong> {{ $messagewarning }}.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                    </button>
                </div>
        @endif
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="profile card card-body px-3 pt-3 pb-0">
                            <div class="profile-head">
                                <div class="photo-content">
                                    <img src="{{asset ('assets/images/profile/cover.png') }}" class="img-fluid rounded" alt="">
                                </div>
                                <div class="profile-info">
									<div class="profile-photo">
                                        @if (Auth::user()->profile == 0)
										<img src="{{asset ('assets/images/profile/profil-cewe.png') }}" class="img-fluid rounded-circle" alt="">
                                        @else
										<img src="{{asset ('assets/images/profile/profil-cowo.png') }}" class="img-fluid rounded-circle" alt="">
                                        @endif
									</div>
									<div class="profile-details">
										<div class="profile-name px-3 pt-2">
											<h4 class="text mb-0">SELAMAT DATANG</h4>
											<p>Kelola Data Perjadin dengan mudah dan cepat</p>
										</div>
										<div class="profile-email px-2 pt-2">
											<h4 class="text-primary mb-0">{{Auth::user()->pegawai->nama}}</h4>
											<p>NIP. {{Auth::user()->pegawai->nip}}</p>
										</div>
									</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
			    	<div class="row invoice-card-row">
			    		<div class="col-xl-3 col-xxl-6 col-sm-6">
			    			<div class="card bg-warning invoice-card">
			    				<div class="card-body d-flex">
			    					<div class="icon me-3 d-flex align-items-center justify-content-center">
                                        <i class="bi bi-wallet-fill text-white" style="font-size:30px;"></i>
                                    </div>
			    					<div>
			    						<span class="text-white fs-18">Anggaran</span>
                                        <h2 class="text-white">Rp {{ number_format($totalAnggaran,0,',','.') }}</h2>
                                        <span class="text-white">Sisa Anggaran: Rp 0</span>
			    					</div>
			    				</div>
			    			</div>
			    		</div>
                        <div class="col-xl-3 col-xxl-6 col-sm-6">
			    			<div class="card bg-success invoice-card">
			    				<div class="card-body d-flex">
			    					<div class="icon me-3 d-flex align-items-center justify-content-center">
                                        <i class="bi bi-bar-chart-fill text-white" style="font-size:30px;"></i>
                                    </div>
			    					<div>
			    						<span class="text-white fs-18">Realisasi</span>
                                        <h2 class="text-white">Rp 1.000.000.000</h2>
                                        <span class="text-white">Persentasi: 00 %</span>
			    					</div>
			    				</div>
			    			</div>
			    		</div>
                    </div>
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

@endsection

@push('myscript')
    <!-- Datatable -->
    <script src="{{asset ('assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{asset ('assets/js/plugins-init/datatables.init.js') }}"></script>

@endpush
