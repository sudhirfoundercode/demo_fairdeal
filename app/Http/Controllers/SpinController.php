<?php

namespace App\Http\Controllers;

use App\Models\{Spin,Jackpot,JackpotMultiplier};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpinController extends Controller
{
    
    public function adminresults(){
        $records = DB::table('fun_admin_result')->paginate(10);
        return view('spin.adminresults', compact('records'));
    }
    
    public function bets(){
        $records = DB::table('fun_bets')->paginate(10);
        return view('spin.bets', compact('records'));
    }
    
    
    public function results(){
        $records = DB::table('fun_results')->paginate(10);
        return view('spin.results', compact('records'));
    }
    
     public function index()
    {
        // $jackpot_multiplier= DB::select("SELECT `multiplier` FROM `jackpot_multipliers`");
        
    //   $jackpot_multiplier = JackpotMultiplier::all();
      //dd($jackpot_multiplier);
        //  $jackpot = Jackpot::find(1);
         //dd($jackpot);
        $game_settings = DB::table('fun_game_settings')->where('id', 1)->first();
        //dd($game_settings);
        return view('spin.index')->with('game_settings', $game_settings);
    }
    
     public function spin_update(Request $request)
{
    // Fetch the game number (period_no) from the ab_bet_logs table
    $gamesno = DB::select("SELECT games_no FROM fun_bet_logs ORDER BY games_no ASC LIMIT 1");
    $game_no = $gamesno[0]->games_no;

   
        // Get the jackpot value from the request
        $jackpot = $request->jackpot;

        // Update the jackpot in the ab_admin_winner_result table for the corresponding period_no
        DB::update("UPDATE fun_admin_result SET jackpot = ? WHERE period_no = ?", [$jackpot, $game_no]);
        
        // Redirect back to the previous page
        return redirect()->back();
   
}

    
}

