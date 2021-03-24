<?php

namespace App\Widgets;

use App\Models\Antrian;

use Arrilot\Widgets\AbstractWidget;

class AntreanApotek extends AbstractWidget
{
    public $reloadTimeout = 5;

    protected $config = [];

    public function run()
    {
        $antrean = Antrian::orderBy('antrian', 'desc')->where('jenis', 'Apotek')->where('status', 'Sedang')->first();
        $antreans = Antrian::orderBy('antrian', 'asc')->where('jenis', 'Apotek')->where('status', 'Belum')->limit(5)->get();

        return view('widgets.antrean_apotek', [
            'config' => $this->config,
            'antrean' => $antrean,
            'antreans' => $antreans,
        ]);
    }
}
