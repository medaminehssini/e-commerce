<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App ;

class SetLocale
{



    public function handle($request, Closure $next)
    {
        if (request()->change_language) {
            session()->put('language', request('change_language'));
            $language = request()->change_language;

        } elseif (session('language')) {
            $language = session('language');
        } elseif (config('app.locale')) {
            $language = config('app.locale');
        }

        if (isset($language) && config('app.languages.' . $language)) {
            app()->setLocale($language);
        }

        return $next($request);
    }
}
