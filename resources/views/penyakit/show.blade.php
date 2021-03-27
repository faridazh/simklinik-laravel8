@extends('templates.main')

@section('breadcrumb', Breadcrumbs::render('penyakit_show', $disease->id))

@section('content')
<div class="box p-5">
    <div class="grid grid-cols-12 gap-2">
        <div class="col-span-12">
            <div class="grid grid-cols-12 gap-2">
                <div class="col-span-12 lg:col-span-2 mb-3">
                    <label for="inputCode" class="form-label">Kode Penyakit</label>
                    <input type="text" class="form-control" id="inputCode" value="{{old('code') ?? $disease->code}}" readonly>
                </div>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-6 mb-3">
            <label for="inputNamaIndo" class="form-label">Nama Indonesia</label>
            <input type="text" class="form-control" id="inputNamaIndo" value="{{$disease->namaindo}}" readonly>
        </div>
        <div class="col-span-12 sm:col-span-6 mb-3">
            <label for="inputNamaInggris" class="form-label">Nama Inggris</label>
            <input type="text" class="form-control" id="inputNamaInggris" value="{{$disease->namainggris}}" readonly>
        </div>
        <div class="col-span-12">
            <label for="inputKeterangan" class="form-label">Keterangan</label>
            <textarea class="form-control" id="inputKeterangan" rows="3" readonly>{{$disease->keterangan}}</textarea>
        </div>
        @staff
        <div class="col-span-12">
            <div class="flex mt-5 justify-end">
                <a class="btn btn-warning" href="{{ route('penyakit_edit', $disease->id) }}"><i class="fas fa-edit mr-2"></i> Edit Data</a>
                <a class="btn btn-danger ml-2" href="javascript:;" data-toggle="modal" data-target="#delete-modal"><i class="fas fa-trash-alt mr-2"></i> Hapus Data</a>
            </div>
        </div>
        @endstaff
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
                    <form action="{{ route('penyakit_destroy', $disease->id) }}" method="post" class="inline">
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
