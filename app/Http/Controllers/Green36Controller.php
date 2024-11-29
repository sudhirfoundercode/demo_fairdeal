<?php

namespace App\Http\Controllers;

use App\Models\Timmer36;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Green36Controller extends Controller
{
      
   
   public function fetch_green_36(){
       $bet_log = DB::table('green_36_bet_logs')->get();
       return response()->json(['status'=>200,'data'=>$bet_log]);
   }
    public function bets_green(){
        $records =DB:: table('green_36_bets')->paginate(10);
        return view('green36.bets', compact('records'));
    }
    
    public function results_green(){
        $records = DB::table('green_36_results')->paginate(10);
        return view('green36.results', compact('records'));
    }
    
     public function index_green()
    {
        $game_settings = DB::table('game_settings')->where('id', 1)->first();
        return view('green36.index')->with('game_settings', $game_settings);
    }
    
    
}

