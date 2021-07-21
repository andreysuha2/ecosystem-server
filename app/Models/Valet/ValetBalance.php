<?php

namespace App\Models\Valet;

use App\Modes\User;
use App\Models\Currency\Currency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ValetBalance extends Model
{
    use SoftDeletes;

    protected $table = 'valet_balance';

    protected $fillable = [ 'value', 'description', 'date' ];

    protected $casts = [ 'date' => 'datetime' ];

    public function currency() {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    public function valet() {
        return $this->belongsTo(Valet::class, 'valet_id');
    }

    public function author() {
        return $this->belongsTo(User::class, 'author_id');
    }
}
