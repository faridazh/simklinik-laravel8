@extends('templates.main')

@section('breadcrumb', Breadcrumbs::render('pegawai_index'))

@section('content')
<div class="flex mb-5">
    <a href="{{ route('pegawai_create') }}" class="btn btn-primary"><i class="fas fa-plus mr-2"></i> Staff Baru</a>
    <form action="{{ route('pegawai_index') }}" method="get" class="flex ml-auto search hidden sm:block">
        <input class="search__input form-control border-transparent placeholder-theme-13" type="search" name="cari" placeholder="Masukan keyword...">
        <i class="far fa-search feather feather-search search__icon dark:text-gray-300 text-lg"></i>
    </form>
    <div class="dropdown hidden sm:block sm:ml-2">
        <button class="dropdown-toggle btn px-2 box text-gray-700 dark:text-gray-300" aria-expanded="false">
            <span class="w-5 h-5 flex items-center justify-center">
                <i class="fas fa-ellipsis-v text-lg"></i>
            </span>
        </button>
        <div class="dropdown-menu w-40">
            <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                <a href="{{ route('pegawai_index') }}" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"><i class="fas fa-sync-alt mr-2"></i> Refresh</a>
            </div>
        </div>
    </div>
</div>
<div class="box p-5 overflow-x-auto">
    <table class="table">
        <thead>
            <tr class="border-b-2 dark:border-dark-5 whitespace-nowrap text-center">
                <th width="10%">Staff ID</th>
                <th width="25%">Username</th>
                <th width="25%">Nama</th>
                <th width="20%">Level</th>
                <th width="10%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pegawais as $pegawai)
                <tr class="border-b dark:border-dark-5 whitespace-nowrap text-center">
                    <td class="font-medium">{{ $pegawai->staffid }}</td>
                    <td class="flex justify-center items-center">
                        <div class="w-6 h-6 mr-5">
                            <img class="rounded-full" src="{{asset('uploads/avatar').'/'.$pegawai->avatar}}" onerror="this.src='{{asset('assets/images/default_avatar.png')}}';">
                        </div>
                        <div>{{ $pegawai->username }}</div>
                    </td>
                    <td>{{ $pegawai->name }}</td>
                    <td>{{ $pegawai->level }}</td>
                    <td>
                        <a href="{{ route('pegawai_edit', $pegawai->id) }}" class="btn btn-warning btn-sm tooltip" title="Edit"><i class="fas fa-pen fa-fw"></i></a>
                        <a href="{{ route('pegawai_show', $pegawai->id) }}" class="btn btn-primary btn-sm tooltip" title="Detail"><i class="fas fa-info fa-fw"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="block mt-5 text-center">
    <div>Menampilkan <span class="font-medium">{{$pegawais->firstItem()}}</span> sampai <span class="font-medium">{{$pegawais->lastItem()}}</span> dari <span class="font-medium">{{$pegawais->total()}}</span> data.</div>
    <div class="flex mt-5 mb-3">
        @if ($pegawais->lastPage() > 1)
        <ul class="pagination ml-auto mr-auto">
            @if($pegawais->currentPage() > $pegawais->onFirstPage()+2)
            <li><a class="pagination__link tooltip" href="{{$pegawais->url($pegawais->onFirstPage())}}" title="Halaman Awal"><i class="fas fa-chevron-double-left"></i></a></li>
            @endif
            @if($pegawais->currentPage() > $pegawais->onFirstPage())
            <li><a class="pagination__link tooltip" href="{{$pegawais->previousPageUrl()}}" title="Halaman Sebelumnya"><i class="fas fa-chevron-left"></i></a></li>
            @endif
            @for ($i = 1; $i <= $pegawais->lastPage(); $i++)
                <?php
                $half_total_links = floor(7/2);
                $from = $pegawais->currentPage() - $half_total_links;
                $to = $pegawais->currentPage() + $half_total_links;
                if ($pegawais->currentPage() < $half_total_links) {
                   $to += $half_total_links - $pegawais->currentPage();
                }
                if ($pegawais->lastPage() - $pegawais->currentPage() < $half_total_links) {
                    $from -= $half_total_links - ($pegawais->lastPage() - $pegawais->currentPage()) - 1;
                }
                ?>
                @if ($from < $i && $i < $to)
                    <li><a href="{{ $pegawais->url($i) }}" class="pagination__link @if(($pegawais->currentPage() == $i)) pagination__link--active tooltip @endif" @if($pegawais->currentPage() == $i)) title="Halaman Sekarang" @endif>{{ $i }}</a></li>
                @endif
            @endfor
            @if($pegawais->currentPage() < $pegawais->lastPage())
            <li><a class="pagination__link tooltip" href="{{$pegawais->nextPageUrl()}}" title="Halaman Selanjutnya"><i class="fas fa-chevron-right"></i></a></li>
            @endif
            @if($pegawais->currentPage() < $pegawais->lastPage()-1)
            <li><a class="pagination__link tooltip" href="{{$pegawais->url($pegawais->lastPage())}}" title="Halaman Terakhir"><i class="fas fa-chevron-double-right"></i></a></li>
            @endif
        </ul>
        @endif
    </div>
</div>
@endsection
