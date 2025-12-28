<?php

namespace App\Ship\Core\Abstracts\Actions;

/**
 * @psalm-type Response array{
 *     success: bool,
 *     data: array|object,
 *     message: string,
 *     errors: array,
 * }
 */
abstract class ActionCore
{
    protected function respondSuccess(array|object $data, string $message = ''): array {
        return [
            'success' => true,
            'data' => $data,
            'message' => $message,
            'errors' => []
        ];
    }
    protected function respondError(string $message, array $errors = []): array {
        return [
            'success' => false,
            'data' => [],
            'message' => $message,
            'errors' => $errors
        ];
    }
}
