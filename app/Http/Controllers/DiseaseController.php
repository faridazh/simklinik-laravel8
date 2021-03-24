<?php

namespace App\Http\Controllers;

use App\Models\Disease;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

use RealRashid\SweetAlert\Facades\Alert;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class DiseaseController extends Controller
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
            $sortby = 'code';
            $orderby = 'asc';
        }

        if ($request->has('cari'))
        {
            $diseases = Disease::select('id', 'code', 'namaindo', 'namainggris')
                                ->where('code','LIKE','%'.$request->cari.'%')
                                ->orwhere('namaindo','LIKE','%'.$request->cari.'%')
                                ->orwhere('namainggris','LIKE','%'.$request->cari.'%')
                                ->orwhere('keterangan','LIKE','%'.$request->cari.'%')
                            ->orderBy($sortby, $orderby)
                            ->paginate($page);
        }
        else
        {
            $diseases = Disease::select('id', 'code', 'namaindo', 'namainggris')
                            ->orderBy($sortby, $orderby)
                            ->paginate($page);
        }

        return view('penyakit.index', [
            'pagetitle' => 'Data Penyakit',
            'pagedesc' => 'Menampilkan seluruh data penyakit yang tersedia',
            'pageid' => 'datapenyakit',
            'diseases' => $diseases,
        ]);
    }

    public function create()
    {
        return view('penyakit.create', [
            'pagetitle' => 'Tambah Data Penyakit',
            'pagedesc' => 'Menambahkandata penyakit baru',
            'pageid' => 'datapenyakit',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:20|unique:diseases,code',
            'namaindo' => 'required|string|max:500|unique:diseases',
            'namainggris' => 'required|string|max:500|unique:diseases',
            'keterangan' => 'required|string|max:1000',
        ]);

        Disease::create($request->all());

        Alert::toast('Data berhasil ditambahkan!', 'success');
        return redirect()->route('penyakit_index');
    }

    public function show($id)
    {
        if (!is_numeric($id) || Disease::find($id) === null) {
            Alert::toast('Error, silahkan periksa kembali!', 'error');
            return redirect()->route('penyakit_index');
        }

        $disease = Disease::where('id', $id)->first();

        return view('penyakit.show', [
            'pagetitle' => 'Data Penyakit',
            'pagedesc' => 'Menampilkan data penyakit secara lengkap',
            'pageid' => 'datapenyakit',
            'disease' => $disease,
        ]);
    }

    public function edit($id)
    {
        if (!is_numeric($id) || Disease::find($id) === null) {
            Alert::toast('Error, silahkan periksa kembali!', 'error');
            return redirect()->route('penyakit_index');
        }

        $disease = Disease::where('id', $id)->first();

        return view('penyakit.edit', [
            'pagetitle' => 'Edit Data Penyakit',
            'pagedesc' => 'Mengubah dan memperbarui data penyakit',
            'pageid' => 'datapenyakit',
            'disease' => $disease,
        ]);
    }

    public function update($id, Request $request, Disease $disease)
    {
        if (!is_numeric($id) || Disease::find($id) === null) {
            Alert::toast('Error, silahkan periksa kembali!', 'error');
            return redirect()->route('penyakit_index');
        }

        $disease = Disease::where('id', $id)->first();

        if ($request->code != $disease->code) {
            $request->validate([
                'code' => 'required|string|max:20|unique:diseases,code',
            ]);
        }

        if ($request->namaindo != $disease->namaindo) {
            $request->validate([
                'namaindo' => 'required|string|max:500|unique:diseases',
            ]);
        }

        if ($request->namainggris != $disease->namainggris) {
            $request->validate([
                'namainggris' => 'required|string|max:500|unique:diseases',
            ]);
        }

        $request->validate([
            'keterangan' => 'required|string|max:1000',
        ]);

        Disease::where('id', $disease->id)->update([
            'code' => $request->code,
            'namaindo' => $request->namaindo,
            'namainggris' => $request->namainggris,
            'keterangan' => $request->keterangan,
        ]);

        Alert::toast('Data berhasil diperbarui!', 'success');
        return redirect()->route('penyakit_index');
    }

    public function destroy($id)
    {
        if (!is_numeric($id) || Disease::find($id) === null) {
            Alert::toast('Error, silahkan periksa kembali!', 'error');
            return redirect()->route('penyakit_index');
        }

        Disease::destroy($id);

        Alert::toast('Data berhasil dihapus!', 'success');
        return redirect()->route('penyakit_index');
    }

    public function get_error()
    {
        Alert::toast('Error, silahkan anda periksa kembali!', 'error');
        return redirect()->route('penyakit_index');
    }
}
