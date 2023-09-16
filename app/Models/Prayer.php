<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prayer extends Model
{
    use HasFactory;

    public function prayerLeader(){
        return $this->hasOne(PrayerLeader::class);
    }
}
