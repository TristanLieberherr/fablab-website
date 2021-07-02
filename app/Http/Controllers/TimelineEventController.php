<?php

namespace App\Http\Controllers;

use App\Models\TimelineEvent;
use Illuminate\Http\Request;


class TimelineEventController extends Controller
{
  public function store(Request $request)
  {
    $newTimelineEvent = new TimelineEvent;
    $newTimelineEvent->job_id = $request->job_id;
    $newTimelineEvent->type = $request->type;
    $newTimelineEvent->save();
    return $newTimelineEvent;
  }
}
