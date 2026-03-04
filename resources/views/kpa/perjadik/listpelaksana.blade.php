
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th style="text-align:center;">NO.</th>
                <th style="text-align:center; font-size:16px; width:30%;">NAMA</th>
                <th style="text-align:center; font-size:16px; width:20%;">ASAL PESERTA</th>
                <th style="text-align:center; font-size:16px; width:25%;">NAMA KOPERASI /<br> UMKM</th>
                <th style="text-align:center; font-size:16px; width:20%;">UANG HARIAN</th>
                <th style="text-align:center; font-size:16px; width:20%;">UANG TRANSPORT</th>
            </tr>
        </thead>
        @php
            $totalHarian = 0;
            $totalTransport = 0;
        @endphp
        <tbody>
            @foreach ($pelperjadin as $d )
                @php
                    $totalHarian += $d->uang_harian;
                    $totalTransport += $d->uang_transport;
                @endphp
            <tr>
            <td style="color: black; font-size:12px">{{ $loop->iteration }}</td>
            <td style="color: black; font-size:12px"><b>{{ $d->pelaksana->nama }}</b><br>{{ $d->pelaksana->nip}}</td>
            <td style="color: black; font-size:12px; text-align:center;">{{ $d->pelaksana->alamat }}</td>
            <td style="color: black; font-size:12px">{{ $d->pelaksana->jabatan }}</td>
            <td style="color: black; font-size:12px; text-align:center;">{{ number_format($d->uang_harian,0,',','.') }}</td>
            <td style="color: black; font-size:12px; text-align:center;">{{ number_format($d->uang_transport,0,',','.') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th style="text-align:center; font-size:16px;" colspan="4">TOTAL</th>
                <th style="text-align:center; font-size:16px;">{{ number_format($totalHarian,0,',','.') }}</th>
                <th style="text-align:center; font-size:16px;">{{ number_format($totalTransport,0,',','.') }}</th>
            </tr>
        </tfoot>
    </table>
</div>

@if ($status == 1)
<div class="modal-footer">
    <button type="button" class="btn btn-danger" id="hapus-terpilih"> <i class="fa fa-trash color-muted"></i> Hapus</button>
</div>
@else
@endif

    