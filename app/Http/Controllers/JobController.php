<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\Job;
use App\Models\Notification;
use App\Models\User;
use App\Models\File;
use App\Models\TimelineEvent;
use App\Models\Message;

//use App\Events\NotificationEvent;
use App\Events\JobPusherEvent;
use App\Events\TimelinePusherEvent;


class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
      if($id == 0){
        $jobs = Job::all();
      }
      else{
        $jobs = User::find($id)->is_technician ? Job::where('technician_id', $id)->get() : Job::where('client_id', $id)->get();   
      }

      foreach($jobs as $job){
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
      $newJob->save();
      
      $newTimelineEvent = new TimelineEvent;
      $newTimelineEvent->job_id = $newJob->id;
      $newTimelineEvent->type = "status";
      $newTimelineEvent->data = "new";
      $newTimelineEvent->save();
      
      if(isset($request->uploadedFiles)){
        foreach($request->uploadedFiles as $file){
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
      $job->status_alert = true;  //Notify the client
      $job->save();
      
      $newTimelineEvent = new TimelineEvent;
      $newTimelineEvent->job_id = $job->id;
      $newTimelineEvent->type = "status";
      $newTimelineEvent->data = $request->status;
      $newTimelineEvent->notify_user = true;
      $newTimelineEvent->save();
      
      broadcast(new JobPusherEvent($job, $job->client_id))->toOthers();
      broadcast(new TimelinePusherEvent($newTimelineEvent, $job->client_id))->toOthers();
      broadcast(new TimelinePusherEvent($newTimelineEvent, $job->technician_id))->toOthers();

        
        /*if($job->status_alert == false){
            $job->status_alert = true;
            $doIncrement = true;
        }
        else{
            $doIncrement = false;
        }
        
        
        $notification = Notification::firstOrNew(['type' => 'job', 'user_id' => $job->client_id]);
        if(isset($notification->id)){//Entry exists
            if($doIncrement){
                $notification->increment('count');
            }
        }
        else{//New entry
            $notification->user_id = $job->client_id;
            $notification->type_id = 0;
            $notification->count = 1;
        }

        $notification->text = "$notification->count Commandes ont été modifiées";
        $notification->save();*/
        //$job->save();

        //broadcast(new NotificationEvent($notification))->toOthers();
        //broadcast(new JobEvent($job, $job->client_id))->toOthers();
        
      
      return $job;
    }

    public function updateStatusAlert(Request $request, $id)
    {
      $job = Job::find($id);
      $job->status_alert = false;
      $job->save();

      $timelineEvents = TimelineEvent::where('job_id', $job->id)->get();
      foreach($timelineEvents as $event){
        $event->notify_user = false;
        $event->save();
      }
      
      return $job;
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
