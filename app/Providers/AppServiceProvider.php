<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Cache;

use App\Models\Setting;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        Blade::if('authcheck', function () {
            return Auth::user() == true;
        });
        Blade::if('notauth', function () {
            return Auth::user() == false;
        });
        Blade::if('admin', function () {
            return Auth::user() == true && Auth::user()->level == 'Administrator';
        });
        Blade::if('staff', function () {
            return Auth::user() == true && in_array(Auth::user()->level, ['Administrator','Staff']);
        });
        Blade::if('apoteker', function () {
            return Auth::user() == true && in_array(Auth::user()->level, ['Administrator','Staff','Apoteker']);
        });
        Blade::if('dokter', function () {
            return Auth::user() == true && in_array(Auth::user()->level, ['Administrator','Staff','Dokter']);
        });
        Blade::if('kasir', function () {
            return Auth::user() == true && in_array(Auth::user()->level, ['Administrator','Staff','Kasir']);
        });
        Blade::if('resepsionis', function () {
            return Auth::user() == true && in_array(Auth::user()->level, ['Administrator','Staff','Resepsionis']);
        });

        if (Schema::hasTable('settings')) {
            foreach (Setting::all() as $setting) {
                Config::set('setting.'.$setting->name, $setting->value);
            }
        }

        Blade::if('dark', function () {
            return Cache::has('darkmode');
        });
    }
}
