<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WinningRatioController extends Controller
{
    public function winning_ratio(){
        return view('winningRatio.index');
    }
}