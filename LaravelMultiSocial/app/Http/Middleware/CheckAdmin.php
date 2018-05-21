<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //check if the user is logged in
        if (Auth::check())
        {
          // The user is logged in...
          $user = User::find(Auth::id());
          //check if the user has admin role
          if ($user->role_id != '1')
          {
            // need to be admin
            //redirect to home with a status of not allowed to access the page
            return redirect('/');
          }

        }
        else {
          // user not logged in redirect to login page
          return redirect('/login');
        }

        return $next($request);
    }
}
