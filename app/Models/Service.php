<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //

    public function getTranslatedName()
    {
        $locale = app()->getLocale();
        return $locale === 'en' ? $this->name_en : $this->name_es;
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
