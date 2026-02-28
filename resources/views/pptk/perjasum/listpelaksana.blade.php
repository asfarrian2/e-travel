
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th style="text-align:center;">NO.</th>
                <th style="text-align:center; font-size:16px; width:50%;">NAMA / NIP <br>PANGKAT / GOL</th>
                <th style="text-align:center; font-size:16px; width:45%;">JABATAN</th>
                <th style="text-align:center; font-size:16px; width:5%;"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pelperjadin as $d )
            <tr>
            <td style="color: black; font-size:12px">{{ $loop->iteration }}</td>
            <td style="color: black; font-size:12px"><b>{{ $d->pelaksana->nama }}</b><br>{{ $d->pelaksana->nip}}</td>
            <td style="color: black; font-size:12px">{{ $d->pelaksana->jabatan }}</td>
            <td>
		    	<div class="form-check custom-checkbox checkbox-success check-xs me-3">
		    		<input type="checkbox" class="form-check-input hapus-checkbox" value="{{ Crypt::encrypt($d->id_pelperjadin)}}">
		    		<label class="form-check-label" for="customCheckBox2"></label>
		    	</div>
		    </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th style="text-align:center;">NO.</th>
                <th style="text-align:center;">NAMA / NIP <br>PANGKAT / GOL</th>
                <th style="text-align:center;">JABATAN</th>
                <th style="text-align:center; font-size:16px; width:5%;"></th>
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

    