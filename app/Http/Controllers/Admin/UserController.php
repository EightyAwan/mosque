<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role_id', 1)
        ->paginate(10);

        return view('dashboard.imam.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('dashboard.imam.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([ 
            'name' => ['required', 'string', 'max:255'],
            'color' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'is_irc' => 'in:no,yes',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);  

        User::create([
        'name' => $request->name,
        'email' => $request->email,
        'address' => $request->address,
        'phone_number' => $request->phone_number,
        'color' => $request->color,
        'role_id' => 1,
        'is_irc_imam' => $request->is_irc,
        'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Imam Has Been Added Successfully.');  

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        return view('dashboard.imam.edit', compact('user')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([ 
            'name' => ['required', 'string', 'max:255'],
            'is_irc' => 'in:no,yes',  
            'password' => ['required_if:password_change,==,yes', 'nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $Payloads = [
            'name' => $request->name,  
            'phone_number' => $request->phone_number, 
            'color' => $request->color,
            'is_irc_imam' => $request->is_irc
        ];

        if($request->password_change==='yes'){
            $Payloads['password'] = Hash::make($request->password);
        }

        User::where('id', $id)->update($Payloads);

        return redirect()->back()->with('success', 'Imam Has Been Updated Successfully.');  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            $user = User::find($id);
            $user->delete();
            return redirect()->back()->with('success', 'Imam Has Been Deleted Successfully.');

        }catch (Exception $e){
            return redirect()->back()->with('error', 'Something went wrong.');  
        }
    }
 
}
