<?php

use File;
use Core\Core;
use App\Models\MatchSet;
use App\Models\PlayerMatch;
use Yajra\DataTables\DataTables;

class PlayerMatchController extends Core
{
    public function getPlayerMatchData()
    {
        $dataGet = PlayerMatch::select(['id', 'home_id', 'away_id'])
        ->orderBy('id', 'asc');

        return Datatables::of($dataGet)
        ->editColumn('home_id', function($dataGet){
            return $dataGet->playerHome->name;
        })
        ->editColumn('away_id', function($dataGet){
            return $dataGet->playerAway->name;
        })
        ->addColumn('versus', function(){
            return 'VS';
        })
        ->addColumn('action', function ($dataGet) {
            $PlayerMatchValue = '{"id":"'.$dataGet->id.'"}#{"id":""}#{"id":""}';
            return Core::getactiondt('PlayerMatch', $PlayerMatchValue);
        })
        ->rawColumns(['action'])
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
        $modul = PlayerMatch::find(request('PlayerMatchId'));
        $modul->name = request('name');
        if ($modul->update()) {
            return Core::createReturn(true, $modul, 'Data Updated Successfully');
        } else {
            return Core::createReturn(false, $modul, 'Data Updated Failed');
        }
    }

    public function deletePlayerMatchData()
    {
        $modul = PlayerMatch::find(request('data'));
        if ($modul->delete()) {
            return Core::createReturn(true, [], 'Data Deleted Successfully');
        } else {
            return Core::createReturn(false, [], 'Data Deleted Failed');
        }
    }

    public function getPlayerMatchStatus()
    {
        $dataGet = MatchSet::where('player_match_id', request('matchId'))
        ->with(['getPlayerMatch', 'getPlayerMatch.playerHome', 'getPlayerMatch.playerAway'])
        ->orderBy('id', 'asc')->get();
        // dd($dataGet);

        return Datatables::of($dataGet)
        ->addColumn('winner', function($dataGet){
            if ($dataGet->home_score > $dataGet->away_scrore) {
                return $dataGet->getPlayerMatch->playerHome->name;
            } else {
                return $dataGet->getPlayerMatch->playerAway->name;
            }
        })
        ->addColumn('score', function($dataGet){
            return $dataGet->home_score .' - '.$dataGet->away_score;
        })
        ->addColumn('action', function ($dataGet) {
            $PlayerMatchValue = '{"id":""}#{"id":"' . $dataGet->id . '"}#{"id":"' . $dataGet->id . '"}';
            return Core::getactiondt('PlayerMatch', $PlayerMatchValue);
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
        $photo = request('photo');
        $image = str_replace('data:image/jpeg;base64,', '', $photo);
        $image = str_replace(' ', '+', $image);
        // dd($image);
        $imageName = rand() . '.' . 'jpeg';
        // dd($imageName);
        // $path = $image->storeAs('photos', $imageName, 'public');
        File::put(public_path() . '/photos/' . $imageName, base64_decode($image));
        $modul->photo = '/photos/'. $imageName;
        if ($modul->save()) {
            return Core::createReturn(true, $modul, 'Data Added Successfully');
        } else {
            return Core::createReturn(false, [], 'Data Added Failed');
        }
    }

}
