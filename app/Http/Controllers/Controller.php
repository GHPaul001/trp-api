<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Laravel\Passport\HasApiTokens;
use App\Http\Traits\ResponseTrait;
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests,HasApiTokens,ResponseTrait;
}
