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
                                Perjalanan Fasilitator
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
						<li class="breadcrumb-item active"><a href="/kpa/dashboard">E-Travel</a></li>
						<li class="breadcrumb-item">Perjalanan Fasilitator</li>
					</ol>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-body">
                            <form action="/kpa/perjalanan/fasilitator" method="GET">
                             <div class="mb-3">
                                 <label class="form-label">Jenis Perjalanan :</label>
                                 <select class="input-default form-control" name="jenis" required>
                                     <option value="">Pilih Jenis Perjalanan</option>
                                     <option value="1" {{ request('jenis') == '1' ? 'selected' : '' }}>Dalam Daerah</option>
                                     <option value="2" {{ request('jenis') == '2' ? 'selected' : '' }}>Luar Daerah</option>
                                 </select>  
                             </div>
                             <button type="submit" class="btn btn-secondary"><i class="fa fa-search"></i> Cari</button>  
                            </form>
                            </div>
                        </div>
                    </div>
                </div>

                @if (request('jenis'))

                @include('kpa.perjasum.data1')


                @endif
                            <!-- Start List PegawaiModal -->
                            <div class="modal fade" id="modal-listpegawai">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title">List Fasilitator</h3>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                            </button>
                                        </div>
                                        <div class="modal-body mb-1" id="loadlistpegawai">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End List PegawaiModal -->
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
    <script src="{{asset ('assets/vendor/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{asset ('assets/vendor/select2/js/select2.full.min.js') }}"></script>
    <script src="{{asset ('assets/js/plugins-init/select2-init.js') }}"></script>

    <!-- Button Status -->
    <script>
    $(document).on('click', '.batal', function(){
        var id_perjalanan = $(this).attr('data-id');
    Swal.fire({
      title: "Apakah Anda Yakin Ingin Membatalkan Data Ini ?",
      text: "Jika Ya Maka Data Akan Dikembalikan ke PPTK",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, Batalkan !"
      }).then((result) => {
      if (result.isConfirmed) {
        window.location = "/kpa/perjalanan/fasilitator/batal/"+id_perjalanan
        }
      });
    });
    </script>
    <!-- END Button Status -->

    <!-- Button Status -->
    <script>
    $(document).on('click', '.setuju', function(){
        var id_perjalanan = $(this).attr('data-id');
    Swal.fire({
      title: "Apakah Anda Yakin Ingin Mensetujui Data Ini ?",
      text: "Jika Ya Maka Status Data Akan Tersimpan Permanen",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, Setuju!"
      }).then((result) => {
      if (result.isConfirmed) {
        window.location = "/kpa/perjalanan/fasilitator/setuju/"+id_perjalanan
        }
      });
    });
    </script>
    <!-- END Button Status -->
    
    <script>
    /* ===============================
    BUKA MODAL & LOAD LIST PEGAWAI
    ================================ */
    $(document).on('click', '.listpegawai', function () {

        let id_perjalanan = $(this).data('id');

        $.ajax({
            type: 'POST',
            url: '/kpa/perjalanan/fasilitator/listpelaksana',
            data: {
                _token: "{{ csrf_token() }}",
                id_perjalanan: id_perjalanan
            },
            success: function (respond) {
                $("#loadlistpegawai").html(respond);
                $("#modal-listpegawai").modal("show");
            }
        });
    });

</script>



@endpush
