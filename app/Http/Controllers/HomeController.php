<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\PlayerMatch;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $players = Player::select(['id','name','total_point','l1_pts'])
        ->with(['homeGame','awayGame','playerWin', 'playerLost'])
        ->get()->sortByDesc('total_point');

        $lastGames = PlayerMatch::latest('updated_at')->with(['playerHome', 'playerAway'])->take(5)->get();
        return view('landing.index', ['players'=>$players, 'lastGames'=>$lastGames]);
    }

}
