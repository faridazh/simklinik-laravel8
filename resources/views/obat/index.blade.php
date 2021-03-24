@extends('templates.main')

@section('content')
<div class="flex mb-5">
    <a href="{{ route('obat_create') }}" class="btn btn-primary"><i class="fas fa-plus mr-2"></i> Obat Baru</a>
    <form action="{{ route('obat_index') }}" method="get" class="flex ml-auto search hidden sm:block">
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
                <a href="{{ route('obat_index') }}" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"><i class="fas fa-sync-alt mr-2"></i> Refresh</a>
            </div>
        </div>
    </div>
</div>
<div class="box p-5 overflow-x-auto">
    <table class="table">
        <thead>
            <tr class="border-b-2 dark:border-dark-5 whitespace-nowrap text-center">
                <th width="10%">Kode</th>
                <th width="20%">Nama Obat</th>
                <th width="30%">Isi Obat</th>
                <th width="10%">Golongan</th>
                <th width="10%">Stok</th>
                <th width="10%">Harga</th>
                <th width="10%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($obats as $obat)
                <tr class="border-b dark:border-dark-5 whitespace-nowrap text-center">
                    <td class="font-medium">{{ $obat->code }}</td>
                    <td>{{ $obat->namaobat }}</td>
                    <td>{{ $obat->isiobat }}</td>
                    <td class="font-medium text-gray-700 dark:text-gray-600">
                        @if(in_array($obat->golongan, ['Bebas','Bebas Terbatas']))
                        <span class="px-1 rounded border-2 border-theme-9">{{ $obat->golongan }}</span>
                        @elseif(in_array($obat->golongan, ['Keras']))
                        <span class="px-1 rounded border-2 border-theme-6">{{ $obat->golongan }}</span>
                        @else
                        <span class="px-1 rounded border-2">{{ $obat->golongan }}</span>
                        @endif
                    </td>
                    <!-- <td><span class="px-1 rounded border-2 bg-gray-200">{{ $obat->jenis }}</span></td> -->
                    <td>{{ $obat->stok . ' ' . $obat->jenis }}</td>
                    <td id="harga">{{ config('setting.currency') . number_format($obat->harga_jual) }}</td>
                    <td class="text-center">
                        <a href="{{ route('obat_edit', $obat->id) }}" class="btn btn-warning btn-sm tooltip" title="Edit"><i class="fas fa-pen fa-fw"></i></a>
                        @staff
                        <form action="{{ route('obat_destroy', $obat->id) }}" method="post" class="inline">
                            @method('delete')
                            @csrf
                            <button class="btn btn-sm btn-danger tooltip" type="submit" onclick="return confirm('Apakah anda yakin?');" title="Delete"><i class="fas fa-trash fa-fw"></i></button>
                        </form>
                        @endstaff
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="block mt-5 text-center">
    <div>Menampilkan <span class="font-medium">{{$obats->firstItem()}}</span> sampai <span class="font-medium">{{$obats->lastItem()}}</span> dari <span class="font-medium">{{$obats->total()}}</span> data.</div>
    <div class="flex mt-5 mb-3">
        @if ($obats->lastPage() > 1)
        <ul class="pagination ml-auto mr-auto">
            @if($obats->currentPage() > $obats->onFirstPage()+2)
            <li><a class="pagination__link tooltip" href="{{$obats->url($obats->onFirstPage())}}" title="Halaman Awal"><i class="fas fa-chevron-double-left"></i></a></li>
            @endif
            @if($obats->currentPage() > $obats->onFirstPage())
            <li><a class="pagination__link tooltip" href="{{$obats->previousPageUrl()}}" title="Halaman Sebelumnya"><i class="fas fa-chevron-left"></i></a></li>
            @endif
            @for ($i = 1; $i <= $obats->lastPage(); $i++)
                <?php
                $half_total_links = floor(7/2);
                $from = $obats->currentPage() - $half_total_links;
                $to = $obats->currentPage() + $half_total_links;
                if ($obats->currentPage() < $half_total_links) {
                   $to += $half_total_links - $obats->currentPage();
                }
                if ($obats->lastPage() - $obats->currentPage() < $half_total_links) {
                    $from -= $half_total_links - ($obats->lastPage() - $obats->currentPage()) - 1;
                }
                ?>
                @if ($from < $i && $i < $to)
                    <li><a href="{{ $obats->url($i) }}" class="pagination__link @if(($obats->currentPage() == $i)) pagination__link--active tooltip @endif" @if($obats->currentPage() == $i)) title="Halaman Sekarang" @endif>{{ $i }}</a></li>
                @endif
            @endfor
            @if($obats->currentPage() < $obats->lastPage())
            <li><a class="pagination__link tooltip" href="{{$obats->nextPageUrl()}}" title="Halaman Selanjutnya"><i class="fas fa-chevron-right"></i></a></li>
            @endif
            @if($obats->currentPage() < $obats->lastPage()-1)
            <li><a class="pagination__link tooltip" href="{{$obats->url($obats->lastPage())}}" title="Halaman Terakhir"><i class="fas fa-chevron-double-right"></i></a></li>
            @endif
        </ul>
        @endif
    </div>
</div>
@endsection
