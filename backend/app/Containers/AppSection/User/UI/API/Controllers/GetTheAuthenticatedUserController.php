<?php

namespace App\Containers\AppSection\User\UI\API\Controllers;

use App\Containers\AppSection\User\Contracts\Actions\GetTheAuthenticatedUserActionContract;
use App\Ship\Parents\Controllers\ApiControllerParent;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class GetTheAuthenticatedUserController extends ApiControllerParent
{
    public function __invoke(
        GetTheAuthenticatedUserActionContract $action,
    ): JsonResponse {
        $response = $action();

        return match ($response['success']) {
            true => Response::json($response, SymfonyResponse::HTTP_OK),
            false => Response::json($response, SymfonyResponse::HTTP_UNAUTHORIZED),
        };
    }
}
