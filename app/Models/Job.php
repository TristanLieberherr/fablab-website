<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
  use HasFactory;
  protected $fillable = [
    'client_id',
    'technician_id',
    'job_type',
    'description',
    'status',
    'deadline',
    'notify_client',
    'notify_technician'
  ];
}
