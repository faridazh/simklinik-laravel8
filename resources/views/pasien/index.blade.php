@extends('templates.main')

@section('breadcrumb', Breadcrumbs::render('pasien_index'))

@section('content')
<div class="flex mb-5">
    <a href="{{ route('pasien_create') }}" class="btn btn-primary"><i class="fas fa-plus mr-2"></i> Pasien Baru</a>
    <form action="{{ route('pasien_index') }}" method="get" class="flex ml-auto search hidden sm:block">
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
                <a href="{{ route('pasien_index') }}" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"><i class="fas fa-sync-alt mr-2"></i> Refresh</a>
            </div>
        </div>
    </div>
</div>

<div class="box p-5 overflow-x-auto">
    <table class="table">
        <thead>
            <tr class="border-b-2 dark:border-dark-5 whitespace-nowrap text-center">
                <th width="10%">No. RM</th>
                <th width="20%">Nama</th>
                <th width="20%">Kepala Keluarga</th>
                <th width="40%">Alamat</th>
                <th width="10%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pasiens as $pasien)
            <tr class="border-b dark:border-dark-5 whitespace-nowrap text-center">
                <td class="font-medium">{{ $pasien->norm }}</td>
                <td>{{ $pasien->nama }}</td>
                <td>{{ $pasien->headfamily }}</td>
                <td>{{ $pasien->alamat }}</td>
                <td>
                    <a href="{{ route('pasien_edit', $pasien->id) }}" class="btn btn-warning btn-sm tooltip" title="Edit"><i class="fas fa-pen fa-fw"></i></a>
                    <a href="{{ route('pasien_show', $pasien->id) }}" class="btn btn-primary btn-sm tooltip" title="Detail"><i class="fas fa-info fa-fw"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="block mt-5 text-center">
    <div>Menampilkan <span class="font-medium">{{$pasiens->firstItem()}}</span> sampai <span class="font-medium">{{$pasiens->lastItem()}}</span> dari <span class="font-medium">{{$pasiens->total()}}</span> data.</div>
    <div class="flex mt-5 mb-3">
        @if ($pasiens->lastPage() > 1)
        <ul class="pagination ml-auto mr-auto">
            @if($pasiens->currentPage() > $pasiens->onFirstPage()+2)
            <li><a class="pagination__link tooltip" href="{{$pasiens->url($pasiens->onFirstPage())}}" title="Halaman Awal"><i class="fas fa-chevron-double-left"></i></a></li>
            @endif
            @if($pasiens->currentPage() > $pasiens->onFirstPage())
            <li><a class="pagination__link tooltip" href="{{$pasiens->previousPageUrl()}}" title="Halaman Sebelumnya"><i class="fas fa-chevron-left"></i></a></li>
            @endif
            @for ($i = 1; $i <= $pasiens->lastPage(); $i++)
                <?php
                $half_total_links = floor(7/2);
                $from = $pasiens->currentPage() - $half_total_links;
                $to = $pasiens->currentPage() + $half_total_links;
                if ($pasiens->currentPage() < $half_total_links) {
                   $to += $half_total_links - $pasiens->currentPage();
                }
                if ($pasiens->lastPage() - $pasiens->currentPage() < $half_total_links) {
                    $from -= $half_total_links - ($pasiens->lastPage() - $pasiens->currentPage()) - 1;
                }
                ?>
                @if ($from < $i && $i < $to)
                    <li><a href="{{ $pasiens->url($i) }}" class="pagination__link @if(($pasiens->currentPage() == $i)) pagination__link--active tooltip @endif" @if($pasiens->currentPage() == $i)) title="Halaman Sekarang" @endif>{{ $i }}</a></li>
                @endif
            @endfor
            @if($pasiens->currentPage() < $pasiens->lastPage())
            <li><a class="pagination__link tooltip" href="{{$pasiens->nextPageUrl()}}" title="Halaman Selanjutnya"><i class="fas fa-chevron-right"></i></a></li>
            @endif
            @if($pasiens->currentPage() < $pasiens->lastPage()-1)
            <li><a class="pagination__link tooltip" href="{{$pasiens->url($pasiens->lastPage())}}" title="Halaman Terakhir"><i class="fas fa-chevron-double-right"></i></a></li>
            @endif
        </ul>
        @endif
    </div>
</div>
@endsection
