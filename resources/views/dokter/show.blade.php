@extends('templates.main')

@section('content')
<div class="box p-5">
    <div class="grid grid-cols-12 gap-2">
        <div class="col-span-12 sm:col-span-4 mb-3">
            <label for="inputDokterID" class="form-label">ID Dokter</label>
            <input type="text" id="inputDokterID" class="form-control text-center" value="{{ $dokter->dokterid }}" readonly>
        </div>
        <div class="col-span-12 sm:col-span-4 mb-3">
            <label for="inputSertif" class="form-label">No. Surat Izin</label>
            <input type="text" id="inputSertif" class="form-control text-center" name="nosertif" value="{{ $dokter->nosertif }}" readonly>
        </div>
        <div class="col-span-12 sm:col-span-4 mb-3">
            <label for="inputValid" class="form-label">Valid Sampai</label>
            <input type="date" id="inputValid" class="form-control" name="validtill" value="{{ $dokter->validtill }}" readonly>
        </div>
        <div class="col-span-12 sm:col-span-6 mb-3">
            <label for="inputSTR" class="form-label">No. STR</label>
            <input type="text" id="inputSTR" class="form-control" name="nostr" value="{{ $dokter->nostr }}" readonly>
        </div>
        <div class="col-span-12 sm:col-span-6 mb-3">
            <label for="inputIDI" class="form-label">No. Rekomendasi</label>
            <input type="text" id="inputIDI" class="form-control" name="norekom" value="{{ $dokter->norekom }}" readonly>
        </div>
        <div class="col-span-12 sm:col-span-6 mb-3">
            <label for="inputNama" class="form-label">Nama Lengkap</label>
            <input type="text" id="inputNama" class="form-control" name="nama" value="{{ $dokter->nama }}" readonly>
        </div>
        <div class="col-span-12 sm:col-span-6 mb-3">
            <label for="inputNamaGelar" class="form-label">Nama Lengkap (Gelar)</label>
            <input type="text" id="inputNamaGelar" class="form-control" name="namagelar" value="{{ $dokter->namagelar }}" readonly>
        </div>
        <div class="col-span-12 sm:col-span-6">
            <div class="grid grid-cols-12 gap-2">
                <div class="col-span-12 sm:col-span-6 mb-3">
                    <label for="inputTempatLahir" class="form-label">Tempat Lahir</label>
                    <input type="text" id="inputTempatLahir" class="form-control" name="tempatlahir" value="{{ $dokter->tempatlahir }}" readonly>
                </div>
                <div class="col-span-12 sm:col-span-6 mb-3">
                    <label for="inputTanggalLahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" id="inputTanggalLahir" class="form-control" name="datelahir" value="{{ $dokter->datelahir }}" readonly>
                </div>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-6 mb-3">
            <label for="inputAlamat" class="form-label">Alamat</label>
            <textarea id="inputAlamat" class="form-control" name="alamat" rows="1" readonly>{{ $dokter->alamat }}</textarea>
        </div>
        <div class="col-span-12">
            <label for="inputKeterangan" class="form-label">Keterangan</label>
            <textarea id="inputKeterangan" class="form-control" name="keterangan" rows="3" readonly>{{ $dokter->keterangan }}</textarea>
        </div>
        <div class="col-span-12 mt-2 mb-5"><hr></div>
        <div class="col-span-12">
            <label for="inputSertifikat" class="form-label">Sertifikat</label>
            <div class="h-full w-full">
                <img src="{{asset('uploads/dokter').'/'.$dokter->sertifikat}}">
            </div>
        </div>
        <div class="col-span-12">
            <div class="flex mt-5 justify-end">
                @staff
                <a class="btn btn-warning" href="{{ route('dokter_edit', $dokter->id) }}"><i class="fas fa-edit mr-2"></i> Edit Data</a>
                <a class="btn btn-danger ml-2" href="javascript:;" data-toggle="modal" data-target="#delete-modal"><i class="fas fa-trash-alt mr-2"></i> Hapus Data</a>
                @endstaff
            </div>
        </div>
    </div>
</div>
@staff
<div id="delete-modal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <a data-dismiss="modal" href="javascript:;"><i data-feather="x" class="w-8 h-8 text-gray-500"></i></a>
            <div class="modal-body p-0">
                <div class="p-5 text-center">
                    <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                    <div class="text-3xl mt-5">Apakah anda yakin?</div>
                    <div class="text-gray-600 mt-2">Apakah anda benar-benar ingin menghapus data ini? <br>Proses ini tidak dapat dibatalkan.</div>
                </div>
                <div class="px-5 pb-8 text-center">
                    <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-24 dark:border-dark-5 dark:text-gray-300 mr-1">Batal</button>
                    <form action="{{ route('dokter_destroy', $dokter->id) }}" method="post" class="inline">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger" type="submit"><i class="fas fa-trash mr-2"></i> Hapus Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endstaff
@endsection
