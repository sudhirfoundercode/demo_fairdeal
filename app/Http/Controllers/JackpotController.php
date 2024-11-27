<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jackpot;

class JackpotController extends Controller
{
    // public function update(Request $request)
    // {
        
    //     $jackpot_duration=$request->jackpot_duration;
    //     $jackpot_count=$request->jackpot_count;
    //     $active_jackpot=$request->active_jackpot;
    //     dd($active_jackpot);
    //     // Find the first record (or create it if it doesn't exist)
    //     $bonusSetting = Jackpot::firstOrCreate([], [
    //         'jackpot_duration' => $jackpot_duration,
    //         'jackpot_count' => $jackpot_count,
    //         'jackpot_left' => $jackpot_count,
    //         'active_jackpot' => [],
    //     ]);

    //     // Update with new data
    //     $bonusSetting->update($validated);

    //     return back()->with('success', 'Bonus settings updated successfully!');
    // }
    
    public function update(Request $request)
    {
        // Input data ko fetch karte hain
        $jackpot_duration = $request->jackpot_duration;
        $jackpot_count = $request->jackpot_count;
        $active_jackpot = $request->active_jackpot; // Ye active_jackpot ko request se lenge
        
        // Debugging - dd() se check karte hain
        //dd($active_jackpot);

        // Yahan pe jackpot table ko find ya create karenge agar pehle se nahi hai
        $bonusSetting = Jackpot::firstOrCreate([], [
            'jackpot_duration' => $jackpot_duration,
            'jackpot_count' => $jackpot_count,
            'jackpot_left' => $jackpot_count,
            'active_jackpot' => json_encode($active_jackpot), // Convert to JSON string if needed
        ]);
        

        // Update data ko validate karte hain
        $validated = $request->validate([
            'jackpot_duration' => 'required|integer',
            'jackpot_count' => 'required|integer',
            'active_jackpot' => 'required|array', // Active jackpot ko array hona chahiye
        ]);

        // Update the record
        $bonusSetting->update([
            'jackpot_duration' => $validated['jackpot_duration'],
            'jackpot_count' => $validated['jackpot_count'],
            'jackpot_left' =>  $validated['jackpot_count'],
            'active_jackpot' => json_encode($validated['active_jackpot']), // Store active_jackpot as JSON
        ]);

        // Success message and redirect
        return back()->with('success', 'Bonus settings updated successfully!');
    }

}
