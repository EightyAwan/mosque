<?php 

use App\Models\User;

class Helper {
    static function getImams(){
        return User::where('role_id', 1)
        ->get();
    }
}