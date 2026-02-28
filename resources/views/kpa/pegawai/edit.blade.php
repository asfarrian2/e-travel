         <form action="{{ Route('u.pegawai')}}"  method="POST" enctype="multipart/form-data">
         @csrf
             <div class="mb-3">
                 <label class="form-label">Nama :</label>
                 <input type="hidden" name="id" value="{{ Crypt::encrypt($pegawai->id_pelaksana) }}" class="form-control input-default" required>
                 <input type="text" name="nama" value="{{ $pegawai->nama }}" class="form-control input-default" required>
             </div>
             <div class="mb-3">
                 <label class="form-label">NIP :</label>
                 <input type="text" name="nip" value="{{ $pegawai->nip }}" class="form-control input-default" required>
             </div>
             <div class="mb-3">
                 <label class="form-label">Pangkat / Golongan :</label>
                 <input type="text" name="pangkgol" value="{{ $pegawai->pangkgol }}" class="form-control input-default">
             </div>
             <div class="mb-3">
                 <label class="form-label">Jabatan :</label>
                 <input type="text" name="jabatan" value="{{ $pegawai->jabatan }}" class="form-control input-default" required>
             </div>
              <div class="mb-3">
                <label class="form-label">Status Pegawai :</label>
                <select class="input-default form-control" name="kelas" required>
                    <option value="">Pilih Jenis Perjalanan</option>
                    <option value="1" {{ $pegawai->kelas == 1 ? 'selected' : '' }}>Pejabat Administrator (Ess.III)</option>
                    <option value="2" {{ $pegawai->kelas == 2 ? 'selected' : '' }}>Pejabat Pengawas (Ess.IV)</option>
                    <option value="3" {{ $pegawai->kelas == 3 ? 'selected' : '' }}>Staf (PNS)</option>
                    <option value="4" {{ $pegawai->kelas == 4 ? 'selected' : '' }}>Staf (PPPK)</option>
                    <option value="5" {{ $pegawai->kelas == 5 ? 'selected' : '' }}>Staf (PPPKPW)</option>
                </select>
            </div>
        </div>
     </div>
     <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
