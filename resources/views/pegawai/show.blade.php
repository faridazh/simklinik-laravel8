@extends('templates.main')

@section('content')
<div class="box pb-5 px-5 w-1/2 mx-auto">
    <div class="flex flex-col lg:flex-row border-b border-gray-200 dark:border-dark-5">
        <div class="flex flex-1 p-5 items-center justify-center lg:justify-start">
            <div class="w-16 h-16 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32 image-fit relative">
                <img class="rounded-full" src="{{asset('uploads/avatar'.'/'.$pegawai->avatar)}}" onerror="this.src='{{asset('uploads/avatar/default_avatar.png')}}';">
            </div>
            <div class="ml-5">
                <div class="sm:whitespace-normal font-medium text-lg lg:text-3xl">{{$pegawai->username}}</div>
                <div class="text-gray-600 sm:text-lg">{{$pegawai->level}}</div>
            </div>
        </div>
        <div class="flex-1 dark:text-gray-300 px-5 lg:border-l border-gray-200 dark:border-dark-5 border-t lg:border-t-0 py-5 lg:pb-0 lg:pt-0 my-auto">
            <div class="flex flex-col justify-center items-center lg:items-start">
                <div class="truncate sm:whitespace-normal flex items-center"><i class="far fa-id-badge mr-3"></i> {{$pegawai->staffid}}</div>
                <div class="truncate sm:whitespace-normal flex items-center mt-3"><i class="far fa-user mr-3"></i> {{$pegawai->name}}</div>
                <div class="truncate sm:whitespace-normal flex items-center mt-3"><i class="far fa-envelope mr-3"></i> {{$pegawai->email}}</div>
            </div>
        </div>
    </div>
    <div class="flex flex-col lg:flex-row text-center justify-center pt-5">
        <a href="{{ route('pegawai_edit', $pegawai->id) }}" class="mb-2 lg:mb-0 bg-theme-12 rounded px-2 py-1"><i class="fas fa-edit"></i> Edit Data</a>
        @admin<a href="javascript:;" class="lg:ml-2 bg-theme-6 text-white rounded px-2 py-1" data-toggle="modal" data-target="#delete-modal"><i class="fas fa-trash-alt"></i> Hapus Data</a>@endadmin
    </div>
</div>
@admin
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
                    <form action="{{ route('pegawai_destroy', $pegawai->id) }}" method="post" class="inline">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger" type="submit"><i class="fas fa-trash mr-2"></i> Hapus Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endadmin
@endsection
