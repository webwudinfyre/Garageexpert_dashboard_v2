<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserTypeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $userType): Response
    {


        if(($request->user()->user_type === $userType) && ($request->user()->status === '1'))
        {

            return $next($request);
        }
        else
        {
            return redirect()->route('failed.page');

        }
        // return redirect()->back();
        // print_r($request->user()->user_type);die();
        // return to_route('/dashboard');
    }
}
