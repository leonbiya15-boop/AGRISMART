<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Parcelle;

class ParcellePolicy
{
    public function viewAny(User $user): bool
    {
        return true; // tout utilisateur connecté peut consulter la liste
    }

    public function view(User $user, Parcelle $parcelle): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return (bool) ($user->administrateur || $user->contremaitre);
    }

    public function update(User $user, Parcelle $parcelle): bool
    {
        if ($user->administrateur) {
            return true;
        }

        return $user->contremaitre
            && $parcelle->contremaitre_id === $user->contremaitre->id;
    }

    public function delete(User $user, Parcelle $parcelle): bool
    {
        return $this->update($user, $parcelle);
    }
}