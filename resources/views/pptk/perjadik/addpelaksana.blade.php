<form action="{{ route('import.pelaksana')}}" method="POST" enctype="multipart/form-data">
        @csrf    
        <input type="hidden" name="id" value="{{ Crypt::encrypt($perjalanan->id_perjalanan) }}"  class="form-control input-default" required> 
        <div class="mb-3">
            <label class="form-label">Kelompok :</label>
            <textarea style="height: 80px;" name="kelompok" class="form-control" disabled>{{ $perjalanan->keperluan }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">File :</label>
            <input type="file" name="file" class="form-control" required>
            <small>Unduh format upload file *xlsx untuk impor data peserta <a type="button" style="color: green" href="#"><u>disini</u></a></small>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-primary"><i class="fa fa-save color-muted"></i> Simpan</button>
</form>