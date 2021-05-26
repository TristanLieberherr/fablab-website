<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Mail\NotifyEmail;

class NotifyEmailController extends Controller
{
  public function send(Request $request)
  {
    //Mail::to('test@example.com')->later(now()->addMinutes(1), new NotifyEmail);
    Mail::to('test@example.com')->send(new NotifyEmail);
  }
}
