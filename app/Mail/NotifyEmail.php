<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\Job;
use App\Models\User;
use App\Models\File;
use App\Models\TimelineEvent;
use App\Models\Message;

class NotifyEmail extends Mailable
{
  use Queueable, SerializesModels;

  public $jobs;
  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct()
  {
    
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    $this->jobs = Job::where('client_id', 1)->get();
    return $this->view('mails/email');
  }
}
