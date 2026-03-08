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
                                Rincian SPJ
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
						<li class="breadcrumb-item active"><a href="/dashboard">E-Travel</a></li>
                        <li class="breadcrumb-item active"><a href="/pengajuanspj">Pengajuan SPJ</a></li>
						<li class="breadcrumb-item">Rincian SPJ</li>
					</ol>
                </div>
                <!-- row -->
                 <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Data SPJ</h4>
                            </div>
                            <div class="card-body">
                                <table style="color:black">
                                    <tr>
                                        <td style="width: 19%; padding-bottom:10px; vertical-align: top;">Tanggal</td>
                                        <td style="padding-bottom:10px; vertical-align: top;">&nbsp; : &nbsp;</td>
                                        <td style="padding-bottom:10px; vertical-align: top;"> {{ \Carbon\Carbon::parse($spj->tgl)->locale('id')->translatedFormat('d F Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 19%; padding-bottom:10px; vertical-align: top;">Tujuan Pembayaran</td>
                                        <td style="padding-bottom:10px; vertical-align: top;">&nbsp; : &nbsp;</td>
                                        <td style="padding-bottom:10px; vertical-align: top;"> <b>{{ $spj->uraian }}</b></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 19%; padding-bottom:10px; vertical-align: top;">Jenis Perjalanan</td>
                                        <td style="padding-bottom:10px; vertical-align: top;">&nbsp; : &nbsp;</td>
                                        <td style="padding-bottom:10px; vertical-align: top;"> @if ($spj->status == 1) Dalam Daerah @else Luar Daerah @endif </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 19%; padding-bottom:10px; vertical-align: top;">Sub Kegiatan</td>
                                        <td style="padding-bottom:10px; vertical-align: top;">&nbsp; : &nbsp;</td>
                                        <td style="padding-bottom:10px; vertical-align: top;"> {{ $spj->subkegiatan->kd_subkegiatan }} {{ $spj->subkegiatan->nm_subkegiatan }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 19%; padding-bottom:10px; vertical-align: top;">Kode Rekening</td>
                                        <td style="padding-bottom:10px; vertical-align: top;">&nbsp; : &nbsp;</td>
                                        <td style="padding-bottom:10px; vertical-align: top;"> {{ $spj->rekening->kd_rekening }} {{ $spj->rekening->nm_rekening }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 19%; padding-bottom:10px; vertical-align: top;">Total Nilai</td>
                                        <td style="padding-bottom:10px; vertical-align: top;">&nbsp; : &nbsp;</td>
                                        <td style="padding-bottom:10px; vertical-align: top;"> <b>Rp {{ number_format($spj->total_realisasi ?? 0) }}</b></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 19%; padding-bottom:10px; vertical-align: top;">Status</td>
                                        <td style="padding-bottom:10px; vertical-align: top;">&nbsp; : &nbsp;</td>
                                        <td style="padding-bottom:10px; vertical-align: top;"> 
                                            @if ($spj->status == 1) 
                                            <i class="fa fa-file"></i> Draft
                                            @elseif ($spj->status == 2)
                                            <i class="fa fa-submit"></i> Terkirim
                                            @elseif ($spj->status == 3)
                                            <i class="fa fa-check"></i> Disetujui
                                            @elseif ($spj->status == 0)
                                            <i class="fa fa-check"></i> Selesai
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                 </div>
                <!-- row -->
                 <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Rincian SPJ</h4>
                                @if ($spj->status == 1 )
                                <a type="button" class="btn btn-primary addperjalanan" data-id="{{Crypt::encrypt($spj->id_spj)}}">+Tambah</a>
                                @endif
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-responsive-sm" style="min-width: 1200px">
                                        <thead>
                                            <tr>
                                                <th style="text-align:center;">NOMOR</th>
                                                <th style="text-align:center;">TANGGAL</th>
                                                <th style="text-align:center;">KEPERLUAN / PERIODE / TUJUAN</th>
                                                <th style="text-align:center;">PELAKSANA</th>
                                                <th style="text-align:center;">NOMINAL</th>
                                                <th style="text-align:center;">AKSI</th>
                                            </tr>
                                        </thead>
                                        <tbody class="collapse-group">
                                        @foreach ($subspj as $d)
                                        <tr>
                                            <td style="text-align:center;">
                                                <div class="perjalanan-header collapsed"
                                                     data-bs-toggle="collapse"
                                                     data-bs-target="#collapse{{$d->perjalanan->id_perjalanan}}">
                                                {{ $d->perjalanan->nomor_perjalanan }}                                    
                                                </div>
                                                </td>
                                            <td style="color: black; text-align:center;">
                                                {{ \Carbon\Carbon::parse($d->perjalanan->tgl)->format('d/m/Y') }}
                                            </td>

                                            <td style="color: black;">
                                                <b>{{$d->perjalanan->keperluan}}</b>
                                                <br>
                                                <div style="font-size: 12px">
                                                    Periode :
                                                    {{ \Carbon\Carbon::parse($d->perjalanan->tgl_berangkat)->format('d/m/Y') }}
                                                    -
                                                    {{ \Carbon\Carbon::parse($d->perjalanan->tgl_pulang)->format('d/m/Y') }}
                                                    ({{ \Carbon\Carbon::parse($d->perjalanan->tgl_pulang)->diffInDays(\Carbon\Carbon::parse($d->perjalanan->tgl_berangkat)) + 1 }} Hari)
                                                    <br>
                                                    Tujuan: {{ $d->perjalanan->tujuan }}
                                                </div>
                                            </td>
                                            <td style="color: black;">
                                                @php
                                                    $jumlah = $d->perjalanan->pelperjadin->count();
                                                @endphp

                                                @if ($jumlah == 0)
                                                    <span style="color:red">Data Tidak Ada</span>
                                                @else
                                                    {{ $jumlah }} Orang
                                                @endif
                                            </td>
                                            <td style="text-align:center; color: black;">
                                                <b>Rp{{ number_format($d->total_realisasi ?? 0) }}</b>
                                            </td>
                                            <td>
                                                <div class="dropdown">
								        			<button type="button" class="btn btn-primary light sharp" data-bs-toggle="dropdown">
								        				<svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
								        			</button>
                                                    @csrf
								        			<div class="dropdown-menu">
                                                        <a type="button" class="dropdown-item hapus" data-id="{{Crypt::encrypt($d->id_perjalanan)}}" ><i class="fa fa-trash color-muted"></i> Hapus</a>
								        			</div>
								        		</div>
                                            </td>
                                        </tr>
                                        <tr class="collapse-row">
                                            <td colspan="6">
                                                <div id="collapse{{$d->perjalanan->id_perjalanan}}"
                                                        class="collapse"
                                                        data-bs-parent=".collapse-group">
                                                    <div class="accordion-body-text">
                                                        <div class="mb-3 d-flex gap-2">
                                                            <a type="button" class="adduh btn btn-twitter btn-xs flex-fill" data-id="{{ Crypt::encrypt($d->id_perjalanan)}}"  data-ids="{{ Crypt::encrypt($d->id_subspj)}}"><i class="fa fa-plus"></i> Uang Harian</a>
                                                            <a type="button" class="addut btn btn-skype btn-xs flex-fill" data-id="{{ Crypt::encrypt($d->id_perjalanan)}}" ><i class="fa fa-car"></i> Uang Transport</a>
                                                            <a type="button" class="addup btn btn-vimeo btn-xs flex-fill" data-id="{{ Crypt::encrypt($d->id_perjalanan)}}" ><i class="fa fa-building"></i> Uang Penginapan</a>
                                                        </div>
                                                        <div class="table-responsive">
                                                            <table data-perjalanan="{{ $d->id_perjalanan }}" class="table table-bordered table-responsive-sm" style="min-width: 1200px">
                                                                    <tr>
                                                                        <td style="text-align:center; color: black; font-size: 12px" rowspan="2"><b>NO.</b></td>
                                                                        <td style="text-align:center; color: black; font-size: 12px" rowspan="2"><b>NAMA / GOLONGAN / NIP</b></td>
                                                                        <td style="text-align:center; color: black; font-size: 12px" rowspan="2"><b>UANG HARIAN</b></td>
                                                                        <td style="text-align:center; color: black; font-size: 12px" rowspan="2"><b>UANG TRANSPORT</b></td>
                                                                        <td style="text-align:center; color: black; font-size: 12px" colspan="2"><b>PENGINAPAN</b></td>
                                                                        <td style="text-align:center; color: black; font-size: 12px" rowspan="2"><b>JUMLAH</b></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="text-align:center; color: black; font-size: 12px"><b>UANG PENGINAPAN</b></td>
                                                                        <td style="text-align:center; color: black; font-size: 12px"><b>NAMA PENGINAPAN</b></td>
                                                                    </tr>
                                                                    @foreach ($d->perjalanan->pelperjadin->sortBy('pelaksana.kelas') as $r)
                                                                    <tr>
                                                                       <td style="text-align:center; color: black; font-size: 12px;"> 
												                        	{{ $loop->iteration}}
												                        </td>
                                                                        <td style="color: black; font-size: 12px"> 
                                                                            <b>{{ $r->pelaksana->nama }}</b> <br>
                                                                            {{ $r->pelaksana->pangkgol }}<br>
                                                                            NIP. {{ $r->pelaksana->nip }}
                                                                        </td>
                                                                        <td style="text-align:center; color:black; font-size:12px">@if($r->uang_harian == NULL) 
                                                                            Rp0 @else Rp{{ number_format($r->uang_harian) }} @endif</td>
                                                                        <td style="text-align:center; color: black; font-size: 12px"> @if($r->uang_transport == NULL) Rp0 @else Rp{{ number_format($r->uang_transport) }} @endif</td>
                                                                        <td style="text-align:center; color: black; font-size: 12px"> @if($r->uang_penginapan == NULL) Rp0 @else Rp{{ number_format($r->uang_penginapan) }} @endif</td>
                                                                        <td style="text-align:center; color: black; font-size: 12px"> @if($r->nama_penginapan == NULL) - @else {{$r->nama_penginapan}} @endif </td>
                                                                        <td style="text-align:center; color: black; font-size: 12px"><b>Rp{{ number_format(($r->uang_harian ?? 0) + ($r->uang_transport ?? 0) + ($r->uang_penginapan ?? 0)) }}</b></td>
                                                                    </tr>
                                                                    @endforeach
                                                                <tfoot>
                                                                    <tr>
                                                                        <td style="text-align:center; color: black; font-size: 12px" colspan="2"><b>JUMLAH</b></td>
                                                                        <td style="text-align:center; color: black; font-size: 12px"><b> Rp{{ number_format($totals[$d->id_perjalanan]->total_harian ?? 0) }} </b></td>
                                                                        <td style="text-align:center; color: black; font-size: 12px"><b> Rp{{ number_format($totals[$d->id_perjalanan]->total_transport ?? 0) }} </b></td>
                                                                        <td style="text-align:center; color: black; font-size: 12px"><b> Rp{{ number_format($totals[$d->id_perjalanan]->total_penginapan ?? 0) }} </b></td>
                                                                        <td></td>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th style="text-align:center;">NOMOR</th>
                                                <th style="text-align:center;">TANGGAL</th>
                                                <th style="text-align:center;">KEPERLUAN / PERIODE / TUJUAN</th>
                                                <th style="text-align:center;">PELAKSANA</th>
                                                <th style="text-align:center;">NOMINAL</th>
                                                <th style="text-align:center;">AKSI</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <!-- Start +PegawaiModal -->
                            <div class="modal fade" id="modal-addperjalanan">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title">Tambah Perjalanan</h3>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                            </button>
                                        </div>
                                        <div class="modal-body" id="loadaddperjalanan">
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" id="simpan-perjalanan"><i class="fa fa-save color-muted"></i> Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End +perjalananModal -->
                            <!-- Start Modal Uang Harian -->
                            <div class="modal fade" id="modal-uangharian">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title">Input Uang Harian</h3>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                            </button>
                                        </div>
                                        <div class="modal-body" id="formuangharian">
                                            <div class="basic-form">
                                            <!-- Form
                                                        Edit -->
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" id="simpan-uangharian"><i class="fa fa-save color-muted"></i> Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal Uang Harian -->
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
        <script src="{{asset ('assets/vendor/select2/js/select2.full.min.js') }}"></script>
    <script src="{{asset ('assets/js/plugins-init/select2-init.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

<style>
    .perjalanan-header{
    background-color:#f9f9f9; /* light primary */
    color:#00a7ea;
    padding:6px 10px;
    border-radius:6px;
    font-weight:600;
    cursor:pointer;
    display:inline-block;
    }
    
    /* saat accordion terbuka */
    .perjalanan-header:not(.collapsed){
        background-color:#00a7ea; /* primary */
        color:white;
    }
</style>

<script>
    $(document).ready(function(){
        $('.pagu').mask("#.##0", { reverse:true });
    });
</script>

<script>
    $('.checkAll').on('click', function () {
        let table = $(this).closest('table');
        table.find('.checkItem').prop('checked', $(this).prop('checked'));
    });
</script>

<script>
    var id_spj;

    $(document).on('click', '.addperjalanan', function () {
        id_spj = $(this).attr('data-id');

        $.ajax({
            type: 'POST',
            url: '/pengajuanspj/addperjalanan',
            cache: false,
            data: {
                _token: "{{ csrf_token() }}",
                id_spj: id_spj
            },
            success: function (respond) {
                $("#loadaddperjalanan").html(respond);
                $("#modal-addperjalanan").modal("show");
            }
        });
    });

    // SIMPAN PERJALANAN
    $(document).on('click', '#simpan-perjalanan', function () {

    var perjalananId = [];
    $('.perjalanan-checkbox:checked').each(function () {
        perjalananId.push($(this).val());
    });

    if (perjalananId.length === 0) {
        Swal.fire({
            icon: 'warning',
            title: 'Perhatian',
            text: 'Pilih Minimal Satu Perjalanan'
        });
        return;
    }

        $.ajax({
            type: 'POST',
            url: '/simpanspj-perjalanan',
            data: {
                _token: '{{ csrf_token() }}',
                id_spj: id_spj,
                perjalanan_id: perjalananId
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

{{-- Simpan Uang Harian --}}
    <script>    
    var id_perjalanan;
    var id_subspj;

    $(document).on('click', '.adduh', function(){

    id_perjalanan = $(this).data('id');
    id_subspj = $(this).data('ids');

        $.ajax({
            type: 'POST',
            url: '/rincianspj/add-uangharian',
            data: {
                _token: "{{ csrf_token() }}",
                id_perjalanan: id_perjalanan,
                id_subspj: id_subspj
            },

            success: function (respond) {

                $("#formuangharian").html(respond);
                $("#modal-uangharian").modal("show");

                $('.pagu').mask("#.##0", { reverse:true });

                $('#anggaran').select2({
                    placeholder: "Cari Anggaran...",
                    dropdownParent: $('#modal-uangharian'),
                    width: '100%'
                });

                $('.checkAll').on('click', function () {

                    let table = $(this).closest('table');
                    table.find('.checkItem').prop('checked', $(this).prop('checked'));

                });

            }
        });

    });


    $(document).on('click','#simpan-uangharian',function(){

        let id_rincanggaran = $('#anggaran').val();
        let subspj = $('input[name=subspj]').val();
        let kegunaan = $('input[name=kegunaan]').val();
        let nilai = $('input[name=uang]').val();
        let volume = $('input[name=volume]').val();

        if(id_rincanggaran == ""){
        Swal.fire({
            icon:'warning',
            title:'Perhatian',
            text:'Rincian anggaran harus dipilih'
        });
        return;
    }
    if(nilai == ""){
        Swal.fire({
            icon:'warning',
            title:'Perhatian',
            text:'Nilai uang harian harus diisi'
        });
        return;
    }
    if(volume == ""){
        Swal.fire({
            icon:'warning',
            title:'Perhatian',
            text:'Volume harus diisi'
        });
        return;
    }

        let pelperjadin = [];

        $('.checkItem:checked').each(function(){
            pelperjadin.push($(this).val());
        });

        // VALIDASI CHECKBOX
        if(pelperjadin.length === 0){
            Swal.fire({
                icon:'warning',
                title:'Perhatian',
                text:'Silakan pilih pelaksana terlebih dahulu!',
                confirmButtonText:'OK'
            });
            return; // stop proses ajax
        }

        $.ajax({

            type:"POST",
            url:"/rincianspj/simpan-uangharian",

            data:{
                _token:"{{ csrf_token() }}",
                id_rincanggaran:id_rincanggaran,
                subspj:subspj,
                kegunaan:kegunaan,
                nilai:nilai,
                volume:volume,
                pelperjadin:pelperjadin
            },

            success:function(respond){

                $("#modal-uangharian").modal("hide");

                Swal.fire({
                icon:'success',
                title:'Simpan Berhasil',
                text:'Uang harian berhasil diperbarui',
                timer:1500,
                confirmButtonText:'OK'
                }).then(() => {
                    location.reload();
                });
            }

        });

    });

    </script>
    {{-- END Simpan Uang Harian --}}

<!-- Button Edit pegawai -->
<script>
$(document).on('click', '.edit', function(){
    var id_perjalanan = $(this).attr('data-idp');
    var id_pelaksana = $(this).attr('data-id');
    $.ajax({
        type: 'POST',
        url: '/perjalanan/diklat/peserta/edit',
        cache: false,
        data: {
            _token: "{{ csrf_token() }}",
            id_perjalanan: id_perjalanan,
            id_pelaksana: id_pelaksana
        },
        success: function(respond) {
            $("#loadeditform").html(respond);
            $('.pagu').mask("#.##0", { reverse:true });
        }
    });
    $("#modal-editobjek").modal("show");
});

$(document).on('click', '.hapus', function(){
    var id_pelaksana = $(this).attr('data-id');
    var id_pelperjadin = $(this).attr('data-idp');
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
            window.location = "/perjalanan/diklat/peserta/hapus/"+id_pelaksana+"/"+id_pelperjadin
        }
    });
});

</script>
<!-- END Button Edit pegawai -->

@endpush
