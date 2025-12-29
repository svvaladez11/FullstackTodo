<?php

namespace App\Swagger\Containers\AppSection\User\Schemas;

/**
 * @OA\Schema(
 *     schema="RespondWithToken",
 *     type="object",
 *     title="Respond with token",
 *     description="Respond with token object",
 *     @OA\Property(property="access_token", type="string", example="some_token"),
 *     @OA\Property(property="token_type", type="string", example="bearer"),
 *     @OA\Property(property="expires_in", type="integer", example="3600"),
 * )
 */
class RespondWithTokenSchema {}
