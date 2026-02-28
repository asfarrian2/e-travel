         <form action="{{ Route('u.fasilitator')}}"  method="POST" enctype="multipart/form-data">
         @csrf
             <div class="mb-3">
                 <label class="form-label">Nama :</label>
                 <input type="hidden" name="id" value="{{ Crypt::encrypt($pelaksana->id_pelaksana) }}" class="form-control input-default" required>
                 <input type="text" name="nama" value="{{ $pelaksana->nama }}" class="form-control input-default" required>
             </div>
             <div class="mb-3">
                 <label class="form-label">NIP :</label>
                 <input type="text" name="nip" value="{{ $pelaksana->nip }}" class="form-control input-default" required>
             </div>
             <div class="mb-3">
                 <label class="form-label">Pangkat / Golongan :</label>
                 <input type="text" name="pangkgol" value="{{ $pelaksana->pangkgol }}" class="form-control input-default">
             </div>
             <div class="mb-3">
                 <label class="form-label">Jabatan :</label>
                 <input type="text" name="jabatan" value="{{ $pelaksana->jabatan }}" class="form-control input-default" required>
             </div>
             <div class="mb-3">
                 <label class="form-label">Asal / Instansi :</label>
                 <input type="text" name="alamat" value="{{ $pelaksana->alamat }}" class="form-control input-default" required>
             </div>
        </div>
     </div>
     <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
