<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Rotation;

class RotationPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Rotation $rotation): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return (bool) ($user->administrateur || $user->contremaitre);
    }

    public function update(User $user, Rotation $rotation): bool
    {
        if ($user->administrateur) {
            return true;
        }

        if (! $user->contremaitre) {
            return false;
        }

        // Toutes les parcelles liées doivent appartenir au contremaître
        // (reprend exactement la logique de ton destroy() existant)
        $parcelles = $rotation->parcelles;

        if ($parcelles->isEmpty()) {
            return false;
        }

        return $parcelles->every(
            fn ($parcelle) => $parcelle->contremaitre_id === $user->contremaitre->id
        );
    }

    public function delete(User $user, Rotation $rotation): bool
    {
        return $this->update($user, $rotation);
    }
}