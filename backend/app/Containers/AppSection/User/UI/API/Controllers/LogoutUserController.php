<?php

namespace App\Containers\AppSection\User\UI\API\Controllers;

use App\Containers\AppSection\User\Contracts\Actions\LogoutUserActionContract;
use App\Ship\Parents\Controllers\ApiControllerParent;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class LogoutUserController extends ApiControllerParent
{
    public function __invoke(
        LogoutUserActionContract $action,
    ): JsonResponse {
        $response = $action();

        return Response::json($response, SymfonyResponse::HTTP_NO_CONTENT);
    }
}
