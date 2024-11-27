<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Illuminate\Support\Str;

class PlayerController extends Controller
{
    public function player_index(){
        $users = User::where('role_id', 5)->get();
        return view('players.index')->with('user',$users);
    }

    // public function PlayerStore(Request $request){

    //     $validated=$request->validate([
    //         'email'=>'required',
    //         'password'=>'required',
    //         'name'=>'required',
    //     ]);
    //     $store = array(
    //         'email'=>$request->email,
    //         'password'=>$request->password,
    //         'name'=>$request->name,
    //         'role_id'=>5
    //     );

    //     $users = User::create($store);
    //     return redirect()->back()->with('success', 'User created successfully!');
    // }
    
public function PlayerStore(Request $request)
    {
        // $request->validate([
        //      'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        //     'password' => ['required'],
           
        // ]);
        
 

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>$request->password,
            'role_id' => 5,
            'username' => Str::upper(Str::random(5)),
        ]);

        //event(new Registered($user));

        // Auth::login($user);

         return redirect()->back()->with('success', 'User created successfully!');
    }

public function wallet_store(Request $request, $id)
{
   
    
    // Retrieve wallet amount from the request
    $walletAmount = $request->wallet;
    
    if ($walletAmount <= 0) {
        return redirect()->back()->with('error', 'Invalid wallet amount.');
    }

    // Update wallet and related fields in the 'users' table
    $updated = DB::table('users')
        ->where('id', $id)
        ->increment('wallet', $walletAmount);

    if ($updated) {
       
        return redirect()->back()->with('success', 'Amount added successfully!');
    } else {
        return redirect()->back()->with('error', 'Failed to update wallet.');
    }
}

public function wallet_subtract(Request $request, $id)
{
  

    // Retrieve the amount to subtract
    $amountToSubtract = $request->wallet;
    
    if ($amountToSubtract <= 0) {
        return redirect()->back()->with('error', 'Invalid amount to subtract.');
    }

    // Retrieve user from the database
    $user = DB::table('users')->where('id', $id)->first();
    
    if (!$user) {
        return redirect()->back()->with('error', 'User not found.');
    }

    // Check if the wallet balance is sufficient
    if ($user->wallet < $amountToSubtract) {
        return redirect()->back()->with('error', 'Insufficient wallet balance.');
    }

    // Perform the wallet update (subtract the amount)
    $updated = DB::table('users')
        ->where('id', $id)
        ->decrement('wallet', $amountToSubtract);
    
    if ($updated) {
        return redirect()->back()->with('success', 'Amount subtracted successfully!');
    } else {
        return redirect()->back()->with('error', 'Failed to subtract from wallet.');
    }
}

    
}
