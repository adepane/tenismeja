<?php

use Core\Core;
use App\Models\MatchSet;
use App\Models\Player;
use App\Models\PlayerMatch;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;

class PlayerMatchController extends Core
{
    public function getPlayerMatchData()
    {
        $formId = request('cari');
        $homeId = null;
        $awayId = null;

        if (!empty($formId)) {
            foreach ($formId as $value) {
                if ($value['name'] == "_home_id") {
                    $homeId = ($value['value'] != null) ? $value['value'] : null;
                }
                if ($value['name'] == "_away_id") {
                    $awayId = ($value['value'] != null) ? $value['value'] : null;
                }
            }
        }

        $dataGet = PlayerMatch::select(['id', 'home_id', 'away_id', 'finish', 'home_score', 'away_score'])
        ->where(function ($x) use ($homeId) {
            if ($homeId != null) {
                $x->where('home_id', $homeId)->orWhere('away_id',$homeId);
            }
        })
        ->where(function ($x) use ($awayId) {
            if ($awayId != null) {
                $x->where('away_id', $awayId)->orWhere('home_id',$awayId);
            }
        })
        ->with(['getMatchSets'])
        ->orderBy('id', 'asc');

        return Datatables::of($dataGet)
        ->editColumn('finish', function($dataGet) {
            return ($dataGet->finish) ? '<span class="text-success">Finish</span>' : (($dataGet->getMatchSets->count() > 0) ? '<span class="text-warning">On Event</span>' : 'Not Start');
        })
        ->editColumn('home_id', function($dataGet){
            $winner = ($dataGet->home_score > $dataGet->away_score) ? "<i class='fas fa-trophy text-success'></i>" : "";
            $score = ($dataGet->finish) ? ' ( '.$dataGet->home_score .' ) ' : '';
            return $dataGet->playerHome->name . $score.' '.$winner;
        })
        ->editColumn('away_id', function($dataGet){
            $winner = ($dataGet->home_score < $dataGet->away_score) ? "<i class='fas fa-trophy text-success'></i>" : "";
            $score = ($dataGet->finish) ? ' ( ' . $dataGet->away_score . ' )' : '';

            return $winner.' '. $score .' '. $dataGet->playerAway->name;
        })
        ->addColumn('versus', function(){
            return 'VS';
        })
        ->addColumn('action', function ($dataGet) {
            $PlayerMatchValue = '{"id":"'.$dataGet->id.'"}#{"id":""}#{"id":""}';
            return Core::getactiondt('playerMatch', $PlayerMatchValue);
        })
        ->rawColumns(['action', 'home_id', 'away_id', 'finish'])
        ->make();
    }

    public function addPlayerMatchData()
    {
        $modul = new PlayerMatch;
        $modul->name = request('name');
        if ($modul->save()) {
            return Core::createReturn(true, $modul, 'Data Added Successfully');
        } else {
            return Core::createReturn(false, [], 'Data Added Failed');
        }
    }

    public function editPlayerMatchData()
    {
        $modul = MatchSet::find(request('PlayerMatchId'));
        $modul->player_match_id = request('player_match_id');
        $modul->home_score = request('home_score');
        $modul->away_score = request('away_score');
        $modul->finish = 1;
        $modul->set_of_match = request('game_set');
        $photo = request('photo');
        $image = str_replace('data:image/jpeg;base64,', '', $photo);
        $image = str_replace(' ', '+', $image);
        $imageName = rand() . '.' . 'jpeg';
        File::put(public_path() . '/photos/' . $imageName, base64_decode($image));
        $modul->photo = '/photos/' . $imageName;
        if ($modul->update()) {
            return Core::createReturn(true, $modul, 'Data Updated Successfully');
        } else {
            return Core::createReturn(false, [], 'Data Updated Failed');
        }
    }

    public function deletePlayerMatchData()
    {
        $modul = MatchSet::find(request('data'));
        $file = public_path($modul->photo);
        if (file_exists($file)) {
            File::delete($file);
        }
        if ($modul->delete()) {
            return Core::createReturn(true, [], 'Data Deleted Successfully');
        } else {
            return Core::createReturn(false, [], 'Data Deleted Failed');
        }
    }

    public function getPlayerMatchStatus()
    {
        $dataGet = MatchSet::select([
            'id',
            'home_score',
            'away_score',
            'finish',
            'set_of_match',
            'player_match_id',
        ])
        ->where('player_match_id', request('matchId'))
        ->with(['getPlayerMatch', 'getPlayerMatch.playerHome', 'getPlayerMatch.playerAway'])
        ->orderBy('set_of_match', 'asc');

        return Datatables::of($dataGet)
        ->addColumn('winner', function($dataGet){
            if (bccomp($dataGet->home_score, $dataGet->away_score) == 1) {
                return $dataGet->getPlayerMatch->playerHome->name;
            } else {
                return $dataGet->getPlayerMatch->playerAway->name;
            }
        })
        ->addColumn('score', function($dataGet){
            return $dataGet->home_score .' - '.$dataGet->away_score;
        })
        ->addColumn('action', function ($dataGet) {
            if (!$dataGet->getPlayerMatch->finish) {
                $PlayerMatchValue = '{"id":""}#{"id":"' . $dataGet->id . '"}#{"id":"' . $dataGet->id . '"}';
                return Core::getactiondt('playerMatch', $PlayerMatchValue);
            }
        })
        ->rawColumns(['action'])
        ->make();
    }
    
    public function addPlayerMatchSetdata()
    {
        $modul = new MatchSet;
        $modul->player_match_id = request('player_match_id');
        $modul->home_score = request('home_score');
        $modul->away_score = request('away_score');
        $modul->finish = 1;
        $modul->set_of_match = request('game_set');
        if (request('home_score') > request('away_score')) {
            $modul->home_win = 1;
        } else {
            $modul->away_win = 1;
        }
        $photo = request('photo');
        $image = str_replace('data:image/jpeg;base64,', '', $photo);
        $image = str_replace(' ', '+', $image);
        $imageName = rand() . '.' . 'jpeg';
        File::put(public_path() . '/photos/' . $imageName, base64_decode($image));
        $modul->photo = '/photos/'. $imageName;
        if ($modul->save()) {
            return Core::createReturn(true, $modul, 'Data Added Successfully');
        } else {
            return Core::createReturn(false, [], 'Data Added Failed');
        }
    }

    public function finishTheMatch()
    {
        $modul = PlayerMatch::find(request('data'));
        $modul->finish = true;
        $homeScore = $modul->getMatchSets->where('home_win', 1)->count();
        $awayScore = $modul->getMatchSets->where('away_win', 1)->count();
        $modul->home_score = $homeScore;
        $modul->away_score = $awayScore;
        $winner = ($homeScore > $awayScore) ? $modul->home_id : $modul->away_id;
        $modul->winner = $winner;
        if ($modul->update()) {
            if ($modul->home_score > $modul->away_score) {
                $thePlayer = Player::find($modul->home_id);
                $thePlayer->total_point = $thePlayer->total_point + 3;
            } else {
                $thePlayer = Player::find($modul->away_id);
                $thePlayer->total_point = $thePlayer->total_point + 3;
            }
            $thePlayer->update();
            return Core::createReturn(true, $modul, 'Data Updated Successfully');
        } else {
            return Core::createReturn(false, [], 'Data Updated Failed');
        }
        // dd($modul);
    }

}
