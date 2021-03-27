<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
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
            $invoices = Invoice::where('invoice','LIKE','%'.$request->cari.'%')
                                ->orwhere('code','LIKE','%'.$request->cari.'%')
                                ->orwhere('total','LIKE','%'.$request->cari.'%')
                                ->orwhere('payment_method','LIKE','%'.$request->cari.'%')
                                ->orwhere('status','LIKE','%'.$request->cari.'%')
                            ->orderBy($sortby, $orderby)
                            ->paginate($page);
        }
        else
        {
            $invoices = Invoice::orderBy($sortby, $orderby)->paginate($page);
        }

        return view('kasir.index', [
            'pagetitle' => 'Data Invoice',
            'pagedesc' => 'Menampilkan seluruh data invoice',
            'pageid' => 'datainvoice',
            'invoices' => $invoices,
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Invoice $invoice)
    {
        return view('kasir.show', [
            'pagetitle' => '',
            'pagedesc' => '',
            'pageid' => 'datainvoice',
            'invoice' => $invoice,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
