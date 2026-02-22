         <form action="{{ Route('u.tahun')}}"  method="POST" enctype="multipart/form-data">
         @csrf
             <div class="mb-3">
                 <label class="form-label">Tahun Anggaran :</label>
                 <input type="hidden" name="id" value="{{ Crypt::encrypt($tahun->id_tahun) }}" class="form-control input-default" required>
                 <input type="number" name="tahun" value="{{ $tahun->tahun }}" class="form-control input-default" required>
             </div>
             <div class="mb-3">
                 <label class="form-label">Nomor DPA :</label>
                 <input type="text" name="dpa" value="{{ $tahun->dpa }}" class="form-control input-default" required>
             </div>
             <div class="mb-3">
                 <label class="form-label">Tanggal DPA :</label>
                 <input type="date" name="tgl" value="{{ $tahun->tgl_dpa }}" class="form-control input-default" required>
             </div>
        </div>
     </div>
     <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
