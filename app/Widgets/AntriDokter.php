<?php

namespace App\Widgets;

use App\Models\Antrian;

use Arrilot\Widgets\AbstractWidget;

class AntriDokter extends AbstractWidget
{
    public $reloadTimeout = 5;

    protected $config = [];

    public function run()
    {
        $antrean = Antrian::orderBy('antrian')->where('jenis', 'Dokter')->where('status', 'Belum')->first();

        return view('widgets.antri_dokter', [
            'config' => $this->config,
            'antrean' => $antrean,
        ]);
    }
}
