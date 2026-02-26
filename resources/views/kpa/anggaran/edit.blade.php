         <form action="{{ Route('u.anggaran')}}"  method="POST" enctype="multipart/form-data">
         @csrf
             <div class="mb-3">
                 <label class="form-label">Sub Kegiatan :</label>
                 <input type="hidden" name="id" value="{{ Crypt::encrypt($anggaran->id_anggaran) }}" class="form-control input-default" required>
                 <select class="input-default form-control select2" name="subkegiatan" id="esubkegiatan" required>
                   <option value="">Pilih Sub Kegiatan</option>
                   @foreach ($subkegiatan as $d)
                   <option {{ $anggaran->id_subkegiatan == $d->id_subkegiatan ? 'selected' : '' }}
                     value="{{ Crypt::encrypt($d->id_subkegiatan) }}"> {{$d->kd_subkegiatan}} - {{$d->nm_subkegiatan}}</option>
                   @endforeach
                </select>
             </div>
             <div class="mb-3">
                 <label class="form-label">Kode Rekening :</label>
                 <select class="input-default form-control select2" name="koderekening" id="ekoderekening" required>
                   <option value="">Pilih Kode Rekening</option>
                   @foreach ($koderekening as $d)
                   <option {{ $anggaran->id_rekening == $d->id_rekening ? 'selected' : '' }}
                      value="{{ Crypt::encrypt($d->id_rekening) }}"> {{$d->kd_rekening}} - {{$d->nm_rekening}}</option>
                   @endforeach
                </select>
             </div>
             <div class="mb-3">
                 <label class="form-label">Nama Anggaran :</label>
                 <select name="nm_anggaran" class="form-control nm_anggaran">
                    @if($anggaran->nm_anggaran)
                        <option value="{{ $anggaran->nm_anggaran }}" selected>
                            {{ $anggaran->nm_anggaran }}
                        </option>
                    @endif
                </select>
             </div>
             <div class="mb-3">
                 <label class="form-label">Sub Anggaran :</label>
                 <select name="sub_anggaran" class="form-control nm_anggaran">
                    @if($anggaran->sub_anggaran)
                        <option value="{{ $anggaran->sub_anggaran }}" selected>
                            {{ $anggaran->sub_anggaran }}
                        </option>
                    @endif
                </select>
             </div>
        </div>
     </div>
     <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
