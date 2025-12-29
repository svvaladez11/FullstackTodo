<?php

namespace App\Swagger\Containers\AppSection\User\UI\API\Controllers;

/**
 * @OA\Post(
 *     path="/api/v1/users/login",
 *     method="POST",
 *     tags={"User"},
 *     summary="Login user",
 *     description="Login user",
 *     operationId="loginUser",
 *
 *     @OA\Response(
 *         response=200,
 *         description="Logged in successfully",
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
 *                         example="Logged in successfully"
 *                     ),
 *                 )
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=401,
 *         description="Invalid credentials",
 *         @OA\JsonContent(
 *             allOf={
 *                 @OA\Schema(ref="#/components/schemas/ErrorResponse"),
 *                 @OA\Schema(
 *                     @OA\Property(
 *                          property="message",
 *                          type="string",
 *                          example="Invalid credentials"
 *                     ),
 *                 )
 *             }
 *         )
 *     )
 * )
 */
class LoginUser {}
