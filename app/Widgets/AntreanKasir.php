<?php

namespace App\Widgets;

use App\Models\Antrian;

use Arrilot\Widgets\AbstractWidget;

class AntreanKasir extends AbstractWidget
{
    public $reloadTimeout = 5;

    protected $config = [];

    public function run()
    {
        $antrean = Antrian::orderBy('antrian', 'desc')->where('jenis', 'Kasir')->where('status', 'Sedang')->first();
        $antreans = Antrian::orderBy('antrian', 'asc')->where('jenis', 'Kasir')->where('status', 'Belum')->limit(5)->get();

        return view('widgets.antrean_kasir', [
            'config' => $this->config,
            'antrean' => $antrean,
            'antreans' => $antreans,
        ]);
    }
}
