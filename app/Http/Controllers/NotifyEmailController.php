<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyEmail;
use App\Jobs\NotifyEmailJob;


class NotifyEmailController extends Controller
{
  public function dispatchMailJob($id)
  {
    //NotifyEmailJob::dispatch($id)->delay(now()->addMinutes(1));
    NotifyEmailJob::dispatch($id)->delay(now()->addSeconds(10));
  }
}
