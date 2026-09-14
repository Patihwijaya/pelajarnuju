<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Artikel;

class ArticlePolicy
{
    /**
     * Param pertama ($user) tidak diberi type-hint karena panel admin
     * memakai guard 'admin' (model Admin) dan panel user memakai guard 'web'
     * (model User). Laravel Gate otomatis memilih guard yang sedang login.
     */

    public function viewAny($user): bool
    {
        return true;
    }

    public function view($user, Artikel $artikel): bool
    {
        if ($user instanceof Admin) {
            if ($user->isSuperAdmin()) {
                return true;
            }

            if ($artikel->isAuthoredByAdmin()) {
                return $artikel->authorable_id === $user->id;
            }

            return $artikel->isAuthoredByUser()
                && $artikel->authorable
                && $artikel->authorable->asal === $user->asal;
        }

        return $this->owns($user, $artikel);
    }

    public function create($user): bool
    {
        return true;
    }

    public function update($user, Artikel $artikel): bool
    {
        return $this->owns($user, $artikel);
    }

    public function delete($user, Artikel $artikel): bool
    {
        return $this->owns($user, $artikel);
    }

    public function verify($user, Artikel $artikel): bool
    {
        if (!$user instanceof Admin) {
            return false;
        }

        if ($user->isSuperAdmin()) {
            return true;
        }

        if (!$user->isAdmin()) {
            return false;
        }

        if (!$artikel->isAuthoredByUser() || $artikel->isPublished()) {
            return false;
        }

        return $artikel->authorable && $artikel->authorable->asal === $user->asal;
    }

    private function owns($user, Artikel $artikel): bool
    {
        return $artikel->authorable_type === get_class($user)
            && $artikel->authorable_id === $user->id;
    }
}
