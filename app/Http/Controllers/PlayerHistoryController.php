<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Illuminate\Support\Str;

class PlayerHistoryController extends Controller
{
    
    public function playerHistory_index(Request $request){
        
         $distributor = User::select('id', 'name')->where('role_id', 4)->get();
        
         
        
       if($request->isMethod('POST')){
           $distributor_id = $request->distributor_id;
           $game_id = $request->id;
           $from_date = $request->from_date;
           $to_date = $request->to_date;
           
           
           $table_name = $game_id==1?'green_36_bets':($game_id==2?'blue_36_bets':'fun_bets');
           $query = DB::table('users')
                    ->leftJoin($table_name, "users.id", '=', "$table_name.user_id")
                     ->selectRaw("
                                users.name as name,
                                $table_name.description as description,
                                COALESCE(SUM($table_name.amount),0)AS total_bet,
                                COALESCE(SUM(CASE WHEN $table_name.status = 1 THEN $table_name.amount ELSE 0 END), 0) AS total_win,
                                COALESCE(SUM(CASE WHEN $table_name.status = 2 THEN $table_name.amount ELSE 0 END), 0) AS total_loss
                            ")
                            ->where('users.parent_id',$distributor_id);
            if($from_date){
                $query->whereDate("$table_name.created_at",'>=',$from_date);
            }   
            if($to_date){
                $query->whereDate("$table_name.created_at",'<=',$to_date);
            }
            
           $blue_36_bets =  $query->groupBy("$table_name.user_id", 'users.name', "$table_name.description")->get();
           
           return view('playerHistory.index')->with('blue_36_bets',$blue_36_bets)->with('distributor',$distributor);
           
           
       }else{
        
        $blue_36_bets = DB::table('blue_36_bets')
                            ->leftJoin('users', 'blue_36_bets.user_id', '=', 'users.id')
                            ->selectRaw("
                                users.name as name,
                                blue_36_bets.description as description,
                                COALESCE(SUM(blue_36_bets.amount),0)AS total_bet,
                                COALESCE(SUM(CASE WHEN blue_36_bets.status = 1 THEN blue_36_bets.amount ELSE 0 END), 0) AS total_win,
                                COALESCE(SUM(CASE WHEN blue_36_bets.status = 2 THEN blue_36_bets.amount ELSE 0 END), 0) AS total_loss
                            ")
                            ->groupBy('blue_36_bets.user_id', 'users.name', 'blue_36_bets.description')
                            ->get();
        $green_36_bets = DB::table('green_36_bets')
                            ->leftJoin('users', 'green_36_bets.user_id', '=', 'users.id')
                            ->selectRaw("
                                users.name as name,
                                green_36_bets.description as description,
                                COALESCE(SUM(green_36_bets.amount),0)AS total_bet,
                                COALESCE(SUM(CASE WHEN green_36_bets.status = 1 THEN green_36_bets.amount ELSE 0 END), 0) AS total_win,
                                COALESCE(SUM(CASE WHEN green_36_bets.status = 2 THEN green_36_bets.amount ELSE 0 END), 0) AS total_loss
                            ")
                            ->groupBy('green_36_bets.user_id', 'users.name', 'green_36_bets.description')
                            ->get();
                            
     $fun_bets = DB::table('fun_bets')
                            ->leftJoin('users', 'fun_bets.user_id', '=', 'users.id')
                            ->selectRaw("
                                users.name as name,
                                fun_bets.description as description,
                                COALESCE(SUM(fun_bets.amount),0)AS total_bet,
                                COALESCE(SUM(CASE WHEN fun_bets.status = 1 THEN fun_bets.amount ELSE 0 END), 0) AS total_win,
                                COALESCE(SUM(CASE WHEN fun_bets.status = 2 THEN fun_bets.amount ELSE 0 END), 0) AS total_loss
                            ")
                            ->groupBy('fun_bets.user_id', 'users.name', 'fun_bets.description')
                            ->get();
                            
                            

        return view('playerHistory.index')->with('blue_36_bets',$blue_36_bets)->with('green_36_bets',$green_36_bets)->with('fun_bets',$fun_bets)->with('distributor',$distributor);
        
       }
    }
    
    
    
    
    
    
    // public function playerHistory_index(){
    //   $gamename = [
    //                   "Green36 Game",
    //                   "Blue36 Game",
    //                   "FunTarget Game"
    //               ];
    //               $distributor = User::select('id', 'name')->where('role_id', 4)->get();
          
    //     return view('playerHistory.index', compact('gamename','distributor'));
    // }
    
//   public function playerHistory_index(Request $request)
// {
//     // Game names
//     $gamename = [
//         "Green36 Game",
//         "Blue36 Game",
//         "FunTarget Game"
//     ];

//     // Distributors list
//     $distributor = DB::table('users')
//         ->select('id', 'name')
//         ->where('role_id', 4) // Assuming role_id 4 represents distributors
//         ->get();

//     // Initialize query for blue_36_bets table
//     $query = DB::table('blue_36_bets')
//         ->join('users', 'blue_36_bets.user_id', '=', 'users.id')
//         ->select(
//             'users.id as user_id',
//             'users.name as player_name',
//             DB::raw('SUM(blue_36_bets.amount) as total_amount'),
//             DB::raw('SUM(CASE WHEN blue_36_bets.status = 1 THEN blue_36_bets.amount ELSE 0 END) as total_win'), // Conditional sum for total_win
//             DB::raw('SUM(CASE WHEN blue_36_bets.status = 2 THEN blue_36_bets.amount ELSE 0 END) as total_loss'), // Conditional sum for total_win
//         )
//         ->groupBy('users.id', 'users.name'); // Group by user_id and player name

//     // Apply filters
//     if ($request->has('distributor_id') && $request->distributor_id != null) {
//         $query->where('users.id', $request->distributor_id);
//     }

//     if ($request->has('game_name') && $request->game_name != null) {
//         $query->where('blue_36_bets.game_name', $request->game_name);
//     }

//     if ($request->has('from_date') && $request->has('to_date')) {
//         $query->whereBetween('blue_36_bets.created_at', [$request->from_date, $request->to_date]);
//     }

//     // Paginate the results
//     $playerHistories = $query->paginate(10);

//     // Return view with the data
//     return view('playerHistory.index', compact('gamename', 'distributor', 'playerHistories'));
// }

  public function playerHistory_index_old(Request $request)
    {
        // Game names and corresponding tables
        $gamename = [
            1 => "Green36 Game",
            2 => "Blue36 Game",
            3 => "FunTarget Game"
        ];

        $tableMapping = [
            1 => 'green_36_bets',
            2 => 'blue_36_bets',
            3 => 'fun_bets'
        ];

        // Distributors list
        $distributor = DB::table('users')
            ->select('id', 'name')
            ->where('role_id', 4) // Assuming role_id 4 represents distributors
            ->get();

        $playerHistories = [];

        // Determine the table or fetch from all tables
        if ($request->filled('id')) {
            $table = $tableMapping[$request->id] ?? null;

            if ($table) {
                // Query for a specific table
                $playerHistories = $this->fetchDataFromTable($table, $request);
            }
        } else {
            // Query for all tables
            $playerHistories = $this->fetchDataFromAllTables($tableMapping, $request);
        }

        // Return view with the data
        return view('playerHistory.index', compact('gamename', 'distributor', 'playerHistories'));
    }

    private function fetchDataFromTable($table, $request)
    {
       // dd($table);
        $query = DB::table($table)
            ->join('users', "{$table}.user_id", '=', 'users.id')
            ->select(
                'users.id as user_id',
                'users.name as player_name',
                DB::raw("SUM({$table}.amount) as total_bet"),
                DB::raw("SUM(CASE WHEN {$table}.status = 1 THEN {$table}.amount ELSE 0 END) as total_win"),
                DB::raw("SUM(CASE WHEN {$table}.status = 2 THEN {$table}.amount ELSE 0 END) as total_loss")
            )
            ->groupBy('users.id', 'users.name');
//dd($query);
        if ($request->filled('distributor_id')) {
            $query->where('users.id', $request->distributor_id);
        }

        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween("{$table}.created_at", [$request->from_date, $request->to_date]);
        }

        return $query->get();
    }

    private function fetchDataFromAllTables($tableMapping, $request)
    {
        $allData = [];

        foreach ($tableMapping as $table) {
            $query = DB::table($table)
                ->join('users', "{$table}.user_id", '=', 'users.id')
                ->select(
                    'users.id as user_id',
                    'users.name as player_name',
                    DB::raw("SUM({$table}.amount) as total_bet"),
                    DB::raw("SUM(CASE WHEN {$table}.status = 1 THEN {$table}.amount ELSE 0 END) as total_win"),
                    DB::raw("SUM(CASE WHEN {$table}.status = 2 THEN {$table}.amount ELSE 0 END) as total_loss")
                )
                ->groupBy('users.id', 'users.name');

            if ($request->filled('distributor_id')) {
                $query->where('users.id', $request->distributor_id);
            }

            if ($request->filled('from_date') && $request->filled('to_date')) {
                $query->whereBetween("{$table}.created_at", [$request->from_date, $request->to_date]);
            }

            $data = $query->get();
            $allData = array_merge($allData, $data->toArray());
        }

        // Aggregate results by user_id
        return collect($allData)
            ->groupBy('user_id')
            ->map(function ($group) {
                return [
                    'user_id' => $group->first()->user_id,
                    'player_name' => $group->first()->player_name,
                    'total_bet' => $group->sum('total_bet'),
                    'total_win' => $group->sum('total_win'),
                    'total_loss' => $group->sum('total_loss'),
                ];
            })
            ->values();
    }


    
    
}
