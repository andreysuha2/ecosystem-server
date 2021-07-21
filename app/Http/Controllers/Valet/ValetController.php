<?php

namespace App\Http\Controllers\Valet;

use App\Http\Controllers\Controller;
use App\Http\Requests\Valet\ViewValetRequest;
use App\Http\Resources\Valet\ValetResource;
use App\Models\Valet\Valet;
use Illuminate\Http\Request;

class ValetController extends Controller
{
    public function getValet(Valet $valet, ViewValetRequest $request) {
        return new ValetResource($valet, true);
    }
}
