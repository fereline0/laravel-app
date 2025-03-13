<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Request as RequestModel;

class CheckRequestAccess
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
        $requestId = $request->route('id');

        $requestModel = RequestModel::find($requestId);

        if (!$requestModel) {
            return abort(404);
        }

        if ($requestModel->user_id === $request->user()->id) {
            return $next($request);
        }

        if (Auth::user()->canany(['edit request status', 'delete request'])) {
            return $next($request);
        }

        return redirect()->route('welcome');
    }
}