<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RestrictWebAccess
{
    public function isBrowserRequest()
    {
        $browsers = ['Opera', 'Mozilla', 'Firefox', 'Chrome', 'Edge'];

        $userAgent = request()->header('User-Agent');

        $isBrowser = false;

        foreach($browsers as $browser){
            if(strpos($userAgent, $browser) !==  false){
            $isBrowser = true;
            break;
            }
        }

        return $isBrowser;
    }


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$this->isBrowserRequest() 
            && !request()->expectsJson()) {
            
                return response()->json([
                    "message" => "Forbidden",
                    "code" => 403
                ], 403);
        }

        return $next($request);
    }
}
