<?php

namespace App\Http\Controllers;

use App\Models\Timmer36;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Timmer36Controller extends Controller
{
      
   
   public function fetch_timer_36(){
       $bet_log = DB::table('timmer_36_bet_logs')->get();
       return response()->json(['status'=>200,'data'=>$bet_log]);
   }
    public function bets(){
        $records =DB:: table('timmer_36_bets')->paginate(10);
        return view('timmer36.bets', compact('records'));
    }
    
    public function results(){
        $records = DB::table('timmer_36_results')->paginate(10);
        return view('timmer36.results', compact('records'));
    }
    
     public function index()
    {
        $game_settings = DB::table('game_settings')->where('id', 1)->first();
        return view('timmer36.index')->with('game_settings', $game_settings);
    }
    
    // public function admin_prediction(Request $request){
        
    //     $request->validate([
    //         'games_no' => 'required|unique:admin_results|max:10',
    //         'number' => 'required',
    //     ]);
        
    //       $custom_date_time= $request->custom_result_date_time;
    //       if($custom_date_time){
    //           $custom_date_time = date('Y-m-d H:i:s', strtotime($custom_date_time));
    //       }
    //   // dd($custom_date_time);
    //       $result_time = $request->result_time;
    //       $number = $request->number;
    //       $games_no = $request->games_no;
    //       $prediction_insert = DB::table('timmer36admin_winner_result')->insert(['card_number'=>$number,'result_time'=>$result_time ?? now(),
    //       'games_no' => $games_no
    //       ]);
          
    //       if($prediction_insert){
    //           return redirect()->back()->with('success','Result Inserted Successfully');
    //       }else{
    //           return redirect()->back()->with('error','Result Not Inserted Successfully');
    //       }
          
    // }
    
}

