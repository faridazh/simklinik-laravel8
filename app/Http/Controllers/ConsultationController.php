<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Consultation;
use App\Models\Disease;
use App\Models\Medicine;
use App\Models\Pasien;
use App\Models\Resep;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;

use RealRashid\SweetAlert\Facades\Alert;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class ConsultationController extends Controller
{
    public function index(Request $request)
    {
        Paginator::useBootstrap();

        $page = 25;

        if($request->has('sortby') && $request->has('orderby'))
        {
            $sortby = $request->sorby;
            $orderby = $request->orderby;
        }
        else
        {
            $sortby = 'id';
            $orderby = 'desc';
        }

        if ($request->has('cari')) {
            $consultations = Consultation::select('id', 'norm', 'nama', 'tanggal', 'diagnosa', 'resep')
                                ->where('norm','LIKE','%'.$request->cari.'%')
                                ->orwhere('nama','LIKE','%'.$request->cari.'%')
                                ->orwhere('diagnosa','LIKE','%'.$request->cari.'%')
                                ->orwhere('diagnosalain','LIKE','%'.$request->cari.'%')
                                ->orwhere('anamnesis','LIKE','%'.$request->cari.'%')
                                ->orwhere('tindakan','LIKE','%'.$request->cari.'%')
                                ->orderBy($sortby, $orderby)
                                ->paginate($page);
        }
        else {
            $consultations = Consultation::select('id', 'norm', 'nama', 'tanggal', 'diagnosa', 'resep')
                                ->orderBy($sortby, $orderby)
                                ->paginate($page);
        }

        $antrian = Antrian::orderBy('antrian', 'desc')->where('jenis', 'Dokter')->where('status', 'Sedang')->select('norm','nama')->first();
        if (!empty($antrian)) {
            $consulting = '<a href="'. route('konsultasi_create') .'" class="btn btn-primary"><i class="fas fa-eye mr-2"></i> Konsultasi Sekarang</a>';
        }
        else {
            $consulting = '';
        }

        return view('konsultasi.index', [
            'pagetitle' => 'Daftar Rekam Medis',
            'pagedesc' => 'Menampilkan seluruh data rekam medis',
            'pageid' => 'datamedis',
            'consultations' => $consultations,
            'consulting' => $consulting,
        ]);
    }

    public function update_antrian($antrian)
    {
        if (!Antrian::where('antrian', $antrian)->exists()) {
            Alert::toast('Antrian tidak tersedia!', 'error');
            return redirect()->route('konsultasi_index');
        }
        else {
            Antrian::where('antrian', $antrian)->update(['status' => 'Sedang']);
            return redirect()->route('konsultasi_create');
        }
    }

    public function create()
    {
        $antrian = Antrian::orderBy('antrian', 'desc')->where('jenis', 'Dokter')->where('status', 'Sedang')->select('norm','nama')->first();

        if (empty($antrian)) {
            $antrian = Antrian::orderBy('antrian', 'asc')->where('jenis', 'Dokter')->where('status', 'Belum')->select('norm','nama')->first();
        }

        if (empty($antrian)) {
            Alert::toast('Anda melakukan konsultasi baru!', 'info');
        }
        // else {
        //     Alert::toast('Anda sedang melanjutkan konsultasi!', 'info');
        // }

        if (isset($antrian)) {
            $pasien = Pasien::where('norm', $antrian->norm)->select('rmringan')->first();
            if ($pasien->rmringan === null) {
                $rmringan = ['','','','',''];
            }
            else {
                $rmringan = explode(',', $pasien->rmringan);
            }
        }
        else {
            // $rmringan = ['','','','',''];
            Alert::toast('Tidak ada pasien dalam antrian!', 'error');
            return redirect()->route('konsultasi_index');
        }

        return view('konsultasi.create', [
            'pagetitle' => 'Rekam Medis Baru',
            'pagedesc' => '',
            'pageid' => 'datamedis',
            'antrian' => $antrian,
            'rmringan' => $rmringan,
        ]);
    }

    protected function genRMcode()
    {
        $config = [
            'table' => 'consultations',
            'field' => 'code',
            'length' => 6,
            'prefix' => 'RM'
        ];

        return $coderm = IdGenerator::generate($config);
    }

    public function store(Request $request)
    {
        $request->validate([
            'norm' => 'required|exists:pasiens,norm',
            'nama' => 'required|exists:pasiens,nama',

            'diagnosa' => 'required|string',
            'diagnosalain' => 'nullable|string',
            'anamnesis' => 'required|string',
            'tindakan' => 'required|string',

            'berat' => 'nullable|numeric|digits_between:1,3',
            'tinggi' => 'nullable|numeric|digits_between:1,3',
            'tensi_sistol' => 'nullable|numeric|digits_between:1,3',
            'tensi_diastol' => 'nullable|numeric|digits_between:1,3',
            'tensi_pulse' => 'nullable|numeric|digits_between:1,3',

            'resep' => 'required|in:Tidak,Belum',
        ]);

        $antrian = Antrian::orderBy('antrian', 'asc')->where('norm', $request->norm)->where('deleted_at', null);

        if ($antrian->count() == 1) {
            $antrian->update(['status' => 'Sudah']);
        }
        else {
            Alert::toast('Error, silahkan periksa kembali!', 'error');
            return redirect()->route('konsultasi_create');
        }

        Pasien::where('norm', $antrian->first()->norm)->update([
            'rmringan' => strval($request->berat . ',' . $request->tinggi . ',' . $request->tensi_sistol . ',' . $request->tensi_diastol . ',' . $request->tensi_pulse),
        ]);

        $coderm = $this->genRMcode();

        Consultation::create([
            'code' => $coderm,
            'norm' => $request->norm,
            'nama' => $request->nama,
            'tanggal' => date('Y-m-d'),
            'anamnesis' => $request->anamnesis,
            'diagnosa' => $request->diagnosa,
            'tindakan' => $request->tindakan,
            'resep' => $request->resep,
        ]);

        Antrian::destroy($antrian->first()->id);

        $rm = Consultation::where('code', $coderm)->select('id')->first();

        if ($request->resep == 'Belum') {
            Alert::toast('Silahkan tulis resep untuk pasien!', 'info');
            return redirect()->route('konsultasi_resep', $rm->id);
        }

        Alert::toast('Rekam medis berhasil ditambahkan!', 'success');
        return redirect()->route('konsultasi_index');
    }

    public function resep($id)
    {
        if (!is_numeric($id) || Consultation::where('resep', 'Belum')->find($id) === null) {
            Alert::toast('Rekam medis tidak ada!', 'error');
            return redirect()->route('konsultasi_index');
        }

        $consultation = Consultation::where('id', $id)->first();

        if (in_array($consultation->resep, ['Tidak', 'Sedang', 'Sudah'])) {
            Alert::toast('Resep sudah dibuat!', 'error');
            return redirect()->route('konsultasi_index');
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

        return view('konsultasi.resep', [
            'pagetitle' => 'Resep Pasien',
            'pagedesc' => $consultation->code . ' - ' . $consultation->norm . ' - ' . $consultation->nama,
            'pageid' => 'datamedis',
            'consultation' => $consultation,
            'id' => $id,
            'resep_id' => $resep_id,
            'isi_resep' => $isi_resep,
            'reseps_count' => $reseps_count,
        ]);
    }

    public function resep_store($id, Request $request){
        if (!is_numeric($id) || Consultation::where('resep', 'Belum')->find($id) === null) {
            Alert::toast('Error, silahkan periksa kembali!', 'error');
            return redirect()->route('konsultasi_index');
        }

        $request->validate([
            'code' => 'required|exists:consultations,code',
            'norm' => 'required|exists:pasiens,norm',
            'nama' => 'required|exists:pasiens,nama',
            'namaobat' => 'required|string',
        ]);

        $find_similar = Resep::where([
            ['resep', 'LIKE', '%'.$request->namaobat.'%'],
            ['code', $request->code],
        ])->first();

        if (isset($find_similar)) {
            $resepobat = explode(',', $find_similar->resep);
            $p_one = $resepobat[3] + 1;
            $resep = $resepobat[0] . ',' . $resepobat[1] . ',' . $resepobat[2] . ',' . $p_one . ',' . $resepobat[4];

            $obat = Medicine::where('namaobat', $request->namaobat)->first();

            Resep::where('id', $find_similar->id)
                    ->update([
                        'resep' => $resep,
                    ]);
        }
        else {
            $obat = Medicine::where('namaobat', $request->namaobat)->first();

            if (isset($obat)) {
                $resep = $obat->code . ',' . $obat->namaobat . ',' . $obat->isiobat . ',' . '1' . ',' . $obat->jenis;
            }
            else {
                Alert::toast('Obat tidak tersedia!', 'error');
                return redirect()->route('konsultasi_resep', $id);
            }

            Resep::create([
                'code' => $request->code,
                'norm' => $request->norm,
                'nama' => $request->nama,
                'resep' => $resep,
            ]);
        }

        Medicine::where('code', $obat->code)
                    ->update([
                        'stok' => $obat->stok - 1,
                    ]);

        Alert::toast('Obat berhasil ditambahkan ke resep!', 'success');
        return redirect()->route('konsultasi_resep', $id);
    }

    public function resep_save(Request $request)
    {
        if (!is_numeric($request->id) || Resep::find($request->id) === null) {
            Alert::toast('Error, silahkan periksa kembali!', 'error');
            return redirect()->route('konsultasi_index');
        }

        $request->validate([
            'id' => 'required|exists:reseps,id',
            'jumlah' => 'required|numeric|max:999999999',
        ]);

        if ($request->jumlah <= 0) {
            Alert::toast('Error, silahkan masukan jumlah!', 'error');
            return back();
        }

        $reseps = Resep::where('id', $request->id)->select('id','resep')->first();
        $resepobat = explode(',', $reseps->resep);

        $medicine = Medicine::where('code', $resepobat[0])->select('stok')->first();

        $jumlah = $request->jumlah - $resepobat[3];

        if ($request->jumlah == $resepobat[3]) {
            $stok = $medicine->stok;
        }
        elseif ($request->jumlah < $resepobat[3]) {
            $stok = $medicine->stok + ($resepobat[3] - $request->jumlah);
        }
        elseif ($request->jumlah > $resepobat[3] && $jumlah <= $medicine->stok) {
            $stok = $medicine->stok - ($request->jumlah - $resepobat[3]);
        }
        elseif ($jumlah > $medicine->stok) {
            Alert::toast('Stok tersedia: ' . $medicine->stok . ' ' . $resepobat[4], 'error');
            return back();
        }

        // code,namaobat,isiobat,jumlah,jenis
        $obats = $resepobat[0] . ',' . $resepobat[1] . ',' . $resepobat[2] . ',' . $request->jumlah . ',' . $resepobat[4];

        Medicine::where('code', $resepobat[0])
                    ->update([
                        'stok' => $stok,
                    ]);

        Resep::where('id', $request->id)
                ->update([
                    'resep' => $obats,
                ]);

        Alert::toast('Obat berhasil diperbarui dari resep!', 'success');
        return back();
    }

    public function resep_delete(Request $request)
    {
        if (!is_numeric($request->id) || Resep::find($request->id) === null) {
            Alert::toast('Error, silahkan periksa kembali!', 'error');
            return redirect()->route('konsultasi_index');
        }

        $request->validate([
            'id' => 'required|exists:reseps,id',
        ]);

        $reseps = Resep::where('id', $request->id)->select('id','resep')->first();
        $resepobat = explode(',', $reseps->resep);

        $medicine = Medicine::where('code', $resepobat[0])->select('stok')->first();

        Medicine::where('code', $resepobat[0])
                    ->update([
                        'stok' => $medicine->stok + $resepobat[3],
                    ]);

        Resep::destroy($request->id);

        Alert::toast('Obat berhasil dihapus dari resep!', 'success');
        return back();
    }

    public function resep_confirm($id)
    {
        if (!is_numeric($id) || Consultation::find($id) === null) {
            Alert::toast('Error, silahkan periksa kembali!', 'error');
            return redirect()->route('konsultasi_index');
        }

        Consultation::where('id', $id)
                        ->update([
                            'resep' => 'Sedang',
                        ]);

        Alert::toast('Resep berhasil dibuat!', 'success');
        return redirect()->route('konsultasi_index');
    }

    public function show(Request $request, $id)
    {
        if (!is_numeric($id) || Consultation::find($id) === null) {
            Alert::toast('Error, silahkan periksa kembali!', 'error');
            return redirect()->route('konsultasi_index');
        }

        $consultation = Consultation::where('id', $id)->first();

        $pasien = Pasien::where('norm', $consultation->norm)->select('rmringan')->first();

        if ($pasien === null) {
            Alert::toast('Error, silahkan periksa kembali!', 'error');
            return redirect()->route('konsultasi_index');
        }

        if (empty($pasien->rmringan)) {
            $rmringan = ['','','','',''];
        }
        else {
            $rmringan = explode(',', $pasien->rmringan);
        }

        return view('konsultasi.show', [
            'pagetitle' => 'Rekam Medis',
            'pagedesc' => $consultation->code . ' - ' . $consultation->norm . ' - ' . $consultation->nama,
            'pageid' => 'datamedis',
            'consultation' => $consultation,
            'rmringan' => $rmringan,
        ]);
    }

    // Cari Penyakit - Ajax Search (Jquery 3.6.0)
    public function caripenyakit(Request $request)
    {
        if ($request->has('disease')) {
            if($request->ajax()) {
                $output = null;
                $diseases = Disease::where('namaindo','LIKE','%'.$request->disease.'%')
                                        ->orwhere('namainggris','LIKE','%'.$request->disease.'%')
                                        ->orwhere('keterangan','LIKE','%'.$request->disease.'%')
                                        ->orderBy('namaindo', 'asc')->limit(25)->get();
                if(isset($diseases)) {
                    foreach ($diseases as $key => $disease) {
                        $output.='<option value="'. $disease->namaindo .'">';
                    }
                    return Response($output);
                }
            }
        }
    }

    // Cari Obat - Ajax Search (Jquery 3.6.0)
    public function cariobat(Request $request)
    {
        if ($request->has('cari')) {
            if($request->ajax()) {
                $output = null;
                $items = Medicine::where([
                    ['namaobat','LIKE','%'.$request->cari.'%'],
                    ['stok', '>', 0]
                ])
                ->orwhere([
                    ['isiobat','LIKE','%'.$request->cari.'%'],
                    ['stok', '>', 0]
                ])
                ->limit(25)->get();

                if(isset($items)) {
                    foreach ($items as $key => $item) {
                        $output.='<option value="'. $item->namaobat .'">';
                    }
                    return Response($output);
                }
            }
        }
    }

    public function listrm(Request $request)
    {
        if (!$request->has('rm')) {
            Alert::toast('Error, silahkan periksa kembali!', 'error');
            return redirect()->route('konsultasi_index');
        }

        if (!Pasien::where('norm', $request->rm)->exists()) {
            Alert::toast('Error, silahkan periksa kembali!', 'error');
            return redirect()->route('konsultasi_index');
        }

        $pasien = Pasien::where('norm', $request->rm)->select('id')->first();
        $pasien_data = '<a href="'. route('pasien_show', $pasien->id) .'" target="_blank" class="text-decoration-none">Data Pasien</a>';

        $consultations = Consultation::where('norm', $request->rm)->orderBy('created_at', 'desc')->get();

        return view('konsultasi.listrm', [
            'pagetitle' => 'Rekam Medis',
            'pagedesc' => $consultations[0]->norm . ' - ' . $consultations[0]->nama . ' - ' . $pasien_data,
            'pageid' => 'datamedis',
            'consultations' => $consultations,
        ]);
    }

    public function show_resep($id)
    {
        if (!is_numeric($id) || Consultation::find($id) === null) {
            Alert::toast('Error, silahkan periksa kembali!', 'error');
            return redirect()->route('konsultasi_index');
        }

        $consultation = Consultation::where('id', $id)->first();

        if (in_array($consultation->resep, ['Tidak', 'Belum'])) {
            Alert::toast('Resep belum dibuat!', 'error');
            return redirect()->route('konsultasi_index');
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

        return view('konsultasi.showresep', [
            'pagetitle' => 'Rekam Medis',
            'pagedesc' => $consultation->code . ' - ' . $consultation->norm . ' - ' . $consultation->nama,
            'pageid' => 'datamedis',
            'id' => $id,
            'consultation' => $consultation,
            'isi_resep' => $isi_resep,
            'reseps_count' => $reseps_count,
        ]);
    }

    public function get_error()
    {
        Alert::toast('Error, silahkan anda periksa kembali!', 'error');
        return redirect()->route('konsultasi_index');
    }
}
