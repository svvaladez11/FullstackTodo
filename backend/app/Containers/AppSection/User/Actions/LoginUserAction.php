<?php

namespace App\Containers\AppSection\User\Actions;

use App\Containers\AppSection\User\Contracts\Actions\LoginUserActionContract;
use App\Containers\AppSection\User\Contracts\Actions\RespondWithTokenSubActionContract;
use App\Containers\AppSection\User\Data\Dto\LoginUser\LoginUserDto;
use App\Ship\Parents\Actions\ActionParent;
use Illuminate\Support\Facades\Auth;

class LoginUserAction extends ActionParent implements LoginUserActionContract
{
    public function __construct(
        private readonly RespondWithTokenSubActionContract $respondWithTokenSubAction,
    ) {
    }

    public function __invoke(LoginUserDto $dto): array
    {
        $token = Auth::attempt($dto->toArray());

        if (!$token) {
            return $this->respondError(
                message: 'Invalid credentials',
            );
        }

        return $this->respondSuccess(
            data: $this->respondWithTokenSubAction->run($token),
            message: 'Logged in successfully'
        );
    }
}
