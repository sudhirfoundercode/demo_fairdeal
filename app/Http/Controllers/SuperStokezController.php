<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;
class SuperStokezController extends Controller
{
    public function super_stokez_index(){
    $users = User::where('role_id', 2)->get();

    return view('super_stokez.index')->with('users', $users);
}

    public function SuperStokezStore(Request $request)
{

    $validated = $request->validate([
        'email' => 'required',
        'password' => 'required',
        'name' => 'required',
        'revenue' => 'required',
    ]);

    $data = array(
        'email' => $request->email,
        'password' => $request->password,
        'name' => $request->name,
        'revenue' => $request->revenue,
        'role_id' => 2, // Ensure this field is included
    );
    

    $users = User::create($data);
    

    return redirect()->back()->with('success', 'User created successfully!');
}

 public function SuperStokez_update(Request $request, $id)
      {
          
        $name=$request->name;
         $email=$request->email;
         $password=$request->password;
         $revenue=$request->revenue;
       
        $data= DB::update("UPDATE `users` SET `name`='$name',`email`='$email',`password`='$password',`revenue`='$revenue' WHERE id=$id");
         
              return redirect()->back()->with('success', 'User updated successfully!');
            
       
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
