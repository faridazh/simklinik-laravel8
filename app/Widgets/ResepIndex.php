<?php

namespace App\Widgets;

use App\Models\Consultation;

use Arrilot\Widgets\AbstractWidget;

class ResepIndex extends AbstractWidget
{
    public $reloadTimeout = 5;

    protected $config = [];

    public function run()
    {
        $reseps = Consultation::where('resep', 'Sedang')->orderBy('created_at', 'asc')->select('id','code','norm','nama')->get();

        return view('widgets.resep_index', [
            'config' => $this->config,
            'reseps' => $reseps,
        ]);
    }
}
