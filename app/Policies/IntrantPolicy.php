<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Intrant;

class IntrantPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Intrant $intrant): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return (bool) ($user->administrateur || $user->contremaitre);
    }

    public function update(User $user, Intrant $intrant): bool
    {
        // Pas de propriétaire individuel sur un intrant (stock partagé) :
        // tout contremaître ou administrateur peut le gérer
        return (bool) ($user->administrateur || $user->contremaitre);
    }

    public function delete(User $user, Intrant $intrant): bool
    {
        return $this->update($user, $intrant);
    }
}