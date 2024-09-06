<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!isset($_SERVER['HTTP_RCM_API_KEY'])){
            $response['status'] = "Failed";
            $response['result'] = "Please set custom header!";
            return response()->json($response);
        }
        if($_SERVER['HTTP_RCM_API_KEY'] != env('RCM_API_KEY')){
            $response['status'] = "Failed";
            $response['result'] = [];
            $response['message'] = "Local API key not matched";
            return response()->json($response);
        }
        return $next($request);
    }
}
