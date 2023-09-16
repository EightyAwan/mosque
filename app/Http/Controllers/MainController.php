<?php

namespace App\Http\Controllers;

use App\Models\Prayer;
use Illuminate\Http\Request;

class MainController extends Controller
{
    // index function

    public function index(){
        return view('index');
    }
 
}
