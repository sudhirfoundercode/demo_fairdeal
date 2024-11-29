<?php

namespace App\Http\Controllers;

use App\Models\Timmer36;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Blue36Controller extends Controller
{
      
   
   public function fetch_blue_36(){
       $bet_log = DB::table('blue_36_bet_logs')->get();
       return response()->json(['status'=>200,'data'=>$bet_log]);
   }
    public function bets_blue(){
        $records =DB:: table('blue_36_bets')->paginate(10);
        return view('blue36.bets', compact('records'));
    }
    
    public function results_blue(){
        $records = DB::table('blue_36_results')->paginate(10);
        return view('blue36.results', compact('records'));
    }
    
     public function index_blue()
    {
        $game_settings = DB::table('game_settings')->where('id', 1)->first();
        return view('blue36.index')->with('game_settings', $game_settings);
    }
    
   
}

