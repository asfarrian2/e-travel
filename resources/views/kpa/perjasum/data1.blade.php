                <!-- row -->
                 <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Tabel Data</h4>
                                <!-- Button trigger modal -->
                            </div>
                            
                            <div class="card-body">
                                <div class="custom-tab-1">
                                    <ul class="nav nav-tabs nav-fill w-100">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#status1"><i class="la la-file-alt me-2"></i> Belum Diverifikasi</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#status2"><i class="la la-check-circle me-2"></i> Sudah Diverifikasi</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#status0"><i class="la la-trash me-2"></i> Dihapus</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        </br>
                                        <div class="tab-pane fade show active" id="status1" role="tabpanel">
                                            <div class="table-responsive">
                                                <table id="data-1" class="table table-bordered table-striped display" style="min-width: 1200px">
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align:center; width: 10px">NO.</th>
                                                            <th style="text-align:center; width: 120px">PPTK</th>
                                                            <th style="text-align:center; width: 120px">DASAR</th>
                                                            <th style="text-align:center; width: 300px">KEPERLUAN / PERIODE / TUJUAN</th>
                                                            <th style="text-align:center; width: 120px">PELAKSANA</th>
                                                            <th style="text-align:center; width: 10px">STATUS</th>
                                                            <th style="text-align:center; width: 5px">AKSI</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($kirim->sortByDesc('id_perjalanan') as $d)
                                                        <tr>
                                                            <td style="color: black; text-align:center;">NPJ/{{ substr($d->id_perjalanan, -4) }}/{{ $ytahun }}</td>
                                                            <td style="color: black;">{{ $d->pptk->pegawai->nama}}</td>
                                                            <td style="color: black;"><div class="bootstrap-popover d-inline-block">
                                                                                        <a type="button" data-bs-container="body" data-bs-toggle="popover"
                                                                                            data-bs-placement="right" data-bs-content="{{ $d->dasar }}" title="Dasar Pelaksanaan">
                                                                                            {{ Str::limit($d->dasar, 75, '...')}}
                                                                                        </a>
                                                                                        </div>
                                                                                        <br>
                                                                                        @php
                                                                                            $Sub = $d->anggaran?->subkegiatan?->kd_subkegiatan;
                                                                                            $Rek = $d->anggaran?->rekening?->kd_rekening;
                                                                                            $Anm = $d->anggaran?->nm_anggaran;
                                                                                            $Asb = $d->anggaran?->sub_anggaran;
                                                                                        @endphp
                                                                                        @if($Sub && $Rek)
                                                                                            <div style="font-size: 12px">({{ $Sub }}. {{ $Rek }} {{ $Anm }} - {{ $Asb }})</div>
                                                                                        @else
                                                                                            <div style="font-size: 12px">(-Empty)</div>
                                                                                        @endif
                                                            </td>
                                                            <td style="color: black;">{{$d->keperluan}}<br><br><div style="font-size: 12px">Periode : {{ \Carbon\Carbon::parse($d->tgl_berangkat)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($d->tgl_pulang)->format('d/m/Y') }} ({{ \Carbon\Carbon::parse($d->tgl_pulang)->diffInDays(\Carbon\Carbon::parse($d->tgl_berangkat)) + 1 }} Hari)<br>Tujuan: {{ $d->tujuan }}</div></td>
                                                            <td style="color: black;">
                                                                @if ($d->pelperjadin->isEmpty())
                                                                    <div style="color: red">Data Tidak Ada</div>
                                                                @else
                                                                 @foreach ($d->pelperjadin->take(3) as $index => $r )
                                                                     <p style="color: rgb(11, 85, 57);" class="mb-0">{{ $r->pelaksana->nama }}</p>@if ($index < 2 && $d->pelperjadin->count() > 3)@endif
                                                                 @endforeach
                                                                 @if ($d->pelperjadin->count() > 3)
                                                                     Dll...
                                                                 @endif 
                                                                <a type="button" class="listpegawai" data-id="{{Crypt::encrypt($d->id_perjalanan)}}"> <i class="fa fa-list color-muted"></i> Selengkapnya..</a>
                                                                @endif
                                                            </td>
                                                            <td style="text-align:center;"><span class="badge light badge-warning">Belum Diverifikasi</span></td>   
                                                            <td>
                                                                <div class="dropdown">
								            						<button type="button" class="btn btn-primary light sharp" data-bs-toggle="dropdown">
								            							<svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
								            						</button>
                                                                    @csrf
								            						<div class="dropdown-menu">
                                                                        <a type="button" class="dropdown-item setuju" data-id="{{Crypt::encrypt($d->id_perjalanan)}}"> <i class="fa fa-check color-muted"></i> Setujui</a>
                                                                        <a type="button" class="dropdown-item batal" data-id="{{Crypt::encrypt($d->id_perjalanan)}}"> <i class="fa fa-ban color-muted"></i> Batalkan</a>
								            						</div>
								            					</div>
                                                            </td>
                                                        @endforeach
                                                        </tr>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th style="text-align:center;">NO.</th>
                                                            <th style="text-align:center;">PPTK</th>
                                                            <th style="text-align:center;">DASAR</th>
                                                            <th style="text-align:center;">KEPERLUAN / PERIODE / TUJUAN</th>
                                                            <th style="text-align:center;">PELAKSANA</th>
                                                            <th style="text-align:center;">STATUS</th>
                                                            <th style="text-align:center;">AKSI</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>

                                        @include('kpa.perjasum.data2')
                                        
                                    </div>
                                </div>
                            </div>
                            