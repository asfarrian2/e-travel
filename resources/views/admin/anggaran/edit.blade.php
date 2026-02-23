         <form action="{{ Route('u.subkegiatan')}}"  method="POST" enctype="multipart/form-data">
         @csrf
             <div class="mb-3">
                 <label class="form-label">Kode :</label>
                 <input type="hidden" name="id" value="{{ Crypt::encrypt($subkegiatan->id_subkegiatan) }}" class="form-control input-default" required>
                 <input type="text" name="kodesubkegiatan" value="{{ $subkegiatan->kd_subkegiatan }}" class="form-control input-default" required>
             </div>
             <div class="mb-3">
                 <label class="form-label">Sub Kegiatan :</label>
                 <input type="text" name="subkegiatan" value="{{ $subkegiatan->nm_subkegiatan }}" class="form-control input-default" required>
             </div>

        </div>
     </div>
     <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
