<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Events\PlayerHitBuzzer;
use App\Http\Requests;
use Illuminate\Contracts\Auth\Guard;
use DateTime;
use Carbon\Carbon;

class BuzzerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function buzzer(Guard $auth)
    {
        return view('buzzer.buzzer')->with('currentUser', $auth->user());
    }

    public function buzz(Guard $auth)
    {
        $user = view()->share('user', $auth->user());
//        $user->last_buzz = round(microtime(true) * 1000);
        $user->touch();
        $user->last_buzz = Carbon::createFromTimestamp(strtotime($user->updated_at));
        $user->save();
        event(new PlayerHitBuzzer($user));
    }
}