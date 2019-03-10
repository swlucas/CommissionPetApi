<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttendanceService extends Model
{
    use SoftDeletes;
    protected $table = "attendance_service";
    protected $fillable = ['attendance_id', 'service_id'];

}
