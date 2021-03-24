<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Setting;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;

use RealRashid\SweetAlert\Facades\Alert;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class MedicineController extends Controller
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
            $obats = Medicine::where('code','LIKE','%'.$request->cari.'%')
                                ->orwhere('namaobat','LIKE','%'.$request->cari.'%')
                                ->orwhere('isiobat','LIKE','%'.$request->cari.'%')
                                ->orwhere('golongan','LIKE','%'.$request->cari.'%')
                                ->orwhere('jenis','LIKE','%'.$request->cari.'%')
                            ->orderBy($sortby, $orderby)
                            ->paginate($page);
        }
        else
        {
            // select('id','code','namaobat','isiobat','golongan','jenis')
            $obats = Medicine::orderBy($sortby, $orderby)->paginate($page);
        }

        // $setting = Setting::select('value')->get();

        return view('obat.index', [
            'pagetitle' => 'Data Obat',
            'pagedesc' => 'Menampilkan seluruh data obat',
            'pageid' => 'dataobat',
            'obats' => $obats,
        ]);
    }

    public function create()
    {
        return view('obat.create', [
            'pagetitle' => 'Tambah Data Obat',
            'pagedesc' => 'Menambahkan data obat baru',
            'pageid' => 'dataobat',
        ]);
    }

    protected function prefixgen($data)
    {
        $firstchar = Str::upper($data[0]);
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

    public function store(Request $request)
    {
        $request->validate([
            'namaobat' => 'required|string|max:150',
            'isiobat' => 'required|string|max:500',
            'golongan' => 'required|in:Bebas,Bebas Terbatas,Fitofarmaka,Golongan Narkotik,Herbal Terstandar (OHT),Herbal (Jamu),Keras',
            'jenis' => 'required|in:Drops,Gas,Gel,Injeksi,Kaplet,Kapsul,Koyo,Krim,Larutan,Pil,Puyer,Salep,Sirop,Spray,Suntik,Tablet',
            'stok' => 'nullable|numeric|min:0|max:999999999',
            'harga_beli' => 'nullable|numeric|min:0|max:999999999',
            'harga_jual' => 'nullable|numeric|min:0|max:999999999',
        ]);

        // Generate Kode Obat
        $config = [
            'table' => 'medicines',
            'field' => 'code',
            'length' => 6,
            'prefix' => $this->prefixgen($request->jenis),
        ];

        $kodeobat = IdGenerator::generate($config);

        Medicine::create([
            'code' => $kodeobat,
            'namaobat' => $request->namaobat,
            'isiobat' => $request->isiobat,
            'golongan' => $request->golongan,
            'jenis' => $request->jenis,
            'stok' => $request->stok,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
        ]);

        Alert::toast('Data berhasil ditambahkan!', 'success');
        return redirect()->route('obat_index');
    }

    public function edit($id)
    {
        if (!is_numeric($id) || Medicine::find($id) === null) {
            Alert::toast('Error, silahkan periksa kembali!', 'error');
            return redirect()->route('obat_index');
        }

        $obat = Medicine::where('id', $id)->first();

        return view('obat.edit', [
            'pagetitle' => 'Edit Data Obat',
            'pagedesc' => '',
            'pageid' => 'dataobat',
            'obat' => $obat,
        ]);
    }

    public function update(Request $request, $id)
    {
        if (!is_numeric($id) || Medicine::find($id) === null) {
            Alert::toast('Error, silahkan periksa kembali!', 'error');
            return redirect()->route('obat_index');
        }

        if (!isset($request->golongan)) {
            $request->merge(['golongan' => Medicine::find($id)->golongan]);
        }

        if (!isset($request->jenis)) {
            $request->merge(['jenis' => Medicine::find($id)->jenis]);
        }

        $request->validate([
            'namaobat' => 'required|string|max:150',
            'isiobat' => 'required|string|max:500',
            'golongan' => 'required|in:Bebas,Bebas Terbatas,Fitofarmaka,Golongan Narkotik,Herbal Terstandar (OHT),Herbal (Jamu),Keras',
            'jenis' => 'required|in:Drops,Gas,Gel,Injeksi,Kaplet,Kapsul,Koyo,Krim,Larutan,Pil,Puyer,Salep,Sirop,Spray,Suntik,Tablet',
            'stok' => 'nullable|numeric|min:0|max:999999999',
            'harga_beli' => 'nullable|numeric|min:0|max:999999999',
            'harga_jual' => 'nullable|numeric|min:0|max:999999999',
        ]);

        Medicine::where('id', $id)->update([
            'namaobat' => $request->namaobat,
            'isiobat' => $request->isiobat,
            'golongan' => $request->golongan,
            'jenis' => $request->jenis,
            'stok' => $request->stok,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
        ]);

        Alert::toast('Data berhasil diperbarui!', 'success');
        return redirect()->route('obat_index');
    }

    public function destroy($id)
    {
        if (!is_numeric($id) || Medicine::find($id) === null) {
            Alert::toast('Error, silahkan periksa kembali!', 'error');
            return redirect()->route('obat_index');
        }

        Medicine::destroy($id);

        Alert::toast('Data berhasil dihapus!', 'success');
        return redirect()->route('obat_index');
    }

    public function get_error()
    {
        Alert::toast('Error, silahkan anda periksa kembali!', 'error');
        return redirect()->route('obat_index');
    }
}
