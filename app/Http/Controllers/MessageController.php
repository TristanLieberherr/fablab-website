<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Notification;
use App\Models\Job;
use App\Models\User;
use App\Models\TimelineEvent;

use App\Events\MessagePusherEvent;


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
      $job = Job::find($request->job_id);
      $request->user()->is_technician ? $job->notify_client = true : $job->notify_technician = true;
      $job->save();

      $newMessage = new Message;
      $newMessage->sender_id = $request->user()->id;
      $newMessage->recipient_id = $request->user()->is_technician ? $job->client_id : $job->technician_id;
      $newMessage->job_id = $request->job_id;
      $newMessage->text = $request->text;
      $newMessage->save();
      $newMessage = Message::find($newMessage->id);
      
      broadcast(new MessagePusherEvent($newMessage))->toOthers();
      
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
