         <form action="{{ Route('u.koderekening')}}"  method="POST" enctype="multipart/form-data">
         @csrf
             <div class="mb-3">
                 <label class="form-label">Kode Rekening :</label>
                 <input type="hidden" name="id" value="{{ Crypt::encrypt($koderekening->id_rekening) }}" class="form-control input-default" required>
                 <input type="text" name="koderekening" value="{{ $koderekening->kd_rekening }}" class="form-control input-default" required>
             </div>
             <div class="mb-3">
                 <label class="form-label">Nama Rekening :</label>
                 <input type="text" name="rekening" value="{{ $koderekening->nm_rekening }}" class="form-control input-default" required>
             </div>

        </div>
     </div>
     <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
