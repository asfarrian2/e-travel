         <form action="{{ Route('u.spj')}}"  method="POST" enctype="multipart/form-data">
         @csrf
         <input type="hidden" id="selected_subkegiatan" value="{{ $spj->id_subkegiatan }}">
        <input type="hidden" id="selected_rekening" value="{{ $spj->id_rekening }}">
        <input type="hidden" name="id" value="{{ Crypt::encrypt($spj->id_spj) }}" class="form-control input-default" required>
             <div class="mb-3">
                 <label class="form-label">Tanggal Pengajuan :</label>
                 <input type="text" name="tgl" value="{{ $spj->tgl }}" class="form-control input-default" required>
             </div>
             <div class="mb-3">
                 <label class="form-label">Tujuan Pembayaran :</label>
                 <input type="text" name="uraian" value="{{ $spj->uraian }}" class="form-control input-default" required>
             </div>
             <div class="mb-3">
                  <label class="form-label">Jenis Perjalanan :</label>
                  <select class="input-default form-control" name="jenis" id="ejenis" required>
                      <option value="">Pilih Jenis Perjalanan</option>
                      <option value="1" {{ $spj->jenis == 1 ? 'selected' : '' }}>Dalam Daerah</option>
                      <option value="2" {{ $spj->jenis == 2 ? 'selected' : '' }}>Luar Daerah</option>
                  </select>
              </div>
             <div class="mb-3">
                 <label class="form-label">Sub Kegiatan :</label>
                 <select class="input-default form-control select2" name="subkegiatan" id="esubkegiatan" required>
                   <option value="">Pilih Sub Kegiatan</option>
                </select>
             </div>
             <div class="mb-3">
                <label class="form-label">Kode Rekening :</label>
                <select class="input-default form-control select2" name="koderekening" id="ekoderekening" required>
                  <option value="">Pilih Kode Rekening</option>
               </select>
            </div>
            <div class="mb-3">
                  <label class="form-label">Penerima :</label>
                  <select class="input-default form-control" name="pengguna" required>
                      <option value="">Pilih Penerima</option>
                      <option value="1" {{ $spj->pengguna == 1 ? 'selected' : '' }}>Pegawai BPKUK</option>
                      <option value="2" {{ $spj->pengguna == 2 ? 'selected' : '' }}>Fasilitator</option>
                      <option value="3" {{ $spj->pengguna == 3 ? 'selected' : '' }}>Peserta Diklat</option>
                  </select>
            </div>
        </div>
     </div>
     <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
