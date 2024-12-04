<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    public function transfer_index(){
        return view('transfer.index');
    }
    
     public function getBalance($username)
    {
        $user = DB::table('users')->where('username', $username)->first();

        if ($user) {
            return response()->json(['balance' => $user->wallet]);
        }

        return response()->json(['balance' => 0]); // Default if user not found
    }
    
    public function Player_transfer_amount(Request $request)
{
   
    
    // Retrieve wallet amount from the request
    $walletAmount = $request->amount;
    
     $username = $request->username;
     
     
$parent_id = DB::select("SELECT id,parent_id FROM `users` WHERE `username` = '{$username}'");
   $parent=$parent_id[0]->parent_id;
   $id=$parent_id[0]->id;
    
    $updated = DB::table('users')
        ->where('id', $parent)
        ->decrement('wallet', $walletAmount);
    // if ($walletAmount <= 0) {
    //     return redirect()->back()->with('error', 'Invalid wallet amount.');
    // }

    // Update wallet and related fields in the 'users' table
    $updated = DB::table('users')
        ->where('id', $id)
        ->increment('wallet', $walletAmount);

    if ($updated) {
       
        return redirect()->back()->with('success', 'Amount Transfer successfully!');
    } else {
        return redirect()->back()->with('error', 'Failed to update wallet.');
    }
}

 public function Agent_transfer_amount(Request $request)
{
   
    
    // Retrieve wallet amount from the request
    $walletAmount = $request->amount;
    
     $username = $request->username;
     
     
$parent_id = DB::select("SELECT id,parent_id FROM `users` WHERE `username` = '{$username}'");
   $parent=$parent_id[0]->parent_id;
   $id=$parent_id[0]->id;
    
    $updated = DB::table('users')
        ->where('id', $parent)
        ->decrement('wallet', $walletAmount);
    // if ($walletAmount <= 0) {
    //     return redirect()->back()->with('error', 'Invalid wallet amount.');
    // }

    // Update wallet and related fields in the 'users' table
    $updated = DB::table('users')
        ->where('id', $id)
        ->increment('wallet', $walletAmount);

    if ($updated) {
       
        return redirect()->back()->with('success', 'Amount Transfer successfully!');
    } else {
        return redirect()->back()->with('error', 'Failed to update wallet.');
    }
}
}
