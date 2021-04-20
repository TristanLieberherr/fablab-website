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
        $newMessage->user_id = $request->user_id;
        $newMessage->job_id = $request->job_id;
        $newMessage->text = $request->text;
        $newMessage->save();

        $job = Job::find($newMessage->job_id);
        /*if($newMessage->user_id == $job->client_id){      //Pour le dev, $id = $newMessage->user_id
            $id = $job->technician_id;
        }
        elseif($newMessage->user_id == $job->technician_id){
            $id = $job->client_id;
        }*/
        $id = $newMessage->user_id;

        error_log("New message from user $newMessage->user_id, notification to user $id");
        $notification = Notification::firstOrNew(['type' => 'message', 'user_id' => $id, 'type_id' => $newMessage->job_id]);
        if(isset($notification->id)){//Entry exists
            $notification->increment('count');
        }
        else{
            $notification->url = "";
            $notification->count = 1;
        }
        
        $notification->text = "A.Ventura : $notification->count nouveaux messages";
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
