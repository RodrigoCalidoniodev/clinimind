<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hour extends Model
{
    //

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
