<?php

namespace App\Models\Currency;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    public $timestamps = false;

    protected $table = 'currencies';

    protected $fillable = [ 'code', 'symbol', 'name' ];
}
