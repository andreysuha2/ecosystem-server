<?php

namespace App\Models\Valet;

use App\Models\Currency\Currency;
use App\Modes\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ValetRecord extends Model
{
    use SoftDeletes;

    protected $table = 'valet_record';

    protected $fillable = [ 'description', 'value', 'type', 'date' ];

    protected $casts = [ 'date' => 'datetime' ];

    public function currency() {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    public function valet() {
        return $this->belongsTo(Valet::class, 'valet_id');
    }

    public function category() {
        return $this->belongsTo(ValetCategory::class, 'category_id');
    }

    public function author() {
        return $this->belongsTo(User::class, 'author_id');
    }
}
