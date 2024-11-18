<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckInstallation
{
    public function handle(Request $request, Closure $next)
    {
        if (env('APP_INSTALLED', false) === false) {
            return redirect('/install');
        }
        // Check if there is any user with 'user_type' == 'master'
        $masterUserExists = DB::table('users')->where('usertype', 'master')->exists();

        // If no 'master' user exists, redirect to the installation
        if (!$masterUserExists) {
            return redirect('/install');
        }

        return $next($request);
    }
}
