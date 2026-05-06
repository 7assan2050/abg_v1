<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = session('locale', config('app.locale'));

        if ($request->has('lang')) {
            $requested = $request->input('lang');
            $locale = \in_array($requested, ['ar', 'en']) ? $requested : $locale;
            session(['locale' => $locale]);

            return redirect()->back();
        }

        app()->setLocale($locale);

        return $next($request);
    }
}
