<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\Job;
use App\Models\User;
use App\Models\File;
use App\Models\TimelineEvent;
use App\Models\Message;

use App\Events\JobPusherEvent;


class JobController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index($id)
  {
    if ($id == 0) {
      $jobs = Job::where('technician_id', null)->get();
    } else {
      $jobs = User::find($id)->is_technician ? Job::where('technician_id', $id)->get() : Job::where('client_id', $id)->get();
    }

    foreach ($jobs as $job) {
      $job->files = File::where('job_id', $job->id)->get();
      $job->timeline = TimelineEvent::where('job_id', $job->id)->get();
      $job->messages = Message::where('job_id', $job->id)->get();
    }
    return $jobs;
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $newJob = new Job;
    $newJob->client_id = $request->client_id;
    $newJob->job_type = $request->job_type;
    $newJob->deadline = $request->deadline;
    $newJob->description = $request->description;
    $newJob->save();
    $newJob = Job::find($newJob->id);

    $newTimelineEvent = new TimelineEvent;
    $newTimelineEvent->job_id = $newJob->id;
    $newTimelineEvent->type = "status";
    $newTimelineEvent->data = "new";
    $newTimelineEvent->save();

    if (isset($request->uploadedFiles)) {
      foreach ($request->uploadedFiles as $file) {
        $newFile = new File;
        $newFile->hashed_name = hash_file('sha256', $file);
        $newFile->name = $file->getClientOriginalName();
        $newFile->job_id = $newJob->id;
        $newFile->save();
        $file->storeAs('FileStorage', hash_file('sha256', $file));

        $newTimelineEvent = new TimelineEvent;
        $newTimelineEvent->job_id = $newJob->id;
        $newTimelineEvent->type = "file";
        $newTimelineEvent->data = $newFile->name;
        $newTimelineEvent->save();
      }
    }

    broadcast(new JobPusherEvent($newJob, 0))->toOthers();
    $newJob->files = File::where('job_id', $newJob->id)->get();
    $newJob->timeline = TimelineEvent::where('job_id', $newJob->id)->get();
    $newJob->messages = [];
    return $newJob;
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function updateStatus(Request $request, $id) //Accessible only by the technician
  {
    $job = Job::find($id);
    $job->status = $request->status;
    $job->notify_technician = false;
    $job->notify_client = true;
    $job->save();
    $job = Job::find($job->id);

    $newTimelineEvent = new TimelineEvent;
    $newTimelineEvent->job_id = $job->id;
    $newTimelineEvent->type = "status";
    $newTimelineEvent->data = $request->status;
    $newTimelineEvent->notify_technician = false;
    $newTimelineEvent->notify_client = true;
    $newTimelineEvent->save();
    $newTimelineEvent = TimelineEVent::find($newTimelineEvent->id);

    $timeline = array($newTimelineEvent);
    $job->timeline = $timeline;
    broadcast(new JobPusherEvent($job, $job->client_id))->toOthers();
    return $job;
  }

  public function updateNotify(Request $request, $id)
  {
    $job = Job::find($id);
    $request->user()->is_technician ? $job->notify_technician = false : $job->notify_client = false;
    $job->save();
    $job = Job::find($job->id);

    $timelineEvents = TimelineEvent::where('job_id', $job->id)->get();
    foreach ($timelineEvents as $event) {
      $request->user()->is_technician ? $event->notify_technician = false : $event->notify_client = false;
      $event->save();
    }
    $messages = Message::where('job_id', $job->id)->where('recipient_id', $request->user()->id)->get();
    foreach ($messages as $message) {
      $message->notify = false;
      $message->save();
    }

    return $job;
  }

  public function assign(Request $request)
  { 
    $jobArray = array();
    foreach ($request->idArray as $id) {
      $job = Job::find($id);
      if(is_null($job->technician_id)){
        $job->technician_id = $request->user()->id;
        $job->status = "assigned";
        $job->notify_technician = true;
        $job->notify_client = true;
        $job->save();
        $job = Job::find($job->id);
    
        $newTimelineEvent = new TimelineEvent;
        $newTimelineEvent->job_id = $job->id;
        $newTimelineEvent->type = "status";
        $newTimelineEvent->data = $job->status;
        $newTimelineEvent->notify_technician = true;
        $newTimelineEvent->notify_client = true;
        $newTimelineEvent->save();
        $newTimelineEvent = TimelineEvent::find($newTimelineEvent->id);
  
        broadcast(new JobPusherEvent($job, 0))->toOthers();
        $job->timeline = array($newTimelineEvent);
        broadcast(new JobPusherEvent($job, $job->client_id))->toOthers();
        array_push($jobArray, $job);
      }
    }

    
    foreach ($jobArray as $job){
      $job->files = File::where('job_id', $job->id)->get();
      $job->timeline = TimelineEvent::where('job_id', $job->id)->get();
      $job->messages = [];
    }
    return $jobArray;
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $job = Job::find($id);
    $job->delete();
    return $id;
  }
}
