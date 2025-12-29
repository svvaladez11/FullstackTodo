<?php

namespace App\Swagger\Containers\AppSection\User\UI\API\Controllers;

/**
 * @OA\Post(
 *     path="/api/v1/users/logout",
 *     method="POST",
 *     tags={"User"},
 *     summary="Logout user",
 *     description="Logout user",
 *     operationId="logoutUser",
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Response(
 *         response=204,
 *         description="Logged out successfully.",
 *         @OA\JsonContent(
 *             allOf={
 *                 @OA\Schema(ref="#/components/schemas/SuccessResponse"),
 *                 @OA\Schema(
 *                     @OA\Property(
 *                         property="message",
 *                         type="string",
 *                         example="Logged out successfully."
 *                     ),
 *                 )
 *             }
 *         )
 *     ),
 * )
 */
class LogoutUser {}
