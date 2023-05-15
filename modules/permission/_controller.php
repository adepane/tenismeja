<?php

use App\Models\Permission;
use Core\Core;
use Yajra\DataTables\DataTables;

class permissionController extends Core
{
    public function getpermissiondata()
    {
        $modulGet = Permission::select(['id', 'name', 'status'])->orderBy('id', 'asc')->get();

        return Datatables::of($modulGet)
        ->addColumn('action', function ($modulGet) {
            $checkedPermission = ($modulGet->status == 1) ? 'checked' : 'un';
            $profileValue = '{"id":"'.$modulGet->id.'"}#{"id":"'.$modulGet->id.'"}#{"id":"'.$modulGet->id.'","checked":"'.$checkedPermission.'"}';

            return Core::getactiondt('permission', $profileValue);
        })
        ->removeColumn('status')
        ->removeColumn('_id')
        ->rawColumns(['action'])
        ->make();
    }

    public function addpermissiondata()
    {
        $modul = new Permission;
        $modul->name = request('name');
        $modul->status = 1;
        $modul->role_access = '{}';
        $return_arr = [];
        if ($modul->save()) {
            $return_arr['status'] = 1;
            $return_arr['message'] = 'Permission added.';

            return $return_arr;
        } else {
            $return_arr['status'] = 0;
            $return_arr['message'] = 'Permission failed added.';

            return $return_arr;
        }
    }

    public function editpermissiondata()
    {
        $profile = Permission::find(request('idPermission'));
        $profile->name = request('name');
        $return_arr = [];
        if ($profile->update()) {
            $return_arr['status'] = 1;
            $return_arr['message'] = 'Permission updated.';

            return $return_arr;
        } else {
            $return_arr['status'] = 0;
            $return_arr['message'] = 'Permission failed updated.';

            return $return_arr;
        }
    }

    public function deletepermissiondata()
    {
        $modul = Permission::find(request('data'));
        $return_arr = [];
        if ($modul->delete()) {
            $return_arr['status'] = 1;
            $return_arr['message'] = 'The Permission has been deleted.';

            return $return_arr;
        } else {
            $return_arr['status'] = 0;
            $return_arr['message'] = 'Permission failed deleted.';

            return $return_arr;
        }
    }

    public function statuspermissiondata()
    {
        $expData = explode('-', request('data'));
        $modul = Permission::find($expData[0]);
        $modul->status = (int) request('statusid');
        if ($modul->update()) {
            return Core::createReturn(true, [], 'Data Status updated Successfully');
        } else {
            return Core::createReturn(false, [], 'Data Status updated Failed');
        }
    }
}
