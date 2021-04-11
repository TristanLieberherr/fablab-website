<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Notification;
use App\Models\Job;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return Message::where('job_id', $id)->get();
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
        $newMessage = new Message;
        $newMessage->user_id = $request->message['user_id'];
        $newMessage->job_id = $request->message['job_id'];
        $newMessage->text = $request->message['text'];
        $newMessage->date = $request->message['date'];
        $newMessage->save();

        $notification = new Notification;
        error_log("Job ID:$newMessage->job_id");
        $job = Job::find($newMessage->job_id);
        if($newMessage->user_id == $job->client_id){
            $notification->user_id = $job->technician_id;
        }
        elseif($newMessage->user_id == $job->technician_id){
            $notification->user_id = $job->client_id;
        }
        $notification->text = "Vous avez reçu de nouveaux messages";
        $notification->url = "applications/chat/$job->id";
        $notification->save();
        
        return $newMessage;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
