<?php

namespace App\Containers\AppSection\User\Actions;

use App\Containers\AppSection\User\Contracts\Actions\RespondWithTokenSubActionContract;
use App\Ship\Parents\Actions\SubActionParent;
use Illuminate\Support\Facades\Auth;

class RespondWithTokenSubAction extends SubActionParent implements RespondWithTokenSubActionContract
{
    public function run(string $token): array
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
        ];
    }
}
