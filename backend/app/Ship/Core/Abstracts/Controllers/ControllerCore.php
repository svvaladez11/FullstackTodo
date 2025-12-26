<?php

namespace App\Ship\Core\Abstracts\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

abstract class ControllerCore extends Controller
{
    use AuthorizesRequests;
    use ValidatesRequests;
}
