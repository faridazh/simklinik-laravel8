<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Invoice;
use App\Models\Pasien;
use App\Models\Transaction;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;

use RealRashid\SweetAlert\Facades\Alert;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $page = 25;

        if($request->has('sortby') && $request->has('orderby'))
        {
            $sortby = $request->sorby;
            $orderby = $request->orderby;
        }
        else
        {
            $sortby = 'invoice';
            $orderby = 'asc';
        }

        if ($request->has('cari'))
        {
            $invoices = Invoice::where('status', 'Lunas')
                                ->where('invoice','LIKE','%'.$request->cari.'%')
                                ->orwhere('code','LIKE','%'.$request->cari.'%')
                                ->orwhere('total','LIKE','%'.$request->cari.'%')
                                ->orwhere('payment_method','LIKE','%'.$request->cari.'%')
                                ->orwhere('status','LIKE','%'.$request->cari.'%')
                            ->orderBy($sortby, $orderby)->paginate($page);
        }
        else
        {
            $invoices = Invoice::where('status', 'Lunas')->orderBy($sortby, $orderby)->paginate($page);
        }

        return view('kasir.index', [
            'pagetitle' => 'Data Invoice',
            'pagedesc' => 'Menampilkan seluruh data invoice',
            'pageid' => 'datainvoice',
            'invoices' => $invoices,
            'belumBayar' => Invoice::where('status', 'Belum Bayar')->where('payment_method', '!=', 'Hutang')->orderBy('invoice', 'asc')->get(),
            'Hutang' => Invoice::where('status', 'Belum Bayar')->where('payment_method', '=', 'Hutang')->orderBy('invoice', 'asc')->get(),
        ]);
    }

    public function create()
    {
        return view('kasir.create', [
            'pagetitle' => 'Invoice Baru',
            'pagedesc' => 'Membuat invoice baru',
            'pageid' => 'datainvoice',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([

        ]);

        Alert::toast('Pembayaran berhasil!', 'success');
        return redirect()->route('invoice_show', $invoice->id);
    }

    public function show(Invoice $invoice)
    {
        if ($invoice->status != 'Lunas') {
            Alert::toast('Resi belum terbayar!', 'error');
            return redirect()->route('invoice_pay', $invoice->id);
        }

        $client = Consultation::where('code', $invoice->code)->select('norm')->first();

        return view('kasir.show', [
            'pagetitle' => 'Invoice',
            'pagedesc' => null,
            'pageid' => 'datainvoice',
            'invoice' => $invoice,
            'client' => Pasien::where('norm', $client->norm)->first(),
            'transaction' => Transaction::where('invoice', $invoice->invoice)->get(),
        ]);
    }

    public function pay(Invoice $invoice)
    {
        if ($invoice->status == 'Lunas') {
            Alert::toast('Resi sudah terbayar!', 'error');
            return redirect()->route('invoice_show', $invoice->id);
        }

        $client = Consultation::where('code', $invoice->code)->select('norm')->first();

        return view('kasir.bayar', [
            'pagetitle' => 'Invoice',
            'pagedesc' => null,
            'pageid' => 'datainvoice',
            'invoice' => $invoice,
            'client' => Pasien::where('norm', $client->norm)->first(),
            'transaction' => Transaction::where('invoice', $invoice->invoice)->get(),
        ]);
    }

    public function pay_process(Request $request, Invoice $invoice)
    {
        $request->validate([
            'payment_method' => 'required|in:Tunai,Transfer Bank,Kredit/Debit,Dana,OVO,GoPay,Hutang',
        ]);

        if ($request->payment_method == 'Hutang') {
            $status_pay = 'Belum Bayar';
        }
        else {
            $status_pay = 'Lunas';
        }

        Invoice::where('invoice', $invoice->invoice)->update([
            'payment_method' => $request->payment_method,
            'status' => $status_pay,
        ]);

        if ($request->payment_method != 'Hutang') {
            Alert::toast('Pembayaran berhasil!', 'success');
            return redirect()->route('invoice_show', $invoice->id);
        }
        else {
            Alert::toast('Resi berhasil masuk daftar hutang!', 'success');
            return redirect()->route('invoice_index');
        }
    }

    public function beliobat()
    {
        return view('kasir.obat', [
            'pagetitle' => 'Beli Obat',
            'pagedesc' => null,
            'pageid' => 'beliobat',
        ]);
    }

    public function beliobat_store()
    {

    }

    // public function edit($id)
    // {
    //     //
    // }
    //
    // public function update(Request $request, $id)
    // {
    //     //
    // }
    //
    // public function destroy($id)
    // {
    //     //
    // }

    public function get_error()
    {
        Alert::toast('Error, silahkan periksa kembali!', 'error');
        return redirect()->route('invoice_index');
    }
}
