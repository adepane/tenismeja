<?php

namespace Core;

use App\Models\User;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class Core
{
    public static function links(string $name)
    {
        return url('/admin/#/'.$name);
    }

    public static function modal(string $name)
    {
        return url("/admin/$name");
    }

    public static function api(string $name)
    {
        return url("/api/$name");
    }

    public static function switchUser($user)
    {
        $user = User::find($user);
        return $user->name;
    }

    public function roleAccess($user, string $module, $slug = false)
    {
        $sub_slug = ($slug == false) ? $module : $slug;
        if ($user->permission_id == 1) {
            return true;
        } else {
            if ($user->is_custom) {
                $Profile = json_decode($user->role_access, true);
            } else {
                $getProfile = Permission::find($user->permission_id);
                $Profile = json_decode($getProfile->role_access, true);
            }
            if (! empty($Profile) && isset($Profile[$module])) {
                $getAccess = (array_key_exists($sub_slug, $Profile[$module]) && $Profile[$module][$sub_slug] == 1) ? true : false;

                return $getAccess;
            } else {
                return false;
            }
        }
    }

    public function permissionUser($user)
    {
        $permissionUser = [];
        if ($user->permission_id != 1) {
            if ($user->is_custom) {
                $permissionUser = json_decode($user->role_access, true);
            } else {
                $permission = Permission::find($user->permission_id);
                $permissionUser = json_decode($permission->role_access, true);
            }
        } else {
            $listDir = File::directories(base_path('modules/'));
            foreach ($listDir as $modules) {
                $module = $modules.'/_config.json';
                $content_m = File::get($module);
                $dataMenu_ = json_decode($content_m);
                foreach ($dataMenu_->subMenu as $keys => $data) {
                    $permissionUser[$dataMenu_->moduleSlug][$keys] = 1;
                }
                foreach ($dataMenu_->action as $keys => $data) {
                    $permissionUser[$dataMenu_->moduleSlug][$keys] = 1;
                }
            }
        }

        return $permissionUser;
    }

    public function getLeftMenu()
    {
        $menu = resource_path('views/layouts/_menu.json');
        $content = File::get($menu);
        $dataMenu = json_decode($content);
        $user = Auth::user();
        $permissionUser = $this->permissionUser($user);
        // dd($permissionUser);
        if (! empty($permissionUser)) {
            foreach ($permissionUser as $menu => $key) {
                $menu_ = base_path('modules/'.$menu.'/_config.json');
                if (File::exists($menu_)) {
                    $content_ = File::get($menu_);
                    $contentz = json_decode($content_);
                    $subMenu = $contentz->sub;
                    if (property_exists($dataMenu, $subMenu) && $dataMenu->$subMenu->sub) {
                        if (isset($permissionUser[$menu][$menu]) && $permissionUser[$menu][$menu] == 1) {
                            $sub_menus = [];
                            $sub_menus['name'] = $contentz->moduleName;
                            $sub_menus['order'] = $contentz->order;
                            $sub_menus['slug'] = $menu;
                            $dataMenu->$subMenu->subMenu[$menu] = (object) $sub_menus;
                        }
                        unset($permissionUser[$menu][$menu]);
                    }
                }
            }
        }

        $dataMenu = collect($dataMenu)->sortBy('order');
        $menuArr = [];
        foreach ($dataMenu as $keyMenu => $menuLeft) {
            $li_subMenu = '';
            $li = 0;
            if ($menuLeft->sub) {
                if (property_exists($menuLeft, 'subMenu')) {
                    $inSubMenu = [];
                    $menuLeft->subMenu = collect($menuLeft->subMenu)->sortBy('order');
                    foreach ($menuLeft->subMenu as $keys => $data) {
                        $inSubMenu[$keys]['url'] = self::links($data->slug);
                        $inSubMenu[$keys]['name'] = $data->name;
                        $inSubMenu[$keys]['hash'] = '#/'.$data->slug;
                    }
                    $li = 1;
                }
            }

            if (! $menuLeft->sub) {
                if ($this->roleAccess($user, $menuLeft->slug)) {
                    $menuArr[$keyMenu]['url'] = self::links($menuLeft->slug);
                    $menuArr[$keyMenu]['name'] = $menuLeft->name;
                    $menuArr[$keyMenu]['icon'] = $menuLeft->icon;
                    $menuArr[$keyMenu]['hash'] = '#/'.$menuLeft->slug;
                }
            } else {
                if ($li == 1) {
                    $menuArr[$keyMenu]['url'] = 'javascript:void(0);';
                    $menuArr[$keyMenu]['name'] = $menuLeft->name;
                    $menuArr[$keyMenu]['icon'] = $menuLeft->icon;
                    $menuArr[$keyMenu]['hash'] = '#/'.$menuLeft->slug;
                    $menuArr[$keyMenu]['submenu'] = $inSubMenu;
                }
            }
        }

        return json_encode($menuArr);
    }

    public function getActionModule($user, $submenu, $menu)
    {
        $result = '';
        foreach ($submenu as $smenu => $key) {
            if (! $key->hidden) {
                $dataHash = ($key->main) ? '#/'.$menu : '#/'.$menu.'/'.$smenu;
                $linkMenu = ($key->main) ? self::links($menu) : self::links($menu.'/'.$smenu);
                $result .= ($this->roleAccess($user, $menu, $smenu)) ? '<a href="'.$linkMenu.'" class="dropdown-item '.$key->classLink.'"  data-hash="'.$dataHash.'"><span class="align-middle"><i class="'.$key->classIcon.'"></i> '.$key->name.'</span></a>' : '';
            }
        }

        return $result;
    }

    public function getactiondt($slug, $value)
    {
        $explodeValue = explode('#', $value);
        $module = base_path('modules/'.$slug.'/_config.json');
        $content = File::get($module);
        $data_menu = json_decode($content);
        $dtlistBtn = '<div class="d-inline-flex">';
        $dtlistBtn .= '<a class="pe-1 dropdown-toggle hide-arrow  text-primary" data-bs-toggle="dropdown">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
            <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
        </svg>
        </a>
        <div class="dropdown-menu dropdown-menu-end">';
        $i = 0;
        $switch = '';
        $Profile = $this->permissionUser(Auth::user());
        foreach ($data_menu->action as $keys => $values) {
            if ($data_menu->action->$keys->action && isset($Profile[$slug][$keys])) {
                $iv = $i++;
                if ($Profile[$slug][$keys] == 1) {
                    switch ($data_menu->action->$keys->type) {
                        case 'btn':
                            $data_var = json_decode($explodeValue[$iv]);
                            foreach ($data_var as $k => $value) {
                                $id_encoded[] = $value;
                            }

                            $id_encode = implode('-', $id_encoded);
                            if ($id_encode != '') {
                                $urlLink = (! Str::contains($data_menu->action->$keys->page, '#')) ? 'href="'.Core::links($data_menu->moduleSlug.'/'.$data_menu->action->$keys->page.'/'.$id_encode).'"' : '';

                                $dtlistBtn .= '<a '.$urlLink.' data-value="'.$id_encode.'" class="dropdown-item '.$data_menu->action->$keys->aClass.'"><i class="'.$data_menu->action->$keys->iClass.'"></i> '.$data_menu->action->$keys->name.'</a>';
                            }
                            $id_encode = '';
                            $id_encoded = [];
                            break;

                        case 'checkbox':
                            $data_var = json_decode($explodeValue[$iv]);
                            foreach ($data_var as $k => $value) {
                                $id_encoded[] = $value;
                            }

                            $id_encode = implode('-', $id_encoded);
                            if ($id_encode != '') {
                                $switch .= '
                                    <div class="form-check form-check-primary form-switch">
                                        <input type="checkbox" class="switch form-check-input" '.$data_var->checked.' data-value="'.$id_encode.'#'.$data_var->checked.'" />
                                    </div>
                                ';
                            }
                            $id_encode = '';
                            $id_encoded = [];
                            break;

                        default:
                            $data_var = json_decode($explodeValue[$iv]);
                            foreach ($data_var as $k => $value) {
                                $id_encoded[] = $value;
                            }

                            $id_encode = implode('-', $id_encoded);
                            if ($id_encode != '') {
                                $urlLink = (! Str::contains($data_menu->action->$keys->page, '#')) ? 'href="'.Core::links($data_menu->moduleSlug.'/'.$data_menu->action->$keys->page.'/'.$id_encode).'"' : '';

                                $dtlistBtn .= '<a '.$urlLink.' valueajax="'.$id_encode.'" class="btn '.$data_menu->action->$keys->aClass.'"><i class="'.$data_menu->action->$keys->iClass.'"></i></a>';
                            }

                            $id_encoded = [];
                            break;
                    }
                }
            }
        }
        $dtlistBtn .= '</div>';
        $dtlistBtn .= $switch;
        $dtlistBtn .= '</div>';

        return $dtlistBtn;
    }

    public function getModels($models)
    {
        $result = [];
        foreach ($models as $model) {
            $Model = 'App\\Models\\'.$model;
            $result[$model] = $Model;
        }

        return $result;
    }

    public static function createReturn($status, $data, $message)
    {
        return response()->json([
            'success' => $status,
            'data' => $data,
            'message' => $message,
        ]);
    }
}
