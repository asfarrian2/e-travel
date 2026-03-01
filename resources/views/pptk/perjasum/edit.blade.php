<form action="{{ route('u.perjasum')}}" method="POST">
        @csrf    
        <input type="hidden" name="id" value="{{ Crypt::encrypt($perjalanan->id_perjalanan) }}"  class="form-control input-default" required>
        <div class="mb-3 col-6">
                <label class="form-label">Tanggal :</label>
                <input type="date" name="tgl" value="{{ $perjalanan->tgl }}" class="form-control input-default" required>
        </div> 
        <div class="mb-3">
            <label class="form-label">Dasar Perjalanan :</label>
            <textarea style="height: 80px;" name="dasar" class="form-control" required>{{ $perjalanan->dasar }}</textarea>
        </div> 
        <div class="mb-3">
            <label class="form-label">Uraian :</label>
            <textarea style="height: 80px;" name="keperluan" class="form-control" required>{{ $perjalanan->keperluan }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Tujuan :</label>
            @if ($perjalanan->jenis == 1)
            <select class="input-default form-control" name="tujuan" required>
                <option value="">-Pilih Tujuan-</option>
                <option value="Kota Banjarbaru" {{ $perjalanan->tujuan == 'Kota Banjarbaru' ? 'selected' : '' }}>Kota Banjarbaru</option>
                <option value="Kota Banjarmasin" {{ $perjalanan->tujuan == 'Kota Banjarmasin' ? 'selected' : '' }}>Kota Banjarmasin</option>
                <option value="Kab. Banjar" {{ $perjalanan->tujuan == 'Kab. Banjar' ? 'selected' : '' }}>Kab. Banjar</option>
                <option value="Kab. Balangan" {{ $perjalanan->tujuan == 'Kab. Balangan' ? 'selected' : '' }}>Kab. Balangan</option>
                <option value="Kab. Barito Kuala" {{ $perjalanan->tujuan == 'Kab. Barito Kuala' ? 'selected' : '' }}>Kab. Barito Kuala</option>
                <option value="Kab. Tanah Laut" {{ $perjalanan->tujuan == 'Kab. Tanah Laut' ? 'selected' : '' }}>Kab. Tanah Laut</option>
                <option value="Kab. Tanah Bumbu" {{ $perjalanan->tujuan == 'Kab. Tanah Bumbu' ? 'selected' : '' }}>Kab. Tanah Bumbu</option>
                <option value="Kab. Kotabaru" {{ $perjalanan->tujuan == 'Kab. Kotabaru' ? 'selected' : '' }}>Kab. Kotabaru</option>
                <option value="Kab. Tabalong" {{ $perjalanan->tujuan == 'Kab. Tabalong' ? 'selected' : '' }}>Kab. Tabalong</option>
                <option value="Kab. Tapin" {{ $perjalanan->tujuan == 'Kab. Tapin' ? 'selected' : '' }}>Kab. Tapin</option>
                <option value="Kab. Hulu Sungai Selatan" {{ $perjalanan->tujuan == 'Kab. Hulu Sungai Selatan' ? 'selected' : '' }}>Kab. Hulu Sungai Selatan</option>
                <option value="Kab. Hulu Sungai Tengah" {{ $perjalanan->tujuan == 'Kab. Hulu Sungai Tengah' ? 'selected' : '' }}>Kab. Hulu Sungai Tengah</option>
                <option value="Kab. Hulu Sungai Utara" {{ $perjalanan->tujuan == 'Kab. Hulu Sungai Utara' ? 'selected' : '' }}>Kab. Hulu Sungai Utara</option>
            </select>
            @else
                <input type="text" name="tujuan" value="{{ $perjalanan->tujuan }}" class="form-control input-default" required>
            @endif
        </div>
        <div class="row col-12">  
            <div class="mb-3 col-6">
                <label class="form-label">Tanggal Berangkat :</label>
                <input type="date" name="tgl_berangkat" id="tgl_berangkat" value="{{ $perjalanan->tgl_berangkat }}" class="form-control input-default" required>
            </div> 
            <div class="mb-3 col-6">
                <label class="form-label">Tanggal Pulang :</label>
                <input type="date" name="tgl_pulang" id="tgl_pulang" value="{{ $perjalanan->tgl_pulang }}" class="form-control input-default" required>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Angkutan :</label>
            <input type="text" name="angkutan" value="{{ $perjalanan->angkutan }}" class="form-control input-default" required>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>