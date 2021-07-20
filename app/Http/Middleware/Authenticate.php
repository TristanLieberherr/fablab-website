<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use App\Models\User;

class Authenticate extends Middleware
{
  protected function redirectTo($request)
  {
    return route("welcome");
  }
}