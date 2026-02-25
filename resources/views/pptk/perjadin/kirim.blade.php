<form action="{{ route('u.submit')}}" method="POST">
        @csrf    
        <input type="hidden" name="id" value="{{ Crypt::encrypt($perjalanan->id_perjalanan) }}"  class="form-control input-default" required>
        
        <div class="mb-3">
            <label class="form-label">Sub Kegiatan :</label>
            <select class="input-default form-control select2" name="subkegiatan" id="ksubkegiatan" required>
              <option value="">Pilih Sub Kegiatan</option>
              @foreach ($subkegiatan as $d)
              <option value="{{ Crypt::encrypt($d->subkegiatan->id_subkegiatan) }}"> {{$d->subkegiatan->kd_subkegiatan}} - {{$d->subkegiatan->nm_subkegiatan}}</option>
              @endforeach
           </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Kode Rekening :</label>
            <select class="input-default form-control select2" name="koderekening" id="kkoderekening" required>
              <option value="">Pilih Kode Rekening</option>
           </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Anggaran :</label>
            <select class="input-default form-control select2" name="anggaran" id="kanggaran" required>
              <option value="">Pilih Anggaran</option>
           </select>
        </div>  
    </div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Kirim</button>
</form>