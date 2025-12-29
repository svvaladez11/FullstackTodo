<?php

namespace App\Swagger\Main\Schemas;

/**
 * @OA\Schema(
 *     schema="ErrorResponse",
 *     type="object",
 *     @OA\Property(property="success", type="boolean", example=false),
 *     @OA\Property(property="data", type="object"),
 *     @OA\Property(property="message", type="string", example="Operation failed."),
 *     @OA\Property(property="errors", type="array", @OA\Items())
 * )
 */
class ErrorResponse {}
