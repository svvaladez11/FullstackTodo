<?php

namespace App\Containers\AppSection\User\Tasks;

use App\Containers\AppSection\User\Contracts\Data\Presenters\UserPresenterContract;
use App\Containers\AppSection\User\Contracts\Tasks\CreateUserTaskContract;
use App\Containers\AppSection\User\Data\Dto\RegisterUser\RegisterUserDto;
use App\Containers\AppSection\User\Data\Dto\User\UserDto;
use App\Containers\AppSection\User\Data\Services\UserService;
use App\Ship\Exceptions\InternalServerErrorException;
use App\Ship\Parents\Tasks\TaskParent;
use Illuminate\Support\Facades\Log;

final class CreateUserTask extends TaskParent implements CreateUserTaskContract
{
    public function __construct(
        private readonly UserService $service,
        private readonly UserPresenterContract $presenter,
    ) {
    }

    public function run(RegisterUserDto $user): UserDto
    {
        try {
            $model = $this->service->create($user);
            return $this->presenter->present($model);
        } catch (\Exception $e) {
            Log::error('Failed to create user', ['exception' => $e]);
            throw new InternalServerErrorException();
        }
    }
}
