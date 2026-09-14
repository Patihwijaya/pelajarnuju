<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * super_admin memiliki akses penuh (bypass via Gate::before).
     * admin hanya boleh mengelola user dengan role 'user'.
     * user biasa tidak memiliki akses ke User Management.
     *
     * Param pertama ($user) tidak diberi type-hint karena panel admin
     * memakai guard 'admin' (model Admin) yang juga mengelola user.
     */
    public function viewAny($user): bool
    {
        return $user->hasRole('super_admin', 'admin');
    }

    public function view($user, User $target): bool
    {
        return $user->hasRole('super_admin', 'admin') && $this->canManage($user, $target);
    }

    public function create($user): bool
    {
        return $user->hasRole('super_admin', 'admin');
    }

    public function update($user, User $target): bool
    {
        return $user->hasRole('super_admin', 'admin') && $this->canManage($user, $target);
    }

    public function delete($user, User $target): bool
    {
        if ($user->id === $target->id) {
            return false;
        }

        return $user->hasRole('super_admin', 'admin') && $this->canManage($user, $target);
    }

    private function canManage($user, User $target): bool
    {
        if ($user->isSuperAdmin()) {
            return true;
        }

        return $target->isUser();
    }
}
