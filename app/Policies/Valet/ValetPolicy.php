<?php

namespace App\Policies\Valet;

use App\Models\Valet\Valet;
use App\Modes\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ValetPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Valet $valet) {
        return $user->valets->contains($valet);
    }
}
