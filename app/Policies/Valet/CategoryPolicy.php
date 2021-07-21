<?php

namespace App\Policies\Valet;

use App\Models\Valet\ValetCategory;
use App\Modes\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function view(User $user, ValetCategory $category) {
        return $user->participant()->where('valet_id', $category->valet_id)->exists();
    }

    public function create(User $user) {

    }
}
