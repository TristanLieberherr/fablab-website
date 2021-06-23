<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

use App\Mail\NotifyEmail;
use App\Models\Job;
use App\Models\User;

class NotifyEmailJob implements ShouldQueue, ShouldBeUnique
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  public $userID;
  public $uniqueId;
  /**
   * Create a new job instance.
   *
   * @return void
   */
  public function __construct($id)
  {
    $this->userID = $id;
    $this->uniqueId = $id;
  }

  /**
   * Execute the job.
   *
   * @return void
   */
  public function handle()
  {
    $user = User::find($this->userID);
    $user_type = $user->is_technician ? 'technician' : 'client';

    if(Job::where($user_type.'_id', $this->userID)->where('notify_'.$user_type, true)->count() > 0){
      Mail::to("tristan.lieberherr@heig-vd.ch")->send(new NotifyEmail($this->userID));
    }
  }
}
