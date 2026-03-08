                <!-- row -->
                 <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Tabel Data</h4>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#tambahdata">+Tambah</button>
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
                                                            <th style="text-align:center; width:5%">NO.</th>
                                                            <th style="text-align:center; width:5%">TANGGAL</th>
                                                            <th style="text-align:center; width:25%">TUJUAN PEMBAYARAN</th>
                                                            <th style="text-align:center; width:5%">JENIS</th>
                                                            <th style="text-align:center; ">NILAI</th>
                                                            <th style="text-align:center; width: 20%">KEGIATAN</th>
                                                            <th style="text-align:center;">STATUS</th>
                                                            <th style="text-align:center;">AKSI</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($spj as $d)
                                                        <tr>
                                                            <td style="color: black; text-align:center;"><a class="link-spj" href="/pengajuanspj/{{ Crypt::encrypt($d->id_spj) }}">{{ $d->nomor_spj }}</a></td>
                                                            <td style="color: black;"><a class="link-spj" href="/pengajuanspj/{{ Crypt::encrypt($d->id_spj) }}">{{ \Carbon\Carbon::parse($d->tgl)->format('d/m/Y') }}</a></td>
                                                            <td style="color: black;"><a class="link-spj" href="/pengajuanspj/{{ Crypt::encrypt($d->id_spj) }}"><b>{{ $d->uraian }}</b></a><br>
                                                                Penerima: @if ($d->pengguna == 1)
                                                                Pegawai BPKUK
                                                                @elseif (($d->pengguna == 2))
                                                                Fasilitator
                                                                @else
                                                                Peserta Diklat
                                                                @endif  </td>
                                                            <td style="color: black;">
                                                                @if ($d->jenis == 1)
                                                                    Dalam Daerah
                                                                @else
                                                                Luar Daerah
                                                                @endif
                                                            </td>
                                                            <td style="color: black;">Rp 0</td>
                                                            <td style="color: black;">{{ $d->subkegiatan->kd_subkegiatan}}-{{ $d->subkegiatan->nm_subkegiatan}}</td>
                                                            @if ($d->status == '1')
                                                                    <td style="text-align:center;"><span class="badge light badge-warning">Draft</span></td>
                                                                @elseif ($d->status == '2')
                                                                    <td style="text-align:center;"><span class="badge light badge-success">Terkirim</span></td>
                                                            @endif
                                                            <td>
                                                                <div class="dropdown">
                                                                    <button type="button" class="btn btn-primary light sharp" data-bs-toggle="dropdown">
                                                                        <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                                                                    </button>
                                                                    <div class="dropdown-menu">
                                                                        @csrf
                                                                        @if ($d->status == '1')
                                                                        <a type="button" class="dropdown-item status" data-id="{{Crypt::encrypt($d->id_spj)}}"> <i class="fa fa-send color-muted"></i> Kirim</a>
                                                                        <a type="button" class="dropdown-item edit" data-id="{{Crypt::encrypt($d->id_spj)}}"> <i class="fa fa-pencil color-muted"></i> Edit</a>
                                                                        <a type="button" class="dropdown-item hapus" data-id="{{Crypt::encrypt($d->id_spj)}}" ><i class="fa fa-trash color-muted"></i> Hapus</a>
                                                                        @elseif ($d->status == '2')
                                                                        <a type="button" class="dropdown-item status" data-id="{{Crypt::encrypt($d->id_spj)}}"> <i class="fa fa-ban color-muted"></i> Batalkan</a>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        @endforeach
                                                        </tr>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th style="text-align:center;">NO.</th>
                                                            <th style="text-align:center;">TANGGAL</th>
                                                            <th style="text-align:center;">TUJUAN PEMBAYARAN</th>
                                                            <th style="text-align:center;">JENIS</th>
                                                            <th style="text-align:center;">NILAI</th>
                                                            <th style="text-align:center;">KEGIATAN</th>
                                                            <th style="text-align:center;">STATUS</th>
                                                            <th style="text-align:center;">AKSI</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>

                                        {{-- @include('pptk.perjadin.data2') --}}
                                        
                                    </div>
                                </div>
                            </div>
                            