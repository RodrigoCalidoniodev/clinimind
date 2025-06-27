<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    //

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function hour()
    {
        return $this->belongsTo(Hour::class);
    }
}
