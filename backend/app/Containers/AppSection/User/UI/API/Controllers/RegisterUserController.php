<?php

namespace App\Containers\AppSection\User\UI\API\Controllers;

use App\Containers\AppSection\User\Contracts\Actions\RegisterUserActionContract;
use App\Containers\AppSection\User\Data\Dto\RegisterUser\Factories\CreateRegisterUserDtoFactory;
use App\Containers\AppSection\User\UI\API\Requests\RegisterUserRequest;
use App\Ship\Parents\Controllers\ApiControllerParent;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class RegisterUserController extends ApiControllerParent
{
    public function __invoke(
        RegisterUserRequest $request,
        RegisterUserActionContract $action,
    ): JsonResponse {
        $dto = new CreateRegisterUserDtoFactory()->fromRequest($request);

        $response = $action($dto);

        return match ($response['success']) {
            true => Response::json($response, SymfonyResponse::HTTP_OK),
            false => Response::json($response, SymfonyResponse::HTTP_UNAUTHORIZED),
        };

    }
}
