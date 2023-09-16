<?php

namespace Database\Seeders;

use App\Models\Prayer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prayers = array(
            array(
                "name" => "FAJR",
                "icon" => "images/icon-fajr.svg"
            ),
            array(
                "name" => "DHUHR",
                "icon" => "images/icon-dhuhr.svg"
            ),
            array(
                "name" => "ASR",
                "icon" => "images/icon-asr.svg"
            ),
            array(
                "name" => "MAGHRIB",
                "icon" => "images/icon-maghrib.svg"
            ),
            array(
                "name" => "ISHA",
                "icon" => "images/icon-isha.svg"
            ),
            array(
                "name" => "JUMMA",
                "icon" => "images/icon-dhuhr.svg"
            ),
        );
        
        Prayer::insert($prayers);
    }
}
