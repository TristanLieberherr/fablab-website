<?php

namespace App\Http\Controllers;

use App\Models\TimelineEvent;
use Illuminate\Http\Request;

class TimelineEventController extends Controller
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
      $newTimelineEvent = new TimelineEvent;
      $newTimelineEvent->job_id = $request->job_id;
      $newTimelineEvent->type = $request->type;
      $newTimelineEvent->save();
      return $newTimelineEvent;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TimelineEvent  $timelineEvent
     * @return \Illuminate\Http\Response
     */
    public function show(TimelineEvent $timelineEvent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TimelineEvent  $timelineEvent
     * @return \Illuminate\Http\Response
     */
    public function edit(TimelineEvent $timelineEvent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TimelineEvent  $timelineEvent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TimelineEvent $timelineEvent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TimelineEvent  $timelineEvent
     * @return \Illuminate\Http\Response
     */
    public function destroy(TimelineEvent $timelineEvent)
    {
        //
    }
}
