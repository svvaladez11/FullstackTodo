<?php

use App\Containers\AppSection\User\UI\API\Controllers\LoginUserController;
use Illuminate\Support\Facades\Route;

Route::post('v1/users/login', LoginUserController::class);
