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
                                Anggaran
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
                <!-- End Pemberitahuan -->
				<div class="row page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item active"><a href="/admin/dashboard">E-Travel</a></li>
						<li class="breadcrumb-item">Anggaran</li>
					</ol>
                </div>
                <!-- row -->
                 <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Data Anggaran Perjalanan Dinas</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-responsive-md" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th style="text-align:center;"><strong>NO</strong></th>
                                                <th style="text-align:center;"><strong>NAMA PPTK</strong></th>
                                                <th style="text-align:center;"><strong>ANGGARAN</strong></th>
                                                <th style="text-align:center;"><strong>STATUS</strong></th>
                                                <th style="text-align:center;"><strong>AKSI</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $d)
                                            <tr>
                                                <td style="color: black; text-align:center;">{{ $loop->iteration }}</td>
                                                <td style="color: black;">{{$d->pegawai->nama}}</td>
                                                <td style="color: black;">Rp {{ number_format($d->total_anggaran ?? 0, 0, ',', '.') }}</td>
                                                @if ($d->jdwl_anggaran == Auth::user()->id_tahun)
                                                        <td style="text-align:center;"><span class="badge light badge-warning">Proses</span></td>
                                                    @else
                                                        <td style="text-align:center;"><span class="badge light badge-success">Selesai</span></td>
                                                @endif
                                                <td>
                                                    <div class="dropdown">
														<button type="button" class="btn btn-primary light sharp" data-bs-toggle="dropdown">
															<svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
														</button>
                                                        @csrf
														<div class="dropdown-menu">
                                                            <a type="button" class="dropdown-item" href="/kpa/anggaran/rincian/{{Crypt::encrypt($d->id)}}"> <i class="fa fa-list color-muted"></i> Rincian</a>
                                                            @if ($d->jdwl_anggaran == Auth::user()->id_tahun)
                                                            <a type="button" class="dropdown-item akses" data-id="{{Crypt::encrypt($d->id)}}"> <i class="fa fa-toggle-on color-muted"></i> Tutup Akses</a>
                                                            @else
                                                            <a type="button" class="dropdown-item akses" data-id="{{Crypt::encrypt($d->id)}}"> <i class="fa fa-toggle-off color-muted"></i> Buka Akses</a>
                                                            @endif
														</div>
													</div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th style="text-align:center; color: rgb(71, 71, 71)" colspan="2"><b>JUMLAH ANGGARAN</b></th>
                                                @php
                                                    $jumlah = $users->sum('total_anggaran');
                                                @endphp
                                                <th style="color: rgb(71, 71, 71)" colspan="3"><b>Rp {{ number_format($jumlah ?? 0, 0, ',', '.') }}</b></th>
                                            </tr>
                                        </tfoot>
                                    </table>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

<!-- Button Akses -->
<script>
$(document).on('click', '.akses', function(){
    var id = $(this).attr('data-id');
Swal.fire({
  title: "Apakah Anda Yakin Ingin Mengubah Status Akses Data Ini ?",
  text: "Jika Ya Maka Status Data Akan Diubah",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Ya, Ubah Status!"
  }).then((result) => {
  if (result.isConfirmed) {
    window.location = "/kpa/anggaran/akses/"+id
    }
  });
});
</script>
<!-- END Button Akses -->

@endpush
