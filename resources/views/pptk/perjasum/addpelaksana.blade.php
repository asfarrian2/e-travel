<div class="mb-3">
    <label class="form-label">Pilih Pelaksana</label>
    <select name="pelaksana[]" class="form-control pelaksana-select" multiple="multiple">
        @foreach ($pelaksana as $d)
            <option value="{{ Crypt::encrypt($d->id_pelaksana) }}">
                {{ $d->nama }} - {{ $d->jabatan }} ({{ $d->alamat }})
            </option>
        @endforeach
    </select>
</div>