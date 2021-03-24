@extends('templates.main')

@section('content')
<div class="box p-5">
    <form class="grid grid-cols-12 gap-2" action="{{ route('dokter_update', $dokter->id) }}" method="post" enctype="multipart/form-data">
        @method('patch')
        @csrf
        <div class="col-span-12">
            <div class="grid grid-cols-12 gap-2">
                <div class="col-span-12 sm:col-span-4 mb-3">
                    <label for="inputDokterID" class="form-label">ID Dokter</label>
                    <input type="text" id="inputDokterID" class="form-control text-center" value="{{ $dokter->dokterid }}" readonly disabled>
                </div>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-4 mb-3">
            <label for="inputPhoto" class="form-label">Foto Dokter</label>
            <input type="file" id="inputPhoto" class="form-control @error('nosertif') is-invalid @enderror" name="photo" accept="image/x-png,image/gif,image/jpeg">
            <div class="form-help @error('photo') text-invalid @enderror">* Maksimal {{ $photo_maxSize }}</div>
        </div>
        <div class="col-span-12 sm:col-span-4 mb-3">
            <label for="inputSertif" class="form-label">No. Surat Izin</label>
            <input type="text" id="inputSertif" class="form-control text-center @error('nosertif') is-invalid @enderror" name="nosertif" value="{{ $dokter->nosertif }}">
        </div>
        <div class="col-span-12 sm:col-span-4 mb-3">
            <label for="inputValid" class="form-label">Valid Sampai</label>
            <input type="date" id="inputValid" class="form-control @error('validtill') is-invalid @enderror" name="validtill" value="{{ $dokter->validtill }}">
        </div>
        <div class="col-span-12 sm:col-span-6 mb-3">
            <label for="inputSTR" class="form-label">No. STR</label>
            <input type="text" id="inputSTR" class="form-control @error('nostr') is-invalid @enderror" name="nostr" value="{{ $dokter->nostr }}">
        </div>
        <div class="col-span-12 sm:col-span-6 mb-3">
            <label for="inputIDI" class="form-label">No. Rekomendasi</label>
            <input type="text" id="inputIDI" class="form-control @error('norekom') is-invalid @enderror" name="norekom" value="{{ $dokter->norekom }}">
        </div>
        <div class="col-span-12 sm:col-span-6 mb-3">
            <label for="inputNama" class="form-label">Nama Lengkap</label>
            <input type="text" id="inputNama" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ $dokter->nama }}">
        </div>
        <div class="col-span-12 sm:col-span-6 mb-3">
            <label for="inputNamaGelar" class="form-label">Nama Lengkap (Gelar)</label>
            <input type="text" id="inputNamaGelar" class="form-control @error('namagelar') is-invalid @enderror" name="namagelar" value="{{ $dokter->namagelar }}">
        </div>
        <div class="col-span-12 sm:col-span-6">
            <div class="grid grid-cols-12 gap-2">
                <div class="col-span-12 sm:col-span-6 mb-3">
                    <label for="inputTempatLahir" class="form-label">Tempat Lahir</label>
                    <input type="text" id="inputTempatLahir" class="form-control @error('tempatlahir') is-invalid @enderror" name="tempatlahir" value="{{ $dokter->tempatlahir }}">
                </div>
                <div class="col-span-12 sm:col-span-6 mb-3">
                    <label for="inputTanggalLahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" id="inputTanggalLahir" class="form-control @error('datelahir') is-invalid @enderror" name="datelahir" value="{{ $dokter->datelahir }}">
                </div>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-6 mb-3">
            <label for="inputAlamat" class="form-label">Alamat</label>
            <textarea id="inputAlamat" class="form-control @error('alamat') is-invalid @enderror" name="alamat" rows="1">{{ $dokter->alamat }}</textarea>
        </div>
        <div class="col-span-12">
            <label for="inputKeterangan" class="form-label">Keterangan</label>
            <textarea id="inputKeterangan" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" rows="3">{{ $dokter->keterangan }}</textarea>
        </div>
        <div class="col-span-12 mt-2 mb-5"><hr></div>
        <div class="col-span-12">
            <label for="inputSertifikat" class="form-label">Sertifikat</label>
            <input type="file" id="inputSertifikat" class="form-control @error('sertifikat') is-invalid @enderror" name="sertifikat" accept="image/x-png,image/gif,image/jpeg">
            <div class="form-help @error('sertifikat') text-invalid @enderror">* Maksimal {{ $sertifikat_maxSize }}</div>
        </div>
        <div class="col-span-12">
            <div class="flex mt-5 justify-end">
                <button class="btn btn-warning" type="submit"><i class="fas fa-edit mr-2"></i> Edit Data</button>
            </div>
        </div>
    </form>
</div>
@endsection
