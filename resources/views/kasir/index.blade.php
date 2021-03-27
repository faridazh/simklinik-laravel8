@extends('templates.main')

@section('breadcrumb', Breadcrumbs::render('invoice_index'))

@section('content')
<div class="flex mb-5">
    <form action="{{ route('invoice_index') }}" method="get" class="flex ml-auto search hidden sm:block">
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
                <a href="{{ route('invoice_index') }}" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"><i class="fas fa-sync-alt mr-2"></i> Refresh</a>
            </div>
        </div>
    </div>
</div>
<div class="box p-5 overflow-x-auto">
    <table class="table">
        <thead>
            <tr class="border-b-2 dark:border-dark-5 whitespace-nowrap text-center">
                <th width="20%">Invoice</th>
                <th width="15%">Code</th>
                <th width="15%">Payment Method</th>
                <th width="20%">Total</th>
                <th width="15%">Status</th>
                <th width="15%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoices as $invoice)
            <tr class="border-b dark:border-dark-5 whitespace-nowrap text-center">
                <td class="font-medium">{{ $invoice->invoice }}</td>
                <td>{{ $invoice->code }}</td>
                <td>{{ $invoice->payment_code }}</td>
                <td>{{ config('setting.currency') . ' ' . number_format($invoice->total) }}</td>
                <td>{{ $invoice->status }}</td>
                <td>
                    <a href="{{ route('invoice_edit', $pasien->id) }}" class="btn btn-warning btn-sm tooltip" title="Edit"><i class="fas fa-pen fa-fw"></i></a>
                    <a href="{{ route('invoice_show', $pasien->id) }}" class="btn btn-primary btn-sm tooltip" title="Detail"><i class="fas fa-info fa-fw"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="block mt-5 text-center">
    <div>Menampilkan <span class="font-medium">{{$invoices->firstItem()}}</span> sampai <span class="font-medium">{{$invoices->lastItem()}}</span> dari <span class="font-medium">{{$invoices->total()}}</span> data.</div>
    <div class="flex mt-5 mb-3">
        @if ($invoices->lastPage() > 1)
        <ul class="pagination ml-auto mr-auto">
            @if($invoices->currentPage() > $invoices->onFirstPage()+2)
            <li><a class="pagination__link tooltip" href="{{$invoices->url($invoices->onFirstPage())}}" title="Halaman Awal"><i class="fas fa-chevron-double-left"></i></a></li>
            @endif
            @if($invoices->currentPage() > $invoices->onFirstPage())
            <li><a class="pagination__link tooltip" href="{{$invoices->previousPageUrl()}}" title="Halaman Sebelumnya"><i class="fas fa-chevron-left"></i></a></li>
            @endif
            @for ($i = 1; $i <= $invoices->lastPage(); $i++)
                <?php
                $half_total_links = floor(7/2);
                $from = $invoices->currentPage() - $half_total_links;
                $to = $invoices->currentPage() + $half_total_links;
                if ($invoices->currentPage() < $half_total_links) {
                   $to += $half_total_links - $invoices->currentPage();
                }
                if ($invoices->lastPage() - $invoices->currentPage() < $half_total_links) {
                    $from -= $half_total_links - ($invoices->lastPage() - $invoices->currentPage()) - 1;
                }
                ?>
                @if ($from < $i && $i < $to)
                    <li><a href="{{ $invoices->url($i) }}" class="pagination__link @if(($invoices->currentPage() == $i)) pagination__link--active tooltip @endif" @if($invoices->currentPage() == $i)) title="Halaman Sekarang" @endif>{{ $i }}</a></li>
                @endif
            @endfor
            @if($invoices->currentPage() < $invoices->lastPage())
            <li><a class="pagination__link tooltip" href="{{$invoices->nextPageUrl()}}" title="Halaman Selanjutnya"><i class="fas fa-chevron-right"></i></a></li>
            @endif
            @if($invoices->currentPage() < $invoices->lastPage()-1)
            <li><a class="pagination__link tooltip" href="{{$invoices->url($invoices->lastPage())}}" title="Halaman Terakhir"><i class="fas fa-chevron-double-right"></i></a></li>
            @endif
        </ul>
        @endif
    </div>
</div>
@endsection
