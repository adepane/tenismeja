<?php

use App\Models\Permission;
use Core\Core;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;

class moduleController extends Core
{
    public function getdirectory()
    {
        $directory = new Collection;
        $i = 1;
        $listDir = File::directories(base_path('modules/'));
        foreach ($listDir as $modules) {
            $modul = str_replace(base_path('modules/'), '', $modules);
            $id = $i++;
            $directory->push([
                'id' => $id,
                'module' => str_replace('_', ' ', $modul),
                'action' => '<a href="#permission-modules-'.$id.'" class="btn btn-primary btn-sm btn-icon md-ajax-load" value="'.$modul.'"><i class="fas fa-lock"></i></a>',
            ]);
        }

        return DataTables::of($directory)
        ->make();
    }

    public function sendrole()
    {
        $id = request('idprofile');
        $slugaction = request('slugaction');
        $statusrole = (request('statusrole')) ? 1 : 0;
        $module = request('module');
        $permission = Permission::find($id);
        $permissionID = $permission->id;
        $role_access = $permission->role_access;
        $getRole = ($role_access != '') ? json_decode($role_access, true) : '0';
        $updateArr = [$module => [$slugaction => $statusrole]];

        if (count($getRole) == 0) {
            $updateSlug = json_encode($updateArr, true);
            $uPermission = Permission::find($permissionID);
            $uPermission->role_access = $updateSlug;
            if ($uPermission->save()) {
                return response()->json(['status' => 1, 'message' => "Role $permission->name Updated!"]);
            } else {
                return response()->json(['status' => 0, 'message' => "Role $permission->name Not Updated!"]);
            }
        } else {
            unset($getRole[$module][$slugaction]);
            $getRole[$module][$slugaction] = $statusrole;

            $uPermission = Permission::find($permissionID);
            $uPermission->role_access = json_encode($getRole, true);
            if ($uPermission->save()) {
                return response()->json(['status' => 1, 'message' => "Role $permission->name Updated!"]);
            } else {
                return response()->json(['status' => 0, 'message' => "Role $permission->name Not Updated!"]);
            }
        }
    }

    public function vrole_profile()
    {
        $slug = request('slug');

        return View('module.view.role_profile')->with('slug', $slug);
    }

    public function getprofilesdata()
    {
        $slug = request('slug');
        $module = base_path('/modules/'.$slug.'/_config.json');
        $content = File::get($module);
        $data_menu = json_decode($content);
        $profiles = Permission::select(['id', 'name', 'role_access'])->where('id', '!=', '1');

        return Datatables::of($profiles)
        ->addColumn('view', function ($profiles) use ($data_menu, $slug) {
            $menu = '';
            $role_access = $profiles->role_access;
            $role_access2 = ($role_access != '') ? json_decode($role_access, true) : '';
            foreach ($data_menu->subMenu as $view => $key) {
                if ($role_access2 != '') {
                    if (array_key_exists($slug, $role_access2)) {
                        if (array_key_exists($view, $role_access2[$slug])) {
                            $checked = ($role_access2[$slug][$view] == '1') ? 'checked' : '';
                        } else {
                            $checked = '';
                        }
                    } else {
                        $checked = '';
                    }
                } else {
                    $checked = '';
                }

                $menu .= '
					<li s style="display:inline-block; margin:8px; padding-left: 27px; padding-bottom:0px; vertical-align:middle; width:100%; text-align:left;">
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" '.$checked.' name="'.$slug.'-'.$profiles->id.'-'.$view.'" id="view-'.$slug.'-'.$profiles->id.'-'.$view.'">
							<label class="form-check-label" for="view-'.$slug.'-'.$profiles->id.'-'.$view.'">'.$key->name.'</label>
						</div>
					</li>';
                $checked = '';
            }

            return '<ul class="role">'.$menu.'</ul>';
        })
        ->addColumn('action', function ($profiles) use ($data_menu, $slug) {
            $action = '';
            $role_access = $profiles->role_access;
            $role_access2 = ($role_access != '') ? json_decode($role_access, true) : '';
            foreach ($data_menu->action as $keys => $view) {
                if ($role_access2 != '') {
                    if (array_key_exists($slug, $role_access2)) {
                        if (array_key_exists($keys, $role_access2[$slug])) {
                            $checked = ($role_access2[$slug][$keys] == '1') ? 'checked' : '';
                        } else {
                            $checked = '';
                        }
                    } else {
                        $checked = '';
                    }
                } else {
                    $checked = '';
                }

                $action .= '
				<li style="display:inline-block; margin:8px; padding-left: 27px; padding-bottom:0px; vertical-align:middle; width:100%; text-align:left;" >
					<div class="form-check form-check-inline">
						<input class="form-check-input" id="action-'.$slug.'-'.$profiles->id.'-'.$keys.'" type="checkbox" '.$checked.' name="'.$slug.'-'.$profiles->id.'-'.$keys.'">
						<label class="form-check-label" for="action-'.$slug.'-'.$profiles->id.'-'.$keys.'">'.$data_menu->action->$keys->name.'</label>
					</div>
				</li>';
                $checked = '';
            }

            return '<ul class="role">'.$action.'</ul>';
        })
        ->removeColumn('role_access')
        ->removeColumn('id')
        ->rawColumns(['view', 'action'])
        ->make();
    }
}
