<div class="tab-pane fade" id="status2">
    <div class="table-responsive">
        <table id="data-2" class="display" style="min-width: 1200px">
            <thead>
                <tr>
                    <th style="text-align:center;">NO.</th>
                    <th style="text-align:center;">TANGGAL</th>
                    <th style="text-align:center; width: 250px">DASAR</th>
                    <th style="text-align:center; width: 300px">KEPERLUAN / PERIODE / TUJUAN</th>
                    <th style="text-align:center; width: 300px">PELAKSANA</th>
                    <th style="text-align:center;">STATUS</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($disetujui as $d)
                <tr>
                    <td style="color: black; text-align:center;">NPJ/{{ substr($d->id_perjalanan, -4) }}/{{ $ytahun }}</td>
                    <td style="color: black; text-align:center;">{{ \Carbon\Carbon::parse($d->tgl)->format('d/m/Y') }}</td>
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
                    <td style="text-align:center;"><span class="badge light badge-success">Sudah Diverifikasi</span></td>
                @endforeach
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th style="text-align:center;">NO.</th>
                    <th style="text-align:center;">TANGGAL</th>
                    <th style="text-align:center;">DASAR</th>
                    <th style="text-align:center;">KEPERLUAN / PERIODE / TUJUAN</th>
                    <th style="text-align:center;">PEGAWAI</th>
                    <th style="text-align:center;">STATUS</th>
                </tr>
            </tfoot>
        </table>
    </div>    
</div>
@include('pptk.perjasum.data0')