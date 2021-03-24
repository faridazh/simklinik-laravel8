<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Pasien;

use Illuminate\Http\Request;

use RealRashid\SweetAlert\Facades\Alert;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class AntrianController extends Controller
{
    public function index()
    {
        $antrians = Antrian::orderBy('antrian', 'asc')->get();

        return view('registrasi.index', [
            'pagetitle' => 'Registrasi',
            'pagedesc' => 'Mendaftarkan antrian baru',
            'pageid' => 'registrasi',
            'antrians' => $antrians,
        ]);
    }

    protected function GenPrefix($data)
    {
        // Generate No. Antrian
        if($data == 'Apotek')
        {
            $length = 4;
            $prefix = 'B';
        }
        elseif($data == 'Dokter')
        {
            $length = 4;
            $prefix = 'A';
        }
        elseif($data == 'Kasir')
        {
            $length = 4;
            $prefix = 'C';
        }
        elseif($data == 'Laboratorium')
        {
            $length = 4;
            $prefix = 'D';
        }

        $config = [
            'table' => 'antrians',
            'field' => 'antrian',
            'length' => $length,
            'prefix' => $prefix,
            'reset_on_prefix_change' => TRUE,
        ];

        return IdGenerator::generate($config);
    }

    public function store(Request $request)
    {
        if (Antrian::where('norm', $request->norm)->where('jenis', $request->jenis)->exists()) {
            Alert::toast('Pasien sudah dalam antrian!', 'error');
            return redirect()->route('registrasi_index');
        }

        $request->validate([
            'norm' => 'required|numeric|digits:6',
            'jenis' => 'required|in:Apotek,Dokter,Kasir,Laboratorium',
        ]);

        if (Pasien::where('norm', $request->norm)->count() == 1) {
            $no_antri = $this->GenPrefix($request->jenis);
            $nama_pasien = Pasien::where('norm', $request->norm)->select('nama')->first();

            Antrian::create([
                'antrian' => $no_antri,
                'jenis' => $request->jenis,
                'norm' => $request->norm,
                'nama' => $nama_pasien->nama,
            ]);

            Alert::toast('Antrian baru berhasil ditambahkan!', 'success');
            return redirect()->route('registrasi_index');
        }
        else {
            Alert::toast('periksa kembali nomor rekam medis!', 'error');
            return redirect()->route('registrasi_index');
        }
    }

    // public function edit($id)
    // {
    //     if (!is_numeric($id) || Antrian::find($id) === null) {
    //         Alert::toast('Error, silahkan periksa kembali!', 'error');
    //         return redirect()->route('registrasi_index');
    //     }
    //
    //     $antrians = Antrian::where('id', $id)->first();
    //     $nama_pasien = Pasien::where('norm', $antrians->norm)->select('nama')->get();
    //
    //     return view('registrasi.edit', [
    //         'pagetitle' => 'Edit Antrian',
    //         'pagedesc' => '',
    //         'pageid' => 'registrasi',
    //         'antrians' => $antrians,
    //         'pasiens' => $nama_pasien,
    //     ]);
    // }
    //
    // public function update(Request $request, $id)
    // {
    //     if (!is_numeric($id) || Antrian::find($id) === null) {
    //         Alert::toast('Error, silahkan periksa kembali!', 'error');
    //         return redirect()->route('registrasi_index');
    //     }
    //
    //     $request->validate([
    //         'nama' => 'required|string|max:255',
    //     ]);
    //
    //     Antrian::where('id', $id)
    //             ->update([
    //                 'nama' => $request->nama,
    //             ]);
    //
    //     Alert::toast('Antrian berhasil diperbarui!', 'success');
    //     return redirect()->route('registrasi_index');
    // }

    public function destroy(Antrian $antrian)
    {
        Antrian::destroy($antrian->id);

        Alert::toast('Antrian berhasil dihapus!', 'success');
        return redirect()->route('registrasi_index');
    }

    public function destroy_all()
    {
        Antrian::truncate();
        // Antrian::whereNotNull('id')->delete();

        Alert::toast('Semua antrian berhasil dihapus!', 'success');
        return redirect()->route('registrasi_index');
    }

    public function antrean()
    {
        return view('registrasi.antrean.antrean', [
            'pagetitle' => 'List Antrian',
            'pagedesc' => '',
            'pageid' => 'antrian',
        ]);
    }

    public function antreanDokter()
    {
        return view('registrasi.antrean.dokter', [
            'pagetitle' => 'List Antrian',
            'pagedesc' => '',
            'pageid' => 'antrian',
        ]);
    }

    public function antreanApotek()
    {
        return view('registrasi.antrean.apotek', [
            'pagetitle' => 'List Antrian',
            'pagedesc' => '',
            'pageid' => 'antrian',
        ]);
    }

    public function antreanKasir()
    {
        return view('registrasi.antrean.kasir', [
            'pagetitle' => 'List Antrian',
            'pagedesc' => '',
            'pageid' => 'antrian',
        ]);
    }

    public function get_error()
    {
        Alert::toast('Error, silahkan anda periksa kembali!', 'error');
        return redirect()->route('registrasi_index');
    }
}
