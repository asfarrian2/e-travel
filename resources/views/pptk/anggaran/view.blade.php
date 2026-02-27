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
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header flex-wrap border-0 pb-0 align-items-end">
                                <div class="mb-3 me-3">
                                    <h5 class="fs-20 text-black font-w500">Total Anggaran</h5>
                                    <span class="text-num text-black fs-36 font-w500">Rp {{ number_format($totalAnggaran,0,',','.') }}</span>
                                </div>
                                <div class="me-3 mb-3">
                                    <p class="fs-14 mb-1">DPA-SKPD</p>
                                    <span class="text-black fs-16">{{ $tahun->dpa }}</span>
                                </div>
                                <div class="me-3 mb-3">
                                    <p class="fs-14 mb-1">STATUS</p>
                                    @if ($users->jdwl_anggaran == Auth::user()->id_tahun)
                                    <span class="btn btn-rounded btn-warning"><span
                                        class="btn-icon-start text-warning"><i class="fa fa-file"></i>
                                    </span>Draft</span>
                                    @else
                                    <span class="btn btn-rounded btn-success"><span
                                        class="btn-icon-start text-success"><i class="fa fa-check"></i>
                                    </span>Tersimpan</span>
                                    @endif
                                </div>
                                <div class="dropdown mb-auto">
                                    <a href="javascript:void(0);" class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a type="button" class="simpan dropdown-item" data-id="{{ Crypt::encrypt($users->id) }}"><i class="fa fa-send color-muted"></i> Simpan</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Tabel Data</h4>
                                <!-- Button trigger modal -->
                                @if ($users->jdwl_anggaran == Auth::user()->id_tahun)
                                <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#tambahdata">+Tambah</button>
                                @else
                                @endif
                            </div>
                            <!-- Start Modal -->
                            <div class="modal fade" id="tambahdata">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title">Tambah Data</h3>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="basic-form">
                                                <form action="{{ route('a.anggaran')}}" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label class="form-label">Sub Kegiatan :</label>
                                                     <select class="input-default form-control select2" name="subkegiatan" id="subkegiatan" required>
                                                        <option value="">Pilih Sub Kegiatan</option>
                                                        @foreach ($subkegiatan as $d)
                                                        <option value="{{ Crypt::encrypt($d->id_subkegiatan) }}"> {{$d->kd_subkegiatan}} - {{$d->nm_subkegiatan}}</option>
                                                        @endforeach
                                                     </select>
                                                </div>    
                                                <div class="mb-3">
                                                    <label class="form-label">Kode Rekening :</label>
                                                    <select class="input-default form-control select2" name="koderekening" id="koderekening" required>
                                                        <option value="">Pilih Kode Rekening</option>
                                                        @foreach ($koderekening as $d)
                                                        <option value="{{ Crypt::encrypt($d->id_rekening) }}"> {{$d->kd_rekening}} - {{$d->nm_rekening}}</option>
                                                        @endforeach
                                                     </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Nama Anggaran :</label>
                                                    <select name="nm_anggaran" id="nm_anggaran" class="form-control nm_anggaran" required></select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Sub Anggaran :</label>
                                                    <select name="sub_anggaran" id="sub_anggaran" class="form-control sub_anggaran" required></select>
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
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th style="text-align:center;">KODE</th>
                                                <th style="text-align:center;">URAIAN</th>
                                                <th style="text-align:center;">HARGA</th>
                                                <th style="text-align:center;">VOLUME</th>
                                                <th style="text-align:center;">JUMLAH</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($anggaran as $subId => $rekeningGroup)
                                        @php
                                                $firstSub = $rekeningGroup->flatten(3)->first();
                                                $totalSubkegiatan = $rekeningGroup
                                                ->flatten(3)
                                                ->flatMap(fn($a) => $a->rincian ?? [])
                                                ->sum(fn($r) => $r->harga * $r->volume);
                                        @endphp
                                            <tr>
                                                <td style="color:green; text-align:center;"><b>{{ $firstSub->subkegiatan->kd_subkegiatan ?? '' }}</b></td>
                                                <td style="color: green;"><b>{{ $firstSub->subkegiatan->nm_subkegiatan ?? '' }}</b></td>
                                                <td style="color: black;"></td>
                                                <td style="color: black;"></td>
                                                <td style="color: green;"><b>Rp{{ number_format($totalSubkegiatan,0,',','.') }}</b></td>
                                            </tr>
                                            @foreach($rekeningGroup as $rekId => $nmAnggaranGroup)
                                            @php
                                                $firstRek = $nmAnggaranGroup->flatten(2)->first();
                                                $totalRekening = $nmAnggaranGroup
                                                ->flatten(2)
                                                ->flatMap(fn($a) => $a->rincian ?? [])
                                                ->sum(fn($r) => $r->harga * $r->volume);
                                            @endphp
                                            <tr>
                                                <td style="color:orange; text-align:center;"><b>{{ $firstRek->rekening->kd_rekening ?? '' }}</b></td>
                                                <td style="color: orange;"><b>{{ $firstRek->rekening->nm_rekening ?? '' }}</b></td>
                                                <td style="color: black;"></td>
                                                <td style="color: black;"></td>
                                                <td style="color:orange;"><b>Rp{{ number_format($totalRekening,0,',','.') }}</b></td>
                                             </tr>
                                            @foreach($nmAnggaranGroup as $namaAnggaran => $subAnggaranGroup)
                                             @php
                                                $totalNama = collect($subAnggaranGroup)
                                                    ->flatten(2)
                                                    ->flatMap(fn($a) => $a->rincian ?? [])
                                                    ->sum(fn($r) => $r->harga * $r->volume);
                                            @endphp
                                             <tr>
                                                <td style="color: black; text-align:center;"></td>
                                                <td style="color: black;"><b>[#] {{ $namaAnggaran }}</b></td>
                                                <td style="color: black;"></td>
                                                <td style="color: black;"></td>
                                                <td style="color: black;"><b>Rp{{ number_format($totalNama,0,',','.') }}</b></td>
                                             </tr>
                                             @foreach($subAnggaranGroup as $subAnggaran => $items)
                                              @php
                                                  $firstAnggaran = $items->first();
                                                  $totalSub = collect($items)
                                                  ->flatMap(fn($a) => $a->rincian ?? [])
                                                  ->sum(fn($r) => $r->harga * $r->volume);
                                              @endphp
                                             <tr>
                                                <td style="color: black; text-align:center;"></td>
                                                <td style="color: black;" colspan="3"><b>[-] {{ $subAnggaran }}</b>
                                                    @if ($users->jdwl_anggaran == Auth::user()->id_tahun)
                                                    &nbsp;<a type="button" class="addrinc" data-id="{{Crypt::encrypt( $firstAnggaran->id_anggaran )}}"> <i class="fa fa-plus color-muted"></i> Rincian</a>
                                                    &nbsp;<a type="button" class="edit" data-id="{{Crypt::encrypt( $firstAnggaran->id_anggaran )}}"> <i class="fa fa-edit color-muted"></i> Edit</a>
                                                    &nbsp;<a type="button" class="hapus" data-id="{{Crypt::encrypt( $firstAnggaran->id_anggaran )}}"> <i class="fa fa-trash color-muted"></i> Hapus</a>
                                                    @endif
                                                </td>
                                                <td style="color: black;"><b>Rp{{ number_format($totalSub,0,',','.') }}</b></td>
                                             </tr>
                                             @foreach($items as $row)
                                                @foreach($row->rincian as $rinci)
                                             <tr>
                                                <td style="color: black; text-align:center;"></td>
                                                <td style="color: black;">{{ $rinci->uraian }}<br>Spesifikasi: {{ $rinci->spesifikasi }}<br>
                                                    @if ($users->jdwl_anggaran == Auth::user()->id_tahun)
                                                     &nbsp;<a type="button" class="editrinc" data-id="{{Crypt::encrypt( $rinci->id_rincanggaran )}}"> <i class="fa fa-edit color-muted"></i> Edit</a>
                                                     &nbsp;<a type="button" class="haptrinc" data-id="{{Crypt::encrypt( $rinci->id_rincanggaran )}}"> <i class="fa fa-trash color-muted"></i> Hapus</a>
                                                     @endif
                                                    </td>
                                                <td style="color: black;">Rp{{ number_format($rinci->harga, 0, ',', '.') }},-</td>
                                                <td style="color: black;">{{ $rinci->volume }} {{ $rinci->satuan }}</td>
                                                @php 
                                                $jmlharga = $rinci->harga*$rinci->volume
                                                @endphp
                                                <td style="color: black;">Rp{{ number_format($jmlharga, 0, ',', '.') }},-</td>
                                             </tr>
                                             @endforeach
                                             @endforeach
                                             @endforeach
                                             @endforeach
                                             @endforeach
                                             @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th style="text-align:center;">KODE</th>
                                                <th style="text-align:center;">URAIAN</th>
                                                <th style="text-align:center;">HARGA</th>
                                                <th style="text-align:center;">VOLUME</th>
                                                <th style="text-align:center;">JUMLAH</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
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
                            <!-- Start EditModal -->
                            <div class="modal fade" id="modal-addrinc">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title">Tambah Rincian Anggaran</h3>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                            </button>
                                        </div>
                                        <div class="modal-body" id="loadrincform">
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
                            <div class="modal fade" id="modal-editrinc">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title">Edit Rincian Anggaran</h3>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                            </button>
                                        </div>
                                        <div class="modal-body" id="loadrincedit">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <!-- Button Edit SPJ -->
    <script>
$(document).on('click', '.edit', function(){

    var id_anggaran = $(this).attr('data-id');

    $.ajax({
        type: 'POST',
        url: '/anggaran/edit',
        cache: false,
        data: {
            _token: "{{ csrf_token() }}",
            id_anggaran: id_anggaran
        },
        success: function(respond) {

            $("#loadeditform").html(respond);

            // ✅ Inisialisasi select2 SETELAH form muncul
            $('#esubkegiatan').select2({
                placeholder: "Cari Sub Kegiatan...",
                dropdownParent: $('#modal-editobjek'),
                width: '100%'
            });

            $('#ekoderekening').select2({
                placeholder: "Cari Kode Rekening...",
                dropdownParent: $('#modal-editobjek'),
                width: '100%'
            });

            $('.nm_anggaran').select2({
                tags: true,
                placeholder: "Ketik atau pilih Nama Anggaran",
                dropdownParent: $('#modal-editobjek'),
                width: '100%',
                ajax: {
                    url: "{{ route('get.anggaran') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return { q: params.term };
                    },
                    processResults: function (data) {
                        return { results: data };
                    }
                }
            });

            $('.sub_anggaran').select2({
                tags: true,
                placeholder: "Ketik atau pilih Sub Anggaran",
                dropdownParent: $('#modal-editobjek'),
                width: '100%',
                ajax: {
                    url: "{{ route('get.subanggaran') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return { q: params.term };
                    },
                    processResults: function (data) {
                        return { results: data };
                    }
                }
            });

        }
    });

    $("#modal-editobjek").modal("show");
});
</script>
    <!-- END Button Edit SPJ -->

<!-- Start Button Hapus -->
<script>
    $(document).on('click', '.hapus', function(){
        var id_anggaran = $(this).attr('data-id');
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
        window.location = "/anggaran/hapus/"+id_anggaran
      }
    });
    });
    </script>
    <!-- End Button Hapus -->

<!-- Button Status -->
<script>
$(document).on('click', '.simpan', function(){
    var id_user = $(this).attr('data-id');
Swal.fire({
  title: "Apakah Anda Yakin Ingin Menyimpan Data Anggaran Ini ?",
  text: "Jika Ya Maka Data Akan Terseimpan",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Ya, Simpan!"
  }).then((result) => {
  if (result.isConfirmed) {
    window.location = "/anggaran/simpan/"+id_user
    }
  });
});
</script>
<!-- END Button Status -->

<script>
    $(document).ready(function() {
        $('#subkegiatan').select2({
            placeholder: "Cari Sub Kegiatan...",
            dropdownParent: $('#tambahdata'),
            width: '100%'
        });
        $('#koderekening').select2({
            placeholder: "Cari Kode Rekening...",
            dropdownParent: $('#tambahdata'),
            width: '100%'
        });
    });
</script>

<script>
$('.nm_anggaran').select2({
    tags: true,
    placeholder: "Ketik atau pilih Nama Anggaran",
    dropdownParent: $('#tambahdata'),
    ajax: {
        url: "{{ route('get.anggaran') }}",
        dataType: 'json',
        delay: 250,
        data: function (params) {
            return {
                q: params.term
            };
        },
        processResults: function (data) {
            return {
                results: data
            };
        }
    }
});

$('.sub_anggaran').select2({
    tags: true,
    placeholder: "Ketik atau pilih Sub Anggaran",
    dropdownParent: $('#tambahdata'),
    ajax: {
        url: "{{ route('get.subanggaran') }}",
        dataType: 'json',
        delay: 250,
        data: function (params) {
            return {
                q: params.term
            };
        },
        processResults: function (data) {
            return {
                results: data
            };
        }
    }
});
</script>

<script>
    $(document).on('click', '.addrinc', function(){
        var id_anggaran = $(this).attr('data-id');
        $.ajax({
                        type: 'POST',
                        url: '/rinciananggaran/add',
                        cache: false,
                        data: {
                            _token: "{{ csrf_token() }}",
                            id_anggaran: id_anggaran
                        },
                        success: function(respond) {
                            $("#loadrincform").html(respond);
                            $('.pagu').mask("#.##0", {
                                reverse:true
                            });
                        }
                    });
         $("#modal-addrinc").modal("show");

    });
    var span = document.getElementsByClassName("close")[0];
</script>

<script>
    $(document).on('click', '.editrinc', function(){
        var id_rincanggaran = $(this).attr('data-id');
        $.ajax({
                        type: 'POST',
                        url: '/rinciananggaran/edit',
                        cache: false,
                        data: {
                            _token: "{{ csrf_token() }}",
                            id_rincanggaran: id_rincanggaran
                        },
                        success: function(respond) {
                            $("#loadrincedit").html(respond);
                            $('.pagu').mask("#.##0", {
                                reverse:true
                            });
                        }
                    });
         $("#modal-editrinc").modal("show");

    });
    var span = document.getElementsByClassName("close")[0];
</script>

<!-- Start Button Hapus -->
<script>
    $(document).on('click', '.haptrinc', function(){
        var id_rincanggaran = $(this).attr('data-id');
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
        window.location = "/rinciananggaran/hapus/"+id_rincanggaran
      }
    });
    });
</script>
<!-- End Button Hapus -->




@endpush
