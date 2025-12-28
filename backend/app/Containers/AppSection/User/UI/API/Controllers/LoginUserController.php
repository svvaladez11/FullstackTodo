<?php

namespace App\Containers\AppSection\User\UI\API\Controllers;

use App\Containers\AppSection\User\Contracts\Actions\LoginUserActionContract;
use App\Containers\AppSection\User\Data\Dto\LoginUser\Factories\CreateLoginUserDtoFactory;
use App\Containers\AppSection\User\UI\API\Requests\LoginUserRequest;
use App\Ship\Parents\Controllers\ApiControllerParent;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class LoginUserController extends ApiControllerParent
{
    public function __invoke(
        LoginUserRequest        $request,
        LoginUserActionContract $action,
    ): JsonResponse {
        $dto = new CreateLoginUserDtoFactory()
            ->fromRequest($request);

        $response = $action($dto);

        return match ($response['success']) {
            true => Response::json($response, SymfonyResponse::HTTP_OK),
            false => Response::json($response, SymfonyResponse::HTTP_UNAUTHORIZED),
        };
    }
}
