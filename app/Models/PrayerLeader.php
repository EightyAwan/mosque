<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrayerLeader extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'prayer_id',
        'prayer_date'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
