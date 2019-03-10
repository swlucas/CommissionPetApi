<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Animal extends Model
{
    use SoftDeletes;
    protected $fillable = ['user_id', 'name', 'species', 'gender', 'breed', 'fur', 'weight', 'age', 'owner','image'];

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
