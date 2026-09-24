<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Diagnostic;

class DiagnosticPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Diagnostic $diagnostic): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return (bool) ($user->administrateur || $user->contremaitre);
    }

    public function update(User $user, Diagnostic $diagnostic): bool
    {
        if ($user->administrateur) {
            return true;
        }

        if (! $user->contremaitre) {
            return false;
        }

        // Au moins une des parcelles liées à ce diagnostic
        // doit appartenir au contremaître connecté
        return $diagnostic->parcelles()
            ->where('contremaitre_id', $user->contremaitre->id)
            ->exists();
    }

    public function delete(User $user, Diagnostic $diagnostic): bool
    {
        return $this->update($user, $diagnostic);
    }
}