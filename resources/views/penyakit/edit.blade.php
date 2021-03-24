@extends('templates.main')

@section('content')
<div class="box p-5">
    <form class="grid grid-cols-12 gap-2" action="{{ route('penyakit_update', $disease->id) }}" method="post">
        @method('patch')
        @csrf
        <div class="col-span-12">
            <div class="grid grid-cols-12 gap-2">
                <div class="col-span-12 lg:col-span-2 mb-3">
                    <label for="inputCode" class="form-label">Kode Penyakit</label>
                    <input type="text" class="form-control @error('code') is-invalid @enderror" id="inputCode" name="code" value="{{old('code') ?? $disease->code}}">
                </div>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-6 mb-3">
            <label for="inputNamaIndo" class="form-label">Nama Indonesia</label>
            <input type="text" class="form-control @error('namaindo') is-invalid @enderror" id="inputNamaIndo" name="namaindo" value="{{old('namaindo') ?? $disease->namaindo}}">
        </div>
        <div class="col-span-12 sm:col-span-6 mb-3">
            <label for="inputNamaInggris" class="form-label">Nama Inggris</label>
            <input type="text" class="form-control @error('namainggris') is-invalid @enderror" id="inputNamaInggris" name="namainggris" value="{{old('namainggris') ?? $disease->namainggris}}">
        </div>
        <div class="col-span-12">
            <label for="inputKeterangan" class="form-label">Keterangan</label>
            <textarea class="form-control @error('keterangan') is-invalid @enderror" id="inputKeterangan" name="keterangan" rows="3">{{old('keterangan') ?? $disease->keterangan}}</textarea>
        </div>
        <div class="col-span-12">
            <div class="flex mt-5 justify-end">
                <button type="submit" class="btn btn-success"><i class="fas fa-save mr-2"></i> Save Data</button>
            </div>
        </div>
    </form>
</div>
@endsection
