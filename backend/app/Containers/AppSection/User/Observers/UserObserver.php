<?php

namespace App\Containers\AppSection\User\Observers;

use App\Containers\AppSection\User\Models\User;
use Illuminate\Support\Str;

class UserObserver
{
    public function deleting(User $user): void
    {
        $user->login = Str::slug(now() . ' ' . $user->login, '_');
        $user->save();
    }
}
