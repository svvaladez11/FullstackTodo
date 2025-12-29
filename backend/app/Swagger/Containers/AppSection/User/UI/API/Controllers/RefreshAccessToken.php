<?php

namespace App\Swagger\Containers\AppSection\User\UI\API\Controllers;

/**
 * @OA\Post(
 *     path="/api/v1/users/refresh",
 *     method="POST",
 *     tags={"User"},
 *     summary="Refresh token",
 *     description="Refresh token",
 *     operationId="refreshToken",
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Response(
 *         response=200,
 *         description="Token successfully refreshed.",
 *         @OA\JsonContent(
 *             allOf={
 *                 @OA\Schema(ref="#/components/schemas/SuccessResponse"),
 *                 @OA\Schema(
 *                     @OA\Property(
 *                         property="data",
 *                         type="object",
 *                         ref="#/components/schemas/RespondWithToken"
 *                     ),
 *                     @OA\Property(
 *                         property="message",
 *                         type="string",
 *                         example="Token successfully refreshed."
 *                     ),
 *                 )
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=401,
 *         description="Token refresh failed.",
 *         @OA\JsonContent(
 *             allOf={
 *                 @OA\Schema(ref="#/components/schemas/ErrorResponse"),
 *                 @OA\Schema(
 *                     @OA\Property(
 *                          property="message",
 *                          type="string",
 *                          example="Token refresh failed."
 *                     ),
 *                 )
 *             }
 *         )
 *     )
 * )
 */
class RefreshAccessToken {}
