<?php

namespace App\Http\Controllers;

// use Auth; // or
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;

use App\Http\Controllers\Controller;
use App\Models\User;

use RealRashid\SweetAlert\Facades\Alert;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $page = 25;

        if ($request->has('cari'))
        {
            $pegawais = User::select('id','staffid','avatar','name','username','level')
                                ->where('staffid','LIKE','%'.$request->cari.'%')
                                ->orwhere('nama','LIKE','%'.$request->cari.'%')
                                ->orwhere('username','LIKE','%'.$request->cari.'%')
                                ->orwhere('level','LIKE','%'.$request->cari.'%')
                            ->orderBy('staffid')->paginate($page);
        }
        else
        {
            $pegawais = User::select('id','staffid','avatar','name','username','level')
                            ->orderBy('staffid')->paginate($page);
        }

        return view('pegawai.index', [
            'pagetitle' => 'Data Staff',
            'pagedesc' => 'Menampilkan seluruh data staff',
            'pageid' => 'datastaff',
            'pegawais' => $pegawais,
        ]);
    }

    public function create()
    {
        $config = [
            'table' => 'users',
            'field' => 'staffid',
            'length' => 6,
            'prefix' => 'STF'
        ];

        $staffid = IdGenerator::generate($config);

        return view('pegawai.create', [
            'pagetitle' => 'Staff Baru',
            'pagedesc' => 'Menambahkan data staff baru',
            'pageid' => 'datastaff',
            'staffid' => $staffid,
            'maxsize' => number_format(config('setting.max_size')) . ' KB',
            'maxdimensions' => number_format(config('setting.max_width')) . ' x ' . number_format(config('setting.max_height')) . 'px',
        ]);
    }

    public function store(Request $request)
    {
        $maxsize = config('setting.max_size');
        $maxwidth = config('setting.max_width');
        $maxheight = config('setting.max_height');

        $request->validate([
            'name' => 'required|string|min:5|max:255',
            'username' => 'required|string|min:5|max:30',
            'email' => 'required|email|required_with:email_confirmation|same:email_confirmation',
            'password' => 'min:8|required_with:password_confirmation|same:password_confirmation',
            'level' => 'required|string|in:Apoteker,Dokter,Kasir,Resepsionis,Staff,Administrator',
            'avatar' => 'nullable|mimes:jpg,jpeg,png,bmp,gif,webp|image|max:'.$maxsize.'|dimensions:min_width=100,min_height=100,max_width='.$maxwidth.',max_height='.$maxheight,
        ]);

        //Generate Staff ID
        $config = [
            'table' => 'users',
            'field' => 'staffid',
            'length' => 6,
            'prefix' => 'STF'
        ];
        $staffid = IdGenerator::generate($config);

        if (isset($request->avatar)) {
            if (Storage::disk('public')->exists('uploads/avatar/' . $request->username)) {
                Storage::disk('public')->delete('uploads/avatar/' . $request->username);
            }

            $avatar_name = date('Ymdhis', time()) . '_' . $request->username . '.' . $request->file('avatar')->extension();
            $request->file('avatar')->storeAs('uploads/avatar/', $avatar_name, 'public');
        }
        else {
            $avatar_name = null;
        }

        User::create([
            'staffid' => $staffid,
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => $request->level,
            'avatar' => $avatar_name,
            'remember_token' => Str::random(60),
        ]);

        Alert::toast('Data berhasil ditambahkan!', 'success');
        return redirect()->route('pegawai_index');
    }

    public function show($id)
    {
        if (!is_numeric($id) || User::find($id) === null) {
            Alert::toast('Error, silahkan periksa kembali!', 'error');
            return redirect()->route('pegawai_index');
        }

        $pegawai = User::where('id', $id)->first();

        return view('pegawai.show', [
            'pagetitle' => 'Data Lengkap Staff',
            'pagedesc' => 'Menampilkan data staff secara lengkap',
            'pageid' => 'datastaff',
            'pegawai' => $pegawai,
        ]);
    }

    public function edit($id)
    {
        if (!is_numeric($id) || User::find($id) === null) {
            Alert::toast('Error, silahkan periksa kembali!', 'error');
            return redirect()->route('resep_index');
        }

        $pegawai = User::where('id', $id)->first();

        return view('pegawai.edit', [
            'pagetitle' => 'Data Lengkap Staff',
            'pagedesc' => 'Mengubah dan memperbarui data staff',
            'pageid' => 'datastaff',
            'pegawai' => $pegawai,
            'maxsize' => number_format(config('setting.max_size')) . ' KB',
            'maxdimensions' => number_format(config('setting.max_width')) . ' x ' . number_format(config('setting.max_height')) . 'px',
        ]);
    }

    public function update(Request $request, $id)
    {
        if (!is_numeric($id) || User::find($id) === null) {
            Alert::toast('Error, silahkan periksa kembali!', 'error');
            return redirect()->route('resep_index');
        }

        $maxsize = config('setting.max_size');
        $maxwidth = config('setting.max_width');
        $maxheight = config('setting.max_height');

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:30',
            'level' => 'required|string|in:Apoteker,Dokter,Kasir,Resepsionis,Staff,Administrator',
            'email' => 'required|email|required_with:email_confirmation|same:email_confirmation',
            'avatar' => 'nullable|mimes:jpg,jpeg,png,bmp,gif,webp|image|max:'.$maxsize.'|dimensions:min_width=100,min_height=100,max_width='.$maxwidth.',max_height='.$maxheight,
        ]);

        if (isset($request->avatar)) {
            if (Storage::disk('public')->exists('uploads/avatar/' . $request->username)) {
                Storage::disk('public')->delete('uploads/avatar/' . $request->username);
            }

            $avatar_name = date('Ymdhis', time()) . '_' . $request->username . '.' . $request->file('avatar')->extension();
            $request->file('avatar')->storeAs('uploads/avatar/', $avatar_name, 'public');
        }
        else {
            $avatarUser = User::where('id', $id)->select('avatar')->first();
            if (isset($avatarUser)) {
                $avatar_name = $avatarUser->avatar;
            }
            else {
                $avatar_name = null;
            }
        }

        User::where('id', $id)
                ->update([
                    'name' => $request->name,
                    'username' => $request->username,
                    'level' => $request->level,
                    'email' => $request->email,
                    'avatar' => $avatar_name,
                ]);

        Alert::toast('Data berhasil diperbarui!', 'success');
        return redirect()->route('pegawai_index');
    }

    public function destroy($id)
    {
        if (!is_numeric($id) || User::find($id) === null) {
            Alert::toast('Error, silahkan periksa kembali!', 'error');
            return redirect()->route('resep_index');
        }

        User::destroy($id);

        Alert::toast('Data berhasil dihapus!', 'success');
        return redirect()->route('pegawai_index');
    }

    public function forgot_password($id)
    {
        if (!is_numeric($id) || User::find($id) === null) {
            Alert::toast('Error, silahkan periksa kembali!', 'error');
            return redirect()->route('resep_index');
        }

        $pegawai = User::select('id', 'staffid', 'username', 'name')->where('id', $id)->first();

        return view('pegawai.forgotpass', [
            'pagetitle' => 'Reset Password Staff',
            'pagedesc' => 'Mengubah dan memperbarui password staff',
            'pageid' => 'datastaff',
            'pegawai' => $pegawai,
        ]);
    }

    public function update_password(Request $request, $id)
    {
        if (!is_numeric($id) || User::find($id) === null) {
            Alert::toast('Error, silahkan periksa kembali!', 'error');
            return redirect()->route('resep_index');
        }

        $request->validate([
            'password' => 'min:8|required_with:password_confirmation|same:password_confirmation',
        ]);

        User::where('id', $id)
                ->update([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ]);

        Alert::toast('Password berhasil diperbarui!', 'success');
        return redirect()->route('pegawai_index');
    }

    public function login()
    {
        return view('user.login', [
            'pagetitle' => 'Login',
            'pagedesc' => '',
            'pageid' => 'loginpage',
        ]);
    }

    public function postlogin(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        $remember = $request->rememberMe;

        if(Auth::attempt($credentials, $remember))
        {
            Alert::toast('Anda berhasil masuk!', 'success');
            return redirect()->route('dashboard');
        }

        Alert::toast('Silahkan periksa kembali username/password anda!', 'error');
        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Alert::toast('Anda berhasil keluar!', 'success');
        return redirect()->route('home');
    }

    public function myprofile()
    {
        $myprofile = User::where('id', Auth::user()->id)->first();

        return view('user.profile', [
            'pagetitle' => 'Profile Saya',
            'pagedesc' => '',
            'pageid' => 'myprofile',
            'myprofile' => $myprofile,
        ]);
    }

    public function edit_myprofile()
    {
        $myprofile = User::where('id', Auth::user()->id)->first();

        return view('user.editprofile', [
            'pagetitle' => 'Edit Profile Saya',
            'pagedesc' => '',
            'pageid' => 'myprofile',
            'myprofile' => $myprofile,
            'maxsize' => number_format(config('setting.max_size')) . ' KB',
            'maxdimensions' => number_format(config('setting.max_width')) . ' x ' . number_format(config('setting.max_height')) . 'px',
        ]);
    }

    public function update_myprofile(Request $request)
    {
        $maxsize = config('setting.max_size');
        $maxwidth = config('setting.max_width');
        $maxheight = config('setting.max_height');

        $request->validate([
            'avatar' => 'nullable|mimes:jpg,jpeg,png,bmp,gif,webp|image|max:'.$maxsize.'|dimensions:min_width=100,min_height=100,max_width='.$maxwidth.',max_height='.$maxheight,
            'name' => 'required|string|min:5|max:255',
            'username' => 'required|string|min:5|max:30',
            'email' => 'required|email|required_with:email_confirmation|same:email_confirmation',
        ]);

        if (isset($request->avatar)) {
            if (Storage::disk('public')->exists('uploads/avatar/' . Auth::user()->avatar)) {
                Storage::disk('public')->delete('uploads/avatar/' . Auth::user()->avatar);
            }

            $avatar_name = date('Ymdhis', time()) . '_' . $request->username . '.' . $request->file('avatar')->extension();
            $request->file('avatar')->storeAs('uploads/avatar/', $avatar_name, 'public');
        }
        else {
            $avatar_name = Auth::user()->avatar;
        }

        User::where('id', Auth::user()->id)
                ->update([
                    'name' => $request->name,
                    'username' => $request->username,
                    'email' => $request->email,
                    'avatar' => $avatar_name,
                ]);

        Alert::toast('Data berhasil diperbarui!', 'success');
        return redirect()->route('myprofile_index');
    }

    public function reset_mypass()
    {
        $myprofile = User::where('id', Auth::user()->id)->first();

        return view('user.resetpass', [
            'pagetitle' => 'Reset Password',
            'pagedesc' => '',
            'pageid' => 'myprofile',
            'myprofile' => $myprofile,
        ]);
    }

    public function update_mypass(Request $request)
    {
        $request->validate([
            'password' => 'min:8|required_with:password_confirmation|same:password_confirmation',
        ]);

        User::where('id', Auth::user()->id)
                ->update([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ]);

        Alert::toast('Password berhasil diperbarui!', 'success');
        return redirect()->route('myprofile_index');
    }

    public function get_error()
    {
        Alert::toast('Error, silahkan anda periksa kembali!', 'error');
        return redirect()->route('myprofile_index');
    }
}
