@extends('templates.main')

@section('breadcrumb', Breadcrumbs::render('invoice_pay', $invoice->id))

@section('content')
<div class="intro-y box mt-5">
    <div class="flex border-b px-5 sm:px-20 pt-10 pb-10 sm:pb-20 items-start">
        <div>
            <div class="text-base text-gray-600">Pasien</div>
            <div class="text-lg font-medium text-theme-1 dark:text-theme-10 mt-2">#{{ $client->norm }}</div>
            <div class="mt-1">{{ $client->nama }}</div>
            <div class="mt-1">{{ $client->alamat }}</div>
        </div>
        <div class="ml-auto text-right">
            <div class="text-base text-gray-600">No. Resi</div>
            <div class="text-lg text-theme-1 dark:text-theme-10 font-medium mt-2">#{{ $invoice->invoice }}</div>
            <div class="mt-1">{{ date('j M, Y', strtotime($invoice->created_at)) }}</div>
        </div>
    </div>
    <div class="px-5 sm:px-16 py-10 sm:py-20">
        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">DESKRIPSI</th>
                        <th class="border-b-2 dark:border-dark-5 text-right whitespace-nowrap">QTY</th>
                        <th class="border-b-2 dark:border-dark-5 text-right whitespace-nowrap">HARGA</th>
                        <th class="border-b-2 dark:border-dark-5 text-right whitespace-nowrap">TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < $transaction->count(); $i++)
                    <tr>
                        <td class="border-b dark:border-dark-5">
                            <div class="font-medium whitespace-nowrap">{{ $transaction[$i]->isibon }}</div>
                            <div class="text-gray-600 text-xs whitespace-nowrap">Regular License</div>
                        </td>
                        <td class="text-right border-b dark:border-dark-5 w-32">{{ number_format($transaction[$i]->quantity) }}</td>
                        <td class="text-right border-b dark:border-dark-5 w-32">{{ config('setting.currency') . number_format($transaction[$i]->harga) }}</td>
                        <td class="text-right border-b dark:border-dark-5 w-32 font-medium">{{ config('setting.currency') . ' ' . number_format($transaction[$i]->total) }}</td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
    <div class="px-5 sm:px-20 pb-10 sm:pb-20 flex flex-col sm:flex-row">
        <div class="text-center sm:text-left">
            <div class="text-base text-gray-600">Total Bayar</div>
            <div class="text-xl text-theme-1 dark:text-theme-10 font-medium mt-2">{{ config('setting.currency') . number_format($invoice->total) }}</div>
        </div>
        <form class="text-center sm:text-right sm:ml-auto mt-10 sm:mt-0 flex justify-end items-end w-full sm:w-72" action="{{ route('invoice_pay_process', $invoice->id) }}" method="post">
            @csrf
            @method('patch')
            <select id="inputMethod" class="tail-select z-50" name="payment_method">
                <option value="Tunai">Tunai</option>
                <option value="Kredit/Debit">Kredit/Debit</option>
                <option value="Transfer Bank">Transfer Bank</option>
                <option value="Dana">Dana</option>
                <option value="OVO">OVO</option>
                <option value="GoPay">GoPay</option>
                <option value="Hutang">Hutang</option>
            </select>
            <button type="submit" class="btn btn-primary ml-2"><i class="far fa-cash-register mr-2"></i> Bayar</button>
        </form>
    </div>
</div>
@endsection
