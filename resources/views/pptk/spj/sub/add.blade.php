
<div class="table-responsive">
    <table class="table table-striped" style="min-width: 700px">
        <thead>
            <tr>
                <th style="text-align:center;">NOMOR / <br>TANGGAL</th>
                <th style="text-align:center; width: 200px">KEPERLUAN / PERIODE / TUJUAN</th>
                <th style="text-align:center; width: 200px">PELAKSANA</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($perjalanan as $d)
            <tr>
            <td style="color: black; text-align:center;">{{ $d->nomor_perjalanan}}<br>{{ \Carbon\Carbon::parse($d->tgl)->format('d/m/Y') }}</td>
            <td style="color: black;">{{$d->keperluan}}<br><br><div style="font-size: 12px">Periode : {{ \Carbon\Carbon::parse($d->tgl_berangkat)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($d->tgl_pulang)->format('d/m/Y') }} ({{ \Carbon\Carbon::parse($d->tgl_pulang)->diffInDays(\Carbon\Carbon::parse($d->tgl_berangkat)) + 1 }} Hari)<br>Tujuan: {{ $d->tujuan }}</div></td>
            <td style="color: black;">
                @foreach ($d->pelperjadin->sortBy('pelaksana.kelas') as $r)
                {{ $loop->iteration}}. {{ $r->pelaksana->nama }}<br>
                @endforeach
            </td>
            <td>
		    	<div class="form-check custom-checkbox checkbox-success check-xs me-3">
		    		<input type="checkbox" class="form-check-input perjalanan-checkbox" value="{{ Crypt::encrypt($d->id_perjalanan)}}">
		    		<label class="form-check-label" for="customCheckBox2"></label>
		    	</div>
		    </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align:center; color:rgb(0, 0, 0);">
                    Data perjalanan tidak ada
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>


    