<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Consultation;
use App\Models\Invoice;
use App\Models\Medicine;
use App\Models\Resep;
use App\Models\Transaction;

use Illuminate\Http\Request;

use RealRashid\SweetAlert\Facades\Alert;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class ResepController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('sortby') && $request->has('orderby'))
        {
            $sortby = $request->sorby;
            $orderby = $request->orderby;
        }
        else
        {
            $sortby = 'code';
            $orderby = 'asc';
        }

        $reseps = Consultation::where('resep', 'Sedang')->select('id','code','norm','nama')->orderBy($sortby, $orderby)->get();

        $antrian = Antrian::orderBy('antrian', 'desc')->where('jenis', 'Apotek')->where('status', 'Sedang')->select('norm','nama')->first();
        if (!empty($antrian)) {
            $showID = Consultation::where('resep', 'Sedang')->where('norm', $antrian->norm)->select('id')->first();
            $reseping = '<a href="'. route('resep_show', $showID->id) .'" class="btn btn-primary"><i class="fas fa-eye mr-2"></i> Sedang Meracik</a>';
        }
        else {
            $reseping = null;
        }

        return view('resep.index', [
            'pagetitle' => 'Data Resep',
            'pagedesc' => 'Menampilkan seluruh data resep',
            'pageid' => 'dataresep',
            'reseps' => $reseps,
            'reseping' => $reseping,
        ]);
    }

    public function update_antrian($antrian)
    {
        $antrean = Antrian::where('antrian', $antrian)->where('status', 'Belum')->first();

        if (!Antrian::where('antrian', $antrian)->exists()) {
            Alert::toast('Antrian tidak tersedia!', 'error');
            return redirect()->route('resep_index');
        }
        else {
            Antrian::where('antrian', $antrian)->update(['status' => 'Sedang']);

            $resep = Consultation::where('norm', $antrean->norm)->where('resep', 'Sedang')->select('id')->first();

            return redirect()->route('resep_show', $resep->id);
        }
    }

    public function show($id)
    {
        if (!is_numeric($id) || Consultation::find($id) === null) {
            Alert::toast('Resep tidak ada!', 'error');
            return redirect()->route('resep_index');
        }

        $consultation = Consultation::where('id', $id)->first();

        if (in_array($consultation->resep, ['Tidak', 'Belum'])) {
            Alert::toast('Resep tidak ada!', 'error');
            return redirect()->route('resep_index');
        }

        if (in_array($consultation->resep, ['Sudah'])) {
            Alert::toast('Resep sudah dibuat!', 'info');
            return redirect()->route('resep_index');
        }

        $reseps = Resep::where('code', $consultation->code)->get();
        $reseps_count = $reseps->count();

        if ($reseps_count > 0) {
            for ($i=0; $i < $reseps_count; $i++) {
                $resep_id[$i] = $reseps[$i]->id;

                if (isset($reseps[$i]->resep)) {
                    $isi_resep[$i] = explode(',', $reseps[$i]->resep);
                }
                else {
                    $isi_resep[$i] = ['','','','',''];
                }
            }
        }
        else {
            $resep_id = null;
            $isi_resep = null;
        }

        return view('resep.show', [
            'pagetitle' => 'Resep Pasien',
            'pagedesc' => $consultation->code . ' - ' . $consultation->norm . ' - ' . $consultation->nama,
            'pageid' => 'dataresep',
            'rmcode' => $consultation->code,
            'resep_id' => $resep_id,
            'isi_resep' => $isi_resep,
            'reseps_count' => $reseps_count,
            'id' => $id,
        ]);
    }

    private function genAntri($code)
    {
        Antrian::where('jenis', 'Apotek')->where('status', 'Sedang')->update(['status' => 'Sudah']);

        $config = [
            'table' => 'antrians',
            'field' => 'antrian',
            'length' => 4,
            'prefix' => 'C',
            'reset_on_prefix_change' => TRUE,
        ];
        $noAntri = IdGenerator::generate($config);

        $consultation = Consultation::where('code', $code)->first();

        Antrian::create([
            'antrian' => $noAntri,
            'jenis' => 'Kasir',
            'norm' => $consultation->norm,
            'nama' => $consultation->nama,
        ]);
    }

    private function invoice($code)
    {
        $config = [
            'table' => 'invoices',
            'field' => 'invoice',
            'length' => 12,
            'prefix' => date('Ymd'),
            'reset_on_prefix_change' => TRUE,
        ];
        $invoice = IdGenerator::generate($config);

        $reseps = Resep::where('code', $code)->where('status', 'Belum')->get();
        $reseps_count = $reseps->count();

        if ($reseps_count > 0) {
            for ($i=0; $i < $reseps_count; $i++) {
                $resep_id[$i] = $reseps[$i]->id;

                if (isset($reseps[$i]->resep)) {
                    $isi_resep[$i] = explode(',', $reseps[$i]->resep);
                }
                else {
                    $isi_resep[$i] = ['','','','',''];
                }
            }
        }
        else {
            $resep_id = null;
            $isi_resep = null;
        }

        for ($i=0; $i < $reseps_count; $i++) {
            $obat = Medicine::where('code', $isi_resep[$i][0])->first();
            Transaction::create([
                'invoice' => $invoice,
                'code' => $code,
                'isibon' => $obat->namaobat,
                'quantity' => $isi_resep[$i][3],
                'harga' => $obat->harga_jual,
                'total' => $obat->harga_jual * $isi_resep[$i][3],
            ]);
        }

        Transaction::create([
            'invoice' => $invoice,
            'code' => $code,
            'isibon' => 'Fee Dokter - ' . config('setting.dokterjaga'),
            'quantity' => 1,
            'harga' => config('setting.fee_dokter'),
            'total' => config('setting.fee_dokter'),
        ]);

        Invoice::create([
            'invoice' => $invoice,
            'code' => $code,
            'total' => Transaction::where('invoice', $invoice)->sum('total'),
            'status' => 'Belum Bayar'
        ]);
    }

    public function resep_confirm($id)
    {
        $code = preg_replace("/[^A-Z0-9]+/", "", $id);

        if (!Consultation::where('code', $code)->where('resep','Sedang')->exists()) {
            Alert::toast('Error, silahkan periksa kembali!', 'error');
            return redirect()->route('resep_index');
        }

        if (Resep::where('code', $code)->where('status', 'Belum')->exists()) {
            $this->invoice($code);
            $this->genAntri($code);
            Consultation::where('code', $code)->where('resep', 'Sedang')->update(['resep' => 'Sudah']);
            Resep::where('code', $code)->where('status', 'Belum')->update(['status' => 'Sudah']);

            Alert::toast('Resep berhasil dibuat!', 'success');
            return redirect()->route('resep_index');
        }
        else {
            Alert::toast('Resep tidak ada!', 'error');
            return redirect()->route('resep_index');
        }
    }

    public function get_error()
    {
        Alert::toast('Error, silahkan periksa kembali!', 'error');
        return redirect()->route('resep_index');
    }
}
