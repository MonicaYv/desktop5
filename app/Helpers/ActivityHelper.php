<?php

namespace App\Helpers;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;

class ActivityHelper
{
    public static function log($action, $path, $address)
    {
        $user = Auth::user();
  $agent = new Agent();
        $system = $agent->platform();
        $browser = $agent->browser();
        $browserVersion = $agent->version($browser);
        $systemVersion = $agent->version($system);

        Activity::create([
            'user_id' => $user->id,
            'path' => $path,
            'date' => now(),
            'action' => $action,
            'details' => "$system $systemVersion $browser $browserVersion",
            'address' => $address,
        ]);
    }
}
