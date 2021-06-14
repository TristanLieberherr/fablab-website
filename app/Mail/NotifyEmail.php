<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\Job;
use App\Models\User;
use App\Models\File;
use App\Models\TimelineEvent;
use App\Models\Message;

class NotifyEmail extends Mailable
{
  use SerializesModels;

  public $jobs;
  public $userID;
  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct($id)
  {
    $this->userID = $id;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    $user = User::find($this->userID);
    $user_type = $user->is_technician ? 'technician' : 'client';

    $this->jobs = Job::where($user_type.'_id', $this->userID)->where('notify_'.$user_type, true)->get();
    foreach($this->jobs as $job){
      $job->new_status_event = TimelineEvent::where('job_id', $job->id)->where('notify_'.$user_type, true)->where('type', 'status')->orderBy('created_at', 'desc')->first();
      $job->new_files_event = TimelineEvent::where('job_id', $job->id)->where('notify_'.$user_type, true)->where('type', 'file')->get();
      $job->new_messages_count = Message::where('job_id', $job->id)->where('recipient_id', $user->is_technician ? $job->technician_id : $job->client_id)->where('notify', true)->count();
    }

    return $this->view('mails/email');
  }
}
