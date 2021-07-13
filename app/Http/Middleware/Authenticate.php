<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use App\Models\User;

class Authenticate extends Middleware
{
  protected function redirectTo($request)
  {
    //return abort(403);
    if(isset($_SERVER['Shib-Identity-Provider'])){
      $user = User::firstOrCreate(['email' => $_SERVER['mail'], 'name' => $_SERVER['givenName'], 'surname' => $_SERVER['surname']]);
      \Auth::loginUsingId($user->id);
    }
    else{
      return "https://tb21-lieberherr.heig-vd.ch/Shibboleth.sso/Login?entityID=https%3A%2F%2Faai-logon.hes-so.ch%2Fidp%2Fshibboleth&target=https%3A%2F%2Ftb21-lieberherr.heig-vd.ch%2F";
    }
  }
}
