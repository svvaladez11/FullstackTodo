<?php

namespace App\Containers\AppSection\User\Actions;

use App\Containers\AppSection\User\Contracts\Actions\LogoutUserActionContract;
use App\Ship\Parents\Actions\ActionParent;
use Illuminate\Support\Facades\Auth;

class LogoutUserAction extends ActionParent implements LogoutUserActionContract
{
    public function __construct(
    ) {
    }

    public function __invoke(): array
    {
        Auth::logout();
        return $this->respondSuccess(
            data: [],
            message: 'Logged out successfully.',
        );
    }
}
