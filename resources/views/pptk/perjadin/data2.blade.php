<div class="tab-pane fade" id="status2">
    <div class="table-responsive">
        <table id="data-2" class="display" style="min-width: 1000px">
            <thead>
                <tr>
                    <th style="text-align:center;">NO.</th>
                    <th style="text-align:center; width: 250px">DASAR</th>
                    <th style="text-align:center;">KEPERLUAN / PERIODE / TUJUAN</th>
                    <th style="text-align:center; width: 200px">PEGAWAI</th>
                    <th style="text-align:center;">STATUS</th>
                    <th style="text-align:center;">AKSI</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($disetujui as $d)
                <tr>
                    <td style="color: black; text-align:center;">NPJ/{{ substr($d->id_perjalanan, -4) }}/{{ $ytahun }}</td>
                    <td style="color: black;">{{$d->dasar}}</td>
                    <td style="color: black;">{{$d->keperluan}}<br>Periode : {{ \Carbon\Carbon::parse($d->tgl_berangkat)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($d->tgl_pulang)->format('d/m/Y') }} ({{ \Carbon\Carbon::parse($d->tgl_pulang)->diffInDays(\Carbon\Carbon::parse($d->tgl_berangkat)) + 1 }} Hari)<br>Tujuan: {{ $d->tujuan }}</td>
                     <td style="color: black;">
                         {{-- @foreach ($d->rperjadin->take(3) as $index => $r )
                             <p style="color: rgb(11, 85, 57);" class="mb-0">{{ $r->pegawai->nama }}</p>@if ($index < 2 && $d->rperjadin->count() > 3)@endif
                         @endforeach
                         @if ($d->rperjadin->count() > 3)
                             Dll...
                         @endif  --}}
                        <a type="button" class="listpegawai" data-id="{{Crypt::encrypt($d->id_perjalanan)}}"> <i class="fa fa-list color-muted"></i> View</a>
                    </td>
                    @if ($d->status == '3')
                        <td style="text-align:center;"><span class="badge light badge-success">Sudah Diverifikasi</span></td>
                        @else
                        <td style="text-align:center;"><span class="badge light badge-secondary">Terkirim</span></td>
                    @endif
                    <td>
                        <div class="dropdown">
							<button type="button" class="btn btn-primary light sharp" data-bs-toggle="dropdown">
								<svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
							</button>
                            @csrf
							<div class="dropdown-menu">
                                <a type="button" href="/admin/perjadin/pegawai/spt/{{Crypt::encrypt($d->id_perjalanan)}}" class="dropdown-item" target="_BLANK"> <i class="fa fa-print color-muted"></i> SPT</a>
                                <a type="button" class="dropdown-item status" data-id="{{Crypt::encrypt($d->id_perjalanan)}}"> <i class="fa fa-ban color-muted"></i> Batalkan</a>
							</div>
						</div>
                    </td>
                @endforeach
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th style="text-align:center;">NO.</th>
                    <th style="text-align:center;">DASAR</th>
                    <th style="text-align:center;">KEPERLUAN / PERIODE / TUJUAN</th>
                    <th style="text-align:center;">PEGAWAI</th>
                    <th style="text-align:center;">STATUS</th>
                    <th style="text-align:center;">AKSI</th>
                </tr>
            </tfoot>
        </table>
    </div>    
</div>