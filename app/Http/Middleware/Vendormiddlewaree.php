<?php

namespace App\Http\Middleware;

use Closure;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Vendormiddlewaree
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
          if(Auth::check() ){
            if(Auth::user()->checktype() == "Super Admin"){
                return $next($request);
            }else{
                return response([
                    'message'=>"access denied",
                    'status' => 403
                ]);
            }
        }else{
            return response([
                'message' => 'please login',
                'status' => 401

            ]);
        } 
     
        //return auth()->user();
      
    }
}
