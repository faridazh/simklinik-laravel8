<?php

namespace App\Http\Controllers;

use App\Models\Dokter;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;

use RealRashid\SweetAlert\Facades\Alert;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class DokterController extends Controller
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
            $sortby = 'dokterid';
            $orderby = 'asc';
        }

        if ($request->has('cari'))
        {
            $dokters = Dokter::select('id', 'dokterid', 'photo', 'namagelar', 'validtill', 'alamat')
                                ->where('dokterid','LIKE','%'.$request->cari.'%')
                                ->orwhere('nosertif','LIKE','%'.$request->cari.'%')
                                ->orwhere('nostr','LIKE','%'.$request->cari.'%')
                                ->orwhere('norekom','LIKE','%'.$request->cari.'%')
                                ->orwhere('namagelar','LIKE','%'.$request->cari.'%')
                                ->orwhere('tempatlahir','LIKE','%'.$request->cari.'%')
                                ->orwhere('alamat','LIKE','%'.$request->cari.'%')
                                ->orwhere('keterangan','LIKE','%'.$request->cari.'%')
                            ->orderBy($sortby, $orderby)
                            ->paginate($page);
        }
        else
        {
            $dokters = Dokter::select('id', 'dokterid', 'photo', 'namagelar', 'validtill', 'alamat')
                            ->orderBy($sortby, $orderby)
                            ->paginate($page);
        }

        return view('dokter.index', [
            'pagetitle' => 'Data Dokter',
            'pagedesc' => 'Menampilkan seluruh data dokter',
            'pageid' => 'datadokter',
            'dokters' => $dokters,
        ]);
    }

    public function create()
    {
        return view('dokter.create', [
            'pagetitle' => 'Dokter Baru',
            'pagedesc' => 'Menambahkan data dokter baru',
            'pageid' => 'datadokter',
            'photo_maxSize' => 256 . ' KB',
            'sertifikat_maxSize' => 10240 . ' KB',
        ]);
    }

    public function store(Request $request)
    {
        $photo_maxSize = 256;
        $sertifikat_maxSize = 10240;

        $request->validate([
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,bmp,gif,webp|max:' . $photo_maxSize,
            'nosertif' => 'required|string',
            'validtill' => 'required|date',
            'nostr' => 'required|string',
            'norekom' => 'required|string',
            'nama' => 'required|string|max:255',
            'namagelar' => 'required|string|max:500',
            'tempatlahir' => 'required|string|max:30',
            'datelahir' => 'required|date',
            'alamat' => 'required|string|max:500',
            'keterangan' => 'nullable|string|max:2500',
            'sertifikat' => 'nullable|image|mimes:jpg,jpeg,png,bmp,gif,webp|max:' . $sertifikat_maxSize,
        ]);

        $config = [
            'table' => 'dokters',
            'field' => 'dokterid',
            'length' => 6,
            'prefix' => 'DR',
        ];
        $dokterid = IdGenerator::generate($config);

        if (isset($request->photo)) {
            $photoName = date('Ymdhis', time()) . '_' . $dokterid . '_avatar' . '.' . $request->file('photo')->extension();
            $request->file('photo')->storeAs('uploads/dokter/', $photoName, 'public');
        }
        else {
            $photoName = null;
        }

        if (isset($request->sertifikat)) {
            $sertifName = date('Ymdhis', time()) . '_' . $dokterid . '_sertifikat' . '.' . $request->file('sertifikat')->extension();
            $request->file('sertifikat')->storeAs('uploads/dokter/', $sertifName, 'public');
        }
        else {
            $sertifName = null;
        }

        Dokter::create([
            'dokterid' => $dokterid,
            'photo' => $photoName,
            'nosertif' => $request->nosertif,
            'validtill' => $request->validtill,
            'nostr' => $request->nostr,
            'norekom' => $request->norekom,
            'nama' => $request->nama,
            'namagelar' => $request->namagelar,
            'tempatlahir' => $request->tempatlahir,
            'datelahir' => $request->datelahir,
            'alamat' => $request->alamat,
            'keterangan' => $request->keterangan,
            'sertifikat' => $sertifName,
        ]);

        Alert::toast('Data berhasil ditambahkan!', 'success');
        return redirect()->route('dokter_index');
    }

    public function show(Dokter $dokter)
    {
        $dokter = Dokter::where('id', $dokter->id)->first();

        return view('dokter.show', [
            'pagetitle' => 'Data Lengkap Dokter',
            'pagedesc' => 'Menampilkan data dokter secara lengkap',
            'pageid' => 'datadokter',
            'dokter' => $dokter,
        ]);
    }

    public function edit(Dokter $dokter)
    {
        $dokter = Dokter::where('id', $dokter->id)->first();

        return view('dokter.edit', [
            'pagetitle' => 'Edit Data Dokter',
            'pagedesc' => 'Mengubah dan memperbarui data dokter',
            'pageid' => 'datadokter',
            'dokter' => $dokter,
            'photo_maxSize' => 256 . ' KB',
            'sertifikat_maxSize' => 10240 . ' KB',
        ]);
    }

    public function update(Request $request, Dokter $dokter)
    {
        $photo_maxSize = 256;
        $sertifikat_maxSize = 10240;

        $request->validate([
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,bmp,gif,webp|max:' . $photo_maxSize,
            'nosertif' => 'required|string',
            'validtill' => 'required|date',
            'nostr' => 'required|string',
            'norekom' => 'required|string',
            'nama' => 'required|string|max:255',
            'namagelar' => 'required|string|max:500',
            'tempatlahir' => 'required|string|max:30',
            'datelahir' => 'required|date',
            'alamat' => 'required|string|max:500',
            'keterangan' => 'nullable|string|max:2500',
            'sertifikat' => 'nullable|image|mimes:jpg,jpeg,png,bmp,gif,webp|max:' . $sertifikat_maxSize,
        ]);

        if (isset($request->photo)) {
            if (Storage::disk('public')->exists('uploads/dokter/' . $dokter->photo)) {
                Storage::disk('public')->delete('uploads/dokter/' . $dokter->photo);
            }

            $photoName = date('Ymdhis', time()) . '_' . $dokter->id . '_avatar' . '.' . $request->file('photo')->extension();
            $request->file('photo')->storeAs('uploads/dokter/', $photoName, 'public');
        }
        else {
            $photoName = $dokter->photo;
        }

        if (isset($request->sertifikat)) {
            if (Storage::disk('public')->exists('uploads/dokter/' . $dokter->sertifikat)) {
                Storage::disk('public')->delete('uploads/dokter/' . $dokter->sertifikat);
            }

            $sertifName = date('Ymdhis', time()) . '_' . $dokter->id . '_sertifikat' . '.' . $request->file('sertifikat')->extension();
            $request->file('sertifikat')->storeAs('uploads/dokter/', $sertifName, 'public');
        }
        else {
            $sertifName = $dokter->sertifikat;
        }

        Dokter::where('id', $dokter->id)
                ->update([
                    'photo' => $photoName,
                    'nosertif' => $request->nosertif,
                    'validtill' => $request->validtill,
                    'nostr' => $request->nostr,
                    'norekom' => $request->norekom,
                    'nama' => $request->nama,
                    'namagelar' => $request->namagelar,
                    'tempatlahir' => $request->tempatlahir,
                    'datelahir' => $request->datelahir,
                    'alamat' => $request->alamat,
                    'keterangan' => $request->keterangan,
                    'sertifikat' => $sertifName,
                ]);

        Alert::toast('Data berhasil diperbarui!', 'success');
        return redirect()->route('dokter_index');
    }

    public function destroy(Dokter $dokter)
    {
        Dokter::destroy($dokter->id);

        Alert::toast('Data berhasil dihapus!', 'success');
        return redirect()->route('dokter_index');
    }

    public function get_error()
    {
        Alert::toast('Error, silahkan anda periksa kembali!', 'error');
        return redirect()->route('dokter_index');
    }
}
