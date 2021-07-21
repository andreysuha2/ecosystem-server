<?php

namespace App\Policies\Valet;

use App\Models\Valet\Valet;
use App\Modes\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ValetPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Valet $valet) {
        return $user->valets->contains($valet->id);
    }

    public function update(User $user, Valet $valet) {
        return $user->valets()
            ->where('valet_id', $valet->id)
            ->wherePivotIn('role', [ 'admin', 'moderator' ])->exists();
    }

    public function delete(User $user, Valet $valet) {
        return $user->valets()
            ->where('valet_id', $valet->id)
            ->wherePivotIn('role', [ 'admin' ])->exists();
    }
}
