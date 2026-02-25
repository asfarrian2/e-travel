
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th style="text-align:center; font-size:16px; width:50%;">NAMA / NIP <br>PANGKAT / GOL</th>
                <th style="text-align:center; font-size:16px; width:45%;">JABATAN</th>
                <th style="text-align:center; font-size:16px; width:5%;"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pegawai as $d )
            <tr>
            <td style="color: black; font-size:12px"><b>{{ $d->nama }}</b><br>NIP. {{ $d->nip}}</td>
            <td style="color: black; font-size:12px">{{ $d->jabatan }}</td>
            <td>
		    	<div class="form-check custom-checkbox checkbox-success check-xs me-3">
		    		<input type="checkbox" class="form-check-input pegawai-checkbox" value="{{ Crypt::encrypt($d->id_pelaksana)}}">
		    		<label class="form-check-label" for="customCheckBox2"></label>
		    	</div>
		    </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


    