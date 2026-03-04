         <form action="{{ Route('u.peserta')}}"  method="POST" enctype="multipart/form-data">
         @csrf
             <div class="mb-3">
                 <label class="form-label">Nama :</label>
                 <input type="hidden" name="id" value="{{ Crypt::encrypt($peserta->id_peserta) }}" class="form-control input-default" required>
                 <input type="text" name="nama" value="{{ $peserta->nama }}" class="form-control input-default" required>
             </div>
             <div class="mb-3">
                 <label class="form-label">Asal Peserta :</label>
                 <select class="input-default form-control" name="tujuan" required>
                    <option value="">-Pilih Tujuan-</option>
                    <option value="Kota Banjarbaru" {{ $peserta->alamat == 'Prov. Kalimantan Selatan' ? 'selected' : '' }}>Prov. Kalimantan Selatan</option>
                    <option value="Kota Banjarbaru" {{ $peserta->alamat == 'Kota Banjarbaru' ? 'selected' : '' }}>Kota Banjarbaru</option>
                    <option value="Kota Banjarmasin" {{ $peserta->alamat == 'Kota Banjarmasin' ? 'selected' : '' }}>Kota Banjarmasin</option>
                    <option value="Kab. Banjar" {{ $peserta->alamat == 'Kab. Banjar' ? 'selected' : '' }}>Kab. Banjar</option>
                    <option value="Kab. Balangan" {{ $peserta->alamat == 'Kab. Balangan' ? 'selected' : '' }}>Kab. Balangan</option>
                    <option value="Kab. Barito Kuala" {{ $peserta->alamat == 'Kab. Barito Kuala' ? 'selected' : '' }}>Kab. Barito Kuala</option>
                    <option value="Kab. Tanah Laut" {{ $peserta->alamat == 'Kab. Tanah Laut' ? 'selected' : '' }}>Kab. Tanah Laut</option>
                    <option value="Kab. Tanah Bumbu" {{ $peserta->alamat == 'Kab. Tanah Bumbu' ? 'selected' : '' }}>Kab. Tanah Bumbu</option>
                    <option value="Kab. Kotabaru" {{ $peserta->alamat == 'Kab. Kotabaru' ? 'selected' : '' }}>Kab. Kotabaru</option>
                    <option value="Kab. Tabalong" {{ $peserta->alamat == 'Kab. Tabalong' ? 'selected' : '' }}>Kab. Tabalong</option>
                    <option value="Kab. Tapin" {{ $peserta->alamat == 'Kab. Tapin' ? 'selected' : '' }}>Kab. Tapin</option>
                    <option value="Kab. Hulu Sungai Selatan" {{ $peserta->alamat == 'Kab. Hulu Sungai Selatan' ? 'selected' : '' }}>Kab. Hulu Sungai Selatan</option>
                    <option value="Kab. Hulu Sungai Tengah" {{ $peserta->alamat == 'Kab. Hulu Sungai Tengah' ? 'selected' : '' }}>Kab. Hulu Sungai Tengah</option>
                    <option value="Kab. Hulu Sungai Utara" {{ $peserta->alamat == 'Kab. Hulu Sungai Utara' ? 'selected' : '' }}>Kab. Hulu Sungai Utara</option>
                </select>
             </div>
             <div class="mb-3">
                 <label class="form-label">Nama Koperasi / UMKM :</label>
                 <input type="text" name="jabatan" value="{{ $peserta->jabatan }}" class="form-control input-default">
             </div>
             <div class="mb-3">
                 <label class="form-label">Uang Harian :</label>
                 <input type="text" name="jabatan" value="{{ $peserta->jabatan }}" class="form-control input-default pagu" required>
             </div>
             <div class="mb-3">
                 <label class="form-label">Uang Transport :</label>
                 <input type="text" name="alamat" value="{{ $peserta->alamat }}" class="form-control input-default pagu" required>
             </div>
        </div>
     </div>
     <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
