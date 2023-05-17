<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $players = Player::select(['name'])->get();
        return view('landing.index', ['players'=>$players]);
    }

}
