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
  public $jobTypeTextFormatter = array("drilling"=>"de perçage", "milling"=>"de fraisage CNC", "3Dprinting"=>"d'impression 3D", "engraving"=>"de gravure laser");
  public $jobStatusColorFormatter = array("new"=>"#E0E0E0", "assigned"=>"#B3E5FC", "ongoing"=>"#03A9F4", "on-hold"=>"#F44336", "completed"=>"#4CAF50");
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
      $job->new_status_event = TimelineEvent::where('job_id', $job->id)->where('type', 'status')->where('notify_'.$user_type, true)->orderBy('created_at', 'desc')->first();
      $job->new_files_count = TimelineEvent::where('job_id', $job->id)->where('type', 'file')->where('notify_'.$user_type, true)->count();
      $job->new_messages_count = Message::where('job_id', $job->id)->where('recipient_id', $this->userID)->where('notify', true)->count();
      $job->interlocutor = $user->is_technician ? User::find($job->client_id) : User::find($job->technician_id);
    }

    return $this->view('mails/email');
  }
}
