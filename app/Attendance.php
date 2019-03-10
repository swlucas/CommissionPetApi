<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Attendance extends Model
{
    use SoftDeletes;
    protected $fillable = ['user_id', 'animal_id', 'amount', 'earnings'];

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

    public function service()
    {
        return $this->belongsToMany(Service::class)->withPivot('value', 'gain');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
