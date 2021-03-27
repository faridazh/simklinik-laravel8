<?php

namespace App\Widgets;

use App\Models\Antrian;

use Arrilot\Widgets\AbstractWidget;

class AntriResep extends AbstractWidget
{
    public $reloadTimeout = 5;
    protected $config = [];

    public function run()
    {
        $antrean = Antrian::orderBy('antrian')->where('jenis', 'Apotek')->where('status', 'Belum')->first();

        return view('widgets.antri_resep', [
            'config' => $this->config,
            'antrean' => $antrean,
        ]);
    }
}
