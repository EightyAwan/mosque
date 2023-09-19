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
        return view('index');
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
            'address' => $request->address,
            'phone_number' => $request->phone_number 
        ];

        if($request->password_change==='yes'){
            $Payloads['password'] = Hash::make($request->password);
        }

        User::where('id', Auth::user()->id)->update($Payloads);

        return redirect()->back()->with('success', 'Imam Has Been Updated Successfully.');  
    }
 
}
