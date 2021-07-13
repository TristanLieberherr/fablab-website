<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
  public function login(Request $request)
  {
    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)){
      return Auth::user();
    }
    return abort(403);
  }

  public function logout(Request $request)
  {
    Auth::logout();
  }

  public function updateSettings(Request $request)//Called when a user has changed some settings
  {//input : {fields : [{name : the name of the column (e.g "notify_email_status"), value : the new boolean value}]}
    $user = $request->user();
    $fields = $request->fields;
    foreach($fields as $field){
      $user[$field["name"]] = $field["value"];
    }
    $user->save();
    
    return $user;
  }//return : the user
}
