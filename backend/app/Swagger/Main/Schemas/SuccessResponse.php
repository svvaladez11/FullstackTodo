<?php

namespace App\Swagger\Main\Schemas;

/**
 * @OA\Schema(
 *     schema="SuccessResponse",
 *     type="object",
 *     @OA\Property(property="success", type="boolean", example=true),
 *     @OA\Property(property="data", type="object"),
 *     @OA\Property(property="message", type="string", example="Operation successful."),
 *     @OA\Property(property="errors", type="array", @OA\Items())
 * )
 */
class SuccessResponse {}
