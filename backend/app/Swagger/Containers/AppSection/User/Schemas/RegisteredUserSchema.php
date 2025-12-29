<?php

namespace App\Swagger\Containers\AppSection\User\Schemas;

/**
 * @OA\Schema(
 *     schema="RegisteredUser",
 *     type="object",
 *     title="Registered User",
 *     description="Registered user object",
 *     @OA\Property(property="id", type="string", example="1"),
 *     @OA\Property(property="login", type="string", example="john_doe"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-01-01T12:00:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-01-01T12:00:00Z"),
 *     @OA\Property(property="deleted_at", type="string", format="date-time", nullable=true, example=null)
 * )
 */
class RegisteredUserSchema {}
