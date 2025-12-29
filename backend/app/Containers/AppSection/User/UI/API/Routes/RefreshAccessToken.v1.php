<?php

use App\Containers\AppSection\User\UI\API\Controllers\RefreshAccessTokenController;
use Illuminate\Support\Facades\Route;

Route::post('v1/users/refresh', RefreshAccessTokenController::class);
