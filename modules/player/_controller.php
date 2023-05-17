<?php

use App\Models\Player;
use Core\Core;
use Yajra\DataTables\DataTables;

class PlayerController extends Core
{
    public function getPlayerData()
    {
        

        $dataGet = Player::select(['id', 'name', 'total_point'])
        ->orderBy('id', 'asc');

        return Datatables::of($dataGet)
        ->addColumn('action', function ($dataGet) {
            $playerValue = '{"id":"'.$dataGet->id.'"}#{"id":"'.$dataGet->id.'"}';
            return Core::getactiondt('player', $playerValue);
        })
        ->rawColumns(['action'])
        ->make();
    }

    public function addPlayerData()
    {
        $modul = new Player;
        $modul->name = request('name');
        if ($modul->save()) {
            return Core::createReturn(true, $modul, 'Data Added Successfully');
        } else {
            return Core::createReturn(false, [], 'Data Added Failed');
        }
    }

    public function editPlayerData()
    {
        $modul = Player::find(request('playerId'));
        $modul->name = request('name');
        if ($modul->update()) {
            return Core::createReturn(true, $modul, 'Data Updated Successfully');
        } else {
            return Core::createReturn(false, $modul, 'Data Updated Failed');
        }
    }

    public function deletePlayerData()
    {
        $modul = Player::find(request('data'));
        if ($modul->delete()) {
            return Core::createReturn(true, [], 'Data Deleted Successfully');
        } else {
            return Core::createReturn(false, [], 'Data Deleted Failed');
        }
    }

}
