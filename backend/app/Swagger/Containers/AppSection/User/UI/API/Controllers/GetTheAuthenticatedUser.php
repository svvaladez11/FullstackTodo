<?php

namespace App\Swagger\Containers\AppSection\User\UI\API\Controllers;

/**
 * @OA\Post(
 *     path="/api/v1/users/me",
 *     method="POST",
 *     tags={"User"},
 *     summary="Get authenticated user",
 *     description="Returns the currently authenticated user",
 *     operationId="getAuthenticatedUser",
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Response(
 *         response=200,
 *         description="User found",
 *         @OA\JsonContent(
 *             allOf={
 *                 @OA\Schema(ref="#/components/schemas/SuccessResponse"),
 *                 @OA\Schema(
 *                     @OA\Property(
 *                         property="data",
 *                         type="object",
 *                         @OA\Property(
 *                             property="user",
 *                             ref="#/components/schemas/User"
 *                         )
 *                     ),
 *                     @OA\Property(
 *                         property="message",
 *                         type="string",
 *                         example="User found."
 *                     )
 *                 )
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=401,
 *         description="User is not authenticated",
 *         @OA\JsonContent(
 *             allOf={
 *                 @OA\Schema(ref="#/components/schemas/ErrorResponse"),
 *                 @OA\Schema(
 *                     @OA\Property(
 *                          property="message",
 *                          type="string",
 *                          example="User is not authenticated."
 *                     )
 *                 )
 *             }
 *         )
 *     )
 * )
 */
class GetTheAuthenticatedUser {}
