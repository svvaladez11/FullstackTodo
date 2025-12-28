<?php

use App\Containers\AppSection\User\UI\API\Controllers\LogoutUserController;
use Illuminate\Support\Facades\Route;

Route::post('v1/users/logout', LogoutUserController::class);
