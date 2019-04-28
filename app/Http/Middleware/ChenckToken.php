<?php
namespace App\Http\Middleware;
use Illuminate\Http\Request;
use Closure;

class ChenckToken
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
        if(!$request->session()->get('cid')){
           return redirect('/kao/login');
        }
        return $next($request);
    }
}
