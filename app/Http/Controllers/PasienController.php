<?php

namespace App\Http\Controllers;

use App\Models\Pasien;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;

use RealRashid\SweetAlert\Facades\Alert;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class PasienController extends Controller
{
    protected function RMPrefix($namapasien)
    {
        $firstchar = Str::upper($namapasien[0]);
        $alphabet = range('A', 'Z');

        $prefix = array_search($firstchar, $alphabet) + 1;

        if (Str::length($prefix) == 1) {
            $prefix = strval('0' . $prefix);
        }
        else {
            $prefix = strval($prefix);
        }

        return $prefix;
    }

    protected function getAge($date)
    {
        return intval(date('Y', time() - strtotime($date))) - 1970;
    }

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
            $sortby = 'norm';
            $orderby = 'asc';
        }

        if ($request->has('cari'))
        {
            $pasiens = Pasien::select('id','norm','nama','headfamily','alamat')
                                ->where('norm','LIKE','%'.$request->cari.'%')
                                ->orwhere('nama','LIKE','%'.$request->cari.'%')
                                ->orwhere('headfamily','LIKE','%'.$request->cari.'%')
                                ->orwhere('alamat','LIKE','%'.$request->cari.'%')
                                ->orwhere('telepon','LIKE','%'.$request->cari.'%')
                                ->orwhere('bpjs','LIKE','%'.$request->cari.'%')
                            ->orderBy($sortby, $orderby)
                            ->paginate($page);
        }
        else
        {
            $pasiens = Pasien::select('id','norm','nama','headfamily','alamat')
                            ->orderBy($sortby, $orderby)
                            ->paginate($page);
        }

        return view('pasien.index', [
            'pagetitle' => 'Data Pasien',
            'pagedesc' => 'Menampilkan seluruh data pasien',
            'pageid' => 'datapasien',
            'pasiens' => $pasiens,
        ]);
    }

    public function create()
    {
        return view('pasien.create', [
            'pagetitle' => 'Pasien Baru',
            'pagedesc' => 'Menambahkan data pasien baru',
            'pageid' => 'datapasien',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:150',
            'kelamin' => 'required|in:Laki-laki,Perempuan',
            'headfamily' => 'required|string|max:150',
            'hubfamily' => 'required|string|max:255',
            'agama' => 'required|in:Islam,Protestantisme,Katolisisme,Hinduisme,Buddhisme,Konghucu,Tidak Beragama',
            'tempatlahir' => 'required|string|max:30',
            'datelahir' => 'required|date',
            'alamat' => 'required|string|max:500',
            'alamat_rt' => 'nullable|numeric|digits_between:1,3',
            'alamat_rw' => 'nullable|numeric|digits_between:1,3',
            'alamat_no' => 'nullable|numeric|digits_between:1,3',
            'telepon' => 'nullable|numeric|digits_between:10,15',
            'bpjs' => 'nullable|numeric|digits:13',
            'statusnikah' => 'required|in:Sudah Menikah,Belum Menikah',
            'pendidikan' => 'required|in:SD,SMP,SMA,Diploma,Sarjana,Tidak Sekolah',
            'pekerjaan' => 'required|string|max:50',

            'berat' => 'nullable|numeric|digits_between:1,3',
            'tinggi' => 'nullable|numeric|digits_between:1,3',
            'tensi_sistol' => 'nullable|numeric|digits_between:1,3',
            'tensi_diastol' => 'nullable|numeric|digits_between:1,3',
            'tensi_pulse' => 'nullable|numeric|digits_between:1,3',

            'alergi' => 'nullable|string|max:1000',
            'penyakitskrg' => 'nullable|string|max:1000',
            'penyakitfamily' => 'nullable|string|max:1000',

            'imunisasi_bcg' => 'nullable|numeric|digits_between:1,3',
            'imunisasi_polio' => 'nullable|numeric|digits_between:1,3',
            'imunisasi_hepatitis' => 'nullable|numeric|digits_between:1,3',
            'imunisasi_dpt' => 'nullable|numeric|digits_between:1,3',
            'imunisasi_campak' => 'nullable|numeric|digits_between:1,3',
            'imunisasi_dt' => 'nullable|numeric|digits_between:1,3',
            'imunisasi_covid19' => 'nullable|numeric|digits_between:1,3',

            'kb_suntik' => 'nullable|numeric|digits:4',
            'kb_implant' => 'nullable|numeric|digits:4',
            'kb_tubektomi' => 'nullable|numeric|digits:4',
            'kb_paritas' => 'nullable|numeric|digits_between:1,3',
            'kb_pil' => 'nullable|numeric|digits:4',
            'kb_akdr' => 'nullable|numeric|digits:4',
            'kb_vasektomi' => 'nullable|numeric|digits:4',
            'kb_abortus' => 'nullable|numeric|digits_between:1,3',

            'kb_operasi' => 'nullable|string|max:1000',

            'riwayatrawat_tempat' => 'nullable|string|max:150',
            'riwayatrawat_date' => 'nullable|date',
            'riwayatrawat_alasan' => 'nullable|string|max:500',

            'riwayatoperasi_tempat' => 'nullable|string|max:150',
            'riwayatoperasi_date' => 'nullable|date',
            'riwayatoperasi_alasan' => 'nullable|string|max:500',
        ]);

        //Generate No.RM
        $config = [
            'table' => 'pasiens',
            'field' => 'norm',
            'length' => 6,
            'prefix' => $this->RMPrefix($request->nama),
        ];

        $norm = IdGenerator::generate($config);

        if (isset($request->alamat_rt)) {
            $alamat_rt = ' RT.' . $request->alamat_rt;
        }
        else {
            $alamat_rt = null;
        }

        if (isset($request->alamat_rw)) {
            $alamat_rw = ' RW.' . $request->alamat_rw;
        }
        else {
            $alamat_rw = null;
        }

        if (isset($request->alamat_no)) {
            $alamat_no = ' No.' . $request->alamat_no;
        }
        else {
            $alamat_no = null;
        }

        $alamat = $request->alamat . $alamat_rt . $alamat_rw . $alamat_no;

        if (isset($request->berat) || isset($request->tinggi) || isset($request->tensi_sistol) || isset($request->tensi_diastol) || isset($request->tensi_pulse)) {
            $rmringan = strval($request->berat . ',' . $request->tinggi . ',' . $request->tensi_sistol . ',' . $request->tensi_diastol . ',' . $request->tensi_pulse);
        }
        else {
            $rmringan = null;
        }

        if (isset($request->imunisasi_bcg) || isset($request->imunisasi_polio) || isset($request->imunisasi_hepatitis) ||
            isset($request->imunisasi_dpt) || isset($request->imunisasi_campak) || isset($request->imunisasi_dt) || isset($request->imunisasi_covid19)) {
            $imunisasi = $request->imunisasi_bcg . ',' .
                                $request->imunisasi_polio . ',' .
                                $request->imunisasi_hepatitis . ',' .
                                $request->imunisasi_dpt . ',' .
                                $request->imunisasi_campak . ',' .
                                $request->imunisasi_dt . ',' .
                                $request->imunisasi_covid19;
        }
        else {
            $imunisasi = null;
        }

        if (isset($request->kb_suntik) || isset($request->kb_implant) || isset($request->kb_tubektomi) || isset($request->kb_paritas) ||
            isset($request->kb_pil) || isset($request->kb_akdr) || isset($request->kb_vasektomi) || isset($request->kb_abortus)) {
            $kb_riwayat = $request->kb_suntik . ',' .
                                $request->kb_implant . ',' .
                                $request->kb_tubektomi . ',' .
                                $request->kb_paritas . ',' .
                                $request->kb_pil . ',' .
                                $request->kb_akdr . ',' .
                                $request->kb_vasektomi . ',' .
                                $request->kb_abortus;
        }
        else {
            $kb_riwayat = null;
        }

        if (isset($request->riwayatrawat_tempat) || isset($request->riwayatrawat_date) || isset($request->riwayatrawat_alasan)) {
            $riwayatrawat = $request->riwayatrawat_tempat . ',' .
                            $request->riwayatrawat_date . ',' .
                            $request->riwayatrawat_alasan;
        }
        else {
            $riwayatrawat = null;
        }

        if (isset($request->riwayatoperasi_tempat) || isset($request->riwayatoperasi_date) || isset($request->riwayatoperasi_alasan)) {
            $riwayatoperasi = $request->riwayatoperasi_tempat . ',' .
                            $request->riwayatoperasi_date . ',' .
                            $request->riwayatoperasi_alasan;
        }
        else {
            $riwayatoperasi = null;
        }

        Pasien::create([
            'norm' => $norm,
            'nama' => $request->nama,
            'kelamin' => $request->kelamin,
            'headfamily' => $request->headfamily,
            'hubfamily' => $request->hubfamily,
            'agama' => $request->agama,
            'tempatlahir' => $request->tempatlahir,
            'datelahir' => $request->datelahir,
            'alamat' => $alamat,
            'telepon' => $request->telepon,
            'bpjs' => $request->bpjs,
            'statusnikah' => $request->statusnikah,
            'pendidikan' => $request->pendidikan,
            'pekerjaan' => $request->pekerjaan,
            'rmringan' => $rmringan,
            'alergi' => $request->alergi,
            'penyakitskrg' => $request->penyakitskrg,
            'penyakitfamily' => $request->penyakitfamily,
            'imunisasi' => $imunisasi,
            'kb_operasi' => $request->kb_operasi,
            'kb_riwayat' => $kb_riwayat,
            'riwayatrawat' => $riwayatrawat,
            'riwayatoperasi' => $riwayatoperasi,
        ]);

        Alert::toast('Data berhasil ditambahkan!', 'success');
        return redirect()->route('pasien_index');
    }

    public function show(Pasien $pasien)
    {
        if (empty($pasien->imunisasi)) {
            $imunisasi = ['','','','','','',''];
        }
        else {
            $imunisasi = explode(',', $pasien->imunisasi);
        }

        if (empty($pasien->kb_riwayat)) {
            $kb_riwayat = ['','','','','','','',''];
        }
        else {
            $kb_riwayat = explode(',', $pasien->kb_riwayat);
        }

        if (empty($pasien->riwayatrawat)) {
            $riwayatrawat = ['','',''];
        }
        else {
            $riwayatrawat = explode(',', $pasien->riwayatrawat);
        }

        if (empty($pasien->riwayatoperasi)) {
            $riwayatoperasi = ['','',''];
        }
        else {
            $riwayatoperasi = explode(',', $pasien->riwayatoperasi);
        }

        if (empty($pasien->rmringan)) {
            $rmringan = ['','','','',''];
        }
        else {
            $rmringan = explode(',', $pasien->rmringan);
        }

        return view('pasien.show', [
            'pagetitle' => 'Data Lengkap Pasien',
            'pagedesc' => 'Menampilkan data pasien secara lengkap',
            'pageid' => 'datapasien',
            'umurDia' => $this->getAge($pasien->datelahir),
            'pasien' => $pasien,
            'rmringan' => $rmringan,
            'imunisasi' => $imunisasi,
            'kb_riwayat' => $kb_riwayat,
            'riwayatrawat' => $riwayatrawat,
            'riwayatoperasi' => $riwayatoperasi,
        ]);
    }

    public function edit(Pasien $pasien)
    {
        if (empty($pasien->imunisasi)) {
            $imunisasi = ['','','','','','',''];
        }
        else {
            $imunisasi = explode(',', $pasien->imunisasi);
        }

        if (empty($pasien->kb_riwayat)) {
            $kb_riwayat = ['','','','','','','',''];
        }
        else {
            $kb_riwayat = explode(',', $pasien->kb_riwayat);
        }

        if (empty($pasien->riwayatrawat)) {
            $riwayatrawat = ['','',''];
        }
        else {
            $riwayatrawat = explode(',', $pasien->riwayatrawat);
        }

        if (empty($pasien->riwayatoperasi)) {
            $riwayatoperasi = ['','',''];
        }
        else {
            $riwayatoperasi = explode(',', $pasien->riwayatoperasi);
        }

        if (empty($pasien->rmringan)) {
            $rmringan = ['','','','',''];
        }
        else {
            $rmringan = explode(',', $pasien->rmringan);
        }

        return view('pasien.edit', [
            'pagetitle' => 'Edit Data Pasien',
            'pagedesc' => 'Mengubah dan memperbarui data pasien',
            'pageid' => 'datapasien',
            'umurDia' => $this->getAge($pasien->datelahir),
            'pasien' => $pasien,
            'rmringan' => $rmringan,
            'imunisasi' => $imunisasi,
            'kb_riwayat' => $kb_riwayat,
            'riwayatrawat' => $riwayatrawat,
            'riwayatoperasi' => $riwayatoperasi,
        ]);
    }

    public function update(Request $request, Pasien $pasien)
    {
        $request->validate([
            'nama' => 'required|string|max:150',
            'kelamin' => 'required|in:Laki-laki,Perempuan',
            'headfamily' => 'required|string|max:150',
            'hubfamily' => 'required|string|max:255',
            'agama' => 'required|in:Islam,Protestantisme,Katolisisme,Hinduisme,Buddhisme,Konghucu,Tidak Beragama',
            'tempatlahir' => 'required|string|max:30',
            'datelahir' => 'required|date',
            'alamat' => 'required|string|max:500',
            'alamat_rt' => 'nullable|numeric|digits_between:1,3',
            'alamat_rw' => 'nullable|numeric|digits_between:1,3',
            'alamat_no' => 'nullable|numeric|digits_between:1,3',
            'telepon' => 'nullable|numeric|digits_between:10,15',
            'bpjs' => 'nullable|numeric|digits:13',
            'statusnikah' => 'required|in:Sudah Menikah,Belum Menikah',
            'pendidikan' => 'required|in:SD,SMP,SMA,Diploma,Sarjana,Tidak Sekolah',
            'pekerjaan' => 'required|string|max:50',

            'berat' => 'nullable|numeric|digits_between:1,3',
            'tinggi' => 'nullable|numeric|digits_between:1,3',
            'tensi_sistol' => 'nullable|numeric|digits_between:1,3',
            'tensi_diastol' => 'nullable|numeric|digits_between:1,3',
            'tensi_pulse' => 'nullable|numeric|digits_between:1,3',

            'alergi' => 'nullable|string|max:1000',
            'penyakitskrg' => 'nullable|string|max:1000',
            'penyakitfamily' => 'nullable|string|max:1000',

            'imunisasi_bcg' => 'nullable|numeric|digits_between:1,3',
            'imunisasi_polio' => 'nullable|numeric|digits_between:1,3',
            'imunisasi_hepatitis' => 'nullable|numeric|digits_between:1,3',
            'imunisasi_dpt' => 'nullable|numeric|digits_between:1,3',
            'imunisasi_campak' => 'nullable|numeric|digits_between:1,3',
            'imunisasi_dt' => 'nullable|numeric|digits_between:1,3',
            'imunisasi_covid19' => 'nullable|numeric|digits_between:1,3',

            'kb_suntik' => 'nullable|numeric|digits:4',
            'kb_implant' => 'nullable|numeric|digits:4',
            'kb_tubektomi' => 'nullable|numeric|digits:4',
            'kb_paritas' => 'nullable|numeric|digits_between:1,3',
            'kb_pil' => 'nullable|numeric|digits:4',
            'kb_akdr' => 'nullable|numeric|digits:4',
            'kb_vasektomi' => 'nullable|numeric|digits:4',
            'kb_abortus' => 'nullable|numeric|digits_between:1,3',

            'kb_operasi' => 'nullable|string|max:1000',

            'riwayatrawat_tempat' => 'nullable|string|max:150',
            'riwayatrawat_date' => 'nullable|date',
            'riwayatrawat_alasan' => 'nullable|string|max:500',

            'riwayatoperasi_tempat' => 'nullable|string|max:150',
            'riwayatoperasi_date' => 'nullable|date',
            'riwayatoperasi_alasan' => 'nullable|string|max:500',
        ]);

        if (isset($request->berat) || isset($request->tinggi) || isset($request->tensi_sistol) || isset($request->tensi_diastol) || isset($request->tensi_pulse)) {
            $rmringan = strval($request->berat . ',' . $request->tinggi . ',' . $request->tensi_sistol . ',' . $request->tensi_diastol . ',' . $request->tensi_pulse);
        }
        else {
            $rmringan = null;
        }

        if (isset($request->imunisasi_bcg) || isset($request->imunisasi_polio) || isset($request->imunisasi_hepatitis) ||
            isset($request->imunisasi_dpt) || isset($request->imunisasi_campak) || isset($request->imunisasi_dt) || isset($request->imunisasi_covid19)) {
            $imunisasi = $request->imunisasi_bcg . ',' .
                                $request->imunisasi_polio . ',' .
                                $request->imunisasi_hepatitis . ',' .
                                $request->imunisasi_dpt . ',' .
                                $request->imunisasi_campak . ',' .
                                $request->imunisasi_dt . ',' .
                                $request->imunisasi_covid19;
        }
        else {
            $imunisasi = null;
        }

        if (isset($request->kb_suntik) || isset($request->kb_implant) || isset($request->kb_tubektomi) || isset($request->kb_paritas) ||
            isset($request->kb_pil) || isset($request->kb_akdr) || isset($request->kb_vasektomi) || isset($request->kb_abortus)) {
            $kb_riwayat = $request->kb_suntik . ',' .
                                $request->kb_implant . ',' .
                                $request->kb_tubektomi . ',' .
                                $request->kb_paritas . ',' .
                                $request->kb_pil . ',' .
                                $request->kb_akdr . ',' .
                                $request->kb_vasektomi . ',' .
                                $request->kb_abortus;
        }
        else {
            $kb_riwayat = null;
        }

        if (isset($request->riwayatrawat_tempat) || isset($request->riwayatrawat_date) || isset($request->riwayatrawat_alasan)) {
            $riwayatrawat = $request->riwayatrawat_tempat . ',' .
                            $request->riwayatrawat_date . ',' .
                            $request->riwayatrawat_alasan;
        }
        else {
            $riwayatrawat = null;
        }

        if (isset($request->riwayatoperasi_tempat) || isset($request->riwayatoperasi_date) || isset($request->riwayatoperasi_alasan)) {
            $riwayatoperasi = $request->riwayatoperasi_tempat . ',' .
                            $request->riwayatoperasi_date . ',' .
                            $request->riwayatoperasi_alasan;
        }
        else {
            $riwayatoperasi = null;
        }

        Pasien::where('id', $pasien->id)
                -> update([
                    'nama' => $request->nama,
                    'kelamin' => $request->kelamin,
                    'headfamily' => $request->headfamily,
                    'hubfamily' => $request->hubfamily,
                    'agama' => $request->agama,
                    'tempatlahir' => $request->tempatlahir,
                    'datelahir' => $request->datelahir,
                    'alamat' => $request->alamat,
                    'telepon' => $request->telepon,
                    'bpjs' => $request->bpjs,
                    'statusnikah' => $request->statusnikah,
                    'pendidikan' => $request->pendidikan,
                    'pekerjaan' => $request->pekerjaan,
                    'rmringan' => $rmringan,
                    'alergi' => $request->alergi,
                    'penyakitskrg' => $request->penyakitskrg,
                    'penyakitfamily' => $request->penyakitfamily,
                    'imunisasi' => $imunisasi,
                    'kb_operasi' => $request->kb_operasi,
                    'kb_riwayat' => $kb_riwayat,
                    'riwayatrawat' => $riwayatrawat,
                    'riwayatoperasi' => $riwayatoperasi,
                ]);

        Alert::toast('Data berhasil diperbarui!', 'success');
        return redirect()->route('pasien_index');
    }

    public function destroy(Pasien $pasien)
    {
        Pasien::destroy($pasien->id);

        Alert::toast('Data berhasil dihapus!', 'success');
        return redirect()->route('pasien_index');
    }

    public function get_error()
    {
        Alert::toast('Error, silahkan anda periksa kembali!', 'error');
        return redirect()->route('pasien_index');
    }
}
