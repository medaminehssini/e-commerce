<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App ;

class SetLocale
{



    public function handle($request, Closure $next)
    {


        app()->setLocale(app('lang'));


        return $next($request);
    }
}
