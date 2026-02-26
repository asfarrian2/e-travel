         <form action="{{ Route('u.akun')}}"  method="POST" enctype="multipart/form-data">
         @csrf
             <div class="mb-3">
                 <label class="form-label">Pegawai :</label>
                 <input type="hidden" name="id" value="{{ Crypt::encrypt($user->id) }}" class="form-control input-default" required>
                 <select class="input-default form-control" name="pegawai" id="pegawai" required>
                    <option value="">Pilih Pegawai</option>
                    @foreach ($pegawai as $d)
                    <option {{ $user->id_pelaksana == $d->id_pelaksana ? 'selected' : '' }}
                    value="{{ Crypt::encrypt($d->id_pelaksana) }}">{{$d->nip }} - {{$d->nama }}</option>
                    @endforeach
                </select>
             </div>
             <div class="mb-3">
                 <label class="form-label">Nama Panggilan :</label>
                 <input type="text" name="nickname" value="{{ $user->nickname }}" class="form-control input-default" required>
             </div>
             <div class="mb-3">
                 <label class="form-label">Email :</label>
                 <input type="email" name="email" value="{{ $user->email }}" class="form-control input-default" required>
             </div>
             <div class="mb-3">
                 <label class="form-label">Password :</label>
                 <input type="text" name="password" class="form-control input-default">
             </div>
             <div class="mb-3">
                <label class="form-label">Profile :</label>
                <select class="input-default form-control" name="profile" required>
                    <option value="">-Pilih Tujuan-</option>
                    <option value="1" {{ $user->profile == '1' ? 'selected' : '' }}>Laki-Laki</option>
                    <option value="0" {{ $user->profile == '0' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
        </div>
     </div>
     <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
