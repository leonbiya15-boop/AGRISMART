<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Culture;

class CulturePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Culture $culture): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return (bool) ($user->administrateur || $user->contremaitre);
    }

    public function update(User $user, Culture $culture): bool
    {
        if ($user->administrateur) {
            return true;
        }

        // La culture appartient à une parcelle, qui appartient à un contremaître
        return $user->contremaitre
            && $culture->parcelle->contremaitre_id === $user->contremaitre->id;
    }

    public function delete(User $user, Culture $culture): bool
    {
        return $this->update($user, $culture);
    }
}