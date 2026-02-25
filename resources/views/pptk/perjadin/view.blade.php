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
                                Perjalanan Dinas
                            </div>
                        </div>
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
						<li class="breadcrumb-item">Perjalanan Dinas</li>
					</ol>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-body">
                            <form action="/perjalanan/dinas" method="GET">
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

                @include('pptk.perjadin.data1')


                @endif
                <!-- Start Modal Tambah Dalam Daerah -->
                <div class="modal fade" id="tambahdata1">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Tambah Perjalanan Dinas</h3>
                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="basic-form">
                                    <form action="{{ route('a.perjadin')}}" method="POST">
                                    @csrf    
                                    <input type="hidden" name="jenis" value="1"  class="form-control input-default" required>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Dasar Perjalanan :</label>
                                        <textarea style="height: 80px;" name="dasar" class="form-control" required></textarea>
                                    </div> 
                                    <div class="mb-3">
                                        <label class="form-label">Keperluan / Perihal:</label>
                                        <textarea style="height: 80px;" name="keperluan" class="form-control" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tujuan :</label>
                                        <select class="input-default form-control" name="tujuan" required>
                                            <option value="">-Pilih Tujuan-</option>
                                            <option value="Kota Banjarbaru">Kota Banjarbaru</option>
                                            <option value="Kota Banjarmasin">Kota Banjarmasin</option>
                                            <option value="Kab. Banjar">Kab. Banjar</option>
                                            <option value="Kab. Balangan">Kab. Balangan</option>
                                            <option value="Kab. Barito Kuala">Kab. Barito Kuala</option>
                                            <option value="Kab. Tanah Laut">Kab. Tanah Laut</option>
                                            <option value="Kab. Tanah Bumbu">Kab. Tanah Bumbu</option>
                                            <option value="Kab. Kotabaru">Kab. Kotabaru</option>
                                            <option value="Kab. Tabalong">Kab. Tabalong</option>
                                            <option value="Kab. Tapin">Kab. Tapin</option>
                                            <option value="Kab. Hulu Sungai Selatan">Kab. Hulu Sungai Selatan</option>
                                            <option value="Kab. Hulu Sungai Tengah">Kab. Hulu Sungai Tengah</option>
                                            <option value="Kab. Hulu Sungai Utara">Kab. Hulu Sungai Utara</option>
                                        </select>
                                    </div>
                                    <div class="row col-12">  
                                        <div class="mb-3 col-6">
                                            <label class="form-label">Tanggal Berangkat :</label>
                                            <input type="date" name="tgl_berangkat" id="tgl_berangkat" class="form-control input-default" required>
                                        </div> 
                                        <div class="mb-3 col-6">
                                            <label class="form-label">Tanggal Pulang :</label>
                                            <input type="date" name="tgl_pulang" id="tgl_pulang" class="form-control input-default" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Angkutan :</label>
                                        <input type="text" name="angkutan"  class="form-control input-default" required>
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
                <!-- End Modal Tambah Dalam Daerah -->

                            <!-- Start EditModal -->
                            <div class="modal fade" id="modal-editobjek">
                                <div class="modal-dialog modal-lg" role="document">
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
                            <!-- Start EditModal -->
                            <div class="modal fade" id="modal-kirim">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title">Dasar Anggaran Kegiatan</h3>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                            </button>
                                        </div>
                                        <div class="modal-body" id="loadkirim">
                                            <div class="basic-form">
                                            <!-- Form
                                                        Edit -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->
                            <!-- Start +PegawaiModal -->
                            <div class="modal fade" id="modal-addpegawai">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title">Tambah Pegawai</h3>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                            </button>
                                        </div>
                                        <div class="modal-body" id="loadaddpegawai">
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" id="simpan-pegawai"><i class="fa fa-save color-muted"></i> Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End +PegawaiModal -->
                            <!-- Start List PegawaiModal -->
                            <div class="modal fade" id="modal-listpegawai">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title">List Pegawai</h3>
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

    <script>
    const tglBerangkat = document.getElementById('tgl_berangkat');
    const tglPulang = document.getElementById('tgl_pulang');

    tglBerangkat.addEventListener('change', () => {
        tglPulang.min = tglBerangkat.value;
    });
    </script>

    <!-- Button Edit Perjadin -->
    <script>
    $(document).on('click', '.kirim', function(){
    var id_perjalanan = $(this).attr('data-id');
    $.ajax({
        type: 'POST',
        url: '/perjalanan/dinas/kirim',
        cache: false,
        data: {
            _token: "{{ csrf_token() }}",
            id_perjalanan: id_perjalanan
        },
        success: function(respond) {
            $("#loadkirim").html(respond);
            $(document).on('change', '#ksubkegiatan', function () {

            let id_sub = $(this).val();

            $('#kkoderekening').html('<option value="">Loading...</option>');

            if (id_sub !== '') {

                $.ajax({
                    type: 'POST',
                    url: "{{ route('get.koderekening') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id_subkegiatan: id_sub
                    },
                    success: function (response) {

                        let html = '<option value="">Pilih Kode Rekening</option>';

                        $.each(response, function (key, item) {
                            html += `<option value="${item.rekening.id_rekening}">
                                        ${item.rekening.kd_rekening} - ${item.rekening.nm_rekening}
                                     </option>`;
                        });

                        $('#kkoderekening').html(html).trigger('change');
                    }
                });

            } else {
                $('#kkoderekening').html('<option value="">Pilih Kode Rekening</option>');
            }

        });
        $(document).on('change', '#kkoderekening', function () {

        let id_sub = $('#ksubkegiatan').val();
        let id_rek = $(this).val();

        $('#kanggaran').html('<option value="">Loading...</option>');

        if (!id_rek) {
            $('#kanggaran').html('<option value="">Pilih Anggaran</option>');
            return;
        }

        $.ajax({
            type: 'POST',
            url: "{{ route('get.anggaranperjalanan') }}",
            data: {
                _token: "{{ csrf_token() }}",
                id_subkegiatan: id_sub,
                id_rekening: id_rek
            },
            success: function (response) {

                let grouped = {};

                $.each(response, function (key, item) {

                    if (!grouped[item.nm_anggaran]) {
                        grouped[item.nm_anggaran] = [];
                    }

                    grouped[item.nm_anggaran].push(item);

                });

                let html = '<option value="">Pilih Anggaran</option>';

                $.each(grouped, function (namaAnggaran, items) {

                    html += `<optgroup label="${namaAnggaran}">`;

                    $.each(items, function (i, item) {

                        html += `<option value="${item.id_anggaran}">
                                    ${item.sub_anggaran}
                                 </option>`;

                    });

                    html += `</optgroup>`;
                });

            $('#kanggaran')
                .html(html)
                .trigger('change');
        }
    });

});
        }
    });
    $("#modal-kirim").modal("show");
    });
    </script>
    <!-- END Button Edit Perjadin -->

    <!-- Button Status -->
    <script>
    $(document).on('click', '.batal', function(){
        var id_perjalanan = $(this).attr('data-id');
    Swal.fire({
      title: "Apakah Anda Yakin Ingin Membatalkan Data Ini ?",
      text: "Jika Ya Maka Status Data Akan Diubah",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, Batalkan !"
      }).then((result) => {
      if (result.isConfirmed) {
        window.location = "/perjalanan/dinas/batal/"+id_perjalanan
        }
      });
    });
    </script>
    <!-- END Button Status -->

    <!-- Button Edit Perjadin -->
    <script>
    $(document).on('click', '.edit', function(){
    var id_perjalanan = $(this).attr('data-id');
    $.ajax({
        type: 'POST',
        url: '/perjalanan/dinas/edit',
        cache: false,
        data: {
            _token: "{{ csrf_token() }}",
            id_perjalanan: id_perjalanan
        },
        success: function(respond) {
            $("#loadeditform").html(respond);
        }
    });
    $("#modal-editobjek").modal("show");
    });
    </script>
    <!-- END Button Edit Perjadin -->

    <!-- Start Button Hapus -->
    <script>
    $(document).on('click', '.hapus', function(){
        var id_perjalanan = $(this).attr('data-id');
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
        window.location = "/admin/perjadin/pegawai/hapus"+id_perjalanan
      }
    });
    });
    </script>
    <!-- End Button Hapus -->

    <!-- Button Status -->
    <script>
    $(document).on('click', '.status', function(){
        var id_perjalanan = $(this).attr('data-id');
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
        window.location = "/admin/perjadin/pegawai/status"+id_perjalanan
        }
      });
    });
    </script>
    <!-- END Button Status -->
    
    <script>
    var id_perjalanan;

    // =======================
    // BUKA MODAL + LOAD PEGAWAI
    // =======================
    $(document).on('click', '.addpegawai', function () {
        id_perjalanan = $(this).attr('data-id');

        $.ajax({
            type: 'POST',
            url: '/perjalanan/dinas/addpegawai',
            cache: false,
            data: {
                _token: "{{ csrf_token() }}",
                id_perjalanan: id_perjalanan
            },
            success: function (respond) {
                $("#loadaddpegawai").html(respond);
                $("#modal-addpegawai").modal("show");
            }
        });
    });

    // =======================
    // SIMPAN PEGAWAI
    // =======================
    $(document).on('click', '#simpan-pegawai', function () {

    var pegawaiId = [];
    $('.pegawai-checkbox:checked').each(function () {
        pegawaiId.push($(this).val());
    });

    if (pegawaiId.length === 0) {
        Swal.fire({
            icon: 'warning',
            title: 'Perhatian',
            text: 'Pilih Minimal Satu Pegawai'
        });
        return;
    }

        $.ajax({
            type: 'POST',
            url: '/simpanperjadin-pegawai',
            data: {
                _token: '{{ csrf_token() }}',
                id_perjalanan: id_perjalanan,
                pegawai_id: pegawaiId
            },
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses',
                        text: response.message,
                    }).then(() => {
                        location.reload(); //REFRESH HALAMAN
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: response.error ?? 'Terjadi kesalahan'
                    });
                }
            },
            error: function (xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: xhr.responseJSON?.error ?? 'Server error'
                });
            }
        });
    });
    </script>

    <script>
/* ===============================
   BUKA MODAL & LOAD LIST PEGAWAI
================================ */
$(document).on('click', '.listpegawai', function () {

    let id_perjalanan = $(this).data('id');

    $.ajax({
        type: 'POST',
        url: '/perjalanan/dinas/listpegawai',
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

/* ===============================
   CHECK ALL
================================ */
$(document).on('click', '#check-all', function () {
    $('.hapus-checkbox').prop('checked', this.checked);
});

/* ===============================
   HAPUS DATA TERPILIH
================================ */
$(document).on('click', '#hapus-terpilih', function () {

    let ids = [];
    $('.hapus-checkbox:checked').each(function () {
        ids.push($(this).val());
    });

    if (ids.length === 0) {
        Swal.fire('Perhatian', 'Pilih data yang ingin dihapus', 'warning');
        return;
    }

    Swal.fire({
        title: 'Yakin?',
        text: 'Data yang dihapus tidak dapat dikembalikan',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {

        if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: '/hapusperjadin-pegawai',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ids
                },
                success: function (res) {
                    if (res.success) {
                        Swal.fire('Sukses', res.message, 'success')
                        .then(() => {
                            // reload isi modal TANPA reload halaman
                             location.reload();
                        });
                    } else {
                        Swal.fire('Gagal', res.message, 'error');
                    }
                },
                error: function () {
                    Swal.fire('Error', 'Terjadi kesalahan server', 'error');
                }
            });
        }

    });
});
</script>



@endpush
