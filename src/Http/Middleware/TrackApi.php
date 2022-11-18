<?php

namespace SimpleAnalytics\LaravelPackage\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Http;

class TrackApi
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        Http::post("https://queue.simpleanalyticscdn.com/post",[
            'url' => $request->fullUrl(),
            'ua' => $request->userAgent(),
            'timezone' => config('app.timezone')
        ]);

        return $response;
    }
}
