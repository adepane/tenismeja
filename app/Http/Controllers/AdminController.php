<?php

namespace App\Http\Controllers;

use App\Models\User;
use Core\Core as Core;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layouts.app', ['user' => Auth::user()]);
    }

    /**
     * Show the check privilage menu user.
     *
     * @return \Illuminate\Http\Response
     */
    public function identify(Request $request, string $slug, string $subslug = null, string $data = null)
    {
        $Core = new Core;
        $user = Auth::user();
        $models = $request->models;
        if (! empty($models)) {
            $models = $Core->getModels($models);
        }
        if (request()->ajax() && $Core->roleAccess($user, $slug, $subslug)) {
            $module = base_path('modules/'.$slug.'/_config.json');
            if (File::exists($module)) {
                $content = File::get($module);
                $dataMenu = json_decode($content);
                $name = $dataMenu->moduleName;

                return view($slug.'.app', ['name' => $name, 'content' => $dataMenu, 'slug' => $slug, 'subslug' => $subslug, 'data' => $data, 'models' => $models]);
            }

            return view('layouts.404');
        }

        return view('layouts.ssr');
    }

    /**
     * Check module exists.
     *
     * @return \Illuminate\Http\Response
     */
    public function getModuleController(Request $request, $slug, $action = '', $data = '')
    {
        $Core = new Core;
        if ($Core->roleAccess(Auth::user(), $slug, $action)) {
            $controller = base_path('modules/'.$slug.'/_controller.php');
            if (File::exists($controller)) {
                include $controller;
                $contr = $slug.'Controller';
                $modcontroller = new $contr;
                if (method_exists($contr, $action)) {
                    return $modcontroller->$action();
                } else {
                    return response()->json(['message' => 'Action Function Not Found']);
                }
            } else {
                return response()->json(['message' => 'Action Function Not Found']);
            }
        } else {
            return response()->json(['message' => 'Page Not found'], 404);
        }
    }

    public function getLeftMenu()
    {
        $Core = new Core;

        return $Core->getLeftMenu();
    }

    public function loginasuser(Request $request)
    {
        if (! is_null(Session::get('orig_user'))) {
            $return_arr['status'] = 0;
            $return_arr['message'] = 'Sorry, You still have session user, please back to original user';

            return $return_arr;
        } else {
            $user = User::find($request->data);
            $previousUserId = Auth::user()->id;
            Auth::loginUsingId($user->id);
            $token = $user->createToken('appToken')->plainTextToken;
            Cookie::queue(\Cookie::make('user_token', $token, 21600));
            Session::put('orig_user', $previousUserId);
            $return_arr['status'] = 1;
            $return_arr['message'] = 'Success, login as '.$user->name;
            $return_arr['redir'] = route('dash').'/#/dashboard';

            return $return_arr;
        }
    }

    public function returnBackUser(Request $request)
    {
        $oldUser = Session::get('orig_user');
        $user = User::find($oldUser);
        Auth::loginUsingId($oldUser);
        $token = $user->createToken('appToken')->plainTextToken;
        Cookie::queue(\Cookie::make('user_token', $token, 21600));
        Session::forget('orig_user');

        return redirect(route('dash').'/#/dashboard');
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
}
