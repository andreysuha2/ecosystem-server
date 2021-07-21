<?php

namespace App\Http\Controllers\Valet;

use App\Http\Controllers\Controller;
use App\Http\Resources\Valet\ValetResource;
use App\Models\Valet\Valet;
use Illuminate\Http\Request;

class ValetController extends Controller
{
    public function getValet(Valet $valet) {
        return new ValetResource($valet, true);
    }
}
