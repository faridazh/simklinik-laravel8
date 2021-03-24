<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Dokter;
use App\Models\Setting;

use RealRashid\SweetAlert\Facades\Alert;

class SettingController extends Controller
{
    public function index()
    {
        return view('settings', [
            'pagetitle' => 'Pengaturan',
            'pagedesc' => 'Pengaturan aplikasi SIM',
            'pageid' => 'settings',
            'dokters' => Dokter::select('namagelar')->get(),
            'logo_maxSize' => 256 . ' KB',
            'icon_maxSize' => 10 . ' KB',
        ]);
    }

    public function update_website(Request $request)
    {
        $logo_maxSize = 256;
        $icon_maxSize = 10;

        $request->validate([
            'webname' => 'required|string|max:15',
            'weblogo' => 'nullable|image|mimes:jpg,jpeg,png,bmp,gif,webp|max:' . $logo_maxSize,
            'favicon' => 'nullable|image|mimes:jpg,jpeg,png,bmp,gif,webp|max:' . $icon_maxSize,
        ]);

        if ($request->webname != config('setting.webname')) {
            Setting::where('name', 'webname')->update([
                'value' => $request->webname,
            ]);
        }

        if (isset($request->weblogo)) {
            if (Storage::disk('public')->exists('uploads/images/' . config('setting.weblogo'))) {
                Storage::disk('public')->delete('uploads/images/' . config('setting.weblogo'));
            }

            $logoName = date('Ymdhis', time()) . '_' . 'logo' . '.' . $request->file('weblogo')->extension();
            $request->file('weblogo')->storeAs('uploads/images/', $logoName, 'public');

            Setting::where('name', 'weblogo')->update([
                'value' => $logoName,
            ]);
        }

        if (isset($request->favicon)) {
            if (Storage::disk('public')->exists('uploads/images/' . config('setting.favicon'))) {
                Storage::disk('public')->delete('uploads/images/' . config('setting.favicon'));
            }

            $iconName = date('Ymdhis', time()) . '_' . 'favicon' . '.' . $request->file('favicon')->extension();
            $request->file('favicon')->storeAs('uploads/images/', $iconName, 'public');

            Setting::where('name', 'favicon')->update([
                'value' => $iconName,
            ]);
        }

        Alert::toast('Pengaturan berhasil diperbarui!', 'success');
        return redirect()->route('settings_index');
    }

    public function update_dokter(Request $request)
    {
        $request->validate([
            'dokterjaga' => 'required|exists:dokters,namagelar',
            'fee_dokter' => 'required|numeric|min:0|max:999999999'
        ]);

        if ($request->dokterjaga != config('setting.dokterjaga')) {
            Setting::where('name', 'dokterjaga')->update([
                'value' => $request->dokterjaga,
            ]);
        }

        if ($request->fee_dokter != config('setting.fee_dokter')) {
            Setting::where('name', 'fee_dokter')->update([
                'value' => $request->fee_dokter,
            ]);
        }

        Alert::toast('Pengaturan berhasil diperbarui!', 'success');
        return redirect()->route('settings_index');
    }

    public function update_profile(Request $request)
    {
        $request->validate([
            'max_size' => 'required|numeric|min:0',
            'max_height' => 'required|numeric|min:0',
            'max_width' => 'required|numeric|min:0',
        ]);

        if ($request->max_size != config('setting.max_size')) {
            Setting::where('name', 'max_size')->update([
                'value' => $request->max_size,
            ]);
        }

        if ($request->max_height != config('setting.max_height')) {
            Setting::where('name', 'max_height')->update([
                'value' => $request->max_height,
            ]);
        }

        if ($request->max_width != config('setting.max_width')) {
            Setting::where('name', 'max_width')->update([
                'value' => $request->max_width,
            ]);
        }

        Alert::toast('Pengaturan berhasil diperbarui!', 'success');
        return redirect()->route('settings_index');
    }

    public function update_obat(Request $request)
    {
        $request->validate([
            'harga_jual' => 'required|numeric|min:0',
        ]);

        if ($request->harga_jual != config('setting.harga_jual')) {
            Setting::where('name', 'harga_jual')->update([
                'value' => $request->harga_jual,
            ]);
        }

        Alert::toast('Pengaturan berhasil diperbarui!', 'success');
        return redirect()->route('settings_index');
    }

    public function update_kasir(Request $request)
    {
        $request->validate([
            'currency' => 'required|string|max:5',
        ]);

        if ($request->currency != config('setting.currency')) {
            Setting::where('name', 'currency')->update([
                'value' => $request->currency,
            ]);
        }

        Alert::toast('Pengaturan berhasil diperbarui!', 'success');
        return redirect()->route('settings_index');
    }

    public function get_error()
    {
        Alert::toast('Error, silahkan anda periksa kembali!', 'error');
        return redirect()->route('settings_index');
    }

    // public function create()
    // {
    //     //
    // }
    //
    // public function store(Request $request)
    // {
    //     //
    // }
    //
    // public function show($id)
    // {
    //     //
    // }
    //
    // public function edit($id)
    // {
    //     //
    // }

    // public function update(Request $request, $id)
    // {
    //     //
    // }

    // public function destroy($id)
    // {
    //     //
    // }
}
