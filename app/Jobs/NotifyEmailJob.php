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
use App\Models\Message;
use App\Models\TimelineEvent;

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
    $jobs = Job::where($user_type.'_id', $this->userID)->where('notify_'.$user_type, true);

    if($jobs->count() > 0){
      $IDs = $jobs->pluck('id');
      $is_new_status = TimelineEvent::whereIn('job_id', $IDs)->where('type', 'status')->where('notify_'.$user_type, true)->count() > 0;
      $is_new_files = TimelineEvent::whereIn('job_id', $IDs)->where('type', 'file')->where('notify_'.$user_type, true)->count() > 0;
      $is_new_messages = Message::whereIn('job_id', $IDs)->where('recipient_id', $this->userID)->where('notify', true)->count() > 0;
      
      if($user->notify_email_status && $is_new_status || $user->notify_email_files && $is_new_files || $user->notify_email_messages && $is_new_messages){
        Mail::to("$user->email@gmail.com")->send(new NotifyEmail($this->userID));
      }
    }
  }
}
