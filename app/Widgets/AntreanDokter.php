<?php

namespace App\Widgets;

use App\Models\Antrian;

use Arrilot\Widgets\AbstractWidget;

class AntreanDokter extends AbstractWidget
{
    public $reloadTimeout = 5;

    protected $config = [];

    public function run()
    {
        $antrean = Antrian::orderBy('antrian', 'desc')->where('jenis', 'Dokter')->where('status', 'Sedang')->first();
        $antreans = Antrian::orderBy('antrian', 'asc')->where('jenis', 'Dokter')->where('status', 'Belum')->limit(5)->get();

        return view('widgets.antrean_dokter', [
            'config' => $this->config,
            'antrean' => $antrean,
            'antreans' => $antreans,
        ]);
    }
}
