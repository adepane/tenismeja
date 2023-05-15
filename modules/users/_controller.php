<?php

use App\Models\User;
use Core\Core;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

// use Illuminate\Auth\RequestGuard;

class usersController extends Core
{
    public function getusersdata()
    {
        $users = User::select([
            'id',
            'name',
            'email',
            'username',
            'status',
            'permission_id',
            'is_custom',
        ])
        ->with('getPermission');

        return DataTables::of($users)
        ->editColumn('permission_id', function ($user) {
            return (! $user->is_custom) ? $user->getPermission->name : 'Custom';
        })
        ->addColumn('action', function ($user) {
            $checkedUser = ($user->status) ? 'checked' : 'un';
            if ($user->is_custom) {
                $usersValue = '{"id":"'.$user->id.'"}#{"id":"'.$user->id.'"}#{"id":"'.$user->id.'"}#{"id":"'.$user->id.'"}#{"id":"'.$user->id.'","checked":"'.$checkedUser.'"}';
            } else {
                $usersValue = '{"id":"'.$user->id.'"}#{"id":"'.$user->id.'"}#{"id":"'.$user->id.'"}#{"id":""}#{"id":"'.$user->id.'","checked":"'.$checkedUser.'"}';
            }

            return Core::getactiondt('users', $usersValue);
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function getusersinfo()
    {
        if (request()->has('username')) {
            $fieldWhere = 'username';
            $fieldWhereIs = request()->get('username');
        } elseif (request()->has('email')) {
            $fieldWhere = 'email';
            $fieldWhereIs = request()->get('email');
        } else {
            $fieldWhere = 'id';
            $fieldWhereIs = '1';
        }
        if (request()->has('update')) {
            $id = request()->get('update');
            $chkUser = User::where("$fieldWhere", '!=', "$fieldWhereIs")->where('id', '==', $id)->get()->first();
        } else {
            $chkUser = User::where("$fieldWhere", '=', "$fieldWhereIs")->get()->first();
        }
        if (! empty($chkUser)) {
            return response('false', 200)->header('Content-Type', 'text/plain');
        } else {
            return response('true', 200)->header('Content-Type', 'text/plain');
        }
    }

    public function userInfoEdit()
    {
        $user = User::find(request('id'));
        if (request()->has('username')) {
            if (request('username') == $user->username) {
                return response()->json('true', 200);
            } else {
                $checkUser = User::where('username', request('username'))->get()->count();
                if ($checkUser > 0) {
                    return response()->json('false', 200);
                } else {
                    return response()->json('true', 200);
                }
            }
        } elseif (request()->has('email')) {
            if (request('email') == $user->email) {
                return response()->json('true', 200);
            } else {
                $checkUser = User::where('email', request('email'))->get()->count();
                if ($checkUser > 0) {
                    return response()->json('false', 200);
                } else {
                    return response()->json('true', 200);
                }
            }
        }
    }

    public function adduserdata()
    {
        $modul = new User;
        $modul->name = request('name');
        $modul->username = request('username');
        $modul->email = request('email');
        $modul->password = bcrypt(request('password'));
        $modul->permission_id = (int) request('permission');
        $modul->is_custom = request('is_custom');
        $modul->address = request('address');
        $modul->phone = request('phone');
        $modul->status = 1;
        $return_arr = [];
        if ($modul->save()) {
            $return_arr['status'] = 1;
            $return_arr['message'] = 'User inserted.';
        } else {
            $return_arr['status'] = 0;
            $return_arr['message'] = 'User failed inserted.';
        }

        return $return_arr;
    }

    public function editusersdata()
    {
        // dd(request()->all());
        $modul = User::find(request('idUser'));
        $modul->name = request('name');
        if (request()->has('password')) {
            $modul->password = bcrypt(request('password'));
        }
        if (Auth::user()->permission_id == 1) {
            $modul->username = request('username');
            $modul->email = request('email');
            if (request()->has('permission')) {
                $modul->permission_id = request('permission');
            }
            if (request()->has('is_custom')) {
                $modul->is_custom = request('is_custom');
            }
        }
        $modul->address = request('address');
        $modul->phone = request('phone');
        $return_arr = [];
        if ($modul->update()) {
            $return_arr['status'] = 1;
            $return_arr['message'] = 'User updated.';
        } else {
            $return_arr['status'] = 0;
            $return_arr['message'] = 'User failed updated.';
        }

        return $return_arr;
    }

    public function editprofiledata()
    {
        $modul = User::find(request('idUser'));
        $modul->name = request('name');
        if (request()->has('password')) {
            $modul->password = bcrypt(request('password'));
        }
        $modul->username = request('username');
        $modul->email = request('email');
        $modul->address = request('address');
        $modul->phone = request('phone');
        $return_arr = [];
        if ($modul->update()) {
            $return_arr['status'] = 1;
            $return_arr['message'] = 'Profile updated.';
        } else {
            $return_arr['status'] = 0;
            $return_arr['message'] = 'Profile failed updated.';
        }

        return $return_arr;
    }

    public function statususerdata()
    {
        $idUpdate = explode('-', request('data'));
        $id = $idUpdate[0];
        $user = User::find($id);
        $status_id = request('statusid');
        $user->status = $status_id;
        $return_arr = [];
        if ($user->save()) {
            $return_arr['status'] = 1;
            $return_arr['message'] = 'User Status updated.';

            return $return_arr;
        } else {
            $return_arr['status'] = 0;
            $return_arr['message'] = 'User Status failed updated.';

            return $return_arr;
        }
    }

    public function deleteusersdata()
    {
        $id = request('data');
        $users = User::find($id);
        if ($users->delete()) {
            $return_arr['status'] = 1;
            $return_arr['message'] = 'The user has been deleted.';

            return $return_arr;
        } else {
            $return_arr['status'] = 0;
            $return_arr['message'] = 'User failed deleted.';

            return $return_arr;
        }
    }

    public function getmodulepermission()
    {
        $user = User::find(request('user'));
        $directories = new Collection;
        $i = 1;
        $listDir = File::directories(base_path('modules/'));
        foreach ($listDir as $modules) {
            $modul = str_replace(base_path('modules/'), '', $modules);
            $module = base_path('/modules/'.$modul.'/_config.json');
            $content = File::get($module);
            $dataModule = json_decode($content);
            $id = $i++;
            $directories->push([
                'id' => $id,
                'name' => $dataModule->moduleName,
                'module' => str_replace('_', ' ', $modul),
                'actions' => $dataModule->action,
                'pages' => $dataModule->subMenu,
            ]);
        }

        return Datatables::of($directories)
        ->addColumn('module', function ($directory) {
            return $directory['name'];
        })
        ->addColumn('pages', function ($directory) use ($user) {
            $checked = '';
            $menu = '';
            $userRoleAccess = (! empty($user->role_access)) ? json_decode($user->role_access, true) : null;
            foreach ($directory['pages'] as $key => $page) {
                if (! empty($userRoleAccess)) {
                    if (array_key_exists($directory['module'], $userRoleAccess) && array_key_exists($key, $userRoleAccess[$directory['module']])) {
                        $checked = ($userRoleAccess[$directory['module']][$key] == 1) ? 'checked' : '';
                    }
                }

                $menu .= '
					<li s style="display:inline-block; margin:8px; padding-left: 27px; padding-bottom:0px; vertical-align:middle; width:100%; text-align:left;">
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" '.$checked.' name="'.$directory['module'].'-'.$user->id.'-'.$key.'" id="view-'.$directory['module'].'-'.$user->id.'-'.$key.'">
							<label class="form-check-label" for="view-'.$directory['module'].'-'.$user->id.'-'.$key.'">'.$page->name.'</label>
						</div>
					</li>';
                $checked = '';
            }

            return '<ul class="role">'.$menu.'</ul>';
        })
        ->addColumn('actions', function ($directory) use ($user) {
            $checked = '';
            $menu = '';
            $userRoleAccess = (! empty($user->role_access)) ? json_decode($user->role_access, true) : null;
            foreach ($directory['actions'] as $key => $action) {
                if (! empty($userRoleAccess)) {
                    if (array_key_exists($directory['module'], $userRoleAccess) && array_key_exists($key, $userRoleAccess[$directory['module']])) {
                        $checked = ($userRoleAccess[$directory['module']][$key] == 1) ? 'checked' : '';
                    }
                }

                $menu .= '
                <li s style="display:inline-block; margin:8px; padding-left: 27px; padding-bottom:0px; vertical-align:middle; width:100%; text-align:left;">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" '.$checked.' name="'.$directory['module'].'-'.$user->id.'-'.$key.'" id="view-'.$directory['module'].'-'.$user->id.'-'.$key.'">
                        <label class="form-check-label" for="view-'.$directory['module'].'-'.$user->id.'-'.$key.'">'.$action->name.'</label>
                    </div>
                </li>';
                $checked = '';
            }

            return '<ul class="role">'.$menu.'</ul>';
        })
        ->rawColumns(['pages', 'actions'])
        ->make();
    }

    public function sendcustomrole()
    {
        $slugaction = request('slugaction');
        $statusrole = (request('statusrole')) ? 1 : 0;
        $module = request('module');
        $user = User::find(request('userId'));
        $getRole = (! empty($user->role_access)) ? json_decode($user->role_access, true) : [];
        $updateArr = [$module => [$slugaction => $statusrole]];

        if (count($getRole) == 0) {
            $updateSlug = json_encode($updateArr, true);
            $user->role_access = $updateSlug;
            if ($user->update()) {
                return response()->json(['status' => 1, 'message' => "Role $user->name Updated!"]);
            }
        } else {
            unset($getRole[$module][$slugaction]);
            $getRole[$module][$slugaction] = $statusrole;
            $user->role_access = json_encode($getRole, true);
            if ($user->update()) {
                return response()->json(['status' => 1, 'message' => "Role $user->name Updated!"]);
            }
        }

        return response()->json(['status' => 0, 'message' => 'Role Change Failed']);
    }
}
