<?php

namespace App\Models\Valet;

use App\Models\Currency\Currency;
use App\Modes\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Valet extends Model
{
    use SoftDeletes;

    protected $table = "valets";

    protected $fillable = [ "name", "description" ];

    public function defaultCurrency() {
        return $this->belongsTo(Currency::class, 'default_currency_id');
    }

    public function author() {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function categories() {
        return $this->hasMany(ValetCategory::class);
    }

    public function records() {
        return $this->hasMany(ValetRecord::class);
    }

    public function balances() {
        return $this->hasMany(ValetBalance::class);
    }

    public function participants() {
        return $this->belongsToMany(User::class, 'user_valet', 'valet_id', 'user_id');
    }
}
