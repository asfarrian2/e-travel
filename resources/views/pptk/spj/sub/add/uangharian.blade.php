<input type="hidden" name="kegunaan" value="Uang Harian" class="form-control input-default" required>
<input type="hidden" name="subspj" value="{{ Crypt::encrypt($id_subspj) }}" class="form-control input-default" required>
<div class="mb-3">
    <label class="form-label">Rincian Anggaran :</label>
    <select class="input-default form-control select2" name="anggaran" id="anggaran" required>
        <option value="">Pilih Rincian Anggaran</option>
        @foreach ($rincanggaran as $d)
        <option value="{{ Crypt::encrypt($d->id_rincanggaran) }}"> {{$d->uraian}} | Spesifikasi: {{ $d->spesifikasi}}</option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label class="form-label">Nilai Uang Harian (Rp) :</label>
    <input type="text" name="uang" class="form-control input-default pagu" required>
</div>
<div class="mb-3">
    <label class="form-label">Volume (Orang/Hari/Kali) :</label>
    <input type="number" name="volume" class="form-control input-default" required>
</div>
<div class="table-responsive">
    <table class="table table-bordered table-responsive-sm" style="min-width: 1200px">
            <tr>
                <td style="text-align:center; color: black; font-size: 12px">
                    <div class="form-check custom-checkbox checkbox-success check-md me-3">
                        <input type="checkbox" class="form-check-input checkAll" id="checkAll" required="">
                        <label class="form-check-label" for="checkAll"></label>
                    </div>
                </td>
                <td style="text-align:center; color: black; font-size: 12px"><b>NAMA / GOLONGAN / NIP</b></td>
                <td style="text-align:center; color: black; font-size: 12px"><b>JABATAN</b></td>
                <td style="text-align:center; color: black; font-size: 12px"><b>UANG HARIAN</b></td>
            </tr>
            @foreach ($pelperjadin->sortBy('pelaksana.kelas') as $d)
            <tr>
                <td>
                <div class="form-check custom-checkbox checkbox-success check-md me-3">
                <input type="checkbox" 
                       class="form-check-input checkItem" 
                       name="pelperjadin[]" 
                       value="{{ $d->id_pelperjadin }}"
                       id="check{{$loop->index}}">
                <label class="form-check-label" for="check{{$loop->index}}"></label>
                </div>
                </td>
                <td style="color: black; font-size: 12px"> 
                    <b>{{ $d->pelaksana->nama }}</b> <br>
                    {{ $d->pelaksana->pangkgol }}<br>
                    NIP. {{ $d->pelaksana->nip }}
                </td>
                <td style="color: black; font-size: 12px"> {{ $d->pelaksana->jabatan }}</td>
                <td style="text-align:center; color: black; font-size: 12px">@if($d->uang_harian == NULL) Rp0 @else Rp{{ number_format($d->uang_harian) }} @endif</td>
            </tr>
            @endforeach
    </table>
</div>