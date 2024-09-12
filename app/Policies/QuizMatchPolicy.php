<?php

namespace App\Policies;

use App\Models\User;

class QuizMatchPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function before(User $user, string $ability): bool|null{
        if ($user->is_admin){
            return true;
        }

        return null;
    }

    public function viewAny(User $user): bool{
        return $user->is_referee || $user->is_downloader;
    }

    public function create(User $user): bool{
        return false;
    }

    public function update(User $user): bool{
        return $user->is_referee;
    }

    public function delete(User $user): bool{
        return false;
    }

    public function generatePic(User $user): bool{
        return $user->is_downloader;
    }
}
