@extends('templates.main')

@section('breadcrumb', Breadcrumbs::render('registrasi'))

@section('content')
<div class="ml-auto mr-auto mb-10 w-auto sm:w-64 lg:w-64">
    <div class="block items-center h-10">
        <h2 class="text-lg font-medium truncate mr-5">Input Antrian</h2>
    </div>
    <div class="box p-5">
        <form action="{{ route('registrasi_index') }}" method="post">
            @csrf
            <div>
                <label for="inputRM" class="form-label font-medium">No. RM</label>
                <input type="text" class="form-control text-center @error('norm') is-invalid @enderror" id="inputRM" name="norm">
            </div>
            <div class="mt-3">
                <label for="inputJenis" class="form-label font-medium">Jenis Antrean</label>
                <select class="form-select @error('jenis') is-invalid @enderror" id="inputJenis" name="jenis">
                    <option value="Apotek">Apotek</option>
                    <option value="Dokter" selected>Dokter</option>
                    <option value="Kasir">Kasir</option>
                    <option value="Laboratorium">Laboratorium</option>
                </select>
            </div>
            <div class="text-right mt-5">
                <button type="submit" class="btn btn-primary"><i class="far fa-plus mr-2"></i> Tambah Antrian</button>
            </div>
        </form>
    </div>
</div>
<div class="box p-5 overflow-x-auto">
    <table class="table">
        <thead>
            <tr class="border-b-2 dark:border-dark-5 whitespace-nowrap text-center">
                <th width="15%">No. Antrian</th>
                <th width="15%">No. RM</th>
                <th width="30%">Nama Pasien</th>
                <th width="15%">Jenis Antrian</th>
                <th width="15%">Status</th>
                <th width="10%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($antrians as $antrian)
                <tr class="border-b dark:border-dark-5 whitespace-nowrap text-center">
                    <td class="font-medium">{{ $antrian->antrian }}</td>
                    <td>{{ $antrian->norm }}</td>
                    <td>{{ $antrian->nama }}</td>
                    <td>{{ $antrian->jenis }}</td>
                    <td>{{ $antrian->status }}</td>
                    <td>
                        <form action="{{ route('registrasi_destroy', $antrian->id) }}" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="btn btn-sm btn-danger tooltip" title="Hapus" type="submit" onclick="return confirm('Apakah anda yakin?');"><i class="far fa-trash-alt fa-fw"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="flex mt-10 justify-center">
        <a href="{{ route('antrean') }}" class="btn btn-primary mx-2"><i class="far fa-stream mr-2"></i> List Antrian</a>
        @admin
            <a href="javascript:;" data-toggle="modal" data-target="#hapus-semua-antrian-modal" class="btn btn-danger"><i class="far fa-trash mr-2"></i> Hapus Semua Antrian</a>
        @endadmin
    </div>
</div>
@admin
<div id="hapus-semua-antrian-modal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <a data-dismiss="modal" href="javascript:;"><i data-feather="x" class="w-8 h-8 text-gray-500"></i></a>
            <div class="modal-body p-0">
                <div class="p-5 text-center"> <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                    <div class="text-3xl mt-5">Apakah anda yakin?</div>
                    <div class="text-gray-600 mt-2">Apakah anda benar-benar ingin menghapus semua data? <br>Proses ini tidak dapat dibatalkan.</div>
                </div>
                <div class="px-5 pb-8 text-center">
                    <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-24 dark:border-dark-5 dark:text-gray-300 mr-1">Batal</button>
                    <form action="{{ route('registrasi_destroy_all') }}" method="post" class="inline">
                        @csrf
                        <button class="btn btn-danger w-24" type="submit" role="button"><i class="far fa-trash mr-2"></i> Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endadmin
@endsection
