<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

use App\Models\Dokter;
use App\Models\Medicine;
use App\Models\Pasien;

use Illuminate\Http\Request;

use RealRashid\SweetAlert\Facades\Alert;

class PageController extends Controller
{
    private function general_time($data = 'Bulanan')
    {
        // Y-m-d h:i:s
        if ($data == 'Harian') {
            $start = date('Y-m-d 00:00:00', strtotime('today', time()));
            $end = date('Y-m-d 23:59:59', strtotime('today', time()));
        }
        elseif ($data == 'Mingguan') {
            $start = date('Y-m-d 00:00:00', strtotime('-1 week', time()));
            $end = date('Y-m-d 23:59:59', strtotime('today', time()));
        }
        elseif ($data == 'Bulanan') {
            $start = date('Y-m-d 00:00:00', strtotime('-1 month', time()));
            $end = date('Y-m-d 23:59:59', strtotime('today', time()));
        }
        elseif ($data == 'Tahunan') {
            $start = date('Y-m-d 00:00:00', strtotime('-1 year', time()));
            $end = date('Y-m-d 23:59:59', strtotime('today', time()));
        }
        elseif ($data == 'Semua') {
            $start = date('1970-01-01 00:00:00', time());
            $end = date('Y-m-d 23:59:59', strtotime('today', time()));
        }
        else {
            $start = date('Y-m-d 00:00:00', strtotime('first day of this month', time()));
            $end = date('Y-m-d 23:59:59', strtotime('last day of this month', time()));
        }

        return Pasien::whereBetween('created_at', [$start, $end])->count();
    }

    private function pasien_age()
    {
        $lahir = Pasien::select('datelahir')->get();
        $count1 = $count2 = $count3 = $count4 = 0;

        // return $lahir->count();

        if ($lahir->count() == 0) {
            $final = [$count1, $count2, $count3, $count4];
        }
        else {
            for ($i=0; $i < $lahir->count(); $i++) {
                $array[] = intval(date('Y', time() - strtotime($lahir[$i]->datelahir))) - 1970;
            }

            for ($i = 0; $i < sizeof($array); $i++) {
               if($array[$i] >= 0 && $array[$i] <= 16 ) {
                   $count1++;
               }
               if($array[$i] >= 17 && $array[$i] <= 30 ) {
                   $count2++;
               }
               if($array[$i] >= 31 && $array[$i] <= 50 ) {
                   $count3++;
               }
               if($array[$i] >= 51 ) {
                   $count4++;
               }
           }

           $final = [$count1, $count2, $count3, $count4];
        }
        return $final;
    }

    private function gender_pasien()
    {
        $pria = Pasien::where('kelamin', 'Laki-laki')->count();
        $wanita = Pasien::where('kelamin', 'Perempuan')->count();

        $array = [$pria, $wanita];

        return $array;
    }

    public function dashboard(Request $request)
    {
        if ($request->has('general')) {
            $request->validate([
                'general' => 'required|in:Harian,Mingguan,Bulanan,Tahunan,Semua',
            ]);
            $data_general = $request->general;
        }
        else {
            $data_general = null;
        }

        $new_pasien_count = $this->general_time($data_general);

        $dokterPhoto = Dokter::where('namagelar', config('setting.dokterjaga'))->select('photo')->first();

        $obats = Medicine::where('stok', '<=', 5)->select('namaobat','isiobat','stok','jenis')->orderBy('updated_at', 'desc')->limit(5)->get();

        return view('dashboard', [
            'pagetitle' => 'Dashboard',
            'pagedesc' => 'Halaman utama',
            'pageid' => 'dashboard',
            'request' => $request,
            'all_pasien_count' => Pasien::count(),
            'new_pasien_count' => $new_pasien_count,
            'age_pasien' => $this->pasien_age(),
            'gender_pasien' => $this->gender_pasien(),
            'photo_dokter' => $dokterPhoto,
            'obats' => $obats,
        ]);
    }

    public function home()
    {
        if(Auth::user() == true)
        {
            return redirect()->route('dashboard');
        }

        return view('index', [
            'pagetitle' => 'Beranda',
            'pagedesc' => 'Halaman utama',
            'pageid' => 'beranda',
        ]);
    }

    public function about()
    {
        return view('about', [
            'pagetitle' => 'Tentang Kami',
            'pagedesc' => '',
            'pageid' => 'about',
        ]);
    }

    public function darkmode()
    {
        if (config('setting.darkmode') == 'on') {
            if (Cache::has('darkmode')) {
                Cache::pull('darkmode');
            }
            else {
                Cache::put('darkmode', 'dark');
            }
        }

        return redirect()->back();
    }

    public function get_error()
    {
        if (Auth::check()) {
            Alert::toast('Error, silahkan anda cek kembali!', 'error');
            return redirect()->route('dashboard');
        }
        else {
            Alert::toast('Silahkan login!', 'error');
            return redirect()->route('login');
        }
    }
}
