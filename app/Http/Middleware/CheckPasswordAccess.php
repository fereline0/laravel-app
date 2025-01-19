<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPasswordAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $passwordId = $request->route('id');

        $password = \App\Models\Password::find($passwordId);

        if (!$password) {
            return abort(404);
        }

        if (!$password->privacy || ($password->user_id === $request->user()->id)) {
            return $next($request);
        }

        return redirect()->route('dashboard.passwords.index');
    }
}
