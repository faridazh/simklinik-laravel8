<?php

namespace Database\Seeders;

use App\Models\Setting;

use Carbon\Carbon;

use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run()
    {
        Setting::truncate();

        $timeNow = Carbon::now()->format('Y-m-d H:i:s');

        $data = [
            // TEXT
            // ['name' => '', 'value' => '', 'created_at' => $timeNow, 'updated_at' => $timeNow],

            // Website
            ['name' => 'webname', 'value' => 'SIM Klinik', 'created_at' => $timeNow, 'updated_at' => $timeNow],
            ['name' => 'weblogo', 'value' => '', 'created_at' => $timeNow, 'updated_at' => $timeNow],
            ['name' => 'favicon', 'value' => '', 'created_at' => $timeNow, 'updated_at' => $timeNow],
            ['name' => 'darkmode', 'value' => 'on', 'created_at' => $timeNow, 'updated_at' => $timeNow],

            // Dokter
            ['name' => 'dokterjaga', 'value' => '', 'created_at' => $timeNow, 'updated_at' => $timeNow],
            ['name' => 'fee_dokter', 'value' => '50000', 'created_at' => $timeNow, 'updated_at' => $timeNow],

            // kasir
            ['name' => 'currency', 'value' => 'Rp.', 'created_at' => $timeNow, 'updated_at' => $timeNow],

            // Obat
            ['name' => 'harga_jual', 'value' => '40', 'created_at' => $timeNow, 'updated_at' => $timeNow],

            // profile
            ['name' => 'max_size', 'value' => '256', 'created_at' => $timeNow, 'updated_at' => $timeNow],
            ['name' => 'max_height', 'value' => '512', 'created_at' => $timeNow, 'updated_at' => $timeNow],
            ['name' => 'max_width', 'value' => '512', 'created_at' => $timeNow, 'updated_at' => $timeNow],
        ];

        Setting::insert($data);
    }
}
