@extends('templates.main')

@section('breadcrumb', Breadcrumbs::render('dokter_index'))

@section('content')
<div class="flex mb-5">
    <a href="{{ route('dokter_create') }}" class="btn btn-primary"><i class="fas fa-plus mr-2"></i> Dokter Baru</a>
    <form action="{{ route('dokter_index') }}" method="get" class="flex ml-auto search hidden sm:block">
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
                <a href="{{ route('dokter_index') }}" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"><i class="fas fa-sync-alt mr-2"></i> Refresh</a>
            </div>
        </div>
    </div>
</div>
<div class="box p-5 overflow-x-auto">
    <table class="table">
        <thead>
            <tr class="border-b-2 dark:border-dark-5 whitespace-nowrap text-center">
                <th width="10%">ID Dokter</th>
                <th width="25%">Nama (Gelar)</th>
                <th width="20%">Valid Sampai</th>
                <th width="35%">Alamat</th>
                <th width="10%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dokters as $dokter)
                <tr class="border-b dark:border-dark-5 whitespace-nowrap text-center">
                    <td class="font-medium">{{ $dokter->dokterid }}</td>
                    <td class="flex justify-center items-center">
                        <div class="w-6 h-6 mr-5">
                            <img class="rounded-full" src="{{asset('uploads/dokter').'/'.$dokter->photo}}" onerror="this.src='{{asset('assets/images/default_avatar.png')}}';">
                        </div>
                        <div>{{ $dokter->namagelar }}</div>
                    </td>
                    <td>{{ $dokter->validtill }}</td>
                    <td>{{ $dokter->alamat }}</td>
                    <td class="text-center">
                        <a href="{{ route('dokter_edit', $dokter->id) }}" class="btn btn-warning btn-sm tooltip" title="Edit"><i class="fas fa-pen fa-fw"></i></a>
                        <a href="{{ route('dokter_show', $dokter->id) }}" class="btn btn-primary btn-sm tooltip" title="Detail"><i class="fas fa-info fa-fw"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="block mt-5 text-center">
    <div>Menampilkan <span class="font-medium">{{$dokters->firstItem()}}</span> sampai <span class="font-medium">{{$dokters->lastItem()}}</span> dari <span class="font-medium">{{$dokters->total()}}</span> data.</div>
    <div class="flex mt-5 mb-3">
        @if ($dokters->lastPage() > 1)
        <ul class="pagination ml-auto mr-auto">
            @if($dokters->currentPage() > $dokters->onFirstPage()+2)
            <li><a class="pagination__link tooltip" href="{{$dokters->url($dokters->onFirstPage())}}" title="Halaman Awal"><i class="fas fa-chevron-double-left"></i></a></li>
            @endif
            @if($dokters->currentPage() > $dokters->onFirstPage())
            <li><a class="pagination__link tooltip" href="{{$dokters->previousPageUrl()}}" title="Halaman Sebelumnya"><i class="fas fa-chevron-left"></i></a></li>
            @endif
            @for ($i = 1; $i <= $dokters->lastPage(); $i++)
                <?php
                $half_total_links = floor(7/2);
                $from = $dokters->currentPage() - $half_total_links;
                $to = $dokters->currentPage() + $half_total_links;
                if ($dokters->currentPage() < $half_total_links) {
                   $to += $half_total_links - $dokters->currentPage();
                }
                if ($dokters->lastPage() - $dokters->currentPage() < $half_total_links) {
                    $from -= $half_total_links - ($dokters->lastPage() - $dokters->currentPage()) - 1;
                }
                ?>
                @if ($from < $i && $i < $to)
                    <li><a href="{{ $dokters->url($i) }}" class="pagination__link @if(($dokters->currentPage() == $i)) pagination__link--active tooltip @endif" @if($dokters->currentPage() == $i)) title="Halaman Sekarang" @endif>{{ $i }}</a></li>
                @endif
            @endfor
            @if($dokters->currentPage() < $dokters->lastPage())
            <li><a class="pagination__link tooltip" href="{{$dokters->nextPageUrl()}}" title="Halaman Selanjutnya"><i class="fas fa-chevron-right"></i></a></li>
            @endif
            @if($dokters->currentPage() < $dokters->lastPage()-1)
            <li><a class="pagination__link tooltip" href="{{$dokters->url($dokters->lastPage())}}" title="Halaman Terakhir"><i class="fas fa-chevron-double-right"></i></a></li>
            @endif
        </ul>
        @endif
    </div>
</div>
@endsection
