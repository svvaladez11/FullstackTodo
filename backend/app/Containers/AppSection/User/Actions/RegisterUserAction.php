<?php

namespace App\Containers\AppSection\User\Actions;

use App\Containers\AppSection\User\Contracts\Actions\RegisterUserActionContract;
use App\Containers\AppSection\User\Contracts\Tasks\CreateUserTaskContract;
use App\Containers\AppSection\User\Data\Dto\RegisterUser\RegisterUserDto;
use App\Ship\Exceptions\InternalServerErrorException;
use App\Ship\Parents\Actions\ActionParent;

class RegisterUserAction extends ActionParent implements RegisterUserActionContract
{
    public function __construct(
        private readonly CreateUserTaskContract $createUserTask,
    ) {
    }

    public function __invoke(RegisterUserDto $request): array {

        try {
            $user = $this->createUserTask->run($request);

            return $this->respondSuccess(
                data: [
                    'user' => $user,
                ],
                message: 'User created successfully');
        } catch (InternalServerErrorException $e) {
            return $this->respondError(
                message: $e->getMessage(),
                errors: [],
            );
        }
    }
}
