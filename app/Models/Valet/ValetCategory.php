<?php

namespace App\Models\Valet;

use App\Modes\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ValetCategory extends Model
{
    use SoftDeletes;

    protected $table = 'valet_category';

    protected $fillable = [ 'name', 'description' ];

    public function valet() {
        return $this->belongsTo(Valet::class, 'valet_id');
    }

    public function author() {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function records() {
        return $this->hasMany(ValetRecord::class, 'category_id');
    }
}
