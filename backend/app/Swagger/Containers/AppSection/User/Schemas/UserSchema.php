<?php

namespace App\Swagger\Containers\AppSection\User\Schemas;

/**
 * @OA\Schema(
 *     schema="User",
 *     type="object",
 *     title="User",
 *     description="Authenticated user object",
 *     @OA\Property(property="id", type="string", example="1"),
 *     @OA\Property(property="login", type="string", example="john_doe"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-01-01T12:00:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-01-01T12:00:00Z"),
 * )
 */
class UserSchema {}
