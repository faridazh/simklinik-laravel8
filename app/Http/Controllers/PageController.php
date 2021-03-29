<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

use App\Models\Consultation;
use App\Models\Dokter;
use App\Models\Invoice;
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

        return [$start, $end];
    }

    private function pasien_age()
    {
        $lahir = Pasien::select('datelahir')->get();
        $count1 = $count2 = $count3 = $count4 = 0;

        if ($lahir->count() != 0) {
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
        }

        return [$count1, $count2, $count3, $count4];
    }

    private function gender_pasien()
    {
        $pria = Pasien::where('kelamin', 'Laki-laki')->count();
        $wanita = Pasien::where('kelamin', 'Perempuan')->count();

        return [$pria, $wanita];
    }

    private function incomeGraph()
    {
        $start = date('Y-m-d 00:00:00', strtotime('-1 year', time()));
        $end = date('Y-m-d 23:59:59', strtotime('today', time()));

        $query = Invoice::where('jenis', 'Income')->where('status', 'Lunas');

        $Jan = $query->whereBetween('updated_at', [date('Y-m-d 00:00:00', strtotime('first day of January this year', time())), date('Y-m-d 23:59:59', strtotime('last day of January this year', time()))])->sum('total');
        $Feb = $query->whereBetween('updated_at', [date('Y-m-d 00:00:00', strtotime('first day of February this year', time())), date('Y-m-d 23:59:59', strtotime('last day of February this year', time()))])->sum('total');
        $Mar = $query->whereBetween('updated_at', [date('Y-m-d 00:00:00', strtotime('first day of March this year', time())), date('Y-m-d 23:59:59', strtotime('last day of March this year', time()))])->sum('total');
        $Apr = $query->whereBetween('updated_at', [date('Y-m-d 00:00:00', strtotime('first day of April this year', time())), date('Y-m-d 23:59:59', strtotime('last day of April this year', time()))])->sum('total');
        $May = $query->whereBetween('updated_at', [date('Y-m-d 00:00:00', strtotime('first day of May this year', time())), date('Y-m-d 23:59:59', strtotime('last day of May this year', time()))])->sum('total');
        $Jun = $query->whereBetween('updated_at', [date('Y-m-d 00:00:00', strtotime('first day of June this year', time())), date('Y-m-d 23:59:59', strtotime('last day of June this year', time()))])->sum('total');
        $Jul = $query->whereBetween('updated_at', [date('Y-m-d 00:00:00', strtotime('first day of July this year', time())), date('Y-m-d 23:59:59', strtotime('last day of July this year', time()))])->sum('total');
        $Aug = $query->whereBetween('updated_at', [date('Y-m-d 00:00:00', strtotime('first day of August this year', time())), date('Y-m-d 23:59:59', strtotime('last day of August this year', time()))])->sum('total');
        $Sep = $query->whereBetween('updated_at', [date('Y-m-d 00:00:00', strtotime('first day of September this year', time())), date('Y-m-d 23:59:59', strtotime('last day of September this year', time()))])->sum('total');
        $Oct = $query->whereBetween('updated_at', [date('Y-m-d 00:00:00', strtotime('first day of October this year', time())), date('Y-m-d 23:59:59', strtotime('last day of October this year', time()))])->sum('total');
        $Nov = $query->whereBetween('updated_at', [date('Y-m-d 00:00:00', strtotime('first day of November this year', time())), date('Y-m-d 23:59:59', strtotime('last day of November this year', time()))])->sum('total');
        $Dec = $query->whereBetween('updated_at', [date('Y-m-d 00:00:00', strtotime('first day of December this year', time())), date('Y-m-d 23:59:59', strtotime('last day of December this year', time()))])->sum('total');

        $now = $query->whereBetween('updated_at', [date('Y-m-d 00:00:00', strtotime('first day of this month', time())), date('Y-m-d 23:59:59', strtotime('last day of this month', time()))])->sum('total');
        $last = $query->whereBetween('updated_at', [date('Y-m-d 00:00:00', strtotime('first day of last month', time())), date('Y-m-d 23:59:59', strtotime('last day of last month', time()))])->sum('total');

        return ['Jan' => $Jan, 'Feb' => $Feb, 'Mar' => $Mar, 'Apr' => $Apr, 'May' => $May, 'Jun' => $Jun, 'Jul' => $Jul, 'Aug' => $Aug, 'Sep' => $Sep, 'Oct' => $Oct, 'Nov' => $Nov, 'Dec' => $Dec, 'now' => $now, 'last' => $last];
    }

    private function expenseGraph()
    {
        $start = date('Y-m-d 00:00:00', strtotime('-1 year', time()));
        $end = date('Y-m-d 23:59:59', strtotime('today', time()));

        $query = Invoice::where('jenis', 'Expense')->where('status', 'Lunas');

        $Jan = $query->whereBetween('updated_at', [date('Y-m-d 00:00:00', strtotime('first day of January this year', time())), date('Y-m-d 23:59:59', strtotime('last day of January this year', time()))])->sum('total');
        $Feb = $query->whereBetween('updated_at', [date('Y-m-d 00:00:00', strtotime('first day of February this year', time())), date('Y-m-d 23:59:59', strtotime('last day of February this year', time()))])->sum('total');
        $Mar = $query->whereBetween('updated_at', [date('Y-m-d 00:00:00', strtotime('first day of March this year', time())), date('Y-m-d 23:59:59', strtotime('last day of March this year', time()))])->sum('total');
        $Apr = $query->whereBetween('updated_at', [date('Y-m-d 00:00:00', strtotime('first day of April this year', time())), date('Y-m-d 23:59:59', strtotime('last day of April this year', time()))])->sum('total');
        $May = $query->whereBetween('updated_at', [date('Y-m-d 00:00:00', strtotime('first day of May this year', time())), date('Y-m-d 23:59:59', strtotime('last day of May this year', time()))])->sum('total');
        $Jun = $query->whereBetween('updated_at', [date('Y-m-d 00:00:00', strtotime('first day of June this year', time())), date('Y-m-d 23:59:59', strtotime('last day of June this year', time()))])->sum('total');
        $Jul = $query->whereBetween('updated_at', [date('Y-m-d 00:00:00', strtotime('first day of July this year', time())), date('Y-m-d 23:59:59', strtotime('last day of July this year', time()))])->sum('total');
        $Aug = $query->whereBetween('updated_at', [date('Y-m-d 00:00:00', strtotime('first day of August this year', time())), date('Y-m-d 23:59:59', strtotime('last day of August this year', time()))])->sum('total');
        $Sep = $query->whereBetween('updated_at', [date('Y-m-d 00:00:00', strtotime('first day of September this year', time())), date('Y-m-d 23:59:59', strtotime('last day of September this year', time()))])->sum('total');
        $Oct = $query->whereBetween('updated_at', [date('Y-m-d 00:00:00', strtotime('first day of October this year', time())), date('Y-m-d 23:59:59', strtotime('last day of October this year', time()))])->sum('total');
        $Nov = $query->whereBetween('updated_at', [date('Y-m-d 00:00:00', strtotime('first day of November this year', time())), date('Y-m-d 23:59:59', strtotime('last day of November this year', time()))])->sum('total');
        $Dec = $query->whereBetween('updated_at', [date('Y-m-d 00:00:00', strtotime('first day of December this year', time())), date('Y-m-d 23:59:59', strtotime('last day of December this year', time()))])->sum('total');

        $now = $query->whereBetween('updated_at', [date('Y-m-d 00:00:00', strtotime('first day of this month', time())), date('Y-m-d 23:59:59', strtotime('last day of this month', time()))])->sum('total');
        $last = $query->whereBetween('updated_at', [date('Y-m-d 00:00:00', strtotime('first day of last month', time())), date('Y-m-d 23:59:59', strtotime('last day of last month', time()))])->sum('total');

        return ['Jan' => $Jan,  'Feb' => $Feb, 'Mar' => $Mar, 'Apr' => $Apr, 'May' => $May, 'Jun' => $Jun, 'Jul' => $Jul, 'Aug' => $Aug, 'Sep' => $Sep, 'Oct' => $Oct, 'Nov' => $Nov, 'Dec' => $Dec, 'now' => $now, 'last' => $last];
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

        if (!Cache::has('incomeList')) {
            Cache::put('incomeList', $this->incomeGraph(), 3600);
        }

        if (!Cache::has('expenseList')) {
            Cache::put('expenseList', $this->expenseGraph(), 3600);
        }

        return view('dashboard', [
            'pagetitle' => 'Dashboard',
            'pagedesc' => 'Halaman utama',
            'pageid' => 'dashboard',
            'request' => $request,
            'income' => Invoice::where('jenis', 'Income')->where('status', 'Lunas')->whereBetween('created_at', $this->general_time($data_general))->sum('total'),
            'expense' => Invoice::where('jenis', 'Expense')->where('status', 'Lunas')->whereBetween('created_at', $this->general_time($data_general))->sum('total'),
            'all_pasien_count' => Pasien::count(),
            'new_pasien_count' => Pasien::whereBetween('created_at', $this->general_time($data_general))->count(),
            'age_pasien' => $this->pasien_age(),
            'gender_pasien' => $this->gender_pasien(),
            'photo_dokter' => Dokter::where('namagelar', config('setting.dokterjaga'))->select('photo')->first(),
            'obats' => Medicine::where('stok', '<=', 5)->select('namaobat','isiobat','stok','jenis')->orderBy('updated_at', 'desc')->limit(5)->get(),
            'pemasukan' => Invoice::where('jenis', 'Income')->where('status', 'Lunas')->orderBy('invoice', 'desc')->join('consultations', 'invoices.code', '=', 'consultations.code')->select('invoices.*', 'consultations.nama')->limit(5)->get(),
            'pengeluaran' => Invoice::where('jenis', 'Expense')->where('status', 'Lunas')->orderBy('invoice', 'desc')->join('consultations', 'invoices.code', '=', 'consultations.code')->select('invoices.*', 'consultations.nama')->limit(5)->get(),
            'incomeList' => Cache::get('incomeList'),
            'expenseList' => Cache::get('expenseList'),
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
