<?php

namespace App\Swagger\Containers\AppSection\User\UI\API\Controllers;

/**
 * @OA\Post(
 *     path="/api/v1/users",
 *     method="POST",
 *     tags={"User"},
 *     summary="Register user",
 *     description="Register new user",
 *     operationId="registerUser",
 *
 *     @OA\Response(
 *         response=200,
 *         description="User created successfully",
 *         @OA\JsonContent(
 *             allOf={
 *                 @OA\Schema(ref="#/components/schemas/SuccessResponse"),
 *                 @OA\Schema(
 *                     @OA\Property(
 *                         property="data",
 *                         type="object",
 *                         @OA\Property(
 *                             property="user",
 *                             ref="#/components/schemas/RegisteredUser"
 *                         )
 *                     ),
 *                     @OA\Property(
 *                         property="message",
 *                         type="string",
 *                         example="User created successfully"
 *                     ),
 *                 )
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=401,
 *         description="Something went wrong. Please try again later.",
 *         @OA\JsonContent(
 *             allOf={
 *                 @OA\Schema(ref="#/components/schemas/ErrorResponse"),
 *                 @OA\Schema(
 *                     @OA\Property(
 *                          property="message",
 *                          type="string",
 *                          example="Something went wrong. Please try again later."
 *                     ),
 *                 )
 *             }
 *         )
 *     )
 * )
 */
class RegisterUser {}
