<?php

namespace App\Http\Controllers;

use App\Models\Prayer;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Auth;
class MainController extends Controller
{
    // index function

    public function index(){
        $users = User::where('role_id', 1)->get();
        return view('index', compact('users'));
    }

    public function profile(){
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function saveProfile(Request $request){
        
        $request->validate([ 
            'name' => ['required', 'string', 'max:255'],  
            'password' => ['required_if:password_change,==,yes', 'nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $Payloads = [
            'name' => $request->name,  
            'phone_number' => $request->phone_number 
        ];

        if($request->password_change==='yes'){
            $Payloads['password'] = Hash::make($request->password);
        }

        User::where('id', Auth::user()->id)->update($Payloads);

        return redirect()->back()->with('success', 'Imam Has Been Updated Successfully.');  
    }

    public function ircCalendar(){
        return view('irc-calendar');
    } 
 
}
