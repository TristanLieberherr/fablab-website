<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\File;
use App\Models\Job;
use App\Models\TimelineEvent;

use App\Events\JobPusherEvent;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
      $job = Job::find($request->job_id);
      $job->notify_technician = true;
      $job->notify_client = true;
      $job->save();
      $tempFiles = Array();
      $tempTimeline = Array();

      foreach($request->uploadedFiles as $file){
        $newFile = new File;
        $newFile->hashed_name = hash_file('sha256', $file);
        $newFile->name = $file->getClientOriginalName();
        $newFile->job_id = $request->job_id;
        $newFile->save();
        $newFile = File::find($newFile->id);
        $tempFiles[] = $newFile;
        $file->storeAs('FileStorage', hash_file('sha256', $file));
        
        $newTimelineEvent = new TimelineEvent;
        $newTimelineEvent->job_id = $newFile->job_id;
        $newTimelineEvent->type = "file";
        $newTimelineEvent->data = $newFile->name;
        $newTimelineEvent->save();
        $newTimelineEvent = TimelineEvent::find($newTimelineEvent->id);
        $tempTimeline[] = $newTimelineEvent;
      }

      $job = Job::find($job->id);
      $job->files = $tempFiles;
      $job->timeline = $tempTimeline;

      broadcast(new JobPusherEvent($job, $request->user()->is_technician ? $job->client_id : $job->technician_id))->toOthers();
      return $job;
    }

    public function download($id)
    {
      $file = File::find($id);
      return Storage::download("FileStorage/$file->hashed_name", $file->name);
    }
}
