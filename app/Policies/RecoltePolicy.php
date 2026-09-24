<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Recolte;

class RecoltePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Recolte $recolte): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return (bool) ($user->administrateur || $user->contremaitre);
    }

    public function update(User $user, Recolte $recolte): bool
    {
        if ($user->administrateur) {
            return true;
        }

        return $user->contremaitre
            && $recolte->contremaitre_id === $user->contremaitre->id;
    }

    public function delete(User $user, Recolte $recolte): bool
    {
        return $this->update($user, $recolte);
    }
}