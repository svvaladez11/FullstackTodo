<?php

namespace App\Containers\AppSection\User\Actions;

use App\Containers\AppSection\User\Contracts\Actions\RefreshAccessTokenActionContract;
use App\Containers\AppSection\User\Contracts\Actions\RespondWithTokenSubActionContract;
use App\Ship\Parents\Actions\ActionParent;
use Illuminate\Support\Facades\Auth;

class RefreshAccessTokenAction extends ActionParent implements RefreshAccessTokenActionContract
{
    public function __construct(
        private readonly RespondWithTokenSubActionContract $respondWithTokenSubAction,
    ) {
    }

    public function __invoke(): array
    {
        $token = Auth::refresh();

        if (!$token) {
            return $this->respondError(
                message: 'Token refresh failed.',
            );
        }

        return $this->respondSuccess(
            data: $this->respondWithTokenSubAction->run($token),
            message: 'Token successfully refreshed.',
        );
    }
}
