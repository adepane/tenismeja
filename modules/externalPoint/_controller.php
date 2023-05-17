<?php

use App\Models\ExternalPoint;
use Core\Core;
use Yajra\DataTables\DataTables;

class ExternalPointController extends Core
{
    public function getexternalPointdata()
    {
        $dataGet = ExternalPoint::select(['id', 'player_id', 'points'])->orderBy('id', 'asc')->get();

        return Datatables::of($dataGet)
        // ->addColumn('action', function ($dataGet) {
        //     $checkedExternalPoint = ($dataGet->status == 1) ? 'checked' : 'un';
        //     $externalPointValue = '{"id":"'.$dataGet->id.'"}#{"id":"'.$dataGet->id.'"}#{"id":"'.$dataGet->id.'","checked":"'.$checkedExternalPoint.'"}';
        //     return Core::getactiondt('externalPoint', $externalPointValue);
        // })
        ->rawColumns(['action'])
        ->make();
    }

    public function addexternalPointdata()
    {
        $modul = new ExternalPoint;
        $modul->name = request('name');
        if ($modul->save()) {
            return Core::createReturn(true, $modul, 'Data Added Successfully');
        } else {
            return Core::createReturn(false, [], 'Data Added Failed');
        }
    }

    public function editexternalPointdata()
    {
        $modul = ExternalPoint::find(request('externalPointId'));
        $modul->name = request('name');
        if ($modul->update()) {
            return Core::createReturn(true, $modul, 'Data Updated Successfully');
        } else {
            return Core::createReturn(false, $modul, 'Data Updated Failed');
        }
    }

    public function deleteexternalPointdata()
    {
        $modul = ExternalPoint::find(request('data'));
        if ($modul->delete()) {
            return Core::createReturn(true, [], 'Data Deleted Successfully');
        } else {
            return Core::createReturn(false, [], 'Data Deleted Failed');
        }
    }

    public function statusexternalPointdata()
    {
        $expData = explode('-', request('data'));
        $modul = ExternalPoint::find($expData[0]);
        $modul->status = (int) request('statusid');
        if ($modul->update()) {
            return Core::createReturn(true, [$modul], 'Data Status updated Successfully');
        } else {
            return Core::createReturn(true, [$modul], 'Data Status updated Failed');
        }
    }
}
