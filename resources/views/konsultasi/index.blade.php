@extends('templates.main')

@section('content')
<div class="flex flex-col lg:flex-row mb-10">
    <div class="box p-5 w-auto lg:w-1/2 flex flex-col justify-center items-center">
        @asyncWidget('antri_dokter')
    </div>
    <div class="box p-5 ml-0 lg:ml-5 w-auto lg:w-1/2 flex flex-col justify-center items-center">
        <div class="mb-5 text-center">
            <div class="text-xl font-bold">Tampilkan Rekam Medis</div>
            <div class="">Menampilkan rekam medis secara spesifik</div>
        </div>
        <form class="flex" action="{{ route('konsultasi_list') }}" method="get">
            <div class="input-group">
                <div class="input-group-text w-32 text-center">No. RM</div>
                <input type="text" class="form-control text-center" name="rm" value="{{ old('rm') }}" autocomplete="off">
            </div>
            <button type="submit" class="btn btn-outline-primary ml-3"><i class="fas fa-search mr-2"></i> Cari</button>
        </form>
    </div>
</div>
<div class="flex mb-5">
    {!! $consulting !!}
    <form action="{{ route('konsultasi_index') }}" method="get" class="flex ml-auto search hidden sm:block">
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
                <a href="{{ route('konsultasi_index') }}" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"><i class="fas fa-sync-alt mr-2"></i> Refresh</a>
            </div>
        </div>
    </div>
</div>
<div class="box p-5 overflow-x-auto">
    <table class="table">
        <thead>
            <tr class="border-b-2 dark:border-dark-5 whitespace-nowrap text-center">
                <th width="10%">No. RM</th>
                <th width="25%">Nama Pasien</th>
                <th width="20%">Tanggal</th>
                <th width="35%">Diagnosa</th>
                <th width="10%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($consultations as $consultation)
                <tr class="border-b dark:border-dark-5 whitespace-nowrap text-center">
                    <td class="font-medium">{{ $consultation->norm }}</td>
                    <td>{{ $consultation->nama }}</td>
                    <td>{{ date('j M, Y', strtotime($consultation->tanggal)) }}</td>
                    <td>{{ $consultation->diagnosa }}</td>
                    <td>
                        @if(in_array($consultation->resep, ['Belum']))
                        <a class="btn btn-primary btn-sm tooltip" title="Buat Resep" href="{{ route('konsultasi_resep', $consultation->id) }}"><i class="fas fa-file-medical"></i></a>
                        @elseif(in_array($consultation->resep, ['Sedang', 'Sudah']))
                        <a class="btn btn-primary btn-sm tooltip" title="Lihat Resep" href="{{ route('konsultasi_show_resep', $consultation->id) }}"><i class="fas fa-eye"></i></a>
                        @endif
                        <a href="{{ route('konsultasi_show', $consultation->id) }}" class="btn btn-primary btn-sm tooltip" title="Detail"><i class="fas fa-info fa-fw"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="block mt-5 text-center">
    <div>Menampilkan <span class="font-medium">{{$consultations->firstItem()}}</span> sampai <span class="font-medium">{{$consultations->lastItem()}}</span> dari <span class="font-medium">{{$consultations->total()}}</span> data.</div>
    <div class="flex mt-5 mb-3">
        @if ($consultations->lastPage() > 1)
        <ul class="pagination ml-auto mr-auto">
            @if($consultations->currentPage() > $consultations->onFirstPage()+2)
            <li><a class="pagination__link tooltip" href="{{$consultations->url($consultations->onFirstPage())}}" title="Halaman Awal"><i class="fas fa-chevron-double-left"></i></a></li>
            @endif
            @if($consultations->currentPage() > $consultations->onFirstPage())
            <li><a class="pagination__link tooltip" href="{{$consultations->previousPageUrl()}}" title="Halaman Sebelumnya"><i class="fas fa-chevron-left"></i></a></li>
            @endif
            @for ($i = 1; $i <= $consultations->lastPage(); $i++)
                <?php
                $half_total_links = floor(7/2);
                $from = $consultations->currentPage() - $half_total_links;
                $to = $consultations->currentPage() + $half_total_links;
                if ($consultations->currentPage() < $half_total_links) {
                   $to += $half_total_links - $consultations->currentPage();
                }
                if ($consultations->lastPage() - $consultations->currentPage() < $half_total_links) {
                    $from -= $half_total_links - ($consultations->lastPage() - $consultations->currentPage()) - 1;
                }
                ?>
                @if ($from < $i && $i < $to)
                    <li><a href="{{ $consultations->url($i) }}" class="pagination__link @if(($consultations->currentPage() == $i)) pagination__link--active tooltip @endif" @if($consultations->currentPage() == $i)) title="Halaman Sekarang" @endif>{{ $i }}</a></li>
                @endif
            @endfor
            @if($consultations->currentPage() < $consultations->lastPage())
            <li><a class="pagination__link tooltip" href="{{$consultations->nextPageUrl()}}" title="Halaman Selanjutnya"><i class="fas fa-chevron-right"></i></a></li>
            @endif
            @if($consultations->currentPage() < $consultations->lastPage()-1)
            <li><a class="pagination__link tooltip" href="{{$consultations->url($consultations->lastPage())}}" title="Halaman Terakhir"><i class="fas fa-chevron-double-right"></i></a></li>
            @endif
        </ul>
        @endif
    </div>
</div>



@endsection
