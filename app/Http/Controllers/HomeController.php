<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\MatchSet;
use App\Models\PlayerMatch;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $players = Player::select(['id','name','total_point','l1_pts'])
        ->with(['homeGame','awayGame','playerWin', 'playerLost'])
        ->get()->sortByDesc('total_point');

        $lastGames = PlayerMatch::where('finish',1)->latest('updated_at')->with(['playerHome', 'playerAway'])->take(5)->get();
        return view('landing.index', ['players'=>$players, 'lastGames'=>$lastGames]);
    }

    public function getDetailGame($gameId)
    {
        $match = MatchSet::where('player_match_id',$gameId)->orderBy('set_of_match', 'asc')
        ->with(['getPlayerMatch', 'getPlayerMatch.playerHome', 'getPlayerMatch.playerAway', 'getPlayerMatch.getWinner'])
        ->get();
        return [
            'winner'=>$match[0]->getPlayerMatch->getWinner->name,
            'lastUpdate'=> $match[0]->updated_at->format('l, d-m-Y'),
            'matchs'=>$match];
        // dd($match);
        // dd($gameId);
    }

    public function getDetailUser($userId)
    {
        $player = Player::find($userId);
        return view('landing.detail', ['player'=>$player]);
    }

}
