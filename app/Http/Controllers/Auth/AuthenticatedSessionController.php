<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Core\Core;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        // $request->authenticate();
        // $request->session()->regenerate();
        // return redirect()->intended(RouteServiceProvider::HOME);
        $data = $request->all();
        $login = $data['email'];
        // $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $field = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : (preg_match('/^[0-9]{10}+$/', $request->email) ? 'phone' : 'username');
        $this->validate($request, [
            'email' => 'required', 'password' => 'required',
        ]);

        $credentials = [
            $field => $data['email'],
            'password' => $data['password'],
        ];

        if (Auth::attempt($credentials, $data['remember_me'])) {
            $user = User::where($field, $login)->first();
            if (! $user->status) {
                Auth::logout();

                return Core::createReturn(false, ['route_to' => url('/login')], 'Your account is not active. Please contact the administrator.');
            } else {
                $getUser = Auth::user();
                $token = $getUser->createToken('appToken')->plainTextToken;
                \Cookie::queue(\Cookie::make('user_token', $token, 21600));

                return Core::createReturn(true, ['route_to' => url('/admin/#/dashboard'), 'user' => $user], 'Welcome Back '.$user->name);
            }
        } else {
            return response()->json(['status' => 0, 'route_to' => url('/login'), 'message' => 'Please check your credentials'], 401);
        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
