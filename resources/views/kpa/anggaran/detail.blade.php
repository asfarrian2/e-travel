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
						<li class="breadcrumb-item active"><a href="/kpa/dashboard">E-Travel</a></li>
                        <li class="breadcrumb-item active"><a href="/kpa/anggaran">Anggaran</a></li>
						<li class="breadcrumb-item">Rincian</li>
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
                                    <p class="fs-14 mb-1">PPTK</p>
                                    <span class="text-black fs-16">{{ $users->pegawai->nama }}</span>
                                </div>
                                <div class="me-3 mb-3">
                                    <p class="fs-14 mb-1">STATUS</p>
                                    @if ($users->jdwl_anggaran == Auth::user()->id_tahun)
                                    <span class="btn btn-rounded btn-warning"><span
                                        class="btn-icon-start text-warning"><i class="fa fa-file"></i>
                                    </span>Proses</span>
                                    @else
                                    <span class="btn btn-rounded btn-success"><span
                                        class="btn-icon-start text-success"><i class="fa fa-check"></i>
                                    </span>Selesai</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Tabel Data</h4>
                            </div>
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
                                                <td style="color: black;" colspan="3"><b>[-] {{ $subAnggaran }}</b></td>
                                                <td style="color: black;"><b>Rp{{ number_format($totalSub,0,',','.') }}</b></td>
                                             </tr>
                                             @foreach($items as $row)
                                                @foreach($row->rincian as $rinci)
                                             <tr>
                                                <td style="color: black; text-align:center;"></td>
                                                <td style="color: black;">{{ $rinci->uraian }}<br>Spesifikasi: {{ $rinci->spesifikasi }}<br></td>
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

@endpush
