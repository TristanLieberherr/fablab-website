<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimelineEvent extends Model
{
    use HasFactory;
    protected $fillable = [
      'job_id',
      'type',
      'data',
      'notify_client',
      'notify_technician'
  ];
}
