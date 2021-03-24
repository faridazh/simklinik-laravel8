<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Resep;

use Illuminate\Http\Request;

use RealRashid\SweetAlert\Facades\Alert;

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

        $reseps = Consultation::where('resep', 'Sedang')->select('id','code','norm','nama')
                        ->orderBy($sortby, $orderby)->get();

        return view('resep.index', [
            'pagetitle' => 'Data Resep',
            'pagedesc' => 'Menampilkan seluruh data resep',
            'pageid' => 'dataresep',
            'reseps' => $reseps,
        ]);
    }

    public function show($id)
    {
        if (Consultation::find($id) === null) {
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
            Consultation::where('code', $code)
                            ->where('resep', 'Sedang')
                            ->update([
                                'resep' => 'Sudah'
                            ]);

            Resep::where('code', $code)
                    ->where('status', 'Belum')
                    ->update([
                        'status' => 'Sudah'
                    ]);

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
