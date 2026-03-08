@extends('layouts.pptk')

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
                                Pengajuan SPJ
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
						<li class="breadcrumb-item">Pengajuan SPJ</li>
					</ol>
                </div>

                @include('pptk.spj.data1')

                <!-- Start Modal -->
                            <div class="modal fade" id="tambahdata">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title">Tambah SPJ</h3>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="basic-form">
                                                <form action="{{ route('a.spj')}}" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label class="form-label">Tanggal Pengajuan :</label>
                                                    <input type="date" name="tgl" class="form-control input-default" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Tujuan Pembayaran :</label>
                                                    <input type="text" name="uraian" class="form-control input-default" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Jenis Perjalanan :</label>
                                                    <select class="input-default form-control" name="jenis" id="jenis" required>
                                                        <option value="">Pilih Jenis Perjalanan</option>
                                                        <option value="1">Dalam Daerah</option>
                                                        <option value="2">Luar Daerah</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Sub Kegiatan :</label>
                                                    <select class="input-default form-control select2" name="subkegiatan" id="subkegiatan" required>
                                                       <option value="">Pilih Sub Kegiatan</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Kode Rekening :</label>
                                                    <select class="input-default form-control select2" name="koderekening" id="koderekening" required>
                                                      <option value="">Pilih Kode Rekening</option>
                                                   </select>
                                                </div>
                                                 <div class="mb-3">
                                                    <label class="form-label">Penerima :</label>
                                                    <select class="input-default form-control" name="pengguna" required>
                                                        <option value="">Pilih Penerima</option>
                                                        <option value="1">Pegawai BPKUK</option>
                                                        <option value="2">Fasilitator</option>
                                                        <option value="3">Peserta Diklat</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->
                            <!-- Start EditModal -->
                            <div class="modal fade" id="modal-editobjek">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title">Edit Data</h3>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                            </button>
                                        </div>
                                        <div class="modal-body" id="loadeditform">
                                            <div class="basic-form">
                                            <!-- Form
                                                        Edit -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->
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

    <style>
        .link-spj{
            color:black;
            text-decoration:none;
            transition:0.2s;
        }

        .link-spj:hover{
            color:#198754;
            text-decoration:underline;
            cursor:pointer;
        }
    </style>

    <!-- Datatable -->
    <script src="{{asset ('assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{asset ('assets/js/plugins-init/datatables.init.js') }}"></script>
    <script src="{{asset ('assets/vendor/select2/js/select2.full.min.js') }}"></script>
    <script src="{{asset ('assets/js/plugins-init/select2-init.js') }}"></script>

<script>

$(document).ready(function(){

// saat jenis perjalanan dipilih
$('#jenis').change(function(){

    var jenis = $(this).val();

    $.ajax({
        type:'POST',
        url:'/get-subkegiatan-jenis',
        data:{
            _token:'{{ csrf_token() }}',
            jenis:jenis
        },

        beforeSend:function(){
            $('#subkegiatan').html('<option>Loading...</option>');
        },

        success:function(data){

            $('#subkegiatan').html('<option value="">Pilih Sub Kegiatan</option>');

            $.each(data,function(key,value){

                $('#subkegiatan').append(
                    '<option value="'+value.id_subkegiatan+'">'+
                    value.subkegiatan.kd_subkegiatan+' - '+value.subkegiatan.nm_subkegiatan+
                    '</option>'
                );

            });

        }

    });

});


// saat sub kegiatan dipilih
$('#subkegiatan').change(function(){

    var id_subkegiatan = $(this).val();
    var jenis = $('#jenis').val();

    $.ajax({
        type:'POST',
        url:'/get-koderekening-jenis',
        data:{
            _token:'{{ csrf_token() }}',
            id_subkegiatan:id_subkegiatan,
            jenis:jenis
        },

        beforeSend:function(){
            $('#koderekening').html('<option>Loading...</option>');
        },

        success:function(data){

            $('#koderekening').html('<option value="">Pilih Kode Rekening</option>');

            $.each(data,function(key,value){

                $('#koderekening').append(
                    '<option value="'+value.id_rekening+'">'+
                    value.rekening.kd_rekening+' - '+value.rekening.nm_rekening+
                    '</option>'
                );

            });

        }

    });

});

});

</script>

<!-- Button Edit SPJ -->
<script>
$(document).on('click', '.edit', function(){

    var id_spj = $(this).data('id');

    $.ajax({
        type:'POST',
        url:'/pengajuanspj/edit',
        data:{
            _token:'{{ csrf_token() }}',
            id_spj:id_spj
        },
        success:function(respond){

            $("#loadeditform").html(respond);
            $("#modal-editobjek").modal("show");

            var selected_subkegiatan = $('#selected_subkegiatan').val();
            var selected_rekening    = $('#selected_rekening').val();

            loadSubKegiatan(selected_subkegiatan);
            loadRekening(selected_subkegiatan, selected_rekening);
        }
    });

});


/* =============================
   LOAD SUBKEGIATAN
============================= */

function loadSubKegiatan(selected_subkegiatan=''){

    var jenis = $('#ejenis').val();

    $.ajax({
        type:'POST',
        url:'/get-subkegiatan-jenis',
        data:{
            _token:'{{ csrf_token() }}',
            jenis:jenis
        },

        beforeSend:function(){
            $('#esubkegiatan').html('<option>Loading...</option>');
        },

        success:function(data){

            $('#esubkegiatan').html('<option value="">Pilih Sub Kegiatan</option>');

            $.each(data,function(key,value){

                var selected = '';

                if(value.id_subkegiatan == selected_subkegiatan){
                    selected = 'selected';
                }

                $('#esubkegiatan').append(
                    '<option value="'+value.id_subkegiatan+'" '+selected+'>'+
                    value.subkegiatan.kd_subkegiatan+' - '+value.subkegiatan.nm_subkegiatan+
                    '</option>'
                );

            });

        }
    });

}


/* =============================
   LOAD REKENING
============================= */

function loadRekening(id_subkegiatan, selected_rekening=''){

    var jenis = $('#ejenis').val();

    $.ajax({
        type:'POST',
        url:'/get-koderekening-jenis',
        data:{
            _token:'{{ csrf_token() }}',
            id_subkegiatan:id_subkegiatan,
            jenis:jenis
        },

        beforeSend:function(){
            $('#ekoderekening').html('<option>Loading...</option>');
        },

        success:function(data){

            $('#ekoderekening').html('<option value="">Pilih Kode Rekening</option>');

            $.each(data,function(key,value){

                var selected = '';

                if(value.id_rekening == selected_rekening){
                    selected = 'selected';
                }

                $('#ekoderekening').append(
                    '<option value="'+value.id_rekening+'" '+selected+'>'+
                    value.rekening.kd_rekening+' - '+value.rekening.nm_rekening+
                    '</option>'
                );

            });

        }
    });

}


/* =============================
   SAAT JENIS DIUBAH
============================= */

$(document).on('change','#ejenis',function(){

    $('#ekoderekening').html('<option value="">Pilih Kode Rekening</option>');
    loadSubKegiatan();

});


/* =============================
   SAAT SUBKEGIATAN DIUBAH
============================= */

$(document).on('change','#esubkegiatan',function(){

    var id_subkegiatan = $(this).val();

    loadRekening(id_subkegiatan);

});

$(document).on('click', '.hapus', function(){
    var id_spj = $(this).attr('data-id');
    Swal.fire({
        title: "Apakah Anda Yakin Data Ini Ingin Di Hapus ?",
        text: "Jika Ya Maka Data Akan Terhapus Permanen",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, Hapus Saja!"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location = "/admin/pelaksana/pegawai/hapus"+id_spj
        }
    });
});

$(document).on('click', '.status', function(){
    var id_spj = $(this).attr('data-id');
    Swal.fire({
        title: "Apakah Anda Yakin Ingin Mengubah Status Data Ini ?",
        text: "Jika Ya Maka Status Data Akan Diubah",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, Ubah Status!"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location = "/admin/pelaksana/pegawai/status"+id_spj
        }
    });
});
</script>
<!-- END Button Edit pegawai -->



@endpush
