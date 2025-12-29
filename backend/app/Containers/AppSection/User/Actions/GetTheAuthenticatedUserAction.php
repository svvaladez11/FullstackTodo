<?php

namespace App\Containers\AppSection\User\Actions;

use App\Containers\AppSection\User\Contracts\Actions\GetTheAuthenticatedUserActionContract;
use App\Containers\AppSection\User\Contracts\Tasks\GetTheAuthenticatedUserTaskContract;
use App\Ship\Exceptions\UnauthorizedException;
use App\Ship\Parents\Actions\ActionParent;

class GetTheAuthenticatedUserAction extends ActionParent implements GetTheAuthenticatedUserActionContract
{
    public function __construct(
        private readonly GetTheAuthenticatedUserTaskContract $getTheAuthenticatedUserTask,
    ) {}

    public function __invoke(): array
    {
        try {
            $user = $this->getTheAuthenticatedUserTask->run();
            return $this->respondSuccess(
                data: [
                    'user' => $user->toArray(),
                ],
                message: 'User found.',
            );
        } catch (UnauthorizedException) {
            return $this->respondError(
                message: 'User is not authenticated.',
            );
        }
    }
}
