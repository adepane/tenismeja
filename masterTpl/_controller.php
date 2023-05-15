<?php

use App\Models\$modulModels;
use Core\Core;
use Yajra\DataTables\DataTables;

class $modulModelsController extends Core
{
    public function get$moduledata()
    {
        $dataGet = $modulModels::select(['id', 'name', 'status'])->orderBy('id', 'asc')->get();

        return Datatables::of($dataGet)
        ->addColumn('action', function ($dataGet) {
            $checked$modulModels = ($dataGet->status == 1) ? 'checked' : 'un';
            $$moduleValue = '{"id":"'.$dataGet->id.'"}#{"id":"'.$dataGet->id.'"}#{"id":"'.$dataGet->id.'","checked":"'.$checked$modulModels.'"}';
            return Core::getactiondt('$module', $$moduleValue);
        })
        ->rawColumns(['action'])
        ->make();
    }

    public function add$moduledata()
    {
        $modul = new $modulModels;
        $modul->name = request('name');
        if ($modul->save()) {
            return Core::createReturn(true, $modul, 'Data Added Successfully');
        } else {
            return Core::createReturn(false, [], 'Data Added Failed');
        }
    }

    public function edit$moduledata()
    {
        $modul = $modulModels::find(request('$moduleId'));
        $modul->name = request('name');
        if ($modul->update()) {
            return Core::createReturn(true, $modul, 'Data Updated Successfully');
        } else {
            return Core::createReturn(false, $modul, 'Data Updated Failed');
        }
    }

    public function delete$moduledata()
    {
        $modul = $modulModels::find(request('data'));
        if ($modul->delete()) {
            return Core::createReturn(true, [], 'Data Deleted Successfully');
        } else {
            return Core::createReturn(false, [], 'Data Deleted Failed');
        }
    }

    public function status$moduledata()
    {
        $expData = explode('-', request('data'));
        $modul = $modulModels::find($expData[0]);
        $modul->status = (int) request('statusid');
        if ($modul->update()) {
            return Core::createReturn(true, [$modul], 'Data Status updated Successfully');
        } else {
            return Core::createReturn(true, [$modul], 'Data Status updated Failed');
        }
    }
}
