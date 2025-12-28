<?php

use App\Containers\AppSection\User\UI\API\Controllers\RegisterUserController;
use Illuminate\Support\Facades\Route;

Route::post('v1/users', RegisterUserController::class);
