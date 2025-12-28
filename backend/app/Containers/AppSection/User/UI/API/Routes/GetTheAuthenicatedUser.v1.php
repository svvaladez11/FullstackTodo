<?php

use App\Containers\AppSection\User\UI\API\Controllers\GetTheAuthenticatedUserController;
use Illuminate\Support\Facades\Route;

Route::post('v1/users/me', GetTheAuthenticatedUserController::class);
