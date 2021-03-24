<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use RealRashid\SweetAlert\Facades\Alert;

// // Info Level
// Administrator
// Apoteker
// Dokter
// Kasir
// Resepsionis
// Staff

class CekLevel
{
    public function handle(Request $request, Closure $next, $role)
    {
        $roles = [
            'admin' => ['Administrator'],
            'staff' => ['Administrator','Staff'],
            'apoteker' => ['Administrator','Staff','Apoteker'],
            'dokter' => ['Administrator','Staff','Dokter'],
            'kasir' => ['Administrator','Staff','Kasir'],
            'resepsionis' => ['Administrator','Staff','Resepsionis'],
            'pegawai' => ['Administrator','Staff','Apoteker','Dokter','Kasir','Resepsionis'],
        ];

        if(!Auth::check())
        {
            Alert::toast('Silahkan login!', 'error');
            return redirect()->route('login');
        }

        if(in_array(Auth::user()->level, $roles[$role]))
        {
            return $next($request);
        }

        Alert::toast('Anda tidak mempunyai akses!', 'error');
        return redirect()->route('home');
    }
}
