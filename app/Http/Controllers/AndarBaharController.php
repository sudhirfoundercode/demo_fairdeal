<?php

namespace App\Http\Controllers;
use App\Models\AndarBahar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AndarBaharController extends Controller
{

   public function andar_bahar(Request $request)
{ 
    $winningPercentage = DB::table('ab_game_settings')->value('winning_percentage');
    return view('andarbahar.bet')->with('winningPercentage',$winningPercentage);
}
   public function update_andar_bahar_win_per(Request $request)
{
    $winningPercentage = DB::table('ab_game_settings')->update([
        'winning_percentage'=>$request->winning_percentage
        ]);
        if($winningPercentage){
             return redirect()->back()->with('success','Updated Successfully');
        }else{
              return redirect()->back()->with('error','Failed to update!');  
        }
   
}
    
    public function bets()
    {
        $records = DB::table('ab_bets')->paginate(10);
        return view('andarbahar.bets', compact('records'));
    }
    
    public function betresult()
    {
        $records = DB::table('ab_bet_results')->paginate(10);
        return view('andarbahar.betresult',compact('records'));
    }




//     public function andarbahar_create(Request $request,$game_id)
// 	{
// 	   // dd($game_id);
	
// 		// $gamesno=$request->gamesno;
//       $value = $request->session()->has('id');
// 	dd($value);
//         if(!empty($value))
//         {
// 			$amounts=DB::select("SELECT ab_bet_logs.*,ab_game_settings.winning_percentage AS parsantage ,ab_game_settings.id AS id FROM `ab_bet_logs` LEFT JOIN ab_game_settings ON ab_bet_logs.game_id=ab_game_settings.id where ab_bet_logs.game_id=$gameid Limit 10");

// 			 return view('andarbahar.index')->with('amounts', $amounts)->with('game_id', $game_id);
// 		}
//         else
//         {
//           return redirect()->route('auth.index');  
//         }
// 	}

// public function andarbahar_create(Request $request, $game_id)
// {
//     // Use the correct variable name in the query
//     $amounts = DB::select("SELECT ab_bet_logs.*, ab_game_settings.winning_percentage AS percentage, ab_game_settings.id AS id 
//                             FROM ab_bet_logs 
//                             LEFT JOIN ab_game_settings ON ab_bet_logs.game_id = ab_game_settings.id 
//                             WHERE ab_bet_logs.game_id = ? 
//                             LIMIT 10", [$game_id]); // Use parameter binding to prevent SQL injection
//   //dd($amounts);
//     return view('andarbahar.index')->with('amounts', $amounts)->with('game_id', $game_id);
// }

	
	 public function fetchDatas($game_id)
    {
        	$amounts=DB::select("SELECT ab_bet_logs.*,ab_game_settings.winning_percentage AS parsantage ,ab_game_settings.id AS id FROM `ab_bet_logs` LEFT JOIN game_settings ON ab_bet_logs.game_id=ab_game_settings.id where ab_bet_logs.game_id=$gameid Limit 10");

        return response()->json(['amounts' => $amounts,'game_id' => $game_id]);
    }
    
//     public function andarbahar_update(Request $request)
// {
//     // Fetch the game number (period_no) from the ab_bet_logs table
//     $gamesno = DB::select("SELECT period_no FROM ab_bet_logs ORDER BY period_no ASC LIMIT 1");
//     $game_no = $gamesno[0]->period_no;

   
//         // Get the jackpot value from the request
//         $jackpot = $request->jackpot;

//         // Update the jackpot in the ab_admin_winner_result table for the corresponding period_no
//         DB::update("UPDATE ab_admin_winner_result SET jackpot = ? WHERE period_no = ?", [$jackpot, $game_no]);
        
//         // Redirect back to the previous page
//         return redirect()->back();
   
// }

	
// 	public function andarbahar_store(Request $request)
// 	{
// 		 $datetime = Carbon::now('Asia/Kolkata')->toDateTimeString();
// 	$value = $request->session()->has('id');
	
//         if(!empty($value))
//         {
// 	      $gamesno=$request->game_no;
//          $number=$request->number;
		 
		
//         DB::insert("INSERT INTO `ab_admin_winner_result`( `game_no`,`game_id`, `number`, `status`, `created_at`, `updated_at`) VALUES ('$gamesno',`$gameid`,'$number','$status', '$datetime')");
			
         
        
//              return redirect()->back(); 
// 			 }
//         else
//         {
//           return redirect()->route('auth.index');  
//         }
// 	}
  
}	




