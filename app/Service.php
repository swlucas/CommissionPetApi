<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{

    use SoftDeletes;
    protected $fillable = ['user_id', 'name', 'percentage'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
