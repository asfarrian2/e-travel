         <form action="{{ Route('u.rincanggaran')}}"  method="POST" enctype="multipart/form-data">
         @csrf
            <div class="mb-3">
                 <label class="form-label">Jenis Perjalanan :</label>
                 <input type="hidden" name="id" value="{{Crypt::encrypt($rincanggaran->id_rincanggaran)}}" class="form-control input-default" required>
                 <select class="input-default form-control" name="jenis" required>
                     <option value="">-Jenis Perjalanan-</option>
                     <option value="1" {{ $rincanggaran->jenis == 1 ? 'selected' : '' }}>Dalam Daerah</option>
                     <option value="2" {{ $rincanggaran->jenis == 2 ? 'selected' : '' }}>Luar Daerah</option>
                 </select>
             </div>
             <div class="mb-3">
                 <label class="form-label">Tujuan / Kegunaan :</label>
                 <select class="input-default form-control" name="kegunaan" required>
                     <option value="">-Pilih Tujuan / Kegunaan-</option>
                     <option value="Uang Harian" {{ $rincanggaran->kegunaan == 'Uang Harian' ? 'selected' : '' }}>Uang Harian</option>
                     <option value="Transport" {{ $rincanggaran->kegunaan == 'Transport' ? 'selected' : '' }}>Transport</option>
                     <option value="Penginapan" {{ $rincanggaran->kegunaan == 'Penginapan' ? 'selected' : '' }}>Penginapan</option>
                     <option value="Gabungan Lumsum" {{ $rincanggaran->kegunaan == 'Gabungan Lumsum' ? 'selected' : '' }}>Gabungan Lumsum</option>
                 </select>
             </div>
             <div class="mb-3">
                 <label class="form-label">Uraian :</label>
                 <input type="text" name="uraian" value="{{$rincanggaran->uraian}}" class="form-control input-default" required>
             </div>
             <div class="mb-3">
                 <label class="form-label">Spesifikasi :</label>
                 <input type="text" name="spesifikasi" value="{{$rincanggaran->spesifikasi}}" class="form-control input-default" required>
             </div>
             <div class="mb-3">
                 <label class="form-label">Harga (Rp) :</label>
                 <input type="text" name="harga" value="{{$rincanggaran->harga}}" class="form-control input-default pagu" required>
             </div>
             <div class="mb-3">
                 <label class="form-label">Volume :</label>
                 <input type="text" name="volume" value="{{$rincanggaran->volume}}" class="form-control input-default" required>
             </div>
             <div class="mb-3">
                 <label class="form-label">Satuan :</label>
                 <input type="text" name="satuan" value="{{$rincanggaran->satuan}}" class="form-control input-default" required>
             </div>
        </div>
     </div>
     <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
