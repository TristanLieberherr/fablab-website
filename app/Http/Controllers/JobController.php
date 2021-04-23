<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Notification;
use App\Models\User;
use App\Models\File;
use App\Events\NotificationEvent;
use App\Events\JobEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        $newJob->deadline_date = $request->deadline_date;
        $newJob->status = "NEW";
        $newJob->save();
        
        foreach($request->uploadedFiles as $file){  //Moyen d'utiliser FileController et de passer $request? Héritage?
          $newFile = new File;
          $newFile->hashed_name = hash_file('sha256', $file);
          $newFile->name = $file->getClientOriginalName();
          $newFile->extension = $file->getClientOriginalExtension();
          $newFile->job_id = $newJob->id;
          $newFile->save();
          $file->storeAs('FileStorage', hash_file('sha256', $file));
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
    public function update(Request $request, $id)
    {
        $job = Job::find($id);
        if(isset($request->new_status)){
            $job->status = $request->new_status;
            if($job->status_alert == false){
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
                $notification->url = "";
                $notification->type_id = 0;
                $notification->count = 1;
            }

            $notification->text = "$notification->count Commandes ont été modifiées";
            $notification->save();
            $job->save();

            broadcast(new NotificationEvent($notification))->toOthers();
            broadcast(new JobEvent($job, $job->client_id))->toOthers();
        }
        if(isset($request->status_alert)){
            $job->status_alert = $request->status_alert;
            $job->save();
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