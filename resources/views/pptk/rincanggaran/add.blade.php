         <form action="{{ Route('a.rincanggaran')}}"  method="POST" enctype="multipart/form-data">
         @csrf
            <div class="mb-3">
                 <label class="form-label">Jenis Perjalanan :</label>
                 <input type="hidden" name="id" value="{{ Crypt::encrypt($anggaran->id_anggaran) }}" class="form-control input-default" required>
                 <select class="input-default form-control" name="jenis" required>
                     <option value="">-Jenis Perjalanan-</option>
                     <option value="1">Dalam Daerah</option>
                     <option value="2">Luar Daerah</option>
                 </select>
             </div>
             <div class="mb-3">
                 <label class="form-label">Tujuan / Kegunaan :</label>
                 <select class="input-default form-control" name="kegunaan" required>
                     <option value="">-Pilih Tujuan / Kegunaan-</option>
                     <option value="Uang Harian">Uang Harian</option>
                     <option value="Uang Transport">Uang Transport</option>
                     <option value="Uang Penginapan">Uang Penginapan</option>
                     <option value="Gabungan Lumsum">Gabungan Lumsum</option>
                 </select>
             </div>
             <div class="mb-3">
                 <label class="form-label">Uraian :</label>
                 <input type="text" name="uraian" class="form-control input-default" required>
             </div>
             <div class="mb-3">
                 <label class="form-label">Spesifikasi :</label>
                 <input type="text" name="spesifikasi" class="form-control input-default" required>
             </div>
             <div class="mb-3">
                 <label class="form-label">Harga (Rp) :</label>
                 <input type="text" name="harga" class="form-control input-default pagu" required>
             </div>
             <div class="mb-3">
                 <label class="form-label">Volume :</label>
                 <input type="text" name="volume" class="form-control input-default" required>
             </div>
             <div class="mb-3">
                 <label class="form-label">Satuan :</label>
                 <input type="text" name="satuan" class="form-control input-default" required>
             </div>
        </div>
     </div>
     <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
